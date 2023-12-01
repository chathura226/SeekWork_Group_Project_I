<?php

//download class 
class Download extends Controller
{
    private $filePath;

    public function __construct()
    {
        if (!Auth::logged_in()) { //if not logged in redirect to login page
            message('Please login to download!');
            redirect('login');
        }
        $this->filePath="../app/uploads/";        
    }
    public function tasks($id='',$dir=''){
        if(!empty($id) && !empty($dir)){

            if($dir=='details'){
                if (isset($_GET['file'])) {
                    $this->filePath=$this->filePath."tasks/".$id."/details/".$_GET['file'];
                    $this->serveFile();
                } else {
                    echo "File parameter not specified";
                }
            }
        }
    }

    public function serveFile(){
        // echo $this->filePath;
        // die;
        // Check if the file exists
        if (file_exists($this->filePath)) {
            // Set headers to force download
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($this->filePath) . '"');
            header('Content-Length: ' . filesize($this->filePath));

            // Read the file and output it to the browser
            readfile($this->filePath);    
            exit;
        } else {
            // Handle file not found
            echo "File not found";
        }
    }
}
