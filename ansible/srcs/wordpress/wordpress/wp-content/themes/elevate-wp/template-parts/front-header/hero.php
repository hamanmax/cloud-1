<?php $component = \ColibriWP\Theme\View::getData( 'component' ); ?>
<div class="wp-block wp-block-kubio-hero position-relative wp-block-kubio-hero__outer elevate-front-header__k__J6FPNZyUrn-outer elevate-local-lEgv7azZau-outer d-flex h-section-global-spacing align-items-lg-center align-items-md-center align-items-center" data-kubio="kubio/hero" id="hero">
	<?php $component->printBackground(); ?><?php $component->printSeparator(); ?>
	<div class="position-relative wp-block-kubio-hero__inner elevate-front-header__k__J6FPNZyUrn-inner elevate-local-lEgv7azZau-inner h-navigation-padding h-section-grid-container h-section-boxed-container">
		<div class="wp-block wp-block-kubio-row position-relative wp-block-kubio-row__container elevate-front-header__k__bgnhUSaQMl-container elevate-local-GY0EIawfVu-container gutters-row-lg-2 gutters-row-v-lg-2 gutters-row-md-2 gutters-row-v-md-2 gutters-row-3 gutters-row-v-2" data-kubio="kubio/row">
			<div class="position-relative wp-block-kubio-row__inner elevate-front-header__k__bgnhUSaQMl-inner elevate-local-GY0EIawfVu-inner h-row align-items-lg-stretch align-items-md-stretch align-items-stretch justify-content-lg-center justify-content-md-center justify-content-center gutters-col-lg-2 gutters-col-v-lg-2 gutters-col-md-2 gutters-col-v-md-2 gutters-col-3 gutters-col-v-2">
				<div class="wp-block wp-block-kubio-column position-relative wp-block-kubio-column__container elevate-front-header__k__9IGHpldIpw-container elevate-local-bs-ZNxDQgo-container d-flex h-col-lg-auto h-col-md-auto h-col-auto" data-kubio="kubio/column">
					<div class="position-relative wp-block-kubio-column__inner elevate-front-header__k__9IGHpldIpw-inner elevate-local-bs-ZNxDQgo-inner d-flex h-flex-basis h-px-lg-2 v-inner-lg-2 h-px-md-2 v-inner-md-2 h-px-2 v-inner-2">
						<div class="position-relative wp-block-kubio-column__align elevate-front-header__k__9IGHpldIpw-align elevate-local-bs-ZNxDQgo-align h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-start align-self-md-start align-self-start">
							<?php elevate_wp_theme()->get( 'front-title' )->render(); ?><?php elevate_wp_theme()->get( 'front-subtitle' )->render(); ?><?php elevate_wp_theme()->get( 'buttons' )->render(); ?>
						</div>
					</div>
				</div>
				<div class="wp-block wp-block-kubio-column position-relative wp-block-kubio-column__container elevate-front-header__k__3BQtoGTlnJ-container elevate-local-BElnOMPpy-container d-flex h-col-lg-auto h-col-md-auto h-col-auto" data-kubio="kubio/column">
					<div class="position-relative wp-block-kubio-column__inner elevate-front-header__k__3BQtoGTlnJ-inner elevate-local-BElnOMPpy-inner d-flex h-flex-basis h-px-lg-2 v-inner-lg-2 h-px-md-2 v-inner-md-2 h-px-2 v-inner-2">
						<div class="position-relative wp-block-kubio-column__align elevate-front-header__k__3BQtoGTlnJ-align elevate-local-BElnOMPpy-align h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-start align-self-md-start align-self-start">
							<?php elevate_wp_theme()->get( 'front-image' )->render(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="position-relative wp-block-kubio-hero__inlineScript elevate-front-header__k__J6FPNZyUrn-inlineScript elevate-local-lEgv7azZau-inlineScript">
		<script type='text/javascript'>
			(function () {
				// forEach polyfill
				if (!NodeList.prototype.forEach) {
					NodeList.prototype.forEach = function (callback) {
						for (var i = 0; i < this.length; i++) {
							callback.call(this, this.item(i));
						}
					}
				}
				var navigation = document.querySelector('[data-colibri-navigation-overlap="true"], .h-navigation_overlap');
				if (navigation) {
					var els = document
						.querySelectorAll('.h-navigation-padding');
					if (els.length) {
						els.forEach(function (item) {
							item.style.paddingTop = navigation.offsetHeight + "px";
						});
					}
				}
			})();
		</script>
	</div>
</div>
