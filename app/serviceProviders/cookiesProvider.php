<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/7/12
 * Time: 8:42
 */

namespace serviceProviders;


use core\myProvider;
use Phalcon\Http\Response\Cookies;

class cookiesProvider  extends myProvider
{
    public function setService()
    {
        return function(){
            $cookies = new Cookies();
//            $cookies->useEncryption(false);
            return $cookies;
        };
    }
}