listarPacientes();
function listarPacientes() {
    $.ajax({
      type: 'GET',
      url: '../model/paciente.php',
      data: 'action=listar',
      beforeSend: function () {
        //$('#btn_login_auth').html('AUTENTICANDO...');
      },
      success: function (response) {
        var response = JSON.parse(response);
        alert(response);
        var html = '';
        $.each(response, function(i, item) {
          html += '<tr>'+
          '<td >'+response[i].count+'</td>'+
          '<td >'+response[i].created_at+'</td>'+
          '<td >'+response[i].primer_nombre+'</td>'+
          '</tr>';
        });
        $("#table_paciente").html(html);
      }
    });
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
