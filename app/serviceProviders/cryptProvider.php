<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/6/27
 * Time: 8:42
 */

namespace serviceProviders;


use core\myProvider;
use Phalcon\Crypt;

class cryptProvider extends myProvider
{
    public function setService()
    {
        return function(){
            $crypt = new Crypt();
            $crypt->setKey('myCryptKey024025');//需要注意，key的位数，16,24,32，需要注意！
            return $crypt;
        };
    }
}