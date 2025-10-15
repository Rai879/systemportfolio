<?php
use App\Models\SiteSettingModel;

/**
 * Mengambil Site Settings untuk digunakan di view.
 */
function get_site_settings($key = null)
{
    // Menggunakan static variable untuk menghindari query berulang
    static $settings = null;

    if ($settings === null) {
        $model = new SiteSettingModel();
        $settings = $model->getSettings(); // Asumsi method ini mengembalikan array
    }

    if ($key !== null) {
        return $settings[$key] ?? null;
    }

    return $settings;
}