<?php session_start();?>
<?php
    require('conn.php');
    $noIC = $_GET['noIC'];
    $date = $_GET['date'];
    date_default_timezone_set("asia/kuala_lumpur"); 
    $date2 = date('Y-m-d');
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
    	$nama = $_POST['nama'];
    	$noIC = $_POST['noIC'];
    	$stationCode = $_POST['stationCode'];
    	$success = $_POST['success'];
    	$fail = $_POST['fail'];
    	$date = $_POST['date'];
    	$odoStart = $_POST['odoStart'];
    	$odoFinish = $_POST['odoFinish'];
    	$oil = $_POST['oil'];
    	$success = $_POST['success'];
    	$status = $_POST['status'];
    	$itemCode = $_POST['itemCode'];
    	$mysqli->query("UPDATE `infoParcel` SET `stationCode`='$stationCode', `nama`='$nama', `fail` ='$fail', `date`='$date' , `odoStart`='$odoStart', `odoFinish`='$odoFinish', `oil`='$oil', `success`='$success', `status` = '$status', `itemCode` = '$itemCode' WHERE `noIC` ='$noIC' AND `date`='$date'");
    	header("location:profileRider.php");
    }

    $members = $mysqli->query("SELECT * FROM `infoParcel` WHERE `noIC`='$noIC' AND `date` = '$date'");
    $mem = mysqli_fetch_assoc($members);

?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Using Bootstrap modal</title>
    
</head>
<body>   
<div class = "table responsive">
<?php if ($mem['itemCode'] != NULL){?>
<form method="post" action="editdata.php" role="form">
	<div class="modal-body">
		<div class="form-group">
		    <label for="id">ID</label>
			<input type="text" class="form-control" id="noIC" name="noIC" value="<?php echo $mem['noIC'];?>" readonly="true"/>

		</div>
		<div class="form-group">
		    <label for="id">Name</label>
			<input type="text" class="form-control" id="nama" name="nama" value="<?php echo ucwords(strtolower($mem['nama']));?>"/>
		</div>
	
	
	       <input type="hidden" class="form-control" id="stationCode" name="stationCode" value="<?php echo $mem['stationCode'];?>" readonly="true"/>
			<input type="hidden" class="form-control" id="date" name="date" value="<?php echo $mem['date'];?>" readonly="true"/>
			
		<div class="form-group">
        <label for="email">Total Received:</label>
		<input type="text" class="form-control" id="itemCode" name="itemCode" value="<?php echo $mem['itemCode'];?>"/>
		</div>
			
		<div class="form-group">
        <label for="email">Total Success</label>
			<input type="hidden" class="form-control" id="fail" name="fail" value="<?php echo $mem['fail'];?>"/>
			<input type="hidden" class="form-control" id="status" name="status" value="<?php echo $mem['status'];?>"/>
			<input type="number" class="form-control" id="success" name="success" value="<?php echo $mem['success'];?>"/>
		</div>
		
		<div class="form-group">
        <label for="email">Odometer Start:</label>
			<input type="number" class="form-control" id="odoStart" name="odoStart" value="<?php echo $mem['odoStart'];?>"/>
		</div>
		
		<div class="form-group">
        <label for="email">Odometer Finish:</label>
			<input type="number" class="form-control" id="odoFinish" name="odoFinish" value="<?php echo $mem['odoFinish'];?>"/>
		</div>
		
		<div class="form-group">
        <label for="email">Oil (RM):</label>
			<input type="number" class="form-control" id="oil" name="oil" value="<?php echo $mem['oil'];?>"/>
		</div>
		
		<div class="modal-footer">
			<input type="submit" class="btn btn-primary" name="submit" value="Update Data Parcel" />&nbsp;
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</form>
	<?php }?>
	<?php if ($mem['itemCode'] == NULL){?>
	   <div class="modal-footer">
			<input type="button" class="btn btn-secondary" value="Waiting confirmation parcel list from supervisor!" />&nbsp;
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	<?php }?>
</div>	
  <!--formula subtract on update parcel-->
	<script>
    $(document).ready(function() {
    //this calculates values automatically 
    sum();
    $("#itemCode, #success").on("keydown keyup", function() {
        sum();
    });

    function sum() {
            var num1 = document.getElementById('itemCode').value;
            var num2 = document.getElementById('success').value;
			var result = parseInt(num1) - parseInt(num2);
            if (!isNaN(result)) 
            {
				document.getElementById('fail').value = result;
            }
            if(num2 > 80)
            {
               var calc1 = 20 * 0.9;
               var calc2 = 1.2 * (parseInt(num2) - 20);
               var result2 = parseInt(calc2) + parseInt(calc1);
               document.getElementById('status').value = result2;
            }
            if(num2 < 60)
            {
               var result3 = 0;
               document.getElementById('status').value = result3;
            }
            if(num2 >= 60 && num2 <= 80)
            {
               var result4 = parseInt(num2) * 0.9;
               document.getElementById('status').value = result4;
            }
        }
    });
   </script>