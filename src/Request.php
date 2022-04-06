<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/8/12
 * Time: 16:33
 */

namespace HughCube\Laravel\HttpClient\Contracts;

use HughCube\GuzzleHttp\LazyResponse;
use Illuminate\Support\Str;

abstract class Request
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var array
     */
    protected $httpOptions = [];

    /**
     * @param  Client  $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getHttpOptions(): array
    {
        return $this->httpOptions;
    }

    abstract public function getUri(): string;

    protected function createResponse(LazyResponse $response): Response
    {
        $class = sprintf("%sResponse", Str::beforeLast(static::class, 'Request'));
        return new $class($response);
    }

    public function request(): Response
    {
        return $this->createResponse($this->client->request($this));
    }
}
