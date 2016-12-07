<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/6/6
 * Time: 12:22
 */

namespace serviceProviders;


use core\myDI;
use core\myProvider;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;

class dispatcherProvider extends myProvider
{

    public function register($name)
    {

        $this->di->setShared($name,function(){
            /** @var myDI $this */
            $eventsManager = $this->get('eventsManager');
            $eventsManager->attach("dispatch:beforeDispatchLoop", function(Event $event, Dispatcher $dispatcher){
                //模型注入的功能，这里可以很方便的进行 model binding,这里基本上实现了Laravel中的模型绑定的功能了
                return $this->di->get('router')->executeModelBinding($dispatcher);
            });
            $eventsManager->attach('dispatch:beforeExecuteRoute',function(Event $event,Dispatcher $dispatcher){
                return $this->di->get('router')->executeMiddleWareChecking(
                    $this->di->get('request'), $this->di->get('response'),$dispatcher);
            });

            $dispatcher = new Dispatcher();
            $dispatcher->setEventsManager($eventsManager);
            return $dispatcher;
        });
    }
}