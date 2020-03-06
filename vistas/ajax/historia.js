listarAntecedentesForSelected();
listarTratamientoTable();
listarDientes();

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
var date = mm + "/" + dd + "/" + yyyy;




$('#fecha_documento').val(date);
$('.input-group-append').html('');

$('#fecha_nacimiento_paciente').change(function () {
  var fechaNace = new Date($(this).val());
    var fechaActual = new Date()

    var mes = fechaActual.getMonth();
    var dia = fechaActual.getDate();
    var año = fechaActual.getFullYear();

    fechaActual.setDate(dia);
    fechaActual.setMonth(mes);
    fechaActual.setFullYear(año);

    edad = Math.floor(((fechaActual - fechaNace) / (1000 * 60 * 60 * 24) / 365));

    $('#edad_paciente').val(edad);
})

$('#fecha_nacimiento_paciente').keyup(function () {
  var fechaNace = new Date($(this).val());
    var fechaActual = new Date()

    var mes = fechaActual.getMonth();
    var dia = fechaActual.getDate();
    var año = fechaActual.getFullYear();

    fechaActual.setDate(dia);
    fechaActual.setMonth(mes);
    fechaActual.setFullYear(año);

    edad = Math.floor(((fechaActual - fechaNace) / (1000 * 60 * 60 * 24) / 365));

    $('#edad_paciente').val(edad);
})


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
                  '<input type="checkbox" value="" '+response[i].action+'>'+
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
          '<input type="text" name="otro_antecedente" id="otro_antecedente" class="form-control">'+
        '</div>'+
      '</div>';
      $("#antecedentes_patologicos").html(html);
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
        if (response[0].total_servicio != null) {
          var total_servicio = response[0].total_servicio;
        }else {
          var total_servicio = '';
        }

        var html = '';
        $.each(response, function(i, item) {
          html += '<tr>'+
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

function calcularCantidad(id_tratamiento) {
  if ($('#cantidad'+id_tratamiento).val().length > 0) {
    var precio = $('#precio'+id_tratamiento).val();
    var cantidad = $('#cantidad'+id_tratamiento).val();
    $.ajax({
      type: 'POST',
      url: '../model/historia.php?action=agregar_tratamiento_table',
      data: 'id_tratamiento='+id_tratamiento+'&precio='+precio+'&cantidad='+cantidad,
      beforeSend: function () {
        //$('#btn_login_auth').html('AUTENTICANDO...');
      },
      success: function (response) {
        listarTratamientoTable();
      }
    });
  }else {
    $.ajax({
      type: 'POST',
      url: '../model/historia.php?action=eliminar_tratamiento_table',
      data: 'id_tratamiento='+id_tratamiento,
      beforeSend: function () {
        //$('#btn_login_auth').html('AUTENTICANDO...');
      },
      success: function (response) {
        listarTratamientoTable();
      }
    });
  }

}


function listarDientes() {
  listarDientesBloque1();
  listarDientesBloque2();
  listarDientesBloque3();
  listarDientesBloque4();
  listarDientesBloque5();
  listarDientesBloque6();
  listarDientesBloque7();
  listarDientesBloque8();
}

function listarDientesBloque1() {
  $.ajax({
    type: 'GET',
    url: '../model/historia.php',
    data: 'action=listar_dientes_bloque1',
    beforeSend: function () {
      //$('#btn_login_auth').html('AUTENTICANDO...');
    },
    success: function (response) {
      var response = JSON.parse(response);
      var html = '';
      $.each(response, function(i, item) {
        html += '<div class="col-md-1" style="width: 12.5%; text-align: center">'+
          '<label for="">'+response[i].numero+'</label>'+
          response[i].action+
          '</div>';
      });
      $("#bloque1").html(html);
    }
  });
}

function listarDientesBloque2() {
  $.ajax({
    type: 'GET',
    url: '../model/historia.php',
    data: 'action=listar_dientes_bloque2',
    beforeSend: function () {
      //$('#btn_login_auth').html('AUTENTICANDO...');
    },
    success: function (response) {
      var response = JSON.parse(response);
      var html = '<div class="col-md-4"></div>';
      $.each(response, function(i, item) {
        html += '<div class="col-md-1" style="width: 13.333%; text-align: center">'+
          '<label for="">'+response[i].numero+'</label>'+
          response[i].action+
          '</div>';
      });
      $("#bloque2").html(html);
    }
  });
}

function listarDientesBloque3() {
  $.ajax({
    type: 'GET',
    url: '../model/historia.php',
    data: 'action=listar_dientes_bloque3',
    beforeSend: function () {
      //$('#btn_login_auth').html('AUTENTICANDO...');
    },
    success: function (response) {
      var response = JSON.parse(response);
      var html = '';
      $.each(response, function(i, item) {
        html += '<div class="col-md-1" style="width: 12.5%; text-align: center">'+
          '<label for="">'+response[i].numero+'</label>'+
          response[i].action+
          '</div>';
      });
      $("#bloque3").html(html);
    }
  });
}

function listarDientesBloque4() {
  $.ajax({
    type: 'GET',
    url: '../model/historia.php',
    data: 'action=listar_dientes_bloque4',
    beforeSend: function () {
      //$('#btn_login_auth').html('AUTENTICANDO...');
    },
    success: function (response) {
      var response = JSON.parse(response);
      var html = '';
      $.each(response, function(i, item) {
        html += '<div class="col-md-1" style="width: 13.333%; text-align: center">'+
          '<label for="">'+response[i].numero+'</label>'+
          response[i].action+
          '</div>';
      });
      html += '<div class="col-md-4"></div>';
      $("#bloque4").html(html);
    }
  });
}

function listarDientesBloque5() {
  $.ajax({
    type: 'GET',
    url: '../model/historia.php',
    data: 'action=listar_dientes_bloque5',
    beforeSend: function () {
      //$('#btn_login_auth').html('AUTENTICANDO...');
    },
    success: function (response) {
      var response = JSON.parse(response);
      var html = '<div class="col-md-4"></div>';
      $.each(response, function(i, item) {
        html += '<div class="col-md-1" style="width: 13.333%; text-align: center">'+
          '<label for="">'+response[i].numero+'</label>'+
          response[i].action+
          '</div>';
      });
      $("#bloque5").html(html);
    }
  });
}

function listarDientesBloque6() {
  $.ajax({
    type: 'GET',
    url: '../model/historia.php',
    data: 'action=listar_dientes_bloque6',
    beforeSend: function () {
      //$('#btn_login_auth').html('AUTENTICANDO...');
    },
    success: function (response) {
      var response = JSON.parse(response);
      var html = '';
      $.each(response, function(i, item) {
        html += '<div class="col-md-1" style="width: 12.5%; text-align: center">'+
          '<label for="">'+response[i].numero+'</label>'+
          response[i].action+
          '</div>';
      });
      $("#bloque6").html(html);
    }
  });
}

function listarDientesBloque7() {
  $.ajax({
    type: 'GET',
    url: '../model/historia.php',
    data: 'action=listar_dientes_bloque7',
    beforeSend: function () {
      //$('#btn_login_auth').html('AUTENTICANDO...');
    },
    success: function (response) {
      var response = JSON.parse(response);
      var html = '';
      $.each(response, function(i, item) {
        html += '<div class="col-md-1" style="width: 13.333%; text-align: center">'+
          '<label for="">'+response[i].numero+'</label>'+
          response[i].action+
          '</div>';
      });
      html += '<div class="col-md-4"></div>';
      $("#bloque7").html(html);
    }
  });
}

function listarDientesBloque8() {
  $.ajax({
    type: 'GET',
    url: '../model/historia.php',
    data: 'action=listar_dientes_bloque8',
    beforeSend: function () {
      //$('#btn_login_auth').html('AUTENTICANDO...');
    },
    success: function (response) {
      var response = JSON.parse(response);
      var html = '';
      $.each(response, function(i, item) {
        html += '<div class="col-md-1" style="width: 12.5%; text-align: center">'+
          '<label for="">'+response[i].numero+'</label>'+
          response[i].action+
          '</div>';
      });
      $("#bloque8").html(html);
    }
  });
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
        $('#nombre_paciente').val(response[0].primer_nombre+' '+response[0].segundo_nombre+' '+response[0].primer_apellido+' '+response[0].segundo_apellido);
        $('#fecha_nacimiento_paciente').val(response[0].fecha_nacimiento);
        $('#edad_paciente').val(response[0].edad);
        $('#genero_paciente').val(response[0].id_genero);
        $('#id_estado_civil').val(response[0].id_estado_civil);
        $('#ubigeo_paciente').val(response[0].ubigeo);
        $('#ocupacion_paciente').val(response[0].ocupacion);
        $('#telefono_paciente').val(response[0].telefono);
        $('#direccion_paciente').val(response[0].direccion);
        $('#email_paciente').val(response[0].email);
        $('#apoderado_paciente').val(response[0].nombre_apoderado);
        $('#telefono_apoderado').val(response[0].telefono_apoderado);
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
        $('#apoderado_paciente').val('');
        $('#telefono_apoderado').val('');
      }
    }
    })
});

function agregarDienteHistoria(id_diente) {
  $.ajax({
    type: 'POST',
    url: '../model/historia.php?action=agregar_diente_historia',
    data: 'id_diente='+id_diente,
    beforeSend: function () {
      //$('#btn_login_auth').html('AUTENTICANDO...');
    },
    success: function (response) {
      listarDientes();
    }
  })
}

function eliminarDienteHistoria(id_detalle_historia) {
  $.ajax({
    type: 'POST',
    url: '../model/historia.php?action=eliminar_diente_historia',
    data: 'id_detalle_historia='+id_detalle_historia,
    beforeSend: function () {
      //$('#btn_login_auth').html('AUTENTICANDO...');
    },
    success: function (response) {
      listarDientes();
    }
  })
}

function agregarAntecedenteHistoria(id_ant_patologico) {
  $.ajax({
    type: 'POST',
    url: '../model/historia.php?action=agregar_antecedente_historia',
    data: 'id_ant_patologico='+id_ant_patologico,
    beforeSend: function () {
      //$('#btn_login_auth').html('AUTENTICANDO...');
    },
    success: function (response) {
      listarAntecedentesForSelected();
    }
  })
}

function eliminarAntecedenteHistoria(id_detalle_historia) {
  $.ajax({
    type: 'POST',
    url: '../model/historia.php?action=eliminar_antecedente_historia',
    data: 'id_detalle_historia='+id_detalle_historia,
    beforeSend: function () {
      //$('#btn_login_auth').html('AUTENTICANDO...');
    },
    success: function (response) {
      listarAntecedentesForSelected();
    }
  })
}

$('#form_add_historia').submit(function (e) {
  e.preventDefault();
  console.log($(this).serialize());
});
