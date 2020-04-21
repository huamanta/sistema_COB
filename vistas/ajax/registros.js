listarHistorias();

function listarHistorias() {
  $('#registro_historias').removeClass('hidden');
  $('#detalle_historia').addClass('hidden');
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
            "columns": [0, 1, 3, 4],
          },
          "className": 'copiar',
          "titleAttr": 'Copy'
      },
      {
          "extend":    'excelHtml5',
          "text":      '<i class="fa fa-file-excel-o"> Excel</i>',
          "exportOptions": {
            "columns": [0, 1, 3, 4],
          },
          "titleAttr": 'Excel'
      },
      {
          "extend":    'csvHtml5',
          "text":      '<i class="fa fa-file-text-o"> CSV</i>',
          "exportOptions": {
            "columns": [0, 1, 3, 4],
          },
          "titleAttr": 'CSV'
      },
      {
          "extend": 'pdf',
          "text": '<i class="fa fa-file-pdf-o"> PDF</i>',
          "exportOptions": {
            "columns": [0, 1, 3, 4],
          },
          "titleAttr": 'pdf'
      },
      {
          "extend": 'print',
          "text": '<i class="fa fa-print"> Imprimir</i>',
          "exportOptions": {
            "columns": [0, 1, 3, 4],
          },
          "titleAttr": 'print'
      },
      {
          "text": '<i class="fa fa-plus"> Nueva Historia</i>',
          action: function ( e, dt, node, config ) {
            location.href = './historia';
          },
          "titleAttr": 'Nueva Historia'
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


function verdetalle(id_historia_clinica) {
  $('#registro_historias').addClass('hidden');
  $('#detalle_historia').removeClass('hidden');
  listar_data_paciente(id_historia_clinica);
  listar_antecedentes_paciente(id_historia_clinica);
  listar_dientes_paciente(id_historia_clinica);
  listar_tratamiento_paciente(id_historia_clinica);
}

function listar_dientes_paciente(id_historia_clinica) {
  listarDientesBloque1(id_historia_clinica);
  listarDientesBloque2(id_historia_clinica);
  listarDientesBloque3(id_historia_clinica);
  listarDientesBloque4(id_historia_clinica);
  listarDientesBloque5(id_historia_clinica);
  listarDientesBloque6(id_historia_clinica);
  listarDientesBloque7(id_historia_clinica);
  listarDientesBloque8(id_historia_clinica);
}

function listarDientesBloque1(id_historia_clinica) {
  $.ajax({
    type: 'GET',
    url: '../model/registros.php',
    data: 'action=listar_dientes_bloque1&id_historia_clinica='+id_historia_clinica,
    beforeSend: function () {
      //$('#btn_login_auth').html('AUTENTICANDO...');
    },
    success: function (response) {
      var response = JSON.parse(response);
      var html = '';
      $.each(response, function(i, item) {
        html += '<td>'+
          '<span for="">'+response[i].numero+'</span><br>'+
          response[i].action+
        '</td>';
      });
      $("#tabla1").html(html);
    }
  });
}

function listarDientesBloque2(id_historia_clinica) {
  $.ajax({
    type: 'GET',
    url: '../model/registros.php',
    data: 'action=listar_dientes_bloque2&id_historia_clinica='+id_historia_clinica,
    beforeSend: function () {
      //$('#btn_login_auth').html('AUTENTICANDO...');
    },
    success: function (response) {
      var response = JSON.parse(response);
      var html = '<td></td><td></td><td></td>';
      $.each(response, function(i, item) {
        html += '<td>'+
          '<span for="">'+response[i].numero+'</span><br>'+
          response[i].action+
        '</td>';
      });
      $("#tabla2").html(html);
    }
  });
}

function listarDientesBloque3(id_historia_clinica) {
  $.ajax({
    type: 'GET',
    url: '../model/registros.php',
    data: 'action=listar_dientes_bloque3&id_historia_clinica='+id_historia_clinica,
    beforeSend: function () {
      //$('#btn_login_auth').html('AUTENTICANDO...');
    },
    success: function (response) {
      var response = JSON.parse(response);
      var html = '';
      $.each(response, function(i, item) {
        html += '<td>'+
          '<span for="">'+response[i].numero+'</span><br>'+
          response[i].action+
        '</td>';
      });
      $("#tabla3").html(html);
    }
  });
}

function listarDientesBloque4(id_historia_clinica) {
  $.ajax({
    type: 'GET',
    url: '../model/registros.php',
    data: 'action=listar_dientes_bloque4&id_historia_clinica='+id_historia_clinica,
    beforeSend: function () {
      //$('#btn_login_auth').html('AUTENTICANDO...');
    },
    success: function (response) {
      var response = JSON.parse(response);
      var html = '';
      $.each(response, function(i, item) {
        html += '<td>'+
          '<span for="">'+response[i].numero+'</span><br>'+
          response[i].action+
        '</td>';
      });
      html += '<td></td><td></td><td></td>';
      $("#tabla4").html(html);
    }
  });
}

function listarDientesBloque5(id_historia_clinica) {
  $.ajax({
    type: 'GET',
    url: '../model/registros.php',
    data: 'action=listar_dientes_bloque5&id_historia_clinica='+id_historia_clinica,
    beforeSend: function () {
      //$('#btn_login_auth').html('AUTENTICANDO...');
    },
    success: function (response) {
      var response = JSON.parse(response);
      var html = '<td></td><td></td><td></td>';
      $.each(response, function(i, item) {
        html += '<td>'+
        response[i].action+
          '<span for="">'+response[i].numero+'</span><br>'+
        '</td>';
      });
      $("#tabla5").html(html);
    }
  });
}

function listarDientesBloque6(id_historia_clinica) {
  $.ajax({
    type: 'GET',
    url: '../model/registros.php',
    data: 'action=listar_dientes_bloque6&id_historia_clinica='+id_historia_clinica,
    beforeSend: function () {
      //$('#btn_login_auth').html('AUTENTICANDO...');
    },
    success: function (response) {
      var response = JSON.parse(response);
      var html = '';
      $.each(response, function(i, item) {
        html += '<td>'+
        response[i].action+
          '<span for="">'+response[i].numero+'</span><br>'+
        '</td>';
      });
      $("#tabla6").html(html);
    }
  });
}

function listarDientesBloque7(id_historia_clinica) {
  $.ajax({
    type: 'GET',
    url: '../model/registros.php',
    data: 'action=listar_dientes_bloque7&id_historia_clinica='+id_historia_clinica,
    beforeSend: function () {
      //$('#btn_login_auth').html('AUTENTICANDO...');
    },
    success: function (response) {
      var response = JSON.parse(response);
      var html = '';
      $.each(response, function(i, item) {
        html += '<td>'+
        response[i].action+
          '<span for="">'+response[i].numero+'</span><br>'+
        '</td>';
      });
      $("#tabla7").html(html);
    }
  });
}

function listarDientesBloque8(id_historia_clinica) {
  $.ajax({
    type: 'GET',
    url: '../model/registros.php',
    data: 'action=listar_dientes_bloque8&id_historia_clinica='+id_historia_clinica,
    beforeSend: function () {
      //$('#btn_login_auth').html('AUTENTICANDO...');
    },
    success: function (response) {
      var response = JSON.parse(response);
      var html = '';
      $.each(response, function(i, item) {
        html += '<td>'+
        response[i].action+
          '<span for="">'+response[i].numero+'</span><br>'+
        '</td>';
      });
      $("#tabla8").html(html);
    }
  });
}

function listar_antecedentes_paciente(id_historia_clinica) {
  $.ajax({
    type: 'POST',
    url: '../model/registros.php?action=get_antecedentes_paciente',
    data: 'id_historia_clinica='+id_historia_clinica,
    beforeSend: function () {
      // body...
    },
    success: function (response) {
      var response = JSON.parse(response);
      var html = '';
      $.each(response, function(i, item) {
        html += '<div class="">'+
            '<div class="" style="width: 79%; display: inline-block;">'+
              '<p>'+response[i].nombre+'</p>'+
            '</div>'+
            '<div class="" style="width: 19%; display: inline-block;">'+response[i].action+'</div>'+
        '</div>';
      });
      html += '<div class="">'+
          '<div class="" style="width: 29%; display: inline-block;">'+
            '<p>OTROS</p>'+
          '</div>'+
          '<div class="" style="width: 69%; display: inline-block;">'+
            '<input type="text" name="otro_antecedente" id="otro_antecedente" class="form-control">'+
          '</div>'+
      '</div>';
      $("#antecedentes_patologicos").html(html);
    }
  })
}

function listar_data_paciente(id_historia_clinica) {
  $.ajax({
    type: 'POST',
    url: '../model/registros.php?action=get_data_paciente',
    data: 'id_historia_clinica='+id_historia_clinica,
    beforeSend: function () {
      // body...
    },
    success: function (response) {
      var response = JSON.parse(response);
      $('#fecha_documento').val(response[0].created_at);
      $('#nombre_paciente').val(response[0].nombre);
      $('#fecha_nacimiento_paciente').val(response[0].fecha_nacimiento);
      $('#edad_paciente').val(calcularEdadPaciente(response[0].fecha_nacimiento));
      $('#genero_paciente').val(response[0].id_genero);
      $('#id_estado_civil').val(response[0].id_estado_civil);
      $('#ubigeo_paciente').val(response[0].ubigeo);
      $('#ocupacion_paciente').val(response[0].ocupacion);
      $('#telefono_paciente').val(response[0].telefono);
      $('#direccion_paciente').val(response[0].direccion);
      $('#email_paciente').val(response[0].email);
      $('#apoderado_paciente').val(response[0].nombre_apoderado);
      $('#telefono_apoderado').val(response[0].telefono_apoderado);
      $('#diagnostico').val(response[0].diagnostico);
      $('#observaciones').val(response[0].observaciones);
    }
  })
}

function calcularEdadPaciente(fecha_nacimiento) {
    var fechaNace = new Date(fecha_nacimiento);
    var fechaActual = new Date()
    var mes = fechaActual.getMonth();
    var dia = fechaActual.getDate();
    var año = fechaActual.getFullYear();

    fechaActual.setDate(dia);
    fechaActual.setMonth(mes);
    fechaActual.setFullYear(año);

    edad = Math.floor(((fechaActual - fechaNace) / (1000 * 60 * 60 * 24) / 365));

    return edad;
}

$('#btn_volver_lista').click(function (e) {
  e.preventDefault();
  listarHistorias();
})

function listar_tratamiento_paciente(id_historia_clinica) {
  $.ajax({
      type: 'GET',
      url: '../model/registros.php',
      data: 'action=listar_tratamiento_paciente&id_historia_clinica='+id_historia_clinica,
      beforeSend: function () {
        //$('#btn_login_auth').html('AUTENTICANDO...');
      },
      success: function (response) {
        var response = JSON.parse(response);
        if (response[0].total_servicio != null) {
          var total_servicio = response[0].total_servicio;
        }else {
          var total_servicio = '';
        }

        var html = '';
        $.each(response, function(i, item) {
          html += '<tr style="border: hidden">'+
            '<td>'+
              '<input type="text" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid" readonly class="form-control" name="" value="'+response[i].nombre+'">'+
            '</td>'+
            '<td>'+
              '<input type="number" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid"  class="form-control" id="cantidad'+response[i].id_tratamiento+'" onkeyup="calcularCantidad('+response[i].id_tratamiento+')" name="" value="'+response[i].cantidad+'">'+
            '</td>'+
            '<td>'+
              '<input type="text" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid"  class="form-control" id="precio'+response[i].id_tratamiento+'" name="" value="'+response[i].precio+'">'+
            '</td>'+
            '<td>'+
              '<input type="text" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid"  class="form-control" id="total'+response[i].id_tratamiento+'" name="" value="'+response[i].total+'">'+
            '</td>'+
          '</tr>';
        });
        html += '<tr>'+
          '<td>'+
          '</td>'+
          '<td>'+
            '</td>'+
          '<td style="text-align: center">'+
            '<label style="margin-top: 10px">TOTAL</label>'+
          '</td>'+
          '<td>'+
            '<input type="text" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid"  class="form-control" id="total_servicio" name="" value="'+total_servicio+'">'+
          '</td>'+
        '</tr>';
        $("#table_tratamiento").html(html);
      }
    });
}