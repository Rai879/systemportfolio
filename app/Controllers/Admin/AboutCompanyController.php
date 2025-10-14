<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AboutCompanyModel;

class AboutCompanyController extends BaseController
{
    protected $aboutCompanyModel;

    public function __construct()
    {
        $this->aboutCompanyModel = new AboutCompanyModel();
    }

    public function index()
    {
        $aboutCompany = $this->aboutCompanyModel->getCompanyInfo();

        $data = [
            'title' => 'About Company - Admin Panel',
            'aboutCompany' => $aboutCompany
        ];

        return view('admin/about_company/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah About Company - Admin Panel'
        ];

        return view('admin/about_company/create', $data);
    }

    public function store()
    {
        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'subtitle' => 'permit_empty|max_length[255]',
            'description' => 'required|min_length[10]',
            'years_experience' => 'permit_empty|integer',
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
            'years_experience' => $this->request->getPost('years_experience'),
            'features' => $features
        ];

        // Handle image upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads/about', $newName);
            $data['image'] = $newName;
        }

        if ($this->aboutCompanyModel->save($data)) {
            return redirect()->to('/admin/about-company')->with('success', 'Data about company berhasil disimpan.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data about company.');
    }

    public function edit($id)
    {
        $aboutCompany = $this->aboutCompanyModel->find($id);

        if (!$aboutCompany) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Decode features if exists
        if ($aboutCompany['features']) {
            $aboutCompany['features'] = json_decode($aboutCompany['features'], true);
        }

        $data = [
            'title' => 'Edit About Company - Admin Panel',
            'aboutCompany' => $aboutCompany
        ];

        return view('admin/about_company/edit', $data);
    }

    public function update($id)
    {
        $aboutCompany = $this->aboutCompanyModel->find($id);

        if (!$aboutCompany) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'subtitle' => 'permit_empty|max_length[255]',
            'description' => 'required|min_length[10]',
            'years_experience' => 'permit_empty|integer',
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
            $features = $aboutCompany['features']; // Keep existing if not provided
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'subtitle' => $this->request->getPost('subtitle'),
            'description' => $this->request->getPost('description'),
            'years_experience' => $this->request->getPost('years_experience'),
            'features' => $features
        ];

        // Handle image upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            // Delete old image if exists
            if ($aboutCompany['image']) {
                $oldImagePath = ROOTPATH . 'public/uploads/about/' . $aboutCompany['image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $newName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads/about', $newName);
            $data['image'] = $newName;
        }

        if ($this->aboutCompanyModel->update($id, $data)) {
            return redirect()->to('/admin/about-company')->with('success', 'Data about company berhasil diperbarui.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data about company.');
    }

    public function delete($id)
    {
        $aboutCompany = $this->aboutCompanyModel->find($id);

        if (!$aboutCompany) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Delete image if exists
        if ($aboutCompany['image']) {
            $imagePath = ROOTPATH . 'public/uploads/about/' . $aboutCompany['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        if ($this->aboutCompanyModel->delete($id)) {
            return redirect()->to('/admin/about-company')->with('success', 'Data about company berhasil dihapus.');
        }

        return redirect()->to('/admin/about-company')->with('error', 'Gagal menghapus data about company.');
    }
}