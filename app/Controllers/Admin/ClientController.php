<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ClientModel;

class ClientController extends BaseController
{
    protected $clientModel;

    public function __construct()
    {
        $this->clientModel = new ClientModel();
    }

    public function index()
    {
        $clients = $this->clientModel->orderBy('sort_order', 'ASC')->findAll();

        $data = [
            'title' => 'Clients Management - Admin Panel',
            'clients' => $clients
        ];

        return view('admin/clients/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Client - Admin Panel'
        ];

        return view('admin/clients/create', $data);
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min_length[2]|max_length[255]',
            'location' => 'permit_empty|max_length[255]',
            'sort_order' => 'permit_empty|integer',
            'is_active' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'location' => $this->request->getPost('location'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
            'is_active' => $this->request->getPost('is_active') ? 1 : 0
        ];

        // Handle logo upload
        $logo = $this->request->getFile('logo');
        if ($logo && $logo->isValid() && !$logo->hasMoved()) {
            $newName = $logo->getRandomName();
            $logo->move(ROOTPATH . 'public/uploads/clients', $newName);
            $data['logo'] = $newName;
        }

        if ($this->clientModel->save($data)) {
            return redirect()->to('/admin/clients')->with('success', 'Client berhasil ditambahkan.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan client.');
    }

    public function edit($id)
    {
        $client = $this->clientModel->find($id);

        if (!$client) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit Client - Admin Panel',
            'client' => $client
        ];

        return view('admin/clients/edit', $data);
    }

    public function update($id)
    {
        $client = $this->clientModel->find($id);

        if (!$client) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'name' => 'required|min_length[2]|max_length[255]',
            'location' => 'permit_empty|max_length[255]',
            'sort_order' => 'permit_empty|integer',
            'is_active' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'location' => $this->request->getPost('location'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
            'is_active' => $this->request->getPost('is_active') ? 1 : 0
        ];

        // Handle logo upload
        $logo = $this->request->getFile('logo');
        if ($logo && $logo->isValid() && !$logo->hasMoved()) {
            // Delete old logo if exists
            if ($client['logo']) {
                $oldLogoPath = ROOTPATH . 'public/uploads/clients/' . $client['logo'];
                if (file_exists($oldLogoPath)) {
                    unlink($oldLogoPath);
                }
            }

            $newName = $logo->getRandomName();
            $logo->move(ROOTPATH . 'public/uploads/clients', $newName);
            $data['logo'] = $newName;
        }

        if ($this->clientModel->update($id, $data)) {
            return redirect()->to('/admin/clients')->with('success', 'Client berhasil diperbarui.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui client.');
    }

    public function delete($id)
    {
        $client = $this->clientModel->find($id);

        if (!$client) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Delete logo if exists
        if ($client['logo']) {
            $logoPath = ROOTPATH . 'public/uploads/clients/' . $client['logo'];
            if (file_exists($logoPath)) {
                unlink($logoPath);
            }
        }

        if ($this->clientModel->delete($id)) {
            return redirect()->to('/admin/clients')->with('success', 'Client berhasil dihapus.');
        }

        return redirect()->to('/admin/clients')->with('error', 'Gagal menghapus client.');
    }

    public function updateOrder()
    {
        $order = $this->request->getPost('order');
        
        if (is_array($order)) {
            foreach ($order as $sortOrder => $id) {
                $this->clientModel->update($id, ['sort_order' => $sortOrder]);
            }
            
            return $this->response->setJSON(['success' => true, 'message' => 'Urutan clients berhasil diperbarui.']);
        }
        
        return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui urutan clients.']);
    }

    public function toggleStatus($id)
    {
        $client = $this->clientModel->find($id);

        if (!$client) {
            return $this->response->setJSON(['success' => false, 'message' => 'Client tidak ditemukan.']);
        }

        $newStatus = $client['is_active'] ? 0 : 1;
        $this->clientModel->update($id, ['is_active' => $newStatus]);

        return $this->response->setJSON([
            'success' => true, 
            'message' => 'Status client berhasil diubah.',
            'newStatus' => $newStatus
        ]);
    }
}