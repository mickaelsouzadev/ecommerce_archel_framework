<body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header text-center">Login</div>
        <div class="card-body">
          <form id="login-form" method="post">
            <div class="form-group">
              <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" placeholder="Email" required="required" autofocus="autofocus" name="email">
                <label for="inputEmail">Email: </label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" placeholder="Senha" required="required" name="senha">
                <label for="inputPassword">Senha: </label>
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="continua">
                  Permanecer conectado?
                </label>
              </div>
            </div>
            <input type="submit" class="btn btn-primary btn-block" value="Login">
          </form>
          <div class="text-center">
            <a class="d-block small" href="#">Esqueceu sua senha?</a>
          </div>
        </div>
      </div>
    </div>