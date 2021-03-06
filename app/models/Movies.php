<?php

use Carbon\Carbon;
use core\myPresenterTrait;
use webParser\youtube;

class Movies extends \core\myModel
{
    use myPresenterTrait;
    use CommentableTrait;
    use taggableTrait;
    use WatchlistableTrait;
    use AttachmentableTrait;
    use videoTagsTrait;

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
     * @Column(type="string", length=20, nullable=true)
     */
    public $key;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $title;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $description;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $uploader_url;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $channel_title;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $channel_url;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    public $channel_id;

    /**
     *
     * @var Carbon
     */
    public $created_at;

    /**
     *
     * @var Carbon
     */
    public $updated_at;
    /**
     *
     * @var string
     */
    public $duration;

    public static function findOrDownloadByKey($key)
    {
        $instance = static::findByKey($key);
        if(!$instance){
            $data =  youtube::getMovieInfo($key);
            $instance = new static($data);
            $channel = Channels::findOrNewByData(['title'=>$data['channel_title'],'url'=>$data['channel_url'],'uploader_url'=>$data['uploader_url']]);
            $instance->channel_id = $channel->id;
            $instance->save();
        }
        return $instance;
    }

    public static function findByKey($key)
    {
        return static::query()
            ->where('key = :key:',['key'=>$key])
            ->execute()->getFirst();
    }

    public static function getLatest()
    {
        return modelsManager()->createBuilder()
            ->addFrom(static::class,'m')
            ->orderBy('m.id DESC');
    }
    public static function getLatestWithComments(){
        return static::getLatest()
            ->leftJoin(Comments::class,'c.commentable_id = m.id AND c.commentable_type="Movies"','c')
            ->columns([
                'm.id',
                'm.title',
                'm.channel_id',
                'm.channel_title',
                'm.hasVideoFile',
                'm.duration',
                'm.playtime',
                'm.created_at',
                'COUNT(c.id) AS commentCounts'
            ])
            ->groupBy('m.id');
    }
    public static function search($keywords)
    {
        $query = static::query();
        $bits = static::splitKeyWords($keywords);
        foreach($bits as $key=>$bit){
            $query->andWhere("title like :word{$key}:",["word{$key}"=>"%{$bit}%"]);
        }
        $query->orderBy('created_at DESC');
        return $query->execute();
    }

    private static function splitKeyWords($keywords)
    {
        return preg_split('|\s+|', $keywords);
    }

    public static function findByChannel(Channels $channel)
    {
        return static::query()
            ->where('channel_id like :channel:',['channel'=>$channel->id])
            ->orderBy('updated_at DESC')
            ->execute();
    }

    public static function findByPlaylist(Playlists $playlist)
    {
        return static::query()
            ->rightJoin(Playlistables::class,'p2m.movie_id = Movies.id','p2m')
            ->orderBy('p2m.index')
            ->where('p2m.playlist_id = :id:',['id'=>$playlist->id])
            ->execute();
    }

    public static function findByUserAndLatestVideoTags($limit = 10)
    {
        $rowsets =  static::query()
            ->rightJoin(Videotags::class,'vtags.movie_id = Movies.id','vtags')
            ->where('vtags.user_id = :user:',['user'=>auth()->user()->id])
            ->groupBy('Movies.id')
            ->columns(['Movies.*','MAX(vtags.updated_at) AS time'])
            ->orderBy('time DESC')
            ->limit($limit)
            ->execute();
        $result = [];
        foreach($rowsets as $row){
            $row->movies->time = $row->time;
            $result[]=$row->movies;
        }
        return $result;
    }

    public static function getlatestWithVideos()
    {
        return static :: getLatest()->andWhere('hasVideoFile = 1');
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'movies';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Movies[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Movies
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
    public function getChannelUrl()
    {
        return 'https://www.youtube.com'.$this->channel_url;
    }
    public function getMovieUrl()
    {
        return 'https://www.youtube.com/watch?v='.$this->key;
    }

    public function infoArray()
    {
        return [
            'key'=>'key',
            'description'=>'描述',
            'channel'=>'频道',
            'uploader'=>'上传者',
            'created_at'=>'获取时间',
            'youtubeUrl' => 'YouTube',
//            'fileName'=>'文件名',
            'downloadLink' => '下载链接',
            'tags'=>'所属标签',
            'operation'=>'操作',
        ];
    }


    public function channel()
    {
        return $this->make('channel',function(){
            return Channels::findFirst($this->channel_id);
        });
    }
    public function playlists()
    {
        return $this->make('playlists',function(){
            return Playlists::findByMovie($this);
        });
    }
    public function delete()
    {
        $this->getEventsManager()->trigger(new MovieDeleted($this));
        return parent::delete();
    }

    /**
     * @param array | null $data
     * @param array | null $whiteList
     */
    public function save($data = null, $whiteList = null )
    {
        if(!parent::save($data,$whiteList)){
            return false;
        }
        $this->getEventsManager()->trigger(new MoviesChanged($this));
        return true;
    }
}
