<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\OrderBill;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyStockStaff
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderBill $event)
{
    try {
        $users = User::whereHasMorph('roles', 'App\Models\User', function ($query) {
            $query->whereHas('permissions', function ($query) {
                $query->where('name', '=', 'edit_orders');
            });
        })->get();
        Mail::to($users)->send(new OrderBill());
    } catch (Exception $e) {
        // Log the exception and handle it as needed
    }
}
}
