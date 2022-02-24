<?php

use App\Controllers\BrandController;
use App\Controllers\ViewController;

#Route Configurations
$router->setNamespace('\App\Controllers');

#Login Routes
$router->get('/get-in', 'ViewController@loginView'); //Login View
$router->post('/get-in', 'UserController@loginAction'); //Login Verify


#Main App Routes
$router->mount('/app', function() use ($router) {
    
    #Logout
    $router->get('/logout', 'UserController@logout');
    
    #Dashboard Routes
    $router->get('/dashboard', 'ViewController@dashboardView'); //Dashboard View

    #Brands Route
    $router->mount('/brands', function () use ($router) {
        $router->get('/', 'ViewController@listBrandView'); //Brand List View
        $router->post('/', 'BrandController@addBrand'); //Add Brand
        $router->get('/getBrands', 'BrandController@getBrands'); //Get All Brands
    });
    $router->mount('/brand', function() use ($router) {
        $router->delete('/(\d+)', 'BrandController@deleteBrand'); //Delete Brand
    });

    #Tax Rate Route
    $router->mount('/tax-rates',
        function () use ($router) {
            $router->get('/', 'ViewController@listTaxRateView'); //Tax Rate View
            $router->get('/getTaxRates', 'TaxRateController@getTaxRates'); //Tax Rate View
            $router->post('/', 'TaxRateController@addTaxRate'); //Add Tax rate
        }
    );
    $router->mount('/tax-rate', function () use ($router) {
        $router->delete('/(\d+)', 'TaxRateController@deleteTaxRate'); //Delete Tax Rate
    });

    #Products Route
    $router->mount('/products', function () use ($router) {
        $router->get('/', 'ViewController@listProductsView');
        $router->get('/getProducts', 'ProductController@getProducts');
        $router->get('/add', 'ViewController@addProductView');
        $router->post('/add', 'ProductController@addProduct');
    });
    $router->mount('/product', function () use ($router) {
        $router->delete('/(\d+)', 'ProductController@deleteProduct'); //Delete Product
    });
});


#404 Page Routes
$router->set404(function () {
    echo dirname(dirname(__FILE__));
});


#Middlewares
$router->before('GET|POST', '/get-in', function () {
    if (isset($_SESSION['isLoggedIn']) and $_SESSION['isLoggedIn'] === true) {
        header('Location: app/dashboard');
        exit();
    }
});
$router->before('GET|POST|PUT|DELETE|OPTIONS|HEAD', '/app/.*', function () {
    if (!isset($_SESSION['isLoggedIn'])) {
        header('Location: /get-in');
    }
});
