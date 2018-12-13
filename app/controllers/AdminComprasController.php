<?php  

namespace App\Controllers;

class AdminComprasController extends Controller
{
	function __construct() 
	{
	    parent::__construct();
	}
	
	public function index()
	{
	    $data['title'] = "Adminstração do Site";

	    $this->view->loadPage("compras", $data);
	}

}