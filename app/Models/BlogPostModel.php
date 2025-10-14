<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogPostModel extends Model
{
    protected $table            = 'blog_posts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'slug', 'excerpt', 'content', 'featured_image', 'category', 'author', 'views', 'is_published'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Fungsi untuk mendapatkan post terbaru yang dipublikasikan (contoh 3 post teratas)
    public function getLatestPublishedPosts(int $limit = 3)
    {
        return $this->where('is_published', 1)
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

    // Fungsi untuk menambah jumlah views pada post
    public function incrementViews($id)
    {
        return $this->set('views', 'views + 1', false)
                    ->where('id', $id)
                    ->update();
    }
}