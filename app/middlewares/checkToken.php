<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/11
 * Time: 5:09
 */
class checkToken extends \core\myMiddleware
{

    public function isValid($object): bool
    {
        if(! $this->security->checkToken()) throw new Exception('CSRF found！请重新登录页面！');
        return true;

    }
}