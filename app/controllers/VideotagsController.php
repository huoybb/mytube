<?php

class VideotagsController extends \core\myController
{

    public function indexAction()
    {
        $this->view->videotags = Videotags::getLatest();
        $this->view->movies = auth()->user()->getLatestVideoTagedMovies();
    }

    public function deleteAction(Videotags $videotag)
    {
        $videotag->delete();
        return $this->redirectBack();
    }


}

