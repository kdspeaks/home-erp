<?php

namespace App\Controllers;

use App\Models\User;
use App\Security\CSRF;

class UserController
{
    //The Login Controller
    public function loginAction()
    {
        if($_SERVER['REQUEST_METHOD'] === "POST") {
            if(!(new CSRF())->validate('login-form')) {
                ResponseController::errorResponse(401, "এই মুহুর্তে আপনার অনুরোধ প্রসেস করা সম্ভব হচ্ছে না");
                exit();
            }
            //Sanitize inputs
            $err = [];
            if(isset($_POST['email'])) {
                $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
            } else {
                $err[] = "Please enter valid email";
            }
            if(isset($_POST['password'])) {
                $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
            } else {
                $err[] = "Please enter valid password";
            }

            //No errors
            if(empty($err)) {

                //Find user by email
                $user = new User();
                $user->setEmail($email);
                $getUser = $user->getByEmail();
                if($getUser) {
                    
                    //Check if password is correct
                    if(password_verify($password, $getUser['password_hash'])) {
                        $_SESSION['isLoggedIn'] = true;
                        $_SESSION['userId'] = $getUser['id'];
                        ResponseController::successResponse('লগইন সফল হয়েছে, আপনাকে পরবর্তী পেজে নিয়ে যাওয়া হচ্ছে.....');
                        exit();
                    } else {
                        ResponseController::errorResponse(401, "আপনি ভুল ইমেইল অথবা পাসওযার্ড টাইপ করেছেন");
                        exit();
                    }
                } else {
                    ResponseController::errorResponse(401, "আপনি ভুল ইমেইল অথবা পাসওযার্ড টাইপ করেছেন");
                    exit();
                }
            } else {
                ResponseController::errorResponse(400, "লগইন এর তথ্য প্রদান করা হয় নি");
                exit();
            }
        }
    }

    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();
        header('Location: ' . SITE_URL . '/get-in');
    }
}
