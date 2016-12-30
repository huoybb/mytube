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
        /** @var Movies $this */
        $this->getEventsManager()->trigger(new MoviesChanged($this));
        return Watchlists::addToWantList($this);
    }

    public function addToDoingList()
    {
        $watch = $this->getLastWatch();
        if(!$watch) $watch = Watchlists::addToDoingList($this);
        $watch->save(['status'=>'doing']);
        /** @var Movies $this */
        $this->getEventsManager()->trigger(new MoviesChanged($this));
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
        /** @var Movies $this */
        $this->getEventsManager()->trigger(new MoviesChanged($this));
        return $watch;
    }
}