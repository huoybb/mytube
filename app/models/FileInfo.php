<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/11/30
 * Time: 19:48
 */
class FileInfo
{
    public static function findFirstFile($fileKeyWords,$path = null)
    {
        $path = $path ?: 'H:\YouTubes\*';
        $fileKeyWords = static::getFileKey($fileKeyWords);
        $files = \Symfony\Component\Finder\Finder::create()
            ->files()
            ->in($path)
            ->name('/'.$fileKeyWords.'.+?/im');
        if($files->count() > 0){
            foreach ($files as $file){
                return $file;
            }
        }
        return null;
    }

    public static function getFileKey($keywords)
    {
        $filename = preg_replace('/\'|’|:|—|–|-|\(|\)|"|&|•|\/|,|\||#/im', '.*', $keywords);
        $filename = preg_replace('/[\s]+/im', ' ', $filename);
        return $filename;
    }

    public static function getFilePathFromAttachment(Attachments $attachment)
    {
        $file_path = APP_PATH.'/public/'.$attachment->url;
        if(is_file($file_path)) return $file_path;
        return null;
    }

    public static function getFilePathFromMovie(Movies $movie)
    {
        if($file = FileInfo::findFirstFile($movie->key)) return $file;
        return null;
    }
}