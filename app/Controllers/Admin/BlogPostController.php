<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BlogPostModel;

class BlogPostController extends BaseController
{
    protected $blogPostModel;

    public function __construct()
    {
        $this->blogPostModel = new BlogPostModel();
    }

    public function index()
    {
        $blogPosts = $this->blogPostModel->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'title' => 'Blog Post Management - Admin Panel',
            'blogPosts' => $blogPosts
        ];

        return view('admin/blog_posts/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Blog Post - Admin Panel',
            'categories' => $this->getCategories()
        ];

        return view('admin/blog_posts/create', $data);
    }

    public function store()
    {
        $rules = [
            'title' => 'required|min_length[5]|max_length[255]',
            'slug' => 'required|alpha_dash|is_unique[blog_posts.slug]',
            'excerpt' => 'required|min_length[10]|max_length[500]',
            'content' => 'required|min_length[50]',
            'category' => 'required',
            'author' => 'required',
            'is_published' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'slug' => $this->request->getPost('slug'),
            'excerpt' => $this->request->getPost('excerpt'),
            'content' => $this->request->getPost('content'),
            'category' => $this->request->getPost('category'),
            'author' => $this->request->getPost('author'),
            'is_published' => $this->request->getPost('is_published') ? 1 : 0
        ];

        // Handle featured image upload
        $featuredImage = $this->request->getFile('featured_image');
        if ($featuredImage && $featuredImage->isValid() && !$featuredImage->hasMoved()) {
            $newName = $featuredImage->getRandomName();
            $featuredImage->move(ROOTPATH . 'public/uploads/blog', $newName);
            $data['featured_image'] = $newName;
        }

        if ($this->blogPostModel->save($data)) {
            return redirect()->to('/admin/blog-posts')->with('success', 'Blog post berhasil ditambahkan.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan blog post.');
    }

    public function edit($id)
    {
        $blogPost = $this->blogPostModel->find($id);

        if (!$blogPost) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit Blog Post - Admin Panel',
            'blogPost' => $blogPost,
            'categories' => $this->getCategories()
        ];

        return view('admin/blog_posts/edit', $data);
    }

    public function update($id)
    {
        $blogPost = $this->blogPostModel->find($id);

        if (!$blogPost) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $slugRules = 'required|alpha_dash';
        if ($blogPost['slug'] !== $this->request->getPost('slug')) {
            $slugRules .= '|is_unique[blog_posts.slug]';
        }

        $rules = [
            'title' => 'required|min_length[5]|max_length[255]',
            'slug' => $slugRules,
            'excerpt' => 'required|min_length[10]|max_length[500]',
            'content' => 'required|min_length[50]',
            'category' => 'required',
            'author' => 'required',
            'is_published' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'slug' => $this->request->getPost('slug'),
            'excerpt' => $this->request->getPost('excerpt'),
            'content' => $this->request->getPost('content'),
            'category' => $this->request->getPost('category'),
            'author' => $this->request->getPost('author'),
            'is_published' => $this->request->getPost('is_published') ? 1 : 0
        ];

        // Handle featured image upload
        $featuredImage = $this->request->getFile('featured_image');
        if ($featuredImage && $featuredImage->isValid() && !$featuredImage->hasMoved()) {
            // Delete old image if exists
            if ($blogPost['featured_image']) {
                $oldImagePath = ROOTPATH . 'public/uploads/blog/' . $blogPost['featured_image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $newName = $featuredImage->getRandomName();
            $featuredImage->move(ROOTPATH . 'public/uploads/blog', $newName);
            $data['featured_image'] = $newName;
        }

        if ($this->blogPostModel->update($id, $data)) {
            return redirect()->to('/admin/blog-posts')->with('success', 'Blog post berhasil diperbarui.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui blog post.');
    }

    public function delete($id)
    {
        $blogPost = $this->blogPostModel->find($id);

        if (!$blogPost) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Delete featured image if exists
        if ($blogPost['featured_image']) {
            $imagePath = ROOTPATH . 'public/uploads/blog/' . $blogPost['featured_image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        if ($this->blogPostModel->delete($id)) {
            return redirect()->to('/admin/blog-posts')->with('success', 'Blog post berhasil dihapus.');
        }

        return redirect()->to('/admin/blog-posts')->with('error', 'Gagal menghapus blog post.');
    }

    public function togglePublish($id)
    {
        $blogPost = $this->blogPostModel->find($id);

        if (!$blogPost) {
            return redirect()->to('/admin/blog-posts')->with('error', 'Blog post tidak ditemukan.');
        }

        $newStatus = $blogPost['is_published'] ? 0 : 1;
        $this->blogPostModel->update($id, ['is_published' => $newStatus]);

        return redirect()->to('/admin/blog-posts')->with('success', 'Status publikasi berhasil diubah.');
    }

    /**
     * Generate slug from title
     */
    public function generateSlug()
    {
        $title = $this->request->getPost('title');
        if (!$title) {
            return $this->response->setJSON(['success' => false, 'slug' => '']);
        }

        $slug = url_title($title, '-', true);
        
        // Check if slug exists
        $existing = $this->blogPostModel->where('slug', $slug)->first();
        if ($existing) {
            $slug .= '-' . time();
        }

        return $this->response->setJSON(['success' => true, 'slug' => $slug]);
    }

    /**
     * Get available categories
     */
    private function getCategories()
    {
        // You can get this from database or define statically
        return [
            'teknologi' => 'Teknologi',
            'kesehatan' => 'Kesehatan',
            'rumah-sakit' => 'Rumah Sakit',
            'software' => 'Software',
            'medis' => 'Medis',
            'update' => 'Update',
            'tips' => 'Tips & Trik'
        ];
    }
}