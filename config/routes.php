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

// $collector->filter('auth', function(){
//     if(!App\Auth::verifyAdminIsLogged()) {

//         header('Location: dashbord/login');

//         return false;
//     }
  

//     return "EAEEEEEE";

// });

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

$collector->get('/dashbord/login', function(){
    $controller = new App\Controllers\AdminController();
    $controller->login();
});


// $collector->group(['before' => 'auth'], function(RouteCollector $collector){

// });

$collector->get('dashbord/home', function(){
        $controller = new App\Controllers\AdminController();
        $controller->index();
    });

$collector->group(array('prefix' => 'dashbord'), function(RouteCollector $collector){

    $collector->group(['before' => 'auth'], function(RouteCollector $collector){
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
 
    $collector->get('orders', function(){
        return 'Order management';
    });

   
    
});

$dispatcher =  new Dispatcher($collector->getData());