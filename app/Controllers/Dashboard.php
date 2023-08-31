<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function __construct() {
        $this->db = db_connect();
    }

    public function index()
    {
        return view('dashboard');
    }

    public function getSpesies()
    {
        $data = $this->db->query("SELECT deskripsi FROM dropdown WHERE jenis = 'spesies'")->getResult();
        echo json_encode($data);
    }

    public function getRas()
    {
        $data = $this->db->query("SELECT deskripsi FROM dropdown WHERE jenis = 'ras'")->getResult();
        echo json_encode($data);
    }

    public function getTrx()
    {
        $year = date('Y');

        $data = $this->db->query("SELECT 
            MONTHNAME(tanggal) AS bulan,
            SUM(grand_total) AS total
        FROM rekam_medis
        WHERE YEAR(tanggal) = '$year'
        GROUP BY MONTHNAME(tanggal)
        ORDER BY MONTH(tanggal)")->getResult();

        echo json_encode($data);
    }
}
