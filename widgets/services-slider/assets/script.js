(function ($, Drupal, once) {
  'use strict';

  Drupal.behaviors.caServicesSlider = {
    attach: function (context) {
      once('ca-services-slider', '[data-ca-services-slider]', context).forEach(function (slider) {
        var $track = $(slider).find('[data-ca-services-track]');
        var $cards = $track.children();
        var total = $cards.length;
        var current = 0;
        var visible = 4; // cards visible at once

        function cardWidth() {
          return $cards.first().outerWidth(true);
        }

        function maxIndex() {
          return Math.max(0, total - visible);
        }

        function goTo(index) {
          current = Math.max(0, Math.min(index, maxIndex()));
          $track.css('transform', 'translateX(-' + (current * cardWidth()) + 'px)');
        }

        $(slider).find('[data-ca-services-next]').on('click', function () { goTo(current + 1); });
        $(slider).find('[data-ca-services-prev]').on('click', function () { goTo(current - 1); });
      });
    }
  };

})(jQuery, Drupal, once);
