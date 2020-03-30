listarHistorias();

function listarHistorias() {
  $("#table_historias").DataTable({
   "responsive": true,
   "aProcessing": true, //Activamos el procesamiento del datatables
   "aServerSide": true, //PaginaciÃ³n y filtrado realizados por el servidor
   "dom": '<center>B</center>lfrtip', //Definimos los elementos del control de tabla
   "buttons": [
      {
          "extend":    'copyHtml5',
          "text":      '<i class="fa fa-files-o"> Copiar</i>',
          "exportOptions": {
            "columns": [0, 1, 3, 4, 5],
          },
          "className": 'copiar',
          "titleAttr": 'Copy'
      },
      {
          "extend":    'excelHtml5',
          "text":      '<i class="fa fa-file-excel-o"> Excel</i>',
          "exportOptions": {
            "columns": [0, 1, 3, 4, 5],
          },
          "titleAttr": 'Excel'
      },
      {
          "extend":    'csvHtml5',
          "text":      '<i class="fa fa-file-text-o"> CSV</i>',
          "exportOptions": {
            "columns": [0, 1, 3, 4, 5],
          },
          "titleAttr": 'CSV'
      },
      {
          "extend": 'pdf',
          "text": '<i class="fa fa-file-pdf-o"> PDF</i>',
          "exportOptions": {
            "columns": [0, 1, 3, 4, 5],
          },
          "titleAttr": 'pdf'
      },
      {
          "extend": 'print',
          "text": '<i class="fa fa-print"> Imprimir</i>',
          "exportOptions": {
            "columns": [0, 1, 3, 4, 5],
          },
          "titleAttr": 'print'
      }
  ],
   "ajax": {
     url: '../model/registros.php?action=listar',
     type: "get",
     dataType: "json",
     cache: true,
     beforeSend: function(e) {
       //$("#table_productos").html(".sdfsldf,sd");
     },
     error: function(e) {
       console.log(e.responseText);
     }
   },

   "bDestroy": true,
   "iDisplayLength": 10, //Paginación
   "order": [
     [0, "asc"]
   ], //Ordenar (columna,orden)
   "language": {
       "responsive": true,
       "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
   }
   })
}
