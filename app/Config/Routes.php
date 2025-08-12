<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Public (no login required)
$routes->get('/', 'Auth::index');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/register', 'Auth::save');
$routes->post('/dashboard', 'Auth::check');
$routes->get('logout', 'Auth::logout');

// ✅ Protected (login required)
$routes->group('', ['filter' => 'login'], function($routes) {
    // Dashboard
    $routes->get('dashboard', 'Dashboard::index');

    // Blog routes
    $routes->get('blog/create', 'Blog::create');
    $routes->post('blog/store', 'Blog::store');

    $routes->get('blog/view', 'Blog::viewBlog');
    $routes->post('blog/view', 'Blog::store');

    $routes->get('blog/author/(:any)', 'Blog::postsByAuthor/$1');


    $routes->get('blog/show/(:num)', 'Blog::show/$1');
    $routes->get('blog/edit/(:num)', 'Blog::edit/$1');
    $routes->post('blog/update/(:num)', 'Blog::update/$1');

    $routes->match(['post','delete'],'blog/delete/(:num)', 'Blog::delete/$1');

    // $routes->delete('blog/delete/(:num)', 'Blog::deletePost/$1');

    // $routes->post('blog/delete/(:num)', 'Blog::delete/$1');



    $routes->get('blog/my-posts', 'Blog::myPosts');
});
$routes->get('blog/get/(:num)', 'Blog::get/$1');
// $routes->post('blog/update/(:num)', 'Blog::update/$1');

$routes->post('blog/create-ajax', 'Blog::createAjax');
$routes->post('blog/update-ajax/(:num)', 'Blog::updateAjax/$1');






