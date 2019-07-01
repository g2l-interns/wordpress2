<?php
/**
 * Implements styles set in the theme customizer
 *
 * @package Singularity Customizer Library
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'customizer_library_singularity_build_styles' ) && class_exists( 'Customizer_Library_Styles' ) ) :
	/**
	 * Process user options to generate CSS needed to implement the choices.
	 *
	 * @since  1.0.0.
	 *
	 * @return void
	 */
	function customizer_library_singularity_build_styles() {
		
		// Header
		$setting = 'logo-width';
		$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

		if ( $mod !== customizer_library_get_default( $setting ) ) {

			$width = intval( $mod );

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.custom-logo'
				),
				'declarations' => array(
					'max-width' => $width . '%'
				),
				'media'	=> '(min-width: 48em)'
			) );
		}
		
		$colors = array(
			'primary-color' 	=> array(
				'setting'		=> 'primary-color',
				'selectors'		=> array(
					'a'
				),
				'declarations'	=> array(
					'color'
				)
			),
			'primary-color-bg' 	=> array(
				'setting'		=> 'primary-color',
				'selectors'		=> array(
					'a.button',
					'button',
					'input[type="button"]',
					'input[type="reset"]',
					'input[type="submit"]',
					'#edd-purchase-button',
					'.edd-submit',
					'input[type=submit].edd-submit',
					'.edd-submit.button.blue',
					'.cat-links a'
				),
				'declarations'	=> array(
					'background-color'
				)
			),
			'secondary-color' 	=> array(
				'setting'		=> 'secondary-color',
				'selectors'		=> array(
					'body',
					'button',
					'input',
					'select',
					'textarea'
				),
				'declarations'	=> array(
					'color'
				)
			),
			'secondary-color-bg' 	=> array(
				'setting'		=> 'secondary-color',
				'selectors'		=> array(
					'.mobile-menu-wrapper'
				),
				'declarations'	=> array(
					'background-color'
				)
			),
			'content-bg-color' 	=> array(
				'setting'		=> 'content-bg-color',
				'selectors'		=> array(
					'.site-content',
					'.boxed-layout .site-content',
					'.boxed-layout .site-header-filler'
				),
				'declarations'	=> array(
					'background-color'
				)
			),
			'border-color' 	=> array(
				'setting'		=> 'border-color',
				'selectors'		=> array(
					'.border-color',
					'.singularity-is-scrolling.fixed-header .site-header',
					'.featured-image-wrapper',
					'.sidebar-format-titled h5.widget-title'
				),
				'declarations'	=> array(
					'border-color'
				)
			),
			'light-grey' 	=> array(
				'setting'		=> 'light-grey',
				'selectors'		=> array(
					'.light-grey',
					'.blog-article .entry-wrapper',
					'.sidebar-format-panel .widget',
					'.ctdb-breadcrumb-wrapper',
					'.sidebar-format-titled h5.widget-title',
					'.comment-respond'
				),
				'declarations'	=> array(
					'background-color'
				)
			),
			'light-grey' 	=> array(
				'setting'		=> 'light-grey',
				'selectors'		=> array(
					'cat-links a'
				),
				'declarations'	=> array(
					'color'
				)
			),
			'top-bar-bg' 	=> array(
				'setting'		=> 'top-bar-bg',
				'selectors'		=> array(
					'#top-bar'
				),
				'declarations'	=> array(
					'background-color'
				)
			),
			'top-bar-color' 	=> array(
				'setting'		=> 'top-bar-color',
				'selectors'		=> array(
					'#top-bar',
					'#top-bar a'
				),
				'declarations'	=> array(
					'color'
				)
			),
			'header-background' => array(
				'setting'		=> 'header-background',
				'selectors'		=> array(
					'.site-header'
				),
				'declarations'	=> array(
					'background-color'
				)
			),
			'header-color' 		=> array(
				'setting'		=> 'header-color',
				'selectors'		=> array(
					'.site-header'
				),
				'declarations'	=> array(
					'color'
				)
			),
			'header-link-color' => array(
				'setting'		=> 'header-link-color',
				'selectors'		=> array(
					'.site-header a'
				),
				'declarations'	=> array(
					'color'
				)
			),
			'full-width-bg' 	=> array(
				'setting'		=> 'full-width-bg',
				'selectors'		=> array(
					'.site-footer-full-width-inner'
				),
				'declarations'	=> array(
					'background-color'
				)
			),
			'full-width-color' 	=> array(
				'setting'		=> 'full-width-color',
				'selectors'		=> array(
					'.site-footer-full-width'
				),
				'declarations'	=> array(
					'color'
				)
			),
			'footer-bg' 	=> array(
				'setting'		=> 'footer-bg',
				'selectors'		=> array(
					'.site-footer-columns-inner'
				),
				'declarations'	=> array(
					'background-color'
				)
			),
			'footer-color' 	=> array(
				'setting'		=> 'footer-color',
				'selectors'		=> array(
					'.site-footer-columns'
				),
				'declarations'	=> array(
					'color'
				)
			),
			'footer-link-color' => array(
				'setting'		=> 'footer-link-color',
				'selectors'		=> array(
					'.site-footer-columns'
				),
				'declarations'	=> array(
					'color'
				)
			),
			
			
		);
		
		foreach( $colors as $color ) {
			// Primary Color
			$setting = $color['setting'];
			
			$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

			if ( $mod !== customizer_library_get_default( $setting ) ) {

				$value = sanitize_hex_color( $mod );
				
				$declarations = array();
				if( isset( $color['declarations'] ) ) {
					foreach( $color['declarations'] as $declaration ) {
						$declarations[$declaration] = $value;
					}
				}

				Customizer_Library_Styles()->add( array(
					'selectors' => $color['selectors'],
					'declarations' => $declarations
				) );
			}
		}
		
		// Primary Font
		
		// Typekit font options
		$typekit = get_theme_mod( 'use-typekit', customizer_library_get_default( 'use-typekit' ) );
		$typekit_kit = get_theme_mod( 'typekit-kit', '' );

		if( $typekit && $typekit_kit ) {
			$mod = get_theme_mod( 'typekit-font-family', '' );
			$stack = '"' . esc_attr( $mod ) . '", sans-serif';
		} else {
			$setting = 'primary-font';
			$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );		
			$stack = customizer_library_get_font_stack( $mod );
		}

		if ( $mod != customizer_library_get_default( $setting ) ) {

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'body'
				),
				'declarations' => array(
					'font-family' => $stack
				)
			) );

		}

		// Secondary Font
		$setting = 'secondary-font';
		$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );
		$stack = customizer_library_get_font_stack( $mod );

		if ( $mod != customizer_library_get_default( $setting ) ) {

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.secondary-font',
				),
				'declarations' => array(
					'font-family' => $stack
				)
			) );

		}
		
		// Base Font Size
		$setting = 'base-font-size';
		$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );
	
		if ( $mod != customizer_library_get_default( $setting ) ) {

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'html',
				),
				'declarations' => array(
					'font-size' => intval( $mod ) . '%'
				)
			) );
			
		}
		
		// Max Width
		$setting = 'max-content-width';
		$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

		if ( $mod != customizer_library_get_default( $setting ) ) {
			
			if( $mod == 0 ) {
				$mod = '9999';
			}

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.full-width-layout .row',
				),
				'declarations' => array(
					'max-width' => intval( $mod ) . 'px'
				)
			) );

		}
		
		// Footer Background
		$setting = 'footer-bg-img';
		$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

		if ( $mod != customizer_library_get_default( $setting ) ) {

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.site-footer',
				),
				'declarations' => array(
					'background-image' => 'url(' . esc_url( $mod ) . ')'
				)
			) );

		}
		
		// Footer Backgrounds Opacity
		$setting = 'full-width-opacity';
		$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

		if ( $mod != customizer_library_get_default( $setting ) ) {
			
			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.site-footer-full-width-inner',
				),
				'declarations' => array(
					'opacity' => floatval( $mod )
				)
			) );

		}
		
		$setting = 'footer-bg-opacity';
		$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

		if ( $mod != customizer_library_get_default( $setting ) ) {
			
			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.site-footer-columns-inner',
				),
				'declarations' => array(
					'opacity' => floatval( $mod )
				)
			) );

		}
		
		$setting = 'thumbnail-height';
		$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

		if ( $mod != customizer_library_get_default( $setting ) ) {
			
			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.center-thumbnail .blog-article .featured-image',
				),
				'declarations' => array(
					'max-height' => intval( $mod ) . 'px'
				)
			) );
					
			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.center-thumbnail .blog-article:not(.article-0) .featured-image',
				),
				'declarations' => array(
					'height' => intval( $mod ) . 'px'
				)
			) );
					
			Customizer_Library_Styles()->add( array(
				'selectors' => array(
					'.center-thumbnail .blog-article.article-0 .featured-image',
				),
				'declarations' => array(
					'height' => intval( $mod ) * 2 . 'px',
					'max-height' => intval( $mod ) * 2 . 'px'
				)
			) );

		}

	}
endif;

add_action( 'customizer_library_styles', 'customizer_library_singularity_build_styles' );

if ( ! function_exists( 'customizer_library_singularity_styles' ) ) :
	/**
	 * Generates the style tag and CSS needed for the theme options.
	 *
	 * By using the "Customizer_Library_Styles" filter, different components can print CSS in the header.
	 * It is organized this way to ensure there is only one "style" tag.
	 *
	 * @since  1.0.0.
	 *
	 * @return void
	 */
	function customizer_library_singularity_styles() {

		do_action( 'customizer_library_styles' );

		// Echo the rules
		$css = Customizer_Library_Styles()->build();

		if ( ! empty( $css ) ) {
			echo "\n<!-- Begin Custom CSS -->\n<style type=\"text/css\" id=\"demo-custom-css\">\n";
			echo 'html {
				font-size: 16px;
				font-size: 1rem;
			}';
			echo $css;
			echo "\n</style>\n<!-- End Custom CSS -->\n";
		}
	}
endif;

add_action( 'wp_head', 'customizer_library_singularity_styles', 11 );