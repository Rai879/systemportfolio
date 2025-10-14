<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table             = 'users';
    protected $primaryKey        = 'id';
    protected $useAutoIncrement  = true;
    protected $returnType        = 'array';
    protected $useSoftDeletes    = false;
    protected $protectFields     = true;
    protected $allowedFields     = ['username', 'password', 'email'];

    // Dates
    protected $useTimestamps = true; // Tetap aktifkan, untuk 'created_at' saat INSERT
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    // PENTING: Set updatedField ke string kosong agar TIDAK ADA upaya untuk update 'updated_at'
    protected $updatedField  = ''; 
    protected $deletedField  = null;

    // Validation
    protected $validationRules       = [
        'username' => 'required|alpha_numeric_space|min_length[3]', // Hapus is_unique
        'email'    => 'permit_empty|valid_email',
        'password' => 'required|min_length[8]',
    ];
    protected $validationMessages    = [];
    protected $skipValidation        = false;
    protected $cleanValidationRules  = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword'];
    protected $beforeUpdate   = ['hashPassword'];

    /**
     * Hashes the password before insertion or update.
     */
    protected function hashPassword(array $data)
    {
        // Hanya hash jika password ada dalam data yang akan disimpan/diupdate
        if (! isset($data['data']['password'])) {
            return $data;
        }

        // Apply password hashing
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }
}