<?php

namespace Wcs\test;

use Illuminate\Support\ServiceProvider;

class PackagesTestServiceProvider extends ServiceProvider
{
    protected $defer = true; // 延迟加载服务
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // 单例绑定服务
        $this->app->singleton('PackageTest', function ($app) {
            return new Packagetest($app['session'], $app['config']);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'PackageTest'); // 视图目录指定
        $this->publishes([
            __DIR__ . '/views' => base_path('resources/views/vendor/packageTest'),  // 发布视图目录到resources 下
            __DIR__ . '/config/packagetest.php' => config_path('packageTest.php'), // 发布配置文件到 laravel 的config 下
        ]);
    }

    public function provides()
    {
        // 因为延迟加载 所以要定义 provides 函数 具体参考laravel 文档
        return ['packageTest'];
    }
}
