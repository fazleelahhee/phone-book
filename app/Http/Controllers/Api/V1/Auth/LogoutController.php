<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * User Logout
     * {User logged out from app.}
     * @response {
     *      "data" : {
     *              "message":"Successfully logged out"
     *      }
     * }
     *
     * @response 401 {
     *      "message": "Unauthorized"
     * }
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(
            [
                "data" => [
                    'message' => 'Successfully logged out'
                ]
            ]
        );
    }
}
