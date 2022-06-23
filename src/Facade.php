<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/4/18
 * Time: 10:31 下午.
 */

namespace HughCube\Laravel\HttpClient\Contracts;

use HughCube\GuzzleHttp\LazyResponse;
use HughCube\Laravel\ServiceSupport\LazyFacade;
use Illuminate\Support\Str;

/**
 * Class Package.
 *
 * @method static Client client(string $name = null)
 * @method static LazyResponse request(Request $request)
 *
 * @see \HughCube\Laravel\HttpClient\Contracts\Manager
 * @see \HughCube\Laravel\HttpClient\Contracts\ServiceProvider
 */
abstract class Facade extends LazyFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    public static function getFacadeAccessor(): string
    {
        return lcfirst(Str::afterLast(static::class, '\\'));
    }
}
