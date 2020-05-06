<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Registration as RegistrationRequest;
use App\Http\Resources\Auth\Login as LoginResource;
use App\User;

class RegisterController extends Controller
{

    /**
     * User registration
     * {Allow user to register with fatface reward app}
     *
     * @bodyParam name string required Name is required for the registration.
     * @bodyParam email string required Email is required for the registration and will be used a username & must be unique.
     * @bodyParam password string required Password min 8 chars.
     *
     * @response {
     *              "data": {
     *                          "access_token": "eyJ0eXAiOiJKV1QiLC...dfgsdfg",
     *                          "token_type": "Bearer",
     *                          "expires_at": "2020-09-28 16:00:00"
     *                      }
     *           }
     *
     *
     * @response 422 {
     *          "message": "The given data was invalid.",
     *          "errors": {
     *                "name": [
     *                      "The name field is required."
     *                  ],
     *                  "email": [
     *                      "The email field is required.",
     *                      "The email has already been taken."
     *                  ],
     *                  "password": [
     *                      "The password field is required.",
     *                      "The password format is invalid."
     *                  ],
     *               }
     * }
     *
     *
     * @param RegistrationRequest $request
     * @return LoginResource|\Illuminate\Http\JsonResponse
     */
    public function register(RegistrationRequest $request)
    {
        try {
            $user = new User([
                'name' => trim($request->get('name')),
                'email' => trim($request->get('email')),
                'password' => bcrypt($request->get('password')),
            ]);

            $user->save();

            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->save();

            $response = new LoginResource($tokenResult);
            return $response;
        } catch (\Exception $exp) {
            return response()->json([
                "errors" => [
                    'message' => $exp->getMessage()
                ]
            ], 422);
        }
    }
}
