<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/6
 * Time: 4:55
 */
class isMovieValid extends \core\myMiddleware
{

    public function isValid($movie): bool
    {
        if(!$movie->title) return false;
        return true;
    }
}