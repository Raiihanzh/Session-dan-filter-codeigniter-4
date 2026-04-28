<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
   function __construct()
    {
        helper('form');
    }

public function login()
    {
    if ($this->request->getPost()) {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $dataUser = ['username' => 'Raihan', 'password' => '202cb962ac59075b964b07152d234b70', 'role' => 'admin', 'email' => 'raihan@gmail.com']; // passw 123

        if ($username == $dataUser['username']) {
            if (md5($password) == $dataUser['password']) {
session()->set([
    'username'   => $dataUser['username'],
    'email'      => 'raihan@gmail.com',
    'role'       => $dataUser['role'],
    'isLoggedIn' => true,
    'login_time' => date('Y-m-d H:i:s')
]);

                return redirect()->to(base_url('/'));
            } else {
                session()->setFlashdata('failed', 'Username & Password Salah');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('failed', 'Username Tidak Ditemukan');
            return redirect()->back();
        }
    } else {
        return view('v_login');
    }
    }

    public function logout()
{
    session()->destroy();
    return redirect()->to('login');
}
}