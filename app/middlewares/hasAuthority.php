<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/5
 * Time: 21:47
 */
class hasAuthority extends \core\myMiddleware
{
    public function before()
    {
        //管理员有一切权利
        if($this->auth->isAdmin()) return true;
    }

    public function isValid($object): bool
    {
        if($this->auth->owns($object)) return true;

        $this->flash->error('你没有权限进行“修改或删除”操作');
        $this->redirectBack();
        return false;
    }
}