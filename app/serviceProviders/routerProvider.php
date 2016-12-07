<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/6/6
 * Time: 11:33
 */

namespace serviceProviders;


use core\myDI;
use core\myProvider;

class routerProvider extends myProvider
{

    public function register($name)
    {
        $this->di->setShared($name,function(){
            /** @var myDI $this */
            return include APP_PATH . '/app/config/routes.php';
        });
    }
}