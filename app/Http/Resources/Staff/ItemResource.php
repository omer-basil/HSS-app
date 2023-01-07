<?php

namespace App\Http\Resources\Staff;

use App\Models\Staff\Item;
use App\Models\Staff\Colour;
use App\Http\Resources\Staff\ColourResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // $red_colours=Colour::where('item_id',$this->id)->all();
        return [
            'id' => (string)$this->id,
            'type' => 'Items',
            'attributes' => [
                'i_code' => $this->i_code,
                'i_name' => $this->i_name,
                'i_price' => $this->i_price,
                'description' => $this->description,
                'model' => $this->model,
                'average_rating' => $this->averageRating(),
                'colour' => ColourResource::collection($this->whenLoaded('colours'))
                // 'colour' => $red_colours
            ]
        ];
    }
}
