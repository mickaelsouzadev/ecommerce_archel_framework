<section class="page-section about-heading default-forms-section">
      <div class="container">
        <img class="img-fluid about-heading-img mb-3 mb-lg-0" src="img/about.jpg" alt="">
        <div class="about-heading-content">
          <div class="row">
            <div class="col-xl-9 col-lg-10 mx-auto">
              <div class="bg-faded p-5">
                <div class="row">
				<h2 class="section-heading mb-4">
              
                  <span class="section-heading-lower"><?php echo $data['products']['nome']; ?></span>
                  
                  
                </h2>
				</div>
				<div class="row">
					<div class="col-lg-8">
						<img src="..\<?php echo $this->vendor ?>img/<?php echo $data['products']['imagem'] ?>" width="600" height="400">
					</div>
					<div class="col-lg-4">
						<h1 class="font-weight-bold">R$ <?php echo $data['products']['valor_venda']; ?></h1>
					<br>
						<div class="form-group">
							<form method="post" id="compra-form">
							<div class="form-group col-lg-5">
								<label>Unidade(s): </label>
									<input type="number" max="1000" min="1" class="form-control register-input" value="1" name="quantidade" id="quantidade" required>
									<input type="hidden" id="id_peca" value="<?php echo $data['products']['id']?>">
							</div>
							<div class="form-group col-lg-12">
								<label>Em estoque: <?php echo $data['products']['stock']; ?></label>
							</div>
							<br>
							<div class="form-group">
								 <?php if(App\Auth::verifyUserIsLogged()): ?>
								<input type="submit" class='btn btn-lg btn-success register-input' name="comprar" value='Comprar'><br>
								<?php else: ?>
								<label>Faça <a href="../entrar">login</a> para poder comprar:</label>
								<input type="submit" class='btn btn-lg btn-success register-input disabled' name="comprar" value='Comprar'><br>	
								<?php endif; ?>
							</div>
							
							</form>
							<div class="form-group">
								<button class='btn btn-lg btn-success register-input' id="carrinho" name="carrinho">
								Adicionar ao carrinho
								</button><br>
							</div>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-12">
						<h2>
							<span class="section-heading-lower">Descrição do produto</span>
						</h2>
						<h5>Marca: <?php echo $data['products']['marca'] ?></h5>
						<h5>Compatibilidade: <?php echo $data['products']['compatibilidade'] ?></h5>
						<h5>Dimensões do pacote: <?php echo $data['products']['dimensoes_pacote'] ?></h5>
					</div>
				</div>    
             
                 
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>