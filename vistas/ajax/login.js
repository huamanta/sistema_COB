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
        $("#message").html("<div class='alert alert-info alert-dismissible'>"+
                              "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"+
                              "<strong>Atencion! </strong>Sus credenciales de acceso han sido desactivados</div>");
        $("#ingresar").html('Ingresar');
      }else {
        $("#message").html("<div class='alert alert-danger alert-dismissible'>"+
                              "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"+
                              "<strong>Error! </strong>Las credenciales que ingresaste son incorrectas.</div>");
        $("#ingresar").html('Ingresar');
      }
    }
  })
});
