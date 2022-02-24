<?php

namespace App\Controllers;

use App\Models\Brand;
use App\Security\CSRF;

class BrandController
{
    public function addBrand(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (!(new CSRF())->validate('add-brand-form')) {
                ResponseController::errorResponse(401, "এই মুহুর্তে আপনার অনুরোধ প্রসেস করা সম্ভব হচ্ছে না");
                exit();
            }

            $brandsArr = array_map(function($brand) {
                return filter_var($brand, FILTER_SANITIZE_STRING);
            }, $_POST['brands']);

            $brands = new Brand();
            $brands->setBrands($brandsArr);
            $count = $brands->insertBrands();
            if($count) {
                ResponseController::successResponse($count . ' টি ব্র্যান্ড সফলভাবে যোগ করা হয়েছে');
                exit();
            } else {
                ResponseController::errorResponse(500, "এই মুহুর্তে আপনার অনুরোধ প্রসেস করা সম্ভব হচ্ছে না");
                exit();
            }
        }
    }

    public function getBrands(): void
    {
        $brands = new Brand();
        $getAllBrands = $brands->getBrands();
        if(empty($getAllBrands)) {
            ResponseController::successResponseWithData([]);
        } else {
            //Add Count ID
            for($i = 0; $i < count($getAllBrands); $i++) {
                $getAllBrands[$i]['pubId'] = $i + 1;
            }
            ResponseController::successResponseWithData($getAllBrands);
        }
    }

    public function deleteBrand(int $id): void
    {
        if($_SERVER['REQUEST_METHOD'] === "DELETE") {
            if (!(new CSRF())->validate('delete-brand')) {
                ResponseController::errorResponse(401, "এই মুহুর্তে আপনার অনুরোধ প্রসেস করা সম্ভব হচ্ছে না");
                exit();
            }
        }

        $brands = new Brand();
        $brands->setId($id);
        if($brands->deleteById()) {
            ResponseController::successResponse('ব্র্যান্ড সফলভাবে মোছা হয়েছে');
        } else {
            ResponseController::errorResponse(500, "এই মুহুর্তে আপনার অনুরোধ প্রসেস করা সম্ভব হচ্ছে না");
        }
    }
}
