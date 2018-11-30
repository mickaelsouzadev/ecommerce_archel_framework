<?php  

namespace App\Controllers;

class RegisterController extends Controller{
    
    public function __construct()
    {
        parent::__construct();
        // $this->model->setTable("Review");
        // $this->model->addTable("Comic");
    }
    
    public function index()
    {
		$data['title'] = "Registre-se";
        $this->view->loadPage("register",$data);
    }
    
}