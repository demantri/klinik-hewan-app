<?php

namespace App\Controllers;

use App\Models\LoginModel;
use App\Controllers\BaseController;
use App\Models\CrudModel;
use App\Models\GenerateCode;

class Login extends BaseController
{
    public function __construct() {
        $this->login_model = new LoginModel;
        $this->code = new GenerateCode;
        $this->model = new CrudModel;
        $this->db = db_connect();
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
                    'id' => $data->id,
                    'id_user' => $data->id_user,
                    'role_name' => $data->role_name,
                    'username' => $data->username,
                    // 'nama_lengkap' => $data->nama_lengkap,
                    // 'img' => $data->img,
                    // 'is_register' => $data->is_register,
                    // 'url' => $data
                    'logged_in' => TRUE
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

    public function form_forgot_password()
    {
        return view('auth/forgot_password');
    }

    public function forgot_password()
    {
        $rules = [
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]|max_length[255]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 8 karakter',
                    'max_length' => '{field} maksimal 255 karakter',
                ],
            ],
            // 'confirm_password'  => [
            //     'label' => 'Konfirmasi password', 
            //     'rules' => 'matches[password]',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'matches' => '{field} tidak boleh berbeda',
            //     ],
            // ],
        ];

        if ($this->validate($rules)) {
            // kalau valid, simpan data
            $data = $this->request->getVar();
            
            $username = $data['username'];
            $password = $data['password'];

            $this->db->table('users')
                ->where('username', $username)
                ->update([
                    'password' => password_hash($password, PASSWORD_DEFAULT)
                ]);

            session()->setFlashdata("success", "Password berhasil di reset, silahkan login kembali");
    
            return redirect()->to(base_url('/'));
        } else {
            // dd('eror');
            // kalau gak valid, redirect ke form lagi
            $data['validation'] = $this->validator;
            return view('auth/forgot_password', $data);
        }
    }

    public function find_username()
    {
        $username = $this->request->getVar('username');
        
        $data = $this->db->table('users')
                    ->where('username', $username)
                    ->get()
                    ->getRow();
        
        if (!$data) {
            return $this->response->setJSON([
                'data' => null,
                'msg' => 'Username tidak ditemukan!'
            ]);
        }

        return $this->response->setJSON([
            'data'  => $data,
            'msg'   => 'Get data success'
        ], 200);
    }

    public function form_register()
    {
        $kode = $this->code->createIDPemilik();
        $id_user = $this->code->createIDUser();
        return view('auth/register', [
            'id_user' => $id_user,
            'kode' => $kode,
        ]);
    }

    public function register()
    {
        $rules = [
            'nama_lengkap' => [
                'label' => 'Nama lengkap',
                'rules' => 'required|min_length[4]|max_length[255]|is_unique[pemilik.nama_lengkap]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 4 karakter',
                    'max_length' => '{field} maksimal 255 karakter',
                    'is_unique' => '{field} sudah ada sebelumnya',
                ],
            ],
            'no_telp' => [
                'label' => 'No telp',
                'rules' => 'required|max_length[15]|is_unique[pemilik.no_telp]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    // 'min_length' => '{field} minimal 4 karakter',
                    'max_length' => '{field} maksimal 15 karakter',
                    'is_unique' => '{field} sudah ada sebelumnya',
                ],
            ],
            'username' => [
                'label' => 'Username',
                'rules' => 'required|min_length[4]|max_length[255]|is_unique[users.username]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 4 karakter',
                    'max_length' => '{field} maksimal 255 karakter',
                    'is_unique' => '{field} sudah ada sebelumnya',
                ],
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]|max_length[255]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 8 karakter',
                    'max_length' => '{field} maksimal 255 karakter',
                ],
            ],
            'confirm_password'  => [
                'label' => 'Konfirmasi password', 
                'rules' => 'matches[password]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'matches' => '{field} tidak boleh berbeda',
                ],
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required|min_length[4]|max_length[255]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 4 karakter',
                    'max_length' => '{field} maksimal 255 karakter',
                ],
            ],
        ];

        if ($this->validate($rules)) {
            // kalau valid, simpan data
            $data = $this->request->getVar();
            
            // insert pemilik
            $pemilik = [
                'id_pemilik' => $data['id_pemilik'],
                'id_user' => $data['id_user'],
                'nama_lengkap' => $data['nama_lengkap'],
                'no_telp' => $data['no_telp'],
                'alamat' => $data['alamat'],
            ];
            $this->model->insertData($pemilik, 'pemilik');

            // insert users
            $users = [
                'id_user' => $data['id_user'],
                'username' => $data['username'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                'role_name' => 'customer',
            ];
            $this->model->insertData($users, 'users');

            session()->setFlashdata("success", "Berhasil, silahkan login menggunakan username yang sudah terdaftar");
    
            return redirect()->to(base_url('/'));
        } else {
            // kalau gak valid, redirect ke form lagi
            $data['kode'] = $this->code->createIDPemilik();
            $data['validation'] = $this->validator;
            return view('auth/register', $data);
        }
    }

    public function logout()
    {
        $session = session();
        
        $session->setFlashdata('logout', 'Berhasil logout');
    
        $session->destroy();

        return redirect()->to(base_url('login'));
    }
}
