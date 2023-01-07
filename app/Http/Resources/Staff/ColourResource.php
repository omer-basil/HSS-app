<?php

namespace App\Http\Resources\Staff;

use App\Http\Resources\Staff\SizeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ColourResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'image' => $this->image,
            'size' => SizeResource::collection($this->whenLoaded('sizes'))
        ];
    }
}
