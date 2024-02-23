<?php
require_once 'Users.php';

//Moderator class
class Moderator extends Users
{


    // Constructor
    //all the validations for authorizations are in the parent controller
    public function __construct()
    {
        parent::__construct('moderator');
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
        $this->view('moderator/dashboard', $data);

    }

    public function university($action = null, $id = null)
    {

        if (!empty($action)) {
            if ($action === "post") { //for new uni
                if ($_SERVER['REQUEST_METHOD'] == "POST") {

                    $university = new University();
                    $isThere = $university->first(['domain' => $_POST['domain']]);
                    if (!empty($isThere)) {
                        message(['University Domain Already Exists!', 'danger']);
                        redirect('moderator/university');
                    }
                    $university->insert($_POST);

                    message('University Added Successfully!');
                    redirect('moderator/university');
                }
                $data['title'] = "New University";
                $this->view('moderator/post-university', $data);
                return;
            } else if ($action === 'modify') { //to update
                if (!empty($id)) {
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {

                        $university = new University();
                        $isThere = $university->first(['domain' => $_POST['domain']]);
                        if (!empty($isThere) && $isThere->universityID != $id) {
                            message(['University Domain Already Exists!', 'danger']);
                            redirect('moderator/university');
                        }
                        $university->update($_POST, $id);

                        message('University Modified Successfully!');
                        redirect('moderator/university');
                    }
                    $university = new University();
                    $row = $university->first(['universityID' => $id]);
                    if (!empty($row)) {
                        $data['university'] = $row;
                        $data['title'] = "Modify - " . $row->universityName;
                        $this->view('moderator/modify-university', $data);
                        return;
                    }
                    message(['Error fetching data!', 'danger']);
                    redirect('moderator/university');
                } else {
                    message('Choose a university to modify!');
                    redirect('moderator/university');
                }
            } else if ($action === 'delete') { //to delete
                if ($_SERVER['REQUEST_METHOD'] == "POST") {

                    if (!empty($id)) {
                        $university = new University();
                        $row = $university->first(['universityID' => $id]);
                        if (!empty($row)) {
                            $studentInst = new StudentModel();
                            $student = $studentInst->first(['universityID' => $row->universityID]);
                            if (!empty($student)) {
                                message(['Cannot delete the university domain while students are there from that domain!', 'danger']);
                                redirect('moderator/university');
                            }
                            $university->delete($id);
                            message('University Deleted Successfully!');
                            redirect('moderator/university');
                        }
                        message(['Error Fetching!', 'danger']);
                        redirect('moderator/university');
                    } else {
                        message('Choose a university to delete!');
                        redirect('moderator/university');
                    }
                }
                redirect('moderator/university');
            }
        }

        $university = new University();
        $universities = $university->getAll();
        if (empty($universities)) {
            message(['No universities in the database!', 'danger']);
            redirect('moderator');
        }

        $student = new StudentModel();
        for ($i = 0; $i < count($universities); $i++) {
            $countUsers = $student->where(['universityID' => $universities[$i]->universityID]);
            if (!empty($countUsers)) $universities[$i]->userCount = count($countUsers);
            else $universities[$i]->userCount = 0;
        }

        $data['universities'] = $universities;
        $data['title'] = "Universities";

        $this->view('moderator/university', $data);
    }

    //category
    public function category($action = null, $id = null)
    {


        if (!empty($action)) {
            if ($action === "post") { //for new category
                if ($_SERVER['REQUEST_METHOD'] == "POST") {

                    $category = new Category();
                    $category->insert($_POST);

                    message('Category Added Successfully!');
                    redirect('moderator/category');
                }
                $data['title'] = "New Category";
                $this->view('moderator/post-category', $data);
                return;
            } else if ($action === 'modify') { //to update
                if (!empty($id)) {
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {

                        $category = new Category();
                        $category->update($_POST, $id);

                        message('Category Modified Successfully!');
                        redirect('moderator/category');
                    }
                    $category = new Category();
                    $row = $category->first(['categoryID' => $id]);
                    if (!empty($row)) {
                        $data['category'] = $row;
                        $data['title'] = "Modify - " . $row->title;
                        $this->view('moderator/modify-category', $data);
                        return;
                    }
                    message(['Error fetching data!', 'danger']);
                    redirect('moderator/category');
                } else {
                    message('Choose a category to modify!');
                    redirect('moderator/category');
                }
            } else if ($action === 'delete') { //to delete
                if ($_SERVER['REQUEST_METHOD'] == "POST") {

                    if (!empty($id)) {
                        $category = new Category();
                        $row = $category->first(['categoryID' => $id]);
                        if (!empty($row)) {
                            $taskInst = new Task();
                            $tasks = $taskInst->first(['categoryID' => $row->categoryID, 'isDeleted' => 0]);
                            if (!empty($tasks)) {
                                message(['Category Cannot be Deleted while tasks are there from that category!', 'danger']);
                                redirect('moderator/category');
                            }
                            $category->delete($id);
                            message('Category Deleted Successfully!');
                            redirect('moderator/category');
                        }
                        message(['Error Fetching!', 'danger']);
                        redirect('moderator/category');
                    } else {
                        message('Choose a category to delete!');
                        redirect('moderator/category');
                    }
                }
                redirect('moderator/category');
            }
        }

        $category = new Category();
        $categories = $category->getAll();
        if (empty($categories)) {
            message(['No categories in the database!', 'danger']);
            redirect('moderator');
        }

        $task = new Task();
        for ($i = 0; $i < count($categories); $i++) {
            $countTasks = $task->where(['categoryID' => $categories[$i]->categoryID, 'status' => 'active', 'isDeleted' => 0]);
            if (!empty($countTasks)) $categories[$i]->taskCount = count($countTasks);
            else $categories[$i]->taskCount = 0;
        }

        $data['categories'] = $categories;
        $data['title'] = "Categories";

        $this->view('moderator/category', $data);
    }

    //toverify - verify companies
    public function toverify($action = null)
    {
        $verificationInst = new Moderator_Verifies_Company();

        if (!empty($action)) {
            if ($action == 'reviewed') {
                $reviewed = $verificationInst->innerJoin(['company', 'user'], ['Moderator_Verifies_Company.companyID=company.companyID', 'company.userID=user.userID'], ['Moderator_Verifies_Company.status' => '"reviewed"'], ['user.userID', 'Moderator_Verifies_Company.documents', 'Moderator_Verifies_Company.verificationID', 'company.companyName', 'Moderator_Verifies_Company.status']);
                $data['reviewed'] = $reviewed;
                $data['title'] = "Reviewed Verifications";
                $this->view('moderator/reviewedVerifications', $data);
                return;

            } else if ($action = 'underverification') {
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    if (!empty($_POST['verificationID'])) {
                        $_POST['moderatorID'] = Auth::getmoderatorID();
                        $verificationInst->update($_POST, $_POST['verificationID']);
                        if ($_POST['status'] == 'reviewed') {
                            $row = $verificationInst->first(['verificationID' => $_POST['verificationID']]);
                            $companyInst = new CompanyModel();
                            $companyID = $companyInst->update(['status' => 'verified'], $row->companyID);
                        }

                        message('Submitted Successfully');
                        redirect('moderator/toverify/underverification');
                    }
                }
                $underReviews = $verificationInst->innerJoin(['company', 'user'], ['Moderator_Verifies_Company.companyID=company.companyID', 'company.userID=user.userID'], ['Moderator_Verifies_Company.status' => '"underReview"'], ['user.userID', 'Moderator_Verifies_Company.documents', 'Moderator_Verifies_Company.verificationID', 'company.companyName', 'Moderator_Verifies_Company.status']);
                $data['underReviews'] = $underReviews;
                $data['title'] = "Reviewed Under Verification";
                $this->view('moderator/underverification', $data);
                return;
            }
        }

        $reviewedCount = $verificationInst->count(['status' => 'reviewed'])[0]->{"COUNT(*)"};
        $underReviewCount = $verificationInst->count(['status' => 'underReview'])[0]->{"COUNT(*)"};
        $data['reviewed'] = $reviewedCount;
        $data['underReview'] = $underReviewCount;

        $data['title'] = "To Verify";
        $this->view('moderator/toverify', $data);
    }


    //disputes dashboard page
    public function disputes($id = null)
    {

        $disputeInst = new Dispute();

        if (!empty($id)) {

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if (!empty($_POST['moderatorComment']) && !empty($_POST['status'])) {
                    $_POST['resolvedDate'] = date("Y-m-d H:i:s");
                    $disputeInst->update($_POST, $id);
                    message(ucfirst($_POST['status']) . ' successfully!');
                } else {
                    message(['Error occurred!', 'danger']);
                }
                redirect('moderator/disputes/' . $id);
            }


            $res = $disputeInst->first(['disputeID' => $id]);

            if (!empty($res)) {
                $taskInst = new Task();

                $task = $taskInst->first(['taskID' => $res->taskID]);
                $res->task = $task;

                //geting details of users
                $compinst = new CompanyModel();
                $detailsOfCompany = $compinst->innerJoin(['user'], ['company.userID=user.userID'], ['company.companyID' => $res->task->companyID])[0];
                $studentInst = new StudentModel();
                $detailsOfStudent = $studentInst->innerJoin(['user'], ['student.userID=user.userID'], ['student.studentID' => $res->task->assignedStudentID])[0];

                //getting initiated party data and set res accordignly
                if ($res->initiatedParty == 'company') {
                    //when initiated party is company

                    $res->complainer = $detailsOfCompany;
                    $res->target = $detailsOfStudent;

                } else {
                    //when initiated party is student
                    $res->complainer = $detailsOfStudent;
                    $res->target = $detailsOfCompany;
                }

                $data['dispute'] = $res;
                $data['title'] = "Dispute Details";
                $this->view('moderator/dispute', $data);
                return;
            }
            message(['Invalid dispute ID!', 'danger']);
            redirect('moderator/category');

        }


        $data['disputes'] = $disputeInst->getAll();


        $data['title'] = "Disputes";
        $this->view('moderator/disputes', $data);
    }

    //customer support dashboard page
    public function support($id = null)
    {

        $supportInst = new SupportModel();

        if (!empty($id)) {

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if (!empty($_POST['moderatorComment']) && !empty($_POST['status'])) {
                    $_POST['resolvedDate'] = date("Y-m-d H:i:s");
                    $supportInst->update($_POST, $id);
                    message(ucfirst($_POST['status']) . ' successfully!');
                } else {
                    message(['Error occurred!', 'danger']);
                }
                redirect('moderator/support/' . $id);
            }


            $res = $supportInst->first(['supportID' => $id]);

            if (!empty($res)) {


                $data['support'] = $res;
                $data['title'] = "Support Request Details";
                $this->view('moderator/support', $data);
                return;
            }
            message(['Invalid support ID!', 'danger']);
            redirect('moderator/supports');

        }


        $data['supports'] = $supportInst->getAll();


        $data['title'] = "Support";
        $this->view('moderator/supports', $data);
    }

    //processing students earning withdrawl request
    public function payments()
    {

        $earningInst = new Earning();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $row = $earningInst->first(['transactionID' => $_POST['transactionID']]);
            if (empty($row) || $row->earningStatus !== 'requested') {
                message(['You have already processed!', 'danger']);
                redirect('moderator/payments');
            }
            $_POST['transactionDate'] = date("Y-m-d H:i:s");
            $earningInst->update($_POST, $_POST['transactionID']);
            message("Updated Successfully!");
        }


        $row = $earningInst->query("SELECT * FROM earnings INNER JOIN task ON task.taskID=earnings.taskID  INNER JOIN student ON task.assignedStudentID=student.studentID WHERE earningStatus!='available';");

        $data['earnings'] = $row;

//        show($data);die;


        $data['title'] = "Payment Requests";
        $this->view('moderator/earningReq', $data);
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
                        redirect('moderator/tasks/'.$id);
                        return;
                    }
                }else{
                    $_POST['status']='active';
                }
                $taskInst->update($_POST,$_POST['taskID']);

                message("Updated Successfully!");
                redirect('moderator/tasks/'.$id);
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
            $this->view('moderator/task', $data);

            return;
        }
        $row = $taskInst->where(['isDeleted' => 0]);
        $data['tasks'] = $row;

        $data['title'] = "Tasks";
        $this->view('moderator/tasks', $data);
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

            $this->view('moderator/otherCompanyProfile', $data);
            return;
        }

        message(['Invalid company ID!', 'danger']);
        redirect('moderator');
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

            $this->view('moderator/otherProfile', $data);
            return;
        }

        message(['Invalid User ID!', 'danger']);
        redirect('moderator');
    }

}
