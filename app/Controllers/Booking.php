<?php

namespace App\Controllers;

use App\Models\CrudModel;
use App\Models\GenerateCode;
use App\Controllers\BaseController;

class Booking extends BaseController
{
    public function __construct() {
        $this->model = new CrudModel;
        $this->code = new GenerateCode;
        helper('form');
        $this->db = db_connect();
    }

    public function index()
    {
        $kode = $this->code->kode_booking();
        $pemilik = $this->model->getDataAkun('customer');
        // $pemilik = $this->db->query("select * from pemilik")->getResult();
        // dd($pemilik);
        return view('booking/index', [
            'kode' => $kode,
            'pemilik' => $pemilik
        ]);
    }

    public function simpan()
    {
        $post = $this->request->getVar();
        
        $data = [
            'kode_booking' => $post['kode_booking'],
            'tgl_booking' => $post['tgl_booking'],
            'id_pemilik' => $post['nama_lengkap'],
        ];

        $this->db->table('booking')->insert($data);

        session()->setFlashdata("success", "Data berhasil disimpan!");
    
        return redirect()->to(base_url('form-booking'));
    }

    public function listBooking()
    {
        $booking = $this->db->query("select a.*, b.nama_lengkap, b.no_telp, b.alamat 
        from booking a 
        join pemilik b on a.id_pemilik = b.id_pemilik
        where status = 0")->getResult();
        return view('booking/list_booking', [
            'booking' => $booking
        ]);
    }

    public function getDataBooking()
    {
        $kode_booking = $this->request->getVar('kode_booking');
        
        $data = $this->db->query("select a.*, b.nama_lengkap, b.no_telp, b.alamat 
        from booking a 
        join pemilik b on a.id_pemilik = b.id_pemilik
        where a.kode_booking = '$kode_booking'
        ")->getRow();
        
        return $this->response->setJSON($data);
    }
}
