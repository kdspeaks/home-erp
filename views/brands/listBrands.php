<?php

use App\Security\CSRF;

$title = "ওষুধের ব্রান্ড";
require_once APP_ROOT . '/views/layouts/header.php'; ?>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="card-title font-weight-bold">
                    <i class="nav-icon fas fa-prescription"></i>
                    সমস্ত ওষুধের ব্রান্ড
                </h3>
                <div class="ml-auto">
                    <div class="dropdown">
                        <button class="btn btn-xs text-navy" type="button" id="brandTools" data-toggle="dropdown" aria-expanded="false" data-offset="-140">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="brandTools">
                            <a class="dropdown-item text-olive" href="add" id="add-brand"><i class="fas fa-plus-circle mr-2"></i> নতুন ব্রান্ড যোগ</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-maroon" href="#"><i class="fas fa-trash-alt mr-2"></i> ব্রান্ড বাদ দিন</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <form id="delete-brand">
                <?= (new CSRF())->input('delete-brand') ?>
            </form>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover projects" id="list-brands-table">
                    <thead>
                        <tr role="row">
                            <th>ID</th>
                            <th>ব্রান্ডের নাম</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>ব্রান্ডের নাম</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<!-- Add Brand -->
<div class="modal fade" id="addBrand" tabindex="-1" role="dialog" aria-labelledby="addBrandLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBrandLabel">নতুন ব্রান্ড যোগ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add-brand-form">
                <div class="modal-body">
                    <label for="add-brand-input">ব্রান্ডের নাম</label>
                    <select class="form-control" multiple="multiple" id="add-brand-input" name="brands[]"></select>
                    <small class="text-muted">ব্রান্ডের নাম লেখার পর কমা দিন বা নাম সিলেক্ট করে পরের ব্র্যান্ডের নাম লিখুন</small>
                    <?= (new CSRF())->input('add-brand-form') ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-maroon" data-dismiss="modal">বন্ধ</button>
                    <button type="submit" class="btn bg-olive">যোগ</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once APP_ROOT . '/views/layouts/footer.php';
