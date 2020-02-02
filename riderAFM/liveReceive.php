<?php require('conn.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
session_start();

$colname_Recordset = "-1";
if (isset($_SESSION['user'])) {
  $colname_Recordset = $_SESSION['user'];
}

$Recordset = $mysqli->query("SELECT * FROM login WHERE username = '$colname_Recordset'");
$row_Recordset = mysqli_fetch_assoc($Recordset);
$totalRows_Recordset = mysqli_num_rows($Recordset);

$station=$row_Recordset['stationCode'];
date_default_timezone_set("asia/kuala_lumpur"); 
$date = date('Y-m-d'); 
$time = date('H:i:s');
$noIC = $row_Recordset['noIC'];

$parcel = $mysqli->query("SELECT * FROM infoParcel WHERE date = '$date' AND noIC = '$noIC'");
$row_parcel = mysqli_fetch_assoc($parcel);
$totalRows_parcel = mysqli_num_rows($parcel);

    $mem_attend = $mysqli->query("SELECT * FROM `attendance` WHERE `noIC`='$noIC' AND `date` = '$date'");
    $attend = mysqli_fetch_assoc($mem_attend);
?>

<?php if ($row_parcel['itemCode'] != NULL) {echo '<span class="badge badge-success">Total Received: '.$row_parcel['itemCode'].' parcel</span>';}else{echo '<span class="badge badge-danger">Waiting Confirmation</span>';}?>
