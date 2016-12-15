<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/6/6
 * Time: 17:08
 */

namespace serviceProviders;


use core\myDI;
use core\myProvider;

class eventsManagerProvider extends myProvider
{

    public function setService()
    {
        return function(){
            /** @var myDI $this */
            return include APP_PATH . '/app/config/events.php';
        };
    }
}