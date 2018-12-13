 <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Adicionar</a>
            </li>
            <li class="breadcrumb-item active">Peça</li>
          </ol>
          
           <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                </div>
                    <form method="post" id="add-peca">
                        <div class="panel-body">
                        <div class="col-lg-6">
                                         <div class="form-group">
                                        <label>Nome</label>
                                            <input class="form-control" type="text" name="nome">
                                       
                                     
                           
                        </div>
                        
                          
                                        <div class="form-group">
                                        <label>Valor de compra</label>
                                            <input class="form-control" type="number" step="0.01" name="valor_compra">
                                            
                                     
                           
                            </div>
                         
                                        <div class="form-group">
                                        <label>Valor de venda</label>
                                            <input class="form-control" type="number" step="0.01" name="valor_venda">
                                            
                                     
                          
                            </div>
                            
                                        <div class="form-group">
                                        <label>Marca</label>
                                            <input class="form-control" type="text" name="marca">
                                            
                                     
                        
                            </div>
                            
                                        <div class="form-group">
                                        <label>Stock</label>
                                            <input class="form-control" type="number" name="stock">
                                            
                                     
                          
                            </div>
                         
                                        <div class="form-group">
                                        <label>Dimensoes de pacote</label>
                                            <input class="form-control" type="text" name="dimensoes_pacote">
                                            
                                     
                           
                            </div>
                           
                                        <div class="form-group">
                                        <label>Categoria</label>
                                            <input class="form-control" type="text" name="categoria">
                                            
                                     
                         
                            </div>

                            <div class="form-group">
                                        <label>Compatibilidade</label>
                                            <input class="form-control" type="text" name="compatibilidade">
                                            
                                     
                         
                            </div>
                           
                           
                            <div class="form-group">
                                 <input type="submit" value="Adicionar" class="btn btn-success">
                                 <br><br>
                            <div id="error" class="alert alert-danger" style="display: none;">
                                <p id="#errorMessage"></p>
                            </div>
                            <div id="success" class="alert alert-success" style="display: none;">
                                <p>Adicionada com sucesso</p>
                            </div>
                            </div>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>