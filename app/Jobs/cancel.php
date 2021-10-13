<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Order\Services\OrderService;

class cancel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $orderSn;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($orderSn)
    {
        $this->orderSn = $orderSn;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        (new OrderService())->cancel($this->orderSn);
    }
}
