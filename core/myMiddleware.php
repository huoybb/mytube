<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/3
 * Time: 13:32
 */

namespace core;


use Phalcon\Di;
use Phalcon\DiInterface;


/**
 * Class myMiddleware
 * @package core
 *
 * @property \Phalcon\Mvc\Router|\Phalcon\Mvc\RouterInterface $router
 * @property \Phalcon\Mvc\Url|\Phalcon\Mvc\UrlInterface $url
 * @property \Phalcon\Http\Request|\Phalcon\Http\RequestInterface $request
 * @property \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface $response
 * @property \Phalcon\Http\Response\Cookies|\Phalcon\Http\Response\CookiesInterface $cookies
 * @property \Phalcon\Security $security
 * @property \Phalcon\Flash\Session $flash
 * @property \Phalcon\Session\Adapter\Files|\Phalcon\Session\Adapter|\Phalcon\Session\AdapterInterface $session
 * @property myAuth auth
 */
abstract class myMiddleware implements Di\InjectionAwareInterface
{
    public static function over($objectstring)
    {
        return static::class . ':' . $objectstring;
    }

    public function redirect($routeArray)
    {
        $url = $this->url->get($routeArray);
        return $this->response->redirect($url);
    }
    public function redirectBack()
    {
        $url = $this->request->getServer('HTTP_REFERER');
        return $this->response->redirect($url);
    }


    abstract  public function isValid($object):bool;

     /**
      * Sets the dependency injector
      *
      * @param DiInterface $di
      */
     public function setDI(DiInterface $di)
     {
         $this->di = $di;
     }

     /**
      * Returns the internal dependency injector
      *
      * @return DiInterface
      */
     public function getDI()
     {
         return $this->di;
     }
     public function __get($proptery)
     {
         return $this->getDI()->get($proptery);
     }
}