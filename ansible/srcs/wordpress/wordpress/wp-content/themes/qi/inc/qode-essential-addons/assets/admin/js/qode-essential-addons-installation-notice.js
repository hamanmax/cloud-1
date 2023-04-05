(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefEssentialAddonsDismissNotice.init();
			qodefEssentialAddonsInstall.init();
		}
	);

	var qodefEssentialAddonsDismissNotice = {
		init: function () {
			var noticeHolder = $('.qi-essential-addons-plugin-notice-wrapper');

			if( noticeHolder.length ) {
				var dismissButton =  noticeHolder.find('.notice-dismiss'),
					nonceHolder = noticeHolder.find('#qi-essential-addons-plugin-notice-nonce');

				if( dismissButton.length ){
					dismissButton.on('click', function() {
						$.ajax(
							{
								type: 'POST',
								data: {
									action: 'qi_dismiss_essential_addons_plugin_notice',
									nonce: nonceHolder.val()
								},
								url: ajaxurl
							}
						);
					})
				}
			}
		}
	}

	var qodefEssentialAddonsInstall = {
		init: function () {
			var noticeHolder = $('.qi-essential-addons-plugin-notice-wrapper');

			if( noticeHolder.length ){
				var submitButton = noticeHolder.find('.qi-install-essential-addons-btn'),
					nonceHolder = noticeHolder.find('#qi-essential-addons-plugin-notice-nonce');

				if( submitButton.length ){
					var action = submitButton.data('action'),
						redirectUrl = submitButton.data('redirect-url'),
						submittingLabel = '';

					if( action === 'install' ) {
						submittingLabel = submitButton.data('installing-label');
					} else if ( action === 'activate' ) {
						submittingLabel = submitButton.data('activating-label');
					}

					submitButton.on('click', function() {
						submitButton.text( submittingLabel )
						$.ajax(
							{
								type: 'POST',
								data: {
									action: 'qi_essential_addons_plugin_installation',
									pluginAction: action,
									redirectUrl: redirectUrl,
									nonce: nonceHolder.val()
								},
								url: ajaxurl,
								success: function ( data ) {
									var response = $.parseJSON( data );

									if( response.status === 'success' ){
										submitButton.text( response.message );
										window.location.href = response.redirect;
									}
								}
							}
						);
					})
				}
			}
		}
	}

})( jQuery );
