<?php

use App\Security\CSRF;

$title = "ওষুধ";
require_once APP_ROOT . '/views/layouts/header.php'; ?>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="card-title font-weight-bold">
                    <i class="nav-icon fas fa-capsules"></i>
                    সমস্ত ওষুধের লিস্ট
                </h3>
                <div class="ml-auto">
                    <div class="dropdown">
                        <button class="btn btn-xs text-navy" type="button" id="taxRateTools" data-toggle="dropdown" aria-expanded="false" data-offset="-140">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="taxRateTools">
                            <a class="dropdown-item text-olive" href="<?= APP_URL ?>/products/add" id="add-product"><i class="fas fa-plus-circle mr-2"></i> নতুন ওষুধ যোগ</a>
                            <!-- <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-maroon" href="#"><i class="fas fa-trash-alt mr-2"></i> ট্যাক্সের হার বাদ দিন</a> -->
                        </div>
                    </div>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <form id="delete-product">
                <?= (new CSRF())->input('delete-product')?>
            </form>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover projects" id="list-products-table">
                    <thead>
                        <tr role="row">
                            <th>ID</th>
                            <th>নাম</th>
                            <th>ব্রান্ড</th>
                            <th>ট্যাক্সের হার(%)</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>নাম</th>
                            <th>ব্রান্ড</th>
                            <th>ট্যাক্সের হার(%)</th>
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

<!-- Add Tax Rate -->
<div class="modal fade" id="addTaxRate" tabindex="-1" role="dialog" aria-labelledby="addTaxRateLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTaxRateLabel">নতুন ট্যাক্সের হার যোগ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add-tax-rate-form">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="add-tax-rate-name-input">নাম</label>
                        <input type="text" class="form-control" id="add-tax-rate-name-input" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="add-tax-rate-rate-input">হার</label>
                        <input type="number" class="form-control" id="add-tax-rate-rate-input" name="rate">
                    </div>
                    <div class="mb-3">
                        <label for="add-tax-rate-input">ট্যাক্সের প্রকার</label>
                        <select class="custom-select" id="add-tax-rate-input" name="tax_type">
                            <option value="1" selected>GST</option>
                            <option value="2">Normal Tax</option>
                        </select>
                    </div>
                    <?php // (new CSRF())->input('add-tax-rate-form') 
                    ?>
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
