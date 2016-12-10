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
        //todo 中间件技术的重新思考
        //  这里可以将模型绑定与身份验证以及权限检查等活动都统一用中间件技术来一并提供的，需要重新构建所谓的中间件
        //  针对不同事情可以在不同的节点去执行，包括类似log的工作应该也是可以在这里来完成的，值得好好研究一下的

        $this->di->setShared($name,function(){
            /** @var myDI $this */
            $eventsManager = $this->get('eventsManager');

            $eventsManager->attach("dispatch:beforeDispatchLoop", function(Event $event, Dispatcher $dispatcher){
                /** @var myDI $this */
                //模型注入的功能，这里可以很方便的进行 model binding,这里基本上实现了Laravel中的模型绑定的功能了
                /** @var \core\myRouter $router */
                $router = $this->get('router');
                return $router->executeModelBinding($dispatcher);
            });

            $eventsManager->attach('dispatch:beforeExecuteRoute',function(Event $event,Dispatcher $dispatcher){
                /** @var myDI $this */
                /** @var \core\myRouter $router */
                $router = $this->get('router');
//                $router->handle();
                return $router->executeMiddleWareChecking($this->get('request'), $this->get('response'),$dispatcher);
            });
            $dispatcher = new Dispatcher();
            $dispatcher->setEventsManager($eventsManager);
            return $dispatcher;
        });
    }
}