
<!--start if employeeStatus!='temp'-->

<?php if ($BC['employeeStatus'] != 'temp' && $AC > 0){?>
            <div class="image"><img src="data:image/jpeg;base64,<?php echo base64_encode($BC['riderFacePic']);?>" class="img-fluid img-thumbnail mx-auto d-block" style="width: 50px;height: 50px;border-radius: 50%; vertical-align:middle"/></div>
            <div style="text-align:center; padding:3px"><button class="btn btn-outline-dark btn-sm btn-block"><?php $monthM=date_create($AC['date']);echo 'Month of '.date_format($monthM,"F,Y");?></button></div>
            <div style="text-align:center; padding:3px"><button class="btn btn-outline-dark btn-sm btn-block"><?php echo 'Nama: '.ucwords($BC['nama']).' (I/C Number: '.$BC['noIC'].')';?></button></div>
            <div style="text-align:center; padding:3px"><button class="btn btn-outline-dark btn-sm btn-block"><?php echo 'Account Info: ('.$BC['bankName'].': '.$BC['accNum'].')';?></button></div>
            <table id="example2" class="table table-sm table-hover table-responsive-sm">
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
                <td>Salary</td>
                <td style="text-align:right"><span id = "fees" class="btn btn-light btn-sm btn-block"><?php echo $formBasicSalary;?></span></td>
                <!--earnings-->
                <td>1</td>
                <td>Penalty</td>
                <td style="text-align:right"><span id = "penalty" class="btn btn-light btn-sm btn-block"><?php echo 11.25;?></span></td>
                <!--deductions-->
	            </tr>
	            
	            <tr>
                <td>2</td>
                <td>Petrol</td>
                <td style="text-align:right"><span id = "petrol" class="btn btn-light btn-sm btn-block"><?php echo $formPetrol;?></span></td>
                <!--earnings-->
                <td>2</td>
                <td>Advance</td>
                <td style="text-align:right"><span id = "advance" class="btn btn-light btn-sm btn-block"><?php echo $FS['advance'];?></span></td>
                <!--deductions-->
	            </tr>
	            
	            <tr>
                <td>3</td>
                <td>Handphone</td>
                <td style="text-align:right"><span id = "handphone" class="btn btn-light btn-sm btn-block"><?php echo $formHandphone;?></span></td>
                <!--earnings-->
                <td>3</td>
                <td>KWSP(EPF)</td>
                <td style="text-align:right"><span id = "epf" class="btn btn-light btn-sm btn-block"><?php echo $epf;?></span></td>
                <!--deductions-->
	            </tr>
	            
	            <tr>
                <td>4</td>
                <td>Comission</td>
                <td style="text-align:right"><span id = "comission" class="btn btn-light btn-sm btn-block"><?php formCommision();?></span></td>
                <!--earnings-->
                <td>4</td>
                <td>SOCSO</td>
                <td style="text-align:right"><span id = "socso" class="btn btn-light btn-sm btn-block"></span></td>
                <!--deductions-->
	            </tr>
	            
	            <tr>
                <td>5</td>
                <td>Overtime</td>
                <td style="text-align:right"><span id = "overtime"  class="btn btn-light btn-sm btn-block"></span></td>
                <!--earnings-->
                <td>5</td>
                <td>EIS</td>
                <td style="text-align:right"><span id = "eis" class="btn btn-light btn-sm btn-block"></span></td>
                <!--deductions-->
	            </tr>
                
                </tbody>
                
                <tfoot>
                    
                <tr style="text-align:center">
                  <th class="table-info" colspan="2">Total Earnings</th>
                  <th class="table-info"><span id = "totalEarning" class="btn btn-light btn-sm btn-block"></span></th>
                  <th class="table-warning" colspan="2">Total Deductions</th>
                  <th class="table-warning"><span id = "totalDeduction" class="btn btn-light btn-sm btn-block"></span></th>
                </tr>
                
                <tr style="text-align:center">
                  <th class="table-success" colspan="3">Grand Total</th>
                  <th class="table-success" colspan="3"><span id = "grandTotal" class="btn btn-light btn-sm btn-block"></span></th>
                </tr>
                
                </tfoot>
                
              </table>
<?php }?> 

<!--end if employeeStatus!='temp'-->