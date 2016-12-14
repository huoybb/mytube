<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/14
 * Time: 18:48
 */

namespace core;


use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Mvc\Dispatcher;
use ReflectionMethod;

class myModelBinding implements InjectionAwareInterface
{
    /**
     * @var myDI
     */
    protected $di;
    public function handle(Dispatcher $dispatcher = null)
    {
        $dispatcher = $dispatcher ?: $this->getDi()->get('dispatcher');
        $reflection = new ReflectionMethod($dispatcher->getControllerClass(), $dispatcher->getActiveMethod());
        $actionParams = [];
        foreach($reflection->getParameters() as $parameter){
            $actionParams[$parameter->name] = $this->getParameterValue($parameter,$dispatcher);
        }
        if(count($actionParams)){
            $dispatcher->setParams($actionParams);
        }
        return true;//需要返回这个处理值吗？
    }

    private function getParameterValue(\ReflectionParameter $parameter, Dispatcher $dispatcher)
    {
        $objectId = $this->getRouteValueOrDefaultValue($parameter,$dispatcher);

        if($this->parameterHasClassHint($parameter)){
//            $className = $this->getProvider($parameter->getClass()->name);//这里可以变成Di的getProvider的功能，增加Di注入的功能
            $className = $parameter->getClass()->name;

            if($objectId) return $this->instantiateClassWithID($className,$objectId);
            return new $className;
        }
        return  $objectId;
    }
    private function getRouteValueOrDefaultValue(\ReflectionParameter $parameter, Dispatcher $dispatcher)
    {
        $objectId = $dispatcher->getParam($parameter->name);
        if(null == $objectId && $parameter->isDefaultValueAvailable()) $objectId = $parameter->getDefaultValue();
        return $objectId;
    }
    private function parameterHasClassHint(\ReflectionParameter $parameter)
    {
        return $parameter->getClass();
    }
    private function instantiateClassWithID($className, $objectId)
    {
        if(is_subclass_of($className,\Phalcon\Mvc\Model::class)) {
            $instance =  $className::findFirst($objectId);
            if($instance) return $instance;
            throw new \Exception("你查找的资源{$className}::{$objectId}，不存在");
        }
        return  new $className($objectId);
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
}