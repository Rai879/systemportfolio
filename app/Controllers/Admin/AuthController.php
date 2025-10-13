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

    /**
     * Tampilkan halaman login
     */
    public function login()
    {
        // Jika sudah login, langsung ke dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/admin/dashboard');
        }

        $data = [
            'title' => 'Login - Admin Panel',
            'config' => config('App')
        ];

        return view('admin/auth/login', $data);
    }

    /**
     * Proses login pengguna admin
     */
    public function attemptLogin()
    {
        // Jika sudah login, redirect ke dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/admin/dashboard');
        }

        // Validasi input
        $rules = [
            'username' => 'required',
            'password' => 'required|min_length[8]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Cari user berdasarkan username
        $user = $this->userModel->where('username', $username)->first();

        // Validasi user & password
        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Username atau password salah.');
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

        // Update waktu login terakhir
        $this->userModel->update($user['id'], [
            'last_login' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/admin/dashboard')->with('success', 'Selamat datang, ' . $user['username'] . '!');
    }

    /**
     * Logout pengguna admin
     */
    public function logout()
    {
        $username = session()->get('username');

        session()->destroy();

        return redirect()->to('/admin/login')->with('success', 'Anda telah logout. Sampai jumpa, ' . $username . '!');
    }

    /**
     * Tampilkan profil pengguna
     */
    public function profile()
    {
        $userId = session()->get('userId');
        $user   = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to('/admin/login')->with('error', 'User tidak ditemukan.');
        }

        $data = [
            'title' => 'Profil Saya - Admin Panel',
            'user'  => $user
        ];

        return view('admin/auth/profile', $data);
    }

    /**
     * Proses update profil
     */
    public function updateProfile()
    {
        $userId = session()->get('userId');
        $user   = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        // Validasi
        $rules = [
            'username' => "required|alpha_numeric_space|min_length[3]|is_unique[users.username,id,{$userId}]",
            'email'    => 'permit_empty|valid_email'
        ];

        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[8]';
            $rules['password_confirmation'] = 'matches[password]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Data yang akan diupdate
        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
        ];

        // Hash password jika ada
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        // Update data
        if ($this->userModel->update($userId, $data)) {
            // Perbarui sesi jika username berubah
            if ($user['username'] !== $data['username']) {
                session()->set('username', $data['username']);
            }

            return redirect()->to('/admin/profile')->with('success', 'Profil berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Gagal memperbarui profil.');
    }
}