<?php

//Moderator class
class Moderator extends Controller{

    public function index(){
        
        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the moderator section!');
            redirect('login');
        }
        if(!Auth::is_moderator()){///if not an moderator, redirect to home
            message('Only moderators can view moderator dashboard!');
            redirect('home');
        }
        $data['title'] = "Dashboard";
        
        $this->view('moderator/dashboard',$data);
    }

    public function profile($id=null){

        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the moderator section!');
            redirect('login');
        }
        if(!Auth::is_moderator()){///if not an moderator, redirect to home
            message('Only moderators can view moderator dashboard!');
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
        
        $this->view('moderator/profile',$data);
    }


    //implement this to show all users and specific user if the id is passeed with url
    public function otherusers($id=null){

        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the moderator section!');
            redirect('login');
        }
        if(!Auth::is_moderator()){///if not an moderator, redirect to home
            message('Only moderators can view moderator dashboard!');
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


        $data['title'] = "Other Users";
        
        $this->view('moderator/otherusers',$data);
    }


    public function changepassword(){
        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the moderator section!');
            redirect('login');
        }
        if(!Auth::is_moderator()){///if not an moderator, redirect to home
            message('Only moderators can view moderator dashboard!');
            redirect('home');
        }

        
        $data['title'] = "Change Password";
        
        

        //should implement the validation and procedure
        if($_SERVER['REQUEST_METHOD']=="POST"){
            
            message("Password changed successfully!");
            redirect('moderator');
        }


        $this->view('moderator/changepassword',$data);
    }

    public function updateprofile(){
        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the moderator section!');
            redirect('login');
        }
        if(!Auth::is_moderator()){///if not an moderator, redirect to home
            message('Only moderators can view moderator dashboard!');
            redirect('home');
        }

        
        $data['title'] = "Update Profile";
        
        

        //should implement the validation and procedure
        if($_SERVER['REQUEST_METHOD']=="POST"){
            
            message("Profile updated successfully!");
            redirect('moderator');
        }


        $this->view('moderator/updateprofile',$data);
    }
}