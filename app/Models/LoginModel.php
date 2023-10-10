<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    public function __construct() { //memanggil 
        $this->db = db_connect();
    }

    public function getUser($username)
    {
        $data = $this->db->table('users')
            ->where('username', $username)
            ->get()->getRow();
        // $data = $this->db->query("select 
        //     a.*, 
        //     b.nama_lengkap, 
        //     b.img, 
        //     b.is_register
        // from users a
        // join pemilik b on a.username = b.username
        // where a.username = '$username'")->getRow();
        return $data; 
    }
}
