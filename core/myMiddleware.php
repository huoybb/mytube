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
     * @var FlashInterface
     */
    protected $flash;
    public function __construct($Di = null)
    {
        $this->di = $Di ?: Di::getDefault();
        $this->auth = $this->di->get('auth');
        $this->request = $this->di->get('request');
        $this->flash = $this->di->get('flash');
    }
    public function redirect($routeArray)
    {
        $url = $this->di->get('url')->get($routeArray);
        return $this->di->get('response')->redirect($url);
    }
    public function redirectBack()
    {
        $url = $this->request->getServer('HTTP_REFERER');
        return $this->di->get('response')->redirect($url);
    }


    abstract  public function isValid():bool;

}