<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/27
 * Time: 15:47
 */

namespace core;
use core\Exceptions\ModelBindingNotFoundException;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;


class myException
{
    public function beforeException(Event $event,Dispatcher $dispatcher,$exception)
    {
        if($exception instanceof ModelBindingNotFoundException){
            $dispatcher->forward([
                'controller'=>'error',
                'action'=>'resourceNotFound',
            ]);
            $dispatcher->setParam('message',$exception->getMessage());
            $dispatcher->dispatch();
            return false;
        }
        return true;
    }

}