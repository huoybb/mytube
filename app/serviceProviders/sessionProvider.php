<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/6/6
 * Time: 12:21
 */

namespace serviceProviders;


use core\myDI;
use core\myProvider;
use Phalcon\Session\Adapter\Files as SessionAdapter;

class sessionProvider extends myProvider
{
    public function setService()
    {
        return function () {
            $session = new SessionAdapter();
            $session->start();

            return $session;
        };
    }
}