/**
 * Created with JetBrains PhpStorm.
 * User: mhugos
 * Date: 1/2/15
 * Time: 4:02 PM
 * To change this template use File | Settings | File Templates.
 */
(function ($) {
  Drupal.behaviors.ruauu = {
    attach: function (context, settings) {
//      var options = {
//          'easing': swing
//      }

      $('.block-ruauu').find('h2').click( function () {
          $('.questions').slideToggle( "slow");
      });
    }
  };


})(jQuery);