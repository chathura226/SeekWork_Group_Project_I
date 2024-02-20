<?php

//Company class
class CompanyModel extends Model {
    protected $table="company";
    public $errors=[];
    protected $primaryKey='companyID';

    //fields that can be updated
    protected $allowedColumns=[
        'companyName',	
        'firstName',	
        'lastName',
        'status',
        'address',	
        'website',
        'profilePic',
        'description',
        'brn',	
        'userID',
        'companyID',
        'final_rating',
        'nReviews',
        'nTasks',
    ];

     
    //company validate function is in user model.....................


    //company validation for update profile
    //if all goes well, return true, else false
    public function validate($data){
        $this->errors=[];

        
        if(empty($data['companyName'])){
            $this->errors['companyName']="Company Name is required!";
        }
        if(empty($data['firstName'])){
            $this->errors['firstName']="First Name is required!";
        }else if(!preg_match("/^[a-zA-Z]+$/",trim($data['firstName']))){//checking for numbers
            $this->errors['firstName']="First Name can only contain letters without spaces!";
        }
        if(empty($data['lastName'])){
            $this->errors['lastName']="Last Name is required!";
        }else if(!preg_match("/^[a-zA-Z]+$/",trim($data['lastName']))){//checking for numbers
            $this->errors['lastName']="Last Name can only contain letters without spaces!";
        }
        if(empty($data['address'])){
            $this->errors['address']="Address is required!";
        }


        

        

        if (!empty($data['website'])) {
            $website = $data['website'];
        
            // Remove leading and trailing spaces from the input
            $website = trim($website);
        
            // Check if it's a valid URL
            if (!filter_var($website, FILTER_VALIDATE_URL)) {
                $this->errors['website']="Invalid website URL!";
            }
        }


        // print_r($this->errors);
        if(empty($this->errors)){
            return true;
        }
        
        return false;
    }


    //validation before deltions
    public function deletionValidation(){
        $this->errors=[];
        $userID=Auth::getuserID();
        $companyID=Auth::getcompanyID();

        $taskInst=new Task();
        $row1=$taskInst->first(['status'=>'inProgress','companyID'=>$companyID,'isDeleted'=>0]);
        $row2=$taskInst->first(['status'=>'active','companyID'=>$companyID,'isDeleted'=>0]);
        if(!empty($row1) || !empty($row2)){
//            show($row);die;
            $this->errors['tasks']="Close ongoing tasks before deletion of the account !";
        }

        //check for any payment pendings
        $paymentInst=new PaymentModel();
        $res=$paymentInst->query("SELECT * FROM payment INNER JOIN task ON payment.taskID = task.taskID WHERE task.companyID=:companyID && payment.paymentStatus='outstanding'",['companyID'=>Auth::getcompanyID()]);
        if(!empty($res)){
            $this->errors['payment']="Please settle outstanding payments before deletion!";
        }

        if(empty($this->errors)){
            return true;
        }

        return false;
    }

}