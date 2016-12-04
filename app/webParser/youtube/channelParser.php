<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/4
 * Time: 13:14
 */

namespace webParser\youtube;


use webParser\_pageParser;

class channelParser extends _pageParser
{

    public function parse()
    {
        $title = $this->crawler->filter('.qualified-channel-title-text')->text();
        return compact('title');
    }
}