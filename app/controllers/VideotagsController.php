<?php

class VideotagsController extends \core\myController
{

    public function indexAction()
    {
        $this->view->videotags = Videotags::getLatest();
        $this->view->movies = auth()->user()->getLatestVideoTagedMovies();
//        dd($this->view->movies->toArray());
    }

    public function deleteAction(Videotags $videotag)
    {
        $videotag->delete();
        return $this->redirectBack();
    }


}

