<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TeamMemberModel;

class TeamMemberController extends BaseController
{
    protected $teamMemberModel;

    public function __construct()
    {
        $this->teamMemberModel = new TeamMemberModel();
    }

    public function index()
    {
        $teamMembers = $this->teamMemberModel->orderBy('sort_order', 'ASC')->findAll();

        $data = [
            'title' => 'Team Members Management - Admin Panel',
            'teamMembers' => $teamMembers
        ];

        return view('admin/team_members/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Team Member - Admin Panel',
            'positionOptions' => $this->getPositionOptions()
        ];

        return view('admin/team_members/create', $data);
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min_length[2]|max_length[255]',
            'position' => 'required|max_length[255]',
            'sort_order' => 'permit_empty|integer',
            'is_active' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'position' => $this->request->getPost('position'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
            'is_active' => $this->request->getPost('is_active') ? 1 : 0
        ];

        // Handle photo upload
        $photo = $this->request->getFile('photo');
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            $newName = $photo->getRandomName();
            $photo->move(ROOTPATH . 'public/uploads/team', $newName);
            $data['photo'] = $newName;
        }

        if ($this->teamMemberModel->save($data)) {
            return redirect()->to('/admin/team-members')->with('success', 'Team member berhasil ditambahkan.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan team member.');
    }

    public function edit($id)
    {
        $teamMember = $this->teamMemberModel->find($id);

        if (!$teamMember) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit Team Member - Admin Panel',
            'teamMember' => $teamMember,
            'positionOptions' => $this->getPositionOptions()
        ];

        return view('admin/team_members/edit', $data);
    }

    public function update($id)
    {
        $teamMember = $this->teamMemberModel->find($id);

        if (!$teamMember) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'name' => 'required|min_length[2]|max_length[255]',
            'position' => 'required|max_length[255]',
            'sort_order' => 'permit_empty|integer',
            'is_active' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'position' => $this->request->getPost('position'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
            'is_active' => $this->request->getPost('is_active') ? 1 : 0
        ];

        // Handle photo upload
        $photo = $this->request->getFile('photo');
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            // Delete old photo if exists
            if ($teamMember['photo']) {
                $oldPhotoPath = ROOTPATH . 'public/uploads/team/' . $teamMember['photo'];
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            $newName = $photo->getRandomName();
            $photo->move(ROOTPATH . 'public/uploads/team', $newName);
            $data['photo'] = $newName;
        }

        if ($this->teamMemberModel->update($id, $data)) {
            return redirect()->to('/admin/team-members')->with('success', 'Team member berhasil diperbarui.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui team member.');
    }

    public function delete($id)
    {
        $teamMember = $this->teamMemberModel->find($id);

        if (!$teamMember) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Delete photo if exists
        if ($teamMember['photo']) {
            $photoPath = ROOTPATH . 'public/uploads/team/' . $teamMember['photo'];
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }

        if ($this->teamMemberModel->delete($id)) {
            return redirect()->to('/admin/team-members')->with('success', 'Team member berhasil dihapus.');
        }

        return redirect()->to('/admin/team-members')->with('error', 'Gagal menghapus team member.');
    }

    public function updateOrder()
    {
        $order = $this->request->getPost('order');
        
        if (is_array($order)) {
            foreach ($order as $sortOrder => $id) {
                $this->teamMemberModel->update($id, ['sort_order' => $sortOrder]);
            }
            
            return $this->response->setJSON(['success' => true, 'message' => 'Urutan team members berhasil diperbarui.']);
        }
        
        return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui urutan team members.']);
    }

    public function toggleStatus($id)
    {
        $teamMember = $this->teamMemberModel->find($id);

        if (!$teamMember) {
            return $this->response->setJSON(['success' => false, 'message' => 'Team member tidak ditemukan.']);
        }

        $newStatus = $teamMember['is_active'] ? 0 : 1;
        $this->teamMemberModel->update($id, ['is_active' => $newStatus]);

        return $this->response->setJSON([
            'success' => true, 
            'message' => 'Status team member berhasil diubah.',
            'newStatus' => $newStatus
        ]);
    }

    /**
     * Get available position options
     */
    private function getPositionOptions()
    {
        return [
            'ceo' => 'CEO / Founder',
            'cto' => 'CTO / Technical Lead',
            'project-manager' => 'Project Manager',
            'senior-developer' => 'Senior Developer',
            'developer' => 'Developer',
            'ui-ux-designer' => 'UI/UX Designer',
            'system-analyst' => 'System Analyst',
            'quality-assurance' => 'Quality Assurance',
            'support-specialist' => 'Support Specialist',
            'sales-manager' => 'Sales Manager',
            'marketing-specialist' => 'Marketing Specialist',
            'consultant' => 'Consultant'
        ];
    }
}