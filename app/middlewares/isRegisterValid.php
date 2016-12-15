<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/15
 * Time: 12:39
 */
class isRegisterValid extends \core\myValidation
{
    protected $rules = [
        'email'=>' required | email',
        'name'=> 'required',
        'password'=>'required',
        'repeatPassword'=>'required',
    ];

}