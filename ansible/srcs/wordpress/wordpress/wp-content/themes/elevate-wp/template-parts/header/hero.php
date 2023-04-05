<?php $component = \ColibriWP\Theme\View::getData( 'component' ); ?>
<div style="<?php $component->printPostFeaturedImage(); ?>" class="wp-block wp-block-kubio-hero position-relative wp-block-kubio-hero__outer elevate-header__k__KFTMhA6WOVh-outer elevate-local-WnwSdUm5wJL-outer d-flex h-section-global-spacing align-items-lg-center align-items-md-center align-items-center" data-kubio="kubio/hero" id="hero">
	<?php $component->printBackground(); ?><?php $component->printSeparator(); ?>
	<div class="position-relative wp-block-kubio-hero__inner elevate-header__k__KFTMhA6WOVh-inner elevate-local-WnwSdUm5wJL-inner h-navigation-padding h-section-grid-container h-section-boxed-container">
		<div class="wp-block wp-block-kubio-row position-relative wp-block-kubio-row__container elevate-header__k__vv0pRzL5YoZ-container elevate-local-Xs6ydDE8r-R-container gutters-row-lg-0 gutters-row-v-lg-0 gutters-row-md-0 gutters-row-v-md-0 gutters-row-0 gutters-row-v-0" data-kubio="kubio/row">
			<div class="position-relative wp-block-kubio-row__inner elevate-header__k__vv0pRzL5YoZ-inner elevate-local-Xs6ydDE8r-R-inner h-row align-items-lg-stretch align-items-md-stretch align-items-stretch justify-content-lg-center justify-content-md-center justify-content-center gutters-col-lg-0 gutters-col-v-lg-0 gutters-col-md-0 gutters-col-v-md-0 gutters-col-0 gutters-col-v-0">
				<div class="wp-block wp-block-kubio-column position-relative wp-block-kubio-column__container elevate-header__k__vPVKm6K-swr-container elevate-local-ogaY_Aqs4Y5-container d-flex h-col-lg-auto h-col-md-auto h-col-auto" data-kubio="kubio/column">
					<div class="position-relative wp-block-kubio-column__inner elevate-header__k__vPVKm6K-swr-inner elevate-local-ogaY_Aqs4Y5-inner d-flex h-flex-basis h-px-lg-2 v-inner-lg-2 h-px-md-2 v-inner-md-2 h-px-2 v-inner-2">
						<div class="position-relative wp-block-kubio-column__align elevate-header__k__vPVKm6K-swr-align elevate-local-ogaY_Aqs4Y5-align h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-center align-self-md-center align-self-center">
							<?php elevate_wp_theme()->get( 'inner-title' )->render(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="position-relative wp-block-kubio-hero__inlineScript elevate-header__k__KFTMhA6WOVh-inlineScript elevate-local-WnwSdUm5wJL-inlineScript">
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
