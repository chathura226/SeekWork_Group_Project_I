<?php

//Charts class
class Charts extends Controller
{

    public function monthlyearnings(){

        //getting last 12 months
        $currentDate=new DateTime();
        $last12Months=[];

        for ($i = 1; $i <= 12; $i++) {

            $lastMonth = clone $currentDate;

            // Subtract $i months 
            $lastMonth->sub(new DateInterval('P'.$i.'M'));

            // Format the result ('F Y') and add it to the array
            $last12Months[] = $lastMonth->format('F Y');
        }

        $data=[12, 19, 3, 5, 2, 3,12, 19, 3, 5, 2, 3];
        $label='# of Votes';
        $labels=['January', 'Feb', 'Yellow', 'Green', 'Purple', 'Orange'];

        $obj['data']=$data;
        $obj['label']=$label;
        $obj['labels']=$last12Months;

        echo json_encode($obj);

    }

}