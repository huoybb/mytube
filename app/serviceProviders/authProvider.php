<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/7/12
 * Time: 8:47
 */

namespace serviceProviders;


use core\myProvider;
use core\myAuth;

class authProvider extends myProvider
{
    public function setService()
    {
        return function(){
            //奇怪，这里的this是Di这个对象，看看怎么回事，也类似javascript一样吗？
            //估计这种方式的调用是用：call_user_function([$this,callback])的形式调用的，所以这里的$this指向Di
            $auth = (new myAuth())->setDI($this)->init();
            return $auth;
        };
    }
}