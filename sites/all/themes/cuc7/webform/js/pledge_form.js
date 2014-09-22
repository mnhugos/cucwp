/**
 * Created with JetBrains PhpStorm.
 * User: margaret.hugos-gold
 * Date: 2/23/13
 * Time: 10:00 PM
 * To change this template use File | Settings | File Templates.
 */
(function($) {
    $(window).load( function() {
        var fullName = document.getElementById( "edit-submitted-your-names");
        var formLastName = document.getElementById( "edit-submitted-lastname");
        var paymentOtherOption = document.getElementById( "edit-submitted-payments-will-be-made-as-follows-5");
        var totalPledgeAmt = document.getElementById( "edit-submitted-total-pledge-amount");
        var paymentOptions = document.getElementsByName( "submitted[payments_will_be_made_as_follows]");

        if (!document.addEventListener) {   // a simple check for IE8 and below: they don't use 'addEventListener'
            totalPledgeAmt.attachEvent( 'onchange', calculate_payments);
            fullName.attachEvent( 'onchange', get_lastName);
            for (var i=0; i<paymentOptions.length; i++) {  // attach event to each payment option element
                paymentOptions[i].attachEvent( 'onclick', calculate_payments);
            }
        }
        else {   // *********** NOT IE8 or below *************************
            fullName.addEventListener( 'change', function() { get_lastName( fullName, formLastName)});
            for (var i=0; i<paymentOptions.length; i++) {  // attach event to each payment option radio
                paymentOptions[i].addEventListener( 'click', calculate_payments);
            }
            $("#edit-submitted-total-pledge-amount").change( calculate_payments);

            // Create element for numeric input error
            $("<label />", {
                class   : "lblDollarError",
                text    : ""
            }).appendTo( $("#webform-component-total-pledge-amount"));

            // Check for numeric input
            $("#edit-submitted-total-pledge-amount").keypress( function(e){
                var nNumeric = $.fn.ForceNumericOnly( event, e.target.value );
                switch (nNumeric) {
                    case 0:
                        $(".lblDollarError").text("Numbers Only Please");
                        return false;
//                    case -1:
//                        $(".lblDollarError").text("Start with at least $1.00");
//                        return false;
                    default:
                        $(".lblDollarError").text("");
                        return true;
                }
            });
        }
    });

    function calculate_payments() {
        if ($("#edit-submitted-total-pledge-amount").val() == '') {
            $(".lblDollarError").text(" Please enter an amount to pledge")
            $("#edit-submitted-total-pledge-amount").focus();
            return false;
        }
        if (!($.fn.isValidDollarAmt( $("#edit-submitted-total-pledge-amount").val()))) {
//        if (!checkDollarAmt( $("#edit-submitted-total-pledge-amount").val())) {
            $(".lblDollarError").text("Either too many decimals or too many decimal places")
            $("#edit-submitted-total-pledge-amount").focus();
            return false;
        }
        else {$(".lblDollarError").text("");}

        var totalPledge = $('#edit-submitted-total-pledge-amount').val();
        totalPledge = (totalPledge > 0 ? totalPledge : 0);

        // for each radio button, clear the installment field and calculate anew for the selected one
        jQuery( "input[name='submitted[payments_will_be_made_as_follows]']").each( function() {
            $(this).siblings( '.calculatedPayment').remove();   // remove installment text field in case it already exists
            if (this.checked) {                                 // if active button
                if ($(this).val() != 0) {                       // and is NOT the "Other" button...
                    var amt = 0;                                // then calculate the installment amount
                    var installment = " (Each payment: $" + (Math.round( totalPledge*100 / $(this).val()) / 100).toFixed(2) + ")";
                    // create installment text field
                    $("<span />", {
                        class   : "calculatedPayment",
                        text    : installment
                    }).appendTo( $(this).parent());
                }
                else {                                          // if this IS the "Other" button, let user input an amount
                    $("#edit-submitted-other").focus();
                }
            }
        });
    }

    function get_lastName( fullName, formLastName) {
        var i = fullName.value.lastIndexOf( " ");
        formLastName.value = fullName.value.substr( i+1, fullName.length);
    }
}
)(jQuery)