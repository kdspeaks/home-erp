<?php

namespace App\Controllers;

use App\Models\Brand;
use App\Models\TaxRate;

class ViewController
{
    public function loginView(): void
    {
        require_once APP_ROOT . '/views/login.php';
    }
    
    public function dashboardView(): void
    {
        require_once APP_ROOT . '/views/dashboard.php';
    }

    public function listBrandView(): void
    {
        $pages = [
            [
                'title' => 'ওষুধের ব্রান্ড',
                'url' => APP_URL . '/brands',
                'isLast' => true
            ]
        ];
        require_once APP_ROOT . '/views/brands/listBrands.php';
    }

    public function listTaxRateView(): void
    {
        $pages = [
            [
                'title' => 'ট্যাক্সের হার',
                'url' => APP_URL . '/tax-rates',
                'isLast' => true
            ]
        ];
        require_once APP_ROOT . '/views/tax-rates/listTaxRates.php';
    }

    public function listProductsView(): void
    {
        $pages = [
            [
                'title' => 'ওষুধ',
                'url' => APP_URL . '/products',
                'isLast' => true
            ],
            [
                'title' => 'ওষুধ',
                'url' => APP_URL . '/products',
                'isLast' => true
            ]
        ];
        require_once APP_ROOT . '/views/products/listProducts.php';
    }

    public function addProductView(): void
    {
        $pages = [
            [
                'title' => 'ওষুধ',
                'url' => APP_URL . '/products',
                'isLast' => false
            ],
            [
                'title' => 'নতুন ওষুধ যোগ',
                'url' => APP_URL . '/products/add',
                'isLast' => true
            ]
        ];

        $allBrands = (new Brand)->getBrands();
        $allTaxRates = (new TaxRate)->getTaxRates();
        require_once APP_ROOT . '/views/products/addProduct.php';
    }
}
