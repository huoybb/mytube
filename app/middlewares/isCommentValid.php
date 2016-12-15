<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/3
 * Time: 14:51
 */
class isCommentValid extends \core\myValidation
{
    protected $rules = [
        'content'=>['required'=>'评论不能为空，请重新填写评论']
    ];
}