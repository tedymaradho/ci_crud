<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tb_user';
    protected $primaryKey = 'username';
    protected $autoIncrement = false;
    protected $allowedFields = ['username', 'name', 'email', 'password', 'authority'];

    public function search(string $inputText)
    {
        $builder = $this->table('tb_user');
        $arr_search = explode(" ", $inputText);

        for ($x = 0; $x < count($arr_search); $x++) {
            $builder->orLike('name', $arr_search[$x]);
            $builder->orLike('username', $arr_search[$x]);
            $builder->orLike('email', $arr_search[$x]);
        }

        return $builder;
    }
}