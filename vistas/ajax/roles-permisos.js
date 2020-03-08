listarRoles();
function listarRoles() {
  $("#table_roles").DataTable({
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
          "text": '<i class="fa fa-plus"> Nuevo rol</i>',
          action: function ( e, dt, node, config ) {
            $('#PrimaryModalalert').modal('show');
            $('#div_id_rol').html('');
            $('#form_add_rol')[0].reset();
          },
          "titleAttr": 'Nuevo'
      }
  ],
   "ajax": {
     url: '../model/roles_permisos.php?action=listar_roles',
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


$('#regresar_lista').click(function (e) {
  e.preventDefault();
  $('#lista_roles_page').removeClass('hidden');
  $('#add_permisos_rol').addClass('hidden');
});

function editarRol(id_rol) {
  $('#PrimaryModalalert').modal('show');
  $.ajax({
    type: 'POST',
    url: '../model/roles_permisos.php?action=listar_data_rol',
    data: 'id_rol='+id_rol,
    beforeSend: function () {
    },
    success: function (response) {
      var response = JSON.parse(response);
      $('#div_id_rol').html('<input type="text" name="id_rol" id="id_rol" class="form-control" value="'+response[0].id_rol+'">');
      $('#nombre_rol').val(response[0].nombre);
      $('#abreviacion_rol').val(response[0].abreviacion);
    }
  });
}

function agregarPermisoRol(id_rol) {
  $('#lista_roles_page').addClass('hidden');
  $('#add_permisos_rol').removeClass('hidden');
  listarRolesPermisosAll(id_rol);
  listarRolesPermisosRol(id_rol);
}

function listarRolesPermisosRol(id_rol) {
  $.ajax({
    type: 'POST',
    url: '../model/roles_permisos.php?action=listar_rutas_rol',
    data: 'id_rol='+id_rol,
    beforeSend: function () {
    },
    success: function (response) {
      var response = JSON.parse(response);
      var html = '';
      $.each(response, function (i, item) {
          html += '<li class="list-group-item d-flex justify-content-between align-items-center">'+
          '<h5>'+response[i].nombre+'</h5>';
          html += '<ol class="list-group" style="margin-top: 20px">';
          var children = response[i].children;
          $.each(children, function (i, item) {
            html += '<li class="list-group-item d-flex justify-content-between align-items-center"><h6>'+
              children[i].nombre+
              '</h6>'+
            '</li>';
          });
          html += '</ol></li>';
      })
      $('#lista_rutas_rol').html(html);
    }
  });
}

function listarRolesPermisosAll(id_rol) {
  $.ajax({
    type: 'POST',
    url: '../model/roles_permisos.php?action=listar_rutas_all',
    data: 'id_rol='+id_rol,
    beforeSend: function () {
    },
    success: function (response) {
      var response = JSON.parse(response);
      var html = '';
      $.each(response, function (i, item) {
          html += '<li class="list-group-item d-flex justify-content-between align-items-center">'+
          '<h5>'+response[i].nombre+'<div class="checkbox pull-right">'+
              '<label style="font-size: 1.2em">'+
                  '<input type="checkbox" '+response[i].action+'>'+
                  '<span class="cr"><i class="cr-icon fa fa-check"></i></span>'+
              '</label></div></h5>';
          html += '<ol class="list-group" style="margin-top: 20px">';
          var children = response[i].children;
          $.each(children, function (i, item) {
            html += '<li class="list-group-item d-flex justify-content-between align-items-center"><h6>'+
              children[i].nombre+
              '<div class="checkbox pull-right">'+
                  '<label style="font-size: 1.2em">'+
                      '<input type="checkbox" '+children[i].action+'>'+
                      '<span class="cr"><i class="cr-icon fa fa-check"></i></span>'+
                  '</label></div></h6>'+
            '</li>';
          });
          html += '</ol></li>';
      })
      $('#lista_rutas_all').html(html);
    }
  });
}

function eliminarRol(id_rol) {
  swal({
          title: "¿Eliminar registro?",
          text: "Podra volver a recuperar el registro",
          type: "info",
          showCancelButton: true,
          closeOnConfirm: false,
          showLoaderOnConfirm: true,
          confirmButtonText: 'ELIMINAR',
          confirmButtonColor: '#354a77',
          cancelButtonText: 'CANCELAR',
          cancelButtonColor: '#bb9c7f',
      },
      function(){

            $.ajax({
             type: "POST",
             url: '../model/roles_permisos.php?action=eliminar_rol',
             data: 'id_rol='+id_rol, // serializes the form's elements.
             success: function(response)
             {
               var response = JSON.parse(response);
               if (response.success == "1"){
                 swal({
                     type: "success",
                     title: "Eliminado correctamente",
                     timer: 1000,
                     showConfirmButton: false
                 });
                 listarRoles();
               }
             }
           });

      });
}

$('#form_add_rol').submit(function (e) {
  e.preventDefault();
  var data = $(this).serialize();
  $.ajax({
   type: "POST",
   url: '../model/roles_permisos.php?action=agregar_rol',
   data: data, // serializes the form's elements.
   success: function(response){
     var response = JSON.parse(response);
     if (response.success == "1"){
       $('#PrimaryModalalert').modal('hide');
       listarRoles();
     }
   }
 });
});

function eliminarExistencia(id_ruta, id_rol) {
  $.ajax({
   type: "POST",
   url: '../model/roles_permisos.php?action=eliminar_existencia_rol',
   data: 'id_rol='+id_rol+'&id_ruta='+id_ruta, // serializes the form's elements.
   success: function(response){
     var response = JSON.parse(response);
     if (response.success == "1"){
       listarRolesPermisosAll(id_rol);
       listarRolesPermisosRol(id_rol);
     }
   }
 });
}

function agregarExistencia(id_ruta, id_rol) {
  $.ajax({
   type: "POST",
   url: '../model/roles_permisos.php?action=agregar_existencia_rol',
   data: 'id_rol='+id_rol+'&id_ruta='+id_ruta, // serializes the form's elements.
   success: function(response){
     var response = JSON.parse(response);
     if (response.success == "1"){
       listarRolesPermisosAll(id_rol);
       listarRolesPermisosRol(id_rol);
     }
   }
 });
}
