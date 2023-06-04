<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/8/12
 * Time: 16:50.
 */

namespace HughCube\Laravel\HttpClient\Contracts;

use HughCube\GuzzleHttp\LazyResponse;

abstract class Response
{
    /**
     * @var LazyResponse
     */
    protected $httpResponse;

    /**
     * @var null|Request
     */
    protected $request = null;

    public function __construct(LazyResponse $httpResponse, $request = null)
    {
        $this->httpResponse = $httpResponse;
        $this->request = $request;
    }

    public function getHttpResponse(): LazyResponse
    {
        return $this->httpResponse;
    }

    public function getRequest(): ?Request
    {
        return $this->request;
    }

    abstract public function getCode();

    abstract public function getMessage();

    abstract public function isSuccess(): bool;

    public function getBodyArray(): ?array
    {
        return $this->httpResponse->toArray(false);
    }

    public function __get($name)
    {
        return $this->getBodyArray()[$name] ?? null;
    }
}
