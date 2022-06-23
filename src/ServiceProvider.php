<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/4/18
 * Time: 10:32 下午.
 */

namespace HughCube\Laravel\HttpClient\Contracts;

abstract class ServiceProvider extends \HughCube\Laravel\ServiceSupport\ServiceProvider
{
    protected function createPackageFacadeRoot($app)
    {
        return $this->createManager($app);
    }

    /**
     * @return mixed
     * @see ServiceProvider::createPackageFacadeRoot()
     * @deprecated
     */
    protected function createManager($app)
    {
        return null;
    }
}
