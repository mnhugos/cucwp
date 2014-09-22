/**
 * Created with JetBrains PhpStorm.
 * User: mhugos
 * Date: 6/7/13
 * Time: 5:16 PM
 * To change this template use File | Settings | File Templates.
 */
(function ($) {
    Drupal.behaviors.reRegistration = {
       attach: function () {
           window.onload = function() {
                // Create a ul for jQuery tabs by grabbing the id of the fieldsets for child info entry
                // Each child fieldset was given a class "re-child" in hook_form_alter()
                var tabHTML = "";
                $('.re-child').each( function() {
                        tabHTML += "<li><a href='#" + $(this).attr('id')  + "'>";
                        tabHTML += $(this).children("legend").text();
                        tabHTML += "</a></li>";
                    });
                $('<ul></ul>').html(tabHTML).insertBefore($('#webform-component-childchildren-information-child-1'));

                // Now turn the list into tabs
                $("#webform-component-childchildren-information").tabs( {selected:0});

                // numeric-only fields
                $('#edit-submitted-parentguardian-1-zip-1').keypress( numericHandler);
                $('#edit-submitted-parentguardian-2-zip-1').keypress( numericHandler);
                $('#edit-submitted-parentguardian-1-home-phone-1').keypress( numericHandler);
                $('#edit-submitted-parentguardian-2-home-phone-1').keypress( numericHandler);
                $('#edit-submitted-parentguardian-1-cell-phone-1').keypress( numericHandler);
                $('#edit-submitted-parentguardian-2-cell-phone-1').keypress( numericHandler);
                for (var i=2; i<=6; i++) {
                    $('#edit-submitted-parent-participation-row-'+ i + '-col-1').keypress( numericHandler);
                    $('#edit-submitted-parent-participation-row-'+ i + '-col-2').keypress( numericHandler);
                }
           }
           numericHandler = function(e) {
                               var nNumeric = $.fn.ForceNumericOnly( event, e.target.value);
                               switch (nNumeric) {
                                   case 0:
                                       return false;
                               }
                           }
       }
    }
})(jQuery);