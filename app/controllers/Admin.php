<?php
require_once 'Users.php';

//Admin class
class Admin extends Users
{

    // Constructor
    //all the validations for authorizations are in the parent controller
    public function __construct()
    {
        parent::__construct('admin');
    }

    public function index()
    {
        $taskInst = new Task();
        $activeTotal = $taskInst->query("SELECT count(*) as count FROM task where status IN ('inProgress', 'active');")[0]->count;

        $userModel = new User();
        $row = $userModel->query("SELECT
    role,
    COUNT(*) AS roleCount
FROM
    user
WHERE
    role IN ('student', 'company') AND status='active'
GROUP BY
    role;");
        $companies = $students = 0;
        foreach ($row as $elements) {
            if ($elements->role == 'company') {
                $companies = $elements->roleCount;
            } else {
                $students = $elements->roleCount;
            }
        }

        $disputeInst = new Dispute();
        $disputes = $disputeInst->query("SELECT count(*) as count from dispute where status='pending';")[0]->count;


        $data['disputes'] = $disputes;
        $data['activeTotal'] = $activeTotal;
        $data['companies'] = $companies;
        $data['students'] = $students;
        $data['title'] = "Dashboard";
        $this->view('admin/dashboard', $data);

    }

    public function managemoderators($action = null, $id = null)
    {

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

        $moderators = $moderatorInst->innerJoin(['user'], ['moderator.userID=user.userID']);
        $data['moderators'] = $moderators;

        $data['title'] = "Manage Moderators";

        $this->view('admin/view-moderators', $data);
    }

    public function manageadmins($action = null, $id = null)
    {


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
        $admins = $adminInst->innerJoin(['user'], ['admin.userID=user.userID']);
        // show($admins);
        // die;
        $data['admins'] = $admins;

        $data['title'] = "Manage Admins";

        $this->view('admin/view-admins', $data);
    }
}
