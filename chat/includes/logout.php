<?php
if(isset($_SESSION['userID'])) {
    unset($_SESSION['userID']);
}

$info->logged_in=false;
echo json_encode($info);