<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/6/6
 * Time: 12:22
 */

namespace serviceProviders;


use core\myDI;
use core\myException;
use core\myMiddleWareChecking;
use core\myModelBinding;
use core\myProvider;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;

class dispatcherProvider extends myProvider
{
    public function setService()
    {
        return function(){
            $dispatcher = new Dispatcher();

            /** @var myDI $this */
            $eventsManager = $this->get('eventsManager');

            $eventsManager->attach("dispatch:beforeDispatchLoop", function(Event $event, Dispatcher $dispatcher){
                /** @var myDI $this */
                return $this->get(myModelBinding::class)->handle();
            });

            $eventsManager->attach('dispatch:beforeExecuteRoute',function(Event $event,Dispatcher $dispatcher){
                /** @var myDI $this */
                return $this->get(myMiddleWareChecking::class)->handle();
            });

            $eventsManager->attach('dispatch:beforeException',new myException());

            $dispatcher->setEventsManager($eventsManager);
            return $dispatcher;
        };
    }
}