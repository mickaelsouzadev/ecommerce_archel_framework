<?php  

namespace App\Controllers;
use App\Form;
use App\Auth;

class ProdutoController extends Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->model->setTable("peca");
        $this->model->addTable("imagem_peca");
    }
    
    public function index()
    {
        $data['title'] = "Produtos";
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
                                                    ["id", 
                                                    "id_peca", 
                                                    "imagem"]])->run("fetchAll");

        $this->view->loadPage("produtos",$data);
    }
    
}