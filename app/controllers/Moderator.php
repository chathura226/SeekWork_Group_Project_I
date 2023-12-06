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
                            $tasks = $taskInst->first(['categoryID' => $row->categoryID]);
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
            $countTasks = $task->where(['categoryID' => $categories[$i]->categoryID, 'status' => 'active']);
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
        $verificationInst=new Moderator_Verifies_Company();

        if(!empty($action)){
            if($action=='reviewed'){
                //TODO: have to implement mechanism
                $data['title'] = "Reviewed Verifications";
                $this->view('moderator/reviewedVerifications', $data);
                return;
            }else if($action='underverification'){
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    if(!empty($_POST['verificationID'])){
                        $_POST['moderatorID']=Auth::getmoderatorID();
                        $verificationInst->update($_POST,$_POST['verificationID']);
                        if($_POST['status']=='reviewed'){
                            $row=$verificationInst->first(['verificationID'=>$_POST['verificationID']]);
                            $companyInst=new CompanyModel();
                            $companyID=$companyInst->update(['status'=>'verified'],$row->companyID);
                        }

                        message('Submitted Successfully');
                        redirect('moderator/toverify/underverification');
                    }
                }
                $underReviews=$verificationInst->innerJoin(['company','user'],['Moderator_Verifies_Company.companyID=company.companyID','company.userID=user.userID'],['Moderator_Verifies_Company.status'=>'"underReview"'],['user.userID','Moderator_Verifies_Company.documents','Moderator_Verifies_Company.verificationID','company.companyName','Moderator_Verifies_Company.status']);
                $data['underReviews']=$underReviews;
                $data['title'] = "Reviewed Under Verification";
                $this->view('moderator/underverification', $data);
                return;
            }
        }

        $reviewedCount=$verificationInst->count(['status'=>'reviewed'])[0]->{"COUNT(*)"};
        $underReviewCount=$verificationInst->count(['status'=>'underReview'])[0]->{"COUNT(*)"};
        $data['reviewed']=$reviewedCount;
        $data['underReview']=$underReviewCount;

        $data['title'] = "To Verify";
        $this->view('moderator/toverify', $data);
    }


}
