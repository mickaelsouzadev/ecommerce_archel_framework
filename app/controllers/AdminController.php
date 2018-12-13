<?php

namespace App\Controllers;
use App\Session;

class AdminController extends Controller{
    
    function __construct() 
    {
        parent::__construct();
        Session::setSession("admin",[]);
        if(!$this->verifyRequester()){
            header("Location: ../home");
        }
    }
    
    public function index()
    {
        $data['title'] = "Adminstração do Site";

        $this->view->loadPage("admin", $data);
    }

    public function login()
    {

        $data['title'] = "Login";

        $this->view->loadPage("admin-login", $data);
    }
    
    public function verifyRequester()
    {
        $sessionToken = Session::getSessionAttribute("admin", "token");
        // var_dump($sessionToken);
        $token = hash("sha384",$_SERVER['REMOTE_ADDR'],false);
        // var_dump($token);
        // var_dump($_SERVER['REMOTE_ADDR']);
        // // phpinfo();
        // die;
        if(!is_null($sessionToken)){
            if($sessionToken !== $token){
                //ABORTA TUDO KRAI
                Session::destroySessions();
                return false;
            }else{
                return true;
            }
        }else{
          
            $this->model->setTable("admin_valid_ips");
            $token_exists = $this->model->select()
                            ->where("ip_hash",$token)
                            ->run("rowCount");
            if($token_exists > 0){
                Session::setSessionAttribute("admin", "token", $token);
                return true;
            }
        }
    }
    
    
}