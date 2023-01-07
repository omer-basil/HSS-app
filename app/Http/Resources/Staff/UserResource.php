<?php

namespace App\Http\Resources\Staff;

use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Http\Resources\Staff\RoleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $all_users_with_all_their_roles = User::with('roles')->find($this->id);
    }
}
