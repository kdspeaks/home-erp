<?php

use App\Controllers\HelperFunctionsController;
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= ASSETS_URL ?>/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?= SITE_NAME ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-center">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div> -->

        <!-- SidebarSearch Form -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?= APP_URL ?>/dashboard" class="nav-link <?= HelperFunctionsController::addClassOnCurrentPage('dashboard', false) ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            ড্যাশবোর্ড
                        </p>
                    </a>
                </li>
                <li class="nav-item <?= HelperFunctionsController::addClassOnCurrentPage('products', false, 'menu-open') ?>">
                    <a href="#" class="nav-link <?= HelperFunctionsController::addClassOnCurrentPage('products', false) ?>">
                        <i class="nav-icon fas fa-capsules"></i>
                        <p>
                            ওষুধ
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= APP_URL ?>/products" class="nav-link <?= HelperFunctionsController::addClassOnCurrentPage('products/', true) ?>">
                                <i class="nav-icon fas fa-capsules"></i>
                                <p>সমস্ত ওষুধের লিস্ট</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= APP_URL ?>/products/add" class="nav-link <?= HelperFunctionsController::addClassOnCurrentPage('products/add', true) ?>">
                                <i class="fas fa-plus-circle nav-icon"></i>
                                <p>নতুন ওষুধ যোগ</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item <?= HelperFunctionsController::addClassOnCurrentPage('brands', false, 'menu-open') ?>">
                    <a href="<?= APP_URL ?>/brands" class="nav-link <?= HelperFunctionsController::addClassOnCurrentPage('brands', false) ?>">
                        <i class="nav-icon fas fa-prescription"></i>
                        <p>
                            ওষুধের ব্রান্ড
                        </p>
                    </a>
                </li>
                <li class="nav-item <?= HelperFunctionsController::addClassOnCurrentPage('tax-rates', false, 'menu-open') ?>">
                    <a href="<?= APP_URL ?>/tax-rates" class="nav-link <?= HelperFunctionsController::addClassOnCurrentPage('tax-rates', false) ?>">
                        <i class="nav-icon fas fa-percentage"></i>
                        <p>
                            ট্যাক্সের হার
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= APP_URL ?>/logout" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            বেরিয়ে যান
                        </p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Simple Link
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li> -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>