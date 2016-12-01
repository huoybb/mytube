<?php

use Carbon\Carbon;
use webParser\youtube;

class Movies extends \core\myModel
{
    use \core\myPresenterTrait;

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

    public static function findOrDownloadByKey($key)
    {
        $instance = static::findByKey($key);
        if(!$instance){
            $data =  youtube::getMovieInfo($key);
            $instance = new static($data);
            $channel = Channels::findOrNewByData(['title'=>$data['channel_title'],'url'=>$data['channel_url']]);
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
        return static ::query()
            ->orderBy('id DESC')
            ->limit(50)
            ->execute();
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

    public static function findByChannel($channel)
    {
        return static::query()
            ->where('channel_title like :channel:',['channel'=>$channel])
            ->execute();
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
            'description'=>'描述',
            'channel'=>'频道',
            'uploader'=>'上传者',
            'created_at'=>'获取时间',
            'youtubeUrl' => 'YouTube',
            'fileName'=>'文件名',
            'downloadLink' => '下载链接',
        ];
    }



    public function getVideoFile()
    {
        if($file = FileInfo::findFirstFile($this->title)) {
            $file = str_replace('H:\\YouTubes\\','http://movies.mytube.zhaobing/',$file->getRealPath());
        }else{
            $file = null;
        }
        return $file;
    }
    public function channel()
    {
        return Channels::findFirst($this->channel_id);
    }


}
