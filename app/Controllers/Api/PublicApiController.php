<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

use App\Models\HeroSlideModel;
use App\Models\FeatureModel;
use App\Models\AboutCompanyModel;
use App\Models\WorkScopeModel;
use App\Models\WhyChooseUsModel;
use App\Models\StatisticModel;
use App\Models\ClientModel;
use App\Models\ProductModel;
use App\Models\TeamMemberModel;
use App\Models\BlogPostModel;
use App\Models\SiteSettingModel;

class PublicApiController extends BaseController
{
    use ResponseTrait;

    protected $siteSettings;

    public function __construct()
    {
        $siteSettingModel = new SiteSettingModel();
        $this->siteSettings = $siteSettingModel->getSettings();
    }

    public function home()
    {
        $heroSlideModel = new HeroSlideModel();
        $featureModel = new FeatureModel();
        $aboutCompanyModel = new AboutCompanyModel();
        $statisticModel = new StatisticModel();
        $clientModel = new ClientModel();
        $blogPostModel = new BlogPostModel();

        return $this->respond([
            'siteSettings' => $this->siteSettings,
            'heroSlides' => $heroSlideModel->getActiveSlides(),
            'features' => $featureModel->getActiveFeatures(),
            'aboutCompany' => $aboutCompanyModel->getCompanyInfo(),
            'statistics' => $statisticModel->getAllStats(),
            'clients' => $clientModel->getActiveClients(),
            'latestBlogPosts' => $blogPostModel->getLatestPublishedPosts(3),
        ]);
    }

    public function about()
    {
        $aboutCompanyModel = new AboutCompanyModel();
        $teamMemberModel = new TeamMemberModel();
        $statisticModel = new StatisticModel();

        return $this->respond([
            'siteSettings' => $this->siteSettings,
            'aboutCompany' => $aboutCompanyModel->getCompanyInfo(),
            'teamMembers' => $teamMemberModel->getActiveTeam(),
            'statistics' => $statisticModel->getAllStats()
        ]);
    }

    public function services()
    {
        $featureModel = new FeatureModel();
        $workScopeModel = new WorkScopeModel();
        $productModel = new ProductModel();
        $whyChooseUsModel = new WhyChooseUsModel();

        return $this->respond([
            'siteSettings' => $this->siteSettings,
            'features' => $featureModel->getActiveFeatures(),
            'workScope' => $workScopeModel->getWorkScope(),
            'products' => $productModel->getActiveProducts(),
            'whyChooseUs' => $whyChooseUsModel->getAllItems()
        ]);
    }

    public function products()
    {
        $productModel = new ProductModel();
        return $this->respond([
            'siteSettings' => $this->siteSettings,
            'products' => $productModel->getActiveProducts()
        ]);
    }

    public function blog()
    {
        $blogPostModel = new BlogPostModel();
        
        $page = $this->request->getGet('page') ? (int)$this->request->getGet('page') : 1;
        $perPage = 6;
        $category = $this->request->getGet('category');

        $query = $blogPostModel->where('is_published', 1)->orderBy('created_at', 'DESC');
        
        if ($category) {
            $query = $query->where('category', $category);
        }

        $blogPosts = $query->paginate($perPage, 'default', $page);

        return $this->respond([
            'siteSettings' => $this->siteSettings,
            'blogPosts' => $blogPosts,
            'pager' => $blogPostModel->pager->getDetails(),
            'latestPosts' => $blogPostModel->getLatestPublishedPosts(5)
        ]);
    }

    public function blogPost($slug = null)
    {
        $blogPostModel = new BlogPostModel();
        
        $post = $blogPostModel->where('slug', $slug)->where('is_published', 1)->first();

        if (!$post) {
            return $this->failNotFound('Artikel tidak ditemukan');
        }

        $blogPostModel->incrementViews($post['id']);

        $relatedPosts = $blogPostModel->where('category', $post['category'])
            ->where('is_published', 1)
            ->where('id !=', $post['id'])
            ->orderBy('created_at', 'DESC')
            ->limit(3)
            ->findAll();

        return $this->respond([
            'siteSettings' => $this->siteSettings,
            'post' => $post,
            'latestPosts' => $blogPostModel->getLatestPublishedPosts(5),
            'relatedPosts' => $relatedPosts
        ]);
    }

    public function contact()
    {
        return $this->respond([
            'siteSettings' => $this->siteSettings,
        ]);
    }
}
