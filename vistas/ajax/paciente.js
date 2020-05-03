listarPacientes();
listarDepartamentos();
listarGenero();
listarEstadoCivil();
listarTipoDocumento();

function listarGenero() {
  $.ajax({
    type: 'POST',
    url: '../model/paciente.php?action=listar_genero',
    data: '',
    beforeSend: function () {
      // body...
    },
    success: function (response) {
      var response = JSON.parse(response);
      var html = '<option value="" hidden selected>Genero</option>';
      $.each(response, function (i, item) {
        html += '<option value="'+response[i].id_genero+'">'+response[i].nombre+'</option>';
      });
      $('#genero').html(html);
    }
  });
}

function listarEstadoCivil() {
  $.ajax({
    type: 'POST',
    url: '../model/paciente.php?action=listar_estado_civil',
    data: '',
    beforeSend: function () {
      // body...
    },
    success: function (response) {
      var response = JSON.parse(response);
      var html = '<option value="" hidden selected>Estado Civil</option>';
      $.each(response, function (i, item) {
        html += '<option value="'+response[i].id_estado_civil+'">'+response[i].nombre+'</option>';
      });
      $('#estado_civil').html(html);
    }
  });
}

function listarTipoDocumento() {
  $.ajax({
    type: 'POST',
    url: '../model/paciente.php?action=listar_tipo_documento',
    data: '',
    beforeSend: function () {
      // body...
    },
    success: function (response) {
      var response = JSON.parse(response);
      var html = '<option value="" hidden selected>Tipo Documento</option>';
      $.each(response, function (i, item) {
        html += '<option value="'+response[i].id_tipo_documento+'">'+response[i].nombre+'</option>';
      });
      $('#tipo_doc').html(html);
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

$('#listar_paciente').click(function () {
  location.href = 'listar_paciente';
})

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

function listarPacientes() {
  $("#table_paciente").DataTable({
   "responsive": true,
   "aProcessing": true, //Activamos el procesamiento del datatables
   "aServerSide": true, //PaginaciÃ³n y filtrado realizados por el servidor
   "dom": 'lBfrtip', //Definimos los elementos del control de tabla
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
      },
      {
          "text": '<i class="fa fa-plus"> Nuevo Paciente</i>',
          action: function ( e, dt, node, config ) {
            location.href = './paciente';
          },
          "titleAttr": 'Nuevo Paciente'
      }
  ],
   "ajax": {
     url: '../model/paciente.php?action=listar',
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

$("#addPaciente").validate({
  rules: {
    nombres: "required",
    apellidos: "required",
    email: {
      email: true
    }
  },
  messages: {
    nombres: "Please specify your name",
    apellidos:"Please specify your last name",
    numero_documento: "Please specify your Number Document",
    email: {
      required: "We need your email address to contact you",
      email: "Your email address must be in the format of name@domain.com"
    }
  },
  submitHandler: function(form){
    var formData = $("#addPaciente").serialize();

    $.ajax({
        type: "POST",
        url:'../model/paciente.php?action=guardar',
        data: formData,
        beforeSend: function() {
          //$("#ingresar").html('Autenticando...');
        },
        success: function(response) {
          var jsonData = JSON.parse(response);

          console.log(response);

          if (jsonData.success == "1") {
            location.href = './listar_paciente';
          }else {
          }

        }
      });
  }
});

function eliminarPaciente(id)
{
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
             url: '../model/paciente.php?action=eliminarPaciente',
             data: 'id_paciente='+id, // serializes the form's elements.
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
                 listarPacientes();
               }else {

               }
             }
           });

      });
}

function Redirect(id_paciente, id_persona) {
  redirect_by_post('paciente.php', {
      id_paciente: id_paciente,
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
verDataPaciente($('#id_paciente').val(),$('#id_persona').val());
function verDataPaciente(id_paciente, id_persona)
      {
        $.ajax({
            type: "POST",
            url:'../model/paciente.php?action=dataPaciente',
            data: 'id_paciente='+id_paciente+'id_persona='+id_persona,
            beforeSend: function() {
              //$("#ingresar").html('Autenticando...');
            },
            success: function(response) {
              var json = JSON.parse(response);
              console.log(json);
              $("#tipo_doc").val(json.id_tipo_documento);
              $("#numero_documento").val(json.numero_documento);
              $("#nombres").val(json.primer_nombre+' '+json.segundo_nombre);
              $("#apellidos").val(json.primer_apellido+' '+json.segundo_apellido);
              $("#fecha_nacimiento").val(json.fecha_nacimiento);
              $("#ocupacion").val(json.ocupacion);
              $("#genero").val(json.id_genero);
              $("#estado_civil").val(json.id_estado_civil);
              $("#email").val(json.email);
              $("#direccion").val(json.direccion);
              $("#telefono").val(json.telefono);
              $("#nombre_apoderado").val(json.nombre_apoderado);
              $("#telefono_apoderado").val(json.telefono_apoderado);
              setTimeout(function () {
                $("#departamento").val('	'+json.ubigeo.substr(0,2)+'	');
                var url = 'http://localhost/restapi/v1/ubigeo/data_list';
                var token = '8f126c231ef98f4e45d331dc1bc336278935fed6f09fc214f07691258baa16b0';
                var data = 'ubigeo='+$("#departamento").val();
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
                setTimeout(function () {
                  $("#ubigeo").val('	'+json.ubigeo+'	');
                }, 1000);
              }, 1000);
            }
          });
      }
