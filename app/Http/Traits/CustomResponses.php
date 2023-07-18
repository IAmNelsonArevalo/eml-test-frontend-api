<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;

trait CustomResponses
{
    protected function error(string $content, mixed $data): JsonResponse
    {
        return response()->json(array(
            "transaction" => array("status" => false),
            "message" => array("type" => "error", "content" => $content, "code" => 500),
            "data" => $data
        ), 500);
    }

    protected function success(string $content, mixed $data): JsonResponse
    {
        return response()->json(array(
            "transaction" => array("status" => true),
            "message" => array("type" => "success", "content" => $content, "code" => 200),
            "data" => $data
        ), 200);
    }

    protected function unauthorized(string $content, mixed $data): JsonResponse
    {
        return response()->json(array(
            "transaction" => array("status" => false),
            "message" => array("type" => "unauthorized", "content" => $content, "code" => 421),
            "data" => $data
        ), 421);
    }

    protected function notFound(string $content, mixed $data): JsonResponse
    {
        return response()->json(array(
            "transaction" => array("status" => false),
            "message" => array("type" => "Not Found", "content" => $content, "code" => 404),
            "data" => $data
        ), 404);
    }
}
