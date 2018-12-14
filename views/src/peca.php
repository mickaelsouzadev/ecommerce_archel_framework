
	     <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="../dashbord/home">Administração do site</a>
            </li>
            <li class="breadcrumb-item active">Peça</li>
          </ol>
		  
		   <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
             
                <div class="panel-body">
                    
                        <table width="100%" class="table table-striped table-bordered table-hover" id="table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nome</th>
                                        <th>Valor de compra</th>
                                        <th>Valor de venda</th>
										<th>Marca</th>
										<th>Stock</th>
										<th>Fimensoes de pacote</th>
										<th>Categoria</th>
										<th>Editar</th>
                                        <th>Excluir</th>
										
										
                                    </tr>
                                </thead>
                                <?php foreach($data['peca'] as $peca): ?>
								<tr>
                                        <td><?php echo $peca['id'] ?></td>
                                        <td><?php echo $peca['nome'] ?></td>
                                        <td><?php echo $peca['valor_compra'] ?></td>
                                        <td><?php echo $peca['valor_venda'] ?></td>
										<td><?php echo $peca['marca'] ?></td>
										<td><?php echo $peca['stock'] ?></td>
										<td><?php echo $peca['dimensoes_pacote'] ?></td>
										<td><?php echo $peca['categoria'] ?></td>
										<td><a href="#"><button  value="<?php echo $peca['id'] ?>" class="btn btn-primary update-peca"><i class="fas fa-pencil-alt "></i></button></a>

                                        </td>
                                        <td>
                                            <a href="#"><button value="<?php echo $peca['id'] ?>"  class="btn btn-danger delete-peca"><i class="fas fa-trash-alt"></i></button></a>
                                        </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>

                    
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-delete-peca">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header modal-header-danger">
           
                    <h5 class="modal-title text-left">Excluir Peça</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
              </div>
              <div class="modal-body">
                <p>Excluir a peça: <strong><span id="peca-id"></span></span></strong>?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="delete">Excluir</button>
              </div>
            </div>
          </div>
        </div>

            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
  

        <div class="modal modal-success fade" id="success-delete">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header modal-header-success">
                 <h5 class="modal-title text-left">Successo</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
               
              </div>
              <div class="modal-body">
                <p>Notícia excluida com sucesso!</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Fechar</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <?php  foreach($data['peca'] as $peca):?>
    <div class="modal modal-warning fade" id="modal-update-peca<?php echo $peca['id'] ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header modal-header-primary">
                <h5 class="modal-title text-left">Editar peça</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
              </div>
              <div class="modal-body">
               <form role="form" method="post" id="update-peca-form<?php echo $peca['id'] ?>" enctype="multipart/form-data">

                <!-- text input -->
               <!--  <input type="hidden" name="id" value="<?php echo $peca['id'] ?>"> -->
                 <div class="form-group">
                                        <label>Nome</label>
                                            <input class="form-control" value="<?php echo $peca['nome'] ?>" type="text" name="nome">
                                       
                                     
                           
                        </div>
<div class="form-group">
                                        <label>Valor de compra</label>
                                            <input class="form-control" value="<?php echo $peca['valor_compra'] ?>" type="number" step="0.01" name="valor_compra">
                                            
                                     
                           
                            </div>

                                        <div class="form-group">
                                        <label>Valor de venda</label>
                                            <input class="form-control" value="<?php echo $peca['valor_venda'] ?>" type="number" step="0.01" name="valor_venda">
                                            
                                     
                          
                            </div>
<div class="form-group">
                                        <label>Marca</label>
                                            <input class="form-control" value="<?php echo $peca['marca'] ?>" type="text" name="marca">
                                            
                                     
                        
                            </div>
                            
<div class="form-group">
                                        <label>Stock</label>
                                            <input class="form-control" value="<?php echo $peca['stock'] ?>" type="number" name="stock">
                                            
                                     
                          
                            </div>
                         
<div class="form-group">
                                        <label>Dimensoes de pacote</label>
                                            <input class="form-control" value="<?php echo $peca['dimensoes_pacote'] ?>" type="text" name="dimensoes_pacote">
                                            
                                     
                           
                            </div>
<div class="form-group">
                                        <label>Categoria</label>
                                            <input class="form-control" value="<?php echo $peca['categoria'] ?>" type="text" name="categoria">
                                            
                                     
                         
                            </div>
 <div class="form-group">
                                        <label>Compatibilidade</label>
                                            <input class="form-control" value="<?php echo $peca['compatibilidade'] ?>" type="text" name="compatibilidade"></div>
            
              </form>
              </div>
              <div class="modal-footer">
                
                <button type="submit" id="save<?php echo $peca['id'] ?>" class="btn btn-primary">Salvar</button>

              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <?php  endforeach; ?>