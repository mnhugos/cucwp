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
        else {
            fullName.addEventListener( 'change', function() { get_lastName( fullName, formLastName)});
            for (var i=0; i<paymentOptions.length; i++) {  // attach event to each payment option element
                paymentOptions[i].addEventListener( 'click', calculate_payments);
            }
            $("#edit-submitted-total-pledge-amount").change( calculate_payments);

            // Add element for numeric input error
            $("<label />", {
                class   : "lblNumbersOnly",
                text    : ""
            }).appendTo( $("#webform-component-total-pledge-amount"));

            // Check for numeric input only
            $("#edit-submitted-total-pledge-amount").keypress( numeric_only(event))
        }
    });

    function numeric_only(event) {
        var amt = $("#edit-submitted-total-pledge-amount").val();
        event = (event) ? event : window.event;
        var charCode = (event.which) ? event.which : event.keyCode;
        if (charCode == 46) {
            return true;
        }
        if (charCode < 48 || charCode > 57) {
            $(".lblNumbersOnly").text('Numbers Only Please');
            return false;
        }
        if (amt && (amt.toString().match(/\./g).length > 1)) {
            $(".lblNumbersOnly").text('Too Many Decimals');
            return false;
        }
        $(".lblNumbersOnly").text('');
        return true;
    };

    function calculate_payments() {
        var totalPledge = $('#edit-submitted-total-pledge-amount').val();
        totalPledge = (totalPledge > 0 ? totalPledge.replace(/\D/g, '') : 0);

        // for each radio button
        jQuery( "input[name='submitted[payments_will_be_made_as_follows]']").each( function() {
            $(this).siblings( '.calculatedPayment').remove();   // remove installment text field in case it already exists
            if (this.checked) {                                 // if active button
                if ($(this).val() != 0) {                       // and if this is NOT the "Other" button...
                    var amt = 0;
                    var installment = "(Each payment: " + Math.round( totalPledge*100 / $(this).val()) / 100 + ")";
                    $("<span />", {                             // create installment text field
                        class   : "calculatedPayment",
                        text    : installment
                    }).appendTo( $(this).parent());
                }
                else {                                          // if this IS the "Other" button, let user input amount
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