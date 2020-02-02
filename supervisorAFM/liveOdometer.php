<?php require('conn.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}


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

$station=$row_joiner['stationCode'];
date_default_timezone_set("asia/kuala_lumpur"); 
$date = date('Y-m-d'); 
$time = date('H:i:s');
$Recordset2 = $mysqli->query("SELECT a.*, (a.odoFinish - a.odoStart) as km FROM infoParcel as a WHERE date = '$date'");
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);

$query_Recordset3 = $mysqli->query("SELECT name FROM stationName WHERE stationCode = '$station' ");
$row_Recordset3 = mysqli_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysqli_num_rows($Recordset3);
$a=1;

?>
<?php if($row_Recordset2['date'] == $date){?>
<?php if ($totalRows_Recordset2 > 0) { ?>
	<table id="example2" class="table m-0">
                    <thead>
                    <tr style="text-align:center">
                      <th>No</th></th>
                      <th>Carrier</th>
                      <th>Odometer Start</th>
                      <th>Odometer Finish</th>
                      <th>Total (KM)</th>
                      <th>Oil (RM)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php do { ?>    
                    <tr style="text-align:center">
                      <td><?php echo $a++;?></td>
                      <td><?php echo ucwords(strtolower($row_Recordset2['nama']));?>
                      </td>
                      <td><?php if ($row_Recordset2['odoStart'] != NULL){
                      echo '<span class="badge badge-info">'.$row_Recordset2['odoStart'].'</span>';}else {echo '<span class="badge badge-warning">Pending</span>';}?></td>
                      <td>
                      <?php if ($row_Recordset2['odoFinish'] != NULL){
                      echo '<span class="badge badge-danger">'.$row_Recordset2['odoFinish'].'</span>';}else {echo '<span class="badge badge-warning">Pending</span>';}?>
                      </td>
                      <td>
                      <?php if ($row_Recordset2['odoFinish'] != NULL){
                      echo '<span class="badge badge-danger">'.$row_Recordset2['km'].'</span>';}else {echo '<span class="badge badge-warning">Pending</span>';}?>
                      </td>
                       <td>
                      <?php if ($row_Recordset2['oil'] != NULL){
                      echo '<span class="badge badge-dark">'.$row_Recordset2['oil'].'</span>';}else {echo '<span class="badge badge-warning">Pending</span>';}?>
                      </td>
                    </tr>
                    <?php } while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2)); ?>
                    </tbody>
                  </table>
<?php }?>
<?php }else {echo '<button type="button" class="btn btn-danger btn-block btn-flat" data-toggle="modal" data-target="#modal-success"><i class="fas fa-exclamation-triangle"></i> No data from driver right now!</button>';}?>
