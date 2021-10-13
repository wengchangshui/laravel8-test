<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendWebhook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $queue = 'service';
    public $tries = 0;

    public $service;
    public $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Service $service, array $data)
    {
        $this->service = $service;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // 基于 HTTP 请求发送响应给调用方
        Http::timeout(5)->post($this->service->url, $this->data);
    }

    /**
     * FunctionName: retryUntil
     * Description: 失败重试时间
     * Author: 翁昌水
     * Create Date: 2021/10/13 14:11
     * @return \Illuminate\Support\Carbon
     */
    public function retryUntil()
    {
        return now()->addDay();
    }

    /**
     * FunctionName: fail
     * Description: 失败时调用
     * Author: 翁昌水
     * Create Date: 2021/10/13 14:11
     * @param null $exception
     */
    public function fail($exception = null)
    {

    }
}
