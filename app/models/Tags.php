<?php

use core\myModel;

class Tags extends myModel
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
     * @Column(type="string", length=100, nullable=true)
     */
    public $name;

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
    public $keywords;

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

    public static function findOrCreateByName($tagName)
    {
        $instance = static::query()
            ->where('name = :name:',['name'=>$tagName])
            ->execute()->getFirst();
        if(! $instance){
            $instance = static::saveNew(['name'=>$tagName]);
        }
        return $instance;
    }

    public static function findByTaggedObject(myModel $object)
    {
        return static :: query()
            ->leftJoin('Taggables','Tags.id = Taggables.tag_id')
            ->where('taggable_type = :type:',['type'=>get_class($object)])
            ->andWhere('taggable_id = :id:',['id'=>$object->id])
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
        return 'tags';
    }


    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Tags[]|Tags
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Tags
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
    public function getTaggedObjects(string $tagged_class=null)
    {
        $tagged_class = $tagged_class ?: Movies::class;
        return $tagged_class::findByTag($this);
    }

}
