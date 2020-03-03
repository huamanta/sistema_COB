<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Basic Form Element | Kiaalap - Kiaalap Admin Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
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
    <!-- modals CSS
		============================================ -->
    <link rel="stylesheet" href="css/modals.css">
    <!-- forms CSS
		============================================ -->
    <link rel="stylesheet" href="css/form/all-type-forms.css">
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
                                            <input type="text" placeholder="Search..." class="search-int form-control">
                                            <a href="#"><i class="fa fa-search"></i></a>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <ul class="breadcome-menu">
                                        <li><a href="#">Home</a> <span class="bread-slash">/</span>
                                        </li>
                                        <li><span class="bread-blod" onclick="printDiv()">Add Professor</span>
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
        <!-- Basic Form Start -->
        <div class="basic-form-area mg-b-15" id="imprimir">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline8-list mt-b-30">
                            <div class="sparkline8-graph">
                                <div class="basic-login-form-ad">
                                    <div class="row">
                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12" style="color: #5d6e92; border: 1px #5d6e92 solid; margin-top: 10px">
                                          <div class="col-md-12">
                                            <h3 style="text-align: center; margin-top: 10px">ODONTOGRAMA</h3>
                                          </div>
                                          <div class="form-group col-md-9">
                                          </div>
                                          <div class="form-group col-md-3">
                                              <input name="fecha_documento" id="fecha_documento" type="date" class="form-control" placeholder="">
                                              <label class="pull-right" for="">FECHA/DATE</label>
                                          </div>
                                          <div class="col-md-12">
                                            <label for="">FICHA DE IDENTIFICACION</label>
                                          </div>
                                          <div class="form-group col-md-7">
                                              <input name="nombre_paciente" id="nombre_paciente" type="tex" class="form-control" placeholder="">
                                              <label class="pull-right" for="">NOMBRE/NAME</label>
                                          </div>
                                          <div class="form-group col-md-3">
                                              <input name="fecha_nacimiento_paciente" id="fecha_nacimiento_paciente" type="date" class="form-control" placeholder="">
                                              <label class="pull-right" for="">F. NACIMIENTO/BIRTHDAY</label>
                                          </div>
                                          <div class="form-group col-md-2">
                                              <input name="edad_paciente" id="edad_paciente" type="text" class="form-control" placeholder="">
                                              <label class="pull-right" for="">EDAD/AGE</label>
                                          </div>

                                          <div class="form-group col-md-2">
                                              <select class="form-control" name="genero_paciente" id="genero_paciente">
                                                <option value="" hidden selected>SELECCIONAR...</option>
                                                <option value="1">M</option>
                                                <option value="2">F</option>
                                              </select>
                                              <label class="pull-right" for="">SEXO/GENDER</label>
                                          </div>
                                          <div class="form-group col-md-4">
                                            <select class="form-control" name="id_estado_civil" id="id_estado_civil">
                                              <option value="" hidden selected>SELECCIONAR...</option>
                                              <option value="1">SOLTERO</option>
                                              <option value="2">CASADO</option>
                                            </select>
                                              <label class="pull-right" for="">ESTADO CIVIL/CIVIL STATUS</label>
                                          </div>
                                          <div class="form-group col-md-6">
                                              <input name="ubigeo_paciente" id="ubigeo_paciente" type="text" class="form-control" placeholder="">
                                              <label class="pull-right" for="">LUGAR DE NACIMIENTO/BIRTH PLACE</label>
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
                                              <input name="" id="" type="text" class="form-control" placeholder="">
                                              <label class="pull-right" for="">NOMBRE/NAME</label>
                                          </div>
                                          <div class="form-group col-md-4">
                                              <input name="" id="" type="text" class="form-control" placeholder="">
                                              <label class="pull-right" for="">TELEFONO/PHONE</label>
                                          </div>

    <style media="screen">
    .checkbox label:after,
.radio label:after {
    content: '';
    display: table;
    clear: both;
}

.checkbox .cr,
.radio .cr {
    position: relative;
    display: inline-block;
    border: 1px solid #a9a9a9;
    border-radius: .25em;
    width: 1.3em;
    height: 1.3em;
    float: left;
    margin-right: .5em;
}

.radio .cr {
    border-radius: 50%;
}

.checkbox .cr .cr-icon,
.radio .cr .cr-icon {
    position: absolute;
    font-size: .8em;
    line-height: 0;
    top: 50%;
    left: 20%;
}

.radio .cr .cr-icon {
    margin-left: 0.04em;
}

.checkbox label input[type="checkbox"],
.radio label input[type="radio"] {
    display: none;
}

.checkbox label input[type="checkbox"] + .cr > .cr-icon,
.radio label input[type="radio"] + .cr > .cr-icon {
    transform: scale(3) rotateZ(-20deg);
    opacity: 0;
    transition: all .3s ease-in;
}

.checkbox label input[type="checkbox"]:checked + .cr > .cr-icon,
.radio label input[type="radio"]:checked + .cr > .cr-icon {
    transform: scale(1) rotateZ(0deg);
    opacity: 1;
}

.checkbox label input[type="checkbox"]:disabled + .cr,
.radio label input[type="radio"]:disabled + .cr {
    opacity: .5;
}
    </style>
                                          <div class="col-md-12">
                                            <label for="">ANTECEDENTES PATOLOGICOS</label>
                                          </div>
                                          <div class="col-md-12" id="antecedentes_patologicos">

                                          </div>

                                          <div class="col-md-12">
                                            <label for="">ODONTOGRAMA</label>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="col-md-6" style="border-right: 1px #ccc solid">
                                              <div class="col-md-12">
                                                <div class="col-md-1" style="width: 8.33333333%;">
                                                </div>
                                                <div class="col-md-1" style="width: 8.33333333%;">
                                                </div>
                                                <div class="col-md-1" style="width: 8.33333333%;">
                                                </div>
                                                <div class="col-md-1" style="width: 8.33333333%;">
                                                </div>
                                                <div class="col-md-1" style="width: 8.33333333%;">
                                                  <label for="">18</label>
                                                  <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                </div>
                                                <div class="col-md-1" style="width: 8.33333333%;">
                                                  <label for="">17</label>
                                                  <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                </div>
                                                <div class="col-md-1" style="width: 8.33333333%;">
                                                  <label for="">16</label>
                                                  <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                </div>
                                                <div class="col-md-1" style="width: 8.33333333%;">
                                                  <label for="">15</label>
                                                  <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                </div>
                                                <div class="col-md-1" style="width: 8.33333333%;">
                                                  <label for="">14</label>
                                                  <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                </div>
                                                <div class="col-md-1" style="width: 8.33333333%;">
                                                  <label for="">13</label>
                                                  <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                </div>
                                                <div class="col-md-1" style="width: 8.33333333%;">
                                                  <label for="">12</label>
                                                  <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                </div>
                                                <div class="col-md-1" style="width: 8.33333333%;">
                                                  <label for="">11</label>
                                                  <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                </div>
                                              </div>
                                              <div class="col-md-12" style="margin-top: 10px">
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                  <label for="">55</label>
                                                  <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                </div>
                                                <div class="col-md-1">
                                                  <label for="">54</label>
                                                  <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                </div>
                                                <div class="col-md-1">
                                                  <label for="">53</label>
                                                  <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                </div>
                                                <div class="col-md-1">
                                                  <label for="">52</label>
                                                  <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                </div>
                                                <div class="col-md-1">
                                                  <label for="">51</label>
                                                  <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="col-md-12">
                                                <div class="col-md-1">
                                                  <label for="">21</label>
                                                  <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                </div>
                                                <div class="col-md-1">
                                                  <label for="">22</label>
                                                  <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                </div>
                                                <div class="col-md-1">
                                                  <label for="">23</label>
                                                  <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                </div>
                                                <div class="col-md-1">
                                                  <label for="">24</label>
                                                  <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                </div>
                                                <div class="col-md-1">
                                                  <label for="">25</label>
                                                  <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                </div>
                                                <div class="col-md-1">
                                                  <label for="">26</label>
                                                  <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                </div>
                                                <div class="col-md-1">
                                                  <label for="">27</label>
                                                  <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                </div>
                                                <div class="col-md-1">
                                                  <label for="">28</label>
                                                  <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>

                                              </div>
                                              <div class="col-md-12" style="margin-top: 10px">

                                                <div class="col-md-1">
                                                  <label for="">61</label>
                                                  <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                </div>
                                                <div class="col-md-1">
                                                  <label for="">62</label>
                                                  <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                </div>
                                                <div class="col-md-1">
                                                  <label for="">63</label>
                                                  <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                </div>
                                                <div class="col-md-1">
                                                  <label for="">64</label>
                                                  <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                </div>
                                                <div class="col-md-1">
                                                  <label for="">65</label>
                                                  <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="col-md-2">
                                            </div>
                                            <div class="col-md-1">
                                              <label for="">DERECHO</label>
                                            </div>
                                            <div class="col-md-2">
                                              <hr>
                                            </div>
                                            <div class="col-md-2" style="text-align: center">
                                              <label for="">LENGUALES</label>
                                            </div>
                                            <div class="col-md-2">
                                              <hr>
                                            </div>
                                            <div class="col-md-2">
                                              <label for="">IZQUIERDO</label>
                                            </div>
                                            <div class="col-md-1">
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="col-md-6" style="border-right: 1px #ccc solid">

                                              <div class="col-md-12">
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                  <label for="">85</label>
                                                </div>
                                                <div class="col-md-1">
                                                <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                  <label for="">84</label>
                                                </div>
                                                <div class="col-md-1">
                                                <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                  <label for="">83</label>
                                                </div>
                                                <div class="col-md-1">
                                                <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                  <label for="">82</label>
                                                </div>
                                                <div class="col-md-1">
                                                <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                  <label for="">81</label>
                                                </div>
                                              </div>
                                              <div class="col-md-12" style="margin-top: 10px">
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                  <label for="">48</label>
                                                </div>
                                                <div class="col-md-1">
                                                <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                  <label for="">47</label>
                                                </div>
                                                <div class="col-md-1">
                                                <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                  <label for="">46</label>
                                                </div>
                                                <div class="col-md-1">
                                                <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                  <label for="">45</label>
                                                </div>
                                                <div class="col-md-1">
                                                <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                  <label for="">44</label>
                                                </div>
                                                <div class="col-md-1">
                                                <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                  <label for="">43</label>
                                                </div>
                                                <div class="col-md-1">
                                                <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                  <label for="">42</label>
                                                </div>
                                                <div class="col-md-1">
                                                <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                  <label for="">41</label>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="col-md-12">

                                                <div class="col-md-1">
                                                <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                  <label for="">71</label>
                                                </div>
                                                <div class="col-md-1">
                                                <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                  <label for="">72</label>
                                                </div>
                                                <div class="col-md-1">
                                                <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                  <label for="">73</label>
                                                </div>
                                                <div class="col-md-1">
                                                <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                  <label for="">74</label>
                                                </div>
                                                <div class="col-md-1">
                                                <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                  <label for="">75</label>
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                              </div>
                                              <div class="col-md-12" style="margin-top: 10px">
                                                <div class="col-md-1">
                                                  <i class="fa fa-close" style="font-size: 25px; color: #006df0; position: absolute; left: 18px;"></i>
                                                <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                  <label for="">31</label>
                                                </div>
                                                <div class="col-md-1">
                                                <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                  <label for="">32</label>
                                                </div>
                                                <div class="col-md-1">
                                                <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                  <label for="">33</label>
                                                </div>
                                                <div class="col-md-1">
                                                  <i class="fa fa-close" style="font-size: 25px; color: #006df0; position: absolute; left: 18px;"></i>
                                                <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                  <label for="">34</label>
                                                </div>
                                                <div class="col-md-1">
                                                <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                  <label for="">35</label>
                                                </div>
                                                <div class="col-md-1">
                                                  <i class="fa fa-close" style="font-size: 25px; color: #006df0; position: absolute; left: 18px;"></i>
                                                  <i class="fa fa-life-ring" style="font-size: 25px;"></i>
                                                  <label for="">36</label>
                                                </div>
                                                <div class="col-md-1">
                                                <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                  <label for="">37</label>
                                                </div>
                                                <div class="col-md-1">
                                                <i class="fa fa-life-ring" style="font-size: 25px"></i>
                                                  <label for="">38</label>
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-1">
                                                </div>

                                              </div>
                                            </div>
                                          </div>

                                          <div class="form-group col-md-12">
                                            <label for="">DIAGNOSTICO</label>
                                            <textarea name="name"  style="border: 1px #5d6e92 solid" class="form-control" rows="1" cols="40"></textarea>
                                          </div>
                                          <div class="form-group col-md-12">
                                            <label for="">OBSERVACIONES</label>
                                            <textarea name="name"  style="border: 1px #5d6e92 solid" class="form-control" rows="1" cols="40"></textarea>
                                          </div>
                                          <div class="form-group col-md-12">
                                            <table class="table">
                                              <thead style="background: #5d6e92; color: white">
                                                <tr>
                                                  <th>TRATAMIENTO</th>
                                                  <th>CANTIDAD</th>
                                                  <th>COSTO</th>
                                                  <th>TOTAL</th>
                                                </tr>
                                              </thead>
                                              <tbody id="table_tratamiento">
                                                <tr>
                                                  <td>
                                                    <input type="text" class="form-control" name="" value="">
                                                  </td>
                                                  <td>
                                                    <input type="text" class="form-control" name="" value="">
                                                  </td>
                                                  <td>
                                                    <input type="text" class="form-control" name="" value="">
                                                  </td>
                                                  <td>
                                                    <input type="text" class="form-control" name="" value="">
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </div>
                                          <div class="form-group col-md-12">
                                            <table class="table">
                                              <thead style="background: #5d6e92; color: white">
                                                <tr>
                                                  <th>TRATAMIENTO</th>
                                                  <th>FECHA</th>
                                                  <th>A CUENTA</th>
                                                  <th>SALDO</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr>
                                                  <td>
                                                    <input type="text" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid" readonly class="form-control" name="" value="">
                                                  </td>
                                                  <td>
                                                    <input type="text" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid" class="form-control" name="" value="">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Basic Form End-->
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
    <!-- tab JS
		============================================ -->
    <script src="js/tab.js"></script>
    <!-- icheck JS
		============================================ -->
    <script src="js/icheck/icheck.min.js"></script>
    <script src="js/icheck/icheck-active.js"></script>
    <!-- plugins JS
		============================================ -->
    <script src="js/plugins.js"></script>
    <!-- main JS
		============================================ -->
    <script src="js/main.js"></script>
    <!-- historia JS
		============================================ -->
    <script src="ajax/historia.js"></script>

</body>

</html>
