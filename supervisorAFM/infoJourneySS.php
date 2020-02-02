<?php session_start();?>
<?php
    require('conn.php');
    $noIC = $_GET['noIC'];
    $month = $_GET['month'];
    $month2=date_create($month);
    date_default_timezone_set("asia/kuala_lumpur"); 
    $date2 = date('Y-m-d');

    $mem = $mysqli->query("SELECT a.*, (a.odoFinish - a.odoStart) as km FROM infoParcel as a WHERE noIC = '$noIC' AND month = '$month' ORDER BY date DESC");
    $row_mem = mysqli_fetch_assoc($mem);
    $totalRows_mem = mysqli_num_rows($mem);
    
    $mem2 = $mysqli->query("SELECT a.*, (a.itemCode - a.success) as fail FROM infoParcel as a WHERE noIC = '$noIC' AND month = '$month' ORDER BY date DESC");
    $row_mem2 = mysqli_fetch_assoc($mem2);
    $totalRows_mem2 = mysqli_num_rows($mem2);
    
    $a=1;
    $b=1;

?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Using Bootstrap modal</title>
</head>
<body>
  <div class="table-responsive-sm">
	<table id="example2" class="table m-0">
                    <thead>
                    <tr style="text-align:center">
                    <th colspan="6">
                    <span class="badge badge-pill badge-secondary"><?php echo ucwords(strtolower($row_mem['nama']));?>
                    </span>
                    </br>Vehicle Status
                    </th>
                    </tr>
                    <tr style="text-align:center">
                      <th>No</th>
                      <th>Date</th>
                      <th>Odometer Start</th>
                      <th>Odometer Finish</th>
                      <th>Distance (KM)</th>
                      <th>Oil (RM)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php do { ?>    
                    <tr style="text-align:center">
                      <td><?php echo $a++;?></td>
                      <td><a data-toggle="modal"
                          data-target="#editJourney"
                          data-whatever="<?php echo $row_mem['noIC'];?>"  
                          data-whatever2="<?php echo $row_mem['date'];?>"><span class="badge badge-info"><?php $date=date_create($row_mem['date']);echo date_format($date,"d/m/Y");?></span></a>
                      </td>
                      <td><?php if ($row_mem['odoStart'] != NULL){
                      echo '<span class="badge badge-info">'.$row_mem['odoStart'].'</span>';}else {echo '<span class="badge badge-warning">Pending</span>';}?></td>
                      <td>
                      <?php if ($row_mem['odoFinish'] != NULL){
                      echo '<span class="badge badge-danger">'.$row_mem['odoFinish'].'</span>';}else {echo '<span class="badge badge-warning">Pending</span>';}?>
                      </td>
                      <td>
                      <?php if ($row_mem['odoFinish'] != NULL){
                      echo '<span class="badge badge-danger">'.$row_mem['km'].'</span>';}else {echo '<span class="badge badge-warning">Pending</span>';}?>
                      </td>
                       <td>
                      <?php if ($row_mem['oil'] != NULL){
                      echo '<span class="badge badge-dark">'.$row_mem['oil'].'</span>';}else {echo '<span class="badge badge-warning">Pending</span>';}?>
                      </td>
                    </tr>
                    <?php } while ($row_mem = mysqli_fetch_assoc($mem)); ?>
                    </tbody>
                  </table>
                  
                  	<table id="example2" class="table m-0">
                    <thead>
                    <tr style="text-align:center">
                    <th colspan="6">
                    Driver Performance
                    </th>
                    </tr>
                    <tr style="text-align:center">
                      <th>No</th>
                      <th>Date</th>
                      <th>Received</th>
                      <th>Success</th>
                      <th>Fail</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php do { ?>    
                    <tr style="text-align:center">
                      <td><?php echo $b++;?></td>
                      <td><?php $date2=date_create($row_mem2['date']);echo date_format($date2,"d/m/Y");?>
                      </td>
                      <td>
                      <?php if ($row_mem2['itemCode'] != NULL){
                      echo '<span class="badge badge-info">'.$row_mem2['itemCode'].'</span>';}else {echo '<span class="badge badge-warning">Pending</span>';}?>
                      </td>
                      <td>
                      <?php if ($row_mem2['success'] != NULL){
                      echo '<span class="badge badge-success">'.$row_mem2['success'].'</span>';}else {echo '<span class="badge badge-warning">Pending</span>';}?>
                      </td>
                      <td>
                      <?php if ($row_mem2['fail'] != NULL){
                      echo '<span class="badge badge-warning">'.$row_mem2['fail'].'</span>';}else {echo '<span class="badge badge-warning">Pending</span>';}?>
                      </td>
                    </tr>
                    <?php } while ($row_mem2 = mysqli_fetch_assoc($mem2)); ?>
                    </tbody>
                  </table>
                </div>
</body>
</html>
