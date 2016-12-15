<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/6/6
 * Time: 12:05
 */

namespace serviceProviders;


use core\myDI;
use core\myProvider;
use Phalcon\Mvc\Url as UrlResolver;


class urlProvider extends myProvider
{
    public function setService()
    {
        return function () {
            /**@var myDI $this */
            $url = new UrlResolver();
            $url->setBaseUri($this->get('config')->application->baseUri);
            return $url;
        };
    }
}