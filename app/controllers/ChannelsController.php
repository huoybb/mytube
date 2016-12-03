<?php

class ChannelsController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->channels = Channels::find();
    }
    public function showAction(Channels $channel)
    {
        $this->view->channel = $channel;
    }

    public function addCommentAction(Channels $channel)
    {
        $channel->addComment($this->request->getPost());
        return $this->redirect(['for'=>'channels.show','channel'=>$channel->id]);
    }

}

