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



}

