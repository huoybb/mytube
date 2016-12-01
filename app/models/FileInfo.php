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
        $fileKeyWords = static::getFileKey($fileKeyWords);
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

    public static function getFileKey($keywords)
    {
        $filename = preg_replace('/:|—|–|-|\(|\)|"|&|•|\/|,/im', '.*', $keywords);
        return $filename;
    }
}