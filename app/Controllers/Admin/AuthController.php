<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/admin/dashboard');
        }
        return view('admin/auth/login');
    }

    public function attemptLogin()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('username', $username)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Username atau password salah.');
        }

        $sessionData = [
            'userId'     => $user['id'],
            'username'   => $user['username'],
            'email'      => $user['email'],
            'isLoggedIn' => true,
            'loginTime'  => time()
        ];

        session()->set($sessionData);
        return redirect()->to('/admin/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login');
    }

    /**
     * Proses login pengguna admin via API
     */
    public function apiLogin()
    {
        // Jika sudah login
        if (session()->get('isLoggedIn')) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Already logged in',
                'user' => [
                    'username' => session()->get('username'),
                    'email' => session()->get('email')
                ]
            ]);
        }

        $input = $this->request->getJSON(true) ?? $this->request->getPost();

        // Validasi input
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        if (!$this->validateData($input, $rules)) {
            return $this->response->setStatusCode(422)->setJSON([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $this->validator->getErrors()
            ]);
        }

        $username = $input['username'] ?? '';
        $password = $input['password'] ?? '';

        // Cari user berdasarkan username
        $user = $this->userModel->where('username', $username)->first();

        // Validasi user & password
        if (!$user || !password_verify($password, $user['password'])) {
            return $this->response->setStatusCode(401)->setJSON([
                'success' => false,
                'message' => 'Username atau password salah.'
            ]);
        }

        // Set session data
        $sessionData = [
            'userId'     => $user['id'],
            'username'   => $user['username'],
            'email'      => $user['email'],
            'isLoggedIn' => true,
            'loginTime'  => time()
        ];

        session()->set($sessionData);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Login berhasil',
            'user' => [
                'username' => $user['username'],
                'email' => $user['email']
            ]
        ]);
    }

    /**
     * Logout pengguna admin via API
     */
    public function apiLogout()
    {
        session()->destroy();
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Logout berhasil'
        ]);
    }
}