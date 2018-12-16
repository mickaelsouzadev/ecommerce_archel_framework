<section class="page-section about-heading default-forms-section sections-w">
      <div class="container">
        <img class="img-fluid about-heading-img mb-3 mb-lg-0" src="img/about.jpg" alt="">
        <div class="about-heading-content">
          <div class="row">
            <div class="col-xl-9 col-lg-10 mx-auto">
              <div class="bg-faded p-5">
              	<?php if($data['vazio'] == true): ?>
                <h2 class="section-heading mb-4">
              
                  <span class="section-heading-lower">Seu carrinho está vazio </span>
                  

                  
                </h2>
                <?php else: ?>
				 <h2 class="section-heading mb-4">
              
                  <span class="section-heading-lower">Carrinho </span>
                  
                  
                </h2>
            <div class="form-row">
							<?php foreach ($data['carrinho'] as $prod): ?>
							<div class="data">
								<input type="hidden" name="id"					value="<?php echo $prod['product']['id']; ?>">
								<input type="hidden" name="nome"				value="<?php echo $prod['product']['nome']; ?>">
								<input type="hidden" name="valor"				value="<?php echo $prod['product']['valor_venda']; ?>">
								<input type="hidden" name="quantidade"	value="<?php echo $prod['qtd']; ?>">
							</div>
							<div class="col-lg-3">
								<img src="<?php echo $this->vendor ?>img/<?php echo $prod['product']['imagem'] ?>" width="120" height="80">
							</div>
							<div class="col-lg-7">
								<h4><?php echo $prod['product']['nome'] ?></h4>
								<h5>R$ <?php echo $prod['product']['valor_venda'] ?></h5>
								<h5><?php echo $prod['qtd'] ?> Unidades</h5>
							</div>
							<div class="col-lg-2">
								<button class="btn btn-danger delete-carrinho" id="<?php echo $prod['product']['id'] ?>">Deletar <i class="fa fa-trash"></i></button>
							</div>
							
							<?php endforeach; ?>
						</div><br>
						<div class="row">
							<div class="col-lg-9">
						
							</div>
							<?php $total = 0; foreach($data['carrinho'] as $prod): $total += (float)$prod['total']; endforeach;?>

							<div class="col-lg-3">
								<h5>Total: R$ <?php echo $total ?></h5>
							</div>

						</div>
						<div class="form-group">
							<?php if(App\Auth::verifyUserIsLogged()): ?>
									<button class='btn btn-lg btn-success register-input disabled' id="finalizarcompra" name="criar" >Comprar Tudo</button>
								<?php else: ?>
									<label>Faça <a href="entrar">login</a> para poder comprar:</label>
									<br>
									<br>
								<?php endif; ?>
						</div>
						
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>