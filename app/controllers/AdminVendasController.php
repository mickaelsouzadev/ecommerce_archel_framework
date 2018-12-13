<?php  

namespace App\Controllers;

class AdminVendasController extends Controller
{
	function __construct() 
	{
	    parent::__construct();
	}
	
	public function index()
	{
	    $data['title'] = "Adminstração do Site";

	    $this->view->loadPage("vendas", $data);
	}

}