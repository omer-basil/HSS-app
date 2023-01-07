<?php

namespace App\Http\Services;

use App\Models\Customer\Order;
use App\Models\Customer\OrderDetail;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function storeOrderAndDetails(array $data)
    {
        DB::transaction(function () use ($data) {
            $order = auth()->user()->orders()->create([
                'order_code' => $data['order_code'],
                'total_items' => $data['total_items'],
                'total_price' => $data['total_price'],
            ]);

            $order->orderDetails()->create([
                'item_code' => $data['item_code'],
                'item_colour' => $data['item_colour'],
                'item_size' => $data['item_size'],
                'item_quantity' => $data['item_quantity'],
                'item_price' => $data['item_price'],
                'item_link' => $data['item_link'],
                'item_id' => $data['item_id'],
            ]);
        });

        // DB::table('sizes')->where('id', $data['item_size'])->decrement('item_quantity', $data['item_quantity']);
    }
}

