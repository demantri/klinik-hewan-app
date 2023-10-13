<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    public function __construct() {
        $this->db = db_connect();
    }

    public function createTrx($dataArray)
    {
        $data = $this->db->table('transaksi')
            ->insert($dataArray);

        return $data;
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
}
