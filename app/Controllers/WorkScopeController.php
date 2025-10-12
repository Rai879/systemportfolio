<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\WorkScopeModel;

class WorkScopeController extends BaseController
{
    protected $workScopeModel;

    public function __construct()
    {
        $this->workScopeModel = new WorkScopeModel();
    }

    public function index()
    {
        $workScope = $this->workScopeModel->getWorkScope();

        $data = [
            'title' => 'Work Scope Management - Admin Panel',
            'workScope' => $workScope
        ];

        return view('admin/work_scope/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Work Scope - Admin Panel'
        ];

        return view('admin/work_scope/create', $data);
    }

    public function store()
    {
        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'subtitle' => 'permit_empty|max_length[255]',
            'description' => 'required|min_length[10]',
            'features' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle features array
        $features = $this->request->getPost('features');
        if (is_array($features)) {
            $features = json_encode(array_filter($features)); // Remove empty values
        } else {
            $features = '[]';
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'subtitle' => $this->request->getPost('subtitle'),
            'description' => $this->request->getPost('description'),
            'features' => $features
        ];

        // Handle image upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads/work-scope', $newName);
            $data['image'] = $newName;
        }

        if ($this->workScopeModel->save($data)) {
            return redirect()->to('/admin/work-scope')->with('success', 'Work scope berhasil disimpan.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan work scope.');
    }

    public function edit($id)
    {
        $workScope = $this->workScopeModel->find($id);

        if (!$workScope) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Decode features if exists
        if ($workScope['features']) {
            $workScope['features'] = json_decode($workScope['features'], true);
        }

        $data = [
            'title' => 'Edit Work Scope - Admin Panel',
            'workScope' => $workScope
        ];

        return view('admin/work_scope/edit', $data);
    }

    public function update($id)
    {
        $workScope = $this->workScopeModel->find($id);

        if (!$workScope) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'subtitle' => 'permit_empty|max_length[255]',
            'description' => 'required|min_length[10]',
            'features' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle features array
        $features = $this->request->getPost('features');
        if (is_array($features)) {
            $features = json_encode(array_filter($features));
        } else {
            $features = $workScope['features']; // Keep existing if not provided
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'subtitle' => $this->request->getPost('subtitle'),
            'description' => $this->request->getPost('description'),
            'features' => $features
        ];

        // Handle image upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            // Delete old image if exists
            if ($workScope['image']) {
                $oldImagePath = ROOTPATH . 'public/uploads/work-scope/' . $workScope['image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $newName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads/work-scope', $newName);
            $data['image'] = $newName;
        }

        if ($this->workScopeModel->update($id, $data)) {
            return redirect()->to('/admin/work-scope')->with('success', 'Work scope berhasil diperbarui.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui work scope.');
    }

    public function delete($id)
    {
        $workScope = $this->workScopeModel->find($id);

        if (!$workScope) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Delete image if exists
        if ($workScope['image']) {
            $imagePath = ROOTPATH . 'public/uploads/work-scope/' . $workScope['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        if ($this->workScopeModel->delete($id)) {
            return redirect()->to('/admin/work-scope')->with('success', 'Work scope berhasil dihapus.');
        }

        return redirect()->to('/admin/work-scope')->with('error', 'Gagal menghapus work scope.');
    }
}