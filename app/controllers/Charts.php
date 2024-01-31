<?php

//Charts class
class Charts extends Controller
{

    public function monthlyearnings()
    {
        if (Auth::logged_in() && Auth::is_student()) { //if not logged in redirect to login page

            $monthNames = [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December',
            ];

            $currentMonth=date('n');
            $currentYear=date('Y');

            //getting last 12 months
            $currentDate = new DateTime();
            $last12Months = [];
            $earnings = [];
            $earningInst = new Earning();
            $row = $earningInst->innerJoin(['task'], ['task.taskID=earnings.taskID'], ['task.assignedStudentID' => Auth::getstudentID()], ['*', 'earnings.createdAt as createdAt'], ['earnings.createdAt', 'DESC']);

            for ($i = 12; $i >= 1; $i--) {

                $month=($currentMonth-$i+12)%12+1;
                $year=$currentYear-(($currentMonth-$i+12)>=12?0:1);
                $count = 0;
//                $lastMonth = clone $currentDate;
//
//                // Subtract $i months
//                $lastMonth->sub(new DateInterval('P' . $i . 'M'));
//                $lastMonthInt = $lastMonth->format('m');
//                $lastMonthYearInt = $lastMonth->format('y');
                if (!empty($row)) {
                    foreach ($row as $item) {
                        $dateTimeMySQL = new DateTime($item->createdAt);
                        if ($month == $dateTimeMySQL->format('m') && $year == $dateTimeMySQL->format('Y')) {
                            $count += $item->amount;
                        }
                    }
                }

                // Format the result ('F Y') and add it to the array
                $last12Months[] = $year." ".$monthNames[$month-1];
                $earnings[] = $count;
            }
        }

        $label = 'Earnings per month for last 12 months (Rs.)';

        $obj['data'] = $earnings;
        $obj['label'] = $label;
        $obj['labels'] = $last12Months;

        echo json_encode($obj);


    }

}