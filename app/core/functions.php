<?php

//to show stuff (mostly for logging debug)
function show($stuff)
{
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}

//set value when submiting login, signin 
function set_value($key)
{
    if (!empty($_POST[$key])) {
        return $_POST[$key];
    }
    return '';
}

//redirecting
function redirect($link)
{
    header("Location: " . ROOT . "/" . $link);
    die;
}

//popup message
//message[] consists of message and the type of message
//$msg=['this is the message','success']
//$msg=['this is the message','danger']
function message($msg = ['', 'success'], $erase = false)
{

    if (!is_array($msg)) { //if the $msg is just a string, make it an array and give msg type as success
        $msg = [$msg, 'success'];
    }

    if (!empty($msg[0])) {
        $_SESSION['message'] = $msg;
    } else {
        if (!empty($_SESSION['message'])) {

            $msg = $_SESSION['message'];
            if ($erase) {
                unset($_SESSION['message']);
            }
            return $msg;
        }
    }

    return false;
}

//to replace special characters for security reasons
function esc($str)
{
    return nl2br(htmlspecialchars($str)); //nl2br replace new lines by brake tags
}


//for sorting array of objects by a given property
function sortArrayOfObjects($array, $property, $isAscending = 1)
{
    // Custom comparison function
    $compare = function ($a, $b) use ($property, $isAscending) {
        if ($a->{$property} == $b->{$property}) {
            return 0;
        }
        return ($isAscending ? ($a->{$property} < $b->{$property}) : ($a->{$property} > $b->{$property})) ? -1 : 1;
    };

    // Use usort to sort the array
    usort($array, $compare);

    return $array;
}

//to crop and resize images
function resizeImage($fileName, $maxSize = 700)
{ //reduce the image such that longest side is 700 px


    if (file_exists($fileName)) {
        //get file extension
        $ext = explode(".", $fileName);
        $ext = strtolower(end($ext));

        switch ($ext) {
            case 'png':
                $image = imagecreatefrompng($fileName);
                break;
            case 'jpeg':
                $image = imagecreatefromjpeg($fileName);
                break;
            case 'gif':
                $image = imagecreatefromgif($fileName);
                break;
            default:
                $image = imagecreatefromjpeg($fileName);
                break;
        }

        $src_width = imagesx($image);
        $src_height = imagesy($image);

        //finding longest side and preserve ratio
        if ($src_width > $src_height) {
            $dst_width = $maxSize;
            $dst_height = (int)(($src_height / $src_width) * $maxSize);
        } else {
            $dst_height = $maxSize;
            $dst_width =(int) (($src_width / $src_height) * $maxSize);
        }

        $dst_image = imagecreatetruecolor($dst_width, $dst_height); //making an empty image according to calculated ratio
        imagecopyresampled($dst_image, $image, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height); //copying to empty image from source

        //destroy images since it use memeory
        imagedestroy($image);


        switch ($ext) {
            case 'png':
                imagepng($dst_image, $fileName);
                break;
            case 'jpeg':
                imagejpeg($dst_image, $fileName, 90);
                break;
            case 'gif':
                imagegif($dst_image, $fileName);
                break;
            default:
                imagejpeg($dst_image, $fileName, 90);
                break;
        }

        //destroy dest_image after saving
        imagedestroy($dst_image);
    }
    

    return $fileName;
}
