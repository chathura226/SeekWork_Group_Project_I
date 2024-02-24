<?php

//Tasks class
class Tasks extends Controller
{


    public function index($id = null)
    {
        $categoryInst=new Category();
        $data['categoriesForBar']=$categoryInst->query("SELECT title,categoryID FROM category;");

        //for search
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            //if search type is skill
            if ($_POST['searchType'] == 'skill') {
                redirect('tasks/search/skill/' . $_POST['searchField']);
            } elseif ($_POST['searchType'] == 'title') {
                redirect('tasks/search/title/' . $_POST['searchField']);
            }elseif ($_POST['searchType'] == 'category') {
                redirect('tasks/search/category/' . $_POST['searchField']);
            }
        }

        if (empty($id)) {


            // send 24 by 24
            $tasksPerPage = TASK_PER_PAGE;
            if (!empty($_GET['page'])) $data['pageNum'] = $_GET['page'];
            else $data['pageNum'] = 1;
            if (!empty($_GET['tab'])) $data['tab'] = $_GET['tab'];
            else $data['tab'] = "all";

            $task = new Task();
            //totalNumber of page count for the tasks
            $all_rows = "SELECT DISTINCT COUNT(task.taskID) AS all_rows FROM task INNER JOIN company ON task.companyID=company.companyID WHERE task.status='active' AND task.isDeleted=0;";
            $row4 = $task->query($all_rows, []);
            $data['allTasksPageCount'] = ceil($row4[0]->all_rows / $tasksPerPage); //all  tasks total page count

            $row = $task->innerJoin(['company'], ['task.companyID=company.companyID'], ['task.status' => "'active'", 'task.isDeleted' => 0], ['*,task.status AS status , company.status AS companyStatus,task.description AS description'], ['task.createdAt', 'ASC'], $tasksPerPage, $tasksPerPage * ($data['pageNum'] - 1));
            $data['tasks'] = $row;// this is for all tasks


            if (Auth::is_student()) {
                //total number of recommended tasks  to calculate the total page count
                $totalNumQuery = "SELECT 
                        COUNT(*) AS total_rows_before_limit
                    FROM (
                        SELECT DISTINCT t.`taskID`, `title`, `taskType`, `description`, `deadline`, `value`, `status`, `documents`, `companyID`, `assignedStudentID`, `assignmentID`, `categoryID`, `finishedDate`, `createdAt` 
                        FROM task t 
                        JOIN task_skill ts ON t.taskID = ts.taskID 
                        WHERE  t.isDeleted=0 AND ts.skillID IN ( 
                            SELECT student_skill.skillID 
                            FROM student_skill 
                            WHERE student_skill.studentID = :studentID 
                        ) 
                    ) AS subquery_alias;
                    ";
                $row3 = $task->query($totalNumQuery, ['studentID' => Auth::getstudentID()]);
                $data['recommendedTasksPageCount'] = ceil($row3[0]->total_rows_before_limit / $tasksPerPage); //recommended  tasks total page count
//                  show($data['recommendedTasksPageCount']);
//                  die;

                $query = "SELECT DISTINCT t.`taskID`, `title`, `taskType`, `description`, `deadline`, `value`, `status`, `documents`, `companyID`, `assignedStudentID`, `assignmentID`, `categoryID`, `finishedDate`, `createdAt` FROM task t JOIN task_skill ts ON t.taskID = ts.taskID WHERE t.isDeleted=0 AND ts.skillID IN ( SELECT student_skill.skillID FROM student_skill WHERE student_skill.studentID = :studentID )  ORDER BY t.createdAt ASC LIMIT " . $tasksPerPage . " OFFSET " . $tasksPerPage * ($data['pageNum'] - 1) . ";";
                $row2 = $task->query($query, ['studentID' => Auth::getstudentID()]);
                $data['recommendedTasks'] = $row2;
//                  show($row2);
//                  die;
            } else {//if not a student
                $data['recommendedTasksPageCount'] = 1;
            }

            $data['title'] = "Tasks";
            $this->view('tasks', $data);

        } else {

            $task = new Task();
            $row = $task->first(['taskID' => $id]);//get task details corresponding to the tadsk id


            if (!empty($row)) {

                $company = new CompanyModel();
                // $compDetails=$company->first(['companyID'=>$row->companyID]);
                // $user = new User();
                // $userdetails=$user->first(['userID'=>$compDetails->userID]);
                // $compDetails->createdAt=$userdetails->createdAt;

                $compDetails = $company->innerJoin(['user'], ['company.userID=user.userID'], ['company.companyID' => $row->companyID])[0];
                // show($compDetails);
                // die;

                //if student is viewing, show them whether they have submitted any proposals
                if (Auth::logged_in() && Auth::is_student()) {
                    $proposalInst = new Proposal();
                    $row2 = $proposalInst->first(['studentID' => Auth::getstudentID(), 'taskID' => $id]);
                    if (!empty($row2)) {
                        $data['proposal'] = $row2; // to tell that they have already submitted a proposal for this
                    }
                }
                if (!empty($compDetails)) {
                    $data['error'] = "Error fetching data!";
                }

                $data['company'] = $compDetails;
                //taking number of proposals
                $proposalInst = new Proposal();
                $nProposals = $proposalInst->count(['taskID' => $row->taskID])[0]->{"COUNT(*)"};
                $row->nProposals = $nProposals;

                $data['title'] = $row->title;
                $data['task'] = $row;

                $taskSkillInst = new Task_Skill();
                $data['skills'] = $taskSkillInst->innerJoin(['skill'], ['skill.skillID=task_skill.skillID'], ['taskID' => $row->taskID]);


                $this->view('task/task', $data);

            } else {

                $data['title'] = "404";
                $this->view("404", $data);

            }


        }
    }

    public function search($searchType = null, $searchField = null)
    {
        //for search
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            //if search type is skill
            if ($_POST['searchType'] == 'skill') {
                redirect('tasks/search/skill/' . $_POST['searchField']);
            } elseif ($_POST['searchType'] == 'title') {
                redirect('tasks/search/title/' . $_POST['searchField']);
            }elseif ($_POST['searchType'] == 'category') {
                redirect('tasks/search/category/' . $_POST['searchField']);
            }
        }

        $tasksPerPage = TASK_PER_PAGE;
        if (!empty($_GET['page'])) $data['pageNum'] = $_GET['page'];
        else $data['pageNum'] = 1;

        $categoryInst=new Category();//for all category bar
        $data['categoriesForBar']=$categoryInst->query("SELECT title,categoryID FROM category;");


        $task = new Task();
        if ($searchType == 'title') {
            //totalNumber of page count for the tasks
            $all_rows = "SELECT DISTINCT COUNT(task.taskID) AS all_rows FROM task INNER JOIN company ON task.companyID=company.companyID WHERE task.status='active' AND task.isDeleted=0 AND task.title LIKE '%$searchField%';";
            $row4 = $task->query($all_rows, []);
            $data['allTasksPageCount'] = ceil($row4[0]->all_rows / $tasksPerPage); //all  tasks total page count

            $offset = $tasksPerPage * ($data['pageNum'] - 1);
            $row = $task->query("SELECT *,task.status AS status , company.status AS companyStatus, task.description AS description FROM task INNER JOIN company ON task.companyID=company.companyID WHERE task.status='active' && task.isDeleted=0 && task.title LIKE '%$searchField%' ORDER BY task.createdAt ASC LIMIT $tasksPerPage OFFSET $offset");
//        $row = $task->innerJoin(['company'], ['task.companyID=company.companyID'], ['task.status' => "'active'",'task.isDeleted' => 0], ['*,task.status AS status , company.status AS companyStatus'], ['task.createdAt', 'ASC'], $tasksPerPage, $tasksPerPage * ($data['pageNum'] - 1));
            $data['tasks'] = $row;// this is for all tasks
//        show($row);
        } elseif ($searchType == 'skill') {
            //search type is skill
            //totalNumber of page count for the tasks
            $all_rows = "SELECT DISTINCT COUNT(task.taskID) AS all_rows FROM task INNER JOIN task_skill ON task.taskID=task_skill.taskID INNER JOIN skill ON skill.skillID=task_skill.skillID WHERE task.status='active' AND task.isDeleted=0 AND skill.skill LIKE '%$searchField%';";
            $row4 = $task->query($all_rows, []);
            $data['allTasksPageCount'] = ceil($row4[0]->all_rows / $tasksPerPage); //all  tasks total page count

            $offset = $tasksPerPage * ($data['pageNum'] - 1);
            $row = $task->query("SELECT *,task.status AS status , company.status AS companyStatus, task.description AS description FROM task INNER JOIN company ON task.companyID=company.companyID WHERE task.status='active' && task.isDeleted=0 && task.taskID IN (SELECT DISTINCT(taskID) FROM task_skill WHERE skillID IN (SELECT skillID FROM skill WHERE skill.skill LIKE '%$searchField%')) ORDER BY task.createdAt ASC LIMIT $tasksPerPage OFFSET $offset ");
//        $row = $task->innerJoin(['company'], ['task.companyID=company.companyID'], ['task.status' => "'active'",'task.isDeleted' => 0], ['*,task.status AS status , company.status AS companyStatus'], ['task.createdAt', 'ASC'], $tasksPerPage, $tasksPerPage * ($data['pageNum'] - 1));
            $data['tasks'] = $row;// this is for all tasks
        }else{
            //search type is category
            //totalNumber of page count for the tasks
            $all_rows = "SELECT DISTINCT COUNT(task.taskID) AS all_rows FROM task INNER JOIN category ON task.categoryID=category.categoryID WHERE task.status='active' AND task.isDeleted=0 AND (category.title LIKE '%$searchField%' OR category.tags LIKE '%$searchField%');";
            $row4 = $task->query($all_rows, []);
            $data['allTasksPageCount'] = ceil($row4[0]->all_rows / $tasksPerPage); //all  tasks total page count

            $offset = $tasksPerPage * ($data['pageNum'] - 1);
            $row = $task->query("SELECT *,task.status AS status , company.status AS companyStatus, task.description AS description FROM task INNER JOIN company ON task.companyID=company.companyID WHERE task.status='active' && task.isDeleted=0 && task.taskID IN (SELECT DISTINCT(taskID) FROM task WHERE categoryID IN (SELECT categoryID FROM category WHERE category.title LIKE '%$searchField%' OR category.tags LIKE '%$searchField%')) ORDER BY task.createdAt ASC LIMIT $tasksPerPage OFFSET $offset ");
//        $row = $task->innerJoin(['company'], ['task.companyID=company.companyID'], ['task.status' => "'active'",'task.isDeleted' => 0], ['*,task.status AS status , company.status AS companyStatus'], ['task.createdAt', 'ASC'], $tasksPerPage, $tasksPerPage * ($data['pageNum'] - 1));
            $data['tasks'] = $row;// this is for all tasks
        }
        $data['tab'] = "all";//since reusage of original tasks view
        $data['title'] = "Tasks";
        $data['searchField'] = $searchField;
        $data['searchType'] = $searchType;
        $this->view('searchTasks', $data);

    }

    public function category($id=null){
        //for search
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            //if search type is skill
            if ($_POST['searchType'] == 'skill') {
                redirect('tasks/search/skill/' . $_POST['searchField']);
            } elseif ($_POST['searchType'] == 'title') {
                redirect('tasks/search/title/' . $_POST['searchField']);
            }elseif ($_POST['searchType'] == 'category') {
                redirect('tasks/search/category/' . $_POST['searchField']);
            }
        }

        if(empty($id)){
            redirect('tasks');
        }else{
            $categoryInst=new Category();//for all category bar
            $data['categoriesForBar']=$categoryInst->query("SELECT title,categoryID FROM category;");


            $tasksPerPage = TASK_PER_PAGE;
            if (!empty($_GET['page'])) $data['pageNum'] = $_GET['page'];
            else $data['pageNum'] = 1;
            if (!empty($_GET['tab'])) $data['tab'] = $_GET['tab'];
            else $data['tab'] = "all";

            $task = new Task();
            //totalNumber of page count for the tasks
            $all_rows = "SELECT DISTINCT COUNT(task.taskID) AS all_rows FROM task INNER JOIN company ON task.companyID=company.companyID WHERE task.status='active' AND task.isDeleted=0 AND task.categoryID=:id;";
            $row4 = $task->query($all_rows, ['id'=>$id]);
            $data['allTasksPageCount'] = ceil($row4[0]->all_rows / $tasksPerPage); //all  tasks total page count

            $row = $task->innerJoin(['company'], ['task.companyID=company.companyID'], ['task.status' => "'active'", 'task.isDeleted' => 0,'task.categoryID'=>$id], ['*,task.status AS status , company.status AS companyStatus,task.description AS description'], ['task.createdAt', 'ASC'], $tasksPerPage, $tasksPerPage * ($data['pageNum'] - 1));
            $data['tasks'] = $row;// this is for all tasks

            $categoryInst=new Category();
            $data['title'] = $categoryInst->first(['categoryID'=>$id])->title;
            $data['categoryName']=$data['title'];
            $data['isCategoryResult']=1;//to switch in the view for reuse for same code in search
//            show($row4);
//            show($data);die;
            $this->view('searchTasks', $data);
        }
    }

    //applying for tasks
    public function apply($id = null)
    {

        if (!Auth::logged_in()) {//if not logged in redirect to login page
            message('Please login to view the student section!');
            redirect('login');
        }
        if (!Auth::is_student()) {///if not a student, redirect to home
            message(['Only students can apply for tasks!', 'danger']);
            redirect('home');
        }
        if (empty($id)) {
            redirect('tasks');
        } else {
            $proposal = new Proposal();

            //if a post request--------------------------------------------------------------------------
            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                if ($proposal->validate($_POST)) {

                    //appending student id to post array
                    $_POST['studentID'] = Auth::getstudentID();

                    //if student has submitted a proposal, he cant submit again
                    $row = $proposal->first(['studentID' => $_POST['studentID'], 'taskID' => $_POST['taskID']]);
                    if (!empty($row)) {
                        message(["You have already submitted a proposal!", 'danger']);
                        redirect('tasks/' . $id);
                    }

                    //no need to check file errors since it will be validated using validate func
                    if (!empty($_FILES['documents']['name'])) {//checking for a file upload
                        $folder = "../app/uploads/tasks/" . $_POST['taskID'] . "/proposals/";
                        $destination = $this->uploadFile($_FILES['documents'], $folder, 'proposalBy' . Auth::getstudentID());
                        $_POST['documents'] = $destination;
                    }

                    if (empty($_POST['documents'])) unset($_POST['documents']);
                    $proposal->insert($_POST);
                    // show($_POST);
                    // die;
                    message("Proposal Submitted Successfully!");
                    redirect('tasks/' . $id);
                }
            }


            //if not a post request-------------------------------------------------------------------------
            $task = new Task();
            $row = $task->first(['taskID' => $id]);//get task details corresponding to the tadsk id

            if (!empty($row)) {
                $proposalInst = new Proposal();
                //if student has submitted a proposal, he cant submit again
                $row2 = $proposalInst->first(['studentID' => Auth::getstudentID(), 'taskID' => $id]);
                if (!empty($row2)) {
                    message(["You have already submitted a proposal!", 'danger']);
                    redirect('tasks/' . $id);
                }

                $company = new CompanyModel();

                $compDetails = $company->innerJoin(['user'], ['company.userID=user.userID'], ['company.companyID' => $row->companyID])[0];

                if (!empty($compDetails)) {
                    $data['error'] = "Error fetching data!";
                }

                $data['company'] = $compDetails;
                $data['task'] = $row;
                $data['errors'] = $proposal->errors;

                $data['title'] = "Apply - " . $row->title;

                $this->view('task/apply', $data);

            } else {

                $data['title'] = "404";
                $this->view("404", $data);

            }

        }

    }

}