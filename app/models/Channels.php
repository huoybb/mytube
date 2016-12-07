<?php

class Channels extends \core\myModel
{
    use \core\myPresenterTrait;
    use CommentableTrait;

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
     * @Column(type="string", length=50, nullable=true)
     */
    public $title;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $url;

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

    public static function findByUrl($channel_url)
    {
        return static::query()
            ->where('url = :url:',['url'=>$channel_url])
            ->execute()->getFirst();
    }
    public static function findByUploaderUrl($uploader_url)
    {
        return static::query()
            ->where('uploader_url = :url:',['url'=>$uploader_url])
            ->execute()->getFirst();
    }


    public static function findOrNewByData(array $data)
    {
        $instance = static::query()
            ->where('url = :url:',['url'=>$data['url']])
            ->execute()->getFirst();
        if(!$instance){
            $instance = new static($data);
            $instance->save();
        }
        return $instance;
    }

    public static function downloadAndSaveByUploaderUrl($channelUrl)
    {
        $data = \webParser\youtube::getChannelInfo($channelUrl);
        $data['uploader_url'] = $channelUrl;
        $instance = static::saveNew($data);
        return $instance;
    }

    public static function downloadAndSaveByUrl($channelUrl)
    {
        $data = \webParser\youtube::getChannelInfo($channelUrl);
        $data['url'] = $channelUrl;
        $instance = static::saveNew($data);
        return $instance;
    }

    public static function getLatest()
    {
        return static::query()
            ->orderBy('updated_at DESC')
            ->execute();
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'channels';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Channels[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Channels
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
    public function movies()
    {
        return $this->make('movies',function(){
            return Movies::findByChannel($this);
        });
    }
    public function infoArray()
    {
        return [
            'youtube'=>'Youtube',
            'operation'=>'操作',
        ];
    }
    public function playlists()
    {
        return $this->make('playlists',function(){
            return Playlists::findByChannel($this);
        });
    }
    public function hasAnyPlaylist()
    {
        return $this->playlists()->count() > 0;
    }




}
