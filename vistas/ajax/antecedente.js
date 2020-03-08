listarAntecedentes();

function listarAntecedentes() {
  $("#table_antecedentes").DataTable({
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
            $('#div_id_antecedente').html('');
            $('#form_add_antecedente')[0].reset();
          },
          "titleAttr": 'Nuevo'
      }
  ],
   "ajax": {
     url: '../model/antecedente.php?action=listar',
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
$("#form_add_antecedente").submit(
  function (e)
 {
  e.preventDefault();
  var formData = $(this).serialize();
  $.ajax({
      type: "POST",
      url:'../model/antecedente.php?action=guardar',
      data: formData,
      beforeSend: function() {
        //$("#ingresar").html('Autenticando...');
      },
      success: function(response) {
        var jsonData = JSON.parse(response);
        if (jsonData.success == "1") {
            $('#PrimaryModalalert').modal('hide');
            listarAntecedentes();
        }else {
        }

      }
    });
 })
function eliminarAntecedente(id_ant_patologico) {
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
             url: '../model/antecedente.php?action=eliminarAnte',
             data: 'id_ant_patologico='+id_ant_patologico, // serializes the form's elements.
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
                 listarAntecedentes();
               }else {

               }
             }
           });

      });
}

function verDataAntecedente(id_ant_patologico)
{
  $('#PrimaryModalalert').modal('show');
  $.ajax({
      type: "POST",
      url:'../model/antecedente.php?action=verData',
      data: 'id_ant_patologico='+id_ant_patologico,
      beforeSend: function() {
        //$("#ingresar").html('Autenticando...');
      },
      success: function(response) {
        var json = JSON.parse(response);
        $("#nombre").val(json.nombre);
        $("#descripcion").val(json.descripcion);
        $("#div_id_antecedente").html('<div class="col-md-12">'
            +'<div class="form-group has-success">'
                +'<input type="text" id="id_ant_patologico" name="id_ant_patologico" class="form-control" value="'+json.id_ant_patologico+'">'
              +'</div>'
        +'</div>');
      }
    });
}
