$(document).ready(function() {
        var r = $("#register2");
        r.hide(); 
        
        $("#agreeTerms").click(function () {
            if ($(this).is(":checked")) {
                $("#register2").show();
                $("#register1").hide();
            } else {
                $("#register2").hide();
                $("#register1").show();
            }
        });
    });