<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/7/12
 * Time: 20:31
 */

namespace serviceProviders;


use core\myDI;
use core\myProvider;
use Phalcon\Security;

class securityProvider extends myProvider
{
    public function setService()
    {
        return function(){
            $security = new Security();
            // Set the password hashing factor to 12 rounds
            $security->setWorkFactor(12);
            return $security;
        };
    }
}