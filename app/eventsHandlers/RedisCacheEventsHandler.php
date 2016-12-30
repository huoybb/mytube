<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/30
 * Time: 15:09
 * @property \Phalcon\Cache\BackendInterface $viewCache

 */
class RedisCacheEventsHandler extends \core\myDIAwareClass
{
    public function whenMoviesChanged(MoviesChanged $event)
    {
        $this->removeMovieCache($event->movie);
    }
    public function whenMovieDeleted(MovieDeleted $event)
    {
        $this->removeMovieCache($event->movie);
    }
    public function whenMoviesCommentAdded(MoviesCommentAdded $event)
    {
        $this->removeMovieCache($event->movie);
    }
    public function whenMoviesTagAdded(MoviesTagAdded $event)
    {
        $this->removeMovieCache($event->movie);
    }
    public function whenMoviesAttachmentAdded(MoviesAttachmentAdded $event)
    {
        $this->removeMovieCache($event->movie);
    }
    public function whenMoviesVideotagAdded(MoviesVideotagAdded $event)
    {
        $this->removeMovieCache($event->movie);
    }

    protected function removeMovieCache(Movies $movie){
        $this->viewCache->delete($movie->getCacheKey());
    }

}