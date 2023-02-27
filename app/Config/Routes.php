<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Home::index');
$routes->get('dang-nhap', 'Login::login');
$routes->get('dang-ky', 'Login::register');
$routes->get('dang-xuat', 'Admin\Login::logout');



$routes->post('dang-nhap', 'Login::authLogin');
$routes->post('dang-ky', 'Login::authRegister');

$routes->get('shop', 'Shop::index');

$routes->get('detail', 'Customer::index');
$routes->group('ca-nhan', ["filter" => "auth-customer"], function ($routes) {
    $routes->get('chi-tiet', 'Customer::index');  
    $routes->post('chi-tiet', 'Customer::authUpdateInfo');
});


$routes->get('cart', 'Cart::index');
$routes->get('checkout', 'Checkout::index');
$routes->get('contact', 'Contact::index');


$routes->get('admin-login', 'Admin\Login::index');
$routes->post('admin-login', 'Admin\Login::authentication');
$routes->get('logout', 'Admin\Login::logout');

$routes->group('dashboard', ["filter" => "auth-admin"], function ($routes) {
    $routes->get('', 'Admin\Home::index');

    $routes->group('admin', function ($routes) {
        $routes->get('/', 'Admin\Admin::index');
        $routes->get('detail', 'Admin\Admin::detail');
        $routes->get('detail/:any', 'Admin\Admin::detail');

        $routes->post('save', 'Admin\Admin::save');
        $routes->post('delete', 'Admin\Admin::delete');
    });

    $routes->group('banner', function ($routes) {
        $routes->get('/', 'Admin\Banner::index');
        $routes->get('detail', 'Admin\Banner::detail');
        $routes->get('detail/:any', 'Admin\Banner::detail');

        $routes->post('save', 'Admin\Banner::save');
        $routes->post('delete', 'Admin\Banner::delete');
        $routes->post('action-status', 'Admin\Banner::changeStatus');
    });

    $routes->group('category', function ($routes) {
        $routes->get('/', 'Admin\Category::index');
        $routes->get('detail', 'Admin\Category::detail');
        $routes->get('detail/:any', 'Admin\Category::detail');

        $routes->post('save', 'Admin\Category::save');
        $routes->post('delete', 'Admin\Category::delete');
        $routes->post('action-status', 'Admin\Category::changeStatus');
    });

    $routes->group('product', function ($routes) {

        $routes->group('manage', function ($routes) {
            $routes->get('/', 'Admin\Product::index');
            $routes->get('detail', 'Admin\Product::detail');
            $routes->get('detail/:any', 'Admin\Product::detail');

            $routes->post('save', 'Admin\Product::save');
            $routes->post('delete', 'Admin\Product::delete');
            $routes->post('action-status', 'Admin\Product::changeStatus');
        });

        $routes->group('attribute', function ($routes) {
            $routes->get('/', 'Admin\Attribute::index');
            $routes->get('detail', 'Admin\Attribute::detail');
            $routes->get('detail/:any', 'Admin\Attribute::detail');

            $routes->post('save', 'Admin\Attribute::save');
            $routes->post('delete', 'Admin\Attribute::delete');
            $routes->post('action-status', 'Admin\Attribute::changeStatus');
        });
    });
});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
