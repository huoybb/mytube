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
use Phalcon\FlashInterface;
use Phalcon\Http\Request;
use Phalcon\Http\Response;
use Phalcon\Mvc\Url;
use Phalcon\Session\Adapter\Files as SessionAdapter;

abstract class myMiddleware implements Di\InjectionAwareInterface
{


    /**
     * @return myAuth
     */
    public function auth()
    {
        return $this->getDI()->get('auth');
    }

    /**
     * @return Url
     */
    public function url()
    {
        return $this->getDI()->get('url');
    }

    /**
     * @return Request
     */
    public function request()
    {
        return $this->getDI()->get('request');
    }

    /**
     * @return Response
     */
    public function response()
    {
        return $this->getDI()->get('response');
    }

    /**
     * @return myRouter
     */
    public function router()
    {
        return $this->getDI()->get('router');
    }

    /**
     * @return SessionAdapter
     */
    public function session()
    {
        return $this->getDI()->get('session');
    }

    /**
     * @return FlashInterface
     */
    public function flash()
    {
        return $this->getDI()->get('flash');
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
         if(method_exists($this,$proptery)) return call_user_func([$this,$proptery]);
         return $this->getDI()->get($proptery);
     }

 }