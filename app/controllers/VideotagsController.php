<?php

class VideotagsController extends \core\myController
{

    public function deleteAction(Videotags $videotag)
    {
        $videotag->delete();
        return $this->redirectBack();
    }


}

