<?php
/**
 * Initial Version Created by Danial Panah
 * Email: me@danialrp.com - Web: danialrp.com
 * on 12/12/2022 AD
 */

namespace DanialPanah\MailConnect;

use Illuminate\Support\ServiceProvider;

class MailConnectServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('mailConnect', function ($app) {
            return new MailConnect();
        });

        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'mailconnect');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('mailconnect.php'),
            ], 'config');
        }
    }
}