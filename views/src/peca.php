
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
										<th>Ação</th>
										
										
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
										<td><i class="fas fa-edit"></i>   <i class="fas fa-trash-alt"></i>

                                        </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>

                    
                </div>
            </div>
        </div>
    </div>