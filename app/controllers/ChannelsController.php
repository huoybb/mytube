<?php

class ChannelsController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        $this->view->channels = Channels::find();
    }
    public function showAction(Channels $channel)
    {
        $this->view->channel = $channel;
    }


}

