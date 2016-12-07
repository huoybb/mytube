<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/6
 * Time: 12:11
 */
use Illuminate\Support\Debug\Dumper;

if(! function_exists('auth')){
    /**
     * @return \core\myAuth
     */
    function auth(){
        return \core\myDI::getDefault()->get('auth');
    }
}
if(! function_exists('url')){
    /**
     * @param array $routeArray
     * @return string
     */
    function url(array $routeArray){
        return \core\myDI::getDefault()->get('url')->get($routeArray);
    }
}


if (! function_exists('dd')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed
     * @return void
     */
    function dd()
    {
        array_map(function ($x) {
            (new Dumper)->dump($x);
        }, func_get_args());

        die(1);
    }
}