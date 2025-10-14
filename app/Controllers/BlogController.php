<?php

namespace App\Controllers;

use App\Models\BlogPostModel;
use App\Models\SiteSettingModel;

class BlogController extends BaseController
{
    protected $blogPostModel;
    protected $siteSettingModel;

    public function __construct()
    {
        $this->blogPostModel = new BlogPostModel();
        $this->siteSettingModel = new SiteSettingModel();
    }

    public function index()
    {
        // Get page from query string, default to 1
        $page = $this->request->getGet('page') ? (int)$this->request->getGet('page') : 1;
        $perPage = 6; // Posts per page

        // Get published posts with pagination
        $blogPosts = $this->blogPostModel
            ->where('is_published', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage, 'default', $page);

        $data = [
            'title' => 'Blog & Artikel',
            'blogPosts' => $blogPosts,
            'pager' => $this->blogPostModel->pager,
            'siteSettings' => $this->siteSettingModel->getSettings(),
            'latestPosts' => $this->blogPostModel->getLatestPublishedPosts(5)
        ];

        return view('blog/index', $data);
    }

    public function view($slug = null)
    {
        $post = $this->blogPostModel
            ->where('slug', $slug)
            ->where('is_published', 1)
            ->first();

        if (!$post) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Increment views count
        $this->blogPostModel->incrementViews($post['id']);

        $data = [
            'title' => $post['title'] . ' - Sanata Medical Suite',
            'post' => $post,
            'siteSettings' => $this->siteSettingModel->getSettings(),
            'latestPosts' => $this->blogPostModel->getLatestPublishedPosts(5),
            'relatedPosts' => $this->getRelatedPosts($post)
        ];

        return view('blog/view', $data);
    }

    public function category($category = null)
    {
        $page = $this->request->getGet('page') ? (int)$this->request->getGet('page') : 1;
        $perPage = 6;

        $blogPosts = $this->blogPostModel
            ->where('category', $category)
            ->where('is_published', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage, 'default', $page);

        $data = [
            'title' => 'Kategori: ' . ucfirst($category) . ' - Sanata Medical Suite',
            'blogPosts' => $blogPosts,
            'category' => $category,
            'pager' => $this->blogPostModel->pager,
            'siteSettings' => $this->siteSettingModel->getSettings(),
            'latestPosts' => $this->blogPostModel->getLatestPublishedPosts(5)
        ];

        return view('blog/category', $data);
    }

    /**
     * Get related posts based on category
     */
    private function getRelatedPosts($post, $limit = 3)
    {
        return $this->blogPostModel
            ->where('category', $post['category'])
            ->where('is_published', 1)
            ->where('id !=', $post['id'])
            ->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }
}