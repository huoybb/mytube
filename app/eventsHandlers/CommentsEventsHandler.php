<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/5
 * Time: 18:46
 */
class CommentsEventsHandler
{
    public function whenMovieDeleted(MovieDeleted $event)
    {
        $comments = Comments::findByCommentedObject($event->movie);
        $comments->delete();
    }

}