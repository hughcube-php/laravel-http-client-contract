<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/4/6
 * Time: 12:17.
 */

namespace HughCube\Laravel\HttpClient\Contracts\Tests\Package;

use HughCube\Laravel\HttpClient\Contracts\Facade;
use HughCube\Laravel\HttpClient\Contracts\Tests\Package\Apis\QueryRequest;

/**
 * @method static QueryRequest createQueryRequest();
 */
class Package extends Facade
{
}
