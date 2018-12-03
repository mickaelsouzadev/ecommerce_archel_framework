<?php  
/* PHP Class for managing views and models
 * AUTHOR: Mickael Souza, modified by Antony Acosta for working with current version of MVC
 * LAST EDIT: 2018-12-02
 */
namespace App\Controllers;
use App\View;
use App\Models\Model;

class Controller
{	 
    
    protected $model;
    protected $view;
    protected $form_manager;
   
    public function __construct($inipath = __DIR__."/config.ini")
    {   
        $config = ["View"=>null, "Model"=>null];
        if(file_exists($inipath)){
            $ini = parse_ini_file($inipath, 1);
            $config["View"] = (isset($ini["View"])) ? $ini["View"] : $config["View"];
            $config["Model"] = (isset($ini["Model"])) ? $ini["Model"] : $config["Model"];
        }

        $this->view = new View($config["View"]);
        $this->model = new Model();
    }
    
}