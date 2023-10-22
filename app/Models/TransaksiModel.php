<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    public function __construct() {
        $this->db = db_connect();
    }

    public function createTrx($data, $id_trx)
    {
        $harga_obat = $data['harga_obat'];
        $qty = $data['qty'];
        $subtotal = 0;

        foreach ($harga_obat as $key => $item) {
            $subtotal += $item * $qty[$key];
        }

        $trx = [
            'kode_rm' => $data['id_rekam_medis'],
            'id_trx' => $id_trx,
            'tgl_trx' => $data['tanggal'],
            'id_customer' => $data['pemilik'],
            'id_dokter' => $data['dokter'],
            'jasa_dokter' => $data['jasa_dokter'],
            'total_transaksi' => $subtotal,
            'grand_total' => $data['jasa_dokter'] + $subtotal,
            // 'status' => $data['id_rekam_medis'],
        ];
        $this->db->table('transaksi')->insert($trx);
    }

    public function getDataTrx()
    {
        $data = $this->db->query("select 
            a.*,
            b.nama_lengkap as nama_customer,
            c.nama_lengkap as nama_dokter
        from transaksi a
        join pemilik b on a.id_customer = b.id_pemilik
        join dokter c on a.id_dokter = c.id_dokter;")->getResult();

        return $data;
    }

    // insert detail obat
    public function insertObat($data)
    {
        $id_obat = $data['obat'];
        $qty = $data['qty'];
        foreach ($id_obat as $key => $item) {
            $obat = $this->db->query("select * from obat where id_obat = '$item'")->getRow();
            $insert = [
                'kode_rm' => $data['id_rekam_medis'],
                'id_obat' => $item,
                'nama_obat' => $obat->nama_obat,
                'qty' => $qty[$key],
                'harga_obat' => $obat->harga,
                'subtotal' => $qty[$key] * $obat->harga,
            ];
            // print_r($insert);exit;
            $this->db->table('detail_obat')->insert($insert);
        }
    }

    // update stok obat
    public function updateStokObat($data)
    {
        $id_obat = $data['obat'];
        $qty = $data['qty'];
        
        foreach ($id_obat as $key => $item) {
            $obat = $this->db->query("select * from obat where id_obat = '$item'")->getRow();
            $stok = $obat->stok;
            $last_stok = $stok - $qty[$key];

            // update stok
            $this->db->table('obat')
                ->where('id_obat', $item)
                ->update([
                    'stok' => $last_stok
                ]);
        }
    }
}
