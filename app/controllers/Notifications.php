<?php

//notifications class
class Notifications extends Controller
{

    public function getAll(){
        $notificationInst=new Notification();
        echo json_encode($notificationInst->getAll());
//        echo json_encode("hello world");
    }
}