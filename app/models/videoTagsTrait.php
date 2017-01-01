<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/23
 * Time: 12:30
 */

trait videoTagsTrait
{
    public function addMovieTag($data)
    {
        $data['user_id'] = auth()->user()->id;
        $data['movie_id'] = $this->id;
        Videotags::saveNew($data);
        if($this instanceof Movies) $this->getEventsManager()->trigger(new MoviesVideotagAdded($this));
        return $this;
    }
    public function getVideoTags()
    {
        return $this->make('videoTags',function(){
            return Videotags::findByMovie($this);
        });
    }
    public function hasVideoTags()
    {
        return count($this->getVideoTags());
    }
    public function getVideoFile()
    {
        return $this->make('videoFile',function(){
            if($this->hasVideoFile) {
                $file = FileInfo::findFirstFile($this->key);
            }else{
                $file = FileInfo::findFirstFile($this->title);
                if(!$file) $file = FileInfo::findFirstFile($this->key);
            }
            if(!$file) return null;
            return str_replace('H:\\YouTubes\\','http://movies.mytube.zhaobing/',$file->getRealPath());
        });
    }
    public function setVideoFile()
    {
        //将视频文件放在指定目录下后，能够根据文件名识别出来的情况
        if($file = FileInfo::findFirstFile($this->title)){
            $old_name = $file->getBasename();
            $new_name = $this->key.'.mp4';
            $new_realPath = str_replace($old_name,$new_name,$file->getRealPath());

            rename($file->getRealPath(),$new_realPath);

            $this->save(['hasVideoFile'=>true]);
            return true;
        }
        //当已经手动将文件名按照key修改后的情况
        if($file = FileInfo::findFirstFile($this->key)){
            $this->save(['hasVideoFile'=>true]);
            return true;
        }
        return false;
    }
    // 更新视频文件的时间
    public function updateDuration($duration)
    {
        return $this->save(['duration'=>$duration]);
    }
}