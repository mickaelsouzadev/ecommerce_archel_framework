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
    	$data['vazio'] = true;
    	$data['title'] = "Meu Carrinho";
    	$data['carrinho'] = Session::getSession('carrinho');

    	if(!Session::sessionExists('carrinho')) {
    		$data['carrinho'] = json_decode(Cookie::getCookie('carrinho'), true);
        }

    	$count_array = count($data['carrinho']);
    	$count = 0;
    
    	foreach ($data["carrinho"] as $key => $carrinho) {

	    	if($carrinho == "") {
	    		unset($data['carrinho'][$key]);
	    		$count++;
	    	} 
	    	
    	}

    	if($count < $count_array) {
	    	$data['vazio'] = false;
	    }
       
    	$this->view->loadPage("carrinho",$data);
    }

    public function addToCart()
    {
    	$fields = ['id_peca', 'quantidade'];

        $filters = ['id_peca'=>FILTER_SANITIZE_STRING, 'quantidade'=>FILTER_SANITIZE_STRING];

        $this->form_manager = new Form($fields,$filters);
        $form_data = $this->form_manager->getFilteredData();

    	$data['products'] = array_unique($this->model->join(
                                                ["peca"=>
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
                                                    "imagem"]])->where('id', $form_data['id_peca'])->run("fetch"));
        $data["products"]["valor_venda"] = ((float)$data["products"]["valor_venda"] == $data["products"]["valor_venda"]) ? $data["products"]["valor_venda"].".00" : $data["products"]["valor_venda"];
    	$cart = ['product' => $data["products"], 'qtd'=> $form_data['quantidade'], 'total'=> $form_data['quantidade'] * $data['products']['valor_venda']];

        
        
        Session::setSessionAttribute("carrinho", $data['products']['id'], $cart);	

        $json_cart = json_encode(Session::getSession("carrinho"));

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

    public function pagseguro()
    {
        $config = parse_ini_file(__DIR__."/config.ini");
        $token = $config["token"];
        $receiverEmail = $config["email"];

        $data = $_POST;
        $encodedrows = [];
        foreach($data as $key=>$element){
            $encodedrows[] = http_build_query(array(
                "itemId{$key}"=>$element["id"],
                "itemDescription{$key}"=>$element["nome"],
                "itemAmount{$key}"=>$element["valor"],
                "itemQuantity{$key}"=>$element["quantidade"]
            ));
        };
        $httpquery = implode("&",$encodedrows)."&receiverEmail={$receiverEmail}&currency=BRL";
    
        $c = curl_init("https://ws.sandbox.pagseguro.uol.com.br/v2/checkout?email={$receiverEmail}&token={$token}");
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded', 
                                                 'charset=ISO-8859-1'));
        curl_setopt($c, CURLOPT_POSTFIELDS, $httpquery);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($c);
        curl_close($c);

        preg_match("/<code>(.*)<\/code>/",$output,$code);
        
        print_r($code[1]);
        return 1;
    }

    public function purchased($code)
    {
        $data = ["title"=> "Sua compra está sendo processada",
            "code"=>$code]; 
        $this->view->loadPage("compra-completada",$data);
    }
    
}