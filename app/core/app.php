<?php


class App
{
    protected $controller = '_404'; //default controller if not assigned 
    protected $method = 'index'; //default method for controller - if not defined (all controller classes should have index method)

    public static $pageName = '_404'; //to put in header to get as title for the page

    function __construct()
    {

        $urlarr = $this->getUrl();
        $filename = "../app/controllers/" . ucfirst($urlarr[0]) . ".php"; //path to the controller and capitalize first letter
        if (file_exists($filename)) {
            require $filename;
            $this->controller = ucfirst($urlarr[0]);

            //setting title of the page
            self::$pageName = ucfirst($urlarr[0]);

            unset($urlarr[0]);
        } else {
            require "../app/controllers/" . $this->controller . ".php"; //typically 404

        }

        try {
            $mycontroller = new $this->controller(); // instanciating the corresponding controller according to its value
            $mymethod = $urlarr[1] ?? $this->method; // if method is not defined after controller in url, use default

            if (!empty($urlarr[1])) {
                if (method_exists($mycontroller, strtolower($mymethod))) { //note: keep all method names lower case
                    $this->method = strtolower($mymethod);
                    unset($urlarr[1]);
                }
            }
            // show($urlarr);
            // die;
            $urlarr = array_values($urlarr); //cleaning up, createing new array with indexes from 0
            // show($urlarr);
            call_user_func_array([$mycontroller, $this->method], $urlarr);

        } catch (Error $e) {//if controller instantiation failed

            redirect('home');
        }
    }


    private function getUrl()
    {
        $url = $_GET['url'] ?? 'home'; //if no url , then assign home
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $arr = explode("/", $url);
        return $arr;
    }
}
