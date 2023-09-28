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


    public function tasks($id=null){

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
}