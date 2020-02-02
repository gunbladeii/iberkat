<?php require('conn.php'); ?>
<?php

$colname_Recordset = "-1";
if (isset($_SESSION['user'])) {
  $colname_Recordset = $_SESSION['user'];
}

$Recordset = $mysqli->query("SELECT * FROM login WHERE username = '$colname_Recordset'");
$row_Recordset = mysqli_fetch_assoc($Recordset);
$totalRows_Recordset = mysqli_num_rows($Recordset);

$attend = $mysqli->query("SELECT attendance.nama, attendance.noIC, attendance.date AS date, attendance.stationCode, stationName.name AS stationName, COUNT(attendance.date) AS totalDay , attendance.month FROM attendance INNER JOIN stationName ON attendance.stationCode = stationName.stationCode WHERE attendance.timeOut IS NOT NULL GROUP BY attendance.noIC, attendance.month ORDER BY attendance.month ASC");
$row_attend = mysqli_fetch_assoc($attend);
$totalRows_attend = mysqli_num_rows($attend);


$a=1;
?>
<?php if ($totalRows_attend > 0) { ?>
	<table id="example2" class="table table-hover table-responsive-xl">
                    <thead class="table-info">
                    <tr style="text-align:left">
                      <th scope="col">No</th>
                      <th scope="col">Name</th>
                      <th scope="col">IC No.</th>
                      <th scope="col">Station</th>
                      <th scope="col">Month</th>
                      <th scope="col">Total Attend</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php do { ?>    
                    <tr style="text-align:left">
                      <td><?php echo $a++;?></td>
                      <td><a data-toggle="modal"
                          data-target="#infoJourney"
                          data-whatever="<?php echo $row_attend['noIC'];?>"  
                          data-whatever2="<?php echo $row_attend['month'];?>"><span class="badge badge-info"><?php echo ucwords(strtolower($row_attend['nama']));?></span></a>
                      </td>
                      <td><?php echo $row_attend['noIC'];?></td>
                      <td><?php echo $row_attend['stationName'];?></td>
                      <td><?php $date=date_create($row_attend['date']);echo date_format($date,"F");?></td>
                      <td><?php echo $row_attend['totalDay'];?></td>
                    </tr>
                    <?php } while ($row_attend = mysqli_fetch_assoc($attend)); ?>
                    </tbody>
                  </table>
<?php }?>
