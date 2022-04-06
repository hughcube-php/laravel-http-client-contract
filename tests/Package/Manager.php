<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/4/6
 * Time: 12:17
 */

namespace HughCube\Laravel\HttpClient\Contracts\Tests\Package;

class Manager extends \HughCube\Laravel\HttpClient\Contracts\Manager
{
    protected function getPackageFacadeAccessor(): string
    {
        return Package::getFacadeAccessor();
    }

    public function makeClient(array $config): Client
    {
        return new Client($config);
    }
}
