<?php

class Attachments extends \core\myModel
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
     * @Column(type="string", length=100, nullable=true)
     */
    public $name;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $url;

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
    public $attachmentable_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $attachmentable_type;

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

    public static function findByAttachmentable(\core\myModel $model)
    {
        return static::query()
            ->where('attachmentable_id = :id:',['id'=>$model->id])
            ->andWhere('attachmentable_type = :type:',['type'=>get_class($model)])
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
        return 'attachments';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Attachments[]|Attachments
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Attachments
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function getFileSize()
    {
        return $this->make('fileSize',function(){
            return filesize($this->url);
        });
    }
}
