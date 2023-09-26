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
}