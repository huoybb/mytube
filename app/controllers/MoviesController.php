<?php

class MoviesController extends ControllerBase
{

    public function showAction(Movies $movie)
    {
        $this->view->movie = $movie;
    }
    public function addCommentAction(Movies $movie)
    {
        $movie->addComment($this->request->getPost());
        return $this->redirect(['for'=>'movies.show','movie'=>$movie->id]);
    }

    public function addTagAction(Movies $movie)
    {
        $movie->addTag($this->request->getPost('name'));
        return $this->redirect(['for'=>'movies.show','movie'=>$movie->id]);
    }
    public function updatePlayTimeAction(Movies $movie)
    {
        $movie->save($this->request->getPost());
        return false;
    }


}

