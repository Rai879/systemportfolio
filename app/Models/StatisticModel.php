<?php

namespace App\Models;

use CodeIgniter\Model;

class StatisticModel extends Model
{
    protected $table            = 'statistics';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['label', 'value', 'icon', 'sort_order'];

    // Fungsi untuk mendapatkan semua statistik, diurutkan
    public function getAllStats()
    {
        return $this->orderBy('sort_order', 'ASC')
                    ->findAll();
    }
}