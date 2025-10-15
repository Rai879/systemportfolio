<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BlogPostModel;
use App\Models\ClientModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use App\Models\SiteSettingModel;

class AdminController extends BaseController
{
    protected $blogPostModel;
    protected $clientModel;
    protected $productModel;
    protected $userModel;
    protected $siteSettingModel;

    public function __construct()
    {
        $this->blogPostModel = new BlogPostModel();
        $this->clientModel = new ClientModel();
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel();
        $this->siteSettingModel = new SiteSettingModel();
    }

    public function dashboard()
    {
        // Get counts for dashboard stats
        $totalBlogPosts = $this->blogPostModel->countAll();
        $totalClients = $this->clientModel->where('is_active', 1)->countAllResults();
        $totalProducts = $this->productModel->where('is_active', 1)->countAllResults();
        $totalUsers = $this->userModel->countAll();

        // Get latest blog posts
        $latestPosts = $this->blogPostModel
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->findAll();

        $data = [
            'title' => 'Dashboard - Admin Panel',
            'totalBlogPosts' => $totalBlogPosts,
            'totalClients' => $totalClients,
            'totalProducts' => $totalProducts,
            'totalUsers' => $totalUsers,
            'latestPosts' => $latestPosts,
            'siteSettings' => $this->siteSettingModel->getSettings()
        ];

        return view('admin/dashboard', $data);
    }

    public function analytics()
    {
        // You can implement analytics here
        // For now, we'll just show a basic page
        
        $data = [
            'title' => 'Analytics - Admin Panel'
        ];

        return view('admin/analytics', $data);
    }
}