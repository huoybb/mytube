<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/6/6
 * Time: 12:22
 */

namespace serviceProviders;


use core\myDI;
use core\myDispatcherEventsHandler;
use core\myProvider;
use Phalcon\Mvc\Dispatcher;

class dispatcherProvider extends myProvider
{
    public function setService()
    {
        return function(){
            $dispatcher = new Dispatcher();
            /** @var myDI $this */
            $eventsManager = $this->get('eventsManager');
            $eventsManager->attach('dispatch',$this->get(myDispatcherEventsHandler::class));
            $dispatcher->setEventsManager($eventsManager);
            return $dispatcher;
        };
    }
}