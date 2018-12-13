 <!-- Bootstrap core JavaScript-->
    <script src="../../<?php echo $this->vendor ?>/jquery/jquery.min.js"></script>
    <script src="../../<?php echo $this->vendor ?>/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../<?php echo $this->vendor ?>/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="../../<?php echo $this->vendor ?>/chart.js/Chart.min.js"></script>
    <script src="../../<?php echo $this->vendor ?>/datatables/jquery.dataTables.js"></script>
    <script src="../../<?php echo $this->vendor ?>/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../<?php echo $this->vendor ?>js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="../../<?php echo $this->vendor ?>js/demo/datatables-demo.js"></script>
    <script src="../../<?php echo $this->vendor ?>js/demo/chart-area-demo.js"></script>
    <script type="text/javascript">
        $("#add-peca").submit(function() {

                var data = new FormData($('#add-peca')[0]);

                $.ajax({
                    type: 'POST',
                    url: '../../dashbord/nova-peca',
                    data: data,
                    processData: false,
                    contentType: false,
                    dataType: 'html',
                    success: function(response){
                        console.log(response);
                        if(response == 1) {
                              $('#error').css('display', 'none');
                            $('#success').css('display', 'block');
                        } else {
                            $('#error').css('display', 'block');
                            $('#errorMessage').html(response);
                        }
                    }
                });
                return false;
            });

         $("#add-fornecedor").submit(function() {

                var data = new FormData($('#add-fornecedor')[0]);

                $.ajax({
                    type: 'POST',
                    url: '../../dashbord/novo-fornecedor',
                    data: data,
                    processData: false,
                    contentType: false,
                    dataType: 'html',
                    success: function(response){
                        console.log(response);
                        if(response == 1) {
                              $('#error').css('display', 'none');
                            $('#success').css('display', 'block');
                        } else {
                            $('#error').css('display', 'block');
                            $('#errorMessage').html(response);
                        }
                    }
                });
                return false;
            });
    </script>
  </body>

</html>