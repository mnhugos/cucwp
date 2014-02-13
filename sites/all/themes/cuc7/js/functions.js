/**
 * Created with JetBrains PhpStorm.
 * User: mhugos
 * Date: 7/9/13
 * Time: 1:22 PM
 * To change this template use File | Settings | File Templates.
 */

// Numeric only control handler
jQuery.fn.ForceNumericOnly = function() {
  return this.each( function()
  {
      $(this).keydown( function(e)
      {
        var key = e.charCode || e.keyCode || 0;
        // allow backspace, tab, delete, arrows, numbers, dashes
        // and keypad numbers ONLY
        return (
          key == 8 ||    // backspace
          key == 9 ||    // tab
          key == 46 ||   // delete
          key == 189 ||  // dash
          key == 109 ||  // subtract symbol on number pad
          (key >= 37 && key <= 40) || // arrow keys
          (key >= 48 && key <= 57) || // numbers above letters
          (key >= 96 && key <= 105)   // keypad numbers
        );
      });
  });
};// JavaScript Document