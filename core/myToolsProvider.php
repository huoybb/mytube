<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/14
 * Time: 22:11
 */

namespace core;


class myToolsProvider extends myProvider
{

    public function register($name)
    {
        $this->di->setShared($name,function(){
            $mytools = new myTools();
            return $mytools;
        });
    }
}