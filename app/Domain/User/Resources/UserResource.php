<?php

namespace App\Domain\User\Resources;

use App\Infrastructure\Http\Resources\BaseResource;
use App\Domain\Profile\Resources\ProfileResource;
use App\Domain\User\Resources\UserStatusResource;

class UserResource extends BaseResource
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
            'id' => $this->id,
            'name' => $this->name,
            'profile_id' => $this->profile_id,
            'profile' => ProfileResource::make($this->profile),
            'user_status_id' => $this->user_status_id,
            'status' => UserStatusResource::make($this->user_status),
            'email' => $this->email,
            'gender' => $this->gender,
            'married' => $this->married,
            'dob' => $this->dob,
            'registered' => $this->registered,
            'validated' => $this->validated,
            'approved' => $this->approved,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
