<?php

namespace App\Http\Resources\Staff;

use App\Http\Resources\Staff\ItemResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'id' => (string)$this->id,
            'type' => 'Categories',
            'attributes' => [
                'category_name' => $this->cat_name,
                'category_description' => $this->cat_description,
                'items' => ItemResource::collection($this->whenLoaded('items'))
            ]
        ];
    }
}
