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

    public static function findLastWatchByMovie(Movies $movie)
    {
        return static :: query()
            ->where('movie_id = :movie:',['movie'=>$movie->id])
            ->andWhere('user_id = :user:',['user'=>auth()->user()->id])
            ->orderBy('created_at DESC')
            ->execute()->getFirst();
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
