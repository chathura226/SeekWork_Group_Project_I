<?php

//Submission class
class Submission extends Model {
    protected $table="submission";
    public $errors=[];
    protected $primaryKey='submissionID';

    //fields that can be updated
    protected $allowedColumns=[
        'submissionID',
        'createdAt',
        'documents',
        'status',
        'note',
        'comments',
        'reviewedDate',
        'studentID',
        'taskID',	
    ];


    public function validate($data)
    {

        $this->errors = [];



        if(empty($data['note'])){
            $this->errors['note']="A note about the submission is required!";
        }

        if (!empty($_FILES['documents']['name'][0])) {//checking for a file upload errors
            for($i=0;$i<sizeof($_FILES['documents']['name']);$i++){
                if ($_FILES['documents']['error'][$i] != 0) {
                    $this->errors['documents'] = "Couldn't upload the files";
                }
            }

        }

        if(empty($this->errors)){
            return true;
        }

        return false;
    }
     
}