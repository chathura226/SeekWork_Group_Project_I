<?php

//signup class
class Signup extends Controller
{

    public function index()
    {

        $data['errors'] = [];
        $user = new User();
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
//             print_r($_POST);
//             die;

            //validating student data and inserting to database
            if ($_POST['form_id'] === 'student') {
                if ($user->validateStudent($_POST)) {
                    //since we validated the data, its sure that the domain is in the databse
                    $emailParts = explode("@", $_POST['email']);
                    $domain = $emailParts[1]; //part after @ symbol

                    $univeersityInst = new University();
                    $row = $univeersityInst->first(['domain' => $domain]);
                    if(empty($row)){
                        message(["Error creating account. Try again",'danger']);
                        redirect('login');
                    }
                    $_POST['universityID']=$row->universityID;

                    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $_POST['role'] = "student";
                    $user->insert($_POST);

                    //at this point user is added to the user table. now we can get userID from it 
                    // and put inside the _POST so that it can be added to student dtabase
                    //note that email is unique, so only one user can exist
                    $row = $user->first([
                        'email' => $_POST['email'],
                    ]);
                    $_POST['userID'] = $row->userID;



                    $student = new StudentModel();
                    $student->insert($_POST); //default value for verification status is set to 'pending' from the database

                    message("Account creation successful! Please Log in.");
                    redirect('login');
                }
            } else if ($_POST['form_id'] === 'company') { //validating company data and inserting into database
                if ($user->validateCompany($_POST)) {

                    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $_POST['role'] = "company";
                    $user->insert($_POST);

                    //at this point user is added to the user table. now we can get userID from it 
                    // and put inside the _POST so that it can be added to company dtabase
                    //note that email is unique, so only one user can exist
                    $row = $user->first([
                        'email' => $_POST['email'],
                    ]);
                    $_POST['userID'] = $row->userID;

                    $company = new CompanyModel();
                    $company->insert($_POST); //default value for verification status is set to 'pending' from the database

                    message("Account creation successful! Please Log in.");
                    redirect('login');
                }
            }
            // if($user->validate($_POST)){

            //     $_POST['password']=password_hash($_POST['password'],PASSWORD_DEFAULT);
            //     $_POST['role']="student";
            //     $user->insert($_POST);

            //     message("Account creation successful! Please Log in.");
            //     redirect('login');

            // }
        }

        // show($_POST);
        // show($user->errors);

        //since controller comes to here only when theres an error, we are going to pass formID as error data so that, 
        // front end will show the same form that we submit

        if (!empty($_POST['form_id'])) $user->errors['form_id'] = $_POST['form_id'];
        $data['errors'] = $user->errors;
        $data['title'] = "Signup";

        $this->view('signup', $data);
    }
}
