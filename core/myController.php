<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/8
 * Time: 7:56
 */

namespace core;


use Phalcon\Mvc\Controller;

class myController extends Controller
{
    protected function redirectBack()
    {
        $url = $this->request->getServer('HTTP_REFERER');
        return $this->response->redirect($url, true);
    }

    protected function redirect(array $routeArray)
    {
        $url = $this->url->get($routeArray);
        return $this->response->redirect($url, true);
    }
}