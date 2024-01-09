<?php

//Tasks class
class Tasks extends Controller{

    public function index($id=null){


        if(empty($id)){

        $data['title'] = "Tasks";
        
        $task=new Task();
        // $row=$task->where(['status'=>'active']);
        $row=$task->innerJoin(['company'],['task.companyID=company.companyID'],['task.status'=>"'active'"],['*,task.status AS status , company.status AS companyStatus']);
        // show($row);
        // die;
        $data['tasks']=$row;
        
        //TODO:pagination
        // send 24 by 24

        if(!empty($_GET['page'])) $data['pageNum']=$_GET['page'];
        else $data['pageNum']=1;
        if(!empty($_GET['tab'])) $data['tab']=$_GET['tab'];
        else $data['tab']="all";

        $this->view('tasks',$data);

        }else{

            $task=new Task();
            $row = $task->first(['taskID'=>$id]);//get task details corresponding to the tadsk id
            

            if(!empty($row)){
                
                $company=new CompanyModel();
                // $compDetails=$company->first(['companyID'=>$row->companyID]);
                // $user = new User();
                // $userdetails=$user->first(['userID'=>$compDetails->userID]);
                // $compDetails->createdAt=$userdetails->createdAt;
                
                $compDetails=$company->innerJoin(['user'],['company.userID=user.userID'],['company.companyID'=>$row->companyID])[0];
                // show($compDetails);
                // die;

                //if student is viewing, show them whether they have submitted any proposals
                if(Auth::logged_in() && Auth::is_student()){
                    $proposalInst=new Proposal();
                    $row2=$proposalInst->first(['studentID'=>Auth::getstudentID(),'taskID'=>$id]);
                    if(!empty($row2)){
                        $data['proposal']=$row2; // to tell that they have already submitted a proposal for this
                    }
                }
                if(!empty($compDetails)){
                    $data['error']="Error fetching data!";
                }

                $data['company'] = $compDetails;
                //taking number of proposals
                $proposalInst=new Proposal();
                $nProposals=$proposalInst->count(['taskID'=>$row->taskID])[0]->{"COUNT(*)"};
                $row->nProposals=$nProposals;

                $data['title'] = $row->title;
                $data['task']=$row;

                $taskSkillInst=new Task_Skill();
                $data['skills']=$taskSkillInst->innerJoin(['skill'],['skill.skillID=task_skill.skillID'],['taskID'=>$row->taskID]);


                $this->view('task/task',$data);

            }else{

                $data['title']="404";
                $this->view("404",$data);

            }


        }
    }

    //applying for tasks
    public function apply($id=null){

        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the student section!');
            redirect('login');
        }
        if(!Auth::is_student()){///if not a student, redirect to home
            message(['Only students can apply for tasks!','danger']);
            redirect('home');
        }
        if(empty($id)){
            redirect('tasks');
        }else{
            $proposal=new Proposal();

            //if a post request--------------------------------------------------------------------------
            if($_SERVER['REQUEST_METHOD']=="POST"){

                if($proposal->validate($_POST)) {

                    //appending student id to post array
                    $_POST['studentID'] = Auth::getstudentID();

                    //if student has submitted a proposal, he cant submit again
                    $row=$proposal->first(['studentID'=>$_POST['studentID'],'taskID'=>$_POST['taskID']]);
                    if(!empty($row)){
                        message(["You have already submitted a proposal!",'danger']);
                        redirect('tasks/'.$id);
                    }

                    //no need to check file errors since it will be validated using validate func
                    if (!empty($_FILES['documents']['name'])){//checking for a file upload
                        $folder = "../app/uploads/tasks/".$_POST['taskID']."/proposals/";
                        $destination=$this->uploadFile($_FILES['documents'],$folder,'proposalBy'.Auth::getstudentID());
                        $_POST['documents']=$destination;
                    }

                    if (empty($_POST['documents'])) unset($_POST['documents']);
                    $proposal->insert($_POST);
                    // show($_POST);
                    // die;
                    message("Proposal Submitted Successfully!");
                    redirect('tasks/'.$id);
                }
            }


            //if not a post request-------------------------------------------------------------------------
            $task=new Task();
            $row = $task->first(['taskID'=>$id]);//get task details corresponding to the tadsk id

            if(!empty($row)){
                $proposalInst=new Proposal();
                //if student has submitted a proposal, he cant submit again
                $row2=$proposalInst->first(['studentID'=>Auth::getstudentID(),'taskID'=>$id]);
                if(!empty($row2)){
                    message(["You have already submitted a proposal!",'danger']);
                    redirect('tasks/'.$id);
                }
                
                $company=new CompanyModel();
                
                $compDetails=$company->innerJoin(['user'],['company.userID=user.userID'],['company.companyID'=>$row->companyID])[0];
                
                if(!empty($compDetails)){
                    $data['error']="Error fetching data!";
                }

                $data['company'] = $compDetails;
                $data['task']=$row;
                $data['errors'] = $proposal->errors;

                $data['title'] = "Apply - ".$row->title;
        
                $this->view('task/apply',$data);

            }else{

                $data['title']="404";
                $this->view("404",$data);

            }

        }

    }
    
}