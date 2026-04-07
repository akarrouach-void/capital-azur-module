(function ($, Drupal, once) {
	'use strict';

	Drupal.behaviors.caFaqAccordion = {
		attach: function (context) {
			once('ca-faq-accordion', '[data-ca-faq-accordion]', context).forEach(
				function (accordion) {
					var $accordion = $(accordion);

					$accordion.find('[data-ca-faq-item]').each(function () {
						var $item = $(this);
						var $trigger = $item.find('[data-ca-faq-trigger]');

						$trigger.on('click', function (e) {
							e.preventDefault();

							var $content = $item.find('[data-ca-faq-content]');
							var $title = $item.find('[data-ca-faq-title]');
							var $icon = $item.find('[data-ca-faq-icon]');
							var $divider = $item.find('[data-ca-faq-divider]');

							var isOpen = !$content.hasClass('hidden');

							// Close all others
							$accordion
								.find('[data-ca-faq-content]')
								.not($content)
								.slideUp(300, function () {
									$(this).addClass('hidden').css('display', '');
								});
							$accordion
								.find('[data-ca-faq-title]')
								.not($title)
								.removeClass('text-[#2b6df7]')
								.addClass('text-[#0B1526]');
							$accordion
								.find('[data-ca-faq-icon]')
								.not($icon)
								.html('&plus;')
								.removeClass('text-[#2b6df7]')
								.addClass('text-gray-400');
							$accordion
								.find('[data-ca-faq-divider]')
								.not($divider)
								.removeClass('bg-gray-100')
								.addClass('bg-transparent');

							// Toggle this one
							if (!isOpen) {
								$title.removeClass('text-[#0B1526]').addClass('text-[#2b6df7]');
								$icon
									.html('&minus;')
									.removeClass('text-gray-400')
									.addClass('text-[#2b6df7]');
								$divider.removeClass('bg-transparent').addClass('bg-gray-100');
								$content.hide().removeClass('hidden').slideDown(300);
							} else {
								// If already open, clicking closes it
								$title.addClass('text-[#0B1526]').removeClass('text-[#2b6df7]');
								$icon
									.html('&plus;')
									.addClass('text-gray-400')
									.removeClass('text-[#2b6df7]');
								$divider.addClass('bg-transparent').removeClass('bg-gray-100');
								$content.slideUp(300, function () {
									$(this).addClass('hidden').css('display', '');
								});
							}
						});
					});
				},
			);
		},
	};
})(jQuery, Drupal, once);
