<?php
require_once '../controller/seguridad.php';
$seguridad = new SeguridadApp();
if ($seguridad->sessionApp() == 0) {
  header('location: ../');
}
if (!$seguridad->premisosNuevoPacientes()) {
  header('location: error-404');
  exit;
}
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Add Student | Kiaalap - Kiaalap Admin Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon1.png">
    <!-- Google Fonts
		============================================ -->
    <!-- Bootstrap CSS
		============================================ -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/owl.transitions.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- meanmenu icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="css/main.css">
    <!-- educate icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/educate-custon-icon.css">
    <!-- morrisjs CSS
		============================================ -->
    <link rel="stylesheet" href="css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
		============================================ -->
    <link rel="stylesheet" href="css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
		============================================ -->
    <link rel="stylesheet" href="css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="css/calendar/fullcalendar.print.min.css">
    <!-- forms CSS
		============================================ -->
    <link rel="stylesheet" href="css/form/all-type-forms.css">
    <!-- dropzone CSS
		============================================ -->
    <link rel="stylesheet" href="css/dropzone/dropzone.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr JS
		============================================ -->
</head>

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!-- Start Left menu area -->
    <?php include "fragments/menu.php"; ?>
    <!-- End Left menu area -->
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <a href="index.html"><img class="main-logo" src="img/logo/logo.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-advance-area">
            <?php include "fragments/header.php"; ?>
            <div class="breadcome-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcome-list single-page-breadcome">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="breadcome-heading">
                                            <form role="search" class="sr-input-func">
                                                <input type="text" placeholder="Search..." value="" class="search-int form-control">
                                                <a href="#"><i class="fa fa-search"></i></a>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <ul class="breadcome-menu">
                                            <li><a href="#">Home</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">Add Student</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Single pro tab review Start-->
        <div class="single-pro-review-area mt-t-30 mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-payment-inner-st">
                            <ul id="myTabedu1" class="tab-review-design">
                                <li class="active"><a href="#description">Información Básica</a></li>
                                <li><a href="#reviews">Información de contacto</a></li>
                                <li><a href="#INFORMATION"> Informacion de referencia</a></li>
                            </ul>
                            <style media="screen">
                               .invalid{
                                 color: red;
                               }
                            </style>
                            <form id="addPaciente" method="POST" >
                                <div id="myTabContent" class="tab-content custom-product-edit">

                                  <div class="row" id="div_id_paciente" >
                                    <?php if (isset($_POST['id_paciente']) && isset($_POST['id_persona'])) {
                                      ?>
                                        <input type="hidden" class="form-control" name="id_paciente" id="id_paciente" value="<?php echo $_POST['id_paciente']; ?>">
                                        <input type="hidden" class="form-control" name="id_persona" id="id_persona" value="<?php echo $_POST['id_persona']; ?>">

                                      <?php
                                    } ?>

                                    </div>
                                    <div class="product-tab-list tab-pane fade active in" id="description">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="review-content-section">
                                                    <div id="dropzone1" class="pro-ad">
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                                                  <div class="form-group">
                                                                      <select name="tipo_doc"id="tipo_doc" class="form-control">
                                                                          <option value="" selected="hidden" disabled="">Tipo Documento</option>
                                                                          <option value="1">DNI</option>
                                                                          <option value="2">PASSPORTE</option>
                                                                    </select>
                                                                  </div>
                                                                  <div class="form-group">
                                                                      <input name="numero_documento" id="numero_documento"type="number" class="form-control" placeholder="N° Documento" value="">
                                                                  </div>
                                                                    <div class="form-group">
                                                                        <input name="nombres" id="nombres" type="text" class="form-control" placeholder="Nombres" value="" >
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input name="apellidos" id="apellidos"type="text" class="form-control" placeholder="Apellidos" value="">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input name="direccion" id="direccion"type="text" class="form-control" placeholder="Direccion" value="">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input name="ocupacion" id="ocupacion"type="text" class="form-control" placeholder="Ocupación" value="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                  <div class="form-group">
                                                                    <select class="form-control" data-placeholder="Choose a Category" tabindex="1" id="departamento" name="departamento">

                                                                    </select>
                                                                  </div>
                                                                  <div class="form-group">
                                                                    <select class="form-control" data-placeholder="Choose a Category" tabindex="1" id="ubigeo" name="ubigeo">
                                                                        <option value="" hidden selected>Ubigeo</option>
                                                                        <option value="Bambamarca">Bambamarca</option>
                                                                        <option value="Chota">Chota</option>
                                                                        <option value="Tarapoto">Tarapoto</option>
                                                                    </select>
                                                                  </div>
                                                                  <div class="form-group">
                                                                      <input name="fecha_nacimiento" id="fecha_nacimiento" type="date" class="form-control" placeholder="Fecha Nacimiento" value="">
                                                                  </div>

                                                                    <div class="form-group">
                                                                      <select class="form-control" data-placeholder="Choose a Category" tabindex="1" id="genero" name="genero" >
                                                                          <option value="" hidden selected>Genero</option>
                                                                          <option value="1">Masculino</option>
                                                                          <option value="2">Femenino</option>
                                                                      </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                      <select class="form-control" data-placeholder="Choose a Category" tabindex="1" id="estado_civil" name="estado_civil">
                                                                          <option value="" hidden selected>Estado Civil</option>
                                                                          <option value="1">Soltero</option>
                                                                          <option value="2">Casado</option>
                                                                      </select>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-tab-list tab-pane fade" id="reviews">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="review-content-section">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="devit-card-custom">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="email"name="email"placeholder="Email" value="">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="number" class="form-control" id="telefono"name="telefono"placeholder="Telefono" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-tab-list tab-pane fade" id="INFORMATION">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="review-content-section">
                            												<div class="row">
                            													<div class="col-lg-12">
                            														<div class="devit-card-custom">
                            															<div class="form-group">
                            																<input type="text" class="form-control" name="nombre_apoderado" id="nombre_apoderado"placeholder="nombre apoderado">
                            															</div>
                                                          <div class="form-group">
                            																<input type="number" class="form-control" name="telefono_apoderado" id="telefono_apoderado"placeholder="Telefono apoderado">
                            															</div>
                                                    	</div>
                            													</div>
                            												</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="payment-adress">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">GUARDAR</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copyright-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="footer-copy-right">
                            <p>Copyright © 2018. All rights reserved. Template by <a href="https://colorlib.com/wp/templates/">Colorlib</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery/jquery.min.js"></script>
  <!-- Bootstrap tether Core JavaScript -->
  <script src="js/bootstrap/js/popper.min.js"></script>
  <script src="js/bootstrap/js/bootstrap.min.js"></script>
  <!-- slimscrollbar scrollbar JavaScript -->
  <script src="js/jquery.slimscroll.js"></script>
    <!-- jquery
		============================================ -->
    <!-- bootstrap JS
		============================================ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- wow JS
		============================================ -->
    <script src="js/wow.min.js"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="js/jquery-price-slider.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="js/jquery.meanmenu.js"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- sticky JS
		============================================ -->
    <script src="js/jquery.sticky.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/scrollbar/mCustomScrollbar-active.js"></script>
    <!-- metisMenu JS
		============================================ -->
    <script src="js/metisMenu/metisMenu.min.js"></script>
    <script src="js/metisMenu/metisMenu-active.js"></script>
    <!-- morrisjs JS
		============================================ -->
    <script src="js/sparkline/jquery.sparkline.min.js"></script>
    <script src="js/sparkline/jquery.charts-sparkline.js"></script>
    <!-- calendar JS
		============================================ -->
    <script src="js/calendar/moment.min.js"></script>
    <script src="js/calendar/fullcalendar.min.js"></script>
    <script src="js/calendar/fullcalendar-active.js"></script>
    <!-- maskedinput JS
		============================================ -->
    <script src="js/jquery.maskedinput.min.js"></script>
    <script src="js/masking-active.js"></script>
    <!-- datepicker JS
		============================================ -->
    <script src="js/datepicker/jquery-ui.min.js"></script>
    <script src="js/datepicker/datepicker-active.js"></script>
    <!-- form validate JS
		============================================ -->
    <script src="js/form-validation/jquery.form.min.js"></script>
    <script src="js/form-validation/jquery.validate.min.js"></script>
    <script src="js/form-validation/form-active.js"></script>
    <!-- dropzone JS
		============================================ -->
    <!-- tab JS
		============================================ -->
    <script src="js/tab.js"></script>
    <!-- data table JS
    ============================================ -->
    <script src="js/datatables/datatables.min.js"></script>
    <script src="js/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="js/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="js/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="js/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="js/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="js/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="js/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="js/datatables/datatables-init.js"></script>
    <!-- plugins JS
		============================================ -->
    <script src="js/plugins.js"></script>
    <!-- main JS
		============================================ -->
    <script src="js/main.js"></script>
    <script src="ajax/paciente.js"></script>

</body>

</html>
