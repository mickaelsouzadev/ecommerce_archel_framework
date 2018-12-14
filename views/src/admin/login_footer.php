 <script src="../<?php echo $this->vendor ?>/jquery/jquery.min.js"></script>
    <script src="../<?php echo $this->vendor ?>/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../<?php echo $this->vendor ?>/jquery-easing/jquery.easing.min.js"></script>
     <script type="text/javascript">
        $(document).ready(function() {
            $("#login-form").submit(function() {

                var data = new FormData($('#login-form')[0]);
            
                $.ajax({
                    type: 'POST',
                    url: '../dashbord/do-login',
                    data: data,
                    processData: false,
                    contentType: false,
                    dataType: 'html',
                    success: function(response){
                    	console.log(response);
                        if(response == 1) {
                            window.location.href="http://localhost/archel_framework/dashbord/home";
                        } else {
                            $('#error').css('display', 'block');
                            $('#errorMessage').html(response);
                        }
                    }
                });
                return false;
            });
        });
    </script>
  </body>

</html>