listarTratamientos();

function listarTratamientos() {
  $("#table_tratamiento").DataTable({
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
          "text": '<i class="fa fa-plus"> Nuevo </i>',
          action: function ( e, dt, node, config ) {
            $('#PrimaryModalalert').modal('show');
            $('#div_id_tratamiento').html('');
            $('#form_add_tratamiento')[0].reset();
          },
          "titleAttr": 'Nuevo'
      }
  ],
   "ajax": {
     url: '../model/tratamiento.php?action=listar',
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
$("#form_add_tratamiento").submit(
  function (e)
 {
  e.preventDefault();
  var formData = $(this).serialize();
  //alert(formData);
  $.ajax({
      type: "POST",
      url:'../model/tratamiento.php?action=guardar',
      data: formData,
      beforeSend: function() {
        //$("#ingresar").html('Autenticando...');
      },
      success: function(response) {
        var jsonData = JSON.parse(response);

        if (jsonData.success == "1") {
            $('#PrimaryModalalert').modal('hide');
            listarTratamientos();
        }else {
        }

      }
    });
 })
function eliminarTratamiento(id_tratamiento) {
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
             url: '../model/tratamiento.php?action=eliminar',
             data: 'id_tratamiento='+id_tratamiento, // serializes the form's elements.
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
                 listarTratamientos();
               }else {

               }
             }
           });

      });
}

function verDataTratamiento(id_tratamiento)
{
  $('#PrimaryModalalert').modal('show');
  $.ajax({
      type: "POST",
      url:'../model/tratamiento.php?action=verData',
      data: 'id_tratamiento='+id_tratamiento,
      beforeSend: function() {
        //$("#ingresar").html('Autenticando...');
      },
      success: function(response) {
        var json = JSON.parse(response);
        $("#nombre").val(json.nombre);
        $("#costo").val(json.costo);
        $("#descripcion").val(json.descripcion);
        $("#div_id_tratamiento").html('<div class="col-md-12">'
            +'<div class="form-group has-success">'
                +'<input type="text" id="id_tratamiento" name="id_tratamiento" class="form-control" value="'+json.id_tratamiento+'">'
              +'</div>'
        +'</div>');
      }
    });
}
