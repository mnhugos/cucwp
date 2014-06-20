/**
 * Created with JetBrains PhpStorm.
 * User: mhugos
 * Date: 7/9/13
 * Time: 1:22 PM
 * To change this template use File | Settings | File Templates.
 */

// Numeric only control handler
jQuery.fn.ForceNumericOnly = function(event, amt) {
        event = (event) ? event : window.event;
        var charCode = (event.which) ? event.which : event.keyCode;

        if (charCode == 46) {  // delete key is okay
            return true;
        }
        if (charCode < 48 || charCode > 57) {  // 0 - 9
            return 0; // Numbers Only Please
        }
    };

jQuery.fn.isValidDollarAmt = function(amt) {
    if (amt) {
        var regExp = /^(\d+)\.{0,1}(\d{0,2})$/;
        var found = amt.toString().match(regExp);
        if (!found) {
            return false; // Something's wrong
        }
        return true;
    };

};// JavaScript Document