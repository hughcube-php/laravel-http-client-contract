<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/4/20
 * Time: 4:21 下午.
 */

namespace HughCube\Laravel\HttpClient\Contracts;

use Closure;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\RequestOptions;
use HughCube\GuzzleHttp\Client as HttpClient;
use HughCube\GuzzleHttp\HttpClientTrait;
use HughCube\GuzzleHttp\LazyResponse;
use Illuminate\Support\Arr;
use Psr\Http\Message\RequestInterface;

class Client
{
    use HttpClientTrait;

    /**
     * @var array
     */
    protected $config;

    public function __construct(array $config)
    {
        $this->config = array_replace_recursive($this->defaultConfig(), $config);
    }

    protected function defaultConfig(): array
    {
        return [];
    }

    protected function createHttpClient(): HttpClient
    {
        $config = $this->config['http'] ?? [];

        $config['handler'] = HandlerStack::create();
        $this->pushHttpRequestHandlers($config['handler']);
        $config['handler']->push($this->getHttpHostResolveHandler(), 'httpHostResolveHandler');

        return new HttpClient($config);
    }

    protected function pushHttpRequestHandlers(HandlerStack $stack)
    {
    }

    protected function getHttpHostResolveHandler(): Closure
    {
        return function (callable $handler) {
            return function (RequestInterface $request, array $options) use ($handler) {

                if (!$request->hasHeader('Host')) {
                    $request = $request->withHeader('Host', $request->getUri()->getHost());
                }

                $host = $request->getUri()->getHost();
                if (!empty($resolve = Arr::get($this->config, "http.resolves.$host"))) {
                    $request = $request->withUri($request->getUri()->withHost($resolve), true);
                }

                /** When YOU forcibly change the host using HTTPS, HTTPS authentication must be disabled. */
                $scheme = $request->getUri()->getScheme();
                if ('https' === $scheme && $request->getUri()->getHost() !== $request->getHeaderLine('Host')) {
                    $options[RequestOptions::VERIFY] = false;
                }

                return $handler($request, $options);
            };
        };
    }

    public function request(Request $request): LazyResponse
    {
        return $this->getHttpClient()->requestLazy(
            $request->getMethod(),
            $request->getUri(),
            $request->getHttpOptions()
        );
    }

//    public function createTestRequest(): TestRequest
//    {
//        return new TestRequest($this);
//    }
}
