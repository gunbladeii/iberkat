<?php require('conn.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}


$colname_Recordset2 = "-1";
if (isset($_SESSION['user'])) {
  $colname_Recordset2 = $_SESSION['user'];
}

$query_Recordset = $mysqli->query("SELECT employeeData.noIC, employeeData.nama, employeeData.riderFacePic, login.username FROM login INNER JOIN employeeData ON employeeData.noIC = login.noIC WHERE login.username = '$colname_Recordset2'");
$row_Recordset = mysqli_fetch_assoc($query_Recordset);
$totalRows_Recordset = mysqli_num_rows($query_Recordset);

$noIC = $row_Recordset['noIC'];

$Recordset2 = $mysqli->query("SELECT attendance.nama, attendance.noIC, attendance.date AS date, attendance.stationCode, stationName.name AS stationName, COUNT(attendance.date) AS totalDay , attendance.month FROM attendance INNER JOIN stationName ON attendance.stationCode = stationName.stationCode WHERE attendance.timeOut IS NOT NULL AND attendance.noIC = '$noIC' GROUP BY attendance.month ORDER BY attendance.month ASC");
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);

$station = $mysqli->query("SELECT login.nama, login.role, login.username AS emel, login.noIC FROM login INNER JOIN employeeData ON employeeData.noIC = login.noIC WHERE login.noIC = '$noIC'");
$row_station = mysqli_fetch_assoc($station);
$totalRows_station = mysqli_num_rows($station);
$a=1;
?>

<?php if($row_Recordset2['stationCode'] > 0) {?>
              <table id="example2" class="table table-hover table-responsive-xl">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Month</th>
                  <th>Total working days</th>
                </tr>
                </thead>
                <tbody>
                <?php do {?>    
                <tr>
                <td><?php echo $a++;?></td>	
	            <td> <span data-toggle="modal" data-target="#viewRiderModal" data-whatever="<?php echo $row_Recordset2['noIC'];?>" data-whatever2="<?php echo $row_Recordset2['month'];?>" class="badge badge-primary" role="button" aria-pressed="true"><?php $date=date_create($row_Recordset2['date']);echo date_format($date,"F");?></span></td>	
                <td class="d-sm-inline-flex"><span class="badge badge-warning"><?php echo $row_Recordset2['totalDay'];?></span></td>	
	            </tr>
                <?php } while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2));?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No.</th>
                  <th>Month</th>
                  <th>Total working days</th>
                </tr>
                </tfoot>
              </table>
<?php }?>