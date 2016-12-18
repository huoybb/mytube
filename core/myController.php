<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/8
 * Time: 7:56
 */

namespace core;


use Phalcon\Mvc\Controller;
use Phalcon\Paginator\Adapter\Model;
use Phalcon\Paginator\Adapter\NativeArray;
use Phalcon\Paginator\Adapter\QueryBuilder;

class myController extends Controller
{
    protected function redirectBack()
    {
        $url = $this->request->getServer('HTTP_REFERER');
        return $this->response->redirect($url, true);
    }

    protected function redirect(array $routeArray)
    {
        $url = $this->url->get($routeArray);
        return $this->response->redirect($url, true);
    }
    /**
     * @param $rowSets
     * @param $limit
     * @param $page
     * @return mixed
     */
    protected function getPaginator($rowSets, $limit, $page)
    {
        $paginator = new Model([
            'data'=>$rowSets,
            'limit'=>$limit,
            'page'=>$page
        ]);
        return $this->cyclingPage($paginator->getPaginate());
    }
    protected function getPaginatorByArray($array,$limit,$page){
        $paginator = new NativeArray([
            'data'=>$array,
            'limit'=>$limit,
            'page'=>$page
        ]);
        return $paginator->getPaginate();
    }

    /**
     * @param $builder
     * @param $limit
     * @param $page
     * @return mixed
     */
    protected function getPaginatorByQueryBuilder($builder, $limit, $page)
    {
        $paginator = new QueryBuilder([
            'builder'=>$builder,
            'limit'=>$limit,
            'page'=>$page
        ]);
        return $this->cyclingPage($paginator->getPaginate());
    }
    private function cyclingPage($page)
    {
        if($page->next == $page->current) $page->next = 1;
        if($page->before == $page->current) $page->before = $page->last;
        return $page;
    }
}