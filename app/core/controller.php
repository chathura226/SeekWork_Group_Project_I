<?php

//main controller class., controllers in 
//controllers folder will be childrens of this

class Controller{

    public function view($view,$data=[]){

        extract($data); //goes through array and make every value variables in coresponding names

        $filename = "../app/views/".$view.".view.php";
        if(file_exists($filename)){
            require $filename;
        }else{
            echo "Couldn't find the view file ".$filename;
        }
    }
//TODO:File extensions when saving
    //$file will be $_FILE['document'] which is superglobal
    public function uploadFile($file,$savingDir,$fileName=''): string
    {
        if (!file_exists($savingDir)) {
            mkdir($savingDir, 0777, true);
            //for security, adding empty index.php files
            file_put_contents($savingDir . "index.php", "<?php //Access Denied");
        }
        if(!empty($fileName)){
            $extension=array_reverse(explode('.',$file['name']))[0];

            $destination = $savingDir . $fileName.'.'.$extension;
        }else{
            $destination = $savingDir . time() .'-'. $file['name'];
        }
        move_uploaded_file($file['tmp_name'], $destination);
        return $destination;
    }

}