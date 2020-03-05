listarPacientes();

listarDepartamentos();

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




$("#addPaciente").submit(function (e){
 e.preventDefault();
 var formData = $(this).serialize();
 $.ajax({
     type: "POST",
     url:'../model/paciente.php?action=guardar',
     data: formData,
     beforeSend: function() {
       //$("#ingresar").html('Autenticando...');
     },
     success: function(response) {

       var jsonData = JSON.parse(response);
       if (jsonData.success == "1") {
         $('#tipo_doc').val('');
         $('#numero_documento').val('');
         $('#nombres').val('');
         $('#apellidos').val('');
         $('#direccion').val('');
         $('#ubigeo').val('');
         $('#fecha_nacimiento').val('');
         $('#tipo_doc').val('');
         $('#ocupacion').val('');
         $('#genero').val('');
         $('#estado_civil').val('');
         $('#telefono').val('');
         $('#email').val('');
         $('#nombre_apoderado').val('');
         $('#telefono_apoderado').val('');
       }else {
       }

     }
   });
})
