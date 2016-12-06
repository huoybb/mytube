<?php

class ChannelsController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->channels = Channels::getLatest();
    }
    public function showAction(Channels $channel)
    {
        $this->view->channel = $channel;
    }
    public function showplaylistsAction(Channels $channel)
    {
        $this->view->channel = $channel;
    }


    public function addCommentAction(Channels $channel)
    {
        $channel->addComment($this->request->getPost());
        return $this->redirect(['for'=>'channels.show','channel'=>$channel->id]);
    }
    public function editAction(Channels $channel)
    {
        if($this->request->isPost()){
            $channel->save($this->request->getPost());
            return $this->redirect(['for'=>'channels.show','channel'=>$channel->id]);
        }
        $this->view->channel = $channel;
    }



}

