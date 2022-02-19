<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    private string $token;

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'avatar' => $this->avatar,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'is_marketing' => $this->is_marketing,
            'created_at' => Carbon::create($this->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::create($this->updated_at)->format('Y-m-d H:i:s'),
            'last_login_at' => Carbon::create($this->last_login_at)->format('Y-m-d H:i:s'),
            'token' => $this->when($this->token != null, $this->token),
        ];
    }

    public function token($token): static
    {
        $this->token = $token;

        return $this;
    }
}
