<?php

class Videotags extends \core\myModel
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
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $title;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    public $user_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    public $movie_id;

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

    public static function findByMovie(Movies $movie)
    {
        return static :: query()
            ->where('movie_id = :movie:',['movie'=>$movie->id])
            ->andWhere('user_id = :user:',['user'=>auth()->user()->id])
            ->orderBy('time ASC')
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
        return 'videotags';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Videotags[]|Videotags
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Videotags
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
