<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Customer\OrderDetailResource;

class OrderResource extends JsonResource
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
            'type' => 'Orders',
            'attributes' => [
                'order-code' => $this->order_code,
                'order-customer' => $this->user_id,
                'total-items' => $this->total_items,
                'total-price' => $this->total_price,
                'order-details' => OrderDetailResource::collection($this->whenLoaded('orderDetails')),
            ]
        ];
    }
}
