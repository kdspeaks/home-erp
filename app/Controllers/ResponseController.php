<?php

namespace App\Controllers;

class ResponseController
{
    public static function successResponse(string $responseData): void
    {
        echo json_encode([
            'status' => true,
            'response' => $responseData
        ]);
    }

    public static function successResponseWithData(array $data): void
    {
        echo json_encode([
            'status' => true,
            'data' => $data
        ]);
    }

    public static function errorResponse(int $err_code, string $str = '', array $arr = []): void
    {
        http_response_code($err_code);
        if(empty($arr)) {
            echo json_encode([
                'status' => false,
                'response' => $str
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'response' => $arr
            ]);
        }
    }
}
