<?php

//Tasks class
class Tasks extends Controller{

    public function index($id=null){
        
        if(empty($id)){

        $data['title'] = "Tasks";
        
        $task=new Task();
        $row=$task->where(['status'=>'active']);
        $data['tasks']=$row;
        

        $this->view('tasks',$data);

        }else{

            $task=new Task();
            $row = $task->getFirstCustom('task',['taskID'=>$id],'taskID');//get task details corresponding to the tadsk id

            if(!empty($row)){
                
                $company=new Company();
                $compDetails=$company->first(['companyID'=>$row->companyID]);
                $user = new User();
                $userdetails=$user->first(['userID'=>$compDetails->userID]);
                $compDetails->createdAt=$userdetails->createdAt;
                
                if(!empty($compDetails)){
                    $data['error']="Error fetching data!";
                }

                $data['company'] = $compDetails;
                
                $data['title'] = $row->title;
                $data['task']=$row;
        
                $this->view('task/task',$data);

            }else{

                $data['title']="404";
                $this->view("404",$data);

            }


        }
    }

    //applying for tasks
    public function apply($id=null){

        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the student section!');
            redirect('login');
        }
        if(!Auth::is_student()){///if not a student, redirect to home
            message('Only students can apply for tasks!');
            redirect('home');
        }
        if(empty($id)){
            redirect('tasks');
        }else{

            //if a post request--------------------------------------------------------------------------
            //should implement the validation and procedure
            if($_SERVER['REQUEST_METHOD']=="POST"){
            
            message("Proposal Submitted Successfully!");
            redirect('tasks');
            }


            //if not a post request-------------------------------------------------------------------------
            $task=new Task();
            $row = $task->getFirstCustom('task',['taskID'=>$id],'taskID');//get task details corresponding to the tadsk id

            if(!empty($row)){
                
                $company=new Company();
                $compDetails=$company->first(['companyID'=>$row->companyID]);
                $user = new User();
                $userdetails=$user->first(['userID'=>$compDetails->userID]);
                $compDetails->createdAt=$userdetails->createdAt;
                
                if(!empty($compDetails)){
                    $data['error']="Error fetching data!";
                }

                $data['company'] = $compDetails;
                $data['task']=$row;
        
                $data['title'] = "Apply - ".$row->title;
        
                $this->view('task/apply',$data);

            }else{

                $data['title']="404";
                $this->view("404",$data);

            }




            
        }


    }
    
}