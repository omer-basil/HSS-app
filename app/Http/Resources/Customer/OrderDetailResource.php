<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
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
            'type' => 'Order Details',
            'attributes' => [
                'item-code' => $this->item_code,
                'item-colour' => $this->item_colour,
                'item-size' => $this->item_size,
                'quantity' => $this->quantity,
                'price' => $this->price,
                'item-link' => $this->item_link
            ]
        ];
    }
}
