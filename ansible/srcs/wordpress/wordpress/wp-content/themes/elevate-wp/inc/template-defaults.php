<?php
return array(
	'header'       =>
		array(
			'icon_list'    =>
				array(
					'selective_selector' => '.elevate-header__k__ZpGddm-LcJ-outer',
					'styleRef'           => 'ZpGddm-LcJ',
					'props'              =>
						array(),
				),
			'social_icons' =>
				array(
					'selective_selector' => '.elevate-header__k__NW-UBaFvP_o-outer',
					'styleRef'           => 'NW-UBaFvP_o',
					'props'              =>
						array(),
				),
			'logo'         =>
				array(
					'selective_selector' => '.elevate-header__k__afIZ7lcsb-container',
					'styleRef'           => 'afIZ7lcsb',
					'props'              =>
						array(
							'layoutType' => 'image',
						),
				),
			'header-menu'  =>
				array(
					'selective_selector' => '.elevate-header__k__c6BbujDIAOY-outer',
					'styleRef'           => 'c6BbujDIAOY',
					'props'              =>
						array(
							'showOffscreenMenuOn' => 'has-offcanvas-mobile',
						),
				),
			'navigation'   =>
				array(
					'selective_selector' => '.elevate-header__k__xLwdIMLPC_l-nav',
					'styleRef'           => 'Gp3qTlxXlu',
					'props'              =>
						array(
							'showTopBar' => false,
							'layoutType' => 'logo-spacing-menu',
							'width'      => 'boxed',
							'sticky'     => false,
							'overlap'    => true,
						),
					'style'              =>
						array(
							'descendants' =>
								array(
									'nav' =>
										array(
											'padding'    =>
												array(
													'top' =>
														array(
															'value' => 0,
														),
												),
											'background' =>
												array(
													'color' => 'transparent',
												),
										),
								),
							'ancestor'    =>
								array(
									'sticky' =>
										array(
											'descendants' =>
												array(
													'nav' =>
														array(
															'background' =>
																array(
																	'color' => 'white',
																),
														),
												),
										),
								),
						),
				),
			'hero'         =>
				array(
					'selective_selector' => '.elevate-header__k__KFTMhA6WOVh-outer',
					'styleRef'           => 'KFTMhA6WOVh',
					'props'              =>
						array(
							'layoutType'  => 'textWithMediaOnRight',
							'heroSection' =>
								array(
									'layout' => 'textWithMediaOnRight',
								),
						),
					'hero_column_width'  => '50',
					'style'              =>
						array(
							'descendants' =>
								array(
									'outer' =>
										array(
											'background' =>
												array(
													'type' => 'image',
													'overlay' =>
														array(
															'enabled'  => true,
															'type'     => 'color',
															'gradient' => 'linear-gradient(-20deg, rgba(183, 33, 255, 0.8) 0%,rgba(33, 212, 253, 0.8) 100%)',
															'shape'    =>
																array(
																	'value'  => 'none',
																	'isTile' => false,
																),
															'color'    =>
																array(
																	'opacity' => '0.50',
																),
														),
													'image' =>
														array(
															0 =>
																array(

																	'position' =>
																		array(
																			'x' => 50,
																			'y' => 50,
																		),
																),
														),
													'slideshow' => null,
												),
											'padding'    =>
												array(
													'top' =>
														array(
															'unit'  => 'px',
															'value' => 90,
														),
													'bottom' =>
														array(
															'unit'  => 'px',
															'value' => 160,
														),
												),
											'separators' =>
												array(
													'separatorBottom' =>
														array(),
												),
										),
								),
						),
				),
		),
	'footer'       =>
		array(
			'footer' =>
				array(
					'selective_selector' => '.elevate-footer__k__vP0mYzy99sE-outer',
					'styleRef'           => 'vP0mYzy99sE',
					'props'              =>
						array(
							'attrs' =>
								array(
									'name' => 'Footer',
								),
						),
					'style'              =>
						array(
							'descendants' =>
								array(
									'outer' =>
										array(
											'background' =>
												array(
													'color' => 'rgba(var(--kubio-color-6-variant-5),1)',
												),
										),
								),
						),
				),
		),
	'front-header' =>
		array(
			'icon_list'    =>
				array(
					'selective_selector' => '.elevate-front-header__k__ZpGddm-LcJ-outer',
					'styleRef'           => 'ZpGddm-LcJ',
					'props'              =>
						array(),
				),
			'social_icons' =>
				array(
					'selective_selector' => '.elevate-front-header__k__NW-UBaFvP_o-outer',
					'styleRef'           => 'NW-UBaFvP_o',
					'props'              =>
						array(),
				),
			'logo'         =>
				array(
					'selective_selector' => '.elevate-front-header__k__afIZ7lcsb-container',
					'styleRef'           => 'afIZ7lcsb',
					'props'              =>
						array(
							'layoutType' => 'image',
						),
				),
			'header-menu'  =>
				array(
					'selective_selector' => '.elevate-front-header__k__c6BbujDIAOY-outer',
					'styleRef'           => 'c6BbujDIAOY',
					'props'              =>
						array(
							'showOffscreenMenuOn' => 'has-offcanvas-mobile',
						),
				),
			'navigation'   =>
				array(
					'selective_selector' => '.elevate-front-header__k__xLwdIMLPC_l-nav',
					'styleRef'           => 'Gp3qTlxXlu',
					'props'              =>
						array(
							'showTopBar' => false,
							'layoutType' => 'logo-spacing-menu',
							'width'      => 'boxed',
							'sticky'     => false,
							'overlap'    => true,
						),
					'style'              =>
						array(
							'descendants' =>
								array(
									'nav' =>
										array(
											'padding'    =>
												array(
													'top' =>
														array(
															'value' => 0,
														),
												),
											'background' =>
												array(
													'color' => 'transparent',
												),
										),
								),
							'ancestor'    =>
								array(
									'sticky' =>
										array(
											'descendants' =>
												array(
													'nav' =>
														array(
															'background' =>
																array(
																	'color' => 'white',
																),
														),
												),
										),
								),
						),
				),
			'title'        =>
				array(
					'selective_selector' => '.elevate-front-header__k__ukjZtaF3MN-text',
					'styleRef'           => 'ukjZtaF3MN',
					'props'              =>
						array(
							'link' =>
								array(
									'typeOpenLink' => 'sameWindow',
								),
						),
					'style'              =>
						array(
							'descendants' =>
								array(
									'text' =>
										array(
											'textAlign' => 'center',
										),
								),
						),
				),
			'subtitle'     =>
				array(
					'selective_selector' => '.elevate-front-header__k__6JrzJfgx-N2-text',
					'styleRef'           => '6JrzJfgx-N2',
					'props'              =>
						array(),
					'style'              =>
						array(
							'descendants' =>
								array(
									'text' =>
										array(
											'textAlign' => 'center',
										),
								),
						),
				),
			'button-0'     =>
				array(
					'selective_selector' => '.elevate-front-header__k__krjLr6qWdH7-link',
					'styleRef'           => 'krjLr6qWdH7',
					'props'              =>
						array(
							'link'          =>
								array(
									'value'         => '',
									'typeOpenLink'  => 'sameWindow',
									'noFollow'      => false,
									'lightboxMedia' => '',
								),
							'preserveSpace' =>
								array(
									'text' => false,
								),
							'icon'          =>
								array(
									'name' => 'font-awesome/arrow-right',
								),
						),
				),
			'button-1'     =>
				array(
					'selective_selector' => '.elevate-front-header__k__Dud6AOZG0Hc-link',
					'styleRef'           => 'Dud6AOZG0Hc',
					'props'              =>
						array(
							'link'          =>
								array(
									'value'         => '',
									'typeOpenLink'  => 'sameWindow',
									'noFollow'      => false,
									'lightboxMedia' => '',
								),
							'preserveSpace' =>
								array(
									'text' => false,
								),
							'icon'          =>
								array(
									'name' => 'font-awesome/arrow-right',
								),
						),
				),
			'buttons'      =>
				array(
					'selective_selector' => '.elevate-front-header__k__9uoTT9gnxCy-outer',
					'styleRef'           => '9uoTT9gnxCy',
					'props'              =>
						array(),
				),
			'hero'         =>
				array(
					'image'              =>
						array(
							'selective_selector' => '.elevate-front-header__k__rEVyKQXtvE-outer',
							'styleRef'           => 'rEVyKQXtvE',
							'props'              =>
								array(),
						),
					'selective_selector' => '.elevate-front-header__k__J6FPNZyUrn-outer',
					'styleRef'           => 'J6FPNZyUrn',
					'props'              =>
						array(
							'layoutType'  => 'textWithMediaOnRight',
							'heroSection' =>
								array(
									'layout' => 'textWithMediaOnRight',
								),
						),
					'hero_column_width'  => '50',
					'style'              =>
						array(
							'descendants' =>
								array(
									'outer' =>
										array(
											'background' =>
												array(
													'type' => 'image',
													'image' =>
														array(
															0 =>
																array(

																	'position' =>
																		array(
																			'x' => 50,
																			'y' => 50,
																		),
																),
														),
													'overlay' =>
														array(
															'enabled' => true,
															'color'   =>
																array(
																	'opacity' => '0.40',
																	'value'   => '#000000',
																),
														),
													'slideshow' => null,
												),
											'padding'    =>
												array(
													'top' =>
														array(
															'value' => 150,
															'unit'  => 'px',
														),
													'bottom' =>
														array(
															'value' => 200,
															'unit'  => 'px',
														),
												),
											'separators' =>
												array(
													'separatorBottom' =>
														array(),
												),
										),
								),
						),
				),
		),
	'colors'       =>
		array(
			'kubio-color-1'           =>
				array(
					0 => 3,
					1 => 169,
					2 => 244,
				),
			'kubio-color-2'           =>
				array(
					0 => 247,
					1 => 144,
					2 => 7,
				),
			'kubio-color-3'           =>
				array(
					0 => 0,
					1 => 191,
					2 => 135,
				),
			'kubio-color-4'           =>
				array(
					0 => 102,
					1 => 50,
					2 => 255,
				),
			'kubio-color-5'           =>
				array(
					0 => 255,
					1 => 255,
					2 => 255,
				),
			'kubio-color-6'           =>
				array(
					0 => 30,
					1 => 30,
					2 => 30,
				),
			'kubio-color-1-variant-1' =>
				array(
					0 => 165,
					1 => 219,
					2 => 243,
				),
			'kubio-color-1-variant-2' =>
				array(
					0 => 84,
					1 => 194,
					2 => 243,
				),
			'kubio-color-1-variant-3' =>
				array(
					0 => 3,
					1 => 169,
					2 => 244,
				),
			'kubio-color-1-variant-4' =>
				array(
					0 => 1,
					1 => 110,
					2 => 158,
				),
			'kubio-color-1-variant-5' =>
				array(
					0 => 1,
					1 => 51,
					2 => 73,
				),
			'kubio-color-2-variant-1' =>
				array(
					0 => 246,
					1 => 214,
					2 => 171,
				),
			'kubio-color-2-variant-2' =>
				array(
					0 => 246,
					1 => 179,
					2 => 89,
				),
			'kubio-color-2-variant-3' =>
				array(
					0 => 247,
					1 => 144,
					2 => 7,
				),
			'kubio-color-2-variant-4' =>
				array(
					0 => 161,
					1 => 94,
					2 => 4,
				),
			'kubio-color-2-variant-5' =>
				array(
					0 => 76,
					1 => 44,
					2 => 2,
				),
			'kubio-color-3-variant-1' =>
				array(
					0 => 127,
					1 => 190,
					2 => 172,
				),
			'kubio-color-3-variant-2' =>
				array(
					0 => 63,
					1 => 190,
					2 => 153,
				),
			'kubio-color-3-variant-3' =>
				array(
					0 => 0,
					1 => 191,
					2 => 135,
				),
			'kubio-color-3-variant-4' =>
				array(
					0 => 0,
					1 => 105,
					2 => 74,
				),
			'kubio-color-3-variant-5' =>
				array(
					0 => 0,
					1 => 20,
					2 => 14,
				),
			'kubio-color-4-variant-1' =>
				array(
					0 => 228,
					1 => 220,
					2 => 255,
				),
			'kubio-color-4-variant-2' =>
				array(
					0 => 165,
					1 => 135,
					2 => 255,
				),
			'kubio-color-4-variant-3' =>
				array(
					0 => 102,
					1 => 50,
					2 => 255,
				),
			'kubio-color-4-variant-4' =>
				array(
					0 => 67,
					1 => 33,
					2 => 169,
				),
			'kubio-color-4-variant-5' =>
				array(
					0 => 33,
					1 => 16,
					2 => 84,
				),
			'kubio-color-5-variant-1' =>
				array(
					0 => 255,
					1 => 255,
					2 => 255,
				),
			'kubio-color-5-variant-2' =>
				array(
					0 => 204,
					1 => 204,
					2 => 204,
				),
			'kubio-color-5-variant-3' =>
				array(
					0 => 153,
					1 => 153,
					2 => 153,
				),
			'kubio-color-5-variant-4' =>
				array(
					0 => 101,
					1 => 101,
					2 => 101,
				),
			'kubio-color-5-variant-5' =>
				array(
					0 => 50,
					1 => 50,
					2 => 50,
				),
			'kubio-color-6-variant-1' =>
				array(
					0 => 233,
					1 => 233,
					2 => 233,
				),
			'kubio-color-6-variant-2' =>
				array(
					0 => 182,
					1 => 182,
					2 => 182,
				),
			'kubio-color-6-variant-3' =>
				array(
					0 => 131,
					1 => 131,
					2 => 131,
				),
			'kubio-color-6-variant-4' =>
				array(
					0 => 80,
					1 => 80,
					2 => 80,
				),
			'kubio-color-6-variant-5' =>
				array(
					0 => 30,
					1 => 30,
					2 => 30,
				),
		),
	'fonts'        =>
		array(
			'Open Sans'  =>
				array(
					0  => 400,
					1  => '300',
					2  => '300italic',
					3  => '400',
					4  => '400italic',
					5  => '600',
					6  => '600italic',
					7  => '700',
					8  => '700italic',
					9  => '800',
					10 => '800italic',
				),
			'Mulish'     =>
				array(
					0 => 400,
				),
			'Roboto'     =>
				array(
					0  => '100',
					1  => '100italic',
					2  => '300',
					3  => '300italic',
					4  => 'regular',
					5  => 'italic',
					6  => '500',
					7  => '500italic',
					8  => '700',
					9  => '700italic',
					10 => '900',
					11 => '900italic',
				),
			'Carter One' =>
				array(
					0 => 400,
				),
		),
);
