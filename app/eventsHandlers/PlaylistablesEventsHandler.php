<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/5
 * Time: 19:13
 */
class PlaylistablesEventsHandler
{
    public function whenMovieDeleted(MovieDeleted $event)
    {
        $playlistables = Playlistables::findByMovie($event->movie);
        $playlistables->delete();
    }

}