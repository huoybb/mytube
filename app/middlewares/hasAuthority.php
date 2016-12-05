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
        if($this->auth->owns($object)) return true;

        $this->flash->error('你没有权限删除此视频');
        $this->redirectBack();
        return false;
    }
}