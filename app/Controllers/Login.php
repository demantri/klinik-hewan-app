<?php

namespace App\Controllers;

use App\Models\LoginModel;
use App\Controllers\BaseController;

class Login extends BaseController
{
    public function __construct() {
        $this->login_model = new LoginModel;
    }
    
    public function index()
    {
        return view('auth/index');
    }

    public function doLogin()
    {
        $session = session();

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // cek user di database
        $data = $this->login_model->getUser($username);
        // print_r($data);exit;
        if($data){
            $pass = $data->password;
            $verify_pass = password_verify($password, $pass);
            if($verify_pass){
                $ses_data = [
                    'id'       => $data->id,
                    'role_name'     => $data->role_name,
                    'username'     => $data->username,
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                $session->setFlashdata('success', 'Berhasil login. Selamat datang, ' . ucwords(session('username')));
                return redirect()->to(base_url('dashboard'));
            } else {
                $session->setFlashdata('warning', 'Password salah. Silahkan ulangi kembali.');
                return redirect()->to(base_url('login'));
            }
        } else {
            $session->setFlashdata('warning', 'Username tidak ditemukan.');
            return redirect()->to(base_url('login'));
        }

        return $username;
    }

    public function logout()
    {
        $session = session();
        
        $session->setFlashdata('logout', 'Berhasil logout');
    
        $session->destroy();

        return redirect()->to(base_url('login'));
    }
}
