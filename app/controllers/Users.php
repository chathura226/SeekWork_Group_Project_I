<?php

//this cannot be instantiated directly. should extend
//users class - have common functions for all type of users
abstract class Users extends Controller
{

    protected $controllerRole;
    //only subclasses can instantiate
    protected function __construct($controllerUserRole)
    {

        $this->all_common_verifications($controllerUserRole);
        $this->controllerRole = $controllerUserRole;
    }


    protected function all_common_verifications($controllerUserRole)
    {
        if (!Auth::logged_in()) { //if not logged in redirect to login page
            message('Please login to view the ' . $controllerUserRole . ' section!');
            redirect('login');
        }
        if (!Auth::is_otp_verified()) {
            message(['Verify Email before accessing dashboard!', 'danger']);
            redirect('otp');
        }

        //if param is admin, call is_admin function etc...
        $method = 'is_' . $controllerUserRole;
        if (!call_user_func(array('Auth', $method))) { ///if not an user related to given controller role, redirect to home
            message(['Only ' . $controllerUserRole . 's can view ' . $controllerUserRole . ' dashboard!', 'danger']);
            redirect('home');
        }
    }

    //index dashboard page
    public function index()
    {
        $data['title'] = "Dashboard";
        $this->view($this->controllerRole . '/dashboard', $data);
    }

    //profile views
    public function profile($id = null)
    {
        //if id is null make it current logged in user id
        $id = $id ?? Auth::getuserID();

        $user = new User();
        $row = $user->first((['userID' => $id])); //get user details corresponding to the user id

        if (!empty($row)) {
            //get details of user from relevant table and make a combined object 
            $userDetails = $user->getFirstCustom($row->role, ['userID' => $row->userID], $row->role . "ID");
            $combinedObject = (object)array_merge((array)$row, (array)$userDetails);
        } else  $combinedObject = null;
        //pass the combined object to the view
        $data['user'] = $combinedObject;

        // show($combinedObject);
        // die;
        $data['title'] = "Profile";

        $this->view($this->controllerRole . '/profile', $data);
    }

    //change password
    public function changepassword()
    {

        $data['title'] = "Change Password";

        //should implement the validation and procedure
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($_POST['newpassword'] !== $_POST['confirmnewpassword']) {
                message(["Password and confirm password does not match!", 'danger']);
                redirect($this->controllerRole . '/changepassword');
            }
            $userInst = new User();
            $user = $userInst->first(['userID' => Auth::getuserID()]);
            if (password_verify($_POST['currentpassword'], $user->password)) {
                $password = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
                $userInst->update(['password' => $password], Auth::getuserID());
                message("Password Updated Successfully!");
                redirect($this->controllerRole . '/profile');
            } else {
                message(["Current password is wrong!", 'danger']);
                redirect($this->controllerRole . '/changepassword');
            }
        }

        $this->view($this->controllerRole . '/changepassword', $data);
    }

    //only moderators and admins can use this function
    // show all users and specific user if the id is passeed with url
    public function otherusers($action = null, $id = null)
    {

        if (!($this->controllerRole == 'admin' || $this->controllerRole == 'moderator')) {
            message(["Unauthorized!", 'danger']);
            redirect($this->controllerRole);
        }

        if (!empty($action)) {
            if ($action === 'disable') {

                if ($_SERVER['REQUEST_METHOD'] == "POST") {

                    if (!empty($id)) { //userid

                        $userInst = new User();
                        $user = $userInst->first(['userID' => $id]);
                        if (empty($user)) {
                            message(['No user with given ID found', 'danger']);
                            redirect($this->controllerRole . '/otherusers');
                        } else if ($this->controllerRole == 'moderator' && ($user->role == 'admin' || $user->role == 'moderator')) {
                            message(['Unauthorized', 'danger']);
                            redirect($this->controllerRole . '/otherusers');
                        }

                        $userInst->update(['status' => 'deactivated'], $user->userID);
                        message('Deactivation Successful!');
                    }
                }
                redirect($this->controllerRole . '/otherusers');
            } else if ($action === 'enable') {

                if ($_SERVER['REQUEST_METHOD'] == "POST") {

                    if (!empty($id)) { //userid

                        $userInst = new User();
                        $user = $userInst->first(['userID' => $id]);
                        if (empty($user)) {
                            message(['No user with given ID found', 'danger']);
                            redirect($this->controllerRole . '/otherusers');
                        } else if ($this->controllerRole == 'moderator' && ($user->role == 'admin' || $user->role == 'moderator')) {
                            message(['Unauthorized', 'danger']);
                            redirect($this->controllerRole . '/otherusers');
                        }

                        $userInst->update(['status' => 'active'], $user->userID);
                        message('Activation Successful!');
                    }
                }
                redirect($this->controllerRole.'/otherusers');
            }
        }


        $user = new User();
        $row1 = $user->innerJoin(['student'], ['student.userID=user.userID'], [], ['*,user.status AS status,student.status AS studentStatus']);
        $row2 = $user->innerJoin(['moderator'], ['moderator.userID=user.userID']);
        $row3 = $user->innerJoin(['admin'], ['admin.userID=user.userID']);
        $row4 = $user->innerJoin(['company'], ['company.userID=user.userID'], [], ['*,user.status AS status,company.status AS companyStatus']);
        $row = (object)array_merge((array)$row1, (array)$row2);
        $row = (object)array_merge((array)$row, (array)$row3);
        $row = (object)array_merge((array)$row, (array)$row4);


        //pass the combined object to the view
        $data['users'] = $row;

        $data['title'] = "Other Users";

        $this->view($this->controllerRole . '/otherusers', $data);
    }


    //update profile
    public function updateprofile()
    {
        //calling model instance relavant to role
        $roleModel = ucfirst($this->controllerRole) . "Model";
        $roleModelInst = new $roleModel();

        //should implement the validation and procedure
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            if (!empty($_FILES['imageInput']['name'])) {

                $allowed = ['image/jpeg', 'image/png'];
                if ($_FILES['imageInput']['error'] == 0) {

                    if (in_array($_FILES['imageInput']['type'], $allowed)) {

                        //before move upload files validate other data
                        if ($roleModelInst->validate($_POST)) {

                            $folder = "uploads/profilePics/";
                            if (!file_exists($folder)) {
                                mkdir($folder, 0777, true);
                                //for security, adding empty index.php files
                                file_put_contents($folder . "index.php", "<?php //Access Denied");
                                file_put_contents("uploads/index.php", "<?php //Access Denied");
                            }

                            $destination = $folder . time() . $_FILES['imageInput']['name'];
                            move_uploaded_file($_FILES['imageInput']['tmp_name'], $destination);
                            $destination = resizeImage($destination); //resizing and reducing file size 

                            $_POST['profilePic'] = $destination;

                            //deleting old image
                            if (file_exists(Auth::getprofilePic())) {
                                unlink(Auth::getprofilePic());
                            }

                            //calling Auth::getadminID() using dynamic vaiable as role so for student it will be Auth::getstudentID()
                            $methodName = 'get' . $this->controllerRole . 'ID';
                            $roleModelInst->update($_POST, Auth::$methodName());
                            //update session so that Auth get functions work properly
                            Auth::updateSession();
                            // show($_SESSION['USER_DATA']);
                            // die;
                            message("Profile updated successfully!");
                            redirect($this->controllerRole . '/profile');
                        }
                    } else {
                        $roleModelInst->errors['imageInput'] = "File Type is not allowed!";
                    }
                } else {
                    $roleModelInst->errors['imageInput'] = "Couldn't upload the image";
                }
            } else {
                if ($roleModelInst->validate($_POST)) {
                    $methodName = 'get' . $this->controllerRole . 'ID';
                    $roleModelInst->update($_POST, Auth::$methodName());
                    Auth::updateSession();
                    // show($_SESSION['USER_DATA']);
                    // die;
                    message("Profile updated successfully!");
                    redirect($this->controllerRole . '/profile');
                }
            }
        }
        $data['title'] = "Update Profile";

        $data['errors'] = $roleModelInst->errors;

        $this->view($this->controllerRole . '/updateprofile', $data);
    }
}
