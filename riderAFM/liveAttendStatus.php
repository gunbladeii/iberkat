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
$month = date('m');
$time = date('H:i:s');
$noIC = $row_Recordset['noIC'];

$attendance = $mysqli->query("SELECT COUNT(date) AS attendNo FROM attendance WHERE month = '$month' AND noIC = '$noIC' AND timeout IS NOT NULL");
$row_attendance = mysqli_fetch_assoc($attendance);
$totalRows_attendance = mysqli_num_rows($attendance);
?>

<?php if ($row_attendance['attendNo'] != NULL) {echo '<span class="badge badge-success">Total working days: '.$row_attendance['attendNo'].' days</span>';}else{echo '<span class="badge badge-danger">No records</span>';}?>
