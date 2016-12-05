<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/5
 * Time: 18:44
 */
class MovieDeleted
{
    /**
     * @var Movies
     */
    public $movie;

    /**
     * MovieDeleted constructor.
     * @param Movies $movie
     */
    public function __construct(Movies $movie)
    {
        $this->movie = $movie;
    }
}