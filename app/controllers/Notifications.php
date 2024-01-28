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
            $json_data = file_get_contents("php://input");
            $data = json_decode($json_data, true);


            if(!empty($data['ids'])) {
                $ids=$data['ids'];
                $notificationInst=new Notification();
                foreach ($ids as $id){
                    $notificationInst->update(['seen'=>1],$id);
                }
            }
            echo "marked as seen";
        }
    }
}