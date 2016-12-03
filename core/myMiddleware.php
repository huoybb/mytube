<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/3
 * Time: 13:32
 */

namespace core;


use Phalcon\Di;
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

    public function __construct($Di = null)
    {
        $this->di = $Di ?: Di::getDefault();
        $this->auth = $this->di->get('auth');
    }
    public function redirect($routeArray)
    {
        $url = $this->di->get('url')->get($routeArray);
        return $this->di->get('response')->redirect($url);
    }

    abstract  public function isValid():bool;

}