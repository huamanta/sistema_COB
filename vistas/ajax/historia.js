listarAntecedentesForSelected();
listarTratamientoTable();
listarDientes();
listarPagoTratamiento();

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


function print() {
$('#printButton').html('IMPRIMIR');
printJS({
  printable: 'printElement',
  type: 'html',
  targetStyles: ['*']
})
}

$('#printButton').click(function () {
  $('#printButton').html('IMPRIMIENDO');
  print();
})

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
        setTimeout(function () {
          var obj = $('#cantidad'+id_tratamiento),
          // Guardamos en una variable el contenido
          val = obj.val();
          // Ponemos el foco, limpiamos el contenido y volvemos a poner
          // nuevamente el mismo contenido
          obj.focus().val("").val(val);
          // Movemos el scroll
          obj.scrollTop(obj[0].scrollHeight);
        }, 1000);
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
        setTimeout(function () {
          var obj = $('#cantidad'+id_tratamiento),
          // Guardamos en una variable el contenido
          val = obj.val();
          // Ponemos el foco, limpiamos el contenido y volvemos a poner
          // nuevamente el mismo contenido
          obj.focus().val("").val(val);
          // Movemos el scroll
          obj.scrollTop(obj[0].scrollHeight);
        }, 1000);
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
        html += '<td>'+
          '<span for="">'+response[i].numero+'</span><br>'+
          response[i].action+
        '</td>';
      });
      $("#tabla1").html(html);
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
        html += '<td>'+
          '<span for="">'+response[i].numero+'</span><br>'+
          response[i].action+
        '</td>';
      });
      $("#tabla3").html(html);
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
        html += '<td>'+
        response[i].action+
          '<span for="">'+response[i].numero+'</span><br>'+
        '</td>';
      });
      $("#tabla6").html(html);
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
        html += '<td>'+
        response[i].action+
          '<span for="">'+response[i].numero+'</span><br>'+
        '</td>';
      });
      $("#tabla7").html(html);
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
        html += '<td>'+
        response[i].action+
          '<span for="">'+response[i].numero+'</span><br>'+
        '</td>';
      });
      $("#tabla8").html(html);
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
        $('#id_paciente').val(response[0].id_paciente);
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
      } else {
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

function eliminarDienteHistoria(id_diente) {
  $.ajax({
    type: 'POST',
    url: '../model/historia.php?action=eliminar_diente_historia',
    data: 'id_diente='+id_diente,
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

function eliminarAntecedenteHistoria(id_ant_patologico) {
  $.ajax({
    type: 'POST',
    url: '../model/historia.php?action=eliminar_antecedente_historia',
    data: 'id_ant_patologico='+id_ant_patologico,
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
  if ($('#id_paciente').val().length > 0) {
    $.ajax({
      type: 'POST',
      url: '../model/historia.php?action=procesar_historia_clinica',
      data: $(this).serialize(),
      beforeSend: function () {
        $('#guardar_historia').html('Procesando');
        $('#guardar_historia').attr('readonly', true);
      },
      success: function (response) {
        location.reload();
      }
    });
  }else {
    $("#message").html('<div class="alert alert-danger alert-mg-b alert-success-style4 alert-success-stylenone">'+
                            '<button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">'+
                '<span class="icon-sc-cl" aria-hidden="true">×</span>'+
              '</button>'+
              '<p class="message-alert-none"><strong>Atencion!</strong> Tiene que asignar un paciente a la historia clinica.</p>'+
                        '</div>');
  }
});

function listarPagoTratamiento() {
  $.ajax({
    type: 'GET',
    url: '../model/historia.php',
    data: 'action=listar_pago_tratamiento',
    beforeSend: function () {

    },
    success: function (response) {
      $('#data_pago_tratamiento').html(response);
    }
  });
}

function deletePagoTratamiento(id_tratamiento) {
  if($('#eliminar_registro_'+id_tratamiento).val().length == 0){
    $.ajax({
      type: 'POST',
      url: '../model/historia.php?action=delete_tratamiento',
      data: 'id_tratamiento='+id_tratamiento,
      success: function (response) {
        var jsonData = JSON.parse(response);
        if (jsonData.success == "1") {
          listarPagoTratamiento();
        }
      }
    });
  }
}

function searchTratamiento() {
  if($('#search_tratamiento').val().length > 0){
    var data = $('#search_tratamiento').val();
    $.ajax({
      type: 'POST',
      url: '../model/historia.php?action=search_tratamiento',
      data: 'query_search='+data,
      beforeSend: function () {
        $('#data_list').addClass('Cargando...');
      },
      success: function (response) {
        var response = JSON.parse(response);
        if(response.length > 0){
          $('#data_list').removeClass('hidden');
          var html = '';
          $.each(response, function (i, item) {
              html += '<li><a href="#" onclick="seleccionarTratamiento(event, '+response[i].id_tratamiento+')">'+response[i].nombre+'</a></li>';
          });
          $('#data_list').html(html);
        }else {
          $('#data_list').html('<li><a>No existe datos para: '+data+'</a></li>');
        }
      }
    })
  }else {
    $('#data_list').addClass('hidden');
  }
}


function seleccionarTratamiento(e, id_tratamiento) {
  e.preventDefault();
  $.ajax({
    type: 'POST',
    url: '../model/historia.php?action=add_tratamiento_pago',
    data: 'id_tratamiento='+id_tratamiento,
    beforeSend: function () {

    },
    success: function (response) {
      var jsonData = JSON.parse(response);
      if (jsonData.success == "1") {
        listarPagoTratamiento();
      }
    }
  });
}

function updateCuenta(id_tratamiento) {
  if ($('#cuenta_add'+id_tratamiento).val().length > 0 && $('#cuenta_add'+id_tratamiento).val() != 0) {
    var data = $('#cuenta_add'+id_tratamiento).val();
    $.ajax({
      type: 'POST',
      url: '../model/historia.php?action=update_cuenta',
      data: 'id_tratamiento='+id_tratamiento+'&data='+data,
      beforeSend: function () {

      },
      success: function (response) {
        var jsonData = JSON.parse(response);
        if (jsonData.success == "1") {
          listarPagoTratamiento();
          setTimeout(function () {
            var obj = $('#cuenta_add'+id_tratamiento),
            // Guardamos en una variable el contenido
            val = obj.val();
            // Ponemos el foco, limpiamos el contenido y volvemos a poner
            // nuevamente el mismo contenido
            obj.focus().val("").val(val);
            // Movemos el scroll
            obj.scrollTop(obj[0].scrollHeight);
          }, 1000);
        }else if (jsonData.success == "0"){
          listarPagoTratamiento();
        }
      }
    });
  }
}

function cambiarFechaRegistro(id_tratamiento) {
  var fecha_registro = $('#fecha_registro'+id_tratamiento).val();
  $.ajax({
    type: 'POST',
    url: '../model/historia.php?action=update_fecha_registro',
    data: 'id_tratamiento='+id_tratamiento+'&fecha_registro='+fecha_registro,
    beforeSend: function () {

    },
    success: function (response) {
      var jsonData = JSON.parse(response);
      if (jsonData.success == "1") {
        listarPagoTratamiento();
      }
    }
  });
}

$('#cancelar_historia').click(function () {
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
             url: '../model/historia.php?action=eliminar_historia_clinica',
             data: '', // serializes the form's elements.
             success: function(res)
             {
               var jsonData = JSON.parse(res);
               if (jsonData.success == "1"){
                 location.reload();
               }
             }
           });

      });
})
