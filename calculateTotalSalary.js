$( document ).ready(function() {
    
               /*totalEarnings Group*/
               var fees = parseFloat($('#fees').text()) || 0;
               var handphone = parseFloat($('#handphone').text()) || 0;
               var comission = parseFloat($('#comission').text()) || 0;
               var n = $('#totalEarning');
               var m = n.toFixed(2);
               m.text(fees + handphone + comission);
               
               /*totalDeductions Group*/
               var epf = parseFloat($('#epf').text()) || 0;
               var socso = parseFloat($('#socso').text()) || 0;
               var eis = parseFloat($('#eis').text()) || 0;
               var a =  $('#totalDeduction');
               var b = a.toFixed(2);
               b.text(epf + socso + eis);
               
               /*calculate grand total*/
               var totalEarning = parseFloat($('#totalEarning').text()) || 0;
               var totalDeduction = parseFloat($('#totalDeduction').text()) || 0;
               var c = $('#grandTotal');
               var d = c.toFixed(2);
               d.text(totalEarning - totalDeduction);
               
               
});