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
        $data['user']=$combinedObject;

        // show($combinedObject);
        // die;
        $data['title'] = "Profile";
        
        $this->view('moderator/profile',$data);
    }


    //implement this to show all users and specific user if the id is passeed with url
    public function otherusers($action=null,$id=null){

        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the moderator section!');
            redirect('login');
        }
        if(!Auth::is_moderator()){///if not an moderator, redirect to home
            message('Only moderators can view moderator dashboard!');
            redirect('home');
        }
        

        if(!empty($action)){
            if($action==='disable'){
                
                if($_SERVER['REQUEST_METHOD']=="POST"){
                
                    if(!empty($id)){//userid

                        $userInst= new User();
                        $user=$userInst->first(['userID'=>$id]);
                        if(empty($user)){
                            message('No user with given ID found');
                            redirect('moderator/otherusers');
                        }
                        
                        $userInst->update(['status'=>'deactivated'],$user->userID);
                        message('Deactivation Successful!');
                    }
                }
                redirect('moderator/otherusers');
            }else if($action==='enable'){

                if($_SERVER['REQUEST_METHOD']=="POST"){
                
                    if(!empty($id)){//userid

                        $userInst= new User();
                        $user=$userInst->first(['userID'=>$id]);
                        if(empty($user)){
                            message('No user with given ID found');
                            redirect('moderator/otherusers');
                        }
                        
                        $userInst->update(['status'=>'active'],$user->userID);
                        message('Activation Successful!');
                    }
                }
                redirect('moderator/otherusers');
            }
        }
        $user = new User();
        $row = $user->getAll();

        if(empty($row)){

            message('Error fetching data');
            redirect('moderator');

            // //get details of user from relevant table and make a combined object 
            // $userDetails=$user->getFirstCustom($row->role,['userID'=>$row->userID],$row->role."ID");
            // $combinedObject = (object)array_merge((array)$row, (array)$userDetails);
        }

        for ($i = 0; $i < count($row); $i++) {
            $userDetails=$user->getFirstCustom($row[$i]->role,['userID'=>$row[$i]->userID],$row[$i]->role."ID");
            if(empty($userDetails)){
                message('Error fetching data '.$row[$i]->userID);
                redirect('moderator');
            }
            if($row[$i]->role==='student'){//removing 'status' key from the result because user table also have a status field
                $userDetails->studentStatus=$userDetails->status;
                unset($userDetails->status);
            }
            if($row[$i]->role==='company'){//removing 'status' key from the result because user table also have a status field
                $userDetails->companyStatus=$userDetails->status;
                unset($userDetails->status);
            }
            $row[$i] = (object)array_merge((array)$row[$i], (array)$userDetails);
        }

        //pass the combined object to the view
        $data['users']=$row;
        

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
            redirect('moderator/profile');
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
            redirect('moderator/profile');
        }


        $this->view('moderator/updateprofile',$data);
    }

    public function university($action=null,$id=null){

        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the moderator section!');
            redirect('login');
        }
        if(!Auth::is_moderator()){///if not an moderator, redirect to home
            message('Only moderators can view moderator dashboard!');
            redirect('home');
        }

        if(!empty($action)){
            if($action==="post"){//for new uni
                if($_SERVER['REQUEST_METHOD']=="POST"){
                    
                    $university=new University();
                    $isThere=$university->first(['domain'=>$_POST['domain']]);
                    if(!empty($isThere)){
                        message('University Domain Already Exists!');
                        redirect('moderator/university');
                    }
                    $university->insert($_POST);

                    message('University Added Successfully!');
                    redirect('moderator/university');
                }
                $data['title'] = "New University";
                $this->view('moderator/post-university',$data);
                return;
            
            }else if($action==='modify'){//to update
                if(!empty($id)){
                    if($_SERVER['REQUEST_METHOD']=="POST"){

                        $university=new University();
                        $isThere=$university->first(['domain'=>$_POST['domain']]);
                        if(!empty($isThere) && $isThere->universityID!=$id){
                            message('University Domain Already Exists!');
                            redirect('moderator/university');
                        }
                        $university->update($_POST,$id);

                        message('University Modified Successfully!');
                        redirect('moderator/university');
                    }
                    $university=new University();
                    $row=$university->first(['universityID'=>$id]);
                    if(!empty($row)){
                        $data['university']=$row;
                        $data['title'] = "Modify - ".$row->universityName;
                        $this->view('moderator/modify-university',$data);
                        return;
                    }
                    message('Error fetching data!');
                    redirect('moderator/university');
                }else{
                    message('Choose a university to modify!');
                    redirect('moderator/university');
                }
            }else if($action==='delete'){//to delete
                if($_SERVER['REQUEST_METHOD']=="POST"){
    
                    if(!empty($id)){
                        $university=new University();
                        $row=$university->first(['universityID'=>$id]);
                        if(!empty($row)){
                            $studentInst=new Student();
                            $student=$studentInst->first(['universityID'=>$row->universityID]);
                            If(!empty($student)){
                                message('Cannot delete the university domain while students are there from that domain!');
                                redirect('moderator/university');
                            }
                            $university->delete($id);
                            message('University Deleted Successfully!');
                            redirect('moderator/university');
                        }
                        message('Error Fetching!');
                        redirect('moderator/university');
                    }else{
                        message('Choose a university to delete!');
                        redirect('moderator/university');
                    }
                }
                redirect('moderator/university');

            }
        }
        
        $university=new University();
        $universities=$university->getAll();
        if(empty($universities)){
            message('No universities in the database!');
            redirect('moderator');
        }

        $student=new Student();
        for ($i = 0; $i < count($universities); $i++) {
            $countUsers=$student->where(['universityID'=>$universities[$i]->universityID]);
            if(!empty($countUsers))$universities[$i]->userCount=count($countUsers);
            else $universities[$i]->userCount=0;
            
        }

        $data['universities']=$universities;
        $data['title'] = "Universities";
        
        $this->view('moderator/university',$data);
    }

    //category
    public function category($action=null,$id=null){

        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the moderator section!');
            redirect('login');
        }
        if(!Auth::is_moderator()){///if not an moderator, redirect to home
            message('Only moderators can view moderator dashboard!');
            redirect('home');
        }
        
        if(!empty($action)){
            if($action==="post"){//for new category
                if($_SERVER['REQUEST_METHOD']=="POST"){
                        
                    $category=new Category();
                    $category->insert($_POST);
        
                    message('Category Added Successfully!');
                    redirect('moderator/category');
                }
                $data['title'] = "New Category";
                $this->view('moderator/post-category',$data);
                return;
            
            }else if($action==='modify'){//to update
                if(!empty($id)){
                    if($_SERVER['REQUEST_METHOD']=="POST"){
        
                        $category=new Category();
                        $category->update($_POST,$id);
        
                        message('Category Modified Successfully!');
                        redirect('moderator/category');
                    }
                    $category=new Category();
                    $row=$category->first(['categoryID'=>$id]);
                    if(!empty($row)){
                        $data['category']=$row;
                        $data['title'] = "Modify - ".$row->title;
                        $this->view('moderator/modify-category',$data);
                        return;
                    }
                    message('Error fetching data!');
                    redirect('moderator/category');
                }else{
                    message('Choose a category to modify!');
                    redirect('moderator/category');
                }
            }else if($action==='delete'){//to delete
                if($_SERVER['REQUEST_METHOD']=="POST"){
        
                    if(!empty($id)){
                        $category=new Category();
                        $row=$category->first(['categoryID'=>$id]);
                        if(!empty($row)){
                            $taskInst=new Task();
                            $tasks=$taskInst->first(['categoryID'=>$row->categoryID]);
                            if(!empty($tasks)){
                                message('Category Cannot be Deleted while tasks are there from that category!');
                                redirect('moderator/category');
                            }
                            $category->delete($id);
                            message('Category Deleted Successfully!');
                            redirect('moderator/category');
                        }
                        message('Error Fetching!');
                        redirect('moderator/category');
                    }else{
                        message('Choose a category to delete!');
                        redirect('moderator/category');
                    }
                }
                redirect('moderator/category');
        
            }
        }
        
        $category=new Category();
        $categories=$category->getAll();
        if(empty($categories)){
            message('No categories in the database!');
            redirect('moderator');
        }
        
        $task=new Task();
        for ($i = 0; $i < count($categories); $i++) {
            $countTasks=$task->where(['categoryID'=>$categories[$i]->categoryID,'status'=>'active']);
            if(!empty($countTasks))$categories[$i]->taskCount=count($countTasks);
            else $categories[$i]->taskCount=0;
            
        }
        
        $data['categories']=$categories;
        $data['title'] = "Categories";
        
        $this->view('moderator/category',$data);
    }
}