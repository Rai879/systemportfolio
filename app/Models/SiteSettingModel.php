<?php

namespace App\Models;

use CodeIgniter\Model;

class SiteSettingModel extends Model
{
    protected $table            = 'site_settings';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['setting_key', 'setting_value', 'setting_type'];

    // Fungsi untuk mendapatkan semua pengaturan dalam format key => value
    public function getSettings()
    {
        $settings = $this->findAll();
        $output = [];
        foreach ($settings as $setting) {
            $output[$setting['setting_key']] = $setting['setting_value'];
        }
        return $output;
    }

    // Fungsi untuk mendapatkan nilai pengaturan berdasarkan kunci
    public function getSetting(string $key)
    {
        $setting = $this->where('setting_key', $key)->first();
        return $setting['setting_value'] ?? null;
    }

    // Contoh keys yang dapat Anda gunakan:
    // 'footer_description', 'contact_address', 'contact_email', 'contact_phone',
    // 'social_instagram', 'social_facebook', 'social_linkedin'
}