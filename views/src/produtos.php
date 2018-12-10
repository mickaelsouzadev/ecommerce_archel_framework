
    <section class="page-section container">
          <h3 class="site-heading text-center text-white d-lg-block product-title"> <span class="site-heading-lower mb-2">Produtos </span></h3>
          <div class="row products">
              <div class="card-deck products-deck"> 
                  <!-- <?php var_dump($data['products']) ?> -->
                  <?php foreach($data['products'] as $prod): ?>
                      <!-- <?php var_dump($prod) ?> -->
                      <div class="card product-card" style="width: 18rem;">
                          <img class="card-img-top" src="<?php echo $this->vendor ?>img/<?php echo $prod['imagem']?>" alt="produto 1">
                          <div class="card-body">
                            <h5 class="card-title"><?php echo $prod['nome']?></h5>
                            <p class="card-text"><?php echo $prod['marca']?></p>
                          </div>
                      </div>
                    <?php endforeach; ?>
              
                 
  </div>

          </div>    
             
             
  
    
         

  
   
       

   
      
         

   
     
    </section>