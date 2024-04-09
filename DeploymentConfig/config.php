
<?php

//app info..........................................
define('APP_NAME','Seek Work');
define('APP_DESC','Freelancing platform for undergraduates');




define('SERVERNAME','db');
define('PORT','3306');

//database configs..........................................

if($_SERVER['SERVER_NAME']=='localhost'){
    //database config for local server
    //......NOTE........................
    //THESE CONFIGS ARE ACCORDING TO THE DOCKER COMPOSE
    //IF USING SOFT LIKE XAMPP , THESE SHOULD BE CHANGED
    //..................................

    define('DBNAME','SeekWorkDB');
    define('DBUSER','admin');
    define('DBPASS','password');
    define('DBDRIVER','mysql');

    //rootpath for local
    define('ROOT','https://seekwork.chathuralakshan.com/public');

}else{
    //database config for live server
    define('DBHOST','localhost');
    define('DBNAME','SeekWorkDB');
    define('DBUSER','admin');
    define('DBPASS','password');
    define('DBDRIVER','mysql');

    //rootpath for live server : http://www.myweb.com/
    define('ROOT','https://seekwork.chathuralakshan.com/public') ;
}


//for php mailer
define('MAILER_HOST','smtp.gmail.com');
define('MAILER_EMAIL','seekworklk@gmail.com');
define('MAILER_PASS','fiqslttijzawoyut');


//for payhere ( these are for my personal email address)
define('MERCHANT_ID',1224435);
define('MERCHANT_SECRET','MzY1NTkxMzIwMTQ4NDU3NzM5MTQwNTU0MjI0MTIxODQ2NjQ0NTU1');


////seekwork commision for each task
//define('COMMISSION',500);
//number of tasks per page
define('TASK_PER_PAGE',24);

