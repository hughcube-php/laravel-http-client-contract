<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/8/12
 * Time: 16:33.
 */

namespace HughCube\Laravel\HttpClient\Contracts;

use GuzzleHttp\RequestOptions;
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

        $this->initialize();
    }

    protected function initialize()
    {
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getHttpOptions(): array
    {
        return $this->httpOptions;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    abstract public function getUri(): string;

    protected function createResponse(LazyResponse $response): Response
    {
        $class = sprintf('%sResponse', Str::beforeLast(static::class, 'Request'));

        return new $class($response, $this);
    }

    public function request(): Response
    {
        return $this->createResponse($this->getClient()->request($this));
    }

    /**
     * @return $this
     */
    public function when($when, callable $callable): Request
    {
        if ($when) {
            $callable($this);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function whenEmpty($value, callable $callable): Request
    {
        if (empty($value)) {
            $callable($value, $this);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function whenNotEmpty($value, callable $callable): Request
    {
        if (!empty($value)) {
            $callable($value, $this);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function whenNull($value, callable $callable): Request
    {
        if (null === $value) {
            $callable($value, $this);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function whenNotNull($value, callable $callable): Request
    {
        if (null !== $value) {
            $callable($value, $this);
        }

        return $this;
    }

    /**
     * @param  int|string  $name
     * @param  mixed  $value
     *
     * @return $this
     */
    public function with($name, $value): Request
    {
        $this->httpOptions[$name] = $value;

        return $this;
    }

    /**
     * @param  string|mixed  $value
     *
     * @return $this
     */
    public function withBaseUri($value): Request
    {
        return $this->with('base_uri', $value);
    }

    /**
     * @param  int|string  $name
     * @param  mixed  $value
     *
     * @return $this
     */
    public function withQueryValue($name, $value): Request
    {
        $this->httpOptions[RequestOptions::QUERY][$name] = $value;

        return $this;
    }

    /**
     * @param  int|string  $name
     * @param  mixed  $value
     *
     * @return $this
     */
    public function withJsonValue($name, $value): Request
    {
        $this->httpOptions[RequestOptions::JSON][$name] = $value;

        return $this;
    }

    /**
     * @param  int|string  $name
     * @param  mixed  $value
     *
     * @return $this
     */
    public function withFormValue($name, $value): Request
    {
        $this->httpOptions[RequestOptions::FORM_PARAMS][$name] = $value;

        return $this;
    }
}
