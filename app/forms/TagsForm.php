<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/5
 * Time: 6:50
 */
class TagsForm extends \core\myForm
{
    protected $exludedFields = [
        'created_at','updated_at','id'
    ];
    public $rules = ['name'=>'required'];
}