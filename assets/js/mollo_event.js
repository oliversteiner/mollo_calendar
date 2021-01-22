(function($, Drupal, drupalSettings) {
  Drupal.behaviors.molloArtist = {
    attach(context, settings) {
      console.log("Mollo Artist");

        $('#mollo-calendar', context)
          .once('mollo-calendar')
          .each(() => {});

    },
  };
})(jQuery, Drupal, drupalSettings);
