<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/10/29
 * Time: 10:49
 */

namespace core;


use Phalcon\Di;
use Phalcon\Mvc\Url;

abstract class myPresenter
{
    protected $entity;
    protected $di;
    /**
     * @var Url
     */
    protected $url;

    /**通用的presenter模式
     * http://mylara.zhaobing/tags/presenter
     * myPresenter constructor.
     * @param $entity
     */
    public function __construct($entity,Di $di)
    {
        $this->entity = $entity;
        $this->di = $di;
        $this->url = $this->di->get('url');
    }

    /**
     * @param $property
     * @return mixed
     */
    public function __get($property)
    {
        if(method_exists($this,$property)){
            return $this->{$property}();
        }

        if(property_exists($this->entity,$property)) {
            return $this->entity->$property;
        }
    }
    /**
     * @param $url
     * @param $title
     * @return string
     */
    protected function createLink($url, $title):string
    {
        return "<a href='{$url}'>$title</a>";
    }

    protected function youtubePrefix($url)
    {
        return 'https://www.youtube.com' . $url;
    }
}