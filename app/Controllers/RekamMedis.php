<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use TCPDF;
use App\Models\CrudModel;
use App\Models\GenerateCode;
use App\Controllers\BaseController;
use App\Models\TransaksiModel;

class RekamMedis extends BaseController
{
    public function __construct() {
        $this->code = new GenerateCode;
        $this->model = new CrudModel;
        $this->trx = new TransaksiModel;
        $this->db = db_connect();
    }

    // protected $code;

    // public function __construct(GenerateCode $code) {
    //     $this->code = $code;
    // }

    public function add($kode_booking = '')
    {
        $kode = $this->code->createIDRM();
        // $pemilik = $this->db->query("select * from pemilik where is_register = 1")->getResult();
        $pemilik = $this->model->getDataAkun('customer');
        // $dokter = $this->model->getData('dokter');
        $id_user = session()->get('id_user');
        $dokter = $this->db->query("select a.*, b.id_dokter, b.nama_lengkap
        from users a
        join dokter b on a.id_user = b.id_user
        where b.id_user = '$id_user'")->getRow();
        
        $data = [
            'kode' => $kode,
            'pemilik' => $pemilik,
            'dokter' => $dokter,
            'kode_booking' => $kode_booking
        ];
        return view('rekam-medis/add', $data);
    }

    public function get_peliharaan()
    {
        $id_pemilik = $this->request->getVar('id_pemilik');
        $data = $this->db->query("select * from pendaftaran where id_pemilik = '$id_pemilik'")->getResult();
        return $this->response->setJSON($data);
    }

    public function simpan()
    {
        // $id_rekam_medis = $this->request->getVar();
        // $tanggal = $this->request->getVar();
        // $pemilik = $this->request->getVar();
        // $peliharaan = $this->request->getVar();
        // $dokter = $this->request->getVar();
        // $jasa_dokter = $this->request->getVar();
        // $total_transaksi = $this->request->getVar();
        // $grandtotal = $this->request->getVar();
        // $frekuensi_pulsus = $this->request->getVar();
        // $temperatur_rektal = $this->request->getVar();
        // $frekuensi_nafas = $this->request->getVar();
        // $berat_badan = $this->request->getVar();
        // $kondisi_umum = $this->request->getVar();
        // $kulit_bulu = $this->request->getVar();
        // $membran_mukosa = $this->request->getVar();
        // $kelenjar_limfa = $this->request->getVar();
        // $muskuloskeletal = $this->request->getVar();
        // $sistem_sirkulasi = $this->request->getVar();
        // $sistem_respirasi = $this->request->getVar();
        // $sistem_digesti = $this->request->getVar();
        // $sistem_urogenital = $this->request->getVar();
        // $sistem_saraf = $this->request->getVar();
        // $mata_telinga = $this->request->getVar();
        $data = $this->request->getVar();

        $kode_booking = $data['kode_booking'];
        if ($kode_booking !== '') {
            // update status booking
            $this->db->table('booking')
                ->where('kode_booking', $kode_booking)
                ->update([
                    'status' => 1
                ]);
        }

        $insert = [
            'id_rekam_medis' => $data['id_rekam_medis'],
            'tanggal' => $data['tanggal'],
            'id_pemilik' => $data['pemilik'],
            'nama_peliharaan' => $data['peliharaan'],
            'id_dokter' => $data['dokter'],
            'temperatur_rektal' => $data['temperatur_rektal'],
            'frekuensi_pulsus' => $data['frekuensi_pulsus'],
            'frekuensi_nafas' => $data['frekuensi_nafas'],
            'berat_badan' => $data['berat_badan'],
            'kondisi_umum' => $data['kondisi_umum'],
            'kulit_bulu' => $data['kulit_bulu'],
            'membran_mukosa' => $data['membran_mukosa'],
            'kelenjar_limfa' => $data['kelenjar_limfa'],
            'muskuloskeletal' => $data['muskuloskeletal'],
            'sistem_sirkulasi' => $data['sistem_sirkulasi'],
            'sistem_respirasi' => $data['sistem_respirasi'],
            'sistem_digesti' => $data['sistem_digesti'],
            'sistem_urogenital' => $data['sistem_urogenital'],
            'sistem_saraf' => $data['sistem_saraf'],
            'mata_telinga' => $data['mata_telinga'],
            'jasa_dokter' => $data['jasa_dokter'],
            'total_transaksi' => $data['total_transaksi'],
            'grand_total' => $data['grandtotal'],
            'kode_booking' => $kode_booking,
        ];
        $this->db->table('rekam_medis')
            ->insert($insert);

        // insert table transaksi utk pembayaran
        $id_trx = $this->code->createTrxCode();
        
        $dataTrx = [
            'kode_rm' => $data['id_rekam_medis'],
            'id_trx' => $id_trx,
            'tgl_trx' => $data['tanggal'],
            'id_customer' => $data['pemilik'],
            'id_dokter' => $data['dokter'],
            'jasa_dokter' => $data['jasa_dokter'],
            'total_transaksi' => $data['total_transaksi'],
            'grand_total' => $data['grandtotal'],
            // 'status' => $data['id_rekam_medis'],
        ];
        $this->trx->createTrx($dataTrx);

        return $this->response->setJSON([
            'msg' => 'Data berhasil disimpan'
        ], 200);
    }

    public function view()
    {
        $list = $this->db->query("SELECT 
            a.*,
            b.nama_lengkap,
            c.nama_lengkap AS nama_dokter,
            d.spesies,
            d.ras,
            d.warna,
            d.postur
        FROM rekam_medis a
        JOIN pemilik b ON a.id_pemilik = b.id_pemilik
        JOIN dokter c ON a.id_dokter = c.id_dokter
        JOIN pendaftaran d ON a.id_pemilik = d.id_pemilik
        ORDER BY a.id DESC")->getResult();

        $data = [
            'list' => $list
        ];

        return view('rekam-medis/view', $data);
    }
    
    public function cetak()
    {
        $id_rekam_medis = $this->request->getVar('id_rekam_medis');

        $rm = $this->db->query("SELECT 
            a.*,
            b.nama_lengkap,
            c.nama_lengkap AS nama_dokter,
            d.spesies,
            d.ras,
            d.warna,
            d.postur
        FROM rekam_medis a
        JOIN pemilik b ON a.id_pemilik = b.id_pemilik
        JOIN dokter c ON a.id_dokter = c.id_dokter
        JOIN pendaftaran d ON a.id_pemilik = d.id_pemilik
        WHERE a.id_rekam_medis = '$id_rekam_medis'")->getRow();

        $data = [
            'rm' => $rm
        ];

        $html = view('pdf/cetak_rm', $data);

		$pdf = new TCPDF('L', PDF_UNIT, 'A5', true, 'UTF-8', false);

		// $pdf->SetCreator(PDF_CREATOR);
		// $pdf->SetAuthor('Dea Venditama');
		// $pdf->SetTitle('Invoice');
		// $pdf->SetSubject('Invoice');

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->addPage();

		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');
		//line ini penting
		$this->response->setContentType('application/pdf');
		//Close and output PDF document
		$pdf->Output('rekam_medis.pdf', 'I');
    }

    public function getDetail()
    {
        $id_rm = $this->request->getVar('id_rm');

        $data = $this->db->query("SELECT 
            a.*,
            b.nama_lengkap,
            c.nama_lengkap AS nama_dokter,
            d.spesies,
            d.ras,
            d.warna,
            d.postur
        FROM rekam_medis a
        JOIN pemilik b ON a.id_pemilik = b.id_pemilik
        JOIN dokter c ON a.id_dokter = c.id_dokter
        JOIN pendaftaran d ON a.id_pemilik = d.id_pemilik
        WHERE a.id_rekam_medis = '$id_rm'")->getRow();

        return $this->response->setJSON($data);
    }
}
