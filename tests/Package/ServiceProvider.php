<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/4/6
 * Time: 12:17.
 */

namespace HughCube\Laravel\HttpClient\Contracts\Tests\Package;

class ServiceProvider extends \HughCube\Laravel\HttpClient\Contracts\ServiceProvider
{
    protected function createManager($app): Manager
    {
        return new Manager();
    }

    protected function getPackageFacadeAccessor(): string
    {
        return Package::getFacadeAccessor();
    }
}
