<?php

namespace App\Controllers;

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

class HomeController extends BaseController
{
    protected $heroSlideModel;
    protected $featureModel;
    protected $aboutCompanyModel;
    protected $workScopeModel;
    protected $whyChooseUsModel;
    protected $statisticModel;
    protected $clientModel;
    protected $productModel;
    protected $teamMemberModel;
    protected $blogPostModel;
    protected $siteSettingModel;

    public function __construct()
    {
        $this->heroSlideModel = new HeroSlideModel();
        $this->featureModel = new FeatureModel();
        $this->aboutCompanyModel = new AboutCompanyModel();
        $this->workScopeModel = new WorkScopeModel();
        $this->whyChooseUsModel = new WhyChooseUsModel();
        $this->statisticModel = new StatisticModel();
        $this->clientModel = new ClientModel();
        $this->productModel = new ProductModel();
        $this->teamMemberModel = new TeamMemberModel();
        $this->blogPostModel = new BlogPostModel();
        $this->siteSettingModel = new SiteSettingModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Home - Sanata Medical Suite',
            'heroSlides' => $this->heroSlideModel->getActiveSlides(),
            'features' => $this->featureModel->getActiveFeatures(),
            'aboutCompany' => $this->aboutCompanyModel->getCompanyInfo(),
            'workScope' => $this->workScopeModel->getWorkScope(),
            'whyChooseUs' => $this->whyChooseUsModel->getAllItems(),
            'statistics' => $this->statisticModel->getAllStats(),
            'clients' => $this->clientModel->getActiveClients(),
            'products' => $this->productModel->getActiveProducts(),
            'teamMembers' => $this->teamMemberModel->getActiveTeam(),
            'latestBlogPosts' => $this->blogPostModel->getLatestPublishedPosts(3),
            'siteSettings' => $this->siteSettingModel->getSettings()
        ];

        return view('home/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'Tentang Kami - Sanata Medical Suite',
            'aboutCompany' => $this->aboutCompanyModel->getCompanyInfo(),
            'teamMembers' => $this->teamMemberModel->getActiveTeam(),
            'statistics' => $this->statisticModel->getAllStats(),
            'siteSettings' => $this->siteSettingModel->getSettings()
        ];

        return view('home/about', $data);
    }

    public function services()
    {
        $data = [
            'title' => 'Layanan - Sanata Medical Suite',
            'features' => $this->featureModel->getActiveFeatures(),
            'workScope' => $this->workScopeModel->getWorkScope(),
            'products' => $this->productModel->getActiveProducts(),
            'whyChooseUs' => $this->whyChooseUsModel->getAllItems(),
            'siteSettings' => $this->siteSettingModel->getSettings()
        ];

        return view('home/services', $data);
    }

    public function clients()
    {
        $data = [
            'title' => 'Klien Kami - Sanata Medical Suite',
            'clients' => $this->clientModel->getActiveClients(),
            'siteSettings' => $this->siteSettingModel->getSettings()
        ];

        return view('home/clients', $data);
    }

    public function team()
    {
        $data = [
            'title' => 'Tim Kami - Sanata Medical Suite',
            'teamMembers' => $this->teamMemberModel->getActiveTeam(),
            'siteSettings' => $this->siteSettingModel->getSettings()
        ];

        return view('home/team', $data);
    }
}