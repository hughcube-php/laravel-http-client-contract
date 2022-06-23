<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/4/20
 * Time: 4:19 下午.
 */

namespace HughCube\Laravel\HttpClient\Contracts;

/**
 * @mixin Client
 */
abstract class Manager extends \HughCube\Laravel\ServiceSupport\Manager
{
    public function makeDriver(array $config)
    {
        return $this->makeClient($config);
    }

    protected function getDriversConfigKey(): string
    {
        return 'clients';
    }

    abstract public function makeClient(array $config);
}
