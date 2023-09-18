<?php

//signup class
class Signup extends Controller{

    public function index(){
        
        $data['errors']=[];
        $user=new User();
        if($_SERVER['REQUEST_METHOD']=="POST"){
            if($user->validate($_POST)){

                $_POST['password']=password_hash($_POST['password'],PASSWORD_DEFAULT);
                $_POST['role']="student";
                $user->insert($_POST);

                message("Account creation successful! Please Log in.");
                redirect('login');

            }
        }

        // show($_POST);
        // show($user->errors);
        $data['errors']=$user->errors;
        $data['title'] = "Signup";
        
        $this->view('signup',$data);
    }
    
}