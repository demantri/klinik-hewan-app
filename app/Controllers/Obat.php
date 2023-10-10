<?php

namespace App\Controllers;

use App\Models\CrudModel;
use App\Models\GenerateCode;
use App\Controllers\BaseController;

class Obat extends BaseController
{
    public function __construct() {
        $this->model = new CrudModel;
        $this->code = new GenerateCode;
        helper('form');
        $this->db = db_connect();
    }

    public function index()
    {
        $obat = $this->model->getData('obat');
        $kode = $this->code->createIDObat();
        return view('masterdata/obat/index', [
            'kode' => $kode,
            'obat' => $obat,
            'validation' => $this->validator,
        ]);
    }

    public function simpan()
    {
        $post = $this->request->getVar();
        
        $data = [
            'id_obat' => $post['id_obat'],
            'nama_obat' => $post['nama_obat'],
            'harga' => str_replace('.', '', $post['harga']),
            'stok' => $post['stok'],
            'tgl_expired' => $post['tgl_expired'],
        ];

        $this->model->insertData($data, 'obat');
            
        session()->setFlashdata("success", "Data berhasil disimpan.");

        return redirect()->to(base_url('masterdata/obat'));
    }

    public function update()
    {
        $post = $this->request->getVar();
        
        $data = [
            // 'id_obat' => $post['id_obat'],
            'nama_obat' => $post['nama_obat'],
            'harga' => str_replace('.', '', $post['harga']),
            'stok' => $post['stok'],
            'tgl_expired' => $post['tgl_expired'],
        ];
        $this->db->table('obat')
            ->where('id_obat', $post['id_obat'])
            ->update($data);

        session()->setFlashdata("success", "Data berhasil diubah.");

        return redirect()->to(base_url('masterdata/obat'));
    }

    public function hapus($id)
    {
        $this->db->table('obat')
            ->where('id', $id)
            ->delete();

        session()->setFlashdata("success", "Data berhasil dihapus.");

        return redirect()->to(base_url('masterdata/obat'));
    }
}
