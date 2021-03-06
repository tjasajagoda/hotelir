<?php
  require("../api/checkCookie.php");

  $dao = new MySQLDao();
  $uporabnisko_ime = $_COOKIE['hash'];
  $data = $dao->getUporabnik("'" . $uporabnisko_ime . "'");

  $arr = json_decode($data, true)[0];

  $data = $dao->getHotel("'" . $arr['Hotel_id'] . "'");

  $arrHotel = json_decode($data, true)[0];

  $data = $dao->getNarocila("'" . $arr['id'] . "'");

  $arrNarocila = json_decode($data, true);



  

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Profile</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

   <link rel="stylesheet" href="dist/css/style.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Hot</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Hotel</b>ir</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="kosarica-st">
              <i class="fa fa-shopping-basket"></i>

              <script >
                var storitve = JSON.parse(localStorage.getItem('seznamStoritev'));
                var st = storitve.length;
                 var element = $("#kosarica-st");
                if(st>0){
                  var template="<span class=\"label label-warning\" >"+st+"</span>";
                  element.append(template);
                }

              </script>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Košarica</li>
                  <li>
                  <!-- inner menu: contains the actual data -->
                    <ul class="menu" id="dropdown-kosarica">
                      <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu" id="dropdown-kosarica">
                          <script >
                            $(document).ready(function(){
                               $(function(){
                                 objekt = {
                                  "storitevId":1,
                                  "kolicina":1
                                };
                                var sez = [];
                                sez.push(objekt);
                                objekt1 = {
                                  "storitevId":2,
                                  "kolicina":3
                                };
                                sez.push(objekt1);
                                localStorage.setItem('seznamStoritev',JSON.stringify(sez));
                                  $(".dropdown").on("show.bs.dropdown", function(event){
                                    var element = $("#dropdown-kosarica");
                                    element.empty();
                                    var storitve = JSON.parse(localStorage.getItem('seznamStoritev'))


                                    if(storitve == null){
                                      var template =
                                        "<li>\
                                          <a href=\"#\">\
                                          <i ></i>Košarica je prazna!\
                                          </a>\
                                        </li>";

                                        element.append(template);
                                    }else {
                                      for (var i = 0; i < storitve.length; i++) {
                                        //var idStoritve = storitve[i].storitevId;
                                        var idStoritve="Vino"
                                         var kolicina = storitve[i].kolicina;



                                        var template =
                                        "<li>\
                                          <a>\
                                            <div class=\"col-md-11\">\
                                              <div>"+idStoritve+"</div>\
                                              <div>Količina: "+kolicina+"</div>\
                                            </div>\
                                            <button class=\"fa fa-trash\" >\
                                            </button>\
                                          </a>\
                                        </li>";


                                        element.append(template);



                                      }
                                    }
                                  });
                               })
                          });
                          </script>
                      </ul>
                    </li>
                  </ul>
                  </li>
                 </ul>
                </li>
          <!-- Tasks: style can be found in dropdown.less -->

          <!-- User Account: style can be found in dropdown.less -->
          <!-- Control Sidebar Toggle Button -->
          <!-- <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-gears"></i>
            </a>
            <ul class="dropdown-menu">
              <li class="user-footer">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
              </li>
            </ul>
          </li> -->
          <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Odjavi se</a></li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $arr['ime'] . " " . $arr['priimek']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Dosegljiv</a>
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- <li class="header">MAIN NAVIGATION</li> -->
        <!-- <li>
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul>
        </li> -->
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Layout Options</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
            <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
            <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
            <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
          </ul>
        </li> -->
        <li >
          <a href="index.php">
            <i class="fa fa-shopping-basket"></i>
            <span>Storitve</span>
          </a>
        </li>
        <li >
          <a href="profile.php">
            <i class="fa fa-user"></i>
            <span>Podatki o uporabniku</span>
          </a>
        </li>
        <li >
          <a href="hotel.php">
            <i class="fa fa-building"></i>
            <span>O hotelu</span>
          </a>
        </li>
        <li >
          <a href="contact.php">
            <i class="fa fa-info"></i>
            <span>Kontakt</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Podatki o uporabniku
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Domov</a></li>
        <li class="active">Podatki o uporabniku</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Hotel: <b><?php echo $arrHotel['ime']; ?></b>
            <div class="pull-right">Soba: <strong><?php echo $arr['soba']; ?></strong></div>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
        <h3><?php echo $arr['ime'] . " " . $arr['priimek']; ?> </h3><br>
        
        </div>
        <!-- /.col -->
      
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th># naroč.</th>
              <th>Ime storitve</th>
              <th>Kategorija</th>
              <th>Datum naročila</th>
              <th>Znesek</th>
            </tr>
            </thead>
            <tbody>
            <?php
              
              $skupniDolg = 0;

              foreach ($arrNarocila as $value) {
                echo "<tr>";
                echo "<td>" . $value['Narocilo_id'] . "</td>";
                echo "<td>" . $value['ime_storitve'] . "</td>";
                echo "<td> <i class='".$value['slika_kategorije']."'></i> " . $value['ime_kategorije'] . "</td>";

                $date = new DateTime($value['cas_narocila']);

                echo "<td>" . $date->format('m.d.Y (H:i:s)') . "</td>";
                echo "<td>" . $value['cena'] . " EUR</td>";
                echo "</tr>";

                $skupniDolg += floatval($value['cena']);
              }
              
            ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Možnost plačila:</p>
          <img src="dist/img/credit/visa.png" alt="Visa">
          <img src="dist/img/credit/mastercard.png" alt="Mastercard">
          <img src="dist/img/credit/american-express.png" alt="American Express">
          <img src="dist/img/credit/paypal2.png" alt="Paypal">

          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Račun je možno poravnati na recepciji oziroma preko spletnega plačila.
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Dolg</p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Znesek:</th>
                <td><?php echo $skupniDolg; ?> EUR</td>
              </tr>
              <tr>
                <th>DDV (9.5%)</th>
                <td><?php echo $skupniDolg/100*9.5 ?> EUR</td>
              </tr>
              <tr>
                <th>Za plačilo:</th>
                <td><?php echo $skupniDolg + ($skupniDolg/100*9.5) ?> EUR</td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Natisni</a>
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Plačaj
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generiraj PDF
          </button>
        </div>
      </div>
    </section>



<script >
  $(document).ready(function(){
    // var element = $("#seznamStoritev");
    // for (var i = 0; i < 5; i++) {
    //   var icon = "fa fa-taxi";
    //   var template =" <div class=\"col-lg-3 col-xs-6\">\
    //     <div class=\"small-box bg-green\">\
    //       <div class=\"inner\" >\
    //         <h2 id=\"imeStoritve\">"+i+"</h2>\
    //       </div>\
    //       <div class=\"icon\">\
    //         <i class=\""+ icon +"\"></i>\
    //       </div>\
    //       <a href=\"#\" class=\"small-box-footer\">\
    //         Več <i class=\"fa fa-arrow-circle-right\"></i>\
    //       </a>\
    //     </div>\
    //   </div>";
    //   element.append(template);
    // }
    $.ajax({
        type: 'GET',
        url: '../api/getKategorije.php?hotelId=1',
        // data: { 'facultyId': facultyId,
        //         'studyTypeId': studyTypeId,
        //         'programTypeId': programTypeId
        //       },
        success: function(json) {
          var data = (JSON.parse(json))
          var element = $("#seznamStoritev");
          for (var i = 0; i < data.length; i++) {
            var icon = data[i].slika;
            var template =" <div class=\"col-lg-3 col-xs-6\">\
              <div class=\"small-box bg-aqua\">\
                <div class=\"inner\" >\
                  <h2 id=\"imeStoritve\">"+data[i].ime+"</h2>\
                </div>\
                <div class=\"icon\">\
                  <i class=\""+ icon +"\"></i>\
                </div>\
                <a href=\"storitve.html?kategorijaId="+data[i].id+"\" class=\"small-box-footer\">\
                  Več <i class=\"fa fa-arrow-circle-right\"></i>\
                </a>\
              </div>\
            </div>";
            element.append(template);
          }
        }
    });
  });

</script>
            <!-- <a class="btn btn-app">
              <i class="fa fa-car"></i> Edit
            </a>
          </div>
            <a class="btn btn-app">
              <i class="fa fa-play"></i> Play
            </a>
            <a class="btn btn-app">
              <i class="fa fa-repeat"></i> Repeat
            </a>
            <a class="btn btn-app">
              <i class="fa fa-pause"></i> Pause
            </a>
            <input type="image" src="logg.png" name="saveForm" class="btTxt submit" id="saveForm" /> -->

            <!-- <a class="btn btn-app">
              <i class="fa fa-save"></i> Save
            </a> -->
            <!-- <a class="btn btn-app">
              <span class="badge bg-yellow">3</span>
              <i class="fa fa-bullhorn"></i> Notifications
            </a>
            <a class="btn btn-app">
              <span class="badge bg-green">300</span>
              <i class="fa fa-barcode"></i> Products
            </a>
            <a class="btn btn-app">
              <span class="badge bg-purple">891</span>
              <i class="fa fa-users"></i> Users
            </a>
            <a class="btn btn-app">
              <span class="badge bg-teal">67</span>
              <i class="fa fa-inbox"></i> Orders
            </a>
            <a class="btn btn-app">
              <span class="badge bg-aqua">12</span>
              <i class="fa fa-envelope"></i> Inbox
            </a>
            <a class="btn btn-app">
              <span class="badge bg-red">531</span>
              <i class="fa fa-heart-o"></i> Likes
            </a> -->
          </div>
          <!-- /.box-body -->
        </div>

        <!-- ./col -->
      </div>
    </div>
    <!-- <div class="row">

      <div class="box box-info">
        <div class="box-header">
          <i class="fa fa-envelope"></i>

          <h3 class="box-title">Quick Email</h3>
        </div>
        <div class="box-body">
          <form action="#" method="post">
            <div class="form-group">
              <input type="email" class="form-control" name="emailto" placeholder="Email to:">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="subject" placeholder="Subject">
            </div>
            <div>
              <textarea class="textarea" placeholder="Message"
                        style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>
          </form>
        </div>
        <div class="box-footer clearfix">
          <button type="button" class="pull-right btn btn-default" id="sendEmail">Send
            <i class="fa fa-arrow-circle-right"></i></button>
        </div>
      </div>
    </div> -->
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Skupina Hotelir (Startup Weekend)</b>
    </div>
    <strong>Copyright &copy; 2018</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
