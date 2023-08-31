<?php

namespace App\Controllers;

use App\Models\CrudModel;
use App\Models\GenerateCode;
use App\Controllers\BaseController;

class Dokter extends BaseController
{
    public function __construct() {
        $this->model = new CrudModel();
        $this->code = new GenerateCode;
        helper('form');
        $this->db = db_connect();
    }

    public function index()
    {
        $dokter = $this->model->getData('dokter');
        $kode = $this->code->createIDDokter();
        return view('masterdata/dokter/index', [
            'dokter'   => $dokter,
            'kode'   => $kode,
            'validation' => $this->validator,
        ]);
    }

    public function simpan()
    {
        $valid = $this->validate([
            'nama_lengkap' => [
                'label' => 'Nama lengkap',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                ]
            ],
            'jenis_kelamin' => [
                'label' => 'Jenis kelamin',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                ]
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                ]
            ],
        ]);

        if (!$valid) {
            $dokter = $this->model->getData('dokter');
            $kode = $this->code->createIDDokter();
            return view('masterdata/dokter/index', [
                'dokter'   => $dokter,
                'kode'   => $kode,
                'validation' => $this->validator,
            ]);
        } else {
            $id_dokter = $this->request->getVar('id_dokter');
            $nama_lengkap = $this->request->getVar('nama_lengkap');
            $jenis_kelamin = $this->request->getVar('jenis_kelamin');
            $alamat = $this->request->getVar('alamat');
    
            $data = [
                'id_dokter' => $id_dokter,
                'nama_lengkap' => $nama_lengkap,
                'jenis_kelamin' => $jenis_kelamin,
                'alamat' => $alamat,
            ];
            $this->model->insertData($data, 'dokter');
            
            session()->setFlashdata("success", "Data berhasil disimpan.");
    
            return redirect()->to(base_url('masterdata/dokter'));
        }
    }

    public function update()
    {
        $post = $this->request->getVar();

        $data = [
            'nama_lengkap' => $post['nama_lengkap'],
            'jenis_kelamin' => $post['jenis_kelamin'],
            'alamat' => $post['alamat']
        ];

        $this->db->table('dokter')
            ->where('id_dokter', $post['id_dokter'])
            ->update($data);

        session()->setFlashdata("success", "Data berhasil diubah.");

        return redirect()->to(base_url('masterdata/dokter'));
    }

    public function hapus($id)
    {
        $this->db->table('dokter')
            ->where('id', $id)
            ->delete();

        session()->setFlashdata("success", "Data berhasil dihapus.");

        return redirect()->to(base_url('masterdata/dokter'));
    }
}
