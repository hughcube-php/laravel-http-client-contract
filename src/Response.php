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

    private $bodyArray;

    public function __construct(LazyResponse $httpResponse)
    {
        $this->httpResponse = $httpResponse;
    }

    public function getHttpResponse(): LazyResponse
    {
        return $this->httpResponse;
    }

    abstract public function getCode();

    abstract public function getMessage();

    abstract public function isSuccess(): bool;

    public function getBodyArray(): ?array
    {
        if (null === $this->bodyArray) {
            $this->bodyArray = $this->httpResponse->toArray();
        }
        return $this->bodyArray;
    }

    public function __get($name)
    {
        return $this->getBodyArray()[$name] ?? null;
    }
}
