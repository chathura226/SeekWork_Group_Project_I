<?php
require_once 'Users.php';

//Company class
class Company extends Users
{

    // Constructor
    //all the validations for authorizations are in the parent controller
    public function __construct()
    {
        parent::__construct('company');
    }

    public function index()
    {


        $ongoing = 0;
        $pendingPayments = 0;
        $closedTasks = 0;
        $newSubmissions = 0;
        $activeTasks=0;

        $taskInst=new Task();
        $ongoing=$taskInst->query("SELECT COUNT(*) as count FROM task WHERE companyID=:companyID AND status=:status;",['companyID'=>Auth::getcompanyID(),'status'=>'inProgress'])[0]->count;
        $closedTasks=$taskInst->query("SELECT COUNT(*) as count FROM task WHERE companyID=:companyID AND status=:status;",['companyID'=>Auth::getcompanyID(),'status'=>'closed'])[0]->count;
        $activeTasks=$taskInst->query("SELECT COUNT(*) as count FROM task WHERE companyID=:companyID AND status=:status;",['companyID'=>Auth::getcompanyID(),'status'=>'active'])[0]->count;
        $paymentInst=new PaymentModel();
        $pendingPayments=$paymentInst->query("SELECT sum(payment.amount) as sum FROM payment INNER JOIN task on task.taskID=payment.taskID WHERE task.companyID=:companyID AND payment.paymentStatus=:status; ",['companyID'=>Auth::getcompanyID(),'status'=>'outstanding'])[0]->sum;


        $submissionInst=new Submission();
        $newSubmissions=$submissionInst->query("SELECT COUNT(*) as count FROM submission INNER JOIN task on task.taskID=submission.taskID WHERE task.companyID=:companyID AND submission.status=:status;",['companyID'=>Auth::getcompanyID(),'status'=>'pendingReview'])[0]->count;

        $data['newSubmissions']=$newSubmissions;
        $data['pendingPayments']=$pendingPayments;
        $data['closedTasks']=$closedTasks;
        $data['ongoing']=$ongoing;
        $data['activeTasks']=$activeTasks;
        $data['title'] = "Dashboard";
        $this->view( 'company/dashboard', $data);
    }


    public function verification()
    {
        $verificationInst = new Moderator_Verifies_Company();

        $companyInst = new CompanyModel();
        $data['title'] = "Verification";

        $errors = [];
        //should implement the validation and procedure
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            if (empty($_POST['description'])) {
                $errors['description'] = "Description is required!";
            }
            if (empty($_FILES['imageInput']['name'])) {
                $errors['imageInput'] = "University ID Card photo is required!";
            }

            if (empty($errors)) {
                if ($_FILES['imageInput']['error'] == 0) {

                    $folder = "../app/uploads/verification/" . Auth::userID() . "/";

                    $destination = $this->uploadFile($_FILES['imageInput'], $folder);

                    $verificationData['description'] = $_POST['description'];
                    $verificationData['documents'] = $destination;

                    //theres no field for documents in company table
                    $companyInst->update($verificationData, Auth::getcompanyID());//updating company description

                    //dont put this before update , since company will check for companyID also
                    $verificationData['companyID'] = Auth::getcompanyID();

                    $verificationInst->insert($verificationData);

                    message("Details submitted successfully!");
                    redirect('company/verification');
                } else {
                    $errors['imageInput'] = "Couldn't upload the file";
                }

            }

        }

        $rows = $verificationInst->where(['companyID' => Auth::getcompanyID()]);
        $data['verifications'] = $rows;


        $data['errors'] = $errors;

        $this->view('company/verification', $data);
    }

    public function payments($id = null)
    {

        //for individual payment
        if (!empty($id)) {
            //getting payment details related to the id
            $paymentInst = new PaymentModel();
            $row1 = $paymentInst->innerJoin(['task'], ['task.taskID=payment.taskID'], ['paymentID' => "'" . $id . "'"])[0];

            //checking the status of the payment and redirecting
            if ($row1->paymentStatus == 'outstanding') {
                $data['merchantID'] = MERCHANT_ID;
                $data['order_id'] = $id;
                $data['items'] = "For posting task - " . $row1->title;
                $data['currency'] = "LKR";
                $data['amount'] = $row1->amount;
                $data['first_name'] = Auth::getfirstName();
                $data['last_name'] = Auth::getlastName();
                $data['email'] = Auth::getemail();
                $data['phone'] = Auth::getcontactNo();
                $data['address'] = Auth::getaddress();
                $data['country'] = "Sri Lanka";

                $data['commission'] = $row1->commission;
                $data['taskVal'] = $row1->value;

                $hash = strtoupper(
                    md5(
                        $data['merchantID'] .
                        $data['order_id'] .
                        number_format($data['amount'], 2, '.', '') .
                        $data['currency'] .
                        strtoupper(md5(MERCHANT_SECRET))
                    )
                );
                $data['hash'] = $hash;
                $data['title'] = "Payment";

                $this->view('company/payment', $data);
                return;
            } else {
                message('Payment is already completed!');
                redirect('company/payments');
            }
        }


        //getting payment details regarding tasks of the company
        $paymentInst = new PaymentModel();
        $row = $paymentInst->innerJoin(['task'], ['task.taskID=payment.taskID'], ['task.companyID' => Auth::getcompanyID()]);

        $data['payments'] = $row;
        $data['title'] = "Payments";

        $this->view('company/payments', $data);
    }

    public function tasks($id = null, $action = null, $id2 = null)
    {


        if (empty($id)) {


            $task = new Task();
            $row=$task->query("SELECT task.*, COUNT(proposal.taskID) AS num_proposals
FROM task
LEFT JOIN proposal ON task.taskID = proposal.taskID WHERE task.companyID=:compID && task.isDeleted=0
GROUP BY task.taskID;",['compID'=>Auth::getcompanyID()]);
//            $row = $task->where(['companyID' => Auth::getcompanyID(), 'isDeleted' => 0]);

            if (empty($row)) {
                message(['You have no tasks posted!', 'danger']);
                redirect('company');
            }
            $data['title'] = "Tasks";

            $data['tasks'] = $row;


            $this->view('company/tasks', $data);
        } else {

            $task = new Task();
            $row = $task->getFirstCustom('task', ['taskID' => $id], 'taskID'); //get task details corresponding to the tadsk id


            if (!empty($row)) {
                if ($row->companyID !== Auth::getcompanyID()) {
                    message(['Unauthorized! Task is not yours', 'danger']);
                    redirect('company/tasks');
                }
                if (!empty($action)) {
                    if ($action === 'submissions') {
                        if (!empty($id2)) {
                            $submissionInst = new Submission();
                            $submission = $submissionInst->first(['submissionID' => $id2]);
                            if (empty($submission)) {
                                message(['No Submission with this ID!', 'danger']);
                                redirect('company/tasks/' . $id . '/submissions');
                            }

                            //post request => changing status of submission after reviewing
                            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                                if (!empty($_POST['comments']) && !empty($_POST['status'])) {
                                    $_POST['reviewedDate'] = date("Y-m-d H:i:s");
                                    $submissionInst->update($_POST, $id2);
                                    message(ucfirst($_POST['status']) . ' successfully!');
                                } else {
                                    message(['Error occurred!', 'danger']);
                                }
                                redirect('company/tasks/' . $id . '/submissions/' . $id2);
                            }

                            // Decode the JSON string back into an array
                            if (!empty($submission->documents)) {
                                $array = json_decode($submission->documents, true);
                                //send only the keys (file names)
                                $submission->documents = array_keys($array);
                            }

                            $data['title'] = "Submission";
                            $data['submission'] = $submission;
                            $data['task'] = $row;
                            $this->view('company/submission', $data);
                            return;
                        }
                        $submissionInst = new Submission();
                        $submissions = $submissionInst->where(['taskID' => $id]);
                        if (empty($submissions)) {
                            message(['No Submissions have Recieved!', 'danger']);
                            redirect('company/tasks/' . $id);
                        }

                        $data['title'] = "Submissions";
                        $data['submissions'] = $submissions;
                        $data['task'] = $row;
                        $this->view('company/submissions', $data);
                        return;
                    } else if ($action === 'pendingassignments') { //view all proposals relavant to given task id
                        $assignmentInst = new Assignment();
                        $assignments = $assignmentInst->where(['taskID' => $id]);

                        if (empty($assignments)) {
                            message(['No Invitations have been sent!', 'danger']);
                            redirect('company/tasks/' . $id);
                        }

                        $studentInst = new StudentModel();
                        $proposalInst = new Proposal();
                        for ($i = 0; $i < count($assignments); $i++) {
                            $proposal = $proposalInst->first(['proposalID' => $assignments[$i]->proposalID]);
                            $assignments[$i]->student = $studentInst->first(['studentID' => $proposal->studentID]);
                        }
                        $data['title'] = "Pending Assignment Invitations";
                        $data['assignments'] = $assignments;
                        $data['task'] = $row;
                        $this->view('company/pendingassignments', $data);
                        return;
                    } else if ($action === 'view-proposals') { //view all proposals relavant to given task id
                        $proposal = new Proposal();
                        $proposals = $proposal->where(['taskID' => $id]);
                        $data['title'] = "Proposals";
                        $data['task'] = $row;
                        $data['proposals'] = $proposals;
                        $this->view('company/proposals', $data);
                        return;
                    } else if ($action === 'proposal') { //view proposals relavant to given proposal id that given for the task
                        if (!empty($id2)) {
                            $proposalInst = new Proposal();
                            $proposal = $proposalInst->first(['proposalID' => $id2]);
                            if (!empty($proposal)) {
                                $studentInst = new StudentModel();
                                $student = $studentInst->first(['studentID' => $proposal->studentID]);
                                $universityInst = new University();
                                $university = $universityInst->first(['universityID' => $student->universityID]);
                                $assignmentInst=new Assignment();
                                $data['assignment']=$assignmentInst->first(['proposalID'=>$id2]);
                                $data['title'] = "Proposal";
                                $data['task'] = $row;
                                $data['student'] = $student;
                                $data['university'] = $university;
                                $data['proposal'] = $proposal;
                                $this->view('company/proposal', $data);
                                return;
                            }
                            message(['Invalid Proposal ID!', 'danger']);
                            redirect('company/tasks/' . $id . '/view-proposals');
                            return;
                        }
                    } else if ($action === 'assign') {
                        //in here id 2 will be proposal id
                        if (empty($id2)) {
                            message('Select a Proposal to assign!');
                            redirect('company/tasks/' . $id . '/view-proposals');
                        }

                        $proposalInst = new Proposal();
                        $proposal = $proposalInst->first(['proposalID' => $id2]);

                        if (!empty($proposal)) {
                            if ($proposal->taskID == $id) { //proposal is relevant to the same task

                                if (!empty($row->assignedStudentID)) {
                                    message(['You have already assigned a student!', 'danger']);
                                    redirect('company/pendingassignments');
                                }


                                //id2 is proposal id

                                $assignment = new Assignment();
                                $assignment->insert(['proposalID' => $id2, 'taskID' => $id]);
                                // $task->update(['acceptedProposalID'=>$id2,'assignedStudentID'=>$proposal->studentID],$row->taskID);

                                //sending email for invitation
                                $studentInst = new StudentModel();
                                $student = $studentInst->innerJoin(['user'], ['student.userID=user.userID'], ['studentID' => $proposal->studentID])[0];

                                Notification::newNotification("You have a new task invitation!","student/pendinginvites/",$student->userID);
                                $fullName = $student->firstName . ' ' . $student->lastName;
                                $content = MailService::prepareNewInvitationEmaik($fullName, $row, $proposal);
                                $boom = MailService::sendMail($student->email, $fullName, 'Task Invitation', $content);

                                message('Invitation for the task sent successfully!');
                                redirect('company/pendingassignments');
                            }
                        }
                    }

                    message(['Invalid Action!', 'danger']);
                    redirect('company');
                    return;
                }



                if ($row->companyID === Auth::getcompanyID()) {
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

                    //if assined to a student , get student details
                    if(!empty($row->assignedStudentID)){
                        $studentInst = new StudentModel();
                        $student = $studentInst->innerJoin(['university'],['university.universityID=student.universityID'],['student.studentID' => $row->assignedStudentID])[0];
                        $data['student'] = $student;
                    }

                    $data['task'] = $row;
                    $data['title'] = $row->title;
//                    show($data);die;
                    $this->view('company/task', $data);
                } else {
                    message(['Unauthorized', 'danger']);
                    redirect('company/tasks');
                }
            } else {

                message(['Error fetching data!', 'danger']);
                redirect('company/tasks');
            }
        }
    }

    //to check others profiles
    public function viewstudents($id = null)
    {


        if (!empty($id)) {

            $studentInst = new StudentModel();


            $studentDetails = $studentInst->innerJoin(['user', 'university'], ['student.userID=user.userID', 'student.universityID=university.universityID'], ['student.studentID' => $id])[0];

            // $student = $studentInst->first((['studentID' => $id])); //get user details corresponding to the user id
            // if (!empty($student)) {
            //     $userInst = new User();
            //     $user = $userInst->first((['userID' => $student->userID]));
            //     $universityInst = new University();
            //     $university = $universityInst->first((['universityID' => $student->universityID]));

            //     //get details of user from relevant table and make a combined object 
            //     $combinedObject = (object)array_merge((array)$student, (array)$user);
            //     $combinedObject2 = (object)array_merge((array)$combinedObject, (array)$university);

            //     //pass the combined object to the view
            //     $data['user'] = $combinedObject2;
            //     // show($combinedObject2);
            //     // die;

            //     $data['title'] = "Other User Profiles";

            //     $this->view('company/otherProfile', $data);
            //     return;
            // }

            $data['user'] = $studentDetails;


            $data['title'] = "Other User Profiles";

            $this->view('company/otherProfile', $data);
            return;
        }

        message(['Invalid User ID!', 'danger']);
        redirect('company');
    }

    //post tasks
    public function post()
    {

        $task = new Task();

        //if the method is post->creatre task
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            //chaning the field of is pdf reuired accordignly
            if(!empty($_POST['isPdfRequiredProposal'])){
                if($_POST['isPdfRequiredProposal']=='on'){
                    $_POST['isPdfRequiredProposal']=1;
                }
            }

            if (!empty($_FILES['documents']['name'])) {//checking for a file upload

                if ($_FILES['documents']['error'] == 0) {

                    $_POST['status'] = 'active';
                    $_POST['companyID'] = Auth::getcompanyID();
                    if (empty($_POST['deadline'])) unset($_POST['deadline']);
                    if ($task->validate($_POST)) {//before move file, validate other data and insert
                        $insertedID = $task->insert($_POST);

                        if ($insertedID) {//successful insertion
                            $folder = "../app/uploads/tasks/" . $insertedID . "/details/";

                            $destination = $this->uploadFile($_FILES['documents'], $folder);

                            $fileLoc['documents'] = $destination;
                            $task->update($fileLoc, $insertedID);//updating file location

                            //skills related to task
                            $this->skillsRelatedToTask($insertedID);
                            message('Task Posted Successfully!');
                            redirect('company/tasks');
                        } else {//didnt inserted to db
                            message(['Error occurred while posting! Try again', "danger"]);
                            redirect('company/tasks');
                        }

                    }
                } else {
                    $task->errors['documents'] = "Couldn't upload the file";
                }
            } else {
                $_POST['status'] = 'active';
                $_POST['companyID'] = Auth::getcompanyID();
                if (empty($_POST['deadline'])) unset($_POST['deadline']);
                if ($task->validate($_POST)) {//validate task details

                    $insertedID = $task->insert($_POST);


                    //skills related to task
                    $this->skillsRelatedToTask($insertedID);
                    message('Task Posted Successfully!');
                    redirect('company/tasks');
                }
            }
        }

        $category = new Category();
        $row = $category->getAll();
        $data['categories'] = $row;

        $skillInst = new Skill();
        $data['skills'] = $skillInst->getAll();

        $data['title'] = "Post Task";
        $data['errors'] = $task->errors;

        $this->view('company/post', $data);
    }


    //modify tasks
    public function modify($id = null)
    {


        $task = new Task();

        if (empty($id)) {
            message('Choose a task to modify!');
            redirect('company/tasks');
        } else {

            //if the method is post->update task
            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                //chaning the field of is pdf reuired accordignly
                if(!empty($_POST['isPdfRequiredProposal'])){
                    if($_POST['isPdfRequiredProposal']=='on'){
                        $_POST['isPdfRequiredProposal']=1;
                    }
                }
                if (!empty($_FILES['documents']['name'])) {//checking for a file upload

                    if ($_FILES['documents']['error'] == 0) {

                        if (empty($_POST['deadline'])) unset($_POST['deadline']);
                        if ($task->validate($_POST)) {//before move file, validate other data and insert
                            $row = $task->first(['taskID' => $id]);
                            if (!empty($row)) {
                                $file = $row->documents;
                                if (!empty($file)) {
                                    if (file_exists($file)) {
                                        unlink($file);
                                    }
                                }
                                $folder = "../app/uploads/tasks/" . $id . "/details/";
                                $destination = $this->uploadFile($_FILES['documents'], $folder);
                                $_POST['documents'] = $destination;
                                $task->update($_POST, $id);//updating task

                                //adding modified list of skills
                                //there can be skills to be deleted. => second param is false
                                $this->skillsRelatedToTask($id, false);

                                message("Task modified successfully!");
                                redirect('company/tasks/' . $id);
                            } else {
                                message(['Error occured while modifying! Try again', "danger"]);
                                redirect('company/tasks');
                            }

                        }
                    } else {
                        $task->errors['documents'] = "Couldn't upload the file";
                    }
                } else {

                    if (empty($_POST['deadline'])) unset($_POST['deadline']);
                    if ($task->validate($_POST)) {
                        $task->update($_POST, $id);

                        //adding modified list of skills
                        //there can be skills to be deleted. => second param is false
                        $this->skillsRelatedToTask($id, false);

                        message('Task Modified Successfully!');
                        redirect('company/tasks/' . $id);
                    }
                }
            }


            $row = $task->first(['taskID' => $id]); //get task details corresponding to the tadsk id

            if (!empty($row)) {
                if ($row->companyID === Auth::getcompanyID()) {

                    $category = new Category();
                    $row2 = $category->getAll();
                    $data['categories'] = $row2;

                    $skillInst = new Skill();
                    $data['skills'] = $skillInst->getAll();

                    $taskSkillInst = new Task_Skill();
                    $data['taskSkills'] = $taskSkillInst->innerJoin(['skill'], ['skill.skillID=task_skill.skillID'], ['taskID' => $id]);

                    $data['task'] = $row;
                    $data['title'] = "Modify - " . $row->title;
                    $data['errors'] = $task->errors;

                    $this->view('company/modify', $data);
                } else {

                    message(['Unauthorized', 'danger']);
                    redirect('company/tasks');
                }
            } else {

                message(['Error fetching data!', 'danger']);
                redirect('company/tasks');
            }
        }
    }

    //delete tasks
    public function delete($id = null)
    {
        if (!empty($id)) {

            $taskInst = new Task();
            $task = $taskInst->innerJoin(['category'], ['category.categoryID=task.categoryID'], ['taskID' => $id], ['*,category.title As categoryTitle']);
            if (!empty($task)) $task = $task[0];//removing array that comes with innerjoin
            if (empty($task) || $task->companyID != Auth::getcompanyID()) {
                message(['Invalid Task ID', 'danger']);
                redirect('company/tasks');
            }


            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if ($_POST['confirm'] === 'delete the task') {


                    if($task->status=='closed' || empty($task->assignedStudentID)){
                        //if task is closed OR if task is not assigned
                        $taskInst->update(['isDeleted' => 1], $id);
                    }else{
                        //if task if assigned but not closed
                        message(['Please close the task before deleting!','danger']);
                        redirect('company/tasks');
                    }

                    message('Task Deleted Successfully!');
                    redirect('company/tasks');
                    
                } else {
                    message(['Confirmation Failed', 'danger']);
                    redirect('company/tasks/' . $id);
                }


            }


            $submissionInst = new Submission();
            $submissions = $submissionInst->innerJoin(['task'], ['task.taskID=submission.taskID'], ['task.taskID' => $id], ["COUNT(*)"])[0]->{"COUNT(*)"};
            $pendingSubmissions = $submissionInst->innerJoin(['task'], ['task.taskID=submission.taskID'], ['task.taskID' => $id, 'submission.status' => '"pendingReview"'], ["COUNT(*)"])[0]->{"COUNT(*)"};
            $data['submissions'] = $submissions;
            $data['pendingSubmissions'] = $pendingSubmissions;
            $data['task'] = $task;

            $data['title'] = "Delete task";
            $this->view('company/deleteTask', $data);
        }
    }

    //review
    public function review($action = null, $id = null)
    {


        if (!empty($action)) {

            if ($action === 'post') { //there should be the task id with the url
                if (!empty($id)) {

                    $task = new Task();
                    $row = $task->first(['taskID' => $id, 'companyID' => Auth::getcompanyID()]);

                    if (empty($row)) { //no task posted by him with the given id is found
                        message(['Unauthorized!', 'danger']);
                        redirect('company/tasks');
                    }

                    if ($row->status !== 'closed') {
                        message(['You cannot add the review until the task is finished!', 'danger']);
                        redirect('company/tasks');
                    }


                    if ($_SERVER['REQUEST_METHOD'] == "POST") {

                        $_POST['companyID'] = Auth::getcompanyID();
                        $_POST['studentID'] = $row->assignedStudentID;
                        $_POST['taskID'] = $id;
                        $_POST['reviewType'] = 'companyTOstudent';

                        $review = new Review();
                        $is_review = $review->first(['taskID' => $id, 'reviewType' => 'companyTOstudent']);
                        if (!empty($is_review)) {
                            message(['Failed!  You have a review for this task already!', 'danger']);
                            redirect('company/review');
                        }
                        $review->insert($_POST);

                        message('Review Added Successfully!');
                        redirect('company/review');
                    } else {

                        $student = new StudentModel();
                        $data['student'] = $student->first(['studentID' => $row->assignedStudentID]); //send the details of student relevant to the review
                        $data['task'] = $row;
                        $data['title'] = 'Add a Review';
                        $this->view('company/post-review', $data);
                        return;
                    }
                } else {
                    message('Choose a task to add a review!');
                    redirect('company/tasks');
                }
            } else if ($action === 'modify') { //there should be the review id with the url
                if (!empty($id)) {

                    $review = new Review();
                    $row = $review->first(['reviewID' => $id, 'companyID' => Auth::getcompanyID(), 'reviewType' => 'companyTOstudent']);
                    $task = new Task();
                    $taskDetails = $task->first(['taskID' => $row->taskID, 'companyID' => Auth::getcompanyID()]);
                    if (empty($row)) { //no review posted by him with the given reviewID is found
                        message(['Unauthorized!', 'danger']);
                        redirect('company/review');
                    }


                    if ($_SERVER['REQUEST_METHOD'] == "POST") {

                        $_POST['companyID'] = Auth::getcompanyID();
                        $_POST['studentID'] = $taskDetails->assignedStudentID;
                        $_POST['taskID'] = $row->taskID;
                        $_POST['reviewType'] = 'companyTOstudent';

                        $review->update($_POST, $id);

                        message('Review Updated Successfully!');
                        redirect('company/review');
                    } else {
                        $task = new Task();
                        $taskDetails = $task->first(['taskID' => $row->taskID, 'companyID' => Auth::getcompanyID()]);
                        $data['task'] = $taskDetails;

                        $student = new StudentModel();
                        $data['student'] = $student->first(['studentID' => $row->studentID]);


                        $data['review'] = $row;
                        $data['title'] = 'Modify a Review';
                        $this->view('company/modify-review', $data);
                        return;
                    }
                } else {
                    message('Choose a review to modify!');
                    redirect('company/review');
                }
            } else if ($action === 'delete') { //there hould be a review ID with the url
                if ($_SERVER['REQUEST_METHOD'] == "POST") {

                    if (!empty($id)) {
                        $review = new Review();
                        $row = $review->first(['reviewID' => $id, 'companyID' => Auth::getcompanyID(), 'reviewType' => 'companyTOstudent']);
                        //checking whethere theres review with the given id posted by logged in user
                        if (!empty($row)) {
                            $review->delete($id);
                            message('Review Deleted Successfully!');
                            redirect('company/review');
                        } else {
                            message(['Unauthorized!', 'danger']);
                            redirect('company/review');
                        }
                    } else {
                        message('Choose a review to delete!');
                        redirect('company/review');
                    }
                }
                redirect('company/review');
            }
        }


        $review = new Review();
        $row = $review->where(['companyID' => Auth::getcompanyID(), 'reviewType' => 'companyTOstudent']); //get reviews written by this user
        if (empty($row)) { //no review posted by him with the given reviewID is found
            message('You haven\'t posted any reviews!');
            $data['title'] = 'Reviews';
            $data['reviews'] = $row;
            $this->view('company/review', $data);
            return;
        }
        $task = new Task();
        $student = new StudentModel();
        for ($i = 0; $i < count($row); $i++) {
            $row[$i]->task = $task->first(['taskID' => $row[$i]->taskID]);
            $row[$i]->student = $student->first(['studentID' => $row[$i]->studentID]);
        }

        $data['title'] = 'Reviews';
        $data['reviews'] = $row;
        $this->view('company/review', $data);
    }

    public function inprogress()
    {


        $data['title'] = "Tasks in-progress";
        $tasksInst = new Task();
        $tasks = $tasksInst->where(['companyID' => Auth::getcompanyID(), 'status' => 'inProgress', 'isDeleted' => 0]);

        $data['tasks'] = $tasks;
        $this->view('company/tasks-inprogress', $data);
    }

    public function disputes($action = null, $id = null)
    {


        if (!empty($action)) {
            if ($action === 'post') {

                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    $_POST['status'] = 'pending';
                    $_POST['initiatedParty'] = 'company';

                    $disputeInst = new Dispute();

                    $disputeInst->insert($_POST);
                    // show($_POST);
                    // die;
                    message('Dispute Added Successfully!');
                    redirect('company/disputes');
                }
                $taskInst = new Task();
                $tasks = $taskInst->where(['companyID' => Auth::getcompanyID(), 'isDeleted' => 0]);
                $data['tasks'] = $tasks;
                $data['title'] = "New Dispute";

                $this->view('company/post-disputes', $data);
                return;
            } else if ($action === 'modify') {
                if (!empty($id)) {

                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
                        $_POST['status'] = 'pending';
                        $_POST['initiatedParty'] = 'company';

                        $disputeInst = new Dispute();

                        $disputeInst->update($_POST, $id);

                        message('Dispute Modified Successfully!');
                        redirect('company/disputes');
                    }

                    $taskInst = new Task();
                    $tasks = $taskInst->where(['companyID' => Auth::getcompanyID(), 'isDeleted' => 0]);
                    $data['tasks'] = $tasks;

                    $disputeInst = new Dispute();
                    $dispute = $disputeInst->first(['disputeID' => $id]);
                    $data['dispute'] = $dispute;
                    $data['title'] = "Modify Dispute";

                    $this->view('company/modify-disputes', $data);
                    return;
                }
            } else if ($action === 'delete') {
                if (!empty($id)) {
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
                        $disputeInst = new Dispute();
                        $dispute = $disputeInst->first(['disputeID' => $id]);

                        if (!empty($dispute) && $dispute->status !== 'resolved' && $dispute->initiatedParty === 'company') { //only disputes not resolved can be deleted
                            $taskInst = new Task();
                            $task = $taskInst->first(['taskID' => $dispute->taskID]);
                            if ($task->companyID === Auth::getcompanyID()) {

                                $disputeInst->delete($id);
                                message('Dispute deleted successfully!');
                                redirect('company/disputes');
                            } else {
                                message(['You dont have permission to execute this operation!', 'danger']);
                                redirect('company/disputes');
                            }
                        } else {
                            message(['Error occured while deletion!', 'danger']);
                            redirect('company/disputes');
                        }
                    }
                }
            }
        }

        //get alll tasks related to the company
        $taskInst = new Task();
        $tasks = $taskInst->where(['companyID' => Auth::getcompanyID(), 'isDeleted' => 0]);

        $disputeInst = new Dispute();
        $res = [];
        if (!empty($tasks)) {
            for ($i = 0; $i < count($tasks); $i++) {
                $dispute = $disputeInst->where(['taskID' => $tasks[$i]->taskID, 'initiatedParty' => 'company']);
                if (!empty($dispute)) {
                    for ($j = 0; $j < count($dispute); $j++) {
                        $dispute[$j]->task = $tasks[$i];
                        $res[] = $dispute[$j];
                    }
                }
            }
            //        show($res);
            //        die;
        }
        $data['disputes'] = $res;
        $data['title'] = "Disputes";

        $this->view('company/disputes', $data);
    }

    //close task
    public function close($id = null)
    {
        if (!empty($id)) {
            $taskInst = new Task();
            $task = $taskInst->innerJoin(['category'], ['category.categoryID=task.categoryID'], ['taskID' => $id], ['*,category.title As categoryTitle']);

//            show($pendingSubmissions);die;
            if (!empty($task)) $task = $task[0];//removing array that comes with innerjoin
            if (empty($task) || $task->companyID != Auth::getcompanyID()) {
                message(['Invalid Task ID', 'danger']);
                redirect('company/tasks');
            }


            //for post req for close
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if ($_POST['confirm'] === 'close the task') {

                    //checking whether the payment is made before closing the task
                    $paymentInst = new PaymentModel();
                    $pay = $paymentInst->first(['taskID' => $id]);
                    if (empty($pay)) {
                        message(['Please make the payment for the task before closing!', 'danger']);
                        redirect('company/payments');
                    } else if ($pay->paymentStatus != 'completed') {
                        message(['Please make the payment for the task before closing!', 'danger']);
                        redirect('company/payments');
                    }

                    $taskInst->update(['status' => 'closed'], $id);

                    //new earnigng for the assigned student
                    $earningInst = new Earning();
                    $proposalInst = new Proposal();
                    $proposal = $proposalInst->innerJoin(['assignment'], ['assignment.proposalID=proposal.proposalID'], ['assignmentID' => $task->assignmentID])[0];
                    $price = $proposal->proposeAmount;
                    if (empty($price)) {//fixed price
                        $price = $task->value;
                    }

                    $payment['transactionID'] = uniqid();
                    $payment['earningStatus'] = 'available';
                    $payment['taskID'] = $id;
                    $payment['earningDescription'] = "Earning by the Task - " . $task->title;
                    $payment['amount'] = $price;
                    $earningInst->insert($payment);


                    message('Task closed successfully!');
                    redirect('company/tasks');
                } else {
                    message(['Confirmation Failed', 'danger']);
                    redirect('company/tasks');
                }
            }

            $submissionInst = new Submission();
            $submissions = $submissionInst->innerJoin(['task'], ['task.taskID=submission.taskID'], ['task.taskID' => $id], ["COUNT(*)"])[0]->{"COUNT(*)"};
            $pendingSubmissions = $submissionInst->innerJoin(['task'], ['task.taskID=submission.taskID'], ['task.taskID' => $id, 'submission.status' => '"pendingReview"'], ["COUNT(*)"])[0]->{"COUNT(*)"};


            $data['submissions'] = $submissions;
            $data['pendingSubmissions'] = $pendingSubmissions;
            $data['task'] = $task;

            $data['title'] = "Close the Task";
            $this->view('company/closeTask', $data);

        }
    }

    //show invites that havent yet answered
    public function pendingassignments()
    {
        $assignmentInst = new Assignment();
        $row = $assignmentInst->innerJoin(['task'], ['task.taskID=assignment.taskID'], ['task.companyID' => Auth::getcompanyID()], ['*,task.status AS taskStatus, assignment.status AS assignmentStatus,assignment.createdAt AS assignmentDate,task.createdAt AS taskDate,assignment.assignmentID AS assignmentID']);
//        show($row);die;
        $data['title'] = 'Pending Invitations';
        $data['assignments'] = $row;
        $this->view('company/pendinginvites', $data);
    }

    /**
     * THis is for adding skills for tasks
     * @param $insertedID
     * @param bool $isDeletedEmpty // this shoes whether theres skills to be deleted
     * @return void
     */
    public function skillsRelatedToTask($insertedID, $isDeletedEmpty = true)
    {

        //if theres skills to be deleted
        if (!$isDeletedEmpty) {
            $deletedSkills = json_decode($_POST['deletedSkills']);

            if (!empty($deletedSkills)) {//removing skills
                //deleting from skill-student table
                $taskSkillInst = new Task_Skill();
                $taskSkillInst->deleteBatch($deletedSkills);
            }
        }

        $predefinedSkills = json_decode($_POST['selectedSkills']);
        $newSkills = json_decode($_POST['newlyAddedSkills']);//these are not skill ids. these are task-skillID


        //id array for selected skills
        $allIDs = [];

        if (!empty($newSkills)) { // creating new skills

            // Convert to an array of arrays with 'skill' as the key
            $skillsArrayOfArrays = [];
            foreach ($newSkills as $value) {
                $skillsArrayOfArrays[] = ['skill' => $value];
            }

            $skillInst = new Skill();
            $firstInsertedID = $skillInst->insertBatch($skillsArrayOfArrays); //this will return the id of the first row that was inserted

            //calculating and adding the inserted skill ids for the selected ID list
            $allIDs[] = $firstInsertedID;
            if (count($skillsArrayOfArrays) > 1) {
                for ($i = 1; $i < count($skillsArrayOfArrays); $i++) {//since id generation is squential,ids are calculated for all insertions
                    $allIDs[] = $allIDs[count($allIDs) - 1] + 1;
                }
            }

        }

        if (!empty($predefinedSkills)) { // adding the selected skills
            $allIDs = array_merge($allIDs, $predefinedSkills);
        }

        //if the selected and newly added skills are not empty-> insert to skillstudent table
        if (!empty($allIDs)) {
            // Convert to an array of arrays with 'skillID' and taskID as the key
            $finalTaskSkillData = [];
            foreach ($allIDs as $value) {
                $finalTaskSkillData[] = ['skillID' => $value, 'taskID' => $insertedID];
            }

            //inserting into skill-task table
            $skillTaskInst = new Task_Skill();
            $skillTaskInst->insertBatch($finalTaskSkillData);

        }


    }

}
