<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/11/30
 * Time: 19:48
 */
class FileInfo
{
    public static function findFirstFile($fileKeyWords)
    {
        $files = \Symfony\Component\Finder\Finder::create()
            ->files()
            ->in('H:\YouTubes\*')
            ->name('/'.$fileKeyWords.'.+/im');
        if($files->count() > 0){
            foreach ($files as $file){
                return $file;
            }
        }
        return null;
    }
}