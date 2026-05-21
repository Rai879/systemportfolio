<?php

namespace App\Controllers;

use App\Models\SiteSettingModel;
use App\Controllers\HomeController;
use App\Controllers\BlogController;
use App\Controllers\PageController;

class SpaController extends BaseController
{
    public function index()
    {
        $siteSettingModel = new SiteSettingModel();
        $data['siteSettings'] = $siteSettingModel->getSettings();

        return view('spa/index', $data);
    }

    public function apiContent($path = null)
    {
        $path = trim($path ?? '', '/');
        try {
            $html = $this->renderLegacyContent($path);
            if ($html === false) {
                throw new \Exception('Content render failed');
            }

            $fragment = $this->extractSpaFragment($html);
            return $this->response->setJSON(['html' => $fragment]);
        } catch (\Throwable $e) {
            log_message('error', 'SPA content error: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON(['html' => '<div class="alert alert-danger">Tidak dapat memuat konten.</div>']);
        }
    }

    protected function renderLegacyContent(string $path)
    {
        $legacy = $path === '' ? '' : $path;
        $controller = null;
        $method = null;
        $params = [];

        switch (true) {
            case $legacy === 'about':
                $controller = new HomeController();
                $method = 'about';
                break;
            case $legacy === 'services':
                $controller = new HomeController();
                $method = 'services';
                break;
            case $legacy === 'clients':
                $controller = new HomeController();
                $method = 'clients';
                break;
            case $legacy === 'team':
                $controller = new HomeController();
                $method = 'team';
                break;
            case $legacy === 'blog':
                $controller = new BlogController();
                $method = 'index';
                break;
            case preg_match('#^blog/category/([^/]+)$#', $legacy, $matches):
                $controller = new BlogController();
                $method = 'category';
                $params = [$matches[1]];
                break;
            case preg_match('#^blog/([^/]+)$#', $legacy, $matches):
                $controller = new BlogController();
                $method = 'view';
                $params = [$matches[1]];
                break;
            case $legacy === 'faq':
                $controller = new PageController();
                $method = 'faq';
                break;
            case $legacy === 'contact':
                $controller = new PageController();
                $method = 'contact';
                break;
            case $legacy === 'products':
                $controller = new PageController();
                $method = 'products';
                break;
            case preg_match('#^products/(\d+)$#', $legacy, $matches):
                $controller = new PageController();
                $method = 'productDetail';
                $params = [$matches[1]];
                break;
            case $legacy === 'privacy-policy':
                $controller = new PageController();
                $method = 'privacyPolicy';
                break;
            case $legacy === 'terms-of-service':
                $controller = new PageController();
                $method = 'termsOfService';
                break;
            case $legacy === '':
                $controller = new HomeController();
                $method = 'index';
                break;
            default:
                throw new \RuntimeException('Unknown legacy path: ' . $legacy);
        }

        if (! $controller || ! method_exists($controller, $method)) {
            throw new \RuntimeException('Invalid legacy handler: ' . $method);
        }

        $controller->initController($this->request, $this->response, $this->logger);

        return call_user_func_array([$controller, $method], $params);
    }

    protected function extractSpaFragment(string $html)
    {
        $start = strpos($html, '<!-- SPA_CONTENT_START -->');
        $end = strpos($html, '<!-- SPA_CONTENT_END -->');

        if ($start !== false && $end !== false && $end > $start) {
            return substr($html, $start + strlen('<!-- SPA_CONTENT_START -->'), $end - ($start + strlen('<!-- SPA_CONTENT_START -->')));
        }

        return $html;
    }
}
