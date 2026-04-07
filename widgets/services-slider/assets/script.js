(function ($, Drupal, once) {
	'use strict';

	Drupal.behaviors.caServicesSlider = {
		attach: function (context) {
			once('ca-services-slider', '[data-ca-services-slider]', context).forEach(
				function (slider) {
					var $track = $(slider).find('[data-ca-services-track]');
					var $cards = $track.children();
					var total = $cards.length;
					var current = 0;

					function getVisibleCards() {
						var w = $(window).width();
						if (w < 768) return 1;
						if (w < 1024) return 2;
						return 4;
					}

					function cardWidth() {
						if ($cards.length > 1) {
							// Calculate exact distance including flex gaps
							return (
								$cards.eq(1).position().left - $cards.eq(0).position().left
							);
						}
						return $cards.first().outerWidth(true);
					}

					function maxIndex() {
						return Math.max(0, total - getVisibleCards());
					}

					function goTo(index) {
						current = Math.max(0, Math.min(index, maxIndex()));
						$track.css(
							'transform',
							'translateX(-' + current * cardWidth() + 'px)',
						);
					}

					$(window).on('resize', function () {
						goTo(current);
					});

					$(slider)
						.find('[data-ca-services-next]')
						.on('click', function () {
							goTo(current + 1);
						});
					$(slider)
						.find('[data-ca-services-prev]')
						.on('click', function () {
							goTo(current - 1);
						});
				},
			);
		},
	};
})(jQuery, Drupal, once);
