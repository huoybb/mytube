<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/6/30
 * Time: 20:38
 */
namespace serviceProviders;


use core\myDI;
use core\myProvider;

class gateProvider extends myProvider
{
    public function setService()
    {
        return function(){
            return include APP_PATH . "/app/config/policyGate.php";
        };
    }
}