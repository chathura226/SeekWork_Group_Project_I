<?php

//update MySQL

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'reviews_db';

try{
    $$pdo = new POD('mysql:host='. $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8' , $DATABASE_HOST, $DATABASE_PASS);
}catch(PODException $exception){
    //if there is an error with connection

    exit('Fail to connect the database!');
}

function time_elapsed_string($datetime,$full=false){
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff->w= floor($diff->d/7);
    $diff->d= $diff->w*7;
    $string = array('y'=>'year', 'm'=>'month', 'w'=>'week', 'd' => 'day', 'h' => 'hour', 'i' =>'minute',
    's' =>'second');

    foreach($string as $k=>&$v){
        if($diff->$k){
            $v = $diff->$k . ' ' . $$v . ($diff->$k >1 ? 's' : '');
        }else{
            unset($string[$k]);
        }
    }

    if(!$full) $string = array_slice($string,0,1);
    return $string ? implode(',',$string) . 'ago' : 'just now';

}

//page id

if(isset($_GET['page_id'])){
    if(isset($_POST['name'],$_POST['rating'],$_POST['content'])){
        //insert new review
        $stmt = $pdo -> prepare('INSERT INTO reviews (page_id,name,content,rating,submit_date) VALUES (?,?,?,?NOW())');

        $stmt->execute([$_GET['page_id'], $_POST['name'], $_POST['content'],$post['rating']]);

        exit('Your review has been submitted!');
    }

    $limit = isset($_GET['current_pagination_page'], $_GET['review_per_pagination_page']) ? 'LIMIT:
        current_pagination_page,:reviews_per_pagination_page' : '';

    $sort_by = 'ORDER BY submit_date DEC';
    if(isset($_GET['sort_by'])){
        $sort_by = $_GET['sort_by'] == 'newest' ? 'ORDER BY submit_date DESC' : $store_by;
        $sort_by = $_GET['sort_by'] == 'oldest' ? 'ORDER BY submit_date ASC' : $store_by;
        $sort_by = $_GET['sort_by'] == 'rating_highest' ? 'ORDER BY rating DESC' : $store_by;
        $sort_by = $_GET['sort_by'] == 'rating_lowest' ? 'ORDER BY rating ASC' : $store_by;
    }  
    
    $stmt = $$pdo->prepare('SELECT * FROM reviews WHERE page_id = :page_id' $sort_by. ' ' . $limit);

}
