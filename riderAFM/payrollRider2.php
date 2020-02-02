<?php session_start();?>
<?php
    require('conn.php');
    $noIC = $_GET['noIC'];
    $month = $_GET['month'];
    date_default_timezone_set("asia/kuala_lumpur"); 
    $date = date('Y-m-d');
    
    
    require('../adminAFM/salaryAlgorithm.php');
?>

<!--start if employeeStatus=='temp'-->

<?php if ($BC['employeeStatus'] == 'temp' && $AC > 0){?>
            <div class="image"><img src="data:image/jpeg;base64,<?php echo base64_encode($BC['riderFacePic']);?>" class="img-fluid img-thumbnail mx-auto d-block" style="width: 50px;height: 50px;border-radius: 50%; vertical-align:middle"/></div>
           <div style="text-align:center; padding:3px"><button class="btn btn-outline-dark btn-sm btn-block"><?php $monthM=date_create($AC['date']);echo 'Month of '.date_format($monthM,"F,Y");?></button></div>
            <div style="text-align:center; padding:3px"><button class="btn btn-outline-dark btn-sm btn-block"><?php echo 'Nama: '.ucwords($BC['nama']).' (I/C Number: '.$BC['noIC'].')';?></button></div>
            <div style="text-align:center; padding:3px"><button class="btn btn-outline-dark btn-sm btn-block"><?php echo 'Account Info: ('.$BC['bankName'].': '.$BC['accNum'].')';?></button></div>
            <div class="table-responsive">
            <table id="example2" class="table table-hover table-responsive-xl">
                <thead>
                <tr style="text-align:center">
                  <th colspan="3" class="table-info">Earnings</th>
                  <th colspan="3" class="table-warning">Deductions</th>
                </tr>
                </thead>
                <thead>
                <tr style="text-align:center">
                  <th class="table-info">#</th>
                  <th class="table-info">Description</th>
                  <th class="table-info">Amount (RM)</th>
                  <th class="table-warning">#</th>
                  <th class="table-warning">Description</th>
                  <th class="table-warning">Amount (RM)</th>
                </tr>
                </thead>
                <tbody>
        
                <tr>
                <td>1</td>
                <td>Fees</td>
                <td style="text-align:right"><span id="fees" class="btn btn-light btn-sm btn-block"><?php echo $formBasicSalary;?></span></td>
                <!--earnings-->
                <td>1</td>
                <td>EPF</td>
                <td style="text-align:right"><span id="epf" class="btn btn-light btn-sm btn-block"><?php echo $epf;?></span></td>
                <!--deductions-->
	            </tr>
	            
	            <tr>
                <td>2</td>
                <td>Comission</td>
                <td style="text-align:right"><span id="comission" class="btn btn-light btn-sm btn-block"><?php echo $totalComission;?></span></td>
                <!--earnings-->
                <td>2</td>
                <td>Socso</td>
                <td style="text-align:right"><span id="socso" class="btn btn-light btn-sm btn-block"><?php echo $socso;?></span></td>
                <!--deductions-->
	            </tr>
	            
	            <tr>
                <td>3</td>
                <td>Handphone</td>
                <td style="text-align:right"><span id="handphone" class="btn btn-light btn-sm btn-block"><?php echo $formHandphone;?></span></td>
                <!--earnings-->
                <td>3</td>
                <td>EIS</td>
                <td style="text-align:right"><span id="eis" class="btn btn-light btn-sm btn-block"><?php echo $eis;?></span></td>
                <!--deductions-->
	            </tr>
                </tbody>
                
                <tfoot>
                    
                <tr style="text-align:center">
                  <th class="table-info" colspan="2">Total Earnings</th>
                  <th class="table-info" style="text-align:right"><span id="totalEarning" class="btn btn-light btn-sm btn-block"><?php echo $totalEarning;?></span></th>
                  <th class="table-warning" colspan="2">Total Deductions</th>
                  <th class="table-warning"><span id="totalDeduction" class="btn btn-light btn-sm btn-block"><?php echo $totalDeduction;?></span></th>
                </tr>
                
                <tr style="text-align:center">
                  <th class="table-success" colspan="3">Grand Total</th>
                  <th class="table-success" colspan="3"><span id="grandTotal" class="btn btn-light btn-sm btn-block"><?php echo $grandTotal;?></span></th>
                </tr>
                
                </tfoot>
              </table>
             </div>
<?php }?> 

<!--end if employeeStatus=='temp'-->

        <input type="hidden" name="terms" value="agree"/>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
 
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/inputmask/jquery.inputmask.bundle.js"></script>

<!--calculate total earning, deduction, grand total
<script src="../calculateTotalSalary.js"></script> -->

<script type="text/javascript">
  $(function() {
     'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
   }, false); 
      
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });  
      
      
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 10000
    });

    $('#swalDefaultSuccess').click(function() {
      Toast.fire({
        type: 'success',
        title: 'Registration Succesfull.Thank you'
      })
    });
    $('.swalDefaultInfo').click(function() {
      Toast.fire({
        type: 'info',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultError').click(function() {
      Toast.fire({
        type: 'error',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultWarning').click(function() {
      Toast.fire({
        type: 'warning',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultQuestion').click(function() {
      Toast.fire({
        type: 'question',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });

    $('#toastrDefaultSuccess').click(function() {
      toastr.success('Registration Succesfull.Thank you.')
    });
    $('.toastrDefaultInfo').click(function() {
      toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultError').click(function() {
      toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultWarning').click(function() {
      toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
  });

</script>
