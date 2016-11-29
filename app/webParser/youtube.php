<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/11/29
 * Time: 21:26
 */

namespace webParser;



use webParser\youtube\movieParser;

class youtube extends myParser
{
    public static function getMovieInfo($key){
        $url = 'https://www.youtube.com/watch?v='.$key;
        $crawler = static ::getCrawler($url);
        $data = (new movieParser($crawler))->parse();
        $data['key'] = $key;
        return $data;
    }

}