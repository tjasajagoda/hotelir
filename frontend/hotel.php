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
  <title>Hotel</title>
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
        O hotelu
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Domov</a></li>
        <li class="active">O hotelu</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="invoice">
    <div>
    <div class="box box-primary">
            <div class="box-body box-profile">

              <h3 class="profile-username text-center"><?php echo $arrHotel['ime']; ?></h3>

              <p class="text-muted text-center"><?php echo $arrHotel['lokacija']; ?></p>
              <p class="text-muted text-center"><?php echo $arrHotel['drzava']; ?></p>

              <center><img class="img-responsive" width="300" src="images/slon.png" alt="User profile picture"></center><br>
              <div style="width: 100%"><iframe width="100%" height="600" src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;coord=46.052569, 14.503886999999963&amp;q=Hotel%20Slon+(Hotel%20Slon)&amp;ie=UTF8&amp;t=k&amp;z=18&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.maps.ie/create-google-map/">Embed Google Map</a></iframe></div><br />
              <br>
              Best Western Premier Hotel Slon se nahaja v samem središču Ljubljane, le nekaj korakov od starega mestnega jedra, Ljubljanskega gradu in vseh pomembnih mestnih znamenitosti.

Ta sodoben hotel s 4 zvezdicami superior premore 170 udobnih in kakovostno opremljenih sob. Superior Deluxe sobe, Deluxe sobe in Suite nudijo luksuzno nastanitev tudi za najbolj zahtevne goste.
Spa & Fitness ponuja najsodobnejša Technogym fitnes orodja. Odprt je štiriindvajset ur na dan in zagotavlja optimalno vadbo z utežmi in kardio napravami kot tudi sproščujoče savne s tropskimi tuši. Masažni studio nudi širok izbor tajskih masaž, ki krepijo imunski sistem.

Best Western Premier Hotel Slon je prilagojen poslovnim gostom in nudi 5 vsestranskih konferenčnih dvoran, ki se med seboj združujejo ter tako prilagajajo različnim zahtevam organizatorjev. V dvoranah nudimo tudi delovne zajtrke, poslovna kosila in svečane večerje za  sprejeme, zabave in prestižne poroke.

Restavracija Slon 1552 je priljubljena točka Ljubljančanov in njihovih gostov in je tudi znana po svoji odlični kuhinji. V atraktivnem ambientu s pogledom na ljubljanske ulice, gostom postrežemo sodobne slovenske in mednarodne jedi, kot tudi širok izbor vrhunskih vin.

Za hotelske goste, nudimo valet parkiranje v bližnji garaži kamor avto odpelje naše prijazno osebje.

Best Western Premier Hotel Slon ostaja hiša z več kot 460-letno tradicijo, ki na elitni lokaciji svoje goste razvaja s prijetno namestitvijo in odlično kulinariko. Vljudno vabljeni!
            </div>
            <!-- /.box-body -->
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
          <a href="storitve.php">
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
