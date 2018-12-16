<script type="text/javascript">
    $("#finalizarcompra").click(function(){
        var jsondata = {};
        var data = $(".data");
        
        $.each(data,function(index, node){
            jsondata[index+1] = {
                "id":           $(node).children('[name="id"]').val(),
                "nome":         $(node).children('[name="nome"]').val(),
                "valor":        $(node).children('[name="valor"]').val(),
                "quantidade":   $(node).children('[name="quantidade"]').val()
            }
        });

        $.ajax({
	        type: 'POST',
	        url: './pagseguro',
	        data: jsondata,
	        success: function(response){
	            console.log("Success");
                PagSeguroLightbox({
                    code: response,
                    success: function(transactionCode){
                        console.log("Done.");
                        window.location.href = "./compra-completada/"+transactionCode;
                    },
                    abort: function(){
                        console.log("Aborted");
                    }
                })
            },
            error: function(a,b,c){
                console.log("Error");
                console.log(a,b,c);
            }
        });
    });
</script>