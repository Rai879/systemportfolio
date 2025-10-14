<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SiteSettingModel;
use CodeIgniter\Database\Exceptions\DataException;
use CodeIgniter\HTTP\RedirectResponse; 

class SiteSettingController extends BaseController
{
    protected $siteSettingModel;

    public function __construct()
    {
        $this->siteSettingModel = new SiteSettingModel();
        helper(['form', 'url']); 
    }

    // -----------------------------------------------------------------------------
    // HELPER METHOD (Memperbaiki nama kolom dari 'value' menjadi 'setting_value')
    // -----------------------------------------------------------------------------

    /**
     * Memperbarui atau membuat setting baru di database.
     * @param string $key Kunci setting (setting_key).
     * @param mixed $value Nilai setting.
     * @return bool True jika operasi sukses atau tidak ada perubahan, False jika gagal.
     */
    protected function updateOrCreateSetting($key, $value): bool
    {
        $value = is_string($value) ? trim($value) : $value;
        $setting = $this->siteSettingModel->where('setting_key', $key)->first();

        try {
            if ($setting) {
                // Perhatikan: Kolom di tabel Anda adalah 'setting_value'
                if ((string)$setting['setting_value'] !== (string)$value) {
                    // MENGGUNAKAN 'setting_value'
                    $dataToUpdate = ['setting_value' => $value]; 
                    
                    // Memanggil update
                    $result = $this->siteSettingModel->update($setting['id'], $dataToUpdate);
                    return $result !== false; // Mengembalikan true jika berhasil diupdate
                }
                return true; // Nilai sama, dianggap sukses.
            } else {
                // INSERT new setting
                $data = [
                    'setting_key'   => $key,
                    // MENGGUNAKAN 'setting_value'
                    'setting_value' => $value 
                ];
                $newId = $this->siteSettingModel->insert($data, false);
                return (bool)$newId;
            }
        } catch (DataException $e) {
            log_message('error', "DataException saat update setting '{$key}': " . $e->getMessage());
            return false;
        } catch (\Exception $e) {
            log_message('error', "Exception saat update/create setting '{$key}': " . $e->getMessage());
            return false;
        }
    }

    // -----------------------------------------------------------------------------
    // PUBLIC METHODS
    // -----------------------------------------------------------------------------
    
    public function index(): string
    {
        $settings = $this->siteSettingModel->getSettings() ?? [];

        $data = [
            'title'    => 'Pengaturan Situs - Admin Panel',
            'settings' => $settings
        ];

        return view('admin/settings/index', $data);
    }
    
    // Metode update massal (tidak relevan untuk form yang Anda berikan, tapi biarkan tetap ada)
    public function update(): RedirectResponse
    {
        $settingsData = $this->request->getPost('settings');

        if (empty($settingsData) || !is_array($settingsData)) {
            return redirect()->back()->with('error', 'Tidak ada data pengaturan yang dikirim.');
        }

        $successCount = 0;
        foreach ($settingsData as $key => $value) {
            if ($this->updateOrCreateSetting($key, $value)) {
                $successCount++;
            }
        }
        
        $message = "Pengaturan berhasil diperbarui. Total: $successCount item.";
        return redirect()->to('/admin/settings')->with('success', $message);
    }

    /**
     * Menangani pembaruan Pengaturan Umum.
     * * @return RedirectResponse
     */
    public function updateGeneral(): RedirectResponse
    {
        $rules = [
            'site_name'         => 'required|max_length[255]',
            'site_description'  => 'permit_empty|max_length[500]',
            'contact_email'     => 'permit_empty|valid_email|max_length[255]',
            'contact_phone'     => 'permit_empty|max_length[50]',
            'contact_address'   => 'permit_empty|max_length[500]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fields = ['site_name', 'site_description', 'contact_email', 'contact_phone', 'contact_address'];
        $successCount = 0;
        
        // Catatan: Jika updateOrCreateSetting gagal, successCount tidak bertambah.
        foreach ($fields as $field) {
            $value = $this->request->getPost($field);
            if ($this->updateOrCreateSetting($field, $value)) {
                $successCount++;
            }
        }

        // Output pesan sukses dengan jumlah item yang benar
        return redirect()->to('/admin/settings')->with('success', "Pengaturan umum berhasil diperbarui. ($successCount item)");
    }

    /**
     * Menangani pembaruan Pengaturan Media Sosial.
     * * @return RedirectResponse
     */
    public function updateSocialMedia(): RedirectResponse
    {
        $fields = [
            'social_facebook', 'social_instagram', 'social_twitter', 
            'social_linkedin', 'social_youtube'
        ];
        
        $successCount = 0;

        foreach ($fields as $field) {
            $value = $this->request->getPost($field) ?? '';
            
            if ($this->updateOrCreateSetting($field, $value)) {
                $successCount++;
            }
        }

        return redirect()->to('/admin/settings')->with('success', "Pengaturan media sosial berhasil diperbarui. ($successCount item)");
    }
    
}