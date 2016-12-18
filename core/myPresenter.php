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
    protected function createLink($url, $title,$class = null,$disabled = null):string
    {
        if($disabled == "disabled") $disabled = "disabled='{$disabled}'";
        if($class)  $class = "class='{$class}'";
        return "<a href='{$url}' {$class} {$disabled} >$title</a>";
    }

    protected function youtubePrefix($url)
    {
        return 'https://www.youtube.com' . $url;
    }

    /**
     * @param array $items
     * $item = ['url','value','isActive']
     */
    protected function buildBreadcrumbs(array $items): string
    {
        $result = '<ol class="breadcrumb">';
        foreach ($items as $item) {
            if ($item['isActive']) {
                $result .= "<li class=\"active\">{$item['value']}</li>";
            } else {
                $result .= "<li><a href=\"{$item['url']}\">{$item['value']}</a></li>";
            }
        }
        $result .= '</ol>';
        return $result;
    }
    protected function url(array $routeArray){
        return $this->url->get($routeArray);
    }

    /**
     * @param $items
     * $items = [['url'=>'xxx.url','title'=>'想看']]
     * @return string
     */
    protected function buildArrayOfLinkButtons(array $items): string
    {
        return collect($items)->map(function ($item) {
            if(isset($item['disabled'])) return $this->createLink($item['url'], $item['title'], $item['class'],$item['disabled']);
            return $this->createLink($item['url'], $item['title'], $item['class']);
        })->implode(' ');
    }

    /**
     * 将上面这个一组buttons变成一个group，更加容易管理和查看
     * @param $ArrayOfLinkButtonsString
     * @return string
     */
    protected function insertButtonsToGroup($ArrayOfLinkButtonsString)
    {
        return "<div class='btn-group'>{$ArrayOfLinkButtonsString}</div>";
    }
}