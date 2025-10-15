<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\StatisticModel;

class StatisticController extends BaseController
{
    protected $statisticModel;

    public function __construct()
    {
        $this->statisticModel = new StatisticModel();
    }

    public function index()
    {
        $statistics = $this->statisticModel->orderBy('sort_order', 'ASC')->findAll();

        $data = [
            'title' => 'Statistics Management - Admin Panel',
            'statistics' => $statistics
        ];

        return view('admin/statistics/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Statistic - Admin Panel',
            'iconOptions' => $this->getIconOptions()
        ];

        return view('admin/statistics/create', $data);
    }

    public function store()
    {
        $rules = [
            'label' => 'required|min_length[3]|max_length[255]',
            'value' => 'required|integer',
            'icon' => 'required|max_length[100]',
            'sort_order' => 'permit_empty|integer'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'label' => $this->request->getPost('label'),
            'value' => $this->request->getPost('value'),
            'icon' => $this->request->getPost('icon'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0
        ];

        if ($this->statisticModel->save($data)) {
            return redirect()->to('/admin/statistics')->with('success', 'Statistic berhasil ditambahkan.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan statistic.');
    }

    public function edit($id)
    {
        $statistic = $this->statisticModel->find($id);

        if (!$statistic) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit Statistic - Admin Panel',
            'statistic' => $statistic,
            'iconOptions' => $this->getIconOptions()
        ];

        return view('admin/statistics/edit', $data);
    }

    public function update($id)
    {
        $statistic = $this->statisticModel->find($id);

        if (!$statistic) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'label' => 'required|min_length[3]|max_length[255]',
            'value' => 'required|integer',
            'icon' => 'required|max_length[100]',
            'sort_order' => 'permit_empty|integer'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'label' => $this->request->getPost('label'),
            'value' => $this->request->getPost('value'),
            'icon' => $this->request->getPost('icon'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0
        ];

        if ($this->statisticModel->update($id, $data)) {
            return redirect()->to('/admin/statistics')->with('success', 'Statistic berhasil diperbarui.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui statistic.');
    }

    public function delete($id)
    {
        $statistic = $this->statisticModel->find($id);

        if (!$statistic) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->statisticModel->delete($id)) {
            return redirect()->to('/admin/statistics')->with('success', 'Statistic berhasil dihapus.');
        }

        return redirect()->to('/admin/statistics')->with('error', 'Gagal menghapus statistic.');
    }

    public function updateOrder()
    {
        $order = $this->request->getPost('order');
        
        if (is_array($order)) {
            foreach ($order as $sortOrder => $id) {
                $this->statisticModel->update($id, ['sort_order' => $sortOrder]);
            }
            
            return $this->response->setJSON(['success' => true, 'message' => 'Urutan statistics berhasil diperbarui.']);
        }
        
        return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui urutan statistics.']);
    }

    /**
     * Get available icon options
     */
    private function getIconOptions()
    {
        return [
            'bi-people' => 'People',
            'bi-briefcase' => 'Briefcase',
            'bi-award' => 'Award',
            'bi-check-circle' => 'Check Circle',
            'bi-star' => 'Star',
            'bi-heart' => 'Heart',
            'bi-graph-up' => 'Graph Up',
            'bi-clock' => 'Clock',
            'bi-gear' => 'Gear',
            'bi-laptop' => 'Laptop',
            'bi-shield-check' => 'Shield Check',
            'bi-trophy' => 'Trophy',
            'bi-flag' => 'Flag',
            'bi-building' => 'Building',
            'bi-globe' => 'Globe',
            'bi-calculator' => 'Calculator',
            'bi-cash-coin' => 'Cash Coin',
            'bi-hand-thumbs-up' => 'Thumbs Up'
        ];
    }
}