<?php  

namespace App\Controllers;

class LoginController extends Controller{
    
    public function __construct()
    {
        parent::__construct();
        // $this->model->setTable("Review");
        // $this->model->addTable("Comic");
    }
    
    public function index()
    {
		$data = "SITE DO CAPETA";
        $this->view->loadPage("login",$data);
    }
    
}