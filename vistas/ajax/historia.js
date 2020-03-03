listarAntecedentesForSelected();
listarTratamientoTable();


var hoy = new Date();
var dd = hoy.getDate();
var mm = hoy.getMonth()+1;
var yyyy = hoy.getFullYear();
if(dd<10) {
    dd='0'+dd;
}

if(mm<10) {
    mm='0'+mm;
}
var date = yyyy+ "-" + mm + "-" + dd ;

$('#fecha_documento').val(date);

function listarAntecedentesForSelected() {
  $.ajax({
    type: 'GET',
    url: '../model/historia.php',
    data: 'action=listar_antecedentes_for_selected',
    beforeSend: function () {
      //$('#btn_login_auth').html('AUTENTICANDO...');
    },
    success: function (response) {
      var response = JSON.parse(response);
      var html = '';
      $.each(response, function(i, item) {
        html += '<div class="col-md-4">'+
          '<div class="col-md-8">'+
            '<p style="margin-top: 10px">'+response[i].nombre+' </p>'+
          '</div>'+
          '<div class="col-md-4">'+
          '<div class="checkbox">'+
              '<label style="font-size: 1.2em">'+
                  '<input type="checkbox" value="">'+
                  '<span class="cr"><i class="cr-icon fa fa-check"></i></span>'+
              '</label>'+
          '</div>'+
          '</div>'+
        '</div>';
      });
      html += '<div class="col-md-4">'+
        '<div class="col-md-4">'+
          '<p style="margin-top: 10px">OTROS </p>'+
        '</div>'+
        '<div class="col-md-8">'+
          '<input type="text" class="form-control">'+
        '</div>'+
      '</div>';
      $("#antecedentes_patologicos").append(html);
    },
    error: function (error) {
      console.log(error);
    }
  });
}

function listarTratamientoTable() {
    $.ajax({
      type: 'GET',
      url: '../model/historia.php',
      data: 'action=listar_tratamiento_table',
      beforeSend: function () {
        //$('#btn_login_auth').html('AUTENTICANDO...');
      },
      success: function (response) {
        var response = JSON.parse(response);
        var html = '';
        $.each(response, function(i, item) {
          html += '<tr>'+
            '<td>'+
              '<input type="text" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid" readonly class="form-control" name="" value="'+response[i].nombre+'">'+
            '</td>'+
            '<td>'+
              '<input type="text" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid"  class="form-control" name="" value="">'+
            '</td>'+
            '<td>'+
              '<input type="text" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid"  class="form-control" name="" value="">'+
            '</td>'+
            '<td>'+
              '<input type="text" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid"  class="form-control" name="" value="">'+
            '</td>'+
          '</tr>';
        });
        $("#table_tratamiento").html(html);
      }
    });
}

function printDiv() {
          var objeto=document.getElementById('imprimir');

   //obtenemos el objeto a imprimir
          var ventana=window.open('','_blank');  //abrimos una ventana vacía nueva
          ventana.document.write(objeto.innerHTML);  //imprimimos el HTML del objeto en la nueva ventana
          ventana.document.close();  //cerramos el documento
          ventana.print();  //imprimimos la ventana
          ventana.close();  //cerramos la ventana
        }

$('#nombre_paciente').keyup(function (e) {
  $.ajax({
    type: 'POST',
    url: '../model/historia.php?action=buscar_paciente',
    data: 'nombre_paciente='+$(this).val(),
    beforeSend: function () {
      //$('#btn_login_auth').html('AUTENTICANDO...');
    },
    success: function (response) {
      var response = JSON.parse(response);
      if (response != '') {
        $('#fecha_nacimiento_paciente').val(response[0].fecha_nacimiento);
        $('#edad_paciente').val(response[0].edad);
        $('#genero_paciente').val(response[0].id_genero);
        $('#id_estado_civil').val(response[0].id_estado_civil);
        $('#ubigeo_paciente').val(response[0].ubigeo);
        $('#ocupacion_paciente').val(response[0].ocupacion);
        $('#telefono_paciente').val(response[0].telefono);
        $('#direccion_paciente').val(response[0].direccion);
        $('#email_paciente').val(response[0].email);
      }else {
        $('#fecha_nacimiento_paciente').val('');
        $('#edad_paciente').val('');
        $('#genero_paciente').val('');
        $('#id_estado_civil').val('');
        $('#ubigeo_paciente').val('');
        $('#ocupacion_paciente').val('');
        $('#telefono_paciente').val('');
        $('#direccion_paciente').val('');
        $('#email_paciente').val('');
      }
    }
    })
});
