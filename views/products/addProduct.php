<?php

use App\Security\CSRF;

$title = "নতুন ওষুধ যোগ";
require_once APP_ROOT . '/views/layouts/header.php'; ?>
<div class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">নতুন ওষুধের তথ্যাবলী</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" style="display: block;">
                <form id="add-product-form">
                    <div class="form-group">
                        <label for="name">ওষুধের নাম</label>
                            <input type="text" id="name" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label for="brand-for-product">ওষুধের ব্রান্ড</label>
                        <select id="brand-for-product" class="form-control custom-select" name="brand">
                            <option></option>
                            <?php
                            foreach ($allBrands as $brand) { ?>
                                <option value="<?= $brand['id'] ?>"><?= $brand['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tax-rate-for-product">ট্যাক্সের হার</label>
                        <select id="tax-rate-for-product" class="form-control custom-select" name="tax_rate">
                            <option></option>
                            <?php
                            foreach ($allTaxRates as $taxRate) { ?>
                                <option value="<?= $taxRate['id'] ?>"><?= $taxRate['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="border-bottom my-2 py-2 font-weight-bold">
                        এই ওষুধের বিভিন্ন প্রকার
                    </div>
                    <div class="variant-details-wrapper" id="variant-details-wrapper">
                        <div class="row mb-3 mx-n2" id="variant-details-1">
                            <div class="col-12 col-lg-3 mb-3 mb-lg-0">
                                <label for="variant-power-1" class="form-label">Power</label>
                                <input type="text" name="variant-power" id="variant-power-1" class="form-control" required>
                            </div>
                            <div class="col-12 col-lg-3 mb-3 mb-lg-0">
                                <label for="variant-package-1" class="form-label">Package</label>
                                <input type="text" name="variant-package" id="variant-package-1" class="form-control" required>
                            </div>
                            <div class="col-12 col-lg-3 mb-3 mb-lg-0">
                                <label for="variant-purchase-price-1" class="form-label">ক্র​য় মুল্য</label>
                                <input type="text" name="variant-purchase-price" id="variant-purchase-price-1" class="form-control" required>
                            </div>
                            <div class="col-12 col-lg-3 mb-3 mb-lg-0">
                                <label for="variant-sale-price-1" class="form-label">বিক্র​য় মুল্য</label>
                                <input type="text" name="variant-sale-price" id="variant-sale-price-1" class="form-control" required>
                            </div>
                            <div class="d-flex mt-2 px-2">
                                <button class="btn bg-olive btn-sm mr-2 add-button" id="add-button-1"><i class="fas fa-plus-circle"></i></button>
                                <button class="btn btn-danger btn-sm delete-button" id="delete-button-1"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                    <?= (new CSRF())->input('add-product-form') ?>
                    <button class="btn bg-olive" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once APP_ROOT . '/views/layouts/footer.php';
