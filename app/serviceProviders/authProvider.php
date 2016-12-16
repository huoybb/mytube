<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/7/12
 * Time: 8:47
 */

namespace serviceProviders;


use core\myDI;
use core\myProvider;
use core\myAuth;

class authProvider extends myProvider
{
    public function setService()
    {
        return function(){
            /**@var myDI $this */
            $auth = (new myAuth())->setDI($this)->init();
            return $auth;
        };
    }
}