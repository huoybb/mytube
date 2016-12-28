<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/28
 * Time: 22:47
 */

namespace serviceProviders;


use core\myDI;
use core\myProvider;
use Phalcon\Cache\Backend\Redis;
use Phalcon\Cache\Frontend\Output as OutputFrontend;
class viewCacheProvider extends myProvider
{

    public function setService()
    {
        return function(){
            // Cache data for one day by default
            //@reference https://forum.phalconphp.com/discussion/13699/cache-performance-comparison-file-vs-memcache-vs-apc-vs-mongo-vs
            //这里有相关的说明，感觉statskey这个东西没有怎么搞明白，为什么需要这个东西呢？估计得看源代码否则比较难理解呀!
            $frontCache = new OutputFrontend(
                [
                    "lifetime" => 86400,
                ]
            );

            $cache = new Redis($frontCache,[
                'host' => '127.0.0.1',
                'port' => 6379,
                "statsKey" => 'mytube'
            ]);
            return $cache;
        };
    }
}