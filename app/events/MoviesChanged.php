<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/30
 * Time: 14:44
 */
class MoviesChanged
{
    public $movie;
    /**
     * MoviesCommentAdded constructor.
     * @param Movies $movie
     */
    public function __construct($movie)
    {
        $this->movie = $movie;
    }
}