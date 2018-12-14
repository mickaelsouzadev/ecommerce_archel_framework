<?php  

require 'vendor\autoload.php';

require 'config\routes.php';

use App\Session;
use App\Cookie;

echo $dispatcher->dispatch($method, $uri); 

// var_dump(Session::getAllSessions());