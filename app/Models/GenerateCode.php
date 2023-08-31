<?php

namespace App\Models;

use CodeIgniter\Model;

class GenerateCode extends Model
{
    public function __construct() {
        $this->db = db_connect();
    }

    public function createIDPemilik()
    {
        $query = $this->db->query("select right(id_pemilik, 3) as kode from pemilik order by id desc limit 1");
        
        if (count($query->getResult()) <> 0 ) { // cek kondisi, kalau hasil data nya tidak = 0.
            $data = $query->getRow();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kd = "P-" . $kodemax;
        return $kd;
    }

    public function createIDPendaftaran()
    {
        $query = $this->db->query("select right(id_pendaftaran, 4) as kode from pendaftaran order by id desc limit 1");
        
        if (count($query->getResult()) <> 0 ) { // cek kondisi, kalau hasil data nya tidak = 0.
            $data = $query->getRow();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kd = "RGST".date('Ymd').$kodemax;
        return $kd;
    }

    public function createIDRM()
    {
        $query = $this->db->query("select right(id_rekam_medis, 4) as kode from rekam_medis where status <> 0 order by id desc limit 1");
        
        if (count($query->getResult()) <> 0 ) { // cek kondisi, kalau hasil data nya tidak = 0.
            $data = $query->getRow();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kd = "RM-".date('Ymd').$kodemax;
        return $kd;
    }
    
    public function createIDDokter()
    {
        $query = $this->db->query("select right(id_dokter, 3) as kode from dokter order by id desc limit 1");
        
        if (count($query->getResult()) <> 0 ) { // cek kondisi, kalau hasil data nya tidak = 0.
            $data = $query->getRow();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kd = "D-" . $kodemax;
        return $kd;
    }
}
