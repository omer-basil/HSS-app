<?php

namespace App\Listeners;

use App\Mail\Customer\OrderBill;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailCustomerOrderBill
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $order = $event->order;

        Mail::to(auth()->user()->email)->send(new OrderBill());
    }
}
