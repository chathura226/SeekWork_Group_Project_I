<?php

//this cannot be instantiated directly. should extend
//users class - have common functions for all type of users
abstract class Users extends Controller{

    protected $controllerRole;
    //only subclasses can instantiate
    protected function __construct($controllerUserRole) {

        $this->all_common_verifications($controllerUserRole);
        $this->controllerRole=$controllerUserRole;

    }


    protected function all_common_verifications($controllerUserRole)
    {
        if (!Auth::logged_in()) { //if not logged in redirect to login page
            message('Please login to view the '.$controllerUserRole.' section!');
            redirect('login');
        }
        if (!Auth::is_otp_verified()) {
            message(['Verify Email before accessing dashboard!', 'danger']);
            redirect('otp');
        }

        //if param is admin, call is_admin function etc...
        $method = 'is_' . $controllerUserRole;
        if (!call_user_func(array('Auth', $method))) { ///if not an user related to given controller role, redirect to home
            message(['Only '.$controllerUserRole.'s can view '.$controllerUserRole.' dashboard!', 'danger']);
            redirect('home');
        }
    }

    //index dashboard page
    public function index()
    {
        $data['title'] = "Dashboard";
        $this->view($this->controllerRole.'/dashboard', $data);
    }
    
}