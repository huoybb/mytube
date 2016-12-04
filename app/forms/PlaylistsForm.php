<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/5
 * Time: 7:25
 */
class PlaylistsForm extends \core\myForm
{
    protected $exludedFields = [
        'created_at','updated_at','id','key'
    ];
}