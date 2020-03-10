$('#loginForm').submit(function (e) {
  e.preventDefault();
  $.ajax({
    type: 'POST',
    url: 'model/login.php?action=auth_user',
    data: $(this).serialize(),
    beforeSend: function () {
      $('#btn_login_auth').html('AUTENTICANDO...');
    },
    success: function (response) {
      $('#btn_login_auth').html('INGRESAR');
      var jsonData = JSON.parse(response);
      if (jsonData.success == "1") {
          location.href = 'vistas/principal';
      }else if (jsonData.success == "2"){
        $("#message").html('<div class="alert alert-info alert-mg-b alert-success-style4 alert-success-stylenone">'+
                                '<button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">'+
										'<span class="icon-sc-cl" aria-hidden="true">×</span>'+
									'</button>'+
                  '<p class="message-alert-none"><strong>Danger!</strong> A dangerous negative action.</p>'+
                            '</div>');
        $("#ingresar").html('Ingresar');
      }else {
        $("#message").html('<div class="alert alert-danger alert-mg-b alert-success-style4 alert-success-stylenone">'+
                                '<button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">'+
										'<span class="icon-sc-cl" aria-hidden="true">×</span>'+
									'</button>'+
                  '<p class="message-alert-none"><strong>Danger!</strong> A dangerous negative action.</p>'+
                            '</div>');
        $("#ingresar").html('Ingresar');
      }
    }
  })
});
