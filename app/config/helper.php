<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/6
 * Time: 12:11
 */

/**
 * @return \core\myAuth
 */
function auth()
{
    return \Phalcon\Di::getDefault()->get('auth');
}
