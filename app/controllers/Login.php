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
                
                
                if (password_verify($_POST['password'],$row->password)){

                    //get details of user from relevant table and ake a combined object to store as session data
                    $userDetails=$user->getFirstCustom($row->role,['userID'=>$row->userID],$row->role."ID");
                    $combinedObject = (object)array_merge((array)$row, (array)$userDetails);

                    
                    //authenticate (this will be a static class)
                    Auth::authenticate($combinedObject);

                    redirect('home');
                }
            }

            $data['errors']['email']="Wrong email or password!";
        }

        $this->view('login',$data);
    }
    
}