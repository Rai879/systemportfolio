<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ===== FRONTEND ROUTES =====
// Home Routes
$routes->get('/', 'HomeController::index');
$routes->get('/about', 'HomeController::about');
$routes->get('/services', 'HomeController::services');
$routes->get('/clients', 'HomeController::clients');
$routes->get('/team', 'HomeController::team');

// Blog Routes
$routes->get('/blog', 'BlogController::index');
$routes->get('/blog/(:segment)', 'BlogController::view/$1');
$routes->get('/blog/category/(:segment)', 'BlogController::category/$1');

// Page Routes
$routes->get('/faq', 'PageController::faq');
$routes->get('/contact', 'PageController::contact');
$routes->post('/contact', 'PageController::submitContact');
$routes->get('/products', 'PageController::products');
$routes->get('/products/(:num)', 'PageController::productDetail/$1');
$routes->get('/privacy-policy', 'PageController::privacyPolicy');
$routes->get('/terms-of-service', 'PageController::termsOfService');

// ===== ADMIN ROUTES =====
// Public Admin Routes (bisa diakses tanpa login)
$routes->get('/admin/login', 'Admin\AuthController::login');
$routes->post('/admin/login', 'Admin\AuthController::attemptLogin');

// Protected Admin Routes (harus login)
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    // Dashboard
    $routes->get('dashboard', 'Admin\AdminController::dashboard');
    $routes->get('analytics', 'Admin\AdminController::analytics');

    // Auth Management
    $routes->get('logout', 'Admin\AuthController::logout');
    $routes->get('profile', 'Admin\AuthController::profile');
    $routes->post('profile/update', 'Admin\AuthController::updateProfile');

    // User Management - menggunakan resource routes
    $routes->get('users', 'Admin\UserController::index');
    $routes->get('users/create', 'Admin\UserController::create');
    $routes->post('users', 'Admin\UserController::store');
    $routes->post('users/store', 'Admin\UserController::store');
    $routes->get('users/edit/(:num)', 'Admin\UserController::edit/$1');
    $routes->post('users/update/(:num)', 'Admin\UserController::update/$1');
    $routes->delete('users/delete/(:num)', 'Admin\UserController::delete/$1');

    // Site Settings
    $routes->get('settings', 'Admin\SiteSettingController::index');
    $routes->post('settings/update', 'Admin\SiteSettingController::update');
    $routes->post('settings/update-general', 'Admin\SiteSettingController::updateGeneral');
    $routes->post('settings/update-social', 'Admin\SiteSettingController::updateSocialMedia');
    $routes->post('settings/update-seo', 'Admin\SiteSettingController::updateSeo');

    // About Company Routes
    $routes->get('about-company', 'Admin\AboutCompanyController::index');
    $routes->get('about-company/create', 'Admin\AboutCompanyController::create');
    $routes->post('about-company/store', 'Admin\AboutCompanyController::store');
    $routes->get('about-company/edit/(:num)', 'Admin\AboutCompanyController::edit/$1');
    $routes->post('about-company/update/(:num)', 'Admin\AboutCompanyController::update/$1');
    $routes->get('about-company/delete/(:num)', 'Admin\AboutCompanyController::delete/$1');

    // FAQ Routes
    $routes->get('faq', 'Admin\FaqController::index');
    $routes->get('faq/create', 'Admin\FaqController::create');
    $routes->post('faq/store', 'Admin\FaqController::store');
    $routes->get('faq/edit/(:num)', 'Admin\FaqController::edit/$1');
    $routes->post('faq/update/(:num)', 'Admin\FaqController::update/$1');
    $routes->get('faq/delete/(:num)', 'Admin\FaqController::delete/$1');
    $routes->post('faq/update-order', 'Admin\FaqController::updateOrder');
    $routes->get('faq/toggle-status/(:num)', 'Admin\FaqController::toggleStatus/$1');

    // Blog Post Routes
    $routes->get('blog-posts', 'Admin\BlogPostController::index');
    $routes->get('blog-posts/create', 'Admin\BlogPostController::create');
    $routes->post('blog-posts/store', 'Admin\BlogPostController::store');
    $routes->get('blog-posts/edit/(:num)', 'Admin\BlogPostController::edit/$1');
    $routes->post('blog-posts/update/(:num)', 'Admin\BlogPostController::update/$1');
    $routes->get('blog-posts/delete/(:num)', 'Admin\BlogPostController::delete/$1');
    $routes->get('blog-posts/toggle-publish/(:num)', 'Admin\BlogPostController::togglePublish/$1');
    $routes->post('blog-posts/generate-slug', 'Admin\BlogPostController::generateSlug');

        // Hero Slides Routes
    $routes->get('hero-slides', 'Admin\HeroSlideController::index');
    $routes->get('hero-slides/create', 'Admin\HeroSlideController::create');
    $routes->post('hero-slides/store', 'Admin\HeroSlideController::store');
    $routes->get('hero-slides/edit/(:num)', 'Admin\HeroSlideController::edit/$1');
    $routes->post('hero-slides/update/(:num)', 'Admin\HeroSlideController::update/$1');
    $routes->get('hero-slides/delete/(:num)', 'Admin\HeroSlideController::delete/$1');
    $routes->post('hero-slides/update-order', 'Admin\HeroSlideController::updateOrder');
    $routes->get('hero-slides/toggle-status/(:num)', 'Admin\HeroSlideController::toggleStatus/$1');
    
    // Features Routes
    $routes->get('features', 'Admin\FeatureController::index');
    $routes->get('features/create', 'Admin\FeatureController::create');
    $routes->post('features/store', 'Admin\FeatureController::store');
    $routes->get('features/edit/(:num)', 'Admin\FeatureController::edit/$1');
    $routes->post('features/update/(:num)', 'Admin\FeatureController::update/$1');
    $routes->get('features/delete/(:num)', 'Admin\FeatureController::delete/$1');
    $routes->post('features/update-order', 'Admin\FeatureController::updateOrder');
    $routes->get('features/toggle-status/(:num)', 'Admin\FeatureController::toggleStatus/$1');
    
    // Work Scope Routes
    $routes->get('work-scope', 'Admin\WorkScopeController::index');
    $routes->get('work-scope/create', 'Admin\WorkScopeController::create');
    $routes->post('work-scope/store', 'Admin\WorkScopeController::store');
    $routes->get('work-scope/edit/(:num)', 'Admin\WorkScopeController::edit/$1');
    $routes->post('work-scope/update/(:num)', 'Admin\WorkScopeController::update/$1');
    $routes->get('work-scope/delete/(:num)', 'Admin\WorkScopeController::delete/$1');
    
    // Why Choose Us Routes
    $routes->get('why-choose-us', 'Admin\WhyChooseUsController::index');
    $routes->get('why-choose-us/create', 'Admin\WhyChooseUsController::create');
    $routes->post('why-choose-us/store', 'Admin\WhyChooseUsController::store');
    $routes->get('why-choose-us/edit/(:num)', 'Admin\WhyChooseUsController::edit/$1');
    $routes->post('why-choose-us/update/(:num)', 'Admin\WhyChooseUsController::update/$1');
    $routes->get('why-choose-us/delete/(:num)', 'Admin\WhyChooseUsController::delete/$1');
    $routes->post('why-choose-us/update-order', 'Admin\WhyChooseUsController::updateOrder');
});

// Redirect admin root to dashboard
$routes->get('/admin', function () {
    return redirect()->to('/admin/dashboard');
});

// ===== API ROUTES (jika diperlukan) =====
// $routes->group('api', function($routes) {
//     $routes->get('blog', 'Api\BlogController::index');
// });