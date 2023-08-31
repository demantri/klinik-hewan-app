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
        return $data; 
    }
}
