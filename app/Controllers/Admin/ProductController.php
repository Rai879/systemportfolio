<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class ProductController extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $products = $this->productModel->orderBy('sort_order', 'ASC')->findAll();

        $data = [
            'title' => 'Products Management - Admin Panel',
            'products' => $products,
            'categories' => $this->getCategories()
        ];

        return view('admin/products/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Product - Admin Panel',
            'categories' => $this->getCategories()
        ];

        return view('admin/products/create', $data);
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'description' => 'required|min_length[10]',
            'category' => 'required',
            'sort_order' => 'permit_empty|integer',
            'is_active' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'category' => $this->request->getPost('category'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
            'is_active' => $this->request->getPost('is_active') ? 1 : 0
        ];

        // Handle image upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads/products', $newName);
            $data['image'] = $newName;
        }

        if ($this->productModel->save($data)) {
            return redirect()->to('/admin/products')->with('success', 'Product berhasil ditambahkan.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan product.');
    }

    public function edit($id)
    {
        $product = $this->productModel->find($id);

        if (!$product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit Product - Admin Panel',
            'product' => $product,
            'categories' => $this->getCategories()
        ];

        return view('admin/products/edit', $data);
    }

    public function update($id)
    {
        $product = $this->productModel->find($id);

        if (!$product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'description' => 'required|min_length[10]',
            'category' => 'required',
            'sort_order' => 'permit_empty|integer',
            'is_active' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'category' => $this->request->getPost('category'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
            'is_active' => $this->request->getPost('is_active') ? 1 : 0
        ];

        // Handle image upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            // Delete old image if exists
            if ($product['image']) {
                $oldImagePath = ROOTPATH . 'public/uploads/products/' . $product['image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $newName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads/products', $newName);
            $data['image'] = $newName;
        }

        if ($this->productModel->update($id, $data)) {
            return redirect()->to('/admin/products')->with('success', 'Product berhasil diperbarui.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui product.');
    }

    public function delete($id)
    {
        $product = $this->productModel->find($id);

        if (!$product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Delete image if exists
        if ($product['image']) {
            $imagePath = ROOTPATH . 'public/uploads/products/' . $product['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        if ($this->productModel->delete($id)) {
            return redirect()->to('/admin/products')->with('success', 'Product berhasil dihapus.');
        }

        return redirect()->to('/admin/products')->with('error', 'Gagal menghapus product.');
    }

    public function updateOrder()
    {
        $order = $this->request->getPost('order');
        
        if (is_array($order)) {
            foreach ($order as $sortOrder => $id) {
                $this->productModel->update($id, ['sort_order' => $sortOrder]);
            }
            
            return $this->response->setJSON(['success' => true, 'message' => 'Urutan products berhasil diperbarui.']);
        }
        
        return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui urutan products.']);
    }

    public function toggleStatus($id)
    {
        $product = $this->productModel->find($id);

        if (!$product) {
            return $this->response->setJSON(['success' => false, 'message' => 'Product tidak ditemukan.']);
        }

        $newStatus = $product['is_active'] ? 0 : 1;
        $this->productModel->update($id, ['is_active' => $newStatus]);

        return $this->response->setJSON([
            'success' => true, 
            'message' => 'Status product berhasil diubah.',
            'newStatus' => $newStatus
        ]);
    }

    /**
     * Get available categories
     */
    private function getCategories()
    {
        return [
            'simrs' => 'SIMRS (Sistem Informasi Manajemen Rumah Sakit)',
            'emr' => 'EMR (Electronic Medical Record)',
            'hr-portal' => 'HR Portal',
            'financial' => 'Sistem Keuangan',
            'inventory' => 'Manajemen Inventory',
            'pharmacy' => 'Sistem Farmasi',
            'laboratory' => 'Sistem Laboratorium',
            'radiology' => 'Sistem Radiologi',
            'other' => 'Lainnya'
        ];
    }
}