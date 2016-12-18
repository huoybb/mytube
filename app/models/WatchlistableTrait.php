<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/18
 * Time: 20:22
 */
trait WatchlistableTrait
{

    public function addToWantList()
    {
        $watch = $this->getLastWatch();
        if($watch && $watch->status == 'want') return $watch;
        return Watchlists::addToWantList($this);
    }

    public function addToDoingList()
    {
        $watch = $this->getLastWatch();
        if(!$watch) $watch = Watchlists::addToDoingList($this);
        $watch->save(['status'=>'doing']);
        return $watch;
    }

    public function getLastWatch()
    {
        return Watchlists::findLastWatchByMovie($this);
    }

    public function addToDoneList()
    {
        $watch = $this->getLastWatch();
        if(!$watch) $watch = Watchlists::addToDoneList($this);
        $watch->save(['status'=>'done']);
        return $watch;
    }
}