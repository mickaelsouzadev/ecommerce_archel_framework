<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $data['title'] ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $this->vendor ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="<?php echo $this->vendor ?>css/business-casual.css" rel="stylesheet">

  </head>

  <body>

   <h1 class="site-heading text-center text-white d-none d-lg-block">
      <span class="site-heading-upper text-primary mb-3">Arthur&Michel </span>
      <span class="site-heading-lower">Auto Peças </span>
    </h1>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
      <div class="container">
        <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="#">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav mx-auto">
        </li>
            <li class="nav-item active px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="home">Home
                <span class="sr-only">(current)</span>
               
              </a>
            
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="produtos">Produtos</a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="registrar">Registre-se</a>
            </li>
            <li class="nav-item px-lg-4">
              <?php if(App\Auth::verifyUserIsLogged()): ?>
                <a class="nav-link text-uppercase text-expanded" href="sair">Sair</a>
              <?php else: ?>
                <a class="nav-link text-uppercase text-expanded" href="entrar">Entrar</a>
              <?php endif; ?>
            </li>
            <li class="nav-item px-lg-2">
              <form>
                <div class="form-group">
                   <input type="text" class="form-control search-input" placeholder="Pesquisar" name="pesquisar" required>
                </div>
              </form>
            
            </li>
            <li class="nav-item px-lg-2">
            <a class="nav-link"><i class="fa fa-2x fa-shopping-cart"></i></a>
            
            </li>
          </ul>
        </div>
      </div>
    </nav>
