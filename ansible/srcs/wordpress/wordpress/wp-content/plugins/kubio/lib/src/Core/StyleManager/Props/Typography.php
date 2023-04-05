<?php


namespace Kubio\Core\StyleManager\Props;

use Kubio\Config;
use Kubio\Core\LodashBasic;
use Kubio\Core\Registry;
use Kubio\Core\StyleManager\ParserUtils;
use function join;

class Typography extends PropertyBase {

	public function getSelector( $name ) {
		switch ( $name ) {

			case 'p':
				return 'p';

			case 'lead':
				return '.h-lead';

			case 'blockquote':
				return  'blockquote p';

			default:
				return  $name;
		}
	}

	public function getTypographyCss( $value ) {
		$style              = array();
		$propertiesMap      = Config::value( 'props.typography.config.map' );
		$unitLessProperties = array( 'lineHeight' );

		// Fonts
		Registry::getInstance()->registerFonts( LodashBasic::get( $value, 'family' ), LodashBasic::get( $value, 'weight', '400' ), LodashBasic::get( $value, 'style' ) );
		// add fallback fonts - increase performance scores
		$value['family'] = LodashBasic::get( $value, 'family' ) ? LodashBasic::get( $value, 'family' ) . ',Helvetica, Arial, Sans-Serif, serif' : '';

		// Remaining properties
		$style = LodashBasic::merge( $style, ParserUtils::addPrimitiveValues( $style, $value, $propertiesMap, $unitLessProperties ) );

		return $style;
	}

	public function parseHolders( $typography, $is_global_style = false ) {
		$statesById = Config::statesById();
		$holders    = LodashBasic::omit( $typography, array( 'states' ) );
		$collected  = array();
		foreach ( $holders as $name => $___ ) {
			$holderTypography = $holders[ $name ];
			$normal           = LodashBasic::omit( $holderTypography, array( 'states' ) );
			$byState          = LodashBasic::merge( array( 'normal' => $normal ), LodashBasic::get( $holderTypography, 'states', array() ) );

			foreach ( $byState as $stateName => $___ ) {
				$stateTypography = $byState[ $stateName ];
				$val             = $this->valueWithDefault( $stateTypography );
				$state_selector  = LodashBasic::get( $statesById, array( $stateName, 'selector' ), '' );
				$selector        = $this->getSelector( $name );

				if ( $selector === 'a' ) {
					$selector = 'a:not([class*=wp-block-button])';
				}

				$selector_parts = array();

				if ( $is_global_style ) {
					$selector_parts = array(
						$selector === 'p' ? '[data-kubio]' : false,
						$selector === 'p' ? '.with-kubio-global-style' : false,
						"& [data-kubio] {$selector}",
						"& .with-kubio-global-style {$selector}",
						"& {$selector}[data-kubio]",
					);
				} else {
					$selector_parts = array(
						$selector === 'p' ? '&' : false,
						"& {$selector}",
						"& {$selector}[data-kubio]",
					);
				}

				$selector_parts = array_filter(
					$selector_parts,
					function ( $item ) {
						return ! empty( $item );
					}
				);

				$selector_parts = LodashBasic::uniq( $selector_parts );

				LodashBasic::set(
					$collected,
					array(
						implode( ', ', $selector_parts ),
						'&' . $state_selector,
					),
					$this->getTypographyCss( $val )
				);

				LodashBasic::unsetValue( $typography, $name );
			}
		}
		return $collected;
	}

	public function parse( $value, $options ) {
		$holders     = LodashBasic::get( $value, 'holders', array() );
		$holdersTypo = $this->parseHolders( $holders, LodashBasic::get( (array) $options, 'model.globalStyle', false ) );
		$textDefault = array();
		if ( LodashBasic::has( $holders, 'p' ) ) {
			$textDefault = $holders['p'];
			if ( LodashBasic::has( $textDefault, 'margin' ) ) {
				unset( $textDefault->margin );
			}
		}
		$nodeTypography = LodashBasic::merge( array(), $this->config( 'default' ), /*  $textDefault, */ LodashBasic::omit( $value, 'holders' ) );
		$nodeTypo       = $this->getTypographyCss( $nodeTypography );
		return LodashBasic::merge( $nodeTypo, $holdersTypo );
	}
}
