<?php

class WatchlistsController extends \core\myController
{

    public function addToWantListAction(Movies $movie)
    {
        $movie->addToWantList();
        return $this->redirectBack();
    }
    public function addToDoingListAction(Movies $movie)
    {
        $movie->addToDoingList();
        return $this->redirectBack();
    }
    public function addToDoneListAction(Movies $movie)
    {
        $movie->addToDoneList();
        return $this->redirectBack();
    }
    public function wantAction($page =1)
    {
        $this->view->page = $this->getPaginatorByArray(Watchlists::getWantListByUser(auth()->user()),50,$page);
    }
    public function doingAction($page =1)
    {
        $this->view->page = $this->getPaginatorByArray(Watchlists::getDoingListByUser(auth()->user()),50,$page);
    }
    public function doneAction($page =1)
    {
        $this->view->page = $this->getPaginatorByArray(Watchlists::getDoneListByUser(auth()->user()),50,$page);
    }




}

