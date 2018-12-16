<?php

use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;
use App\Auth;

$uri = $_SERVER['REQUEST_URI'];

$method = $_SERVER['REQUEST_METHOD'];

if($_SERVER['HTTP_HOST'] == "localhost") {
    $uri = str_replace('/archel_framework', "", $uri);
}

$collector = new RouteCollector();

App\Session::start();

$collector->filter('auth', function(){
    if(!Auth::verifyAdminIsLogged()) {
        
        header('Location: ../dashbord/login');

        return false;
    }
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

$collector->post('dashbord/do-login', function(){
    $controller = new App\Controllers\AdminController();
    $controller->doLogin();
});

$collector->post('/adicionar-carrinho', function(){
    $controller = new App\Controllers\CarrinhoController();
    $controller->addToCart();
});

$collector->post('/deletar-carrinho', function(){
    $controller = new App\Controllers\CarrinhoController();
    $controller->deleteFromCart();
});

$collector->post('/pagseguro', function(){
    $controller = new App\Controllers\CarrinhoController();
    $controller->pagseguro();
});

$collector->get('/meu-carrinho', function(){
    $controller = new App\Controllers\CarrinhoController();
    $controller->index();
});

$collector->get('/compra-completada/{code}', function(){
    $controller = new App\Controllers\CarrinhoController();
    $controller->purchased($code);
});

$collector->get('/sair', function(){
    $controller = new App\Controllers\LoginController();
    $controller->logout();
});

$collector->get('/dashbord/login', function(){
    $controller = new App\Controllers\AdminController();
    $controller->login();
});

$collector->get('/dashbord/logout', function(){
    $controller = new App\Controllers\AdminController();
    $controller->logout();
});

$collector->post('/peca/delete/', function(){
    $controller = new App\Controllers\AdminPecaController();
    $controller->delete();
});

$collector->post('/peca/update/{id}', function($id){
    $controller = new App\Controllers\AdminPecaController();
    $controller->update($id);
});
// $collector->group(['before' => 'auth'], function(RouteCollector $collector){

// });



$collector->group(array('prefix' => 'dashbord'), function(RouteCollector $collector){

    $collector->group(['before' => 'auth'], function(RouteCollector $collector){
        $collector->get('/', function() {
            $controller = new App\Controllers\AdminController();
            $controller->index();
        });
        $collector->get('home', function(){
            $controller = new App\Controllers\AdminController();
            $controller->index();
        });
        $collector->get('vendas', function(){
            $controller = new App\Controllers\AdminVendasController();
            $controller->index();
        });
        $collector->get('compras', function(){
            $controller = new App\Controllers\AdminComprasController();
            $controller->index();
        });
        $collector->get('fornecedor', function(){
            $controller = new App\Controllers\AdminFornecedorController();
            $controller->index();
        });
         $collector->get('peca', function(){
            $controller = new App\Controllers\AdminPecaController();
            $controller->index();
        });
        $collector->get('peca/adicionar', function(){
            $controller = new App\Controllers\AdminPecaController();
            $controller->add();
        });
        $collector->get('fornecedor/adicionar', function(){
            $controller = new App\Controllers\AdminFornecedorController();
            $controller->add();
        });
        $collector->post('nova-peca', function() {
            $controller = new App\Controllers\AdminPecaController();
            $controller->insert();
        });
        $collector->post('novo-fornecedor', function(){
            $controller = new App\Controllers\AdminFornecedorController();
            $controller->insert();
        });
    });
   
    
});

$dispatcher =  new Dispatcher($collector->getData());