<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PageModel;

class PageController extends BaseController
{
    protected $pageModel;

    public function __construct()
    {
        $this->pageModel = new PageModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola Halaman Dinamis',
            'pages' => $this->pageModel->findAll()
        ];
        return view('admin/pages/index', $data);
    }

    public function edit($id)
    {
        $page = $this->pageModel->find($id);
        if (!$page) {
            return redirect()->to('/admin/pages')->with('error', 'Halaman tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Halaman: ' . $page['title'],
            'page'  => $page
        ];
        return view('admin/pages/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'title'   => 'required',
            'content' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->pageModel->update($id, [
            'title'   => $this->request->getPost('title'),
            'content' => $this->request->getPost('content')
        ]);

        return redirect()->to('/admin/pages')->with('success', 'Halaman berhasil diperbarui');
    }
}
