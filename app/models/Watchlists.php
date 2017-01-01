<?php

class Watchlists extends \core\myModel
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    public $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    public $movie_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    public $user_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $status;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $playtime;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $created_at;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $updated_at;

    /**
     * @param Movies $movie
     * @return \Phalcon\Mvc\ModelInterface | Watchlists
     */
    public static function findOrCreateLastWatchByMovie(Movies $movie)
    {
        $instance =  static :: query()
            ->where('movie_id = :movie:',['movie'=>$movie->id])
            ->andWhere('user_id = :user:',['user'=>auth()->user()->id])
            ->orderBy('created_at DESC')
            ->execute()->getFirst();
        if(!$instance) $instance = static :: saveNew([
            'movie_id'=>$movie->id,
            'user_id'=>auth()->user()->id,
        ]);
        return $instance;
    }

    /**
     * @param Movies $movie
     * @return static
     */
    protected static function addToWatchlist(Movies $movie, $status = 'want')
    {
        return static:: saveNew([
            'user_id' => auth()->user()->id,
            'movie_id' => $movie->id,
            'status' => $status,
            'playtime' => 0,
        ]);
    }


    public static function addToWantList(Movies $movie)
    {
        return self::addToWatchlist($movie);
    }

    public static function addToDoingList(Movies $movie)
    {
        return self::addToWatchlist($movie,'doing');
    }
    public static function addToDoneList(Movies $movie)
    {
        return self::addToWatchlist($movie,'done');
    }

    public static function getWantListByUser(Users $user)
    {
        return self::getListByUserAndStatus($user,'want');
    }

    private static function getListByUserAndStatus($user, $status)
    {
        $lists =  modelsManager()->createBuilder()
            ->from('Movies')
            ->rightJoin('Watchlists','wlist.movie_id = Movies.id','wlist')
            ->where('wlist.user_id = :user:',['user'=>$user->id])
            ->groupBy('wlist.movie_id')
            ->orderBy('max(wlist.updated_at) DESC')
            ->columns(['Movies.*','wlist.status'])
            ->getQuery()->execute();
        $lists = $lists->filter(function($row) use($status) {
            if($row->status == $status) return $row->movies;
        });
        return $lists;
    }

    public static function getDoingListByUser($user)
    {
        return self::getListByUserAndStatus($user,'doing');
    }
    public static function getDoneListByUser($user)
    {
        return self::getListByUserAndStatus($user,'done');
    }

    public static function updatePlaytimeFor($movie,$playtime)
    {
        $watchlist = static::findOrCreateLastWatchByMovie($movie);
        $watchlist->save(['playtime'=>$playtime]);
    }

    public static function getPlaytimeFor(Movies $movie)
    {
        $instance  = static :: findOrCreateLastWatchByMovie($movie);
        return $instance->playtime;
    }


    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("mytube");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'watchlists';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Watchlists[]|Watchlists
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Watchlists
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
