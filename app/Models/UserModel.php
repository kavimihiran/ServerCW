<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['id', 'firstname', 'lastname', 'email', 'username', 'password'];

    public function verifyUser($username, $password)
    {
        $builder = $this->db->table('users');
        $builder->select("username,password");
        $builder->where('username', $username);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            $row = $result->getRow();
            if ($password == $row->password) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
