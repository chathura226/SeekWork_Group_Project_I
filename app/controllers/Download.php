<?php

//download class 
class Download extends Controller
{
    private $filePath;
    private $referer;
    public function __construct()
    {
        if (!Auth::logged_in()) { //if not logged in redirect to login page
            message('Please login to download!');
            redirect('login');
        }
        $this->filePath = "../app/uploads/";

        //for any fallbacks
        // Get the referer without the ROOT for fallback page
        $this->referer = isset($_SERVER['HTTP_REFERER']) ? str_replace(ROOT . '/', '', $_SERVER['HTTP_REFERER']) : 'index.php';

    }

    public function tasks($id = '', $dir = '')
    {
        if (!empty($id) && !empty($dir)) {

            if (!isset($_GET['file'])) {//no set
                // Handle file not specified
                message(['File Parameter Invalid', 'danger']);
                redirect($this->referer);
            }

            if ($dir == 'details') {

                $this->filePath = $this->filePath . "tasks/" . $id . "/details/" . $_GET['file'];
                $this->serveFile();

            } else if ($dir == 'proposals') {
                $this->filePath = $this->filePath . "tasks/" . $id . "/proposals/" . $_GET['file'];
                $proposal=new Proposal();

                if (Auth::is_student()) { //if a student, only the proposal's owner can download

                    $row=$proposal->first(['taskID'=>$id,'studentID'=>Auth::getstudentID()]);
                    if(!empty($row) && $row->documents==$this->filePath){
                        $this->serveFile();
                    }else{
                        message(['Unauthorized', 'danger']);
                        redirect($this->referer);
                    }

                }else if(Auth::is_company()){//if a company, only task's owner can download
                    $row=$proposal->innerJoin(['task'],['proposal.taskID=task.taskID'],['proposal.taskID'=>$id,'task.companyID'=>Auth::getcompanyID()]);
                    if(!empty($row)){//if there are at least one file
                        $this->serveFile();
                    }else{
                        message(['Unauthorized', 'danger']);
                        redirect($this->referer);
                    }
                }

                //for any other type of user (admin or moderator has direct access)
                $this->serveFile();

            }else if ($dir == 'submissions') {
                $this->filePath = $this->filePath . "tasks/" . $id . "/submissions/" . $_GET['file'];
                $submission=new Submission();

                if (Auth::is_student()) { //if a student, only the submission's owner can download

                    $row=$submission->first(['taskID'=>$id,'studentID'=>Auth::getstudentID()]);
                    if(!empty($row)){
                        $this->serveFile();
                    }else{
                        message(['Unauthorized', 'danger']);
                        redirect($this->referer);
                    }

                }else if(Auth::is_company()){//if a company, only task's owner can download
                    $row=$submission->innerJoin(['task'],['submission.taskID=task.taskID'],['submission.taskID'=>$id,'task.companyID'=>Auth::getcompanyID()]);
                    if(!empty($row)){//if there are at least one file
                        $this->serveFile();
                    }else{
                        message(['Unauthorized', 'danger']);
                        redirect($this->referer);
                    }
                }

                //for any other type of user (admin or moderator has direct access)
                $this->serveFile();

            }
        }
    }

    public function verification($id = '',$id2='')
    {

        if (!empty($id) ) {
            if(Auth::is_student()){//if a student, only  owner can download
                if(Auth::getuserID()!=$id){
                    message(['Unauthorized', 'danger']);
                    redirect($this->referer);
                }
            }
            if(Auth::is_company() || Auth::is_moderator() || Auth::is_admin()){//if a compant, only  owner can download
                if(Auth::getuserID()!=$id && !(Auth::is_moderator() || Auth::is_admin())){
                    message(['Unauthorized', 'danger']);
                    redirect($this->referer);
                }

                //also if its a company, verificationID is required
                if(!empty($id2)){
                    $verificationInst=new Moderator_Verifies_Company();
                    $row=$verificationInst->innerJoin(['company','user'],['Moderator_Verifies_Company.companyID=company.companyID','user.userID=company.userID'],['Moderator_Verifies_Company.verificationID'=>$id2,'user.userID'=>$id])[0];

                    if(!empty($row)){

                        $this->filePath=$row->documents;
                        $this->serveFile();
                        return;
                    }else {
                        redirect($this->referer);
                    }
                }else{
                    message(['Unauthorized', 'danger']);
                    redirect($this->referer);
                }
            }

            $userInst=new User();
            $row=$userInst->first(['userID'=>$id]);
            if(!empty($row)){

                $role=ucfirst($row->role)."Model";

                $roleInst=new $role();

                $roleData=$roleInst->first(['userID'=>$id]);

                if(!empty($roleData)){
                    $this->filePath=$roleData->verificationDocuments;
                    $this->serveFile();
                }
            }
        }
    }

    public function serveFile()
    {
//         echo $this->filePath;
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
            // Get the referer without the ROOT for fallback page
            $referer = isset($_SERVER['HTTP_REFERER']) ? str_replace(ROOT . '/', '', $_SERVER['HTTP_REFERER']) : 'index.php';
//            echo $referer;
            message(['File Not Found', 'danger']);
            redirect($referer);
        }
    }
}
