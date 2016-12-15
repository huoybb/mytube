<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/6/6
 * Time: 12:16
 */

namespace serviceProviders;


use core\myDI;
use core\myProvider;
use Phalcon\Mvc\Model\MetaData\Memory;

class modelsMetadataProvider extends myProvider
{
    public function setService()
    {
        return function () {
            return new Memory();
        };
    }
}