<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/7/15
 * Time: 18:25
 */

use core\myMiddleware;

class isLogin extends myMiddleware
{


    public function isValid(): bool
    {
        if($this->auth->isLogin()) return true;

        $this->redirect(['for'=>'login']);
        return false;
    }
}