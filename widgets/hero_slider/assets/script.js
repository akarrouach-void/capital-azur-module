(function ($, Drupal, once) {
  'use strict';

  Drupal.behaviors.caHeroSlider = {
    attach: function (context) {
      once('ca-hero-slider', '[data-ca-slider]', context).forEach(function (slider) {
        var $track = $(slider).find('[data-ca-slider-track]');
        var $progress = $(slider).find('[data-ca-slider-progress]');
        var total = $track.children().length;
        var current = 0;

        function goTo(index) {
          current = (index + total) % total;
          $track.css('transform', 'translateX(-' + (current * 100) + '%)');
          if ($progress.length && total > 1) {
            $progress.css('width', (((current + 1) / total) * 100) + '%');
          }
        }

        $(slider).find('[data-ca-slider-next]').on('click', function () { goTo(current + 1); });
        $(slider).find('[data-ca-slider-prev]').on('click', function () { goTo(current - 1); });

        if (total > 1) {
          setInterval(function () { goTo(current + 1); }, 5000);
        }
      });
    }
  };

})(jQuery, Drupal, once);
