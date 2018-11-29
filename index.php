<?php  

require 'vendor/autoload.php';

require 'config/routes.php';

use App\Session;
use App\Cookie;

echo $dispatcher->dispatch($method, $uri); 

// //Test

// Session::setSession('user', 'fulaninho');
// Session::setSession('user2', 'fulaninho2');
// Session::setSession('user3', 'fulaninho3');
// Session::setSession('user4', 'fulaninho4');

// echo "<pre>";
// var_dump(Session::getSessions(['user2', 'user', 'user3']));
// var_dump(Session::getAllSessions());
// Cookie::setCookie('user', 'fulaninho');
// var_dump(Cookie::getCookie('user'));
// var_dump(Cookie::getAllCookies());
// echo "</pre>";