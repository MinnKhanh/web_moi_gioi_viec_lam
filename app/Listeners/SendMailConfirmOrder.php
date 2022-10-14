<?php

namespace App\Listeners;

use App\Events\CustomerOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMailConfirmOrder
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CustomerOrder  $event
     * @return void
     */
    public function handle(CustomerOrder $event)
    {
        dd($event);
    }
}
