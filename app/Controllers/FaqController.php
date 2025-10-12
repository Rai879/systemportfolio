<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FaqModel;

class FaqController extends BaseController
{
    protected $faqModel;

    public function __construct()
    {
        $this->faqModel = new FaqModel();
    }

    public function index()
    {
        $faqs = $this->faqModel->orderBy('sort_order', 'ASC')->findAll();

        $data = [
            'title' => 'FAQ Management - Admin Panel',
            'faqs' => $faqs
        ];

        return view('admin/faq/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah FAQ - Admin Panel'
        ];

        return view('admin/faq/create', $data);
    }

    public function store()
    {
        $rules = [
            'question' => 'required|min_length[5]|max_length[500]',
            'answer' => 'required|min_length[10]',
            'sort_order' => 'permit_empty|integer',
            'is_active' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'question' => $this->request->getPost('question'),
            'answer' => $this->request->getPost('answer'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
            'is_active' => $this->request->getPost('is_active') ? 1 : 0
        ];

        if ($this->faqModel->save($data)) {
            return redirect()->to('/admin/faq')->with('success', 'FAQ berhasil ditambahkan.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan FAQ.');
    }

    public function edit($id)
    {
        $faq = $this->faqModel->find($id);

        if (!$faq) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit FAQ - Admin Panel',
            'faq' => $faq
        ];

        return view('admin/faq/edit', $data);
    }

    public function update($id)
    {
        $faq = $this->faqModel->find($id);

        if (!$faq) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'question' => 'required|min_length[5]|max_length[500]',
            'answer' => 'required|min_length[10]',
            'sort_order' => 'permit_empty|integer',
            'is_active' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'question' => $this->request->getPost('question'),
            'answer' => $this->request->getPost('answer'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
            'is_active' => $this->request->getPost('is_active') ? 1 : 0
        ];

        if ($this->faqModel->update($id, $data)) {
            return redirect()->to('/admin/faq')->with('success', 'FAQ berhasil diperbarui.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui FAQ.');
    }

    public function delete($id)
    {
        $faq = $this->faqModel->find($id);

        if (!$faq) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->faqModel->delete($id)) {
            return redirect()->to('/admin/faq')->with('success', 'FAQ berhasil dihapus.');
        }

        return redirect()->to('/admin/faq')->with('error', 'Gagal menghapus FAQ.');
    }

    public function updateOrder()
    {
        $order = $this->request->getPost('order');
        
        if (is_array($order)) {
            foreach ($order as $sortOrder => $id) {
                $this->faqModel->update($id, ['sort_order' => $sortOrder]);
            }
            
            return $this->response->setJSON(['success' => true, 'message' => 'Urutan FAQ berhasil diperbarui.']);
        }
        
        return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui urutan FAQ.']);
    }

    public function toggleStatus($id)
    {
        $faq = $this->faqModel->find($id);

        if (!$faq) {
            return $this->response->setJSON(['success' => false, 'message' => 'FAQ tidak ditemukan.']);
        }

        $newStatus = $faq['is_active'] ? 0 : 1;
        $this->faqModel->update($id, ['is_active' => $newStatus]);

        return $this->response->setJSON([
            'success' => true, 
            'message' => 'Status FAQ berhasil diubah.',
            'newStatus' => $newStatus
        ]);
    }
}