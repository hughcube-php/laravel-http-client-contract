<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/4/6
 * Time: 12:19.
 */

namespace HughCube\Laravel\HttpClient\Contracts\Tests\Package\Apis;

use GuzzleHttp\RequestOptions;
use HughCube\Laravel\HttpClient\Contracts\Tests\Package\Request;

/**
 * @method QueryResponse request()
 */
class QueryRequest extends Request
{
    public function getUri(): string
    {
        return '/s';
    }

    public function withWd(string $wd): QueryRequest
    {
        $this->httpOptions[RequestOptions::QUERY]['wd'] = $wd;

        return $this;
    }
}
