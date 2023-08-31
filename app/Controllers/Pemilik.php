<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CrudModel;
use App\Models\GenerateCode;

class Pemilik extends BaseController
{
    public function __construct() {
        $this->model = new CrudModel();
        $this->code = new GenerateCode;
        helper('form');
        $this->db = db_connect();
    }

    public function index()
    {
        $pemilik = $this->model->getData('pemilik');
        $kode = $this->code->createIDPemilik();
        // print_r($kode);exit;
        return view('masterdata/pemilik/index', [
            'kode' => $kode,
            'pemilik' => $pemilik,
            'validation' => $this->validator,
        ]);
    }

    public function simpan()
    {
        $valid = $this->validate([
            'nama' => [
                'label' => 'Nama pemilik',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                ]
            ],
            'no_telp' => [
                'label' => 'No. telp',
                'rules' => 'required|is_unique[pemilik.no_telp,id]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                    'is_unique' => '{field} sudah terdaftar sebelumnya.',
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
            $data['validation'] = $this->validator;
            $data['pemilik'] = $this->model->getData('pemilik');
            $data['kode'] = $this->code->createIDPemilik();
            echo view('masterdata/pemilik/index', $data);
        } else {
            $id_pemilik = $this->request->getVar('id_pemilik');
            $nama = $this->request->getVar('nama');
            $no_telp = str_replace('-', '', $this->request->getVar('no_telp'));
            $alamat = $this->request->getVar('alamat');
    
            $data = [
                'id_pemilik' => $id_pemilik,
                'nama_lengkap' => $nama,
                'no_telp' => $no_telp,
                'alamat' => $alamat,
            ];
            $this->model->insertData($data, 'pemilik');
            
            session()->setFlashdata("success", "Data berhasil disimpan.");
    
            return redirect()->to(base_url('masterdata/pemilik'));
        }
    }

    public function update()
    {
        $valid = $this->validate([
            'nama_edit' => [
                'label' => 'Nama pemilik',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                ]
            ],
            // 'no_telp_edit' => [
            //     'label' => 'No. telp',
            //     'rules' => 'required|is_unique[pemilik.no_telp,id]',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong.',
            //         'is_unique' => '{field} sudah terdaftar sebelumnya.',
            //     ]
            // ],
            'alamat_edit' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                ]
            ],
        ]);

        if (!$valid) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            $id_pemilik = $this->request->getVar('id_pemilik_edit');
            $nama = $this->request->getVar('nama_edit');
            $no_telp = str_replace('-', '', $this->request->getVar('no_telp_edit'));
            $alamat = $this->request->getVar('alamat_edit');
            
            $data = [
                // 'id_pemilik' => $id_pemilik,
                'nama_lengkap' => $nama,
                'no_telp' => $no_telp,
                'alamat' => $alamat,
            ];
            // print_r($data);exit;

            $this->db->table('pemilik')
                ->where('id_pemilik', $id_pemilik)
                ->update($data);
            // $this->model->insertData($data, 'pemilik');
            
            session()->setFlashdata("success", "Data berhasil diubah.");
    
            return redirect()->to(base_url('masterdata/pemilik'));
        }
    }

    public function hapus($id)
    {
        $this->db->table('pemilik')
            ->where('id_pemilik', $id)
            ->delete();

        session()->setFlashdata("success", "Data berhasil dihapus.");

        return redirect()->to(base_url('masterdata/pemilik'));
    }
}
