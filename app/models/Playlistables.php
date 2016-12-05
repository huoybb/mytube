<?php

class Playlistables extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    public $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    public $playlist_id;

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
    public $index;

    public static function findOrNewByData(Playlists $playlist,Movies $movie, $index=null)
    {
        $instance = static :: query()
            ->where('playlist_id = :playlist:',['playlist'=>$playlist->id])
            ->andWhere('movie_id = :movie:',['movie'=>$movie->id])
            ->execute()->getFirst();
        if(!$instance){
            $instance = new static([
                'playlist_id'=>$playlist->id,
                'movie_id'=>$movie->id,
                'index'=>$index
            ]);
            $instance->save();

        }
        return $instance;
    }

    public static function findByMovie(Movies $movie){
        return static :: query()
            ->where('movie_id = :movie:',['movie'=>$movie->id])
            ->execute();
    }

    public static function findByPlaylist(Playlists $playlist){
        return static :: query()
            ->where('playlist_id = :playlist:',['playlist'=>$playlist->id])
            ->execute();
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
        return 'playlistables';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Playlistables[]|Playlistables
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Playlistables
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
