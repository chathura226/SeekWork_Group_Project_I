<?php

//Admin class
class Admin extends Controller
{

    public function all_common_verifications()
    {
        if (!Auth::logged_in()) { //if not logged in redirect to login page
            message('Please login to view the admin section!');
            redirect('login');
        }
        if (!Auth::is_otp_verified()) {
            message(['Verify Email before accessing dashboard!', 'danger']);
            redirect('otp');
        }
        if (!Auth::is_admin()) { ///if not an admin, redirect to home
            message(['Only admins can view admin dashboard!', 'danger']);
            redirect('home');
        }
    }

    public function index()
    {

        $this->all_common_verifications();
        $data['title'] = "Dashboard";

        $this->view('admin/dashboard', $data);
    }

    public function profile($id = null)
    {

        $this->all_common_verifications();

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

        $this->view('admin/profile', $data);
    }



    public function changepassword()
    {

        $this->all_common_verifications();


        $data['title'] = "Change Password";



        //should implement the validation and procedure
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($_POST['newpassword'] !== $_POST['confirmnewpassword']) {
                message(["Password and confirm password does not match!", 'danger']);
                redirect('admin/changepassword');
            }
            $userInst = new User();
            $user = $userInst->first(['userID' => Auth::getuserID()]);
            if (password_verify($_POST['currentpassword'], $user->password)) {
                $password = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
                $userInst->update(['password' => $password], Auth::getuserID());
                message("Password Updated Successfully!");
                redirect('admin/profile');
            } else {
                message(["Current password is wrong!", 'danger']);
                redirect('admin/changepassword');
            }
        }


        $this->view('admin/changepassword', $data);
    }


    //implement this to show all users and specific user if the id is passeed with url
    public function otherusers($id = null)
    {

        $this->all_common_verifications();



        $user = new User();
        $row1=$user->innerJoin(['student'],['student.userID=user.userID']);
        $row2=$user->innerJoin(['moderator'],['moderator.userID=user.userID']);
        $row3=$user->innerJoin(['admin'],['admin.userID=user.userID']);
        $row4=$user->innerJoin(['company'],['company.userID=user.userID']);
        $row = (object)array_merge((array)$row1, (array)$row2);
        $row = (object)array_merge((array)$row, (array)$row3);
        $row = (object)array_merge((array)$row, (array)$row4);

        if (empty($row)) {

            message(['Error fetching data', 'danger']);
            redirect('admin');

            // //get details of uvalidateModeratorser from relevant table and make a combined object 
            // $userDetails=$user->getFirstCustom($row->role,['userID'=>$row->userID],$row->role."ID");
            // $combinedObject = (object)array_merge((array)$row, (array)$userDetails);
        }

        // for ($i = 0; $i < count($row); $i++) {
        //     $userDetails = $user->getFirstCustom($row[$i]->role, ['userID' => $row[$i]->userID], $row[$i]->role . "ID");
        //     if (empty($userDetails)) {
        //         message(['Error fetching data ' . $row[$i]->userID, 'danger']);
        //         redirect('admin');
        //     }

        //     $row[$i] = (object)array_merge((array)$row[$i], (array)$userDetails);
        // }

        // show($row);
        // die;
        //pass the combined object to the view
        $data['users'] = $row;


        $data['title'] = "Other Users";

        $this->view('admin/otherusers', $data);
    }


    public function updateprofile()
    {
        $this->all_common_verifications();



        $adminInst = new AdminModel();

        //should implement the validation and procedure
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            if (!empty($_FILES['imageInput']['name'])) {

                $allowed = ['image/jpeg', 'image/png'];
                if ($_FILES['imageInput']['error'] == 0) {

                    if (in_array($_FILES['imageInput']['type'], $allowed)) {

                        //before move upload files validate other data
                        if ($adminInst->validate($_POST)) {

                            $folder = "uploads/profilePics/";
                            if (!file_exists($folder)) {
                                mkdir($folder, 0777, true);
                                //for security, adding empty index.php files
                                file_put_contents($folder . "index.php", "<?php //Access Denied");
                                file_put_contents("uploads/index.php", "<?php //Access Denied");
                            }

                            $destination = $folder . time() . $_FILES['imageInput']['name'];
                            move_uploaded_file($_FILES['imageInput']['tmp_name'], $destination);
                            $destination=resizeImage($destination);//resizing and reducing file size 

                            $_POST['profilePic'] = $destination;

                            //deleting old image
                            if (file_exists(Auth::getprofilePic())) {
                                unlink(Auth::getprofilePic());
                            }
                            $adminInst->update($_POST, Auth::getadminID());
                            //update session so that Auth get functions work properly
                            Auth::updateSession();
                            // show($_SESSION['USER_DATA']);
                            // die;
                            message("Profile updated successfully!");
                            redirect('admin/profile');
                        }
                    } else {
                        $adminInst->errors['imageInput'] = "File Type is not allowed!";
                    }
                } else {
                    $adminInst->errors['imageInput'] = "Couldn't upload the image";
                }
            } else {
                if ($adminInst->validate($_POST)) {
                    $adminInst->update($_POST, Auth::getadminID());
                    Auth::updateSession();
                    // show($_SESSION['USER_DATA']);
                    // die;
                    message("Profile updated successfully!");
                    redirect('admin/profile');
                }
            }
        }
        $data['title'] = "Update Profile";

        $data['errors'] = $adminInst->errors;

        $this->view('admin/updateprofile', $data);
    }


    public function managemoderators($action = null, $id = null)
    {

        $this->all_common_verifications();

        if (!empty($action)) {
            if ($action === 'post') { //add new moderator

                $data['title'] = "New Moderator";

                $data['errors'] = [];
                $user = new User();

                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    if ($user->validateModerator($_POST)) {

                        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $_POST['role'] = "moderator";
                        $user->insert($_POST);

                        //at this point user is added to the user table. now we can get userID from it 
                        // and put inside the _POST so that it can be added to company dtabase
                        //note that email is unique, so only one user can exist
                        $row = $user->first([
                            'email' => $_POST['email'],
                        ]);
                        $_POST['userID'] = $row->userID;

                        $moderatorInst = new ModeratorModel();
                        $moderatorInst->insert($_POST); //default value for verification status is set to 'pending' from the database

                        message("Moderator account creation successful!");
                        redirect('admin/managemoderators');
                    }
                }
                $data['errors'] = $user->errors;

                $this->view('admin/post-moderators', $data);
                return;
            } else if ($action === 'disable') { //disable admin user

                if ($_SERVER['REQUEST_METHOD'] == "POST") {

                    if (!empty($id)) { //admin id of diabling user   
                        //get corresponding user id
                        $moderatorInst = new ModeratorModel();
                        $moderator = $moderatorInst->first(['moderatorID' => $id]);
                        if (empty($moderator)) {
                            message(['No user with given moderatorID found', 'danger']);
                            redirect('admin/managemoderators');
                        }

                        $user = new User();
                        $user->update(['status' => 'deactivated'], $moderator->userID);
                        message('Deactivation Successful!');
                    }
                }
                redirect('admin/managemoderators');
            } else if ($action === 'enable') { //enable admin user

                if ($_SERVER['REQUEST_METHOD'] == "POST") {

                    if (!empty($id)) { //admin id of diabling user   
                        //get corresponding user id
                        $moderatorInst = new ModeratorModel();
                        $moderator = $moderatorInst->first(['moderatorID' => $id]);
                        if (empty($moderator)) {
                            message(['No user with given moderatorID found', 'danger']);
                            redirect('admin/managemoderators');
                        }

                        $user = new User();
                        $user->update(['status' => 'active'], $moderator->userID);
                        message('Activation Successful!');
                    }
                }
                redirect('admin/managemoderators');
            }
        }
        // $userInst = new User();
        // $moderatorInst = new ModeratorModel();
        // $moderators = $userInst->where(['role' => 'moderator']);

        // for ($i = 0; $i < count($moderators); $i++) {
        //     $moderatorDetails = $moderatorInst->first(['userID' => $moderators[$i]->userID]);

        //     $moderators[$i] = (object)array_merge((array)$moderators[$i], (array)$moderatorDetails);
        // }

        $moderatorInst = new ModeratorModel();

        $moderators=$moderatorInst->innerJoin(['user'],['moderator.userID=user.userID']);
        $data['moderators'] = $moderators;

        $data['title'] = "Manage Moderators";

        $this->view('admin/view-moderators', $data);
    }

    public function manageadmins($action = null, $id = null)
    {

        $this->all_common_verifications();

        if (!empty($action)) {
            if ($action === 'post') { //add new moderator

                $data['title'] = "New Admin";

                $data['errors'] = [];
                $user = new User();

                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    if ($user->validateAdmin($_POST)) {

                        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $_POST['role'] = "admin";
                        $user->insert($_POST);

                        //at this point user is added to the user table. now we can get userID from it 
                        // and put inside the _POST so that it can be added to company dtabase
                        //note that email is unique, so only one user can exist
                        $row = $user->first([
                            'email' => $_POST['email'],
                        ]);
                        $_POST['userID'] = $row->userID;

                        $adminInst = new AdminModel();
                        $adminInst->insert($_POST); //default value for verification status is set to 'pending' from the database

                        message("Admin account creation successful!");
                        redirect('admin/manageadmins');
                    }
                }
                $data['errors'] = $user->errors;

                $this->view('admin/post-admins', $data);
                return;
            } else if ($action === 'disable') { //disable admin user

                if ($_SERVER['REQUEST_METHOD'] == "POST") {

                    if (!empty($id)) { //admin id of diabling user   
                        //get corresponding user id
                        $adminInst = new AdminModel();
                        $admin = $adminInst->first(['adminID' => $id]);
                        if (empty($admin)) {
                            message(['No user with given adminID found', 'danger']);
                            redirect('admin/manageadmins');
                        }

                        $user = new User();
                        $user->update(['status' => 'deactivated'], $admin->userID);
                        message('Deactivation Successful!');
                    }
                }
                redirect('admin/manageadmins');
            } else if ($action === 'enable') { //enable admin user

                if ($_SERVER['REQUEST_METHOD'] == "POST") {

                    if (!empty($id)) { //admin id of diabling user   
                        //get corresponding user id
                        $adminInst = new AdminModel();
                        $admin = $adminInst->first(['adminID' => $id]);
                        if (empty($admin)) {
                            message(['No user with given adminID found', 'danger']);
                            redirect('admin/manageadmins');
                        }

                        $user = new User();
                        $user->update(['status' => 'active'], $admin->userID);
                        message('Activation Successful!');
                    }
                }
                redirect('admin/manageadmins');
            }
        }
        // $userInst = new User();
        // $adminInst = new AdminModel();
        // $admins = $userInst->where(['role' => 'admin']);

        // for ($i = 0; $i < count($admins); $i++) {
        //     $adminDetails = $adminInst->first(['userID' => $admins[$i]->userID]);

        //     $admins[$i] = (object)array_merge((array)$admins[$i], (array)$adminDetails);
        // }
        $adminInst = new AdminModel();
        $admins=$adminInst->innerJoin(['user'],['admin.userID=user.userID']);
        // show($admins);
        // die;
        $data['admins'] = $admins;

        $data['title'] = "Manage Admins";

        $this->view('admin/view-admins', $data);
    }
}
