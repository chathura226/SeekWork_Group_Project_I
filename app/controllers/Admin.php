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
        $data['user']=$combinedObject;

        // show($combinedObject);
        // die;
        $data['title'] = "Profile";
        
        $this->view('admin/profile',$data);
    }


    //implement this to show all users and specific user if the id is passeed with url
    public function otherusers($id=null){

        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the admin section!');
            redirect('admin');
        }
        if(!Auth::is_admin()){///if not an admin, redirect to home
            message('Only admins can view admin dashboard!');
            redirect('home');
        }
        


        $user = new User();
        $row = $user->getAll();

        if(empty($row)){

            message('Error fetching data');
            redirect('admin');

            // //get details of user from relevant table and make a combined object 
            // $userDetails=$user->getFirstCustom($row->role,['userID'=>$row->userID],$row->role."ID");
            // $combinedObject = (object)array_merge((array)$row, (array)$userDetails);
        }

        for ($i = 0; $i < count($row); $i++) {
            $userDetails=$user->getFirstCustom($row[$i]->role,['userID'=>$row[$i]->userID],$row[$i]->role."ID");
            if(empty($userDetails)){
                message('Error fetching data '.$row[$i]->userID);
                redirect('admin');
            }

            $row[$i] = (object)array_merge((array)$row[$i], (array)$userDetails);
        }

        //pass the combined object to the view
        $data['users']=$row;


        $data['title'] = "Other Users";
        
        $this->view('admin/otherusers',$data);
    }


    public function changepassword(){
        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the admin section!');
            redirect('login');
        }
        if(!Auth::is_admin()){///if not an admin, redirect to home
            message('Only admins can view admin dashboard!');
            redirect('home');
        }

        
        $data['title'] = "Change Password";
        
        

        //should implement the validation and procedure
        if($_SERVER['REQUEST_METHOD']=="POST"){
            
            message("Password changed successfully!");
            redirect('admin');
        }


        $this->view('admin/changepassword',$data);
    }

    public function updateprofile(){
        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the admin section!');
            redirect('login');
        }
        if(!Auth::is_admin()){///if not an admin, redirect to home
            message('Only admins can view admin dashboard!');
            redirect('home');
        }

        
        $data['title'] = "Update Profile";
        
        

        //should implement the validation and procedure
        if($_SERVER['REQUEST_METHOD']=="POST"){
            
            message("Profile updated successfully!");
            redirect('admin');
        }


        $this->view('admin/updateprofile',$data);
    }
}