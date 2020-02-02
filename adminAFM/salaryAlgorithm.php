
<?php
    /*if (isset($_POST['submit'])) {
    	$mysqli->query("INSERT INTO `login` (`noIC`, `nama`, `username`, `employeeID`, `password`, `role`, `terms`) VALUES ('$noIC', '$nama', '$username', '$employeeID', '$password', '$role', '$terms')");
    	
    	header("location:registerRider.php");
    }*/

    $formulaSalary = $mysqli->query("SELECT * FROM `formulaSalary`");
    $FS = mysqli_fetch_assoc($formulaSalary);
    
    $bankCall = $mysqli->query("SELECT employeeData.riderFacePic, employeeData.employeeStatus, employeeData.noIC, employeeData.nama, employeeData.accNum, employeeData.codeBank, bankName.bankName FROM `employeeData` INNER JOIN `bankName` ON bankName.codeBank = employeeData.codeBank WHERE `noIC` = '$noIC'");
    $BC = mysqli_fetch_assoc($bankCall);
    
    $attendanceCall = $mysqli->query("SELECT date, COUNT(date) AS attendNo, month, noIC, time, timeOut FROM `attendance` WHERE `noIC` = '$noIC' AND `month` = '$month' GROUP BY `month`");
    $AC = mysqli_fetch_assoc($attendanceCall);
    
    $timeCall = $mysqli->query("SELECT * FROM `attendance` WHERE `noIC` = '$noIC' AND `month` = '$month'");
    $TC = mysqli_fetch_assoc($timeCall);
    
    $parcelCall = $mysqli->query("SELECT *, SUM(status) AS totalCommission FROM `infoParcel` WHERE `noIC` = '$noIC' AND `month` = '$month' GROUP BY `month`");
    $PC = mysqli_fetch_assoc($parcelCall);
    
    $parcelOil = $mysqli->query("SELECT *, SUM(oil) AS oilT FROM `infoParcel` WHERE `noIC` = '$noIC' AND `month` = '$month' GROUP BY `month`");
    $PCO = mysqli_fetch_assoc($parcelOil);
    
    /*kira basic salary*/
    $basic=$FS['basicSalary'];
    $totalAttend=$AC['attendNo'];
    $formBasicSalary= round($basic,2);
    /*end kira basic salary*/
    
    /*kira basic petrol*/
    $petrol=$FS['petrol'];
    $totalAttend=$AC['attendNo'];
    $formPetrol= round($petrol * ($totalAttend / 26),2);
    /*end kira basic petrol*/
    
    /*kira basic handphone*/
    $handphone=$FS['handphone'];
    $totalAttend=$AC['attendNo'];
    $formHandphone= round($handphone,2);
    /*end kira basic handphone*/
    
    /*kira basic commision*/
    $comission=$PC['totalCommission'];
    $totalComission = round($comission,2);
    /*end kira basic commision*/
    
     /*kira total oil*/
    $oil=$PCO['oilT'];
    $totalOil = round($oil,2);
    /*end kira total oil*/
    
    /*kira basic attAllow*/
    $attAllow=$FS['attAllow'];
    $totalAttend=$AC['attendNo'];
    /*end kira attAllow*/
    
    /*kira basic epf*/
    $totalEarning = round($formBasicSalary + $formHandphone + $totalComission,2);
    $epf=round(0.11 * $totalEarning,2);
    /*end kira basic epf*/
    
    /*eis formula*/
    require('eisTable.php');
    /*end eis formula*/
    
    /*socso formula*/
    require('socsoTable.php');
    /*end socso formula*/
    
    /*calculate total and grand total*/
    $totalDeduction = round($epf + $eis + $socso,2);
    $grandTotal = round($totalEarning - $totalDeduction,2);
    /*end calculate total and grand total*/
    
?>