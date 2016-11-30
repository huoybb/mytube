<?php

class MoviesController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {

    }
    public function showAction(Movies $movie)
    {
        $this->view->movie = $movie;
        $this->view->file = $movie->getVideoFile();
    }


}

