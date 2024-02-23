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

    public function tasks($id = null)
    {
        $taskInst = new Task();


        if (!empty($id)) {
            $row = $taskInst->first(['taskID' => $id]);

            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                if($_POST['action']=='disable'){
                    $_POST['status']='disabled';
                    if($row->status!='active'){
                        message(["Cannot perform the operation on this stage!",'danger']);
                        redirect('admin/tasks/'.$id);
                        return;
                    }
                }else{
                    $_POST['status']='active';
                }
                $taskInst->update($_POST,$_POST['taskID']);

                message("Updated Successfully!");
                redirect('admin/tasks/'.$id);
                return;
            }


            $assignmentInst = new Assignment();
            $submissionInst = new Submission();
            $data['assignments'] = $assignmentInst->where(['taskID' => $id]);
            $data['submissions'] = $submissionInst->where(['taskID' => $id]);
            //taking number of proposals
            $proposalInst = new Proposal();
            $nProposals = $proposalInst->count(['taskID' => $row->taskID])[0]->{"COUNT(*)"};
            $row->nProposals = $nProposals;

            $taskSkillInst = new Task_Skill();
            $data['skills'] = $taskSkillInst->innerJoin(['skill'], ['skill.skillID=task_skill.skillID'], ['taskID' => $id]);

            //companyDetails
            $companyInst = new CompanyModel();
            $data['company'] = $companyInst->first(['companyID' => $row->companyID]);

            //if assined to a student , get student details
            if (!empty($row->assignedStudentID)) {
                $studentInst = new StudentModel();
                $student = $studentInst->innerJoin(['university'], ['university.universityID=student.universityID'], ['student.studentID' => $row->assignedStudentID])[0];
                $data['student'] = $student;
            }

            $data['task'] = $row;
            $data['title'] = $row->title;
//                    show($data);die;
            $this->view('admin/task', $data);

            return;
        }
        $row = $taskInst->where(['isDeleted' => 0]);
        $data['tasks'] = $row;

        $data['title'] = "Tasks";
        $this->view('admin/tasks', $data);
    }

    //to check others profiles
    public function viewcompany($id = null)
    {


        if (!empty($id)) {

            $companyInst = new CompanyModel();


            $companyDetails = $companyInst->innerJoin(['user'], ['company.userID=user.userID'], ['company.companyID' => $id])[0];


            $data['user'] = $companyDetails;


            //calculating star ratings for each star
            $reviewInst=new Review();
            $res=$reviewInst->query("SELECT nStars, COUNT(*) as rCount
FROM review
WHERE companyID=:companyID AND reviewType='studentTOcompany'
GROUP BY nStars;
",['companyID'=>$id]);
            $starCount=array(0,0,0,0,0);

            if(!empty($res)) {
                $length = count($res);

                for ($i = 0; $i < $length; $i++) {
                    $starCount[$res[$i]->nStars-1]=$res[$i]->rCount;
                }

            }

            // Find the maximum value in the array
            $maxValue = max($starCount);
            if($maxValue!=0){
                // Calculate the percentage for each value
                $percentages = [];
                foreach ($starCount as $value) {
                    $percentage = ($value / $maxValue) * 100;
                    $percentages[] = $percentage;
                }
            }else{
                //if max value is zero
                $percentages = $starCount;

            }



            $data['starCount']=$starCount;
            $data['percentages']=$percentages;

            //get the reviews
            $reviews=$reviewInst->innerJoin(['student'],['student.studentID=review.studentID'],['review.companyID'=>$id,'review.reviewType'=>'"studentTOcompany"']);
            $data['reviews']=$reviews;

            $data['title'] = "Other User Profiles";

            $this->view('admin/otherCompanyProfile', $data);
            return;
        }

        message(['Invalid company ID!', 'danger']);
        redirect('admin');
    }
    //to check others profiles
    public function viewstudents($id = null)
    {


        if (!empty($id)) {



            $studentInst = new StudentModel();


            $studentDetails = $studentInst->innerJoin(['user', 'university'], ['student.userID=user.userID', 'student.universityID=university.universityID'], ['student.studentID' => $id])[0];



            $data['user'] = $studentDetails;

            //calculating star ratings for each star
            $reviewInst=new Review();
            $res=$reviewInst->query("SELECT nStars, COUNT(*) as rCount
FROM review
WHERE studentID=:studentID AND reviewType='companyTOstudent'
GROUP BY nStars;
",['studentID'=>$id]);
            $starCount=array(0,0,0,0,0);

            if(!empty($res)) {
                $length = count($res);

                for ($i = 0; $i < $length; $i++) {
                    $starCount[$res[$i]->nStars-1]=$res[$i]->rCount;
                }

            }

            // Find the maximum value in the array
            $maxValue = max($starCount);
            if($maxValue!=0){
                // Calculate the percentage for each value
                $percentages = [];
                foreach ($starCount as $value) {
                    $percentage = ($value / $maxValue) * 100;
                    $percentages[] = $percentage;
                }
            }else{
                //if max value is zero
                $percentages = $starCount;

            }



            $data['starCount']=$starCount;
            $data['percentages']=$percentages;

            //get the reviews
            $reviews=$reviewInst->innerJoin(['company'],['company.companyID=review.companyID'],['review.studentID'=>$id,'review.reviewType'=>'"companyTOstudent"']);
            $data['reviews']=$reviews;




            $data['title'] = "Other User Profiles";

            $this->view('admin/otherProfile', $data);
            return;
        }

        message(['Invalid User ID!', 'danger']);
        redirect('admin');
    }

}
