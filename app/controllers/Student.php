<?php
require_once 'Users.php';

//Student class
class Student extends Users
{
    // Constructor
    //all the validations for authorizations are in the parent controller
    public function __construct()
    {
        parent::__construct('student');
    }


    public function verification()
    {


        $data['title'] = "Verification";


        //should implement the validation and procedure
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            message("Details submitted successfully!");
            redirect('student');
        }


        $this->view('student/verification', $data);
    }

    public function proposals($id = null)
    {
//TODO: modify proposal uppload and download files
        //TODO: view proposals upload and download files in both student and company


        if (empty($id)) {
            $proposal = new Proposal();
            $proposals = $proposal->where(['studentID' => Auth::getstudentID()]);
            if (empty($proposals)) {
                message(['You have not submitted any proposals!', 'danger']);
                redirect('student');
            }
            $task = new Task();
            for ($i = 0; $i < count($proposals); $i++) {
                $proposals[$i]->task = $task->first(['taskID' => $proposals[$i]->taskID]);
            }


            $data['title'] = "Proposals";
            $data['proposals'] = array_reverse($proposals);

            $this->view('student/proposals', $data);
        } else {
            $proposal = new Proposal();
            $row = $proposal->first(['proposalID' => $id]);
            if (!empty($row)) {
                $data['proposal'] = $row;


                $task = new Task();
                $data['task'] = $task->first(['taskID' => $row->taskID]);
                if (!empty($data['task'])) {
                    $company = new CompanyModel();
                    $data['company'] = $company->first(['companyID' => $data['task']->companyID]);
                    if (!empty($data['company'])) {

                        $data['title'] = "Proposal - " . $data['task']->title;
                        $this->view('student/proposal', $data);
                        return;
                    }
                }
            }
            message(['Error fetching data!', 'danger']);
            redirect('student/proposals');
        }
    }

    //modify proposals
    public function modify($id = null)
    {

        if (empty($id)) {
            message('Select a proposal to modify!');
            redirect('student/proposals');
        } else {
            $proposal = new Proposal();

            //if the method is post->modify proposal
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if ($proposal->first(['proposalID' => $id])->studentID !== Auth::getstudentID()) {
                    message(['Unauthorized!', 'danger']);
                    redirect('student/proposals');
                }
                if ($proposal->validate($_POST)) {
                    //no need to check file errors since it will be validated using validate func
                    if (!empty($_FILES['documents']['name'])) {//checking for a file upload
                        $folder = "../app/uploads/tasks/" . $_POST['taskID'] . "/proposals/";

                        $res=$proposal->first(['taskID'=>$_POST['taskID'],'studentID'=>Auth::getstudentID()]);
                        if(!empty($res) && !empty($res->documents)){
                            unlink($res->documents);//removing old file
                        }

                        $destination = $this->uploadFile($_FILES['documents'], $folder, 'proposalBy' . Auth::getstudentID());
                        $_POST['documents'] = $destination;
                    }
                    if (empty($_POST['documents'])) unset($_POST['documents']);
                    $proposal->update($_POST, $id);
                    message('Proposal Updated Successfully!');
                    redirect('student/proposals/' . $id);
                }

            }

            $row = $proposal->first(['proposalID' => $id]);
            if (!empty($row)) {
                $data['proposal'] = $row;
                $task = new Task();
                $data['task'] = $task->first(['taskID' => $row->taskID]);
                if (!empty($data['task'])) {
                    $company = new CompanyModel();
                    $data['company'] = $company->first(['companyID' => $data['task']->companyID]);
                    if (!empty($data['company'])) {

                        $data['errors'] = $proposal->errors;
                        $data['title'] = "Modify Proposal";
                        $this->view('student/modify', $data);
                        return;
                    }
                }
            }
            message(['Error fetching data!', 'danger']);
            redirect('student/proposals');

        }
    }

    //delete proposals
    public function delete($id = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {


            if (!empty($id)) {
                $proposal = new Proposal();
                $row = $proposal->first(['proposalID' => $id]);
                if (!empty($row)) {
                    if ($row->studentID === Auth::getstudentID()) {
                        $proposal->delete($id);
                        message('Proposal Deleted Successfully!');
                        redirect('student/proposals');
                    }
                    message(['Unauthorized !', 'danger']);
                    redirect('student/proposals');
                }
                message(['Error Fetching!', 'danger']);
                redirect('student/proposals');
            }
        }
    }


    public function tasks($id = null, $action = null, $id2 = null, $action2 = null)
    {


        $task = new Task();

        if (!empty($id)) {

            $row = $task->first(['taskID' => $id]); //get task details corresponding to the tadsk id

            if (!empty($row)) {
                if ($row->assignedStudentID === Auth::getstudentID()) {

                    if (!empty($action)) {
                        if ($action === 'submissions') {
//TODO:submisiiobn upload delete
                            //$id2=submission id
                            if (!empty($id2)) { //if theres an id after submissions => view each submission
                                $submissionInst = new Submission();
                                $submission = $submissionInst->first(['submissionID' => $id2, 'taskID' => $id]); //task id also used, so subission releavatn to someone else cannot be taken

                                if (empty($submission)) {

                                    message(['Invalid Submission ID or Submission is not yours!', 'danger']);
                                    redirect('student/tasks/' . $id . '/submissions');
                                }


                                if (!empty($action2)) {
                                    if ($action2 === 'delete') { //submission deletion
                                        if ($_SERVER['REQUEST_METHOD'] == "POST") {
                                            if ($submission->status === 'pendingReview') { //only submissions pending can be deleted
                                                $submissionInst->delete($id2);
                                                message('Submission deleted successfully!');
                                                redirect('student/tasks/' . $id . '/submissions');
                                            } else {
                                                message(['You cannot delete a accepted or rejected submission!', 'danger']);
                                                redirect('student/tasks/' . $id . '/submissions');
                                            }
                                        }
                                        redirect('student/tasks/' . $id . '/submissions/' . $id2);
                                    } else if ($action2 === 'modify') { //submission modify


                                        if ($_SERVER['REQUEST_METHOD'] == "POST") { //when get a post req for modify submision

                                            $_POST['studentID'] = Auth::getstudentID();
                                            $_POST['taskID'] = $id;
                                            $submissionInst->update($_POST, $id2); //implement the things needed for storing documents

                                            message('Submission modified Successfully!');
                                            redirect('student/tasks/' . $id . '/submissions/' . $id2);
                                        }

                                        //implement the things needed for storing documents
                                        $data['task'] = $row;
                                        $data['submission'] = $submission;

                                        $data['title'] = "Modify Submission";
                                        $this->view('student/modify-submission', $data);
                                        return;
                                    }
                                }

                                $data['submission'] = $submission;
                                $data['task'] = $row;
                                $data['title'] = "Submission Details";

                                $this->view('student/submission', $data);
                                return;
                            }

                            $submissionInst = new Submission();
                            $submissions = $submissionInst->where(['taskID' => $id]);
                            if (!empty($submissions)) $submissions = sortArrayOfObjects($submissions, "createdAt", 1); //sort according to date before sending
                            $data['submissions'] = $submissions;
                            $data['task'] = $row;
                            $data['title'] = "Submissions";

                            $this->view('student/submissions', $data);
                            return;
                        } else if ($action === 'addsubmission') {

                            if ($_SERVER['REQUEST_METHOD'] == "POST") { //when get a post req for add submision

                                $submissionInst = new Submission();
                                $_POST['studentID'] = Auth::getstudentID();
                                $_POST['taskID'] = $id;
                                $submissionInst->insert($_POST); //implement the things needed for storing documents

                                message('Submission Posted Successfully!');
                                redirect('student/tasks/' . $id . '/submissions');
                            }

                            $data['task'] = $row;

                            $data['title'] = "New Submission";
                            $this->view('student/post-submission', $data);
                            return;
                        }
                    }
                    $data['task'] = $row;
                    $company = new CompanyModel();
                    $user = new User();

                    $compdetails = $company->first(['companyID' => $row->companyID]);
                    $userdetails = $user->first(['userID' => $compdetails->userID]);
                    $combinedObj = (object)array_merge((array)$compdetails, (array)$userdetails);

                    $data['company'] = $combinedObj;
                    $data['title'] = $row->title;

                    $this->view('student/task', $data);
                    return;
                } else {
                    message(['Unauthorized', 'danger']);
                    redirect('student/tasks');
                }
            } else {

                message(['Error fetching data!', 'danger']);
                redirect('student/tasks');
            }
        }
        $row = $task->where(['assignedStudentID' => Auth::getstudentID()]);

        if (empty($row)) {
            message('You have no tasks assigned!');
            redirect('student');
        }
        $data['title'] = "Tasks";

        $data['tasks'] = $row;


        $this->view('student/tasks', $data);
        return;
    }


    //review
    public function review($action = null, $id = null)
    {


        if (!empty($action)) {

            if ($action === 'post') { //there should be the task id with the url
                if (!empty($id)) {

                    $task = new Task();
                    $row = $task->first(['taskID' => $id, 'assignedStudentID' => Auth::getstudentID()]);

                    if (empty($row)) { //no task posted by him with the given id is found
                        message(['Unauthorized!', 'danger']);
                        redirect('student/tasks');
                    }

                    if ($row->status !== 'closed') {
                        message(['You cannot add the review until the task is finished!', 'danger']);
                        redirect('student/tasks');
                    }


                    if ($_SERVER['REQUEST_METHOD'] == "POST") {

                        $_POST['studentID'] = Auth::getstudentID();
                        $_POST['companyID'] = $row->companyID;
                        $_POST['taskID'] = $id;
                        $_POST['reviewType'] = 'studentTOcompany';

                        $review = new Review();
                        $is_review = $review->first(['taskID' => $id, 'reviewType' => 'studentTOcompany']);
                        if (!empty($is_review)) {
                            message(['Failed!  You have a review for this task already!', 'danger']);
                            redirect('student/review');
                        }
                        $review->insert($_POST);

                        message('Review Added Successfully!');
                        redirect('student/review');
                    } else {

                        $company = new CompanyModel();
                        $data['company'] = $company->first(['companyID' => $row->companyID]); //send the details of student relevant to the review
                        $data['task'] = $row;
                        $data['title'] = 'Add a Review';
                        $this->view('student/post-review', $data);
                        return;
                    }
                } else {
                    message('Choose a task to add a review!');
                    redirect('student/tasks');
                }
            } else if ($action === 'modify') { //there should be the review id with the url
                if (!empty($id)) {

                    $review = new Review();
                    $row = $review->first(['reviewID' => $id, 'studentID' => Auth::getstudentID(), 'reviewType' => 'studentTOcompany']);
                    $task = new Task();
                    $taskDetails = $task->first(['taskID' => $row->taskID, 'assignedStudentID' => Auth::getstudentID()]);
                    if (empty($row)) { //no review posted by him with the given reviewID is found
                        message(['Unauthorized!', 'danger']);
                        redirect('student/review');
                    }


                    if ($_SERVER['REQUEST_METHOD'] == "POST") {

                        $_POST['studentID'] = Auth::getstudentID();
                        $_POST['companyID'] = $taskDetails->companyID;
                        $_POST['taskID'] = $row->taskID;
                        $_POST['reviewType'] = 'studentTOcompany';

                        $review->update($_POST, $id);

                        message('Review Updated Successfully!');
                        redirect('student/review');
                    } else {
                        $task = new Task();
                        $taskDetails = $task->first(['taskID' => $row->taskID, 'assignedStudentID' => Auth::getstudentID()]);
                        $data['task'] = $taskDetails;

                        $company = new CompanyModel();
                        $data['company'] = $company->first(['companyID' => $row->companyID]);


                        $data['review'] = $row;
                        $data['title'] = 'Modify a Review';
                        $this->view('student/modify-review', $data);
                        return;
                    }
                } else {
                    message('Choose a review to modify!');
                    redirect('student/review');
                }
            } else if ($action === 'delete') { //there hould be a review ID with the url
                if ($_SERVER['REQUEST_METHOD'] == "POST") {

                    if (!empty($id)) {
                        $review = new Review();
                        $row = $review->first(['reviewID' => $id, 'studentID' => Auth::getstudentID(), 'reviewType' => 'studentTOcompany']);
                        //checking whethere theres review with the given id posted by logged in user
                        if (!empty($row)) {
                            $review->delete($id);
                            message('Review Deleted Successfully!');
                            redirect('student/review');
                        } else {
                            message(['Unauthorized!', 'danger']);
                            redirect('student/review');
                        }
                    } else {
                        message('Choose a review to delete!');
                        redirect('student/review');
                    }
                }
                redirect('student/review');
            }
        }


        $review = new Review();
        $row = $review->where(['studentID' => Auth::getstudentID(), 'reviewType' => 'studentTOcompany']); //get reviews written by this user
        if (empty($row)) { //no review posted by him with the given reviewID is found
            message('You haven\'t posted any reviews!');
            $data['title'] = 'Reviews';
            $data['reviews'] = $row;
            $this->view('student/review', $data);
            return;
        }
        $task = new Task();
        $company = new CompanyModel();
        for ($i = 0; $i < count($row); $i++) {
            $row[$i]->task = $task->first(['taskID' => $row[$i]->taskID]);
            $row[$i]->company = $company->first(['companyID' => $row[$i]->companyID]);
        }

        $data['title'] = 'Reviews';
        $data['reviews'] = $row;
        $this->view('student/review', $data);
    }

    public function pendinginvites($action = null, $id = null)
    {


        if (!empty($action)) {
            if ($action === 'accept') {
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    if (!empty($id)) {
                        $assignmentInst = new Assignment();
                        $assignment = $assignmentInst->first(['assignmentID' => $id]);
                        if (!empty($assignment)) {
                            $proposalInst = new Proposal();
                            $proposal = $proposalInst->first(['proposalID' => $assignment->proposalID]);

                            $taskInst = new Task();
                            $taskInst->update(['assignmentID' => $assignment->assignmentID, 'assignedStudentID' => $proposal->studentID, 'status' => 'inProgress'], $assignment->taskID);
                            $currentDateTime = date('Y-m-d H:i:s');
                            $assignmentInst->update(['status' => 'accepted', 'replyDate' => $currentDateTime], $assignment->assignmentID);

                            message('Invitation Accepted Successfully!');
                            redirect('student/tasks'); //redirect to my tasks

                        }
                    }
                }
            } else if ($action === 'decline') {
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    if (!empty($id)) {
                        $assignmentInst = new Assignment();
                        $assignment = $assignmentInst->first(['assignmentID' => $id]);
                        if (!empty($assignment)) {


                            $currentDateTime = date('Y-m-d H:i:s');
                            $assignmentInst->update(['status' => 'declined', 'replyDate' => $currentDateTime], $assignment->assignmentID);

                            message('Invitation Declined Successfully!');
                            redirect('student/pendinginvites');
                        }
                    }
                }
            }
        }


        //all invitations
        $proposalInst = new Proposal();
        $proposals = $proposalInst->where(['studentID' => Auth::getstudentID()]); //all of his proposals
        if (empty($proposals)) {
            message(['You have not submitted any proposals thus there are no invitaions!', 'danger']);
            redirect('student');
        }

        $assignmentInst = new Assignment();
        $taskInst = new Task();
        $companyInst = new CompanyModel();
        $assignments = array();
        for ($i = 0; $i < count($proposals); $i++) {
            $assignment = $assignmentInst->first(['proposalID' => $proposals[$i]->proposalID]); //getting assignment wiht the specific proposal id

            if (!empty($assignment)) {
                if ($assignment->status === 'pending') { //only ending assignments are sent
                    $assignment->proposal = $proposals[$i];
                    $assignment->task = $taskInst->first(['taskID' => $proposals[$i]->taskID]);
                    $assignment->company = $companyInst->first(['companyID' => $assignment->task->companyID]);
                    $assignments[] = $assignment;
                }
            }
        }
        $data['title'] = 'Pending Invitations';
        $data['assignments'] = $assignments;
        $this->view('student/pendinginvites', $data);
    }


    public function chats($id = null)
    {


        if (!empty($id)) { //req a particular chat
            //implement chat connection with db


            $data['title'] = "Chat";

            $this->view('student/chat', $data);

            return;
        }


        $data['title'] = "Chats";

        $this->view('student/chats', $data);
    }


    public function disputes($action = null, $id = null)
    {


        if (!empty($action)) {
            if ($action === 'post') {

                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    $_POST['status'] = 'pending';
                    $_POST['initiatedParty'] = 'student';

                    $disputeInst = new Dispute();

                    $disputeInst->insert($_POST);

                    message('Dispute Added Successfully!');
                    redirect('student/disputes');
                }
                $taskInst = new Task();
                $tasks = $taskInst->where(['assignedStudentID' => Auth::getstudentID()]);
                $data['tasks'] = $tasks;
                $data['title'] = "New Dispute";

                $this->view('student/post-disputes', $data);
                return;
            } else if ($action === 'modify') {
                if (!empty($id)) {

                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
                        $_POST['status'] = 'pending';
                        $_POST['initiatedParty'] = 'student';

                        $disputeInst = new Dispute();

                        $disputeInst->update($_POST, $id);

                        message('Dispute Modified Successfully!');
                        redirect('student/disputes');
                    }

                    $taskInst = new Task();
                    $tasks = $taskInst->where(['assignedStudentID' => Auth::getstudentID()]);
                    $data['tasks'] = $tasks;

                    $disputeInst = new Dispute();
                    $dispute = $disputeInst->first(['disputeID' => $id]);
                    $data['dispute'] = $dispute;
                    $data['title'] = "Modify Dispute";

                    $this->view('student/modify-disputes', $data);
                    return;
                }
            } else if ($action === 'delete') {
                if (!empty($id)) {
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
                        $disputeInst = new Dispute();
                        $dispute = $disputeInst->first(['disputeID' => $id]);

                        if (!empty($dispute) && $dispute->status !== 'resolved' && $dispute->initiatedParty === 'student') { //only disputes not resolved can be deleted
                            $taskInst = new Task();
                            $task = $taskInst->first(['taskID' => $dispute->taskID]);
                            if ($task->assignedStudentID === Auth::getstudentID()) {

                                $disputeInst->delete($id);
                                message('Dispute deleted successfully!');
                                redirect('student/disputes');
                            } else {
                                message(['You dont have permission to execute this operation!', 'danger']);
                                redirect('student/disputes');
                            }
                        } else {
                            message(['Error occured while deletion!', 'danger']);
                            redirect('student/disputes');
                        }
                    }
                }
            }
        }

        //get alll tasks related to the company
        $taskInst = new Task();
        $tasks = $taskInst->where(['assignedStudentID' => Auth::getstudentID()]);

        $disputeInst = new Dispute();
        $res = [];
        if (!empty($tasks)) {
            for ($i = 0; $i < count($tasks); $i++) {
                $dispute = $disputeInst->where(['taskID' => $tasks[$i]->taskID, 'initiatedParty' => 'student']);
                if (!empty($dispute)) {
                    for ($j = 0; $j < count($dispute); $j++) {
                        $dispute[$j]->task = $tasks[$i];
                        $res[] = $dispute[$j];
                    }
                }
            }
        }

        //        show($res);
        //        die;

        $data['disputes'] = $res;
        $data['title'] = "Disputes";

        $this->view('student/disputes', $data);
    }
}
