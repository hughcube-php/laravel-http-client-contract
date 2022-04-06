<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/4/6
 * Time: 12:18.
 */

namespace HughCube\Laravel\HttpClient\Contracts\Tests\Package;

use HughCube\Laravel\HttpClient\Contracts\Tests\Package\Apis\QueryRequest;

class Client extends \HughCube\Laravel\HttpClient\Contracts\Client
{
    public function createQueryRequest(): QueryRequest
    {
        return new QueryRequest($this);
    }
}
