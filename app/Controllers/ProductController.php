<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Security\CSRF;

class ProductController
{
    public function addProduct(): void
    {
        if (!(new CSRF())->validate('add-product-form')) {
            ResponseController::errorResponse(401, "এই মুহুর্তে আপনার অনুরোধ প্রসেস করা সম্ভব হচ্ছে না");
            exit();
        }
        $err = [];
        
        if (isset($_POST['name'])) {
            $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
        } else {
            $err[] = "Please enter valid name";
        }
        
        if (isset($_POST['brand-for-product'])) {
            $brand_id = filter_var((int)$_POST['brand-for-product'], FILTER_SANITIZE_NUMBER_INT);
        } else {
            $err[] = "Please enter valid brand";
        }

        if (isset($_POST['tax-rate-for-product'])) {
            $tax_rate = filter_var((int)$_POST['tax-rate-for-product'], FILTER_SANITIZE_NUMBER_INT);
        } else {
            $err[] = "Please enter valid tax rate";
        }

        if(isset($_POST['dataFormat'])) {
            $variants = json_decode($_POST['dataFormat'], true);
        } else {
            $err[] = "Please enter valid variant information";
        }
        
        if(empty($err)) {
            $product = new Product();
            $product->setName($name);
            $product->setBrandId($brand_id);
            $product->setTaxRateId($tax_rate);
            $product_id = $product->addProduct();
            // die(var_dump($product_id));
            //We have got the added product, lets add variant
            $product_variant = new ProductVariant();
            $product_variant->setProductId($product_id);
            $i = 0;
            foreach($variants as $variant) {
                $product_variant->setPower($variant['power']);
                $product_variant->setPackage($variant['package']);
                $product_variant->setPurchasePrice($variant['purchase_price']);
                $product_variant->setSalePrice($variant['sale_price']);
                if($product_variant->addProductVariant()) {
                    $i++;
                }
            }
            if($i) {
                ResponseController::successResponse('নতুন ওষুধ সফলভাবে যোগ করা হয়েছে');
                exit();
            } else {
                ResponseController::errorResponse(500, "এই মুহুর্তে আপনার অনুরোধ প্রসেস করা সম্ভব হচ্ছে না");
                exit();
            }
        } else {
            ResponseController::errorResponse(400, "নতুন ওষুধের তথ্য প্রদান করা হয় নি");
            exit();
        }
    }

    public function getProducts(): void
    {
        $products = new Product();
        $getAllProducts = $products->getAllProducts();
        if (empty($getAllProducts)) {
            ResponseController::successResponseWithData([]);
        } else {
            //Add Count ID
            for ($i = 0; $i < count($getAllProducts); $i++) {
                $getAllProducts[$i]['pubId'] = $i + 1;
            }
            ResponseController::successResponseWithData($getAllProducts);
        }
    }

    public function deleteProduct(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === "DELETE") {
            if (!(new CSRF())->validate('delete-product')) {
                ResponseController::errorResponse(401, "এই মুহুর্তে আপনার অনুরোধ প্রসেস করা সম্ভব হচ্ছে না.");
                exit();
            }
        }

        $product = new Product();
        $product->setId($id);
        if ($product->deleteById()) {
            ResponseController::successResponse('ওষুধের তথ্য সফলভাবে মোছা হয়েছে');
        } else {
            ResponseController::errorResponse(500, "এই মুহুর্তে আপনার অনুরোধ প্রসেস করা সম্ভব হচ্ছে না");
        }
    }
}
