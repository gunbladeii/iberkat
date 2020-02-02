<?php require('conn.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
session_start();

$name = $_POST['name'];
$stationCode = $_POST['stationCode'];
$date = $_POST['date'];
$month = $_POST['month'];
$year = $_POST['year'];
$revenue = $_POST['revenue'];
$vanRental = $_POST['vanRental'];

if (isset($_POST["submit"])) {
 $mysqli->query("INSERT INTO stationName (name, stationCode) VALUES ('$name', '$stationCode')");
  
  header("Location:setting.php");
}

if (isset($_POST["revenue2"])) {
 $mysqli->query("INSERT INTO revenue (date, month, year, totalRevenue, vanRental) VALUES ('$date', '$month', '$year', '$revenue', '$vanRental')");
  
  header("Location:setting.php");
}

$colname_Recordset = "-1";
if (isset($_SESSION['user'])) {
  $colname_Recordset = $_SESSION['user'];
}

$Recordset = $mysqli->query("SELECT employeeData.noIC, employeeData.nama, employeeData.riderFacePic, login.username FROM login INNER JOIN employeeData ON employeeData.noIC = login.noIC WHERE username = '$colname_Recordset'");
$row_Recordset = mysqli_fetch_assoc($Recordset);
$totalRows_Recordset = mysqli_num_rows($Recordset);

$joiner = $mysqli->query("SELECT employeeData.noIC, employeeData.nama, employeeData.emel, stationName.name AS stationName, stationName.stationCode FROM employeeData INNER JOIN stationName ON employeeData.stationCode = stationName.stationCode WHERE emel = '$colname_Recordset'");
$row_joiner = mysqli_fetch_assoc($joiner);
$totalRows_joiner = mysqli_num_rows($joiner);

$station=$row_joiner['stationCode'];
date_default_timezone_set("asia/kuala_lumpur"); 
$date = date('Y-m-d'); 
$time = date('H:i:s');

$Recordset3 = $mysqli->query("SELECT name FROM stationName WHERE stationCode = '$station'");
$row_Recordset3 = mysqli_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysqli_num_rows($Recordset3);

$Recordset2 = $mysqli->query("SELECT * FROM stationName");
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);

$revenue = $mysqli->query("SELECT *,SUM(totalRevenue) as totalRevenue,SUM(vanRental) as vanRental  FROM revenue WHERE totalRevenue NOT LIKE 0 OR vanRental NOT LIKE 0 GROUP BY date, month, year");
$row_revenue = mysqli_fetch_assoc($revenue);
$totalRows_revenue = mysqli_num_rows($revenue);

?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>iBerkat | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../adminAFM/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../adminAFM/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
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
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
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
                <p class="text-sm">Parcel damage during delivery...</p>
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
                <p class="text-sm">Balakong Hub succesfull delivered</p>
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
            <i class="fas fa-users mr-2"></i> 8 friend requests
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
    <a href="index.php" class="brand-link">
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
          <a href="#" class="d-block"><?php echo $row_Recordset['nama'];?></a>
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
                 -SUPERVISOR SECTION-
                <!--<i class="right fas fa-angle-left"></i>-->
              </p>
            </a>
            <ul class="nav nav-treeview">
             
              <!--<li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>-->
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="register.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Rider Registration
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
            <a href="report.php" class="nav-link">
              <i class="nav-icon fas fa-address-card"></i>
              <p>
                Generate Report
                <!--<i class="fas fa-angle-left right"></i>
                <!--<span class="badge badge-info right">6</span>-->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="setting.php" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Control Panel
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
            <h4 class="m-0 text-dark">Altus Freight Managment System Control Panel</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">iBerkat | Conrol Panel</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-12">
          <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Station Registration</h3>

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
                <div class="table-responsive">
                <form action="setting.php" method="post" enctype="multipart/form-data">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Station Code</th>
                      <th>Station Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                    <td>
                    <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Station Code" name="stationCode" id="validationDefault01" required>
                      <div class="input-group-append input-group-text">
                         <span class="fas fa-code"></span>
                      </div>
                     </div>
                     </td>
                      <td>
                     <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="Station Name" name="name" id="validationDefault02" required>
                      <div class="input-group-append input-group-text">
                         <span class="fas fa-motorcycle"></span>
                      </div>
                     </div>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                  <input type="hidden" name="MM_insert" value="prosesDaftar">
                  <div class="card-footer clearfix">
                <button type="submit" name="submit" class="btn btn-sm btn-success float-right">Submit</button>
              </div>
                </div>
                <!-- /.table-responsive -->
              
              </form>
              
              <div class="card-header border-transparent">
                <h3 class="card-title">Registered Station</h3>
                </div>
                <div class="table-responsive">
                   <table class="table-bordered table m-0 table-hover table-sm">
                    <thead>
                    <tr style="text-align:center">
                      <th><div class="badge badge-info">Station Code</div></th>
                      <th><div class="badge badge-info">Station Name</div></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php do {?>
                    <tr style="text-align:center">
                      <td><?php echo $row_Recordset2['stationCode'];?></td>
                      <td><?php echo $row_Recordset2['name'];?></td>
                    </tr>
                    <?php }while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2))?>
                    </tbody>
                  </table> 
                </div>
              </div>
              <!-- /.card-footer -->
           
            <div class="card-header border-transparent">
                <h3 class="card-title">Revenue Update</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              
                <div class="table-responsive">
                <form action="setting.php" method="post" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                    <input type="hidden" name="month" value="<?php date_default_timezone_set("asia/kuala_lumpur");
                     echo $month2 = date('m');?>"/>
                     <input type="hidden" name="year" value="<?php date_default_timezone_set("asia/kuala_lumpur");
                     echo $year2 = date('Y');?>"/>
                    <input type="date" class="form-control" placeholder="Date" name="date" id="validationDefault03" required>
                      <div class="input-group-append input-group-text">
                         <span class="far fa-calendar-alt"></span>
                      </div>
                     </div>
                      
                     <div class="input-group mb-3">
                      <input type="number" class="form-control" placeholder="RM - Insert revenue here.." name="revenue" id="validationDefault04" required>
                      <div class="input-group-append input-group-text">
                         <span class="fas fa-money-check-alt"></span>
                      </div>   
                     </div>
                      
                     <div class="input-group mb-3">
                      <input type="number" class="form-control" placeholder="RM - Insert van rental (if any)" name="vanRental" id="validationDefault05" required>
                      <div class="input-group-append input-group-text">
                         <span class="fas fa-shuttle-van"></span>
                      </div>   
                     </div>
                     
                  <div class="card-footer clearfix">
                <button type="submit" name="revenue2" class="btn btn-sm btn-success float-right">Submit</button>
                 </div>
                </div></br>
                <!-- /.table-responsive -->
              </form>
              
        <?php if($row_revenue['totalRevenue'] != 0 || $row_revenue['vanRental'] != 0) {?>
          <div class="card-header border-transparent">
            <h3 class="card-title">Revenue Record</h3>
                </div>
                <div class="table-responsive">
                   <table class="table m-0 table-hover table-bordered table-sm">
                    <thead>
                    <tr style="text-align:center">
                      <th><div class="badge badge-info">Date</div></th>
                      <th><div class="badge badge-info">Revenue-in (RM)</div></th>
                      <th><div class="badge badge-info">Van Rental (RM)</div></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php do {?>
                    <tr style="text-align:center">
                      <td><div class="badge badge-info"><?php echo $row_revenue['date'];?></div></td>
                      <td><div class="badge badge-primary"><?php echo "RM ".$row_revenue['totalRevenue'];?></div></td>
                      <td><div class="badge badge-primary"><?php echo "RM ".$row_revenue['vanRental'];?></div></td>
                    </tr>
                    <?php }while ($row_revenue = mysqli_fetch_assoc($revenue))?>
                    </tbody>
                  </table> 
                </div>
              <!-- /.card-footer -->
            <?php } ?>
            </div>
          <!-- /.col -->
     </section>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="../adminAFM/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../adminAFM/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../adminAFM/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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
<script src="../adminAFM/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../adminAFM/dist/js/demo.js"></script>
<!-- Select2 -->
<script src="../adminAFM/plugins/select2/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="../adminAFM/plugins/inputmask/jquery.inputmask.bundle.js"></script>
<script type="text/javascript">
  $(function() {
     'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
   }, false); 
      
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });  
      
      
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 10000
    });

    $('#swalDefaultSuccess').click(function() {
      Toast.fire({
        type: 'success',
        title: 'Registration Succesfull.Thank you'
      })
    });
    $('.swalDefaultInfo').click(function() {
      Toast.fire({
        type: 'info',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultError').click(function() {
      Toast.fire({
        type: 'error',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultWarning').click(function() {
      Toast.fire({
        type: 'warning',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultQuestion').click(function() {
      Toast.fire({
        type: 'question',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });

    $('#toastrDefaultSuccess').click(function() {
      toastr.success('Registration Succesfull.Thank you.')
    });
    $('.toastrDefaultInfo').click(function() {
      toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultError').click(function() {
      toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultWarning').click(function() {
      toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
  });

</script>
</body>
</html>
