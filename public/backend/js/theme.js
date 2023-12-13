(function ($) {
	"use strict";

    // OTP Form (Focusing on next input)
    $("#otp-screen .form-control").keyup(function() {  
        if (this.value.length == 0) {
            $(this).blur().parent().prev().children('.form-control').focus();
            $(this).blur().prev('.form-control').focus();
        } else if (this.value.length == this.maxLength) {
            $(this).blur().parent().next().children('.form-control').focus();
            $(this).blur().next('.form-control').focus();
        }
    });

    /*------------------------
    tooltips
    -------------------------- */
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    

})(jQuery)