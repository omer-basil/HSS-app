<?php

namespace App\Http\Controllers\Customer;

use App\Events\OrderBill;
use App\Models\Staff\Size;
use App\Models\Customer\Order;
use Illuminate\Support\Facades\DB;
use App\Http\Services\OrderService;
use App\Http\Controllers\Controller;
use App\Models\Customer\OrderDetail;
use App\Http\Resources\Customer\OrderResource;
use App\Http\Requests\Customer\StoreOrderRequest;
use App\Http\Requests\Customer\UpdateOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OrderResource::collection(Order::with('orderDetails')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        $orderService = new OrderService();

        $data = [
            'order_code' => uniqid(true),
            'total_items' => $request->totalItems,
            'total_price' => $request->totalPrice,
            'item_code' => $request->itemCode,
            'item_colour' => $request->itemColour,
            'item_size' => $request->itemSize,
            'item_quantity' => $request->quantity,
            'item_price' => $request->price,
            'item_id' => $request->itemId,
            'item_link' => url()->current(),
        ];

        $orderService->storeOrderAndDetails($data);

        event(new OrderBill($data));
        return response()->json(['status' => 'Email has been delivered to' - auth()-user()->email]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return new OrderResource($order->load('orderDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Customer\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        // $totalItems = OrderDetail::with('order')->count();
        // $totalPrice = OrderDetail::with('order')->sum('item-price')->get();

        // $order->update([
        //     'total-items' => $totalItems,
        //     'total-price' => $totalPrice,
        // ]);

        $order->update([

        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->load('orderDetails');

        DB::transaction(function () use ($order) {
            $order->delete();

            foreach ($order->orderDetails as $orderDetail) {
                DB::table('sizes')->where('id', $orderDetail->item_id)
                    ->increment('quantity', $orderDetail->item_quantity);
            }
        });

        return "Items have been returned to stock!";
    }
}
