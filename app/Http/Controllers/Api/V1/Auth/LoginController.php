<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login as LoginRequest;
use App\Http\Resources\Auth\Login as LoginResource;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $maxAttempts = 5; // Default is 5
    protected $decayMinutes = 1; // Default is 1


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->maxAttempts = env('MAX_LOGIN_ATTEMPT', 3);
        $this->decayMinutes = env('LOGIN_LOCKDOWN', 30);
    }

    /**
     * User login
     *
     * [User login ]
     *
     * @bodyParam email string required Email needed to login.
     * @bodyParam password string required Password needed to login.
     *
     * @response {
     *              "data": {
     *                          "access_token": "eyJ0eXAiOiJKV1QiLC...dfgsdfg",
     *                          "token_type": "Bearer",
     *                          "expires_at": "2020-09-28 16:00:00"
     *                      }
     *           }
     *
     * @response 401 {
     *      "message": "Incorrect email or password"
     * }
     *
     * @response 429 {
     *      "message": "Too many requests has been made. Application has been temporarily locked for # minutes"
     * }
     *
     * @response 422 {
     *      "message": "The given data was invalid.",
     *      "errors": {
     *              "email": [
     *                      "The email field is required."
     *               ],
     *              "password": [
     *                      "The password field is required."
     *               ]
     *             }
     * }
     *
     * @param LoginRequest $request
     * @return LoginResouce|\Illuminate\Http\JsonResponse
     */

    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);

        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);
            $seconds = $this->limiter()->availableIn(
                $this->throttleKey($request)
            );
            return response()->json([
                'message' => 'Too many requests has been made. Application has been temporarily locked for ' . ceil($seconds / 60) . ' minutes'
            ], Response::HTTP_TOO_MANY_REQUESTS);
        }

        if (!Auth::attempt($credentials)) {
            $this->incrementLoginAttempts($request);
            return response()->json([
                'message' => 'Incorrect email or password'
            ], 401);
        }

        try {
            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->save();
        } catch (\Exception $exp) {
            return response()->json(
                [
                    "errors" => [
                        'message' => $exp->getMessage()
                    ]
                ], 422);
        }

        return new LoginResource($tokenResult);
    }
}
