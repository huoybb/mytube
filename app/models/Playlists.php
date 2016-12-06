<?php

use webParser\youtube;

class Playlists extends \core\myModel
{
    use \core\myPresenterTrait;
    use CommentableTrait;
    use taggableTrait;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
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
     * @Column(type="string", length=100, nullable=false)
     */
    public $key;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    public $channel_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $lastUpdated;

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

    public static function findOrDownloadByKey($key)
    {
        $instance = static::findByKey($key);
        if(!$instance){
            $data =  youtube::getListInfo($key);
            //处理列表的信息
            $data['channel_id'] = static :: getChannelByUrl($data['channel'])->id;
            $instance = static ::saveNew($data);

            //处理列表下的视频关系
            foreach($data['movies'] as $movie_url){
                list($movie,$index) = static::parseMovieUrl($movie_url);
                if($movie) Playlistables::UpdateOrNewByData($instance,$movie,$index);
            }
        }
        return $instance;
    }

    public static function findByKey($key)
    {
        return static::query()
            ->where('key = :key:',['key'=>$key])
            ->execute()->getFirst();
    }

    private static function parseMovieUrl($movie_url)
    {
        preg_match('/v=([^&]+)/sim', $movie_url, $regs);
        $key = ''.$regs[1];
        $movie = Movies::findByKey($key);
        preg_match('/index=([0-9]+)/sim', $movie_url, $regs);
        $index = $regs[1];
        return [$movie,$index];

    }

    public static function findByMovie(Movies $movie)
    {
        return static :: query()
            ->rightJoin(Playlistables::class,'p2m.playlist_id = Playlists.id','p2m')
            ->where('p2m.movie_id = :movie:',['movie'=>$movie->id])
            ->execute();
    }

    public static function findByChannel(Channels $channel)
    {
        return static :: query()
            ->where('channel_id = :channel:',['channel'=>$channel->id])
            ->orderBy('updated_at DESC')
            ->execute();
    }

    public static function getLastes()
    {
        return static :: query()
            ->orderBy('updated_at DESC')
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
        return 'playlists';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Playlists[]|Playlists
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Playlists
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    private static function getChannelByUrl($channelUrl)
    {
        if(preg_match('%/user/.+%sim', $channelUrl)){
            $channel = Channels::findByUploaderUrl($channelUrl);
            if(!$channel) $channel = Channels::downloadAndSaveByUploaderUrl($channelUrl);
        }else{
            $channel = Channels::findByUrl($channelUrl);
            if(!$channel) $channel = Channels::downloadAndSaveByUrl($channelUrl);
        }
        return $channel;
    }

    public function movies()
    {
        return Movies::findByPlaylist($this);
    }
    public function infoArray()
    {
        return [
            'youtube'=>'Youtube',
            'channel'=>'所属频道',
            'lastUpdated'=>'更新时间',
            'tags'=>'标签',
            'operation'=>'操作',
        ];
    }

    public function updateFromYoutube()
    {
        $data =  youtube::getListInfo($this->key);
        //更新列表下的视频的关系
        foreach($data['movies'] as $movie_url){
            list($movie,$index) = static::parseMovieUrl($movie_url);
            if($movie) Playlistables::UpdateOrNewByData($this,$movie,$index);
        }
        return $this;
    }


}
