<?php  
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

$uri = $_SERVER['REQUEST_URI'];

$method = $_SERVER['REQUEST_METHOD'];

if($_SERVER['HTTP_HOST'] == "localhost") {
	$uri = str_replace('/archel_framework', "", $uri);
}

$collector = new RouteCollector();

$collector->filter('auth', function(){

	if($_SERVER['HTTP_HOST'] == "localhost") {

		header('Location: ../login');

		return false;
	}

    header('Location: /login');

    return false;

    return true;
});

// $collector->get('login', function() {
// 	App\Controllers\TestController::login();
// });
$collector->get('/', function() {
    $controller = new App\Controllers\HomeController();
    $controller->index();
});

// $collector->group(['before' => 'auth'], function(RouteCollector $collector){
// 	$collector->get('admin', function(){
//         App\Controllers\HomeController::index();
//     });
// });

// $collector->group(array('prefix' => 'admin'), function(RouteCollector $collector){

//     $collector->group(['before' => 'auth'], function(RouteCollector $collector){
//         $collector->get('pages', function(){
//             return 'page management';
//         });
//         $collector->get('products', function(){
//             return 'product management';
//         });
//     });
 
//     $collector->get('orders', function(){
//         return 'Order management';
//     });

//     $collector->get('login', function() {
//         App\Controllers\TestController::login();
//     })
    
// });

$dispatcher =  new Dispatcher($collector->getData());