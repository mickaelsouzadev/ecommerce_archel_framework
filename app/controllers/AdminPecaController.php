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

	    $data['peca'] = $this->model->select()->where("deletado", 0)->run("fetchAll");

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

		$this->form_manager->filterSingleFile("imagem", array("image/png", "image/jpeg", "image/gif"));
		
		$insert = $this->model->insert($form_data)->run("lastInsertId", $form_data);

        if($insert) {

			if($this->form_manager->saveUploadedFiles("views/vendor/img")) {
				$this->saveImage($this->form_manager->getFileName(0), $insert);
			}

        	echo true;
        }

		
	
       
	}

	public function update($id)
	{
		$fields = ['nome', 'valor_compra', 'valor_venda', 'marca', 'stock', 'dimensoes_pacote', 'categoria', 'compatibilidade'];

        $filters = ['nome'=>FILTER_SANITIZE_STRING, 'valor_compra'=>FILTER_SANITIZE_STRING, 'valor_venda'=>FILTER_SANITIZE_STRING, 'marca'=>FILTER_SANITIZE_STRING, 'stock'=>FILTER_SANITIZE_STRING, 'dimensoes_pacote'=>FILTER_SANITIZE_STRING, 'categoria'=>FILTER_SANITIZE_STRING, 'compatibilidade'=>FILTER_SANITIZE_STRING];

        $this->form_manager = new Form($fields,$filters);
        $form_data = $this->form_manager->getFilteredData();

		$update = $this->model->update($form_data, $id)->run("rowCount", $form_data);

      

		
	}
       

	public function delete($id)
	{
	   	// $fields = ['id'];
	   	// $filters = ['id'=>FILTER_SANITIZE_STRING];

	   	// $this->form_manager = new Form($fields,$filters);
     //    $form_data = $this->form_manager->getFilteredData();



        print $this->model->update(['deletado'=>1], $id)->run("rowCount", ['deletado'=>1]);
	  
	}

	public function getPecaJson()
 	{
 		$data = $this->model->select()->where("deletado", 0)->run("fetchAll");
 		print json_encode($data);
 	}

	private function saveImage($name_image, $last_id)
	{
		
	
		var_dump($last_id);
		$this->model->setTable('imagem_peca');

		$data = ['id_peca'=>$last_id, 'imagem'=>$name_image];

		var_dump($data);

		$this->model->insert($data)->run("rowCount", $data);
	}



}