<?php

//Admin class
class Admin extends Controller{

    public function index(){
        
        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the admin section!');
            redirect('login');
        }
        if(!Auth::is_admin()){///if not an admin, redirect to home
            message('Only admins can view admin dashboard!');
            redirect('home');
        }
        $data['title'] = "Dashboard";
        
        $this->view('admin/dashboard',$data);
    }

    public function profile($id=null){

        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the admin section!');
            redirect('login');
        }
        if(!Auth::is_admin()){///if not an admin, redirect to home
            message('Only admins can view admin dashboard!');
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
        
        $this->view('admin/profile',$data);
    }
}