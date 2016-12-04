<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/5
 * Time: 6:04
 */
class MoviesForm extends \core\myForm
{
    protected $exludedFields = [
        'created_at','updated_at','key','id'
    ];
}