listarDientes();
function listarDientes() {
  $("#table_dientes").DataTable({
   "responsive": true,
   "aProcessing": true, //Activamos el procesamiento del datatables
   "aServerSide": true, //PaginaciÃ³n y filtrado realizados por el servidor
   "dom": 'lBfrtip', //Definimos los elementos del control de tabla
   "buttons": [
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
      },
      {
          "text": '<i class="fa fa-cog"> registros eliminados</i>',
          action: function ( e, dt, node, config ) {
            listarDientesEliminados();
          },
          "titleAttr": 'Nuevo'
      }
  ],
   "ajax": {
     url: '../model/dientes.php?action=listar',
     type: "get",
     dataType: "json",
     cache: true,
     beforeSend: function(e) {
       //alert(e);
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
function listarDientesEliminados() {
  $("#table_dientes").DataTable({
   "responsive": true,
   "aProcessing": true, //Activamos el procesamiento del datatables
   "aServerSide": true, //PaginaciÃ³n y filtrado realizados por el servidor
   "dom": 'lBfrtip', //Definimos los elementos del control de tabla
   "buttons": [
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
      },
      {
          "text": '<i class="fa fa-list"> Lista de registros</i>',
          action: function ( e, dt, node, config ) {
            listarDientes();
          },
          "titleAttr": 'Nuevo'
      }
  ],
   "ajax": {
     url: '../model/dientes.php?action=listarEliminados',
     type: "get",
     dataType: "json",
     cache: true,
     beforeSend: function(e) {
       //alert(e);
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
$("#form_add_dientes").submit(
  function (e)
 {
  e.preventDefault();
  var formData = $(this).serialize();

  $.ajax({
      type: "POST",
      url:'../model/dientes.php?action=actualizar',
      data: formData,
      beforeSend: function() {
        //$("#ingresar").html('Autenticando...');
      },
      success: function(response) {
        var jsonData = JSON.parse(response);
        if (jsonData.success == "1") {

            $('#PrimaryModalalert').modal('hide');
            listarDientes();
        }else {
        }

      }
    });
 })

 function verDataDiente(id_diente)
 {
   $('#PrimaryModalalert').modal('show');
   $.ajax({
       type: "POST",
       url:'../model/dientes.php?action=verData',
       data: 'id_diente='+id_diente,
       beforeSend: function() {
         //$("#ingresar").html('Autenticando...');
       },
       success: function(response) {
         var json = JSON.parse(response);
         $("#nombre").val(json.nombre);
         $("#numero").val(json.numero);
         $("#div_id_dientes").html('<div class="col-md-12">'
             +'<div class="form-group has-success">'
                 +'<input type="text" id="id_diente" name="id_diente" class="form-control" value="'+json.id_diente+'">'
               +'</div>'
         +'</div>');
       }
     });
 }

 function eliminarDiente(id_diente) {
   swal({
           title: "¿Eliminar registro?",
           text: "Podra volver a recuperar el registro",
           type: "info",
           showCancelButton: true,
           closeOnConfirm: false,
           showLoaderOnConfirm: true,
       },
       function(){

             $.ajax({
              type: "POST",
              url: '../model/dientes.php?action=eliminar',
              data: 'id_diente='+id_diente, // serializes the form's elements.
              success: function(res)

              {
                var jsonData = JSON.parse(res);

                if (jsonData.success == "1"){
                  swal({
                      type: "success",
                      title: "Eliminado correctamente",
                      timer: 1000,
                      showConfirmButton: false
                  });
                  listarDientes();
                }else {

                }
              }
            });

       });
 }


 function recuperarDiente(id_diente) {
   swal({
           title: "Recuperar Registro?",
           text: "Podra volver a visualizar el Registro",
           type: "info",
           showCancelButton: true,
           closeOnConfirm: false,
           showLoaderOnConfirm: true,
       },
       function(){

             $.ajax({
              type: "POST",
              url: '../model/dientes.php?action=recuperar',
              data: 'id_diente='+id_diente, // serializes the form's elements.
              success: function(res)

              {
                var jsonData = JSON.parse(res);

                if (jsonData.success == "1"){
                  swal({
                      type: "success",
                      title: "Recuperado correctamente",
                      timer: 1000,
                      showConfirmButton: false
                  });
                  listarDientes();
                }else {

                }
              }
            });

       });

 }
