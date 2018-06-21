<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Overtrue\Pinyin\Pinyin;

class PinYinServiceProvider extends ServiceProvider
{
    /**
     * 是否延时加载提供器。
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('pinyinService', function ($app) {
            return new Pinyin();
        });
    }

    /**
     * 获取提供器提供的服务。
     *
     * @return array
     */
    public function provides()
    {
        return ['pinyinService'];
    }
}
