<?php

//Charts class
class Charts extends Controller
{

    public function myactivity()
    {
        if (Auth::logged_in() && Auth::is_company()) {

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

            $currentMonth = date('n');
            $currentYear = date('Y');

            //getting last 12 months
            $currentDate = new DateTime();
            $last12Months = [];
            $earnings = [];
            $taskInst = new Task();
            $row = $taskInst->query("SELECT createdAt FROM task WHERE companyID=:companyID",['companyID'=>Auth::getcompanyID()]);

            for ($i = 12; $i >= 1; $i--) {

                $month = ($currentMonth - $i + 12) % 12 + 1;
                $year = $currentYear - (($currentMonth - $i + 12) >= 12 ? 0 : 1);
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
                            $count += 1;
                        }
                    }
                }

                // Format the result ('F Y') and add it to the array
                $last12Months[] = $year . " " . $monthNames[$month - 1];
                $earnings[] = $count;
            }
            $label = "No of tasks per month";

            $obj['data'] = $earnings;
            $obj['label'] = $label;
            $obj['labels'] = $last12Months;

            echo json_encode($obj);
        }


    }


    public function tasksvscategory()
    {
        if (Auth::logged_in() && Auth::is_company()) {

            $taskInst=new Task();
            $row=$taskInst->query("SELECT
    category.title as title,
    COUNT(*) AS task_count
FROM
    task INNER JOIN category ON task.categoryID=category.categoryID
WHERE
    companyID=:companyID
GROUP BY
    task.categoryID;",['companyID'=>Auth::getcompanyID()]);

            $categories=[];
            $taskCount=[];
            if(!empty($row)){
                foreach ($row as $rowElement){
                    $categories[]=$rowElement->title;
                    $taskCount[]=$rowElement->task_count;
                }
                $obj['isFine']=1;
            }else{
                $obj['isFine']=0;
            }

            $label = "Tasks vs Categories";

            $obj['data'] = $taskCount;
            $obj['label'] = $label;
            $obj['labels'] = $categories;

            echo json_encode($obj);
        }


    }


    public function monthlyearnings()
    {
        if (Auth::logged_in() && Auth::is_student()) {

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

            $currentMonth = date('n');
            $currentYear = date('Y');

            //getting last 12 months
            $currentDate = new DateTime();
            $last12Months = [];
            $earnings = [];
            $earningInst = new Earning();
            $row = $earningInst->innerJoin(['task'], ['task.taskID=earnings.taskID'], ['task.assignedStudentID' => Auth::getstudentID()], ['*', 'earnings.createdAt as createdAt'], ['earnings.createdAt', 'DESC']);

            for ($i = 12; $i >= 1; $i--) {

                $month = ($currentMonth - $i + 12) % 12 + 1;
                $year = $currentYear - (($currentMonth - $i + 12) >= 12 ? 0 : 1);
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
                $last12Months[] = $year . " " . $monthNames[$month - 1];
                $earnings[] = $count;
            }
            $label = 'Earnings per month (Rs.)';

            $obj['data'] = $earnings;
            $obj['label'] = $label;
            $obj['labels'] = $last12Months;

            echo json_encode($obj);
        }


    }

    function setgoal()
    {
        if (Auth::logged_in() && Auth::is_student()) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $json_data = file_get_contents("php://input");
                $data = json_decode($json_data, true);
                $earningGoalInst = new Earning_Goal();
                $query="INSERT INTO earning_goal (goal, studentID)
                    VALUES (".$data['goal'].",".Auth::getstudentID().")
                    ON DUPLICATE KEY UPDATE
                    goal =".$data['goal'].";";
//                show($query);

                $earningGoalInst->query($query);
            }
        }
    }

    function earninggoal()
    {
        if (Auth::logged_in() && Auth::is_student()) {
            //this is the default goal
            $goal = 5000;
            $earningGoalInst = new Earning_Goal();
            $res = $earningGoalInst->first(['studentID' => Auth::getstudentID()]);
            if (!empty($res)) {
                $goal = $res->goal;
            }

            $monthEarnings = 0;
            //getting earnings for this month
            $earningInst = new Earning();
            $rows = $earningInst->query("SELECT * FROM earnings WHERE YEAR(createdAt) = :year AND MONTH(createdAt) = :month;",
                [
                    'year' => date('Y'),
                    'month' => date('n'),
                ]);

            if (!empty($rows)) {
                foreach ($rows as $row) {
                    $monthEarnings += $row->amount;
                }
            }

            $toEarn = $goal - $monthEarnings;
            if ($toEarn < 0) $toEarn = 0;

            $obj['data'] = [$monthEarnings, $toEarn];
            $obj['label'] = "Earning goal for this month (Current Goal is " . $goal . ")";
            $obj['labels'] = ['Total Earnings for this month : Rs.' . $monthEarnings, 'Needed amount to reach the goal : Rs.' . $toEarn];
            $obj['currentGoal'] = $goal;
            echo json_encode($obj);

        }
    }

    function taskprogress()
    {
        if (Auth::logged_in() && Auth::is_student()) {
            $taskInst=new Task();
            $query="SELECT
    status,
    COUNT(*) AS status_count
FROM
    task
WHERE
    status IN ('inProgress', 'closed') AND assignedStudentID=:studentID
GROUP BY
    status;
";
            $row=$taskInst->query($query,['studentID'=>Auth::getstudentID()]);
            $inProgress=0;
            $closed=0;
            if(!empty($row)){
                foreach ($row as $rowElement){
                    if($rowElement->status=='inProgress'){
                        $inProgress=$rowElement->status_count;
                    }else if($rowElement->status=='closed'){
                        $closed=$rowElement->status_count;
                    }
                }
            }

            if($inProgress==0 && $closed==0){
                $obj['isFine'] = 0;
            }else{
                $obj['data'] = [$inProgress, $closed];
                $obj['label'] = "Tasks inProgress vs completed";
                $obj['labels'] = ['In progress','completed'];
                $obj['isFine'] = 1;
            }
            echo json_encode($obj);

        }else if (Auth::logged_in() && Auth::is_company()) {
            $taskInst=new Task();
            $query="SELECT
    status,
    COUNT(*) AS status_count
FROM
    task
WHERE
    status IN ('inProgress', 'closed','active') AND companyID=:companyID
GROUP BY
    status;
";
            $row=$taskInst->query($query,['companyID'=>Auth::getcompanyID()]);
            $inProgress=0;
            $closed=0;
            if(!empty($row)){
                foreach ($row as $rowElement){
                    if($rowElement->status=='inProgress'){
                        $inProgress=$rowElement->status_count;
                    }else if($rowElement->status=='closed'){
                        $closed=$rowElement->status_count;
                    }else{
                        $active=$rowElement->status_count;

                    }
                }
            }

            if($inProgress==0 && $closed==0){
                $obj['isFine'] = 0;
            }else{
                $obj['data'] = [$inProgress, $closed,$active];
                $obj['label'] = "Tasks inProgress vs completed vs active";
                $obj['labels'] = ['In progress','completed','active'];
                $obj['isFine'] = 1;
            }
            echo json_encode($obj);

        }
    }

}