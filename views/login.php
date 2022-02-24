<?php

use App\Security\CSRF;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= SITE_NAME ?> | Log in </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/adminlte.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div id="login-err-box" class="alert alert-danger" style="display: none;">
            <span id="login-err-msg"></span>
        </div>
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <div class="h1"><b><?= SITE_NAME ?></b> Login</div>
            </div>
            <div class="card-body">
                <p class="login-box-msg">ড্যাসবোর্ড খোলার জন্যে লগ ইন করুন</p>
                <form id="login-form">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="ইমেইল" name="email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="পাসওয়ার্ড" name="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <?=(new CSRF())->input('login-form')?>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remeber-me">
                                <label for="remember" class="font-weight-normal">
                                    আমাকে মনে রাখো​
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" id="login-btn">লগ ইন</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mb-1">
                    <a href="forgot-password.html">পাসওয়ার্ড ভুলে গেছি</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
    <script>
        const app_url = '<?=SITE_URL?>/app'
    </script>
    <!-- jQuery -->
    <script src="<?= ASSETS_URL ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= ASSETS_URL ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= ASSETS_URL ?>/js/adminlte.min.js"></script>
    <script src="<?= ASSETS_URL ?>/js/custom.js"></script>
</body>

</html>