<?php require('conn.php'); ?>
<?php session_start();

$colname_Recordset = "-1";
if (isset($_SESSION['user'])) {
  $colname_Recordset = $_SESSION['user'];
}

$Recordset = $mysqli->query("SELECT * FROM login WHERE username = '$colname_Recordset'");
$row_Recordset = mysqli_fetch_assoc($Recordset);
$totalRows_Recordset = mysqli_num_rows($Recordset);

date_default_timezone_set("asia/kuala_lumpur");
$month = date('m');
$monthF = date("F", mktime(0, 0, 0, $month, 10));

$Recordset2 = $mysqli->query("SELECT month, year,sum(grandTotal) AS grandTotal, sum(totalRevenue) AS revenue, sum(oil) AS oil, sum(vanRental) AS vanRental, 
(sum(grandTotal) + sum(oil) + sum(vanRental)) AS cost
FROM revenue GROUP BY month,year");
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);

$a=1;
?>
<div class="table-responsive">
<?php if($row_Recordset2['month'] > 0 ){ ?>
<table class="table table-bordered table-hover table-responsive-xl">
                    <thead class="table-info">
                    <tr style="text-align:center">
                      <th scope="col">No</th>
                      <th scope="col">Month</th>
                      <th scope="col">Cost</th>
                      <th scope="col">Revenue</th>
                      <th scope="col">Indicator</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php do { ?>    
                    <tr style="text-align:center">
                      <td><?php echo $a++;?></td>
                      <td><?php 
                      $monthM =$row_Recordset2['month']; 
                      $monthZ = date("F", mktime(0, 0, 0, $monthM, 10));
                      echo $monthZ;
                      ?>
                      </td>
                      <td><span class="badge badge-warning">
                      <?php echo "RM ".$row_Recordset2['cost']; ?>
                      </span></td>
                      <td><span class="badge badge-success"><?php echo "RM ".$row_Recordset2['revenue'];?></span></td>
                      <td><span class="badge badge-light">
                          <?php 
                          $revenue = $row_Recordset2['revenue'];
                          $cost = $row_Recordset2['cost'];
                          $calcRC = round($revenue - $cost,2);
                         
                      if($cost > $revenue)
                      {
                         echo '<i class="fas fa-arrow-down" style="color:red"></i>&nbsp RM '.$calcRC; 
                      }
                      else{echo '<i class="fas fa-arrow-up" style="color:green"></i>&nbsp RM '.$calcRC;}
                          ?>
                      </span>
                      </td>
                    </tr>
                    <?php } while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2)); ?>
                    </tbody>
                  </table>
<?php }?>
</div>