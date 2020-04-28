listarDataLogin();
listarDataUser();
fotoPerfilUser();
mostrarFotoUser();

function listarDataLogin() {
	$.ajax({
		url: '../model/perfil.php?action=listar_data_login',
		type: 'POST',
		data: '',
		beforeSend: function () {
			// body...
		},
		success: function (response) {
			var response = JSON.parse(response);
      $('#admin-name').html(response[0].nombre);
		}
	});
}

function mostrarFotoUser() {
  $.ajax({
    url: '../model/perfil.php?action=mostrar_foto_user',
    type: 'POST',
    data: '',
    beforeSend: function () {
      // body...
    },
    success: function (response) {
      var response = JSON.parse(response);
      if (response != '') {
        $("#foto_perfil_img").attr("src","img/profile/"+response[0].foto_perfil);
      }else{
        $("#foto_perfil_img").attr("src","img/profile/default-user.png");
      }
    }
  });
}

function listarDataUser() {
	$.ajax({
		url: '../model/perfil.php?action=listar_data_user',
		type: 'POST',
		data: '',
		beforeSend: function () {
			// body...
		},
		success: function (response) {
			var response = JSON.parse(response);
			$('#nombre_user').html(response[0].nombre);
			$('#rol_user').html(response[0].rol);
		}
	});
}

$('#foto_perfil_usuario').click(function (e) {
	e.preventDefault();
	$('#PerfilModalalert').modal('show');
});

$('#btn_ver_foto').click(function (e) {
	$('#VerFotoModalalert').modal('show');
	$('#PerfilModalalert').modal('hide');
	var id_foto_perfil = $('#foto_perfil_input').val();
	$.ajax({
    	type: "POST",
    	url: '../model/perfil.php?action=list_data_foto_perfil',
    	data: 'id_foto_perfil='+id_foto_perfil, // serializes the form's elements.
    	success: function(response)
    	{
    		var response = JSON.parse(response);
        if(response != ''){
          $("#foto_perfil_large").attr("src","img/profile/"+response[0].nombre);
        }else{
          $("#foto_perfil_large").attr("src","");
        }
     	}
    });
})

$('#btn_eliminar_foto').click(function (e) {
	$('#PerfilModalalert').modal('hide');
	swal({
       title: "¿Eliminar foto?",
       text: "Podra volver a recuperar el registro desde la papelera",
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
        var id_foto_perfil = $('#foto_perfil_input').val();
        $.ajax({
        	type: "POST",
        	url: '../model/perfil.php?action=eliminar_foto_usuario',
        	data: 'id_foto_perfil='+id_foto_perfil, // serializes the form's elements.
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
                  fotoPerfilUser();
                  mostrarFotoUser();
            	}
         	}
        });
   });
})

function fotoPerfilUser() {
	$.ajax({
    	type: "POST",
    	url: '../model/perfil.php?action=foto_perfil_user',
    	data: '', // serializes the form's elements.
    	success: function(response)
    	{
        var response = JSON.parse(response);
    		if (response != '') {
          $("#foto_perfil_usuario").attr("src","img/profile/"+response[0].nombre);
          $('#foto_perfil_input').val(response[0].id_foto_perfil);
					$('#id-foto').val(response[0].id_foto_perfil);
    		}else{
          $("#foto_perfil_usuario").attr("src","img/profile/default-user.png");
    		}
     	}
    });
}

$('#btn_cambiar_foto').click(function (e) {
	e.preventDefault();
	$('#cambiarPerfilModalalert').modal('show');
	$('#PerfilModalalert').modal('hide');
	$("#file-1").val('');
  $('#uploadForm + img').remove();
	$('#label-file-1').removeClass('hidden');
	$('#btn_eliminar_perfil').addClass('hidden');
	$('#btn_guardar_perfil').addClass('hidden');
});

$('#form_add_perfil').submit(function (e) {
	e.preventDefault();
	var id_foto_perfil = $('#foto_perfil_input').val();
	$.ajax({
     type: "POST",
     url: '../model/perfil.php?action=add_imagen_prefil',
     data: new FormData(this), // serializes the form's elements.
     contentType: false,
     cache: false,
     processData:false,
		 beforeSend: function () {
		 	$('#btn_guardar_perfil').html('GUARDANDO');
		 },
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
					 $('#cambiarPerfilModalalert').modal('hide');
					 fotoPerfilUser();
					 mostrarFotoUser();
			 }else {
			 		$('#btn_guardar_perfil').html('GUARDAR');
			 }
     }
   });
})

$("#file-1").change(function () {
  filePreview(this);
});

function filePreview(input) {
	$('#label-file-1').addClass('hidden');
	$('#btn_eliminar_perfil').removeClass('hidden');
	$('#btn_guardar_perfil').removeClass('hidden');
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $('#uploadForm + img').remove();
        $('#uploadForm').after('<img src="'+e.target.result+'" width="450" height="300"/>');
    }
    reader.readAsDataURL(input.files[0]);
  }
}

$('#btn_eliminar_perfil').click(function (e) {
	e.preventDefault();
	$("#file-1").val('');
  $('#uploadForm + img').remove();
	$('#label-file-1').removeClass('hidden');
	$('#btn_eliminar_perfil').addClass('hidden');
	$('#btn_guardar_perfil').addClass('hidden');
})
