
listarCitas();
function listarCitas() {
  $("#table_citas_wrapper").addClass('hidden');
	$("#table_citas").addClass('hidden');
	$("#calendar").removeClass('hidden');
	var todayDate = moment().startOf('day');
	var YM = todayDate.format('YYYY-MM');
	var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
	var TODAY = todayDate.format('YYYY-MM-DD');
	var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');
	var events = Array();
	$.ajax({
		url: '../model/citas.php?action=listar_citas_calendar',
    	type: "post",
    	data: '',
     	beforeSend: function() {
       		//$("#table_productos").html(".sdfsldf,sd");
     	},
     	success: function(response) {
       		var response = JSON.parse(response);
			$.each(response, function (i, item) {
				events.push(response[i]);
			});
       		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,listWeek'
			},
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			navLinks: true,
			backgroundColor: '#1f2e86',
			eventTextColor: '#1f2e86',
			textColor: '#378006',
			plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
	    	selectable: true,
	    	events:events,
			dayClick: function (date, jsEvent, view) {
	      		alert("Day Clicked");
	    	},
	    	eventClick: function (event) {
	  			$.ajax({
					url: '../model/citas.php?action=listar_cita_data',
			    	type: "post",
			    	data: 'id_cita='+event._id,
			     	beforeSend: function() {
			       		//$("#table_productos").html(".sdfsldf,sd");
			     	},
			     	success: function(response) {
			     		$('#PrimaryModalalert').modal('show');
              $('#btn_guardar_data').html('ACTUALIZAR');
              $('#titulo_modal_cita').html('EDITAR CITA');
			     		var response = JSON.parse(response);
	  					$('#div_id_cita').html('<div class="col-md-12">'
		            		+'<div class="form-group has-success">'
		                	+'<input type="text" id="id_cita" name="id_cita" class="form-control" value="'+response[0].id+'">'
		              		+'</div>'
		        			+'</div>');
		  				$('#nombre').val(response[0].title);
		  				$('#descripcion').val(response[0].descripcion);
		  				$('#date_start').val(response[0].date_start);
		  				$('#hour_start').val(response[0].hour_start);
		  				$('#date_end').val(response[0].date_end);
		  				$('#hour_end').val(response[0].hour_end);
		  				$('#color').val(response[0].color);
			     	},
			     	error: function(error) {
			       		console.log(error.responseText);
			     	}
				})
	        },
			select: function (date) {
				alert(date);
			}
			});
     	},
     	error: function(error) {
       		console.log(error.responseText);
     	}
	})
};

$('#nuevo_evento').click(function(e){
	e.preventDefault();
	$('#PrimaryModalalert').modal('show');
	$('#form_add_citas')[0].reset();
	$('#div_id_cita').html('');
  $('#btn_guardar_data').html('GUARDAR');
  $('#titulo_modal_cita').html('NUEVA CITA');
})

$('#form_add_citas').submit(function (e) {
	e.preventDefault();
	var data = $(this).serialize();
	$.ajax({
		url: '../model/citas.php?action=guardar_cita',
    	type: "post",
    	data: data,
     	beforeSend: function() {
       	$('#btn_guardar_data').html('PROCESANDO...');
     	},
     	success: function(response) {
     		var jsonData = JSON.parse(response);
        if (jsonData.success == "1") {
				  $('#PrimaryModalalert').modal('hide');
          listarCitas();
        }else{
          if ($('#titulo_modal_cita').html() === 'NUEVA CITA') {
            $('#btn_guardar_data').html('GUARDAR');
          }else{
            $('#btn_guardar_data').html('ACTUALIZAR');
          }
        }
     	},
     	error: function(error) {
       		console.log(e.responseText);
     	}
    })
})

$('#lista_eventos').click(function (e){
	e.preventDefault();
	$("#table_citas_wrapper").removeClass('hidden');
  $("#table_citas").removeClass('hidden');
	$("#calendar").addClass('hidden');
	listaTablaCitas();
});

function listaTablaCitas() {
	$("#table_citas").DataTable({
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
      }
  ],
   "ajax": {
     url: '../model/citas.php?action=listar_citas_tabla',
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

$('#lista_calendario').click(function (e) {
	e.preventDefault();
	$("#table_citas_wrapper").addClass('hidden');
  $("#table_citas").addClass('hidden');
	$("#calendar").removeClass('hidden');
});

function verDataCita(id_cita) {
	$.ajax({
		url: '../model/citas.php?action=listar_cita_data',
    	type: "post",
    	data: 'id_cita='+id_cita,
     	beforeSend: function() {
       		//$("#table_productos").html(".sdfsldf,sd");
     	},
     	success: function(response) {
     		$('#PrimaryModalalert').modal('show');
        $('#btn_guardar_data').html('ACTUALIZAR');
        $('#titulo_modal_cita').html('EDITAR CITA');
     		var response = JSON.parse(response);
				$('#div_id_cita').html('<div class="col-md-12">'
        		+'<div class="form-group has-success">'
            	+'<input type="text" id="id_cita" name="id_cita" class="form-control" value="'+response[0].id+'">'
          		+'</div>'
    			+'</div>');
				$('#nombre').val(response[0].title);
				$('#descripcion').val(response[0].descripcion);
				$('#date_start').val(response[0].date_start);
				$('#hour_start').val(response[0].hour_start);
				$('#date_end').val(response[0].date_end);
				$('#hour_end').val(response[0].hour_end);
				$('#color').val(response[0].color);
     	},
     	error: function(error) {
       		console.log(error.responseText);
     	}
	})
}

function eliminarcita(id_cita) {
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
              url: '../model/citas.php?action=eliminar_cita',
              data: 'id_cita='+id_cita, // serializes the form's elements.
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
                  listaTablaCitas();
                }
              }
            });

       });
 }

 $('#search_tratamiento').keyup(function (e) {
   e.preventDefault();
   if ($(this).val().length > 0) {
     $.ajax({
      url:"../model/citas.php?action=search_data_paciente",
      method:"POST",
      data: 'query='+$(this).val(),
      success:function(response)
      {
        var response = JSON.parse(response);
        if(response.length > 0){
          $('#data_list').removeClass('hidden');
          var html = '';
          $.each(response, function (i, item) {
              html += '<li><a href="#" onclick="seleccionarTratamiento()">'+response[i].primer_nombre+' '+response[i].segundo_nombre+' '+response[i].primer_apellido+' '+response[i].segundo_apellido+'</a></li>';
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
 });

$('#cliente').keyup(function (e) {
  e.preventDefault();
  var query = $(this).val();
  if ($(this).val().length > 0) {
    $.ajax({
      type: 'POST',
      url: '../model/citas.php?action=search_data_paciente',
      data: {query:query},
      beforeSend: function () {
        // body...
      },
      success: function (response) {
        var response = JSON.parse(response);
        var html = '';
        $.each(response, function (i, item) {
          html += '<li>'+response[i]+'<button class="btn btn-success">seleccionar</button></li>';
        })
        $('#ver_data_paciente').html(html);
      }
    });
  }else{
    $('#ver_data_paciente').html('');
  }
})

 $('#btn_agregar_paciente').click(function (e) {
   e.preventDefault();
   location.href = 'paciente';
 })
