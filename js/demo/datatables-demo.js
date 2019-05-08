// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    paging: false,
    autoWidth: true,
    language:{
      "decimal":        "",
      "emptyTable":     "Sem dados disponíveis na tabela!",
      "info":           "Mostrando _START_ a _END_ of _TOTAL_ registros.",
      "infoEmpty":      "Mostrando o total de 0 registros.",
      "infoFiltered":   "(filtrado de _MAX_ total registros)",
      "infoPostFix":    "",
      "thousands":      ",",
      "lengthMenu":     "Mostrar _MENU_ registros",
      "loadingRecords": "Carregando...",
      "processing":     "Processando...",
      "search":         "Pesquisa:",
      "zeroRecords":    "Nem uma combinação possível encontrada.",
      "paginate": {
          "first":      "Primeiro",
          "last":       "Último",
          "next":       "Próximo",
          "previous":   "Anterior"
      },
      "aria": {
          "sortAscending":  ": ativar ordenação crescente",
          "sortDescending": ": ativar ordenação decrescente"
      }
  }
  });
});
