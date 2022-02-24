<?php

namespace App\Controllers;

use App\Security\CSRF;
use App\Models\TaxRate;

class TaxRateController
{
    public function getTaxRates(): void
    {
        $tax_rate = new TaxRate();
        $getAllTaxRate = $tax_rate->getTaxRates();
        if (empty($getAllTaxRate)) {
            ResponseController::successResponseWithData([]);
        } else {
            //Add Count ID
            for ($i = 0; $i < count($getAllTaxRate); $i++) {
                $getAllTaxRate[$i]['pubId'] = $i + 1;
                if($getAllTaxRate[$i]['tax_type'] === 1) {
                    $getAllTaxRate[$i]['tax_type'] = "GST";
                } else {
                    $getAllTaxRate[$i]['tax_type'] = "Normal Tax";
                }
            }


            ResponseController::successResponseWithData($getAllTaxRate);
        }
    }
    public function addTaxRate(): void
    {
        if($_SERVER['REQUEST_METHOD'] === "POST") {
            if (!(new CSRF())->validate('add-tax-rate-form')) {
                ResponseController::errorResponse(401, "এই মুহুর্তে আপনার অনুরোধ প্রসেস করা সম্ভব হচ্ছে না");
                exit();
            }

            $err = [];
            if (isset($_POST['name'])) {
                $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
            } else {
                $err[] = "Please enter valid name";
            }
            
            if (isset($_POST['rate'])) {
                $rate = trim(filter_var($_POST['rate'],FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
            } else {
                $err[] = "Please enter valid rate";
            }

            if (isset($_POST['tax_type'])) {
                if($_POST['tax_type'] == 1) {
                    $tax_type = 1;
                } else if($_POST['tax_type'] == 2) {
                    $tax_type = 2;
                } else {
                    $err[] = "Please enter valid name";
                }
            } else {
                $err[] = "Please enter valid name";
            }

            //No Errors
            if(empty($err)) {
                $tax_rate = new TaxRate();
                $tax_rate->setName($name);
                $tax_rate->setRate($rate);
                $tax_rate->setTaxType($tax_type);
                if($tax_rate->addTaxRate()) {
                    ResponseController::successResponse('ট্যাক্সের হার সফলভাবে যোগ করা হয়েছে');
                    exit();
                } else {
                    ResponseController::errorResponse(500, "এই মুহুর্তে আপনার অনুরোধ প্রসেস করা সম্ভব হচ্ছে না");
                    exit();
                }
            } else {
                ResponseController::errorResponse(400, "ট্যাক্সের হারের তথ্য প্রদান করা হয় নি");
                exit();
            }
        }
    }

    public function deleteTaxRate(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === "DELETE") {
            if (!(new CSRF())->validate('delete-tax-rate')) {
                ResponseController::errorResponse(401, "এই মুহুর্তে আপনার অনুরোধ প্রসেস করা সম্ভব হচ্ছে না");
                exit();
            }
        }

        $tax_rate = new TaxRate();
        $tax_rate->setId($id);
        if ($tax_rate->deleteById()) {
            ResponseController::successResponse('ট্যাক্সের হার সফলভাবে মোছা হয়েছে');
        } else {
            ResponseController::errorResponse(500, "এই মুহুর্তে আপনার অনুরোধ প্রসেস করা সম্ভব হচ্ছে না");
        }
    }
}
