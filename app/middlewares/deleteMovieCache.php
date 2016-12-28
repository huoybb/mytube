<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/28
 * Time: 23:20
 */
class deleteMovieCache extends \core\myMiddleware
{

    public function isValid($object): bool
    {
        /** @var Movies $object */
        if($object instanceof Movies){
            $this->view->getCache()->delete($object->getCacheKey());
        }
        return true;
    }
}