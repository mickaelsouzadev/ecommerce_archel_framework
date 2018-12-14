<?php

namespace App\Controllers;
use App\Session;
use App\Form;
use App\Password;
use App\Auth;

class AdminController extends Controller{
    
    function __construct() 
    {
        parent::__construct();
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

    public function logout() 
    {
        $this->auth->logout();

        header("Location: ../home");
    }

    public function doLogin()
    {
        $this->model->setTable("admin");

        $fields = ['email', 'senha'];

        $filters = ['email'=>FILTER_SANITIZE_STRING, 'senha'=>FILTER_SANITIZE_STRING];

        $this->form_manager = new Form($fields,$filters);
        $form_data = $this->form_manager->getFilteredData();

        $data = $this->model->select()->where('email', $form_data['email'])->run("fetch", $form_data);

        $user = ['username'=>$data['username'], 'email'=>$data['email'], 'password'=>$data['senha']];

     
        echo $this->auth->login($form_data['senha'], $user, "admin");

    }
    
    public function verifyRequester()
    {
        $sessionToken = Session::getSessionAttribute("admin", "token");
      
        $token = hash("sha384",$_SERVER['REMOTE_ADDR'],false);
        // var_dump($token);
        // var_dump($_SERVER['REMOTE_ADDR']);
        // // phpinfo();
        // var_dump($sessionToken);
       
        if($sessionToken && $sessionToken !== null){
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