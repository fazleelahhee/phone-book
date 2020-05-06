<?php

namespace App\Http\Resources\Auth;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class Login extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'access_token' => $this->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $this->token->expires_at
            )->toDateTimeString()
        ];
    }
}
