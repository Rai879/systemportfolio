<?php

namespace App\Models;

use CodeIgniter\Model;

class FaqModel extends Model
{
    protected $table            = 'faqs';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['question', 'answer', 'sort_order', 'is_active'];

    // Fungsi untuk mendapatkan FAQ yang aktif, diurutkan
    public function getActiveFaqs()
    {
        return $this->where('is_active', 1)
                    ->orderBy('sort_order', 'ASC')
                    ->findAll();
    }
}