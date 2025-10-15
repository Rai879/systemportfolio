<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\WhyChooseUsModel;

class WhyChooseUsController extends BaseController
{
    protected $whyChooseUsModel;

    public function __construct()
    {
        $this->whyChooseUsModel = new WhyChooseUsModel();
    }

    public function index()
    {
        $items = $this->whyChooseUsModel->orderBy('sort_order', 'ASC')->findAll();

        $data = [
            'title' => 'Why Choose Us Management - Admin Panel',
            'items' => $items
        ];

        return view('admin/why_choose_us/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Why Choose Us - Admin Panel',
            'colorOptions' => $this->getColorOptions()
        ];

        return view('admin/why_choose_us/create', $data);
    }

    public function store()
    {
        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'description' => 'required|min_length[10]',
            'icon' => 'required|max_length[100]',
            'color' => 'required|max_length[50]',
            'sort_order' => 'permit_empty|integer'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'icon' => $this->request->getPost('icon'),
            'color' => $this->request->getPost('color'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0
        ];

        if ($this->whyChooseUsModel->save($data)) {
            return redirect()->to('/admin/why-choose-us')->with('success', 'Item berhasil ditambahkan.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan item.');
    }

    public function edit($id)
    {
        $item = $this->whyChooseUsModel->find($id);

        if (!$item) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit Why Choose Us - Admin Panel',
            'item' => $item,
            'colorOptions' => $this->getColorOptions()
        ];

        return view('admin/why_choose_us/edit', $data);
    }

    public function update($id)
    {
        $item = $this->whyChooseUsModel->find($id);

        if (!$item) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'description' => 'required|min_length[10]',
            'icon' => 'required|max_length[100]',
            'color' => 'required|max_length[50]',
            'sort_order' => 'permit_empty|integer'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'icon' => $this->request->getPost('icon'),
            'color' => $this->request->getPost('color'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0
        ];

        if ($this->whyChooseUsModel->update($id, $data)) {
            return redirect()->to('/admin/why-choose-us')->with('success', 'Item berhasil diperbarui.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui item.');
    }

    public function delete($id)
    {
        $item = $this->whyChooseUsModel->find($id);

        if (!$item) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->whyChooseUsModel->delete($id)) {
            return redirect()->to('/admin/why-choose-us')->with('success', 'Item berhasil dihapus.');
        }

        return redirect()->to('/admin/why-choose-us')->with('error', 'Gagal menghapus item.');
    }

    public function updateOrder()
    {
        $order = $this->request->getPost('order');
        
        if (is_array($order)) {
            foreach ($order as $sortOrder => $id) {
                $this->whyChooseUsModel->update($id, ['sort_order' => $sortOrder]);
            }
            
            return $this->response->setJSON(['success' => true, 'message' => 'Urutan items berhasil diperbarui.']);
        }
        
        return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui urutan items.']);
    }

    /**
     * Get available color options
     */
    private function getColorOptions()
    {
        return [
            'primary' => 'Primary (Biru)',
            'secondary' => 'Secondary (Abu-abu)',
            'success' => 'Success (Hijau)',
            'danger' => 'Danger (Merah)',
            'warning' => 'Warning (Kuning)',
            'info' => 'Info (Biru Muda)',
            'light' => 'Light (Terang)',
            'dark' => 'Dark (Gelap)',
            'purple' => 'Purple (Ungu)',
            'pink' => 'Pink (Merah Muda)',
            'orange' => 'Orange (Jingga)',
            'teal' => 'Teal (Biru Hijau)'
        ];
    }
}