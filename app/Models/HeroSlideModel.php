<?php

namespace App\Models;

use CodeIgniter\Model;

class HeroSlideModel extends Model
{
    protected $table            = 'hero_slides';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['title', 'subtitle', 'description', 'button_text', 'button_link', 'image', 'sort_order', 'is_active'];

    // Fungsi untuk mendapatkan slide yang aktif, diurutkan
    public function getActiveSlides()
    {
        return $this->where('is_active', 1)
                    ->orderBy('sort_order', 'ASC')
                    ->findAll();
    }
}