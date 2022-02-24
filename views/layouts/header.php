<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?> | <?= SITE_NAME ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Select 2 BS4 -->
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- <link rel="stylesheet" href="<?= ASSETS_URL ?>/plugins/toastr/"> -->
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/adminlte.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="wrapper">
            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center">
                <img src="<?= ASSETS_URL ?>/img/logo.png" alt="Logo" height="60" width="60">
            </div>
        </div>
        <?php

        use App\Controllers\HelperFunctionsController;

        require_once __DIR__ . '/navbar.php' ?>
        <?php require_once __DIR__ . '/sidebar.php' ?>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?= $title ?></h1>
                        </div><!-- /.col -->
                        <?php
                        if (!(HelperFunctionsController::isCurrentPage('dashboard') or empty($pages))) { ?>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <?php echo implode(HelperFunctionsController::generateBreadcrumb($pages)) ?>
                                </ol>
                            </div><!-- /.col -->
                        <?php } ?>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->