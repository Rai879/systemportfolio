<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\HeroSlideModel;

class HeroSlideController extends BaseController
{
    protected $heroSlideModel;

    public function __construct()
    {
        $this->heroSlideModel = new HeroSlideModel();
    }

    public function index()
    {
        $slides = $this->heroSlideModel->orderBy('sort_order', 'ASC')->findAll();

        $data = [
            'title' => 'Hero Slides Management - Admin Panel',
            'slides' => $slides
        ];

        return view('admin/hero_slides/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Hero Slide - Admin Panel'
        ];

        return view('admin/hero_slides/create', $data);
    }

    public function store()
    {
        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'subtitle' => 'permit_empty|max_length[255]',
            'description' => 'permit_empty',
            'button_text' => 'permit_empty|max_length[50]',
            'button_link' => 'permit_empty|valid_url',
            'sort_order' => 'permit_empty|integer',
            'is_active' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'subtitle' => $this->request->getPost('subtitle'),
            'description' => $this->request->getPost('description'),
            'button_text' => $this->request->getPost('button_text'),
            'button_link' => $this->request->getPost('button_link'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
            'is_active' => $this->request->getPost('is_active') ? 1 : 0
        ];

        // Handle image upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads/hero', $newName);
            $data['image'] = $newName;
        }

        if ($this->heroSlideModel->save($data)) {
            return redirect()->to('/admin/hero-slides')->with('success', 'Hero slide berhasil ditambahkan.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan hero slide.');
    }

    public function edit($id)
    {
        $slide = $this->heroSlideModel->find($id);

        if (!$slide) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit Hero Slide - Admin Panel',
            'slide' => $slide
        ];

        return view('admin/hero_slides/edit', $data);
    }

    public function update($id)
    {
        $slide = $this->heroSlideModel->find($id);

        if (!$slide) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'subtitle' => 'permit_empty|max_length[255]',
            'description' => 'permit_empty',
            'button_text' => 'permit_empty|max_length[50]',
            'button_link' => 'permit_empty|valid_url',
            'sort_order' => 'permit_empty|integer',
            'is_active' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'subtitle' => $this->request->getPost('subtitle'),
            'description' => $this->request->getPost('description'),
            'button_text' => $this->request->getPost('button_text'),
            'button_link' => $this->request->getPost('button_link'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
            'is_active' => $this->request->getPost('is_active') ? 1 : 0
        ];

        // Handle image upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            // Delete old image if exists
            if ($slide['image']) {
                $oldImagePath = ROOTPATH . 'public/uploads/hero/' . $slide['image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $newName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads/hero', $newName);
            $data['image'] = $newName;
        }

        if ($this->heroSlideModel->update($id, $data)) {
            return redirect()->to('/admin/hero-slides')->with('success', 'Hero slide berhasil diperbarui.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui hero slide.');
    }

    public function delete($id)
    {
        $slide = $this->heroSlideModel->find($id);

        if (!$slide) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Delete image if exists
        if ($slide['image']) {
            $imagePath = ROOTPATH . 'public/uploads/hero/' . $slide['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        if ($this->heroSlideModel->delete($id)) {
            return redirect()->to('/admin/hero-slides')->with('success', 'Hero slide berhasil dihapus.');
        }

        return redirect()->to('/admin/hero-slides')->with('error', 'Gagal menghapus hero slide.');
    }

    public function updateOrder()
    {
        $order = $this->request->getPost('order');
        
        if (is_array($order)) {
            foreach ($order as $sortOrder => $id) {
                $this->heroSlideModel->update($id, ['sort_order' => $sortOrder]);
            }
            
            return $this->response->setJSON(['success' => true, 'message' => 'Urutan hero slides berhasil diperbarui.']);
        }
        
        return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui urutan hero slides.']);
    }

    public function toggleStatus($id)
    {
        $slide = $this->heroSlideModel->find($id);

        if (!$slide) {
            return $this->response->setJSON(['success' => false, 'message' => 'Hero slide tidak ditemukan.']);
        }

        $newStatus = $slide['is_active'] ? 0 : 1;
        $this->heroSlideModel->update($id, ['is_active' => $newStatus]);

        return $this->response->setJSON([
            'success' => true, 
            'message' => 'Status hero slide berhasil diubah.',
            'newStatus' => $newStatus
        ]);
    }
}