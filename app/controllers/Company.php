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

        if(empty($id)){

            
            $task=new Task();
            $row=$task->where(['companyID'=>Auth::getcompanyID()]);
            
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
                    $data['error']="Unauthorized!";

                    redirect('company/tasks');
                }
            }else{
                $data['error']="Error fetching data!";

                redirect('company/tasks');
            }
    
    
        }
    }
}