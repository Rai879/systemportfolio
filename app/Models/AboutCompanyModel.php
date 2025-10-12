<?php

namespace App\Models;

use CodeIgniter\Model;

class AboutCompanyModel extends Model
{
    protected $table            = 'about_company';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['title', 'subtitle', 'description', 'years_experience', 'image', 'features'];

    // Contoh: Mengambil data dan mengurai JSON 'features'
    public function getCompanyInfo()
    {
        $data = $this->first();
        if ($data && isset($data['features'])) {
            $data['features'] = json_decode($data['features'], true);
        }
        return $data;
    }
}