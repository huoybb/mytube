<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/3
 * Time: 14:51
 */
class isCommentValid extends \core\myMiddleware
{

    public function isValid(): bool
    {
        $content = trim($this->request->getPost('content'));
        if(!$content){
            $this->flash->error('评论不能为空，请重新填写评论');
            $this->redirectBack();
            return false;
        }
        return true;
    }
}