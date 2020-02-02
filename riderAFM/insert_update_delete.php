<?php require('conn.php'); ?>
<?php 
date_default_timezone_set("asia/kuala_lumpur"); 
$date = date('Y-m-d'); 
$time = date('H:i:s');
$month = date('m');
$year = date('Y');

$noIC = $_POST['noIC'];
$nama = $_POST['nama'];
$stationCode = $_POST['stationCode'];
$status = $_POST['status'];
$dateStore = $_POST['date'];
$timeStore = $_POST['time'];
$monthStore = $_POST['month'];
$yearStore = $_POST['year'];
$role = $_POST['role'];
$timeOut = $_POST['timeOut'];
$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];

if (isset($_POST['submit'])) {
     $mysqli->query("INSERT INTO attendance (`noIC`, `nama`, `stationCode`, `status`, `date`, `time`, `month`, `year`, `role`, `longitude`, `latitude`) VALUES ('$noIC', '$nama', '$stationCode', '$status', '$dateStore', '$timeStore', '$monthStore', '$yearStore', '$role', '$longitude', '$latitude')");
  
  header("Location:attendance.php?insert=success");
}

if (isset($_POST['submit'])) {
    $mysqli->query("INSERT INTO infoParcel (`noIC`, `nama`, `stationCode`, `role`, `date`, `month`, `year`) VALUES ('$noIC', '$nama', '$stationCode', '$role', '$dateStore', '$monthStore', '$yearStore')");

  header("Location:attendance.php?insert=success");
}

if (isset($_POST['update'])) {
    $mysqli->query("UPDATE attendance SET `nama`='$nama', `stationCode`='$stationCode', `timeOut`='$timeOut' WHERE `noIC`='$noIC' AND `date` ='$date'");

  header("location: attendance.php?update=success");
}
?>