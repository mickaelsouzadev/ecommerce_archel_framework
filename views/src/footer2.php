    
    <footer class="footer text-faded text-center py-5">
      <div class="container">
        <p class="m-0 small">Certificado xxxx dados por xxxx para vendas de peças automotiva,categoria:xxxxx</p>
      </div>
    </footer>
    <!-- Bootstrap core JavaScript -->
    <script src="../<?php echo $this->vendor ?>jquery/jquery.min.js"></script>
    <script src="../<?php echo $this->vendor ?>bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
    	$(document).ready(function() {
    		$("#login-form").submit(function() {

    			var data = new FormData($('#login-form')[0]);

    			$.ajax({
	                type: 'POST',
	                url: 'login',
	                data: data,
	                processData: false,
	                contentType: false,
	                dataType: 'html',
	                success: function(response){
	                    if(response == 1) {
	                    	window.location.href="http://localhost/archel_framework";
	                    } else {
	                    	$('#error').css('display', 'block');
	                    	$('#errorMessage').html(response);
	                    }
	                }
           		});
    			return false;
    		});

    		$("#register-form").submit(function() {

    			var data = new FormData($('#register-form')[0]);

    			$.ajax({
	                type: 'POST',
	                url: 'novo-usuario',
	                data: data,
	                processData: false,
	                contentType: false,
	                dataType: 'html',
	                success: function(response){
	                    if(response == 1) {
	                    	window.location.href="http://localhost/archel_framework";
	                    } else {
	                    	$('#error').css('display', 'block');
	                    	$('#errorMessage').html(response);
	                    }
	                }
           		});
    			return false;
    		});

    		$('#compra-form').submit(function(){return false;})

    		$("#carrinho").click(function(){
    			
    			var data = {id_peca: $('#id_peca').val(), quantidade: $('#quantidade').val()};
    		
    			$.ajax({
	                type: 'POST',
	                url: '../adicionar-carrinho',
	                data: data,
	                success: function(response){
	                    console.log("Success");
                        console.log(response);
						$("#isAdded").html("Produto adicionado ao ");
						$("#carrinhoLink").css("display","block");
	                }
           		});
    			
    		});

			$("#comprar").click(function(){
			var data = {id_peca: $('#id_peca').val(), quantidade: $('#quantidade').val()};
    		
			$.ajax({
				type: 'POST',
				url: '../adicionar-carrinho',
				data: data,
				success: function(response){
					window.location.href = "../meu-carrinho";
				}
			   });

			});
    		
    	});
    </script>
  </body>

</html>
