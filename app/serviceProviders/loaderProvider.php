<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/8
 * Time: 6:07
 */

namespace serviceProviders;


use core\myProvider;

class loaderProvider extends myProvider
{
    public function setService()
    {
        return function(){
            return include APP_PATH . '/app/config/loader.php';
        };
    }
}