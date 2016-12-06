<?php

use core\myModel;

class Taggables extends myModel
{

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
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    public $tag_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $taggable_type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    public $taggable_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    public $user_id;

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

    public static function findOrCreateByObjects(Tags $tag, myModel $object)
    {
        $instance = static :: findByTagAndObject($tag,$object);
        if(! $instance){
            $instance = static::saveNew([
                'tag_id'        =>$tag->id,
                'taggable_type' =>get_class($object),
                'taggable_id'   =>$object->id,
                'user_id'       =>auth()->user()->id,
            ]);
        }
        return $instance;
    }

    public static function findByObject(myModel $object)
    {
        return static :: query()
            ->where('taggable_type = :type:',['type'=>get_class($object)])
            ->andWhere('taggable_id = :id:',['id'=>$object->id])
            ->execute();
    }
    public static function findByTag(Tags $tag)
    {
        return static :: query()
            ->where('tag_id = :tag:',['tag'=>$tag->id])
            ->execute();
    }
    public static function findByUser(Users $user){
        return static :: query()
            ->where('user_id = :user:',['user'=>$user->id])
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
        return 'taggables';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Taggables[]|Taggables
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Taggables
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public static function findByTagAndObject($tag, $object)
    {
        return static::query()
            ->where('tag_id = :tag:',['tag'=>$tag->id])
            ->andWhere('taggable_type = :type:',['type'=>get_class($object)])
            ->andWhere('taggable_id = :id:',['id'=>$object->id])
            ->andWhere('user_id = :user:',['user'=>auth()->user()->id])
            ->execute()->getFirst();
    }

}
