<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/11
 * Time: 18:58
 */
class VideotagsPresenter extends \core\myPresenter
{
    /**
     * @var Videotags
     */
    protected $entity;
    public function time()
    {
        return $this->toTimeString($this->entity->time);
    }

    private function toTimeString($time)
    {
        $second = (int)$time % 60;
        $minute = (((int)$time - $second) / 60) % 60;
        $hour = ((((int)$time - $second) / 60) - $minute) / 60;

        $second = sprintf('%02d',$second);
        if($minute) $minute = sprintf('%02d',$minute);
        if($hour) $hour = sprintf('%02d',$hour);

        if(!$hour) return "{$minute}:{$second}";
        return "{$hour}:{$minute}:{$second}";
    }
    public function movie()
    {
        return $this->entity->movie()->present('showLink');
    }
    public function updated_at()
    {
        return $this->entity->updated_at->diffForHumans();
    }



}