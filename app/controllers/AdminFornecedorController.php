<?php  

namespace App\Controllers;
use App\Form;

class AdminFornecedorController extends Controller
{
	function __construct() 
	{
	    parent::__construct();
	    $this->model->setTable("fornecedor");
	}
	
	public function index()
	{
	    $data['title'] = "Adminstração do Site";

	    $this->view->loadPage("fornecedor", $data);
	}

	public function add()
	{
	    $data['title'] = "Adminstração do Site";


	    $this->view->loadPage("add-fornecedor", $data);
	}

	public function insert()
	{
		$fields = ['razao_social', 'cnpj', 'telefone', 'email', 'pagina_web'];

		$filters = ['razao_social'=>FILTER_SANITIZE_STRING, 'cnpj'=>FILTER_SANITIZE_STRING, 'telefone'=>FILTER_SANITIZE_STRING, 'email'=>FILTER_SANITIZE_STRING, 'pagina_web'=>FILTER_SANITIZE_STRING];
       
        $this->form_manager = new Form($fields,$filters);
        $form_data = $this->form_manager->getFilteredData();

        if($this->model->insert($form_data)->run("rowCount", $form_data)) {
        	echo true;
        }

       
	}

}