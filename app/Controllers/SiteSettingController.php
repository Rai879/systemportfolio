<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SiteSettingModel;

class SiteSettingController extends BaseController
{
    protected $siteSettingModel;

    public function __construct()
    {
        $this->siteSettingModel = new SiteSettingModel();
    }

    public function index()
    {
        $settings = $this->siteSettingModel->getSettings();

        $data = [
            'title' => 'Pengaturan Situs - Admin Panel',
            'settings' => $settings
        ];

        return view('admin/settings/index', $data);
    }

    public function update()
    {
        $settingsData = $this->request->getPost('settings');

        if ($settingsData && is_array($settingsData)) {
            foreach ($settingsData as $key => $value) {
                $this->updateOrCreateSetting($key, $value);
            }

            return redirect()->to('/admin/settings')->with('success', 'Pengaturan berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Tidak ada data yang dikirim.');
    }

    public function updateGeneral()
    {
        $rules = [
            'site_name' => 'required',
            'site_description' => 'permit_empty',
            'contact_email' => 'permit_empty|valid_email',
            'contact_phone' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fields = ['site_name', 'site_description', 'contact_email', 'contact_phone', 'contact_address'];
        
        foreach ($fields as $field) {
            $value = $this->request->getPost($field);
            $this->updateOrCreateSetting($field, $value);
        }

        return redirect()->to('/admin/settings')->with('success', 'Pengaturan umum berhasil diperbarui.');
    }

    public function updateSocialMedia()
    {
        $fields = [
            'social_facebook', 'social_instagram', 'social_twitter', 
            'social_linkedin', 'social_youtube'
        ];
        
        foreach ($fields as $field) {
            $value = $this->request->getPost($field);
            $this->updateOrCreateSetting($field, $value);
        }

        return redirect()->to('/admin/settings')->with('success', 'Pengaturan media sosial berhasil diperbarui.');
    }

    public function updateSeo()
    {
        $fields = ['meta_title', 'meta_description', 'meta_keywords'];
        
        foreach ($fields as $field) {
            $value = $this->request->getPost($field);
            $this->updateOrCreateSetting($field, $value);
        }

        return redirect()->to('/admin/settings')->with('success', 'Pengaturan SEO berhasil diperbarui.');
    }

    /**
     * Helper method to update or create setting
     */
    private function updateOrCreateSetting($key, $value)
    {
        $existing = $this->siteSettingModel->where('setting_key', $key)->first();
        
        if ($existing) {
            return $this->siteSettingModel->update($existing['id'], ['setting_value' => $value]);
        } else {
            return $this->siteSettingModel->insert([
                'setting_key' => $key,
                'setting_value' => $value,
                'setting_type' => 'string'
            ]);
        }
    }
}