<?php  

namespace App\Controllers;
use App\Form;
use App\Session;
use App\Cookie;

class CarrinhoController extends Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->model->setTable("peca");
        $this->model->addTable("imagem_peca");
    }
    
    public function index()
    {
    	$data['vazio'] = false;
    	$data['title'] = "Meu Carrinho";
    	$data['carrinho'] = Session::getSession('carrinho');
        
        $cookie_cart = Cookie::getCookie('carrinho');
    	
    	if($data['carrinho'] == null && $cookie_cart == null) {
    		$data['vazio'] = true;
    	} else {
    		foreach ($data["carrinho"] as $key => $carrinho) {
	    		if($carrinho == "") {
	    			unset($data['carrinho'][$key]);
	    			$data['vazio'] = true;
	    		} else {
	    			$data['vazio'] = false;
	    		}

    		}
    	}
    	
        
    	$this->view->loadPage("carrinho",$data);
    }

    public function addToCart()
    {
    	$fields = ['id_peca', 'quantidade'];

        $filters = ['id_peca'=>FILTER_SANITIZE_STRING, 'quantidade'=>FILTER_SANITIZE_STRING];

        $this->form_manager = new Form($fields,$filters);
        $form_data = $this->form_manager->getFilteredData();

    	$data['products'] = $this->model->join(["peca"=>
                                                    ["id", 
                                                    "nome", 
                                                    "valor_venda", 
                                                    "marca", 
                                                    "stock", 
                                                    "compatibilidade", 
                                                    "dimensoes_pacote", 
                                                    "categoria"],
                                                "imagem_peca"=>
                                                    [ 
                                                    "id_peca", 
                                                    "imagem"]])->where('id', $form_data['id_peca'])->run("fetch");
    	$cart = ['product' => $data['products'], 'qtd'=> $form_data['quantidade']];

        
        
        Session::setSessionAttribute("carrinho", $data['products']['id'], $cart);	
        Cookie::setCookie("carrinho", $json_cart);

    	


    	// $this->view->loadPage("ver_produto",$data);
    }

    public function deleteFromCart()
    {
    	$fields = ['id_carrinho'];

        $filters = ['id_carrinho'=>FILTER_SANITIZE_STRING];

        $this->form_manager = new Form($fields,$filters);
        $form_data = $this->form_manager->getFilteredData();

        Session::setSessionAttribute('carrinho', $form_data['id_carrinho'], "");

        $json_cart = json_encode(Session::getSession("carrinho"));
        Cookie::setCookie("carrinho", $json_cart);
        
    }
    
}