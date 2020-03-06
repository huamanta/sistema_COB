listarDepartamentos();
listarUsuarios();
function listarUsuarios() {
  $("#table_usuarios").DataTable({
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
          "text": '<i class="fa fa-plus"> Nuevo usuario</i>',
          action: function ( e, dt, node, config ) {
            location.href = 'nuevo_usuario';
          },
          "titleAttr": 'Nuevo'
      }
  ],
   "ajax": {
     url: '../model/usuarios.php?action=listar_usuarios',
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

 $("#add_usuario").validate({
   rules: {
     tipo_doc: 'required',
     nombres: 'required',
     apellidos: 'required',
     numero_documento: {
       required: true,
       minlength: 8,
       maxlength: 11
     },
     genero: 'required',
     estado_civil: 'required',
     email: {
       required: true,
       email: true
     },
     telefono: 'required',
     id_rol: 'required',
     usuario: 'required',
     password: 'required',
     password_confirm: {
      required: true,
      equalTo: '#password'
    }
   },
   messages: {
     tipo_doc: 'Seleccione tipo de documento',
     nombres: 'Ingrese su nombre completo',
     apellidos:'Ingrese sus apellidos',
     numero_documento: {
       required: 'Ingrese su numero de documento',
       minlength: $.format("Necesitamos por lo menos {0} caracteres"),
       axlength: $.format("{0} caracteres son demasiados!")
     },
     genero: 'Seleccione genero del usuario',
     estado_civil: 'Seleccione estado civil',
     email: {
       required: 'Ingrese su email',
       email: 'Ingrese un email valido ejemplo: ejemplo@ejemplo.com'
     },
     telefono: 'Ingrese su telefono',
     id_rol: 'Seleccione rol',
     usuario: 'Ingrese usuario',
     password: " Ingrese su contraseña",
     password_confirm: {
       required: 'Confirmar contraseña',
       equalTo: 'Enter Confirm Password Same as Password'
     }
   },
   submitHandler: function(form){
     var formData = $("#add_usuario").serialize();
     $.ajax({
         type: "POST",
         url:'../model/usuarios.php?action=guardar_usuario',
         data: formData,
         beforeSend: function() {
           //$("#ingresar").html('Autenticando...');
         },
         success: function(response) {
           var jsonData = JSON.parse(response);
           if (jsonData.success == "1") {
             location.href = 'usuarios';
           }
         }
       });

   }
 });

listarDataUsuario($('#id_usuario').val(), $('#id_persona').val());

function listarDataUsuario(id_usuario, id_persona) {
  $.ajax({
      type: "POST",
      url:'../model/usuarios.php?action=listar_data_usuario',
      data: 'id_usuario='+id_usuario+'&id_persona='+id_persona,
      beforeSend: function() {
        //$("#ingresar").html('Autenticando...');
      },
      success: function(response) {
        if($('#departamento').val() != ''){
          var response = JSON.parse(response);
          var departamento = response[0].ubigeo;
          $('#tipo_doc').val(response[0].id_tipo_documento);
          $('#numero_documento').val(response[0].numero_documento);
          $('#nombres').val(response[0].nombres);
          $('#apellidos').val(response[0].apellidos);
          $('#ocupacion').val(response[0].ocupacion);
          $('#departamento').val(departamento.substr(0,2));
          $('#ubigeo').val(response[0].ubigeo);
          $('#fecha_nacimiento').val(response[0].fecha_nacimiento);
          $('#genero').val(response[0].id_genero);
          $('#estado_civil').val(response[0].id_estado_civil);
          $('#email').val(response[0].email);
          $('#telefono').val(response[0].telefono);
          $('#direccion').val(response[0].direccion);
        }
      }
    });
}


 function listarDepartamentos() {
       var url = 'http://localhost/restapi/v1/ubigeo/all';
       var token = '8f126c231ef98f4e45d331dc1bc336278935fed6f09fc214f07691258baa16b0';
       $.ajax({
         url: url,
         headers: {
         'Authorization': token,
         },
         type: 'GET',
         accepts: "application/json",
         crossDomain: true,
         beforeSend: function () {
           //$('#btn_login_auth').html('AUTENTICANDO...');
         },
         success: function (response) {
           $.each(response, function (i, item) {
             var departamentos = response[i].departamentos;
             var html = '<option value="" hidden selected>Seleccionar region</option>';
             $.each(departamentos, function (i, item) {
               html += '<option value="'+departamentos[i].ubigeo+'">'+departamentos[i].nombre+'</option>';
             })
             $('#departamento').html(html);
           });
         }
       });
 }

 $('#departamento').change(function () {
   var url = 'http://localhost/restapi/v1/ubigeo/data_list';
   var token = '8f126c231ef98f4e45d331dc1bc336278935fed6f09fc214f07691258baa16b0';
   var data = 'ubigeo='+$(this).val();
   $.ajax({
     url: url,
     headers: {
     'Authorization': token,
     },
     type: 'GET',
     data: data,
     accepts: "application/json",
     crossDomain: true,
     beforeSend: function () {
       //$('#btn_login_auth').html('AUTENTICANDO...');
     },
     success: function (response) {
       var departamento = response[0].departamento;
       $.each(departamento, function (i, item) {
         var provincias = departamento[i].provincias;
         var html = '';
         $.each(provincias, function (i, item) {
           var distritos = provincias[i].distritos;
           html += '<optgroup label="'+provincias[i].nombre+'">';
           $.each(distritos, function (i, item) {
             html += '<option value="'+distritos[i].ubigeo+'">'+distritos[i].nombre+'</option>';
           })
           html += '</optgroup>';
         })
         $("#ubigeo").html(html);
       });
     }
   });
 })

 $("#numero_documento").keyup(function(a){
   var numero_documento = $(this).val();
   if(numero_documento.length === 8){
     $.ajax({
         type: "GET",
         url: 'https://dniruc.apisperu.com/api/v1/dni/'+numero_documento+'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImFsaXNodWFtYW50YUB1cGV1LmVkdS5wZSJ9.IX7C0NZ9I5p8tdOqs7CbSnE_m8CxdghcDMZetoUAwEg',
         beforeSend: function() {
           //$("#ingresar").html('Autenticando...');
         },
         success: function(response) {
           $("#nombres").val(response.nombres);
           $("#apellidos").val(response.apellidoPaterno+' '+response.apellidoMaterno);
         }
       });
   }else if (numero_documento.length === 11) {
     $.ajax({
         type: "GET",
         url: 'https://dniruc.apisperu.com/api/v1/ruc/'+numero_documento+'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImFsaXNodWFtYW50YUB1cGV1LmVkdS5wZSJ9.IX7C0NZ9I5p8tdOqs7CbSnE_m8CxdghcDMZetoUAwEg',
         beforeSend: function() {
           //$("#ingresar").html('Autenticando...');
         },
         success: function(response) {
           console.log(response);
           $("#nombres").val(response.nombreComercial);
           $("#email").val(response.email);
           $("#direccion").val(response.direccion);
         }
       });
   }
 })

 $('#lista_usuarios').click(function () {
   location.href = 'usuarios';
 })

 function Redirect(id_usuario, id_persona) {
   redirect_by_post('nuevo_usuario.php', {
       id_usuario: id_usuario,
       id_persona: id_persona
   }, true);
 }

 function redirect_by_post(purl, pparameters, in_new_tab) {
     pparameters = (typeof pparameters == 'undefined') ? {} : pparameters;
     in_new_tab = (typeof in_new_tab == 'undefined') ? true : in_new_tab;

     var form = document.createElement("form");
     $(form).attr("id", "reg-form").attr("name", "reg-form").attr("action", purl).attr("method", "post").attr("enctype", "multipart/form-data");
     if (in_new_tab) {
         $(form).attr("target", "");
     }
     $.each(pparameters, function(key) {
         $(form).append('<input type="text" name="' + key + '" value="' + this + '" />');
     });
     document.body.appendChild(form);
     form.submit();
     document.body.removeChild(form);

     return false;
 }

 function actualizarCredenciales(id_usuario) {
   $('#modal_update_user').modal('show');
   $.ajax({
       type: "POST",
       url:'../model/usuarios.php?action=listar_data_credenciales',
       data: 'id_usuario='+id_usuario,
       beforeSend: function() {
         //$("#ingresar").html('Autenticando...');
       },
       success: function(response) {
         var response = JSON.parse(response);
         $('#id_rol_edit').val(response[0].id_rol);
         $('#usuario_edit').val(response[0].username);
         $('#div_id_user').html('<div class="form-group">'+
             '<input class="form-control" type="text" name="id_user_edit" id="id_user_edit" value="'+response[0].id_usuario+'">'+
         '</div>');
       }
     });
 }

 function eliminarUsuario(id_usuario) {
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
              url: '../model/usuarios.php?action=eliminar_usuario',
              data: 'id_usuario='+id_usuario, // serializes the form's elements.
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
                  listarUsuarios();
                }
              }
            });

       });
 }

 $('#form_update_user').submit(function (e) {
   e.preventDefault();
   $.ajax({
     type: "POST",
     url: '../model/usuarios.php?action=actualizar_user_credenciales',
     data: $(this).serialize(), // serializes the form's elements.
     success: function(response){
       var response = JSON.parse(response);
       if (response.success == "1"){
         listarUsuarios();
         $('#modal_update_user').modal('hide');
       }
     }
  });
 })
