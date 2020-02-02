<?php require('conn.php'); 
include_once 'insert_update_delete.php';?>
<?php
session_start();
if (isset($_SESSION['role']))
{
   if($_SESSION['role'] != 'rider')
    {
      header('Location:../loginFailed.php');  
    }
}
?>
<?php

$colname_Recordset = "-1";
if (isset($_SESSION['user'])) {
  $colname_Recordset = $_SESSION['user'];
}

$Recordset = $mysqli->query("SELECT * FROM login WHERE username = '$colname_Recordset'");
$row_Recordset = mysqli_fetch_assoc($Recordset);
$totalRows_Recordset = mysqli_num_rows($Recordset);

$joiner = $mysqli->query("SELECT employeeData.noIC, employeeData.nama, employeeData.emel, stationName.name AS stationName, stationName.stationCode FROM employeeData INNER JOIN stationName ON employeeData.stationCode = stationName.stationCode WHERE emel = '$colname_Recordset'");
$row_joiner = mysqli_fetch_assoc($joiner);
$totalRows_joiner = mysqli_num_rows($joiner);

$noIC = $row_Recordset['noIC'];

$Recordset2 = $mysqli->query("SELECT *,TIMEDIFF(timeOut, time) AS diff FROM attendance WHERE noIC = '$noIC' ORDER BY date DESC");
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>iBerkat | RIDER PAGE</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../adminAFM/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../adminAFM/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../adminAFM/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../adminAFM/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../adminAFM/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../adminAFM/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../adminAFM/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../adminAFM/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- chart.js plugin -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
</head>
<body onload="getLocation();showPosition2();" class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="profileRider.php" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../adminAFM/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Ahmad Taba
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Please check your payroll for this month</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../adminAFM/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Ali Ahmad
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Noted..ASAP</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../adminAFM/dist/img/user6-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Mohd Abu
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Mr. Sabu attend for emergency call</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 confirmation jobs
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <!-- Exit -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="../profileRider.php">
          <i class="far fa-times-circle"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="../logout.php" class="dropdown-item dropdown-footer">Logout</a>
        </div>
      </li>
     
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="profileRider.php" class="brand-link">
      <img src="../adminAFM/dist/img/iberkat.jpeg" alt="altus Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-dark">iBerkat</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <i class="nav-icon fas fa-user"></i>
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $row_Recordset['nama'];?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="profileRider.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                 -iBERKAT RIDER SECTION-
                <!--<i class="right fas fa-angle-left"></i>-->
              </p>
            </a>
            <ul class="nav nav-treeview">
            </ul>
          </li>
          <li class="nav-item">
            <a href="profileRider.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Back to Dashboard Panel
                <!--<i class="fas fa-angle-left right"></i>
                <!--<span class="badge badge-info right">6</span>-->
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

<!--attendance coding here-->
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Welcome <?php echo ucwords(strtolower($row_Recordset['nama']));?></h1>
            <p>Attendance Section <br>
            (As of <?php echo $date;?>)
            </p>
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="profileRider.php">Home</a></li>
              <li class="breadcrumb-item active">Attendace Section</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          
        <?php if ($row_Recordset2['date'] == NULL || $row_Recordset2['date'] < $date){?>
        <form action="insert_update_delete.php" method="post">
            
        <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr style="text-align:center">
                      <th>Punch your attendance today</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr style="text-align:center">
                       <td><input type="submit" name="submit" class="btn btn-primary btn-block btn-flat" data-toggle="modal" data-target="#modal-info" value='Clock-In'/> 
                       </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
        <input type="hidden" id="longitude" name="longitude" value="">
        <input type="hidden" id="latitude" name="latitude" value="">        
        <input type="hidden" value="<?php echo $time?>" name="time">        
        <input type="hidden" value="<?php echo $date?>" name="date">
        <input type="hidden" value="<?php echo $month?>" name="month">
        <input type="hidden" value="<?php echo $year?>" name="year">
        <input type="hidden" name="nama" value="<?php echo $row_Recordset['nama']?>">
        <input type="hidden" name="noIC" value="<?php echo $row_Recordset['noIC']?>">
        <input type="hidden" name="stationCode" value="<?php echo $row_joiner['stationCode']?>">
        <input type="hidden" name="role" value="<?php echo $row_Recordset['role']?>">
        <input type="hidden" name="status" value="attend">
        </form>
        <?php }?>
        <!--end for if $row_Recorset['date'] < $date-->
        
        <?php if ($row_Recordset2['date'] == $date && $row_Recordset2['timeOut']== NULL){?>
        <form action="insert_update_delete.php" method="post">
            
               <div class="table-responsive">
                  <?php if ($row_Recordset2['timeOut'] == NULL) {echo '<input type="submit" name="update" class="btn btn-warning btn-block btn-flat" data-toggle="modal" data-target="#modal-success" value= "Clock-Out"/>';}?>
                </div>
                <!-- /.table-responsive -->
        <input type="hidden" value="<?php echo $time?>" name="timeOut">   
        <input type="hidden" name="nama" value="<?php echo $row_Recordset['nama']?>">
        <input type="hidden" name="noIC" value="<?php echo $row_Recordset['noIC']?>">
        <input type="hidden" name="stationCode" value="<?php echo $row_joiner['stationCode']?>">
        <input type="hidden" name="role" value="<?php echo $row_Recordset['role']?>">
        <input type="hidden" name="status" value="attend">
        </form>
        <?php }?>
        
        
        <?php if ($row_Recordset2 > 0){?>
                <div class="card-body">
            <div class="table-responsive">
                  <table id="example1" class="table m-0">
                    <thead>
                    <tr style="text-align:center">
                      <th>No.</th></th>
                      <th>Date</th>
                      <th>Clock-In</th>
                      <th>Clock-Out</th>
                      <th>Duration</th>
                      <th>Location</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $a=1;?>
                    <?php do { ?>
                    <tr style="text-align:center">
                      <td><a href="#"><?php echo $a++;?></a></td>
                      <td> 
                          <?php $dateM = new DateTime($row_Recordset2['date']);
                                echo $dateM->format('d-m-Y');?>
                      </td>
                      <td>
                         <?php $timeM = new DateTime($row_Recordset2['time']);
                                echo $timeM->format('h:i a');?>
                      </td>
                      <td>
                         <?php if($row_Recordset2['timeOut'] != NULL){$timeM = new DateTime($row_Recordset2['timeOut']);
                                echo $timeM->format('h:i a');}else{echo 'Still Working';}?>
                      </td>
                      <td>
                      <?php if($row_Recordset2['timeOut'] != NULL){echo ($row_Recordset2['diff']);}else{echo 'Still Working';}?>
                      </td>
                      <td>
                      <?php if (!empty($row_Recordset2['longitude'])){echo '<a data-toggle="modal"
                          data-target="#locationModal"
                          data-whatever="'.$row_Recordset2['latitude'].'" data-whatever2="'.$row_Recordset2['longitude'].'"><span class="badge badge-warning">'.round($row_Recordset2['latitude'],5).','.round($row_Recordset2['longitude'],5).'</span></a>';}else{echo '<span class="badge badge-danger">No data</span>';}?>
                      </td>
                    </tr>
                    <?php } while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2)); ?>
                    </tbody>
                  </table>
                  </div>
                </div>
            <?php } ?>
                <!-- /.table-responsive -->
        
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2019 <a href="https://iberkat.my/iBerkat">iBerkat Sdn. Bhd</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0-beta.1
    </div>
  </footer>

</div>
<!-- ./wrapper -->     

<!-- Begin parcel modal -->
    <div class="modal fade" id="locationModal">
        <div class="modal-dialog">
          <div class="modal-content bg-success">
            <div class="modal-header">
              <h4 class="modal-title">Rider Location</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="dash">
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <!-- End parcel modal -->

<!-- jQuery -->
<script src="../adminAFM/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../adminAFM/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../adminAFM/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- ChartEdit.js -->
<script src="chartEdit.js"></script>
<!-- ChartJS -->
<script src="../adminAFM/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../adminAFM/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../adminAFM/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../adminAFM/plugins/jqvmap/maps/jquery.vmap.world.js"></script>
<!-- jQuery Knob Chart -->
<script src="../adminAFM/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../adminAFM/plugins/moment/moment.min.js"></script>
<script src="../adminAFM/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../adminAFM/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../adminAFM/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../adminAFM/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- FastClick -->
<script src="../adminAFM/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../adminAFM/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../adminAFM/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../adminAFM/dist/js/demo.js"></script>
<!-- jQuery Mapael -->
<script src="../adminAFM/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../adminAFM/plugins/raphael/raphael.min.js"></script>
<script src="../adminAFM/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../adminAFM/plugins/jquery-mapael/maps/world_countries.min.js"></script>
<!-- DataTables -->
<script src="../adminAFM/plugins/datatables/jquery.dataTables.js"></script>
<script src="../adminAFM/plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

<script>
var x = document.getElementById("latitude");
var y = document.getElementById("longitude");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.value = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  x.value = position.coords.latitude 
  y.value = position.coords.longitude;
}
</script>

<script>
    /*parcelModal*/
    $('#locationModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var recipient2 = button.data('whatever2') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'latitude=' + recipient + '&' + 'longitude=' + recipient2;

            $.ajax({
                type: "GET",
                url: "locationRider.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    console.log(data);
                    modal.find('.dash').html(data);
                },
                error: function(err) {
                    console.log(err);
                }
            });
    })
</script>

</body>
</html>

