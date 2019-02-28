 <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.6/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="../<?php echo $this->vendor ?>/jquery/jquery.min.js"></script>
    <script src="../<?php echo $this->vendor ?>/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../<?php echo $this->vendor ?>/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="../<?php echo $this->vendor ?>/chart.js/Chart.min.js"></script>
    <script src="../<?php echo $this->vendor ?>/datatables/jquery.dataTables.js"></script>
    <script src="../<?php echo $this->vendor ?>/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../<?php echo $this->vendor ?>js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="../<?php echo $this->vendor ?>js/demo/datatables-demo.js"></script>
    <script src="../<?php echo $this->vendor ?>js/demo/chart-area-demo.js"></script>

    <script type="text/javascript">
    $(document).ready(function (){
        let peca = new Vue({
            el: "#table",
            data: {
                results: [
                ],
            },
            methods: {
                getPeca: function () {
                     
                    axios.get('../api/peca')
                        .then(response => {
                            this.results = response.data;
                        }).then(() => {
                            console.log('Carregou');
                        }).catch((error) => {
                            console.error("Deu pau: ", error);
                        }).catch((error) => {
                            console.error("Deu pau: ", error);
                        })
                },
                deletePeca: function(id) {
                    $('#modal-delete-peca').modal('show');
                    $('#peca-id').html(id);

                    const deleteBtn = document.getElementById('delete');

                    deleteBtn.onclick = () => {
                        axios.delete('../api/peca/'+id)
                            .then((response) => {
                                const index = this.results.findIndex(result => result.id === id);
                                this.removeResult(index);

                                $('#modal-delete-peca').modal('hide');
                                $('#success-delete').modal('show');
                            }).catch((error) => {
                                console.error("Deu pau: ", error);
                            });
                    }
                  
                },
                removeResult: function(index) {
                    this.results.splice(index, 1)
                }    
            },
            mounted: function() {
                this.getPeca();
                console.log(this.results)
            },
        });
       
          //   $('.delete-peca').click(function() {
          //       console.log('clic')
          //     var id = $(this).val();
          //     $('#modal-delete-peca').modal('show');
          //     $('#peca-id').html(id);
          //     $('#delete').click(function() {
          //       $.ajax({
          //           type: 'POST',
          //           url: '../peca/delete',
          //           data: {'id':id},
          //           success: function(response){
          //               console.log(response);
          //               $('#modal-delete-peca').modal('hide');
          //               $('#success-delete').modal('show');
          //               window.location.reload();
          //               //loadResources();
          //           }
          //       });
          //   });
          // });

          //   $('.update-peca').click(function() {
          //     var id = $(this).val();

          //     $('#modal-update-peca'+id).modal('show');

          //     // $('#peca-id'+id).html(id);
          //     $('#save'+id).click(function() {
          //       var data = $('#update-peca-form'+id).serialize();
               
          //       $.ajax({
          //           type: 'POST',
          //           url: '../peca/update/'+id,
          //           data: data,
          //           success: function(response){
          //               console.log(response);
          //               $('#modal-update-peca'+id).modal('hide');
          //               $('#success-delete').modal('show');
          //               window.location.reload();
          //               //loadResources();
          //           }
          //       });
          //   });
          // });
        });
    </script>
  </body>

</html>