<?php
namespace core;

use Phalcon\Http\Request;
use Phalcon\Http\Response;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Router;
use ReflectionMethod;

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2015/3/21
 * Time: 9:30
 * 核心功能如下：
 * 1、中间件的实现
 * 2、模型绑定，model binding的实现，可以在action函数中指定绑定的类型，类似laravel 5.2 提供的一样
 * 3、模型绑定基础上，实现接口绑定
 */

class myRouter extends Router{
    /**
     * @var array
     */
    public $middlewares = [];

    public $middlewaresForEveryRoute = [];

    public $serviceProvider = [];

    protected $stack = [];
    /**
     * myRouter constructor.
     */
    public function __construct($defaultRoutes = false)
    {
        parent::__construct($defaultRoutes);
        if(getMyEnv() == 'web'){
            //        ---------解决中文url不稳定的问题----------
            $this->setUriSource(Router::URI_SOURCE_SERVER_REQUEST_URI);//这种形式对比$_GET('_url')的要稳定，这个函数没有urldecode()，需要手动执行
            $_SERVER['REQUEST_URI'] = urldecode($_SERVER['REQUEST_URI']);
            //       ---------解决中文url不稳定的问题----------
        }

    }


    /**
     * 主要是增加了一个中间件的功能，利用short syntax来增加中间件，这样的好处是路由、中间件在一起，便于管理
     * @param $pattern
     * @param string $path
     * @param array $middleware
     * @return myRoute
     */
    public function addx(string $pattern,string $path,string $routeName=null,array $middleware=[],$httpMethods = null)//给路由添加中间件
    {
        $route = $this->add($pattern,$path,$httpMethods);
        if($routeName) $route->setName($routeName);
        $this->setRouteMiddlewares($route,$middleware);
        return new myRoute($route,$this);
    }

    public function addPost($pattern, $path = null,$routeName = null,$middleware=[] )
    {
        return $this->addx($pattern,$path,$routeName,$middleware,'POST');
    }

    public function addGet($pattern, $path = null,$routeName = null,$middleware=[] )
    {
        return $this->addx($pattern,$path,$routeName,$middleware,'GET');
    }


    public function group(array $middleware,$callback)
    {
        $this->addMiddlewareToStack($middleware);
        if(is_callable($callback)) call_user_func($callback,$this);
        $this->popMiddlewareFromStack();
    }

    /**中间件过滤检查：
     * 1、识别出适用所有路由的中间件，
     * 2、允许设置排除的几个典型路由的检查，特别是针对所有路由都适用的中间件，对login等几个路由应该可以排除
     * 3、针对当前路由，识别有哪些中间件适用；
     * 4、如果没有通过中间件的检查，则根据中间件提供的redirectUrl进行路由跳转
     * @param Request $request
     * @param Response $response
     * @return bool
     */
    public function executeMiddleWareChecking(Request $request, Response $response, Dispatcher $dispatcher)
    {
        $route = $this->getMatchedRoute();
        if(null == $route){//没有找到正确的路由，无效路由，可以由notFound函数来处理
            return true;
        }

        if($this->hasMatchedMiddleWares($route->getRouteId())){
            $middleWares = $this->getMiddleWares($route->getRouteId());
            foreach($middleWares as $middleWareString){
                list($data,$validator) = $this->getValidatorAndData($middleWareString,$dispatcher);
                if(method_exists($validator,'before') && $validator->before()) return true;
                if(! $validator->isValid($data)) return false;
            }
        }
        return true;
    }

    /**将router中参数，按照controller的中Action的类型参数进行绑定
     * 基本原理是重新设置Dispatcher的参数，以便能够与Controller中的Action对应上
     * @param Dispatcher $dispatcher
     */
    public function executeModelBinding(Dispatcher $dispatcher)
    {
        $reflection = new ReflectionMethod($dispatcher->getControllerClass(), $dispatcher->getActiveMethod());
        $actionParams = [];
        foreach($reflection->getParameters() as $parameter){
            $actionParams[$parameter->name] = $this->getParameterValue($parameter,$dispatcher);
        }
        if(count($actionParams)){
            $dispatcher->setParams($actionParams);
        }
    }


// ----------   提供接口绑定, 从interface 到class的绑定----------

    /**
     * @param $key
     * @param $provider
     */
    public function bindProvider($key, $provider)
    {
        $this->serviceProvider[$key]=$provider;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getProvider($key)
    {
        if(isset($this->serviceProvider[$key])) return $this->serviceProvider[$key];
        return $key;
    }

//---------------命令行中的关于路由的表格生成所需数据-----------
    /**
     * @return array
     */
    public function getTableData($filter=null,$order = null)
    {
        $regex = '|'.$filter.'|i';

        $header = ['pattern','path','middleware','httpMethods','name'];
        $content = [];
        foreach($this->getRoutes() as $route){
            /** @var Router\Route $route */
            $name = $route->getName();
            $pattern = $route->getPattern();
            $path = $this->getPathString($route->getPaths());
            $httpMethods = $this->getHttpMethodsString($route->getHttpMethods());
            $middleWares = $this->getMiddleWaresString($route);
//            $content[]=[$pattern,$path,$middleWares,$httpMethods,$name];
            $content[]=compact('pattern','path','middleWares','httpMethods','name');
        }
        $content = collect($content);

        if($order) $content = $content->sortBy($order);

        if($filter) $content = $content->filter(function($route) use($regex){
            return preg_match($regex,$route['name']);
        });

        return [$header,$content->toArray(),count($this->getRoutes()),$content->count()];
    }
//--------------helper functions for Middleware-----------------------------------------

    /**判断是否存在对应的中间件
     * @param $route_id
     * @return bool
     */
    private function hasMatchedMiddleWares($route_id)
    {
        return isset($this->middlewares[$route_id]);
    }

    /**获得指定的中间件字符串
     * @param $route_id
     * @return array
     *
     *
     */
    private function getMiddleWares($route_id)
    {
        if(isset($this->middlewares[$route_id])) return $this->middlewares[$route_id];
        return null;
    }

    private function getPathString(array $path)
    {
        return $path['controller'].'::'.$path['action'];
    }

    private function getHttpMethodsString($getHttpMethods)
    {
        if(is_array($getHttpMethods)) return '['.implode(',',$getHttpMethods).']';
        if(!$getHttpMethods) return null;
        return '['.$getHttpMethods.']';
    }

    private function getMiddleWaresString(Router\Route $route)
    {
        if(is_array($this->getMiddleWares($route->getRouteId()))) return '['.implode(',',$this->getMiddleWares($route->getRouteId())).']';
        return null;
    }

    private function addMiddlewareToStack($middleware)
    {
        array_unshift($this->stack,$middleware);
    }

    private function popMiddlewareFromStack()
    {
        array_pop($this->stack);
    }

    public function setRouteMiddlewares(Router\RouteInterface $route, array $middleware)
    {
        $middleware = $this->mergeStackedMiddlewares($middleware);
        $this->middlewares[$route->getRouteId()]=$middleware;
        return $this;
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

    private function mergeStackedMiddlewares($middleware)
    {
        if(!empty($this->stack)) $middleware = array_merge($middleware,$this->stack[0]);
        return $middleware;
    }

    private function getParameterValueFromDispatcher(\ReflectionParameter $parameter, Dispatcher $dispatcher)
    {
        return $dispatcher->getParam($parameter->name);;
    }

    /**
     * @param $objectId
     * @param $parameter
     * @return bool
     */
    private function hasNoRouteValueAndHasDefaultParameterValue($objectId, \ReflectionParameter $parameter): bool
    {
        return null == $objectId && $parameter->isDefaultValueAvailable();
    }

    private function getRouteValueOrDefaultValue(\ReflectionParameter $parameter, Dispatcher $dispatcher)
    {
        $objectId = $this->getParameterValueFromDispatcher($parameter,$dispatcher);
        if($this->hasNoRouteValueAndHasDefaultParameterValue($objectId, $parameter)) $objectId = $parameter->getDefaultValue();
        return $objectId;
    }

    private function parameterHasClassHint(\ReflectionParameter $parameter)
    {
        return $parameter->getClass();
    }

    private function getParameterValue(\ReflectionParameter $parameter, Dispatcher $dispatcher)
    {
        $objectId = $this->getRouteValueOrDefaultValue($parameter,$dispatcher);

        if($this->parameterHasClassHint($parameter)){
            $className = $this->getProvider($parameter->getClass()->name);

            if($objectId) return $this->instantiateClassWithID($className,$objectId);
            return new $className;
        }
        return  $objectId;
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

}