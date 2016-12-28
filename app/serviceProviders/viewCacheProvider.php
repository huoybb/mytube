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
            $frontCache = new OutputFrontend(
                [
                    "lifetime" => 86400,
                ]
            );


            $redis = new \Redis();
            $redis->connect('127.0.0.1', 6379);

            $cache = new Redis($frontCache,[
                'redis'=>$redis,
            ]);

            return $cache;
        };
    }
}