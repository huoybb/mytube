<?php

class ErrorController extends \core\myController
{


    public function notFoundAction()
    {
        $this->view->myurl = $this->router->getRewriteUri();
    }
    public function resourceNotFoundAction()
    {
        $this->view->message = $this->dispatcher->getParam('message');
        return $this->view->render('error','resourceNotFound');//因为打断了正常的流程，需要手动来设置
    }


}

