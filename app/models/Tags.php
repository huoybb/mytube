<?php

class Tags extends \core\myModel
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
    public function getTaggedObjects($tagged_class=null)
    {
        $tagged_class = $tagged_class ?: Movies::class;
        $taggable_class = Taggables::class;
        $condition = "{$taggable_class}.taggable_id = {$tagged_class}.id AND {$taggable_class}.taggable_type = '{$tagged_class}' ";
        return $tagged_class::query()
            ->rightJoin(Taggables::class,$condition)
            ->where("{$taggable_class}.tag_id = :tag:",['tag'=>$this->id])
            ->execute();
    }

}
