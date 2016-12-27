<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/27
 * Time: 19:49
 */

namespace core;


use core\Exceptions\ModelBindingNotFoundException;
use Exception;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\User\Plugin;

class myDispatcherEventsHandler extends Plugin
{
    public function beforeDispatchLoop(Event $event, Dispatcher $dispatcher)
    {
        return $this->getDI()->get(myModelBinding::class)->handle();
    }
    public function beforeExecuteRoute(Event $event,Dispatcher $dispatcher)
    {
        return $this->getDI()->get(myMiddleWareChecking::class)->handle();
    }
    public function beforeException(Event $event, Dispatcher $dispatcher, Exception $exception)
    {
        if($exception instanceof ModelBindingNotFoundException){
            $this->resourceNotFound($dispatcher, $exception);
            return false;
        }
        return true;
    }
    /**
     * @param Dispatcher $dispatcher
     * @param Exception $exception
     */
    protected function resourceNotFound(Dispatcher $dispatcher, Exception $exception)
    {
        $dispatcher->forward([
            'controller' => 'error',
            'action' => 'resourceNotFound',
        ]);
        $dispatcher->setParam('message', $exception->getMessage());
        $dispatcher->dispatch();//由于异常处理时中断了正常的引导过程，需要单独来重新dispatch
    }


}