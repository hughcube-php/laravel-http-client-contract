<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/4/18
 * Time: 10:32 下午.
 */

namespace HughCube\Laravel\HttpClient\Contracts;

use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

abstract class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Boot the provider.
     */
    public function boot()
    {
        if (!empty($source = $this->getConfigSource())) {
            if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
                $this->publishes([$source => config_path(sprintf('%s.php', $this->getPackageFacadeAccessor()))]);
            } elseif ($this->app instanceof LumenApplication) {
                $this->app->configure($this->getPackageFacadeAccessor());
            }
        }
    }

    /**
     * Register the provider.
     */
    public function register()
    {
        $this->app->singleton($this->getPackageFacadeAccessor(), function ($app) {
            return $this->createManager($app);
        });
    }

    protected function getConfigSource(): ?string
    {
        //return realpath(dirname(__DIR__).'/config/config.php');
        return null;
    }

    abstract protected function createManager($app);

    abstract protected function getPackageFacadeAccessor(): string;
}
