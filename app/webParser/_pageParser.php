<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/6/11
 * Time: 19:07
 */

namespace webParser;

use Symfony\Component\DomCrawler\Crawler;

abstract class _pageParser
{
    protected $crawler;

    /**
     * serialParser constructor.
     * @param $crawler
     */
    public function __construct(Crawler $crawler)
    {
        $this->crawler = $crawler;
    }
    abstract public function parse();

}