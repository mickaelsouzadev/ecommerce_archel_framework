<?php  
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

$uri = $_SERVER['REQUEST_URI'];

$method = $_SERVER['REQUEST_METHOD'];
// var_dump($uri);
if($_SERVER['HTTP_HOST'] == "localhost") {
    $uri = str_replace('/archel_framework', "", $uri);
}
// var_dump($uri);
$collector = new RouteCollector();

$collector->filter('auth', function(){

	if($_SERVER['HTTP_HOST'] == "localhost") {

		header('Location: ../login');

		return false;
	}

    header('Location: login');

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

$collector->get('/home', function() {
    $controller = new App\Controllers\HomeController();
    $controller->index();
});

$collector->get('/produtos', function() {
    $controller = new App\Controllers\ProdutoController();
    $controller->index();
});

$collector->get('/produtos/{id}', function($id) {
    $controller = new App\Controllers\ProdutoController();
    $controller->showProduct($id);
});


$collector->get('/entrar', function() {
    $controller = new App\Controllers\LoginController();
    $controller->index();
});

$collector->get('/registrar', function(){
    $controller = new App\Controllers\RegisterController();
    $controller->index();
});

$collector->post('/novo-usuario', function(){
    $controller = new App\Controllers\RegisterController();
    $controller->registrar();
});

$collector->post('/login', function(){
    $controller = new App\Controllers\LoginController();
    $controller->login();
});

$collector->post('/adicionar-carrinho', function(){
    $controller = new App\Controllers\CarrinhoController();
    $controller->addToCart();
});

$collector->post('/deletar-carrinho', function(){
    $controller = new App\Controllers\CarrinhoController();
    $controller->deleteFromCart();
});


$collector->get('/meu-carrinho', function(){
    $controller = new App\Controllers\CarrinhoController();
    $controller->index();
});

$collector->get('/sair', function(){
    $controller = new App\Controllers\LoginController();
    $controller->logout();
});



$collector->group(['before' => 'auth'], function(RouteCollector $collector){
$collector->get('admin', function(){
        App\Controllers\HomeController::index();
    });
});

$collector->group(array('prefix' => 'admin'), function(RouteCollector $collector){

    $collector->group(['before' => 'auth'], function(RouteCollector $collector){
        $collector->get('pages', function(){
             return 'page management';
        });
        $collector->get('products', function(){
            return 'product management';
        });
    });
 
    $collector->get('orders', function(){
        return 'Order management';
    });

   
    
});

$dispatcher =  new Dispatcher($collector->getData());