<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/3
 * Time: 13:32
 */

namespace core;


use Phalcon\Di;
use Phalcon\FlashInterface;
use Phalcon\Http\Request;
use Phalcon\Http\Response;
use Phalcon\Mvc\Url;

abstract class myMiddleware
{

    /**
     * @var \Phalcon\DiInterface
     */
    protected $di;
    /**
     * @var myAuth
     */
    protected $auth;
    /**
     * @var Request
     */
    protected $request;
    /**
     * @var Response
     */
    protected $response;
    /**
     * @var Url
     */
    protected $url;
    /**
     * @var FlashInterface
     */
    protected $flash;
    public function __construct($Di = null)
    {
        $this->di = $Di ?: Di::getDefault();
        $this->auth = $this->di->get('auth');
        $this->url = $this->di->get('url');
        $this->request = $this->di->get('request');
        $this->response = $this->di->get('response');
        $this->flash = $this->di->get('flash');
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


    abstract  public function isValid():bool;

}