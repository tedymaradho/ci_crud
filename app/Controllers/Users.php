<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Users extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index()
    {
        $limitRow = 3;

        $inputText = $this->request->getGet('inputText');
        if ($inputText) {
            $search = $this->userModel->search($inputText);
        } else {
            $search = $this->userModel;
        }

        $data['inputText'] = $inputText;
        $data['users'] = $search->orderBy('name')->paginate($limitRow);
        $data['pager'] = $this->userModel->pager;
        if ($this->request->getVar('page')) {
            $data['number'] = $this->request->getVar('page') == '1' ? '0' : $this->request->getVar('page') * $limitRow - $limitRow;
        } else {
            $data['number'] = '0';
        }
        return view('pages/user_view', $data);
    }

    public function save()
    {
        $validasi = \Config\Services::validation();
        $allRules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|is_unique[tb_user.username]',
                'errors' => [
                    'required' => '{field} cannot be empty',
                    'is_unique' => '{field} is already exist'
                ]
            ],
            'name' => [
                'label' => 'Name',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} cannot be empty'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} cannot be empty',
                    'valid_email' => 'Invalid {field}'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => '{field} cannot be empty',
                    'min_length' => '{field} minimum 6 characters'
                ]
            ]
        ];

        $validasi->setRules($allRules);

        if ($validasi->withRequest($this->request)->run()) {
            $username = $this->request->getPost('username');
            $name = $this->request->getPost('name');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $authority = $this->request->getPost('authority');

            $data = [
                'username' => $username,
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'authority' => $authority,
            ];

            $this->userModel->save($data);

            $res['success'] = "Data saved successfully";
            $res['error'] = false;
        } else {
            $res['success'] = false;
            $res['error'] = $validasi->listErrors();
        }

        return json_encode($res);
    }
}