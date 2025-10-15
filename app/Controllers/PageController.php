<?php

namespace App\Controllers;

use App\Models\FaqModel;
use App\Models\SiteSettingModel;
use App\Models\ProductModel;
use App\Models\TeamMemberModel;

class PageController extends BaseController
{
    protected $faqModel;
    protected $siteSettingModel;
    protected $productModel;
    protected $teamMemberModel;

    public function __construct()
    {
        $this->faqModel = new FaqModel();
        $this->siteSettingModel = new SiteSettingModel();
        $this->productModel = new ProductModel();
        $this->teamMemberModel = new TeamMemberModel();
    }

    public function faq()
    {
        $data = [
            'title' => 'FAQ - Pertanyaan yang Sering Diajukan',
            'faqs' => $this->faqModel->getActiveFaqs(),
            'siteSettings' => $this->siteSettingModel->getSettings()
        ];

        return view('pages/faq', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Kontak Kami - Sanata Medical Suite',
            'siteSettings' => $this->siteSettingModel->getSettings()
        ];

        return view('pages/contact', $data);
    }

    public function products()
    {
        $data = [
            'title' => 'Produk & Layanan - Sanata Medical Suite',
            'products' => $this->productModel->getActiveProducts(),
            'siteSettings' => $this->siteSettingModel->getSettings()
        ];

        return view('pages/products', $data);
    }

    public function productDetail($id = null)
    {
        $product = $this->productModel
            ->where('id', $id)
            ->where('is_active', 1)
            ->first();

        if (!$product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => $product['name'] . ' - Sanata Medical Suite',
            'product' => $product,
            'siteSettings' => $this->siteSettingModel->getSettings(),
            'otherProducts' => $this->productModel
                ->where('id !=', $id)
                ->where('is_active', 1)
                ->limit(3)
                ->findAll()
        ];

        return view('pages/product_detail', $data);
    }

    public function team()
    {
        $data = [
            'title' => 'Tim Kami - Sanata Medical Suite',
            'teamMembers' => $this->teamMemberModel->getActiveTeam(),
            'siteSettings' => $this->siteSettingModel->getSettings()
        ];

        return view('pages/team', $data);
    }

    public function privacyPolicy()
    {
        $data = [
            'title' => 'Kebijakan Privasi - Sanata Medical Suite',
            'siteSettings' => $this->siteSettingModel->getSettings()
        ];

        return view('pages/privacy_policy', $data);
    }

    public function termsOfService()
    {
        $data = [
            'title' => 'Syarat & Ketentuan - Sanata Medical Suite',
            'siteSettings' => $this->siteSettingModel->getSettings()
        ];

        return view('pages/terms_of_service', $data);
    }

    public function client()
    {
        $data = [
            'title' => 'Client - Sanata Medical Suite',
            'siteSettings' => $this->siteSettingModel->getSettings()
        ];

        return view('pages/client', $data);
    }

    /**
     * Handle contact form submission
     */
    public function submitContact()
    {
        // Validation rules
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email',
            'subject' => 'required|min_length[5]|max_length[200]',
            'message' => 'required|min_length[10]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Process the contact form (send email, save to database, etc.)
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'subject' => $this->request->getPost('subject'),
            'message' => $this->request->getPost('message'),
            'ip_address' => $this->request->getIPAddress(),
            'created_at' => date('Y-m-d H:i:s')
        ];

        // TODO: Implement email sending or database storage
        // For now, we'll just show success message

        return redirect()->to('/contact')->with('success', 'Pesan Anda telah berhasil dikirim. Kami akan menghubungi Anda segera.');
    }
}