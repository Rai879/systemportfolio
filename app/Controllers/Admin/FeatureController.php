<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FeatureModel;

class FeatureController extends BaseController
{
    protected $featureModel;

    public function __construct()
    {
        $this->featureModel = new FeatureModel();
    }

    public function index()
    {
        $features = $this->featureModel->orderBy('sort_order', 'ASC')->findAll();

        $data = [
            'title' => 'Features Management - Admin Panel',
            'features' => $features
        ];

        return view('admin/features/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Feature - Admin Panel',
            'colorOptions' => $this->getColorOptions()
        ];

        return view('admin/features/create', $data);
    }

    public function store()
    {
        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'description' => 'required|min_length[10]',
            'icon' => 'required|max_length[100]',
            'color' => 'required|max_length[50]',
            'sort_order' => 'permit_empty|integer',
            'is_active' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'icon' => $this->request->getPost('icon'),
            'color' => $this->request->getPost('color'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
            'is_active' => $this->request->getPost('is_active') ? 1 : 0
        ];

        if ($this->featureModel->save($data)) {
            return redirect()->to('/admin/features')->with('success', 'Feature berhasil ditambahkan.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan feature.');
    }

    public function edit($id)
    {
        $feature = $this->featureModel->find($id);

        if (!$feature) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit Feature - Admin Panel',
            'feature' => $feature,
            'colorOptions' => $this->getColorOptions()
        ];

        return view('admin/features/edit', $data);
    }

    public function update($id)
    {
        $feature = $this->featureModel->find($id);

        if (!$feature) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'description' => 'required|min_length[10]',
            'icon' => 'required|max_length[100]',
            'color' => 'required|max_length[50]',
            'sort_order' => 'permit_empty|integer',
            'is_active' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'icon' => $this->request->getPost('icon'),
            'color' => $this->request->getPost('color'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
            'is_active' => $this->request->getPost('is_active') ? 1 : 0
        ];

        if ($this->featureModel->update($id, $data)) {
            return redirect()->to('/admin/features')->with('success', 'Feature berhasil diperbarui.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui feature.');
    }

    public function delete($id)
    {
        $feature = $this->featureModel->find($id);

        if (!$feature) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->featureModel->delete($id)) {
            return redirect()->to('/admin/features')->with('success', 'Feature berhasil dihapus.');
        }

        return redirect()->to('/admin/features')->with('error', 'Gagal menghapus feature.');
    }

    public function updateOrder()
    {
        $order = $this->request->getPost('order');
        
        if (is_array($order)) {
            foreach ($order as $sortOrder => $id) {
                $this->featureModel->update($id, ['sort_order' => $sortOrder]);
            }
            
            return $this->response->setJSON(['success' => true, 'message' => 'Urutan features berhasil diperbarui.']);
        }
        
        return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui urutan features.']);
    }

    public function toggleStatus($id)
    {
        $feature = $this->featureModel->find($id);

        if (!$feature) {
            return $this->response->setJSON(['success' => false, 'message' => 'Feature tidak ditemukan.']);
        }

        $newStatus = $feature['is_active'] ? 0 : 1;
        $this->featureModel->update($id, ['is_active' => $newStatus]);

        return $this->response->setJSON([
            'success' => true, 
            'message' => 'Status feature berhasil diubah.',
            'newStatus' => $newStatus
        ]);
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
            'dark' => 'Dark (Gelap)'
        ];
    }
}