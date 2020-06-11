<?php require('conn.php'); ?>
<?php
session_start();
if ($_SESSION['role'] != 'rider')
{
      header('Location:../index.php');
}

?>
<?php

date_default_timezone_set("asia/kuala_lumpur"); 
$date = date('Y-m-d'); 
$time = date('H:i:s');
$month = date('m');

$colname_Recordset = "-1";
if (isset($_SESSION['user'])) {
  $colname_Recordset = $_SESSION['user'];
}

$query_Recordset = $mysqli->query("SELECT employeeData.noIC, employeeData.nama, employeeData.riderFacePic, login.username FROM login INNER JOIN employeeData ON employeeData.noIC = login.noIC WHERE username =  '$colname_Recordset'");
$row_Recordset = mysqli_fetch_assoc($query_Recordset);
$totalRows_Recordset = mysqli_num_rows($query_Recordset);

$noIC = $row_Recordset['noIC'];
$query_parcel = $mysqli->query("SELECT * FROM infoParcel WHERE date = '$date' AND noIC = '$noIC'");
$mem = mysqli_fetch_assoc($query_parcel);
$totalRows_parcel = mysqli_num_rows($query_parcel);

$query_parcel2 = $mysqli->query("SELECT *,(success/itemCode)*100 AS percent FROM infoParcel WHERE noIC = '$noIC' ORDER BY date DESC LIMIT 10");
$mem2 = mysqli_fetch_assoc($query_parcel2);
$totalRows_parcel2 = mysqli_num_rows($query_parcel2);

$a=1;
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
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../adminAFM/plugins/sweetalert2/sweetalert2.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../adminAFM/plugins/toastr/toastr.min.css">
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
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
  <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

</head>  
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
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
        <a class="nav-link" data-toggle="dropdown" href="../index.php">
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
    <a href="#" class="brand-link">
      <img src="../adminAFM/dist/img/iberkat.jpeg" alt="altus Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-dark">iBerkat</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="data:image/jpeg;base64,<?php echo base64_encode($row_Recordset['riderFacePic']);?>" style="max-width:100%"/> 
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo ucwords(strtolower($row_Recordset['nama']));?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="index.php" class="nav-link active">
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
            <a href="attendance.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                e-Attendance
                <!--<i class="fas fa-angle-left right"></i>
                <!--<span class="badge badge-info right">6</span>-->
              </p>
            </a>
          </li>
          <li class="nav-item">
              <a href="payroll.php" class="nav-link">
              <i class="nav-icon fas fa-file-invoice-dollar"></i>
              <p>
                e-Payroll
                <!--<i class="fas fa-angle-left right"></i>
                <!--<span class="badge badge-info right">6</span>-->
              </p>
              </a>
          </li>
          
          <li class="nav-item">
            <a data-toggle="modal" data-target="#parcelModal" data-whatever="<?php echo $mem['noIC'];?>" data-whatever2="<?php echo $mem['date'];?>" class="nav-link">
              <i class="nav-icon fas fa-address-card"></i>
              <p>
                Delivery Record
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

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Welcome <?php echo ucwords(strtolower($row_Recordset['nama']));?></h1>
            <span class="badge badge-warning">Today is <?php $dateM = new DateTime($mem['date']);echo $dateM->format('d-M-Y');?></span>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Rider Section</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <a href="attendance.php" style="color:black;"><div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-box"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">e-Attendance</span>
                <div id="show2"></div>
              </div>
              <!-- /.info-box-content -->
            </div></a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <a data-toggle="modal" data-target="#parcelModal" data-whatever="<?php echo $mem['noIC'];?>" data-whatever2="<?php echo $mem['date'];?>"><div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-motorcycle"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Delivery Records</span>
                <div id="show"></div>
              </div>
              <!-- /.info-box-content -->
            </div></a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <a data-toggle="modal" data-target="#salaryModal" data-whatever="<?php echo $row_Recordset['noIC'];?>" data-whatever2="<?php echo $month;?>" style="color:black;"><div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-calendar-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Payment Voucher</span>
                <div id="show3"></div>
              </div>
              <!-- /.info-box-content -->
            </div></a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
         
         <div class="col-12 col-sm-6 col-md-3">
            <a href="#" style="color:black;"><div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-archive"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Scan Parcel</span>
                <span class="badge badge-success" data-toggle="modal" data-target="#modal-info">Scan Now</span>
              </div>
              <!-- /.info-box-content -->
            </div></a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          
        </div>
        <!-- /.row -->
        
        <!-- modal for tracking number -->
        <div class="modal fade" id="modal-info">
        <div class="modal-dialog">
          <div class="modal-content bg-info">
            <div class="modal-header">
              <h4 class="modal-title">Scan Parcel</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <div style="width: 100%;margin:0 auto;text-align:center;">
            <!--<form role="form" action="//track.trackingmore.com" method="get" onsubmit="return false">-->
            <form role="form" action="#" method="post">  
                        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
                        <div class="col">
                          <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
                         <div style="col-sm-12;">
                            <video id="preview" class="mw-100 hw-100"></video>
                          </div>

                           <script type="text/javascript">
                        let scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
                        scanner.addListener('scan', function (content) {
                          document.getElementById("scanInput").value = content;
                        });
                        Instascan.Camera.getCameras().then(function (cameras) {
                          if (cameras.length > 0) {
                            scanner.start(cameras[1]);
                          } else {
                            console.error('No cameras found.');
                          }
                        }).catch(function (e) {
                          console.error(e);
                        });
                      </script>

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Result</span>
                        </div>
                        <input type="text" class="form-control" name="scanInput" id="scanInput" aria-label="Username" aria-describedby="basic-addon1">
                      </div>

                      </div>
                    </div>
             </form>
             
             <!-- qr code scanner script 
             <div style="width: 100%;margin:0 auto;text-align:center;">
             <video id="preview" style="width: 100%;margin:0 auto;text-align:center;"></video>
             <span class="scan"></span>
             <script type="text/javascript" src="appcam.js"></script>
            </div>
           end ! qr code scanner script -->
            
             
           </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

        <div class="row">
          <div class="col-md-12">
              
            <div class="row">
         <div class="col-md-12">
           <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Parcel Delivery Status</h3>
                <h2 class="card-title" style="font-size:14px;">(<?php date_default_timezone_set("asia/kuala_lumpur"); echo date('d-M-Y');?>; <?php echo date('g:h:i a');?>)</h2>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <?php if (!empty($mem2['date'])){?>
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr style="text-align:center">
                      <th>No</th>
                      <th>Date</th>
                      <th>Total Parcel</th>
                      <th>Success</th>
                      <th>Undel</th>
                      <th>(%)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php do {?>
                    <tr style="text-align:center">
                      <td><a href="#"><?php echo $a++;?></a></td>
                      <td><?php $dateM = new DateTime($mem2['date']);
                                echo $dateM->format('d-m-Y');?></td>
                      <td><span class="badge badge-info"><?php echo $mem2['itemCode']?></span></td>
                      <td><span class="badge badge-success"><?php echo $mem2['success']?></span></td>
                      <td><span class="badge badge-danger"><?php echo $mem2['fail']?></span></td>
                      <td><span class="badge badge-warning"><?php echo round($mem2['percent'],2).'%';?></span></td>
                    </tr>
                    <?php } while ($mem2 = mysqli_fetch_assoc($query_parcel2)); ?>
                    </tbody>
                  </table>
                </div>
                <?php } else {echo '<span class="badge badge-danger">No data yet</span>';}?>
                
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body 
              <div class="card-footer clearfix">
                <a href="javascript:void(0)" class="btn btn-sm btn-info float-right"><i class="fas fa-phone-square-alt"></i> Call SS</a>
              </div>
              /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-4">
            
            
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
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
    <div class="modal fade" id="parcelModal">
        <div class="modal-dialog">
          <div class="modal-content bg-success">
            <div class="modal-header">
              <h4 class="modal-title">Update info parcel</h4>
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
      
      <!-- Begin salary modal -->
      <div class="modal fade" id="salaryModal">
        <div class="modal-dialog">
          <div class="modal-content bg-light">
            <div class="modal-header">
              <h4 class="modal-title">Payment voucher (Current view)</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <div class="dash"></div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    <!-- End salary modal -->


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
<script type="text/javascript" src="//s.trackingmore.com/plugins/v1/buttonCurrent.js"></script>
<!-- SweetAlert2 -->
<script src="../adminAFM/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../adminAFM/plugins/toastr/toastr.min.js"></script>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			setInterval(function () {
				$('#show').load('liveReceive.php')
				$('#show2').load('liveStatusPunch.php')
				$('#show3').load('liveAttendStatus.php')
			}, 3000);
		});
</script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
    /*parcelModal*/
    $('#parcelModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var recipient2 = button.data('whatever2') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'noIC=' + recipient + '&' + 'date=' + recipient2;

            $.ajax({
                type: "GET",
                url: "editdata.php",
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
    /*SalaryModal*/
    $('#salaryModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var recipient2 = button.data('whatever2') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'noIC=' + recipient + '&' + 'month=' + recipient2;

            $.ajax({
                type: "GET",
                url: "showSalary.php",
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
