<?php

namespace App\Controllers;

use App\Models\GenerateCode;
use App\Models\TransaksiModel;
use App\Controllers\BaseController;

class Transaksi extends BaseController
{
    public function __construct() {
        $this->trx = new TransaksiModel;
        $this->db = db_connect();
    }

    public function index()
    {
        $trx = $this->trx->getDataTrx();
        $data = [
            'trx' => $trx
        ];
        return view('rekam-medis/pembayaran/index', $data);
    }

    public function bayar()
    {
        $id_trx = $this->request->getVar('id_trx');
        // update status
        $this->db->table('transaksi')
            ->where('id_trx', $id_trx)
            ->update([
                'status' => 1
            ]);

        return $this->response->setJSON([
            'msg' => 'Data berhasil disimpan'
        ], 200);
    }
}
