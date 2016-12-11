<?php
namespace core;
use Phalcon\Di\FactoryDefault;

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/6/6
 * Time: 11:23
 */
class myDI extends FactoryDefault
{
//    public function __construct()
//    {
//        $di = self::$_default;
//        if (!$di) {
//            self::$_default = $this;
//        }
//        parent::__construct();
//    }

    public function register($providers, $config = null)
    {
        foreach($providers as $name => $provider){
            $provider = new $provider($this);
            /** @var myProvider $provider */
            $provider->register($name);
        }
    }
    public static function make($serviceName){
        return static::getDefault()->get($serviceName);
    }
}