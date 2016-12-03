<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/3
 * Time: 17:03
 */
class isTagValid extends \core\myMiddleware
{

    public function isValid(): bool
    {
        $tag = trim($this->request->getPost('name'));
        if(!$tag) {
            $this->flash->error('标签不能为空，请重新填写');
            $this->redirectBack();
            return false;
        }
        return true;
    }
}