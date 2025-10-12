<?php

namespace App\Models;

use CodeIgniter\Model;

class FeatureModel extends Model
{
    protected $table            = 'features';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['title', 'description', 'icon', 'color', 'sort_order', 'is_active'];

    // Fungsi untuk mendapatkan fitur yang aktif, diurutkan
    public function getActiveFeatures()
    {
        return $this->where('is_active', 1)
                    ->orderBy('sort_order', 'ASC')
                    ->findAll();
    }
}