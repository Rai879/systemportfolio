<?php

namespace App\Models;

use CodeIgniter\Model;

class WhyChooseUsModel extends Model
{
    protected $table            = 'why_choose_us';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['title', 'description', 'icon', 'color', 'sort_order'];

    // Fungsi untuk mendapatkan semua item, diurutkan
    public function getAllItems()
    {
        return $this->orderBy('sort_order', 'ASC')
                    ->findAll();
    }
}