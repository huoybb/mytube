<?php

use Phalcon\Mvc\Controller;

/**
 * Class ControllerBase
 * * @property \core\myEventsManager $eventsManager
 * * @property \core\myAuth $auth
 */
class ControllerBase extends Controller
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
