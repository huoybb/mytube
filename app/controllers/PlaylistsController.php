<?php

class PlaylistsController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->playlists = Playlists::find();
    }
    public function showAction(Playlists $playlist)
    {
        $this->view->playlist = $playlist;
    }
    public function addCommentAction(Playlists $playlist)
    {
        $playlist->addComment($this->request->getPost());
        return $this->redirect(['for'=>'playlists.show','playlist'=>$playlist->id]);
    }
    public function editAction(Playlists $playlist)
    {
        if($this->request->isPost()){
            $playlist->save($this->request->getPost());
            return $this->redirect(['for'=>'playlists.show','playlist'=>$playlist->id]);
        }
        $this->view->playlist = $playlist;
    }




}

