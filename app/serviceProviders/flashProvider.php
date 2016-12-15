<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/6/6
 * Time: 12:19
 */

namespace serviceProviders;


use core\myProvider;
use Phalcon\Flash\Session as Flash;

class flashProvider extends myProvider
{
    public function setService()
    {
        return function () {
            return new Flash(array(
                'error'   => 'alert alert-danger',
                'success' => 'alert alert-success',
                'notice'  => 'alert alert-info',
                'warning' => 'alert alert-warning'
            ));
        };
    }
}