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



}

