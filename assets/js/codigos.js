// global the manage memeber table
var tbl_codigos;

$(document).ready(function () {
  tbl_codigos = $("#tbl_codigos").DataTable({
    language: {
      "decimal": "",
      "emptyTable": "No hay información",
      "info": "Mostrando _START_ a _END_ de _TOTAL_ codigos",
      "infoEmpty": "Mostrando 0 a 0 de 0 codigos",
      "infoFiltered": "(Filtrado de _MAX_ total entradas)",
      "infoPostFix": "",
      "thousands": ".",
      "lengthMenu": "Mostrar _MENU_ codigos",
      "loadingRecords": "Cargando...",
      "processing": "Procesando...",
      "search": "Buscar:",
      "zeroRecords": "Sin resultados encontrados",
      "paginate": {
        "first": "Primero",
        "last": "Ultimo",
        "next": "Siguiente",
        "previous": "Anterior"
      }},
    scrollY: '50vh',
    scrollX: true,
    paging: true,
    dom: 'Bfrtip',
    buttons: [
      'excel'
    ],
    "ajax": "get_codigos.php"
  });
});
