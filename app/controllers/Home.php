<?php

//home class
class Home extends Controller{

    public function index(){
        //for search
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            //if search type is skill
            if ($_POST['searchType'] == 'skill') {
                redirect('tasks/search/skill/' . $_POST['searchField']);
            } elseif ($_POST['searchType'] == 'title') {
                redirect('tasks/search/title/' . $_POST['searchField']);
            }elseif ($_POST['searchType'] == 'category') {
                redirect('tasks/search/category/' . $_POST['searchField']);
            }
        }
        
        $data['title'] = "Home";
        
        $this->view('home',$data);
    }
    
    public function edit(){
        echo "Home page editing";
    }

    public function delete(){
        echo "Home page deleting";
    }
}