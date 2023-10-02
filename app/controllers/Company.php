<?php

//Company class
class Company extends Controller{

    public function index(){
        
        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the company section!');
            redirect('login');
        }
        if(!Auth::is_company()){///if not an admin, redirect to home
            message('Only companies can view company dashboard!');
            redirect('home');
        }
      


        $data['title'] = "Dashboard";
        
        $this->view('company/dashboard',$data);
    }


    
    public function profile($id=null){

        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the company section!');
            redirect('login');
        }
        if(!Auth::is_company()){///if not an admin, redirect to home
            message('Only companies can view company dashboard!');
            redirect('home');
        }
      
        //if id is null make it current logged in user id
        $id=$id ?? Auth::getuserID();

        $user = new User();
        $row = $user->first((['userID'=>$id]));//get user details corresponding to the user id

        if(!empty($row)){
            //get details of user from relevant table and make a combined object 
            $userDetails=$user->getFirstCustom($row->role,['userID'=>$row->userID],$row->role."ID");
            $combinedObject = (object)array_merge((array)$row, (array)$userDetails);
        }else  $combinedObject=null;
        //pass the combined object to the view
        $data['row']=$combinedObject;


        $data['title'] = "Profile";
        
        $this->view('company/profile',$data);
    }


    

    public function changepassword(){
        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the company section!');
            redirect('login');
        }
        if(!Auth::is_company()){///if not an admin, redirect to home
            message('Only companies can view company dashboard!');
            redirect('home');
        }
      
        
        $data['title'] = "Change Password";
        
        

        //should implement the validation and procedure
        if($_SERVER['REQUEST_METHOD']=="POST"){
            
            message("Password changed successfully!");
            redirect('company');
        }


        $this->view('company/changepassword',$data);
    }

    public function updateprofile(){
        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the company section!');
            redirect('login');
        }
        if(!Auth::is_company()){///if not an admin, redirect to home
            message('Only companies can view company dashboard!');
            redirect('home');
        }
      

        
        $data['title'] = "Update Profile";
        
        

        //should implement the validation and procedure
        if($_SERVER['REQUEST_METHOD']=="POST"){
            
            message("Profile updated successfully!");
            redirect('company');
        }


        $this->view('company/updateprofile',$data);
    }

    public function verification(){
        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the company section!');
            redirect('login');
        }
        if(!Auth::is_company()){///if not an admin, redirect to home
            message('Only companies can view company dashboard!');
            redirect('home');
        }
      

        
        $data['title'] = "Verification";
        
        

        //should implement the validation and procedure
        if($_SERVER['REQUEST_METHOD']=="POST"){
            
            message("Details submitted successfully!");
            redirect('company');
        }


        $this->view('company/verification',$data);
    }


    public function tasks($id=null,$action=null,$id2=null){

        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the company section!');
            redirect('login');
        }
        if(!Auth::is_company()){///if not an admin, redirect to home
            message('Only companies can view company dashboard!');
            redirect('home');
        }

        if(empty($id)){

            
            $task=new Task();
            $row=$task->where(['companyID'=>Auth::getcompanyID()]);
            
            if(empty($row)){
                message('You have no tasks posted!');
                redirect('company');
            }
            $data['title'] = "Tasks";

            $data['tasks']=$row;
            
    
            $this->view('company/tasks',$data);
    
        }else{

            $task=new Task();
            $row = $task->getFirstCustom('task',['taskID'=>$id],'taskID');//get task details corresponding to the tadsk id
            

            if(!empty($row)){
                if($row->companyID!==Auth::getcompanyID()){
                    message('Unauthorized! Task is not yours');
                    redirect('company/tasks');
                }
                if(!empty($action)){
                    if($action==='pendingassignments'){//view all proposals relavant to given task id
                        $assignmentInst=new Assignment();
                        $assignments=$assignmentInst->where(['taskID'=>$id]);

                        if(empty($assignments)){
                            message('No Invitations sent!');
                            redirect('company/tasks/'.$id);
                        }

                        $studentInst=new Student();
                        $proposalInst=new Proposal();
                        for ($i = 0; $i < count($assignments); $i++) {
                            $proposal=$proposalInst->first(['proposalID'=>$assignments[$i]->proposalID]);
                            $assignments[$i]->student=$studentInst->first(['studentID'=>$proposal->studentID]);
                        }
                        $data['title'] = "Pending Assignment Invitations";
                        $data['assignments']=$assignments;
                        $data['task']=$row;
                        $this->view('company/pendingassignments',$data);
                        return;

                    }else if($action==='view-proposals'){//view all proposals relavant to given task id
                        $proposal=new Proposal();
                        $proposals=$proposal->where(['taskID'=>$id]);
                        $data['title'] = "Proposals";
                        $data['task']=$row;
                        $data['proposals']=$proposals;
                        $this->view('company/proposals',$data);
                        return;

                    }else if($action==='proposal'){//view proposals relavant to given proposal id that given for the task
                        if(!empty($id2)){
                            $proposalInst=new Proposal();
                            $proposal=$proposalInst->first(['proposalID'=>$id2]);
                            if(!empty($proposal)){
                                $studentInst=new Student();
                                $student=$studentInst->first(['studentID'=>$proposal->studentID]);
                                $universityInst=new University();
                                $university=$universityInst->first(['universityID'=>$student->universityID]);
                                $data['title'] = "Proposals";
                                $data['task']=$row;
                                $data['student']=$student;
                                $data['university']=$university;
                                $data['proposal']=$proposal;
                                $this->view('company/proposal',$data);
                                return;
                            }
                            message('Invalid Proposal ID!');
                            redirect('company/tasks/'.$id.'/view-proposals');
                            return;
                        }
                    }else if($action==='assign'){
                        //in here id 2 will be proposal id
                        if(empty($id2)){
                            message('Select a Proposal to assign!');
                            redirect('company/tasks/'.$id.'/view-proposals');
                        }

                        $proposalInst=new Proposal();
                        $proposal=$proposalInst->first(['proposalID'=>$id2]);

                        if(!empty($proposal)){
                            if($proposal->taskID==$id){//proposal is relevant to the same task

                                //id2 is proposal id

                                $assignment=new Assignment();
                                $assignment->insert(['proposalID'=>$id2,'taskID'=>$id]);
                                // $task->update(['acceptedProposalID'=>$id2,'assignedStudentID'=>$proposal->studentID],$row->taskID);

                                message('Invitation for the task sent successfully!');
                                redirect('company/pendingassignments');
                            }
                        }

                    }
                    
                    message('Invalid Action!');
                    redirect('company');
                    return;
                }
        
            
            
            
                if($row->companyID===Auth::getcompanyID()){
                    
                    $data['task']=$row;
                    $data['title'] = $row->title;
        
                    $this->view('company/task',$data);
                }else{
                    message('Unauthorized');
                    redirect('company/tasks');
                }
            }else{

                message('Error fetching data!');
                redirect('company/tasks');
            }
    
    
        }
    }

    //to check others profiles
    public function viewstudents($id=null){



        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the company section!');
            redirect('login');
        }
        if(!Auth::is_company()){///if not an admin, redirect to home
            message('Only companies can view company dashboard!');
            redirect('home');
        }
      
      



        if(!empty($id)){

            $studentInst = new Student();
            $student = $studentInst->first((['studentID'=>$id]));//get user details corresponding to the user id
            
 

            if(!empty($student)){
                $userInst = new User();
                $user = $userInst->first((['userID'=>$student->userID]));
                $universityInst = new University();
                $university = $universityInst->first((['universityID'=>$student->universityID]));

                //get details of user from relevant table and make a combined object 
                $combinedObject = (object)array_merge((array)$student, (array)$user);
                $combinedObject2 = (object)array_merge((array)$combinedObject, (array)$university);
            
                //pass the combined object to the view
                $data['user']=$combinedObject2;
                // show($combinedObject2);
                // die;

                $data['title'] = "Other User Profiles";
                
                $this->view('company/otherProfile',$data);
                return;
            }
        }
        
        message('Invalid User ID!');
        redirect('company');
    }

    //post tasks
    public function post(){

        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the company section!');
            redirect('login');
        }
        if(!Auth::is_company()){///if not an admin, redirect to home
            message('Only companies can view company dashboard!');
            redirect('home');
        }

        //if the method is post->creatre task
        if($_SERVER['REQUEST_METHOD']=="POST"){
            
            $task=new Task();
            $_POST['status']='active';
            $_POST['companyID']=Auth::getcompanyID();
            if(empty($_POST['deadline']))unset($_POST['deadline']);

            $task->insert($_POST);

            message('Task Posted Successfully!');
            redirect('company/tasks');
        }

        $category=new Category();
        $row=$category->getAll();
        $data['categories'] = $row;

        $data['title'] = "Post Task";
        
        $this->view('company/post',$data);
           
    
    }
    

    //modify tasks
    public function modify($id=null){

        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the company section!');
            redirect('login');
        }
        if(!Auth::is_company()){///if not an admin, redirect to home
            message('Only companies can view company dashboard!');
            redirect('home');
        }
        
        if(empty($id)){
            message('Choose a task to modify!');
            redirect('company/tasks');
    
        }else{
            
            //if the method is post->update task
            if($_SERVER['REQUEST_METHOD']=="POST"){
                
                $task=new Task();
                $_POST['status']='active';
                $_POST['companyID']=Auth::getcompanyID();
                if(empty($_POST['deadline']))unset($_POST['deadline']);
                
                $task->update($_POST,$id);

                message('Task Updated Successfully!');
                redirect('company/tasks/'.$id);
            }


            $task=new Task();
            $row = $task->getFirstCustom('task',['taskID'=>$id],'taskID');//get task details corresponding to the tadsk id
            
            if(!empty($row)){
                if($row->companyID===Auth::getcompanyID()){
                    
                    $category=new Category();
                    $row2=$category->getAll();
                    $data['categories'] = $row2;
                    
                    $data['task']=$row;
                    $data['title'] = "Modify - ".$row->title;
                    
                    $this->view('company/modify',$data);
                }else{

                    message('Unauthorized');
                    redirect('company/tasks');
                }
            }else{

                message('Error fetching data!');
                redirect('company/tasks');
            }
    
    
        }
    }

    //delete tasks
    public function delete($id=null){
        
            if($_SERVER['REQUEST_METHOD']=="POST"){

                if(!Auth::logged_in()){//if not logged in redirect to login page
                    message('Please login to view the company section!');
                    redirect('login');
                }
                if(!Auth::is_company()){///if not an admin, redirect to home
                    message('Only companies can view company dashboard!');
                    redirect('home');
                }

                if(!empty($id)){
                    $task=new Task();
                    $row=$task->first(['taskID'=>$id]);
                    if(!empty($row)){
                        if($row->companyID===Auth::getcompanyID()){
                            $task->delete($id);
                            message('Task Deleted Successfully!');
                            redirect('company/tasks');
                        }
                        message('Unauthorized !');
                        redirect('company/tasks');
                    }
                    message('Error Fetching!');
                    redirect('company/tasks');
                }
            }

    }

    //review
    public function review($action=null,$id=null){

        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the company section!');
            redirect('login');
        }
        if(!Auth::is_company()){///if not an admin, redirect to home
            message('Only companies can view company dashboard!');
            redirect('home');
        }

        if(!empty($action)){

            if($action==='post'){//there should be the task id with the url
                if(!empty($id)){

                    $task=new Task();
                    $row=$task->first(['taskID'=>$id,'companyID'=>Auth::getcompanyID()]);

                    if(empty($row)){//no task posted by him with the given id is found
                        message('Unauthorized!');
                        redirect('company/tasks');
                    }

                    if($row->status!=='closed'){
                        message('You cannot add the review until the task is finished!');
                        redirect('company/tasks');
                    }


                    if($_SERVER['REQUEST_METHOD']=="POST"){
                        
                        $_POST['companyID']=Auth::getcompanyID();
                        $_POST['studentID']=$row->assignedStudentID;
                        $_POST['taskID']=$id;
                        $_POST['reviewType']='companyTOstudent';

                        $review=new Review();
                        $is_review=$review->first(['taskID'=>$id,'reviewType'=>'companyTOstudent']);
                        if(!empty($is_review)){
                            message('Failed!  You have a review for this task already!');
                            redirect('company/review');
                        }
                        $review->insert($_POST);

                        message('Review Added Successfully!');
                        redirect('company/review');
                    }else{

                        $student=new Student();
                        $data['student']=$student->first(['studentID'=>$row->assignedStudentID]);//send the details of student relevant to the review
                        $data['task']=$row;
                        $data['title']='Add a Review';
                        $this->view('company/post-review',$data);
                        return;
                    }
                }else{
                    message('Choose a task to add a review!');
                    redirect('company/tasks');
                }

            }else if($action==='modify'){//there should be the review id with the url
                if(!empty($id)){

                    $review=new Review();
                    $row=$review->first(['reviewID'=>$id,'companyID'=>Auth::getcompanyID(),'reviewType'=>'companyTOstudent']);
                    $task=new Task();
                    $taskDetails=$task->first(['taskID'=>$row->taskID,'companyID'=>Auth::getcompanyID()]);
                    if(empty($row)){//no review posted by him with the given reviewID is found
                        message('Unauthorized!');
                        redirect('company/review');
                    }


                    if($_SERVER['REQUEST_METHOD']=="POST"){

                        $_POST['companyID']=Auth::getcompanyID();
                        $_POST['studentID']=$taskDetails->assignedStudentID;
                        $_POST['taskID']=$row->taskID;
                        $_POST['reviewType']='companyTOstudent';

                        $review->update($_POST,$id);

                        message('Review Updated Successfully!');
                        redirect('company/review');
                    }else{
                        $task=new Task();
                        $taskDetails=$task->first(['taskID'=>$row->taskID,'companyID'=>Auth::getcompanyID()]);
                        $data['task']=$taskDetails;

                        $student=new Student();
                        $data['student']=$student->first(['studentID'=>$row->studentID]);
                       
                        
                        $data['review']=$row;
                        $data['title']='Modify a Review';
                        $this->view('company/modify-review',$data);
                        return;
                    }
                }else{
                    message('Choose a review to modify!');
                    redirect('company/review');
                }


            }else if ($action==='delete') {//there hould be a review ID with the url
                if($_SERVER['REQUEST_METHOD']=="POST"){
                    
                    if(!empty($id)){
                        $review=new Review();
                        $row=$review->first(['reviewID'=>$id,'companyID'=>Auth::getcompanyID(),'reviewType'=>'companyTOstudent']);
                        //checking whethere theres review with the given id posted by logged in user
                        if(!empty($row)){
                            $review->delete($id);
                            message('Review Deleted Successfully!');
                            redirect('company/review');
                        }else{
                            message('Unauthorized!');
                            redirect('company/review');
                        }
                    }else{
                        message('Choose a review to delete!');
                        redirect('company/review');
                    }
                }
                redirect('company/review');
            }
        }


        $review=new Review();
        $row=$review->where(['companyID'=>Auth::getcompanyID(),'reviewType'=>'companyTOstudent']);//get reviews written by this user
        if(empty($row)){//no review posted by him with the given reviewID is found
            message('You haven\'t posted any reviews!');
            $data['title']='Reviews';
            $data['reviews']=$row;
            $this->view('company/review',$data);
            return;
        }
        $task=new Task();
        $student=new Student();
        for ($i = 0; $i < count($row); $i++) {
            $row[$i]->task=$task->first(['taskID'=>$row[$i]->taskID]);
            $row[$i]->student=$student->first(['studentID'=>$row[$i]->studentID]);
        }

        $data['title']='Reviews';
        $data['reviews']=$row;
        $this->view('company/review',$data);
    
    }

    public function inprogress(){
        
        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the company section!');
            redirect('login');
        }
        if(!Auth::is_company()){///if not an admin, redirect to home
            message('Only companies can view company dashboard!');
            redirect('home');
        }
      


        $data['title'] = "Tasks in-progress";
        $tasksInst=new Task();
        $tasks=$tasksInst->where(['status'=>'inProgress']);

        $data['tasks']=$tasks;
        $this->view('company/tasks-inprogress',$data);
    }


}