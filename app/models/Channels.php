<?php

class Channels extends \core\myModel
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
        return Movies::query()
            ->where('channel_id = :id:',['id'=>$this->id])
            ->execute();
    }


}
