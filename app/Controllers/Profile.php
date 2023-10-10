<?php

namespace App\Controllers;

use App\Models\CrudModel;
use App\Models\GenerateCode;
use App\Controllers\BaseController;

class Profile extends BaseController
{
    public function __construct() {
        $this->model = new CrudModel;
        $this->code = new GenerateCode;
        helper('form');
        $this->db = db_connect();
    }
    
    public function index()
    {
        $username = session()->get('username');
        
        $profile = $this->db->query("SELECT 
            a.id,
            a.username,
            a.role_name,
            b.id_pemilik,
            b.nama_lengkap,
            b.no_telp,
            b.alamat,
            b.created_at,
            b.img
        FROM users a
        JOIN pemilik b ON a.username = b.username
        WHERE a.username = '$username';")->getRow();

        $data = [
            'profile' => $profile
        ];

        return view('setting/profile/index', $data);
    }

    public function update()
    {
        $data = $this->request->getVar();
        // $data = [
        //     'id' => $this->request->getVar('id'),
        //     'id_pemilik' => $this->request->getVar('id_pemilik'),
        //     'nama_lengkap' => $this->request->getVar('nama_lengkap'),
        //     'username' => $this->request->getVar('username'),
        //     'alamat' => $this->request->getVar('alamat'),
        //     'no_telp' => $this->request->getVar('no_telp'),
        //     'foto' => $this->request->getFile('foto'),
        // ];
        $foto = $this->request->getFile('foto');
        if (!$foto->getError() == 4) {
            // kalau update foto, update ke pemilik
            $file_name = $foto->getRandomName();
            $ext = $foto->guessExtension();
            
            $this->db->table('pemilik')
                ->where('id_pemilik', $data['id_pemilik'])
                ->update([
                    'img' => $file_name
                ]);

            $foto->move('uploads/image/', $file_name);
        }
        // update pemilik
        $this->db->table('pemilik')
            ->where('id_pemilik', $data['id_pemilik'])
            ->update([
                'username' => $data['username'],
                'nama_lengkap' => $data['nama_lengkap'],
                'no_telp' => $data['no_telp'],
                'alamat' => $data['alamat'],
            ]);

        // update users
        $this->db->table('users')
            ->where('id', $data['id'])
            ->update([
                'username' => $data['username'],
            ]);

        // session()->setFlashdata('logout', '')

        session()->setFlashdata('success', 'Data berhasil diupdate');
        // session()->destroy();
        return redirect()->to(base_url('setting/profile'));
    }
}