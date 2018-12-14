<script type="text/javascript">
    $("#finalizarcompra").click(function(){
        var jsondata = {};
        data = $(".data");
        //$(data[0]).children('[name="itemId"]').val()
        for(var i = 0; i < data.length; i++){
             var row = {};
                row["itemId"+(i+1)]= $(data[i]).children('[name="itemId"]').val();
                row["itemDescription"+(i+1)]= $(data[i]).children('[name="itemDescription"]').val();
                row["itemAmount"+(i+1)]= $(data[i]).children('[name="itemAmount"]').val();
                row["itemQuantity"+(i+1)]= $(data[i]).children('[name="itemQuantity"]').val();
        
            jsondata[i] = row;
        }
        console.log(data);
        console.log(jsondata);
        $.ajax({
	        type: 'POST',
	        url: './pagseguro',
	        data: jsondata,
	        success: function(response){
	            console.log("Success");
                console.log(response);
				
            },
            error: function(a,b,c){
                console.log("Error");
                console.log(a,b,c);
            }
        });
    });
</script>