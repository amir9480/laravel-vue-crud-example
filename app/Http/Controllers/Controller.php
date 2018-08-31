<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Return API Json success data
     *
     * @param mixed $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseSuccess($data)
    {
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Return API Json error data
     *
     * @param mixed $data
     * @return Illuminate\Http\JsonResponse
     */
    protected function responseError($data)
    {
        return response()->json([
            'success' => false,
            'data' => $data
        ]);
    }
}
