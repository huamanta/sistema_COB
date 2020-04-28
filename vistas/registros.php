<?php
require_once '../controller/seguridad.php';
$seguridad = new SeguridadApp();
if ($seguridad->sessionApp() == 0) {
  header('location: ../');
}
if (!$seguridad->premisosRegistrosHistorias()) {
  header('location: error-401');
  exit;
}
 ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Clínica Odontológica Bambamarca</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon1.png">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/sweetalert/sweetalert.css" rel="stylesheet">
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
    <!-- x-editor CSS
		============================================ -->
    <link rel="stylesheet" href="css/editor/select2.css">
    <link rel="stylesheet" href="css/editor/datetimepicker.css">
    <link rel="stylesheet" href="css/editor/bootstrap-editable.css">
    <link rel="stylesheet" href="css/editor/x-editor-style.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/style-datatables.css">

    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
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
                      <a href="principal.php"><img class="main-logo" src="img/logo/logo2.png" alt="" /></a>
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
                                                <input type="text" placeholder="Search..." class="search-int form-control">
                                                <a href="#"><i class="fa fa-search"></i></a>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <ul class="breadcome-menu">
                                            <li><a href="#">Home</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">Departments</span>
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
        <div class="product-status mg-b-15" id="registro_historias">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="sparkline13-list">
                          <div class="sparkline13-hd">
                              <div class="main-sparkline13-hd">
                                  <h1>Registro <span class="table-project-n"></span> Historias</h1>
                              </div>
                          </div>
                          <div class="sparkline13-graph">
                              <div class="table-responsive datatable-dashv1-list custom-datatable-overright">
                                  <table id="table_historias" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                      <thead>
                                          <tr>
                                              <th>#</th>
                                              <th>Creado</th>
                                              <th>Paciente</th>
                                              <th>Diagnostico</th>
                                              <th>Estado</th>
                                              <th>Acciones</th>
                                          </tr>
                                      </thead>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        <div class="product-status mg-b-15 hidden" id="detalle_historia">
          <div class="container-fluid">
                <div class="row">
                  <!--div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="sparkline13-list">
                            <div class="sparkline13-hd">
                              <div class="main-sparkline13-hd">
                                  <h1>Detalle <span class="table-project-n"></span> Historia Nº1</h1>

                              </div>
                          </div>
                        </div>
                    </div-->
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline8-list mt-b-30">
                            <div class="sparkline8-graph">
                                <div class="basic-login-form-ad">
                                    <div class="row">
                                        <form class="" id="form_add_historia" action="index.html" method="get">
                                          <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">

                                          </div>
                                          <div class="col-lg-10 col-md-10  col-sm-10 col-xs-12" style="color: #5d6e92; border: 1px #5d6e92 solid; margin-top: 10px"  id="printElement">
                                          <div class="col-md-12">
                                            <h3 style="text-align: center; margin-top: 10px">HISTORIA CLINICA</h3>
                                          </div>
                                          <div class="form-group col-md-9">
                                          <button class="btn btn-primary" id="btn_volver_lista" style="background: #23527c; border: 1px #23527c solid">ATRAS</button>
                                          </div>
                                          <div class="form-group col-md-3">
                                              <input name="fecha_documento" id="fecha_documento" type="text" class="form-control" placeholder="">
                                              <label class="pull-right" for="">FECHA/DATE</label>
                                          </div>
                                          <div class="col-md-12">
                                            <label for="">FICHA DE IDENTIFICACION</label>
                                          </div>
                                          <table class="table">
                                            <tbody>
                                              <tr>
                                                <td colspan="6">
                                                  <input name="nombre_paciente" id="nombre_paciente" type="text" class="form-control" placeholder="">
                                                  <label class="pull-right" for="">NOMBRE/NAME</label>
                                                </td>
                                                <td colspan="3">
                                                  <input name="fecha_nacimiento_paciente" id="fecha_nacimiento_paciente" type="text" class="form-control" placeholder="">
                                                  <label class="pull-right" for="">F. NACIMIENTO/BIRTHDAY</label>
                                                </td>
                                                <td colspan="3">
                                                  <input name="edad_paciente" id="edad_paciente" type="text" class="form-control" placeholder="">
                                                  <label class="pull-right" for="">EDAD/AGE</label>
                                                </td>
                                              </tr>
                                              <tr>
                                                <td colspan="3">
                                                  <select class="form-control" name="genero_paciente" id="genero_paciente">
                                                    <option value="" hidden selected>SELECCIONAR...</option>
                                                    <option value="1">M</option>
                                                    <option value="2">F</option>
                                                  </select>
                                                  <label class="pull-right" for="">SEXO/GENDER</label>
                                                </td>
                                                <td colspan="3">
                                                  <select class="form-control" name="id_estado_civil" id="id_estado_civil">
                                                    <option value="" hidden selected>SELECCIONAR...</option>
                                                    <option value="1">SOLTERO</option>
                                                    <option value="2">CASADO</option>
                                                  </select>
                                                    <label class="pull-right" for="">ESTADO CIVIL/CIVIL STATUS</label>
                                                </td>
                                                <td colspan="6">
                                                  <input name="ubigeo_paciente" id="ubigeo_paciente" type="text" class="form-control" placeholder="">
                                                  <label class="pull-right" for="">LUGAR DE NACIMIENTO/BIRTH PLACE</label>
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>

                                          <div class="form-group col-md-2">
                                          </div>
                                          <div class="form-group col-md-4">
                                          </div>
                                          <div class="form-group col-md-6">
                                          </div>
                                          <div class="form-group col-md-6">
                                              <input name="ocupacion_paciente" id="ocupacion_paciente" type="text" class="form-control" placeholder="">
                                              <label class="pull-right" for="">OCUPACION/OCUPATION</label>
                                          </div>
                                          <div class="form-group col-md-6">
                                              <input name="telefono_paciente" id="telefono_paciente" type="number" class="form-control" placeholder="">
                                              <label class="pull-right" for="">TELEFONO/PHONE</label>
                                          </div>
                                          <div class="form-group col-md-8">
                                              <input name="direccion_paciente" id="direccion_paciente" type="text" class="form-control" placeholder="">
                                              <label class="pull-right" for="">DIRECCION/ADDRES</label>
                                          </div>
                                          <div class="form-group col-md-4">
                                              <input name="email_paciente" id="email_paciente" type="text" class="form-control" placeholder="">
                                              <label class="pull-right" for="">CORREO ELECTRONICO/EMAIL</label>
                                          </div>
                                          <div class="col-md-12">
                                            <label for="">EN CASO DE EMERGENCIA LLAMAR A:</label>
                                          </div>
                                          <div class="form-group col-md-8">
                                              <input name="apoderado_paciente" id="apoderado_paciente" type="text" class="form-control" placeholder="">
                                              <label class="pull-right" for="">NOMBRE/NAME</label>
                                          </div>
                                          <div class="form-group col-md-4">
                                              <input name="telefono_apoderado" id="telefono_apoderado" type="text" class="form-control" placeholder="">
                                              <label class="pull-right" for="">TELEFONO/PHONE</label>
                                          </div>
                                          <div class="col-md-12">
                                            <label for="">ANTECEDENTES PATOLOGICOS</label>
                                          </div>
                                          <style media="screen">
                                          .antecedentes_patologicos>div {
                                            width: 33%;
                                            display: inline-block;
                                          }
                                          @media only screen and (max-width: 991px) {
                                            .antecedentes_patologicos>div {
                                              height: 85px;
                                            }                                           }
                                          }
                                          </style>
                                          <div class="col-md-12 antecedentes_patologicos" id="antecedentes_patologicos">

                                          </div>
                                          <div class="col-md-12">
                                            <label for="">ODONTOGRAMA</label>
                                          </div>
                                          <div class="col-md-12">
                                            <table  class="table table-responsive">
                                              <tbody>
                                                <tr style="border: hidden">
                                                  <td style="width: 45%"></td>
                                                  <td style="width: 10%">VESTIBULAR</td>
                                                  <td style="width: 55%"></td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="" style="width: 50%; float: right">
                                              <table class="" style="width: 100%; text-align: right">
                                                <tbody>
                                                  <tr style="border: hidden" id="tabla3">

                                                  </tr>
                                                  <tr style="border: hidden" id="tabla4">

                                                  </tr>
                                                </tbody>
                                              </table>
                                            </div>
                                            <div class="" style="width: 50%; border-right: 1px #ccc solid">
                                              <table class="" style="width: 100%">
                                                <tr style="border: hidden" id="tabla1">

                                                    </tr>
                                                <tr style="border: hidden" id="tabla2">

                                                  </tr>
                                              </table>
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <table  class="table table-responsive">
                                              <tbody>
                                                <tr style="border: hidden">
                                                  <td style="width: 10%">DERECHO</td>
                                                  <td style="width: 35%">
                                                    <hr>
                                                  </td>
                                                  <td style="width: 10%">LENGUALES</td>
                                                  <td style="width: 35%">
                                                    <hr>
                                                  </td>
                                                  <td>IZQUIERDO</td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </div>
                                          <div class="col-md-12" style="margin-top: -30px">
                                            <div class="" style="width: 50%; float: right">
                                              <table class="" style="width: 100%; text-align: right">
                                                <tbody>
                                                  <tr style="border: hidden" id="tabla7">

                                                </tr>
                                                <tr style="border: hidden" id="tabla8">

                                              </tr>
                                                </tbody>
                                              </table>
                                            </div>
                                            <div class="" style="width: 50%; border-right: 1px #ccc solid">
                                              <table class="" style="width: 100%;">
                                                <tbody>
                                                  <tr style="border: hidden" id="tabla5">

                                                </tr>
                                                  <tr style="border: hidden" id="tabla6">

                                                  </tr>
                                                </tbody>
                                              </table>
                                            </div>

                                          </div>

                                          <div class="form-group col-md-12">
                                            <label for="">DIAGNOSTICO</label>
                                            <textarea name="diagnostico" id="diagnostico"  style="border: 1px #5d6e92 solid" class="form-control" rows="1" cols="40"></textarea>
                                          </div>
                                          <div class="form-group col-md-12">
                                            <label for="">OBSERVACIONES</label>
                                            <textarea name="observaciones" id="observaciones"  style="border: 1px #5d6e92 solid" class="form-control" rows="1" cols="40"></textarea>
                                          </div>
                                          <div class="form-group col-md-12">
                                            <table class="table table-responsive">
                                              <thead style="background: #5d6e92; color: white">
                                                <tr>
                                                  <th>TRATAMIENTO</th>
                                                  <th>CANTIDAD</th>
                                                  <th>COSTO</th>
                                                  <th>TOTAL</th>
                                                </tr>
                                              </thead>
                                              <tbody id="table_tratamiento">
                                              </tbody>
                                            </table>
                                          </div>
                                          <div class="form-group col-md-12">
                                            <table class="table table-responsive">
                                              <thead style="background: #5d6e92; color: white">
                                                <tr>
                                                  <th>TRATAMIENTO</th>
                                                  <th>FECHA</th>
                                                  <th>A CUENTA</th>
                                                  <th>SALDO</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr  style="border: hidden">
                                                  <td>
                                                    <input type="text" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid"  class="form-control" name="" value="">
                                                  </td>
                                                  <td>
                                                    <input type="date" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid" class="form-control" name="" value="">
                                                  </td>
                                                  <td>
                                                    <input type="text" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid" class="form-control" name="" value="">
                                                  </td>
                                                  <td>
                                                    <input type="text" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid" class="form-control" name="" value="">
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </div>

                                        </div>
                                        <div class="col-md-12">
                                          <center>
                                            <input type="hidden" name="id_paciente" id="id_paciente" class="form-control" value="">
                                            <button class="btn btn-primary" type="submit" name="button" id="guardar_historia">Guardar</button>
                                            <button class="btn btn-success" type="button" name="button" id="printButton">Imprimir</button>
                                          </center>
                                        </div>
                                      </form>
                                    </div>
                                </div>
                            </div>
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


        <!-- jquery
    		============================================ -->
        <script src="js/vendor/jquery-1.12.4.min.js"></script>
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

        <!--  editable JS
    		============================================ -->
        <script src="js/editable/jquery.mockjax.js"></script>
        <script src="js/editable/mock-active.js"></script>
        <script src="js/editable/select2.js"></script>
        <script src="js/editable/moment.min.js"></script>
        <script src="js/editable/bootstrap-datetimepicker.js"></script>
        <script src="js/editable/bootstrap-editable.js"></script>
        <script src="js/editable/xediable-active.js"></script>
        <!-- Chart JS
    		============================================ -->
        <script src="js/chart/jquery.peity.min.js"></script>
          <script src="js/sweetalert/sweetalert.min.js"></script>
        <script src="js/peity/peity-active.js"></script>
        <!-- tab JS
    		============================================ -->
        <script src="js/tab.js"></script>
        <!-- plugins JS
    		============================================ -->
        <script src="js/plugins.js"></script>
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
        <!-- main JS
    		============================================ -->
        <script src="js/main.js"></script>
        <!-- paciente JS
    		============================================ -->
        <script src="ajax/registros.js"></script>

    <!-- tawk chat JS
		============================================ -->
    <!--<script src="js/tawk-chat.js"></script> -->
</body>

</html>                                                                                                                                                                                                                                                                                                                                                                                                                                     
