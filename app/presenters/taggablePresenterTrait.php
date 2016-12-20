<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/20
 * Time: 17:54
 */
trait taggablePresenterTrait
{
    public function tags()
    {
        /**@var \core\myPresenter $this */
        $result = '';
        foreach($this->entity->getTags() as $tag){
            $url = $this->url(['for'=>'tags.show','tag'=>$tag->id]);
            $result .= ' '.$this->createLink($url,$tag->name."({$tag->count})",'btn btn-primary btn-xs');
        }
        return $result;
    }

}