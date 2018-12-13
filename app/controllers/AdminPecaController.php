<?php  

namespace App\Controllers;
use App\Form;

class AdminPecaController extends Controller
{
	function __construct() 
	{
	    parent::__construct();
	    $this->model->setTable("peca");
	}
	
	public function index()
	{
	    $data['title'] = "Adminstração do Site";

	    $data['peca'] = $this->model->select()->run("fetchAll");

	    $this->view->loadPage("peca", $data);
	}

	public function add()
	{
	    $data['title'] = "Adminstração do Site";


	    $this->view->loadPage("add-peca", $data);
	}

	public function insert()
	{
		$fields = ['nome', 'valor_compra', 'valor_venda', 'marca', 'stock', 'dimensoes_pacote', 'categoria', 'compatibilidade'];

        $filters = ['nome'=>FILTER_SANITIZE_STRING, 'valor_compra'=>FILTER_SANITIZE_STRING, 'valor_venda'=>FILTER_SANITIZE_STRING, 'marca'=>FILTER_SANITIZE_STRING, 'stock'=>FILTER_SANITIZE_STRING, 'dimensoes_pacote'=>FILTER_SANITIZE_STRING, 'categoria'=>FILTER_SANITIZE_STRING, 'compatibilidade'=>FILTER_SANITIZE_STRING];

        $this->form_manager = new Form($fields,$filters);
        $form_data = $this->form_manager->getFilteredData();

        

        if($this->model->insert($form_data)->run("rowCount", $form_data)) {
        	echo true;
        }

       
	}

}