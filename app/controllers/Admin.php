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
            if($_POST['newpassword']!==$_POST['confirmnewpassword']){
                message("Password and confirm password does not match!");
                redirect('admin/changepassword');
            }
            $userInst = new User();
            $user=$userInst->first(['userID'=>Auth::getuserID()]);
            if (password_verify($_POST['currentpassword'],$user->password)){
                $password=password_hash($_POST['newpassword'],PASSWORD_DEFAULT);
                $userInst->update(['password'=>$password],Auth::getuserID());
                message("Password Updated Successfully!");
                redirect('admin/profile');
            }else{
                message("Current password is wrong!");
                redirect('admin/changepassword');
            }
        }


        $this->view('admin/changepassword',$data);
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

            // //get details of uvalidateModeratorser from relevant table and make a combined object 
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
            redirect('admin/profile');
        }


        $this->view('admin/updateprofile',$data);
    }


    public function managemoderators($action=null,$id=null){
        
        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the admin section!');
            redirect('login');
        }
        if(!Auth::is_admin()){///if not an admin, redirect to home
            message('Only admins can view admin dashboard!');
            redirect('home');
        }

        if(!empty($action)){
            if($action==='post'){//add new moderator

                $data['title'] = "New Moderator";

                $data['errors']=[]; 
                $user=new User();

                if($_SERVER['REQUEST_METHOD']=="POST"){
                    if($user->validateModerator($_POST)){

                        $_POST['password']=password_hash($_POST['password'],PASSWORD_DEFAULT);
                        $_POST['role']="moderator";
                        $user->insert($_POST);
                        
                        //at this point user is added to the user table. now we can get userID from it 
                        // and put inside the _POST so that it can be added to company dtabase
                        //note that email is unique, so only one user can exist
                        $row=$user->first([
                            'email'=>$_POST['email'],
                        ]);
                        $_POST['userID']=$row->userID;
    
                        $moderatorInst= new Moderator();
                        $moderatorInst->insert($_POST);//default value for verification status is set to 'pending' from the database
    
                        message("Moderator account creation successful!");
                        redirect('admin/managemoderators');
        
                    }
                }
                $data['errors']=$user->errors;
                
                $this->view('admin/post-moderators',$data);
                return;
            }else if($action==='disable'){//disable admin user

                if($_SERVER['REQUEST_METHOD']=="POST"){
                
                    if(!empty($id)){//admin id of diabling user   
                        //get corresponding user id
                        $moderatorInst= new Moderator();
                        $moderator=$moderatorInst->first(['moderatorID'=>$id]);
                        if(empty($moderator)){
                            message('No user with given moderatorID found');
                            redirect('admin/managemoderators');
                        }
                        
                        $user=new User();
                        $user->update(['status'=>'deactivated'],$moderator->userID);
                        message('Deactivation Successful!');
                    }
                }
                redirect('admin/managemoderators');

            }else if($action==='enable'){//enable admin user

                if($_SERVER['REQUEST_METHOD']=="POST"){
                
                    if(!empty($id)){//admin id of diabling user   
                        //get corresponding user id
                        $moderatorInst= new Moderator();
                        $moderator=$moderatorInst->first(['moderatorID'=>$id]);
                        if(empty($moderator)){
                            message('No user with given moderatorID found');
                            redirect('admin/managemoderators');
                        }
                        
                        $user=new User();
                        $user->update(['status'=>'active'],$moderator->userID);
                        message('Activation Successful!');
                    }
                }
                redirect('admin/managemoderators');
            }
        }
        $userInst=new User();
        $moderatorInst=new Moderator();
        $moderators=$userInst->where(['role'=>'moderator']);

        for ($i = 0; $i < count($moderators); $i++) {
            $moderatorDetails=$moderatorInst->first(['userID'=>$moderators[$i]->userID]);

            $moderators[$i] = (object)array_merge((array)$moderators[$i], (array)$moderatorDetails);
        }
        $data['moderators']=$moderators;

        $data['title'] = "Manage Moderators";
        
        $this->view('admin/view-moderators',$data);
    }

    public function manageadmins($action=null,$id=null){
        
        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the admin section!');
            redirect('login');
        }
        if(!Auth::is_admin()){///if not an admin, redirect to home
            message('Only admins can view admin dashboard!');
            redirect('home');
        }

        if(!empty($action)){
            if($action==='post'){//add new moderator

                $data['title'] = "New Admin";

                $data['errors']=[]; 
                $user=new User();

                if($_SERVER['REQUEST_METHOD']=="POST"){
                    if($user->validateAdmin($_POST)){

                        $_POST['password']=password_hash($_POST['password'],PASSWORD_DEFAULT);
                        $_POST['role']="admin";
                        $user->insert($_POST);
                        
                        //at this point user is added to the user table. now we can get userID from it 
                        // and put inside the _POST so that it can be added to company dtabase
                        //note that email is unique, so only one user can exist
                        $row=$user->first([
                            'email'=>$_POST['email'],
                        ]);
                        $_POST['userID']=$row->userID;
    
                        $adminInst= new AdminModel();
                        $adminInst->insert($_POST);//default value for verification status is set to 'pending' from the database
    
                        message("Admin account creation successful!");
                        redirect('admin/manageadmins');
        
                    }
                }
                $data['errors']=$user->errors;
                
                $this->view('admin/post-admins',$data);
                return;


            }else if($action==='disable'){//disable admin user

                if($_SERVER['REQUEST_METHOD']=="POST"){
                
                    if(!empty($id)){//admin id of diabling user   
                        //get corresponding user id
                        $adminInst= new AdminModel();
                        $admin=$adminInst->first(['adminID'=>$id]);
                        if(empty($admin)){
                            message('No user with given adminID found');
                            redirect('admin/manageadmins');
                        }
                        
                        $user=new User();
                        $user->update(['status'=>'deactivated'],$admin->userID);
                        message('Deactivation Successful!');
                    }
                }
                redirect('admin/manageadmins');

            }else if($action==='enable'){//enable admin user

                if($_SERVER['REQUEST_METHOD']=="POST"){
                
                    if(!empty($id)){//admin id of diabling user   
                        //get corresponding user id
                        $adminInst= new AdminModel();
                        $admin=$adminInst->first(['adminID'=>$id]);
                        if(empty($admin)){
                            message('No user with given adminID found');
                            redirect('admin/manageadmins');
                        }
                        
                        $user=new User();
                        $user->update(['status'=>'active'],$admin->userID);
                        message('Activation Successful!');
                    }
                }
                redirect('admin/manageadmins');
            }
        }
        $userInst=new User();
        $adminInst=new AdminModel();
        $admins=$userInst->where(['role'=>'admin']);

        for ($i = 0; $i < count($admins); $i++) {
            $adminDetails=$adminInst->first(['userID'=>$admins[$i]->userID]);

            $admins[$i] = (object)array_merge((array)$admins[$i], (array)$adminDetails);
        }
        $data['admins']=$admins;

        $data['title'] = "Manage Admins";
        
        $this->view('admin/view-admins',$data);
    }
    
}