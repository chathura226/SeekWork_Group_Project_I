go inside docker folder

docker compose up --build
//--build is necessary, only then images will b built before start conatiner and this is important since i have modified emages( eg:a2enmod rewrite)

ctrl+c
docker compose down



note:
keep all class names with only first letter capitalized
keep all method(function names) lower case
   //database config for local server(IN config.php)
    //......NOTE........................
    //THESE CONFIGS ARE ACCORDING TO THE DOCKER COMPOSE 
    //IF USING SOFT LIKE XAMPP , THESE SHOULD BE CHANGED
    //..................................