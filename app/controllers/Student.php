<?php

//Student class
class Student extends Controller{

    public function index(){
        
        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the student section!');
            redirect('login');
        }
        if(!Auth::is_student()){///if not a student, redirect to home
            message('Only students can view student dashboard!');
            redirect('home');
        }
      


        $data['title'] = "Dashboard";
        
        $this->view('student/dashboard',$data);
    }



    public function profile($id=null){

        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the student section!');
            redirect('login');
        }
        if(!Auth::is_student()){///if not a student, redirect to home
            message('Only students can view student dashboard!');
            redirect('home');
        }
      
      
        //if id is null make it current logged in user id
        $id=$id ?? Auth::getuserID();

        $user = new User();
        $row = $user->first(['userID'=>$id]);//get user details corresponding to the user id

        if(!empty($row)){
            //get details of user from relevant table and make a combined object 
            $userDetails=$user->getFirstCustom($row->role,['userID'=>$row->userID],$row->role."ID");
            $combinedObject = (object)array_merge((array)$row, (array)$userDetails);
        }else  $combinedObject=null;
        //pass the combined object to the view
        $data['row']=$combinedObject;


        $data['title'] = "Profile";
        
        $this->view('student/profile',$data);
    }


    

    public function changepassword(){
        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the student section!');
            redirect('login');
        }
        if(!Auth::is_student()){///if not a student, redirect to home
            message('Only students can view student dashboard!');
            redirect('home');
        }
      
        
        $data['title'] = "Change Password";
        
        

        //should implement the validation and procedure
        if($_SERVER['REQUEST_METHOD']=="POST"){
            
            message("Password changed successfully!");
            redirect('student');
        }


        $this->view('student/changepassword',$data);
    }

    public function updateprofile(){
        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the student section!');
            redirect('login');
        }
        if(!Auth::is_student()){///if not a student, redirect to home
            message('Only students can view student dashboard!');
            redirect('home');
        }
      

        
        $data['title'] = "Update Profile";
        
        

        //should implement the validation and procedure
        if($_SERVER['REQUEST_METHOD']=="POST"){
            
            message("Profile updated successfully!");
            redirect('student');
        }


        $this->view('student/updateprofile',$data);
    }

    public function verification(){
        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the student section!');
            redirect('login');
        }
        if(!Auth::is_student()){///if not a student, redirect to home
            message('Only students can view student dashboard!');
            redirect('home');
        }
      

        
        $data['title'] = "Verification";
        
        

        //should implement the validation and procedure
        if($_SERVER['REQUEST_METHOD']=="POST"){
            
            message("Details submitted successfully!");
            redirect('student');
        }


        $this->view('student/verification',$data);
    }

    public function proposals($id=null){
        
        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the student section!');
            redirect('login');
        }
        if(!Auth::is_student()){///if not a student, redirect to home
            message('Only students can view student dashboard!');
            redirect('home');
        }

        if(empty($id)){
            $proposal=new Proposal();
            $proposals=$proposal->where(['studentID'=>Auth::getstudentID()]);
            if(empty($proposals)){
                message('You have not submitted any proposals!');
                redirect('student');
            }
            $task=new Task();
            for ($i = 0; $i < count($proposals); $i++) {
                $proposals[$i]->task=$task->first(['taskID'=> $proposals[$i]->taskID]);
            }
    
    
            $data['title'] = "Proposals";
            $data['proposals']=$proposals;
            
            $this->view('student/proposals',$data);
        }else{
            $proposal=new Proposal();
            $row=$proposal->first(['proposalID'=>$id]);
            if(!empty($row)){
                $data['proposal']=$row;


                $task=new Task();
                $data['task']=$task->first(['taskID'=>$row->taskID]);
                if(!empty($data['task'])){
                    $company=new Company();
                    $data['company']=$company->first(['companyID'=>$data['task']->companyID]);
                    if(!empty($data['company'])){

                        $data['title'] = "Proposal - ".$data['task']->title;
                        $this->view('student/proposal',$data);
                        return;

                    }

                } 
            }
            message('Error fetching data!');
            redirect('student/proposals');

        }
    }

    //modify proposals
    public function modify($id=null){
        
        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the student section!');
            redirect('login');
        }
        if(!Auth::is_student()){///if not a student, redirect to home
            message('Only students can view student dashboard!');
            redirect('home');
        }

        if(empty($id)){
            message('Select a proposal to modify!');
            redirect('student/proposals');
        }else{

             //if the method is post->modify proposal
            if($_SERVER['REQUEST_METHOD']=="POST"){
                
                $_POST['studentID']=Auth::getstudentID();
                if(empty($_POST['documents']))unset($_POST['documents']);

                $proposal=new Proposal();
                if($proposal->first(['proposalID'=>$id])->studentID!==Auth::getstudentID()){
                    message('Unauthorized!');
                    redirect('student/proposals');
                }
                $proposal->update($_POST,$id);

                message('Proposal Updated Successfully!');
                redirect('student/proposals');

            }else{

                $proposal=new Proposal();
                $row=$proposal->first(['proposalID'=>$id]);
                if(!empty($row)){
                    $data['proposal']=$row;


                    $task=new Task();
                    $data['task']=$task->first(['taskID'=>$row->taskID]);
                    if(!empty($data['task'])){
                        $company=new Company();
                        $data['company']=$company->first(['companyID'=>$data['task']->companyID]);
                        if(!empty($data['company'])){

                            $data['title'] = "Modify Proposal";
                            $this->view('student/modify',$data);
                            return;
                        }

                    } 
                }
                message('Error fetching data!');
                redirect('student/proposals');

            }
        }
    }

    //delete proposals
    public function delete($id=null){
        
        if($_SERVER['REQUEST_METHOD']=="POST"){

            if(!Auth::logged_in()){//if not logged in redirect to login page
                message('Please login to view the student section!');
                redirect('login');
            }
            if(!Auth::is_student()){///if not an student, redirect to home
                message('Only companies can view student dashboard!');
                redirect('home');
            }

            if(!empty($id)){
                $proposal=new Proposal();
                $row=$proposal->first(['proposalID'=>$id]);
                if(!empty($row)){
                    if($row->studentID===Auth::getstudentID()){
                        $proposal->delete($id);
                        message('Proposal Deleted Successfully!');
                        redirect('student/proposals');
                    }
                    message('Unauthorized !');
                    redirect('student/proposals');
                }
                message('Error Fetching!');
                redirect('student/proposals');
            }
        }

    }


    public function tasks($id=null,$action=null,$id2=null,$action2=null){

        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the student section!');
            redirect('login');
        }
        if(!Auth::is_student()){///if not an admin, redirect to home
            message('Only students can view student dashboard!');
            redirect('home');
        }

        $task=new Task();

        if(!empty($id)){

            $row = $task->first(['taskID'=>$id]);//get task details corresponding to the tadsk id
            
            if(!empty($row)){
                if($row->assignedStudentID===Auth::getstudentID()){
                    
                    if(!empty($action)){
                        if($action==='submissions'){

                            //$id2=submission id
                            if(!empty($id2)){//if theres an id after submissions => view each submission
                                $submissionInst=new Submission();
                                $submission=$submissionInst->first(['submissionID'=>$id2,'taskID'=>$id]);//task id also used, so subission releavatn to someone else cannot be taken

                                if(empty($submission) ){

                                    message('Invalid Submission ID or Submission is not yours!');
                                    redirect('student/tasks/'.$id.'/submissions');
                                }
                                

                                if(!empty($action2)){
                                    if($action2==='delete'){//submission deletion
                                        if($_SERVER['REQUEST_METHOD']=="POST"){
                                            if($submission->status==='pendingReview'){//only submissions pending can be deleted
                                                $submissionInst->delete($id2);
                                                message('Submission deleted successfully!');
                                                redirect('student/tasks/'.$id.'/submissions');
                                            }else{
                                                message('You cannot delete a accepted or rejected submission!');
                                                redirect('student/tasks/'.$id.'/submissions');
                                            }
                                        }
                                        redirect('student/tasks/'.$id.'/submissions/'.$id2);  
                                    }else if($action2==='modify'){//submission modify


                                        if($_SERVER['REQUEST_METHOD']=="POST"){//when get a post req for modify submision

                                            $_POST['studentID']=Auth::getstudentID();
                                            $_POST['taskID']=$id;
                                            $submissionInst->update($_POST,$id2);//implement the things needed for storing documents
            
                                            message('Submission modified Successfully!');
                                            redirect('student/tasks/'.$id.'/submissions/'.$id2);
                                        }
            
                                        //implement the things needed for storing documents
                                        $data['task']=$row;
                                        $data['submission']=$submission;
                                        
                                        $data['title']="Modify Submission";
                                        $this->view('student/modify-submission',$data);
                                        return;



                                    }
                                }

                                $data['submission']=$submission;
                                $data['task']=$row;
                                $data['title']="Submission Details";

                                $this->view('student/submission',$data);
                                return;
                            }

                            $submissionInst=new Submission();
                            $submissions=$submissionInst->where(['taskID'=>$id]);
                            if(!empty($submissions)) $submissions=sortArrayOfObjects($submissions,"createdAt",1); //sort according to date before sending
                            $data['submissions']=$submissions;
                            $data['task']=$row;
                            $data['title']="Submissions";

                            $this->view('student/submissions',$data);
                            return;
                        }else if($action==='addsubmission'){

                            if($_SERVER['REQUEST_METHOD']=="POST"){//when get a post req for add submision

                                $submissionInst=new Submission();
                                $_POST['studentID']=Auth::getstudentID();
                                $_POST['taskID']=$id;
                                $submissionInst->insert($_POST);//implement the things needed for storing documents

                                message('Submission Posted Successfully!');
                                redirect('student/tasks/'.$id.'/submissions');
                            }

                            $data['task']=$row;

                            $data['title']="New Submission";
                            $this->view('student/post-submission',$data);
                            return;
                        }
                    }
                    $data['task']=$row;
                    $company=new Company();
                    $user=new User();

                    $compdetails=$company->first(['companyID'=>$row->companyID]);
                    $userdetails=$user->first(['userID'=>$compdetails->userID]);
                    $combinedObj=(object)array_merge((array)$compdetails, (array)$userdetails);

                    $data['company']=$combinedObj;
                    $data['title'] = $row->title;
        
                    $this->view('student/task',$data);
                    return;
                }else{
                    message('Unauthorized');
                    redirect('student/tasks');
                }
            }else{

                message('Error fetching data!');
                redirect('student/tasks');
            }
           
    
        }
        $row=$task->where(['assignedStudentID'=>Auth::getstudentID()]);
            
        if(empty($row)){
            message('You have no tasks assigned!');
            redirect('student');
        }
        $data['title'] = "Tasks";

        $data['tasks']=$row;
        

        $this->view('student/tasks',$data);
        return;
    }



    //review
    public function review($action=null,$id=null){

        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the student section!');
            redirect('login');
        }
        if(!Auth::is_student()){///if not an admin, redirect to home
            message('Only students can view student dashboard!');
            redirect('home');
        }

        if(!empty($action)){

            if($action==='post'){//there should be the task id with the url
                if(!empty($id)){

                    $task=new Task();
                    $row=$task->first(['taskID'=>$id,'assignedStudentID'=>Auth::getstudentID()]);

                    if(empty($row)){//no task posted by him with the given id is found
                        message('Unauthorized!');
                        redirect('student/tasks');
                    }

                    if($row->status!=='closed'){
                        message('You cannot add the review until the task is finished!');
                        redirect('student/tasks');
                    }


                    if($_SERVER['REQUEST_METHOD']=="POST"){
                        
                        $_POST['studentID']=Auth::getstudentID();
                        $_POST['companyID']=$row->companyID;
                        $_POST['taskID']=$id;
                        $_POST['reviewType']='studentTOcompany';

                        $review=new Review();
                        $is_review=$review->first(['taskID'=>$id,'reviewType'=>'studentTOcompany']);
                        if(!empty($is_review)){
                            message('Failed!  You have a review for this task already!');
                            redirect('student/review');
                        }
                        $review->insert($_POST);

                        message('Review Added Successfully!');
                        redirect('student/review');
                    }else{

                        $company=new Company();
                        $data['company']=$company->first(['companyID'=>$row->companyID]);//send the details of student relevant to the review
                        $data['task']=$row;
                        $data['title']='Add a Review';
                        $this->view('student/post-review',$data);
                        return;
                    }
                }else{
                    message('Choose a task to add a review!');
                    redirect('student/tasks');
                }

            }else if($action==='modify'){//there should be the review id with the url
                if(!empty($id)){

                    $review=new Review();
                    $row=$review->first(['reviewID'=>$id,'studentID'=>Auth::getstudentID(),'reviewType'=>'studentTOcompany']);
                    $task=new Task();
                    $taskDetails=$task->first(['taskID'=>$row->taskID,'assignedStudentID'=>Auth::getstudentID()]);
                    if(empty($row)){//no review posted by him with the given reviewID is found
                        message('Unauthorized!');
                        redirect('student/review');
                    }


                    if($_SERVER['REQUEST_METHOD']=="POST"){

                        $_POST['studentID']=Auth::getstudentID();
                        $_POST['companyID']=$taskDetails->companyID;
                        $_POST['taskID']=$row->taskID;
                        $_POST['reviewType']='studentTOcompany';

                        $review->update($_POST,$id);

                        message('Review Updated Successfully!');
                        redirect('student/review');
                    }else{
                        $task=new Task();
                        $taskDetails=$task->first(['taskID'=>$row->taskID,'assignedStudentID'=>Auth::getstudentID()]);
                        $data['task']=$taskDetails;

                        $company=new Company();
                        $data['company']=$company->first(['companyID'=>$row->companyID]);
                       
                        
                        $data['review']=$row;
                        $data['title']='Modify a Review';
                        $this->view('student/modify-review',$data);
                        return;
                    }
                }else{
                    message('Choose a review to modify!');
                    redirect('student/review');
                }


            }else if ($action==='delete') {//there hould be a review ID with the url
                if($_SERVER['REQUEST_METHOD']=="POST"){
                    
                    if(!empty($id)){
                        $review=new Review();
                        $row=$review->first(['reviewID'=>$id,'studentID'=>Auth::getstudentID(),'reviewType'=>'studentTOcompany']);
                        //checking whethere theres review with the given id posted by logged in user
                        if(!empty($row)){
                            $review->delete($id);
                            message('Review Deleted Successfully!');
                            redirect('student/review');
                        }else{
                            message('Unauthorized!');
                            redirect('student/review');
                        }
                    }else{
                        message('Choose a review to delete!');
                        redirect('student/review');
                    }
                }
                redirect('student/review');
            }
        }




        $review=new Review();
        $row=$review->where(['studentID'=>Auth::getstudentID(),'reviewType'=>'studentTOcompany']);//get reviews written by this user
        if(empty($row)){//no review posted by him with the given reviewID is found
            message('You haven\'t posted any reviews!');
            $data['title']='Reviews';
            $data['reviews']=$row;
            $this->view('student/review',$data);
            return;
        }
        $task=new Task();
        $company=new Company();
        for ($i = 0; $i < count($row); $i++) {
            $row[$i]->task=$task->first(['taskID'=>$row[$i]->taskID]);
            $row[$i]->company=$company->first(['companyID'=>$row[$i]->companyID]);
        }

        $data['title']='Reviews';
        $data['reviews']=$row;
        $this->view('student/review',$data);


        
    }

    public function pendinginvites($action=null,$id=null){
        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the student section!');
            redirect('login');
        }
        if(!Auth::is_student()){///if not an admin, redirect to home
            message('Only students can view student dashboard!');
            redirect('home');
        }


        if(!empty($action)){
            if($action==='accept'){
                if($_SERVER['REQUEST_METHOD']=="POST"){
                    if(!empty($id)){
                        $assignmentInst=new Assignment();
                        $assignment=$assignmentInst->first(['assignmentID'=>$id]);
                        if(!empty($assignment)){
                            $proposalInst=new Proposal();
                            $proposal=$proposalInst->first(['proposalID'=>$assignment->proposalID]);

                            $taskInst=new Task();
                            $taskInst->update(['assignmentID'=>$assignment->assignmentID,'assignedStudentID'=>$proposal->studentID,'status'=>'inProgress'],$assignment->taskID);
                            $currentDateTime = date('Y-m-d H:i:s');
                            $assignmentInst->update(['status'=>'accepted','replyDate'=>$currentDateTime],$assignment->assignmentID);

                            message('Invitation Accepted Successfully!');
                            redirect('student/tasks');//redirect to my tasks

                        }
                    }
                }

            }else if($action==='decline'){
                if($_SERVER['REQUEST_METHOD']=="POST"){
                    if(!empty($id)){
                        $assignmentInst=new Assignment();
                        $assignment=$assignmentInst->first(['assignmentID'=>$id]);
                        if(!empty($assignment)){
                            

                            $currentDateTime = date('Y-m-d H:i:s');
                            $assignmentInst->update(['status'=>'declined','replyDate'=>$currentDateTime],$assignment->assignmentID);

                            message('Invitation Declined Successfully!');
                            redirect('student/pendinginvites');

                        }
                    }
                }


            }
        }


        //all invitations
        $proposalInst=new Proposal();
        $proposals=$proposalInst->where(['studentID'=>Auth::getstudentID()]);//all of his proposals
        if(empty($proposals)){
            message('You have not submitted any proposals thus there are no invitaions!');
            redirect('student');
        }

        $assignmentInst=new Assignment();
        $taskInst=new Task();
        $companyInst=new Company();
        $assignments = array();
        for ($i = 0; $i < count($proposals); $i++) {
            $assignment=$assignmentInst->first(['proposalID'=>$proposals[$i]->proposalID]);//getting assignment wiht the specific proposal id

            if(!empty($assignment)){
                if($assignment->status==='pending'){//only ending assignments are sent
                    $assignment->proposal=$proposals[$i];
                    $assignment->task=$taskInst->first(['taskID'=>$proposals[$i]->taskID]);
                    $assignment->company=$companyInst->first(['companyID'=>$assignment->task->companyID]);
                    $assignments[]=$assignment;
                }
                
            }
        }
        $data['title']='Pending Invitations';
        $data['assignments']=$assignments;
        $this->view('student/pendinginvites',$data);

    }


    public function chats($id=null){
        
        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the student section!');
            redirect('login');
        }
        if(!Auth::is_student()){///if not an admin, redirect to home
            message('Only students can view student dashboard!');
            redirect('home');
        }
      
        if(!empty($id)){//req a particular chat
            //implement chat connection with db





            
            $data['title'] = "Chat";
        
            $this->view('student/chat',$data);

            return;
        }


        $data['title'] = "Chats";
        
        $this->view('student/chats',$data);
    }

}