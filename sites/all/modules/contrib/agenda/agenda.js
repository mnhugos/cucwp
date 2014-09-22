(function ($) {

  Drupal.behaviors.agenda = {
    attach: function(context, settings) {
        $( "#hello" ).dialog({
            autoOpen: false,
            resizable: true,
            modal: true,
            overlay: {
                backgroundColor: '#eee',
                opacity: 0.5
            }
        });
        $(".where").dialog({
            autoOpen: false
        })

        $('#say_it').click(function () {
            $("#hello").dialog("open");
        });


        $('.agenda-block .calendar_title').click(function () {
            $(".where").dialog("open");
        });
    }
  };

})(jQuery);
