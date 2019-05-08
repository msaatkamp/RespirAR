      <!-- Footer -->
      <footer class="sticky-footer bg-white">
          <div class="container my-auto">
              <div class="copyright text-center my-auto">
                  <span>Copyright &copy; SLS Cadastro ERP - 2019 </span> <!-- Desenvolvido por Matheus Saatkamp -->
              </div>
          </div>
      </footer>
      <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

      </div>
      <!-- End of Page Wrapper -->

      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
          <i class="fas fa-angle-up"></i>
      </a>

      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Encerrar sessão?</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  <div class="modal-body">Selecione "Logout" abaixo se deseja finalizar sua sessão.</div>
                  <div class="modal-footer">
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                      <a class="btn btn-primary" href="logout.php">Logout</a>
                  </div>
              </div>
          </div>
      </div>
      <?php
        if (activeMatchUrl('users', true) || activeMatchUrl('planos', true) || activeMatchUrl('clientes', true) || activeMatchUrl('pagamentos', true)) {
            ?>
          <!-- Page level plugins -->
          <script src="vendor/datatables/jquery.dataTables.min.js"></script>
          <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

          <!-- Page level custom scripts -->
          <script src="js/demo/datatables-demo.js"></script>
          <script src="js/ms/datatable-index.js"></script>
      <?php

    }
    ?>


      <?php
        if (activeMatchUrl('clientes', true)) {
            echo '<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>';
            echo '<link rel="stylesheet" type="text/css" href="https://printjs-4de6.kxcdn.com/print.min.css">';
        }
        ?>

      <script>
          function shouldDelete(url, id) {
              console.log("URL: " + "delete_" + url + ".php?id=" + id + "");
              confirm('Você realmente quer deletar o item de ID ' + id + '?');
              window.location.href = "delete_" + url + ".php?id=" + id + "";
          }
          <?php
            if (activeMatchUrl('clientes', true)) {
                ?>

              function clientModal() {
                  $('#updateModal').modal('show');
              };
              /*
                  Script para clientes.php
              */
              $('#updateModal').on('show.bs.modal', function(event) {
                  var button = $(event.relatedTarget) // Button that triggered the modal
                  var cliente_id = button.data('cliente_id') // Extract info from data-* attributes
                  var cliente_nome = button.data('cliente_nome');
                  var cliente_cpf = button.data('cliente_cpf');
                  var cliente_cidade = button.data('cliente_cidade');
                  var cliente_bairro = button.data('cliente_bairro');
                  var cliente_endereco = button.data('cliente_endereco');
                  var cliente_numero = button.data('cliente_numero');
                  var cliente_telefone = button.data('cliente_telefone');
                  var cliente_email = button.data('cliente_email');
                  var plano_id = button.data('plano_id');
                  var modal = $(this);
                  //   modal.find('.modal-title').text('New message to ' + recipient)
                  modal.find(".modal-body input[name='cliente_id']").val(cliente_id);
                  modal.find(".modal-body input[name='nome']").val(cliente_nome);
                  modal.find(".modal-body input[name='cpf']").val(cliente_cpf);
                  modal.find(".modal-body input[name='cidade']").val(cliente_cidade);
                  modal.find(".modal-body input[name='bairro']").val(cliente_bairro);
                  modal.find(".modal-body input[name='endereco']").val(cliente_endereco);
                  modal.find(".modal-body input[name='numero']").val(cliente_numero);
                  modal.find(".modal-body input[name='telefone']").val(cliente_telefone);
                  modal.find(".modal-body input[name='email']").val(cliente_email);
                  modal.find(".modal-body select[name='plano']").val(plano_id);
              });
              $('#validateModal').on('show.bs.modal', function(event) {
                  var button = $(event.relatedTarget) // Button that triggered the modal
                  var cliente_id = button.data('cliente_id') // Extract info from data-* attributes
                  var cliente_nome = button.data('cliente_nome');
                  var plano_id = button.data('plano_id');
                  var plano_vel = button.data('plano_velocidade');
                  var plano_val = button.data('plano_valor');

                  var modal = $(this);


                  //   modal.find('.modal-title').text('New message to ' + recipient)
                  modal.find(".modal-body input[name='cliente_id']").val(cliente_id);
                  modal.find(".modal-body input[name='nome']").val(cliente_nome);
                  modal.find(".modal-body select[name='plano']").val(plano_id);
                  modal.find(".modal-body input[name='velocidade']").val(plano_vel);
                  modal.find(".modal-body input[name='valor']").val(plano_val);
              });

              function checkPayments(id) {
                  // AJAX request
                  $.ajax({
                      url: 'retrieve_data.php?data=clients&type=payment&id=' + id,
                      type: 'GET',
                      dataType: 'html',
                      /*data: {
                          userid: userid
                      },*/
                      success: function(response) {
                          console.log("Cliente reconhecido ID: " + id);
                          $('.paymentsTableBody').html(response);
                          console.log("Response: ")
                          console.log(response);
                          // $('.paymentsModal').modal('show');
                      },
                      error: function(x, y, z) {
                          console.log(x);
                          console.log(y);
                          console.log(z);
                      }
                  });
              };
          <?php
        }
        ?>
      </script>
      </body>

      </html>