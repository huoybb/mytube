<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/14
 * Time: 22:10
 */

namespace core;


class myTools
{
    public function my_substr($str, $start, $len)
    {
        $tmpstr = "";
        $strlen = $start + $len;
        for($i = 0; $i < $strlen; $i++)
        {
            if( ord( substr($str, $i, 1) ) > 0xa0 )
            {
                $tmpstr .= substr($str, $i, 3);
                $i += 2;
            } else
                $tmpstr .= substr($str, $i, 1);
        }
        return $tmpstr;
    }

    public function cut($string,$maxLength=50){
//        $result = mb_substr($string,0,$maxLength,'utf-8');
        $result = mb_strcut($string,0,$maxLength,'utf-8');
        if(mb_strlen($string) > $maxLength) $result .= ' ...';
        return $result;
    }
}