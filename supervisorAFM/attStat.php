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

$joiner = $mysqli->query("SELECT employeeData.noIC, employeeData.nama, employeeData.emel, stationName.name AS stationName, stationName.stationCode FROM employeeData INNER JOIN stationName ON employeeData.stationCode = stationName.stationCode WHERE emel = '$colname_Recordset'");
$row_joiner = mysqli_fetch_assoc($joiner);
$totalRows_joiner = mysqli_num_rows($joiner);

$station=$row_joiner['stationCode'];
date_default_timezone_set("asia/kuala_lumpur"); 
$date = date('Y-m-d'); 
$time = date('H:i:s');
$Recordset2 = $mysqli->query("SELECT * FROM attendance WHERE stationCode = '$station' AND date = '$date' AND role = 'rider'");
$mem = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);

$Recordset3 = $mysqli->query("SELECT name FROM stationName WHERE stationCode = '$station' ");
$row_Recordset3 = mysqli_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysqli_num_rows($Recordset3);
$a=1;
?>
<?php if($mem['date'] == $date){?>
<?php if ($totalRows_Recordset2 != NULL) { ?>
	<table id="example2" class="table m-0">
                    <thead>
                    <tr style="text-align:center">
                      <th>No.</th></th>
                      <th>Rider Name</th>
                      <th>Clock-In</th>
                      <th>Clock-Out</th>
                     </tr>
                    </thead>
                    <tbody>
                    <?php do { ?>    
                    <tr style="text-align:center">
                      <td><?php echo $a++;?></td>
                      <td><a data-toggle="modal"
                          data-target="#parcelModal"
                          data-whatever="<?php echo $mem['noIC'];?>" data-whatever2="<?php echo $mem['date'];?>"><span class="badge badge-info"><?php echo ucwords(strtolower($mem['nama']));?></span></a></td>
                      <td><?php $timeM = new DateTime($mem['time']);
                                echo $timeM->format('h:i a');?>
                      </td>
                      <td><?php $timeT = new DateTime($mem['timeOut']);
                      if($mem['timeOut'] != NULL){echo $timeT->format('h:i a');}else{echo '<span class="badge badge-warning">Still working</span>';}?>
                      </td>
                    </tr>
                    <?php } while ($mem = mysqli_fetch_assoc($Recordset2)); ?>
                    </tbody>
                  </table>
<?php }?>
<?php }else {echo '<button type="button" class="btn btn-danger btn-block btn-flat" data-toggle="modal" data-target="#modal-success"><i class="fas fa-exclamation-triangle"></i> No rider available right now!</button>';}?>
            
