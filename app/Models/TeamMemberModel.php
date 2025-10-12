<?php

namespace App\Models;

use CodeIgniter\Model;

class TeamMemberModel extends Model
{
    protected $table            = 'team_members';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['name', 'position', 'photo', 'sort_order', 'is_active'];

    // Fungsi untuk mendapatkan anggota tim yang aktif, diurutkan
    public function getActiveTeam()
    {
        return $this->where('is_active', 1)
                    ->orderBy('sort_order', 'ASC')
                    ->findAll();
    }
}