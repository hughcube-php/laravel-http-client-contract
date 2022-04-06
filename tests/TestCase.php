<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/4/20
 * Time: 11:36 下午.
 */

namespace HughCube\Laravel\HttpClient\Contracts\Tests;

use GuzzleHttp\RequestOptions;
use HughCube\Laravel\HttpClient\Contracts\Facade;
use HughCube\Laravel\HttpClient\Contracts\Tests\Package\Package;
use HughCube\Laravel\HttpClient\Contracts\Tests\Package\ServiceProvider;
use Illuminate\Config\Repository;
use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * @param  Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            ServiceProvider::class,
        ];
    }

    /**
     * @param  Application  $app
     */
    protected function getEnvironmentSetUp($app)
    {
        /** @var Repository $appConfig */
        $appConfig = $app['config'];
        $appConfig->set(Package::getFacadeAccessor(), [
            'default' => 'default',

            'defaults' => [
                'http' => [
                    RequestOptions::TIMEOUT => 10.0,
                    RequestOptions::CONNECT_TIMEOUT => 10.0,
                    RequestOptions::READ_TIMEOUT => 10.0,
                    #RequestOptions::HTTP_ERRORS => false,
                    RequestOptions::HEADERS => [
                        'User-Agent' => null,
                    ]
                ]
            ],

            'clients' => [
                'default' => [
                    'http' => [
                        'base_uri' => "https://www.baidu.com",
                    ]
                ],
            ],
        ]);
    }
}
