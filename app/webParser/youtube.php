<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/11/29
 * Time: 21:26
 */

namespace webParser;



use webParser\youtube\channelParser;
use webParser\youtube\movieParser;
use webParser\youtube\playlistParser;

class youtube extends myParser
{
    public static function getMovieInfo($key){
        $url = 'https://www.youtube.com/watch?v='.$key;
        $crawler = static ::getCrawler($url);
        $data = (new movieParser($crawler))->parse();
        $data['key'] = $key;
        return $data;
    }

    public static function getListInfo($key)
    {
        $url = 'https://www.youtube.com/playlist?list='.$key;
        $crawler = static ::getCrawler($url);
        $data = (new playlistParser($crawler))->parse();
        $data['key'] = $key;
        return $data;
    }

    public static function getChannelInfo($channelUrl)
    {
        $url = 'https://www.youtube.com'.$channelUrl;
        $crawler = static ::getCrawler($url);
        $data = (new channelParser($crawler))->parse();
        return $data;
    }

}