<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/5
 * Time: 21:47
 */
class hasAuthority extends \core\myMiddleware
{

    public function isValid($object): bool
    {
        if(auth()->isAdmin()) return true;
        if(auth()->owns($object)) return true;

        $this->flash->error('你没有权限进行“修改或删除”操作');
        $this->redirectBack();
        return false;
    }
    public static function over($objectstring){
        return static::class.':'.$objectstring;
    }
}