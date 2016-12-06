<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/7/2
 * Time: 9:32
 */
use core\myModel;
trait taggableTrait
{

    /**
     * @param Tags $tag
     * @return mixed
     */
    public static function findByTag(Tags $tag){
        $tagged_class = static::class;
        $condition = "taggable.taggable_id = {$tagged_class}.id AND taggable.taggable_type = '{$tagged_class}' ";
        return static :: query()
            ->leftJoin(Taggables::class,$condition,'taggable')
            ->where("taggable.tag_id = :tag:",['tag'=>$tag->id])
            ->andWhere('taggable.user_id = :user:',['user'=>auth()->user()->id])
            ->execute();
    }
    /**
     * @return \Phalcon\Mvc\Model\Resultset
     */
    public function getTags()
    {
        /** @var myModel $this */
        return $this->make('tags',function(){
            /** @var myModel $this */
            return \Tags::findByTaggedObject($this);
        });
    }
    public function hasTags()
    {
        return $this->getTags()->count();
    }
    public function addTag(string $tagname)
    {
        $tag = Tags::findOrCreateByName(trim($tagname));
        if(! is_a($tag,Tags::class)) throw new Exception('taggableTrait::addTag有问题，应该传入Tags对象类型参数');
        /** @var myModel $this*/
        Taggables::findOrCreateByObjects($tag,$this);
        return $this;
    }
    public function addMultTags(string $tagsString)
    {
        $tags = preg_split('|\s+|',trim($tagsString));
        foreach($tags as $tag){
            if(! preg_match('|\s+|',$tag)) $this->addTag($tag);
        }
        return $this;
    }



    public function getTagForm()
    {
        return (new Tags)->getForm();
    }



}