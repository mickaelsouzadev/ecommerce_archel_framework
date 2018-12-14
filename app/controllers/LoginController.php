<?php  

namespace App\Controllers;
use App\Form;
use App\Auth;
use App\Session;

class LoginController extends Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->model->setTable("cliente");
        // $this->model->addTable("Comic");
    }
    
    public function index()
    {
		$data['title'] = "Entrar";
        $this->view->loadPage("login",$data);
    }
    
    public function login()
    {
        $fields = ['email', 'senha'];

        $filters = ['email'=>FILTER_SANITIZE_STRING, 'senha'=>FILTER_SANITIZE_STRING];

        $this->form_manager = new Form($fields,$filters);
        $form_data = $this->form_manager->getFilteredData();

        $data = $this->model->select()->where('email', $form_data['email'])->run("fetch", $form_data);

        $user = ['username'=>$data['nome'], 'email'=>$data['email'], 'password'=>$data['senha']];

      

        echo $this->auth->login($form_data['senha'], $user);

  
    }

    public function logout()
    {
        $this->auth->logout();

        header('Location: home');
    }
}