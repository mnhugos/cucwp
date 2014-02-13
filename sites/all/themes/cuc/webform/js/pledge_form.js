/**
 * Created with JetBrains PhpStorm.
 * User: margaret.hugos-gold
 * Date: 2/23/13
 * Time: 10:00 PM
 * To change this template use File | Settings | File Templates.
 */
$(window).load( function() {
    var fullName = document.getElementById( "edit-submitted-your-names");
    var formLastName = document.getElementById( "edit-submitted-lastname");
    var paymentOtherOption = document.getElementById( "edit-submitted-payments-will-be-made-as-follows-5");
    var totalPledgeAmt = document.getElementById( "edit-submitted-total-pledge-amount");
    var paymentOptions = document.getElementsByName( "submitted[payments_will_be_made_as_follows]");

    if (!document.addEventListener) {   // a simple check for IE8 and below: they don't use 'addEventListener'
        paymentOtherOption.attachEvent( 'onclick', payment_other);
        totalPledgeAmt.attachEvent( 'onchange', calculate_payments);
        fullName.attachEvent( 'onchange', get_lastName);
        for (var i=0; i<paymentOptions.length; i++) {  // attach event to each payment option element
            paymentOptions[i].attachEvent( 'onclick', showHide);
        }
    }
    else {
        paymentOtherOption.addEventListener( 'click', payment_other);
        totalPledgeAmt.addEventListener( 'change', calculate_payments);
        fullName.addEventListener( 'change', function() { get_lastName( fullName, formLastName)});
        for (var i=0; i<paymentOptions.length; i++) {  // attach event to each payment option element
            paymentOptions[i].addEventListener( 'click', showHide);
        }
    }
});


function payment_other() {
    if (document.getElementById( "edit-submitted-payments-will-be-made-as-follows-5").checked) {
        document.getElementById("edit-submitted-other").focus();
    }
}

function showHide() {
    setHidden();
    if (!document.addEventListener) {  // IE8 or below
        if (window.event.srcElement.id != "edit-submitted-payments-will-be-made-as-follows-5") {
            window.event.srcElement.parentNode.parentNode.lastChild.style.visibility = "visible";
        }
    } else {
        if (this.id != "edit-submitted-payments-will-be-made-as-follows-5") {
            this.parentNode.parentNode.lastChild.style.visibility = "visible";
        }
    }
}

function setHidden() {
    var radioNodes = document.getElementsByName("submitted[payments_will_be_made_as_follows]");
    for (var i = 0; i < radioNodes.length-1; i++) {
        radioNodes[i].parentNode.parentNode.lastChild.style.visibility = "hidden";
    }
}

function get_lastName( fullName, formLastName) {
    var i = fullName.value.lastIndexOf( " ");
    formLastName.value = fullName.value.substr( i+1, fullName.length);
}

function calculate_payments() {
    var totalPledge = document.getElementById("edit-submitted-total-pledge-amount").value;
    if (totalPledge == "") {
        totalPledge = "0";
    }
    var installment = 0;
    var radioNodes = document.getElementsByName("submitted[payments_will_be_made_as_follows]");
    for (var i = 0; i < radioNodes.length-1; i++) {
        totalPledge.replace(/\D/g, '');
        if (totalPledge > 0) {
            installment = Math.round( totalPledge*100 / radioNodes[i].value) / 100;
        }
        if (radioNodes[i].parentNode.parentNode.lastChild.id !== "calculatedPayment") {  // node doesn't exist yet, create it
            var newDiv = document.createElement("span");
            newDiv.id = "calculatedPayment";
            var newText = document.createTextNode("(Each payment: $" + installment + ")");
            newDiv.appendChild( newText);
            radioNodes[i].parentNode.parentNode.appendChild( newDiv);
            if (radioNodes[i].checked) {
                radioNodes[i].parentNode.parentNode.lastChild.style.visibility = "visible";
            }
        }
        else {
            if (!document.addEventListener) {  // way to test if IE8 or below
                radioNodes[i].parentNode.parentNode.lastChild.innerHTML = "(Each payment: $" + installment + ")";
            } else {
                radioNodes[i].parentNode.parentNode.lastChild.textContent = "(Each payment: $" + installment + ")";
            }
        }
    }
}