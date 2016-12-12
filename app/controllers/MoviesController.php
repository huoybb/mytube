<?php

class MoviesController extends \core\myController
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

    public function editAction(Movies $movie)
    {
        if($this->request->isPost()){
            $movie->save($this->request->getPost());
            $this->redirect(['for'=>'movies.show','movie'=>$movie->id]);
        }
        $this->view->movie = $movie;
    }
    public function deleteAction(Movies $movie)
    {
        $movie->delete();
        return $this->redirect(['for'=>'home']);
    }
    public function setFileAction(Movies $movie)
    {
        if(!$movie->setVideoFile()){
            $this->flash->error('没有找到视频文件');
        }
        return $this->redirectBack();
    }
    public function addVideoTagAction(Movies $movie)
    {
        $movie->addMovieTag($this->request->getPost());
        return false;
    }
    public function editMovietagsAction(Movies $movie)
    {
        $this->view->movie = $movie;
    }

    public function withVideosAction($page = 1)
    {
        $this->view->page = $this->getPaginatorByQueryBuilder(Movies::getlatestWithVideos(),50,$page);
    }





}

