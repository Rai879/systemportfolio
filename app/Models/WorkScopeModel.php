<?php

namespace App\Models;

use CodeIgniter\Model;

class WorkScopeModel extends Model
{
    protected $table            = 'work_scope';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['title', 'subtitle', 'description', 'image', 'features'];

    // Contoh: Mengambil data dan mengurai JSON 'features'
    public function getWorkScope()
    {
        $data = $this->first();
        if ($data && isset($data['features'])) {
            $data['features'] = json_decode($data['features'], true);
        }
        return $data;
    }
}