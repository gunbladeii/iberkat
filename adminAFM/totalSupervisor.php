<?php require_once('Connection/iBerkat.php'); ?>
<?php session_start();?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_Recordset = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset = $_SESSION['MM_Username'];
}
mysql_select_db($database, $iBerkat);
$query_Recordset = sprintf("SELECT * FROM login WHERE username = %s", GetSQLValueString($colname_Recordset, "text"));
$Recordset = mysql_query($query_Recordset, $iBerkat) or die(mysql_error());
$row_Recordset = mysql_fetch_assoc($Recordset);
$totalRows_Recordset = mysql_num_rows($Recordset);

date_default_timezone_set("asia/kuala_lumpur");
$date = date('Y-m-d');

$query_Recordset2 = sprintf("SELECT count(role) AS supervisor, role FROM login WHERE role = 'ss'");
$Recordset2 = mysql_query($query_Recordset2, $iBerkat) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

?>
<?php 
if ($row_Recordset2['role'] != NULL){echo $row_Recordset2['supervisor'];}else{echo '0';}?>

