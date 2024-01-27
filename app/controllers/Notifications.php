<?php

//notifications class
class Notifications extends Controller
{

    public function getAll(){
        $notificationInst=new Notification();
        echo json_encode($notificationInst->getAll());
//        echo json_encode("hello world");
    }

    public function markseen()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if(!empty($_POST['ids'])) {
                $ids = json_decode($_POST['ids']);
                $notificationInst=new Notification();
                foreach ($ids as $id){
                    $notificationInst->update(['seen'=>1],$id);
                }
            }
            die;
        }
    }
}