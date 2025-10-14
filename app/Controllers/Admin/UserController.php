<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $users = $this->userModel->findAll();

        $data = [
            'title' => 'Manajemen User - Admin Panel',
            'users' => $users
        ];

        return view('admin/users/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah User Baru - Admin Panel'
        ];

        return view('admin/users/create', $data);
    }

    public function store()
    {
        $rules = [
            'username' => 'required|alpha_numeric_space|min_length[3]|is_unique[users.username]',
            'email' => 'permit_empty|valid_email',
            'password' => 'required|min_length[8]',
            'password_confirmation' => 'required|matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password') 
        ];

        if ($this->userModel->save($data)) {
            return redirect()->to('/admin/users')->with('success', 'User berhasil ditambahkan.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan user.');
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit User - Admin Panel',
            'user' => $user
        ];

        return view("admin/users/edit", $data);
    }

    public function update($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $postedUsername = $this->request->getPost('username');
        $postedEmail = $this->request->getPost('email');
        $postedPassword = $this->request->getPost('password');

        $rules = [];

        // Validasi username hanya jika diubah dan tidak kosong
        if ($postedUsername !== null && $postedUsername !== '' && $postedUsername !== $user['username']) {
            $existing = $this->userModel->where('username', $postedUsername)->where('id !=', $id)->first();
            if ($existing) {
                return redirect()->back()->withInput()->with('error', 'Username sudah digunakan oleh user lain.');
            }
            $rules['username'] = 'required|alpha_numeric_space|min_length[3]';
        } elseif ($postedUsername !== null && $postedUsername !== '') {
            $rules['username'] = 'required|alpha_numeric_space|min_length[3]';
        }

        // Validasi email jika diinput
        if ($postedEmail !== null) {
            $rules['email'] = 'permit_empty|valid_email';
        }

        // Validasi password jika diinput
        if ($postedPassword) {
            $rules['password'] = 'required|min_length[8]';
            $rules['password_confirmation'] = 'required|matches[password]';
        }

        if (!empty($rules) && !$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [];
        if ($postedUsername !== null) {
            $data['username'] = $postedUsername;
        }
        if ($postedEmail !== null) {
            $data['email'] = $postedEmail;
        }
        if ($postedPassword) {
            $data['password'] = $postedPassword;
        }

        if (empty($data)) {
            return redirect()->back()->with('error', 'Tidak ada data yang diubah.');
        }

        $success = $this->userModel->update($id, $data);

        if ($success) {
            return redirect()->to('/admin/users')->with('success', 'User berhasil diperbarui.');
        } 

        if ($this->userModel->errors()) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui user. Detail error: ' . implode(', ', $this->userModel->errors()));
        }

        return redirect()->back()->with('error', 'Gagal memperbarui user. Kemungkinan tidak ada data yang diubah atau terjadi kesalahan koneksi.');
    }

    public function delete($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $currentUserId = session()->get('userId') ?? null;
        
        // Prevent deleting own account
        if ($user['id'] == $currentUserId) {
            return redirect()->to('/admin/users')->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        if ($this->userModel->delete($id)) {
            return redirect()->to('/admin/users')->with('success', 'User berhasil dihapus.');
        }

        return redirect()->to('/admin/users')->with('error', 'Gagal menghapus user.');
    }
}