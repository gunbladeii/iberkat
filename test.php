<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://drive.google.com/open?id=1qhOX00b0mTFELpqL4oYYwQXJptpWxTac">
    
</head>
<body>
<input class='fromdate' value="11-12-2018" />
<input class='todate' value="<?php echo date("d-m-Y");?>"/>
<input class='calculated' />

<script type="text/javascript">
	$('.fromdate').datepicker({
    dateFormat: 'dd-mm-yy',
    changeMonth: true,
    changeYear: true,
});
$('.todate').datepicker({
    dateFormat: 'dd-mm-yy',
    changeMonth: true,
    changeYear: true,
});
$('.fromdate').datepicker().bind("change", function () {
    var minValue = $(this).val();
    minValue = $.datepicker.parseDate("dd-mm-yy", minValue);
    $('.todate').datepicker("option", "minDate", minValue);
    calculate();
});
$('.todate').datepicker().bind("change", function () {
    var maxValue = $(this).val();
    maxValue = $.datepicker.parseDate("dd-mm-yy", maxValue);
    $('.fromdate').datepicker("option", "maxDate", maxValue);
    calculate();
});
$(document).ready(function calculate(){
    var d1 = $('.fromdate').datepicker('getDate');
    var d2 = $('.todate').datepicker('getDate');
    var oneDay = 24*60*60*1000;
    var diff = 0;
    if (d1 && d2) {
  
      diff = Math.round(Math.abs((d2.getTime() - d1.getTime())/(oneDay)));
    }
    $('.calculated').val(diff);
    $('.minim').val(d1)
});
</script>
	
</body>
</html>
