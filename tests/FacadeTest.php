<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/4/20
 * Time: 11:45 下午.
 */

namespace HughCube\Laravel\HttpClient\Contracts\Tests;

use HughCube\Laravel\HttpClient\Contracts\Tests\Package\Manager;
use HughCube\Laravel\HttpClient\Contracts\Tests\Package\Package;

class FacadeTest extends TestCase
{
    public function testIsFacade()
    {
        $this->assertInstanceOf(Manager::class, Package::getFacadeRoot());
    }
}
