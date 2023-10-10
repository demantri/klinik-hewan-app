<?php

namespace App\Controllers;

use App\Models\CrudModel;
use App\Models\GenerateCode;
use App\Controllers\BaseController;

class User extends BaseController
{
    public function __construct() {
        $this->model = new CrudModel;
        $this->code = new GenerateCode;
        helper('form');
        $this->db = db_connect();
    }

    public function index()
    {
        $user = $this->model->getData('users');
        $kode = $this->code->createIDObat();
        return view('masterdata/user/index', [
            'kode' => $kode,
            'user' => $user,
            'validation' => $this->validator,
        ]);
    }

    public function simpan()
    {
        $post = $this->request->getVar();
        
        $data = [
            'username' => $post['username'],
            'password' => password_hash($post['password'], PASSWORD_DEFAULT),
            'role_name' => $post['role'],
        ];

        $this->model->insertData($data, 'users');
            
        session()->setFlashdata("success", "Data berhasil disimpan.");

        return redirect()->to(base_url('masterdata/user'));
    }

    public function update()
    {
        $post = $this->request->getVar();
        
        $data = [
            'username' => $post['username'],
            'password' => password_hash($post['password'], PASSWORD_DEFAULT),
            'role_name' => $post['role'],
        ];
        
        $this->db->table('users')
            ->where('id', $post['id'])
            ->update($data);

        session()->setFlashdata("success", "Data berhasil diubah.");

        return redirect()->to(base_url('masterdata/user'));
    }

    public function hapus($id)
    {
        $this->db->table('users')
            ->where('id', $id)
            ->delete();

        session()->setFlashdata("success", "Data berhasil dihapus.");

        return redirect()->to(base_url('masterdata/user'));
    }
}
