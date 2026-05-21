<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ===== API ROUTES =====
$routes->group('api', function ($routes) {
    
    // -- Public API --
    // Public API
    $routes->group('public', function ($routes) {
        $routes->get('home', 'Api\PublicApiController::home');
        $routes->get('about', 'Api\PublicApiController::about');
        $routes->get('services', 'Api\PublicApiController::services');
        $routes->get('products', 'Api\PublicApiController::products');
        $routes->get('blog', 'Api\PublicApiController::blog');
        $routes->get('blog/(:any)', 'Api\PublicApiController::blogPost/$1');
        $routes->get('contact', 'Api\PublicApiController::contact');
    });

    // Content API (Legacy Fallback)
    $routes->get('content/(:any)', 'SpaController::apiContent/$1');
    $routes->get('content', 'SpaController::apiContent');
    
    // Form submissions
    $routes->post('contact', 'PageController::submitContact');

    // -- Admin API --
    $routes->post('admin/login', 'Admin\AuthController::apiLogin');
    
    // Protected Admin API
    $routes->group('admin', ['filter' => 'auth'], function ($routes) {
        $routes->get('dashboard', 'Admin\AdminController::apiDashboard');
        $routes->get('logout', 'Admin\AuthController::apiLogout');
    });
});

// ===== LEGACY ADMIN ROUTES =====
// These routes handle the legacy CodeIgniter admin panel with standard HTML views.
$routes->get('admin/login', 'Admin\AuthController::login');
$routes->post('admin/login', 'Admin\AuthController::attemptLogin');
$routes->get('admin/logout', 'Admin\AuthController::logout');

$routes->group('admin', ['filter' => 'auth', 'namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('/', 'AdminController::index');
    $routes->get('dashboard', 'AdminController::index');

    // Users
    $routes->get('users', 'UserController::index');
    $routes->get('users/create', 'UserController::create');
    $routes->post('users/store', 'UserController::store');
    $routes->get('users/edit/(:num)', 'UserController::edit/$1');
    $routes->post('users/update/(:num)', 'UserController::update/$1');
    $routes->get('users/delete/(:num)', 'UserController::delete/$1');

    // Settings
    $routes->get('settings', 'SiteSettingController::index');
    $routes->post('settings/update-general', 'SiteSettingController::updateGeneral');

    // FAQ
    $routes->get('faq', 'FaqController::index');
    $routes->get('faq/create', 'FaqController::create');
    $routes->post('faq/store', 'FaqController::store');
    $routes->get('faq/edit/(:num)', 'FaqController::edit/$1');
    $routes->post('faq/update/(:num)', 'FaqController::update/$1');
    $routes->get('faq/delete/(:num)', 'FaqController::delete/$1');

    // Clients
    $routes->get('clients', 'ClientController::index');
    $routes->get('clients/create', 'ClientController::create');
    $routes->post('clients/store', 'ClientController::store');
    $routes->get('clients/edit/(:num)', 'ClientController::edit/$1');
    $routes->post('clients/update/(:num)', 'ClientController::update/$1');
    $routes->get('clients/delete/(:num)', 'ClientController::delete/$1');
    $routes->post('clients/updateOrder', 'ClientController::updateOrder');
    $routes->post('clients/toggleStatus/(:num)', 'ClientController::toggleStatus/$1');

    // Blog Posts
    $routes->get('blog-posts', 'BlogPostController::index');
    $routes->get('blog-posts/create', 'BlogPostController::create');
    $routes->post('blog-posts/store', 'BlogPostController::store');
    $routes->get('blog-posts/edit/(:num)', 'BlogPostController::edit/$1');
    $routes->post('blog-posts/update/(:num)', 'BlogPostController::update/$1');
    $routes->get('blog-posts/delete/(:num)', 'BlogPostController::delete/$1');

    // Products
    $routes->get('products', 'ProductController::index');
    $routes->get('products/create', 'ProductController::create');
    $routes->post('products/store', 'ProductController::store');
    $routes->get('products/edit/(:num)', 'ProductController::edit/$1');
    $routes->post('products/update/(:num)', 'ProductController::update/$1');
    $routes->get('products/delete/(:num)', 'ProductController::delete/$1');
    $routes->post('products/toggleStatus/(:num)', 'ProductController::toggleStatus/$1');

    // Team Members
    $routes->get('team-members', 'TeamMemberController::index');
    $routes->get('team-members/create', 'TeamMemberController::create');
    $routes->post('team-members/store', 'TeamMemberController::store');
    $routes->get('team-members/edit/(:num)', 'TeamMemberController::edit/$1');
    $routes->post('team-members/update/(:num)', 'TeamMemberController::update/$1');
    $routes->get('team-members/delete/(:num)', 'TeamMemberController::delete/$1');
    $routes->post('team-members/updateOrder', 'TeamMemberController::updateOrder');

    // Features
    $routes->get('features', 'FeatureController::index');
    $routes->get('features/create', 'FeatureController::create');
    $routes->post('features/store', 'FeatureController::store');
    $routes->get('features/edit/(:num)', 'FeatureController::edit/$1');
    $routes->post('features/update/(:num)', 'FeatureController::update/$1');
    $routes->get('features/delete/(:num)', 'FeatureController::delete/$1');
    $routes->post('features/updateOrder', 'FeatureController::updateOrder');

    // Hero Slides
    $routes->get('hero-slides', 'HeroSlideController::index');
    $routes->get('hero-slides/create', 'HeroSlideController::create');
    $routes->post('hero-slides/store', 'HeroSlideController::store');
    $routes->get('hero-slides/edit/(:num)', 'HeroSlideController::edit/$1');
    $routes->post('hero-slides/update/(:num)', 'HeroSlideController::update/$1');
    $routes->get('hero-slides/delete/(:num)', 'HeroSlideController::delete/$1');
    $routes->post('hero-slides/updateOrder', 'HeroSlideController::updateOrder');

    // Work Scope
    $routes->get('work-scope', 'WorkScopeController::index');
    $routes->get('work-scope/create', 'WorkScopeController::create');
    $routes->post('work-scope/store', 'WorkScopeController::store');
    $routes->get('work-scope/edit/(:num)', 'WorkScopeController::edit/$1');
    $routes->post('work-scope/update/(:num)', 'WorkScopeController::update/$1');
    $routes->get('work-scope/delete/(:num)', 'WorkScopeController::delete/$1');
    $routes->post('work-scope/updateOrder', 'WorkScopeController::updateOrder');

    // Why Choose Us
    $routes->get('why-choose-us', 'WhyChooseUsController::index');
    $routes->get('why-choose-us/create', 'WhyChooseUsController::create');
    $routes->post('why-choose-us/store', 'WhyChooseUsController::store');
    $routes->get('why-choose-us/edit/(:num)', 'WhyChooseUsController::edit/$1');
    $routes->post('why-choose-us/update/(:num)', 'WhyChooseUsController::update/$1');
    $routes->get('why-choose-us/delete/(:num)', 'WhyChooseUsController::delete/$1');
    $routes->post('why-choose-us/updateOrder', 'WhyChooseUsController::updateOrder');

    // Statistics
    $routes->get('statistics', 'StatisticController::index');
    $routes->get('statistics/create', 'StatisticController::create');
    $routes->post('statistics/store', 'StatisticController::store');
    $routes->get('statistics/edit/(:num)', 'StatisticController::edit/$1');
    $routes->post('statistics/update/(:num)', 'StatisticController::update/$1');
    $routes->get('statistics/delete/(:num)', 'StatisticController::delete/$1');
    $routes->post('statistics/updateOrder', 'StatisticController::updateOrder');

    // About Company
    $routes->get('about-company', 'AboutCompanyController::index');
    $routes->post('about-company/update', 'AboutCompanyController::update');

    // Dynamic Pages (Privacy Policy, Terms of Service)
    $routes->get('pages', 'PageController::index');
    $routes->get('pages/edit/(:num)', 'PageController::edit/$1');
    $routes->post('pages/update/(:num)', 'PageController::update/$1');
});

// Explicit root route so it returns 200 OK natively
$routes->get('/', 'SpaController::index');

// ===== SPA CATCH-ALL ROUTE =====
// Any route that doesn't match API routes will fall through to here.
// We override 404 to serve the SPA entry point with a 200 OK status, unless it's an API request.
$routes->set404Override(function() {
    $request = \Config\Services::request();
    // Prevent SPA Catch-All from interfering with /admin routes
    if (strpos($request->getPath(), 'admin') === 0 || strpos($request->getPath(), 'api/') === 0 || $request->isAJAX()) {
        return \Config\Services::response()->setStatusCode(404)->setJSON(['success' => false, 'message' => 'Endpoint or route not found.']);
    }
    
    // For SPA routes, we MUST return 200 OK, otherwise the browser receives a 404 status
    $response = \Config\Services::response();
    $response->setStatusCode(200);
    $controller = new \App\Controllers\SpaController();
    $controller->initController($request, $response, \Config\Services::logger());
    return $controller->index();
});