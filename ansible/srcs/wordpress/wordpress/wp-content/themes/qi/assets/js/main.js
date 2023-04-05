(function ( $ ) {
	'use strict';

	window.qodef = {};

	qodef.body         = $( 'body' );
	qodef.html         = $( 'html' );
	qodef.window       = $( window );
	qodef.windowWidth  = $( window ).width();
	qodef.windowHeight = $( window ).height();
	qodef.scroll       = 0;

	$( document ).ready(
		function () {
			qodef.scroll = $( window ).scrollTop();
		}
	);

	$( window ).resize(
		function () {
			qodef.windowWidth  = $( window ).width();
			qodef.windowHeight = $( window ).height();
		}
	);

	$( window ).scroll(
		function () {
			qodef.scroll = $( window ).scrollTop();
		}
	);

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefResizeIframes.init();
		}
	);

	$( window ).resize(
		function () {
			qodefResizeIframes.init();
		}
	);

	/**
	 * Resize oembed iframes
	 */
	var qodefResizeIframes = {
		init: function () {
			var $holder = $( '.qodef-blog' );

			if ( $holder.length ) {
				qodefResizeIframes.resize( $holder );
			}
		},
		resize: function ( $holder ) {
			var $iframe = $holder.find( '.qodef-e-media iframe' );

			if ( $iframe.length ) {
				$iframe.each(
					function () {
						var $thisIframe = $( this ),
							width       = $thisIframe.attr( 'width' ),
							height      = $thisIframe.attr( 'height' ),
							newHeight   = $thisIframe.width() / width * height; // rendered width divided by aspect ratio

						$thisIframe.css( 'height', newHeight );
					}
				);
			}
		}
	};

	qodef.qodefResizeIframes = qodefResizeIframes;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefMobileHeader.init();
		}
	);

	/*
	 **	Init mobile header functionality
	 */
	var qodefMobileHeader = {
		init: function () {
			var $holder = $( '#qodef-page-mobile-header' );

			if ( $holder.length ) {
				qodefMobileHeader.initMobileHeaderOpener( $holder );
				qodefMobileHeader.initDropDownMobileMenu();
			}
		},
		initMobileHeaderOpener: function ( holder ) {
			var $opener = holder.find( '.qodef-mobile-header-opener' );

			if ( $opener.length ) {
				var $navigation = holder.find( '.qodef-mobile-header-navigation' );

				$opener.on(
					'tap click',
					function ( e ) {
						e.preventDefault();

						if ( $navigation.is( ':visible' ) ) {
							$navigation.slideUp( 450 );
							$opener.removeClass( 'qodef--opened' ).attr( 'aria-expanded', 'false' );
						} else {
							$navigation.slideDown( 450 );
							$opener.addClass( 'qodef--opened' ).attr( 'aria-expanded', 'true' );
						}
					}
				);

				document.addEventListener(
					'keyup',
					function ( event ) {
						if ( event.key === 'Escape' ) {

							if ( $navigation.is( ':visible' ) ) {
								$navigation.slideUp( 450 );
								$opener.removeClass( 'qodef--opened' ).attr( 'aria-expanded', 'false' );
							}
						} else if ( event.key === 'Tab' ) {

							if ( typeof event !== 'undefined' && $navigation.is( ':visible' ) && ! $navigation.is( event.target ) && $navigation.has( event.target ).length === 0 ) {
								$navigation.slideUp( 450 );
								$opener.removeClass( 'qodef--opened' ).attr( 'aria-expanded', 'false' );
							}
						}
					}
				);
			}
		},
		initDropDownMobileMenu: function () {
			var $dropdownOpener = $( '.qodef-mobile-header-navigation .menu-item-has-children > .qodef-mobile-menu-item-icon' );

			if ( $dropdownOpener.length ) {
				$dropdownOpener.each(
					function () {
						var $thisItem = $( this );

						$thisItem.on(
							'tap click',
							function ( e ) {
								e.preventDefault();

								var $thisItemParent                 = $thisItem.parent(),
									$thisItemParentSiblingsWithDrop = $thisItemParent.siblings( '.menu-item-has-children' );

								if ( $thisItemParent.hasClass( 'menu-item-has-children' ) ) {
									var $submenu = $thisItemParent.find( 'ul.sub-menu' ).first();

									if ( $submenu.is( ':visible' ) ) {
										$submenu.slideUp( 450 );
										$thisItemParent.removeClass( 'qodef--opened' );
										$thisItem.attr( 'aria-expanded', 'false' );
									} else {
										$thisItemParent.addClass( 'qodef--opened' );
										$thisItem.attr( 'aria-expanded', 'true' );

										if ( $thisItemParentSiblingsWithDrop.length === 0 ) {
											$thisItemParent.find( '.sub-menu' ).slideUp(
												400,
												function () {
													$submenu.slideDown( 400 );
												}
											);
										} else {
											$thisItemParent.siblings().removeClass( 'qodef--opened' ).find( '.sub-menu' ).slideUp(
												400,
												function () {
													$submenu.slideDown( 400 );
												}
											);
										}
									}
								}
							}
						);
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {

	$( document ).ready(
		function () {
			qodefDefaultNavMenu.initDropDownKeyboardNavigation();
			qodefDefaultNavMenu.setDropDownPosition();
		}
	);

	var qodefDefaultNavMenu = {
		initDropDownKeyboardNavigation: function () {
			var $menu      = $( '.qodef-header-navigation' ),
				$menuItems = $menu.find( 'li.menu-item-has-children' );

			if ( $menuItems.length ) {

				qodefDefaultNavMenu.setDropDownKeyboardNavigationEvents( $menu );

				$menuItems.each(
					function () {
						var $thisItem  = $( this ),
							$itemLinks = $thisItem.find( 'a' );

						$itemLinks.on(
							'focus blur',
							function () {
								var $focusedLink = $( this );

								qodefDefaultNavMenu.removeFocusClass( $menu );

								if ( $focusedLink.parents( 'li' ).length ) {
									$focusedLink.parents( 'li' ).addClass( 'qodef--focus' );
								}
							}
						);
					}
				);
			}
		},
		setDropDownKeyboardNavigationEvents: function ( $menu ) {
			document.addEventListener(
				'keyup',
				function ( event ) {
					if ( event.key === 'Escape' ) {
						qodefDefaultNavMenu.removeFocusClass( $menu );
					} else if ( event.key === 'Tab' ) {
						qodefDefaultNavMenu.removeFocusClass( $menu, event );
					}
				}
			);

			document.addEventListener(
				'click',
				function ( event ) {
					qodefDefaultNavMenu.removeFocusClass( $menu, event );
				}
			);
		},
		removeFocusClass: function ( $menu, event ) {
			if ( typeof event !== 'undefined' ) {
				if ( ! $menu.is( event.target ) && $menu.has( event.target ).length === 0 ) {
					$menu.find( 'li' ).removeClass( 'qodef--focus' );
				}
			} else {
				$menu.find( 'li' ).removeClass( 'qodef--focus' );
			}
		},
		setDropDownPosition: function () {
			var $menuItems = $( '.qodef-header-navigation > ul > li.qodef-menu-item--narrow.menu-item-has-children' );

			if ( $menuItems.length ) {
				$menuItems.each(
					function () {
						var $thisItem         = $( this ),
							menuItemPosition  = $thisItem.offset().left,
							dropdownMenuItem  = $thisItem.find( ' > ul' ),
							dropdownMenuWidth = dropdownMenuItem.outerWidth(),
							menuItemFromLeft  = $( window ).width() - menuItemPosition;

						var dropDownMenuFromLeft;

						if ( $thisItem.find( 'li.menu-item-has-children' ).length > 0 ) {
							dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
						}

						dropdownMenuItem.removeClass( 'qodef-drop-down--right' );

						if ( menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth ) {
							dropdownMenuItem.addClass( 'qodef-drop-down--right' );
						}
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefWooSelect2.init();
		}
	);

	var qodefWooSelect2 = {
		init: function ( settings ) {
			this.holder = [];
			this.holder.push(
				{
					holder: $( '#qodef-woo-page .woocommerce-ordering select' ),
					options: {
						minimumResultsForSearch: Infinity
					}
				}
			);
			this.holder.push(
				{
					holder: $( '#qodef-woo-page .variations select' ),
					options: {
						minimumResultsForSearch: Infinity
					}
				}
			);
			this.holder.push(
				{
					holder: $( '#qodef-woo-page #calc_shipping_country' ),
					options: {}
				}
			);
			this.holder.push(
				{
					holder: $( '#qodef-woo-page .shipping select#calc_shipping_state' ),
					options: {}
				}
			);
			this.holder.push(
				{
					holder: $( '.widget.widget_archive select' ),
					options: {}
				}
			);
			this.holder.push(
				{
					holder: $( '.widget.widget_categories select' ),
					options: {}
				}
			);
			this.holder.push(
				{
					holder: $( '.widget.widget_text select' ),
					options: {}
				}
			);

			// Allow overriding the default config
			$.extend( this.holder, settings );

			if ( typeof this.holder === 'object' ) {
				$.each(
					this.holder,
					function ( key, value ) {
						qodefWooSelect2.createSelect2( value.holder, value.options );
					}
				);
			}
		},
		createSelect2: function ( $holder, options ) {
			if ( typeof $holder.select2 === 'function' ) {
				$holder.select2( options );
			}
		}
	};

})( jQuery );
