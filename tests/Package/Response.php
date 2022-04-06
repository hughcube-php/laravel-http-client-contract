<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/4/6
 * Time: 12:20.
 */

namespace HughCube\Laravel\HttpClient\Contracts\Tests\Package;

class Response extends \HughCube\Laravel\HttpClient\Contracts\Response
{
    public function getCode()
    {
        return $this->getHttpResponse()->getStatusCode();
    }

    public function getMessage(): string
    {
        return 'ok';
    }

    public function isSuccess(): bool
    {
        return 200 === $this->getCode();
    }
}
