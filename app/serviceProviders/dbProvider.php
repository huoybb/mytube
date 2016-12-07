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

    public function register($name)
    {
        /**
         * Database connection is created based in the parameters defined in the configuration file
         */
        $this->di->setShared($name, function () {
            $config = $this->get('config');
            $dbConfig = $config->database->toArray();
            $adapter = $dbConfig['adapter'];
            unset($dbConfig['adapter']);
            $class = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;
            return new $class($dbConfig);
        });
    }
}