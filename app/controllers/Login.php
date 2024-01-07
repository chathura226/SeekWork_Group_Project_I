<?php

//login class
class Login extends Controller{

    public function index(){
        
        $data['title'] = "Login";
        $data['errors']=[]; 
        $user=new User();
        if($_SERVER['REQUEST_METHOD']=="POST"){

            //validate
            $row = $user->first([
                'email'=>$_POST['email'],
            ]);
            
            //if not found, $row will be false
            if($row){
                
                //TODO: whether deleted account according to new column isDeleted

                if (password_verify($_POST['password'],$row->password)){

                    //if account is deleted
                    if($row->isDeleted){
                        message(['Your account has been deleted! </br>Please contact the administrator!','danger']);
                        Log::info("Login attempt from a deleted user.",['IP_Address'=>$_SERVER['REMOTE_ADDR']]);
                        redirect('login');
                    }

                    if($row->status==='deactivated'){
                        message(['Your account has been deactivated! </br>Please contact the administrator!','danger']);
                        Log::info("Login attempt from a deactivated user.",['IP_Address'=>$_SERVER['REMOTE_ADDR']]);
                        redirect('login');
                    }



                    $joiningTables=[$row->role];
                    $joinConditions=["user.userID=".$row->role."."."userID"];
                    //if user is a student put university details too
                    if($row->role==='student'){
                        $joiningTables[]="university";
                        $joinConditions[]="student.universityID=university.universityID";
                    }
                    //use innerjoin and take first element
                    $combinedObject = $user->innerJoin($joiningTables,$joinConditions,['user.userID'=>$row->userID])[0];

                    //get skills related to student
                    if($row->role==='student'){
                        $skillInst=new Skill();
                        $res=$skillInst->innerJoin(['student_skill'],['skill.skillID=student_skill.skillID'],['studentID'=>$combinedObject->studentID]);
                        $combinedObject->skills=$res;
                    }
                    // show($combinedObject);
                    // die;
                    //authenticate (this will be a static class)
                    Auth::authenticate($combinedObject);
                    Log::info("User Logged in Successfully!",['user_id' => Auth::getuserID(), 'IP_Address'=>$_SERVER['REMOTE_ADDR']]);
                    redirect($row->role);
                }
            }

            $data['errors']['email']="Wrong email or password!";
            Log::info("Failed login attempt from a user.",['IP_Address'=>$_SERVER['REMOTE_ADDR']]);

        }

        $this->view('login',$data);
    }
    
}