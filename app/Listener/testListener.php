<?php

namespace App\Listener;

use App\Event\testListen;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class testListener
{
    private $session;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  testListen  $event
     * @return void
     */
    public function handle(testListen $event)
    {
        $order = $event->order;
        var_dump('this is listener');
        dd($order);
    }
}
