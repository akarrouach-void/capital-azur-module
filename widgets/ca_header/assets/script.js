(function ($, Drupal, once) {
	'use strict';

	Drupal.behaviors.caHeader = {
		attach: function (context) {
			once('ca-header-menu', '[data-ca-menu-toggle]', context).forEach(
				function (button) {
					$(button).on('click', function () {
						var $iconPath = $(this).find('path');
						var $drawer = $('[data-ca-mobile-menu]');

						if ($drawer.hasClass('hidden')) {
							$drawer.removeClass('hidden');
							// Change icon to 'X' (close)
							$iconPath.attr('d', 'M6 18L18 6M6 6l12 12');
						} else {
							$drawer.addClass('hidden');
							// Change icon back to hamburger
							$iconPath.attr('d', 'M4 6h16M4 12h16M4 18h16');
						}
					});
				},
			);
		},
	};
})(jQuery, Drupal, once);
