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
     * @return \Phalcon\Mvc\Model\Resultset
     */
    public function getTags()
    {
        /** @var myModel $this */
        return $this->make('tags',function(){
            /** @var myModel $this */
            return \Tags::query()
                ->leftJoin('Taggables','Tags.id = Taggables.tag_id')
                ->where('taggable_type = :type:',['type'=>get_class($this)])
                ->andWhere('taggable_id = :id:',['id'=>$this->id])
                ->execute();
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
        return new tagForm(new Tags);
    }



}