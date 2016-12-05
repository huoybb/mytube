<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/5
 * Time: 19:09
 */
class TaggablesEventsHandler
{
    public function whenMovieDeleted(MovieDeleted $event)
    {
        $taggables = Taggables::findByObject($event->movie);
        $taggables->delete();
    }

}