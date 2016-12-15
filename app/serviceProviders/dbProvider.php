<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/6/6
 * Time: 12:15
 */

namespace serviceProviders;


use core\myProvider;

class dbProvider extends myProvider
{
    public function setService()
    {
        return function () {
            $config = $this->get('config');
            $dbConfig = $config->database->toArray();
            $adapter = $dbConfig['adapter'];
            unset($dbConfig['adapter']);
            $class = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;
            return new $class($dbConfig);
        };
    }
}