<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/4/6
 * Time: 14:21
 */

namespace HughCube\Laravel\HttpClient\Contracts\Tests\Apis;

use HughCube\Laravel\HttpClient\Contracts\Tests\Package\Apis\QueryRequest;
use HughCube\Laravel\HttpClient\Contracts\Tests\Package\Apis\QueryResponse;
use HughCube\Laravel\HttpClient\Contracts\Tests\Package\Package;
use HughCube\Laravel\HttpClient\Contracts\Tests\TestCase;
use Psr\Http\Message\ResponseInterface;

class QueryTest extends TestCase
{
    public function testQuery()
    {
        $request = Package::createQueryRequest();

        $this->assertInstanceOf(QueryRequest::class, $request);
        $this->assertSame($request, $request->withWd('baidu'));

        $response = $request->request();
        $this->assertInstanceOf(QueryResponse::class, $response);
        $this->assertInstanceOf(ResponseInterface::class, $response->getHttpResponse());

        $this->assertSame($response->getHttpResponse()->getStatusCode(), $response->getCode());
        $this->assertSame('ok', $response->getMessage());
        $this->assertTrue($response->isSuccess());
    }
}
