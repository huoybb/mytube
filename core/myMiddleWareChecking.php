<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/14
 * Time: 19:07
 */

namespace core;


use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Mvc\Dispatcher;

/**
 * Class myMiddleWareChecking
 * @package core
 *
 * @property myRouter $router
 */

class myMiddleWareChecking implements InjectionAwareInterface
{

    protected $di;

    public function handle(Dispatcher $dispatcher = null)
    {
        $dispatcher = $dispatcher ?: $this->dispatcher;

        $route = $this->router->getMatchedRoute();

        if(null == $route) return true; //没有找到正确的路由，无效路由，可以由notFound函数来处理

        if($middleWares = $this->router->getMiddleWares($route->getRouteId())){
            foreach($middleWares as $middleWareString){
                list($data,$validator) = $this->getValidatorAndData($middleWareString,$dispatcher);
                if(method_exists($validator,'before') && $validator->before()) return true;
                if(! $validator->isValid($data)) return false;
            }
        }

        return true;
    }

    private function getValidatorAndData($validator,Dispatcher $dispatcher)
    {
        $data = null;
        if(preg_match('|.*:.*|',$validator)) {//此处设置了可以带中间件参数
            list($validator,$data) = explode(':',$validator);
            $data = $dispatcher->getParam($data);
        }
        /** @var myMiddleware $validator */
        $validator = $this->getDI()->get($validator);
        return [$data,$validator];
    }

    /**
     * Sets the dependency injector
     *
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function setDI(\Phalcon\DiInterface $dependencyInjector)
    {
        $this->di = $dependencyInjector;
    }

    /**
     * Returns the internal dependency injector
     *
     * @return \Phalcon\DiInterface
     */
    public function getDI()
    {
        return $this->di;
    }
    public function __get($property)
    {
        return $this->getDI()->get($property);
    }

}