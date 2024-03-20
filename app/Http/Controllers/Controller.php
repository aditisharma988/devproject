<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use ValidatesRequests;
    /**
     * Return a success JSON response.
     *
     * @param  mixed  $data
     * @param  int  $code
     * @param  string|null  $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($data, int $code = 200, string $message = null)
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $code);
    }

}
