<?php
/**
 * Functions used to implement options
 *
 * @package Customizer Library Demo
 */


/**
 * Get Google font families for font loader
 */
function singularity_get_font_families( $fonts ) {
	// De-dupe the fonts
	$fonts         = array_unique( $fonts );
	$allowed_fonts = customizer_library_get_google_fonts();
	$family        = array();

	// Validate each font and convert to URL format
	foreach ( $fonts as $font ) {
		$font = trim( $font );
		
		// Verify that the font exists
		if ( array_key_exists( $font, $allowed_fonts ) ) {
			// Build the family name and variant string for the Web Font Loader (e.g., "Open Sans:400,400i,700")
			 $family[] = "'" . $font . ':' . join( ',', singularity_choose_google_font_variants( $font, $allowed_fonts[ $font ]['variants'] ) ) . "'";
		}
	}

	// Convert from array to string
	if ( empty( $family ) ) {
		return '';
	} else {
		$request = implode( ',', $family );
	}

	return $request;
}

/**
 * Get Google Font variants
 */
function singularity_choose_google_font_variants( $font, $variants = array() ) {
	$chosen_variants = array();
	if ( empty( $variants ) ) {
		$fonts = singularity_customizer_library_get_google_fonts();

		if ( array_key_exists( $font, $fonts ) ) {
			$variants = $fonts[ $font ]['variants'];
		}
	}

	// If a "regular" variant is not found, get the first variant
	if ( ! in_array( 'regular', $variants ) ) {
		$chosen_variants[] = $variants[0];
	} else {
		$chosen_variants[] = '400';
	}

	// Only add "italic" if it exists
	if ( in_array( 'italic', $variants ) ) {
		// Append 'i' to first variant
		if ( ! in_array( 'regular', $variants ) ) {
			$chosen_variants[] = $variants[0] . 'i';
		} else {
			$chosen_variants[] = '400i';
		}
	}

	// Only add "700" if it exists
	if ( in_array( '700', $variants ) ) {
		$chosen_variants[] = '700';
	}

	return apply_filters( 'singularity_font_variants', array_unique( $chosen_variants ), $font, $variants );
}

/**
 * Load fonts via web font loader
 * @since 1.0.0
 */
function singularity_webfonts() { 
	$typekit_kit = get_theme_mod( 'typekit-kit', '' );
	$typekit = get_theme_mod( 'use-typekit', customizer_library_get_default( 'use-typekit' ) );
	$config = '';
	if( $typekit && $typekit_kit ) {
		$config = "typekit: { id: '" . esc_attr( $typekit_kit ) . "' }";
	} else {
		// Font options
		$fonts = array(
			get_theme_mod ( 'primary-font', customizer_library_get_default( 'primary-font' ) ),
			get_theme_mod ( 'secondary-font', customizer_library_get_default( 'secondary-font' ) )
		);
		$font_families = singularity_get_font_families( $fonts );
		if( ! empty( $font_families ) ) {
			$config = "google: { families: [" . $font_families . "] }";
		}
	}
	if( $config != '' ) { ?>
		<script>
		   WebFontConfig = {
			   <?php echo $config; ?>
		   };
		   (function(d) {
		      var wf = d.createElement('script'), s = d.scripts[0];
		      wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js';
		      s.parentNode.insertBefore(wf, s);
		   })(document);
		</script>
	<?php }
}
add_action( 'wp_footer', 'singularity_webfonts' );

/**
 * Callbacks
 */
function singularity_use_typekit( $control ) {
	$option = $control->manager->get_setting( 'use-typekit' );
	if( $option->value() != '' ) {
		return true;
	}
	return false;
}

function singularity_is_layout_full_width( $control ) {
	$option = $control->manager->get_setting( 'site-layout' );
	if( $option->value() == 'full-width' ) {
		return true;
	}
	return false;
}

function singularity_is_boxed_layout( $control ) {
	$option = $control->manager->get_setting( 'site-layout' );
	if( $option->value() == 'boxed' ) {
		return true;
	}
	return false;
}

function singularity_is_centered_thumbnail( $control ) {
	$option = $control->manager->get_setting( 'center-thumbnail' );
	if( $option->value() == 1 ) {
		return true;
	}
	return false;
}

function singularity_is_pinned_thumbnail( $control ) {
	$pages = $control->manager->get_setting( 'pin-thumbnail-pages' );
	$posts = $control->manager->get_setting( 'pin-thumbnail-posts' );
	if( $pages->value() == 1 || $posts->value() == 1 ) {
		return true;
	}
	return false;
}

function singularity_is_pinned_title( $control ) {
	$option = $control->manager->get_setting( 'pin-title' );
	if( $option->value() == 1 ) {
		return true;
	}
	return false;
}

function singularity_is_discussion_board_enabled() {
	if( class_exists( 'CT_DB_Public' ) ) {
		return true;
	}
	return false;
}

function singularity_is_edd_enabled() {
	if( class_exists( 'Easy_Digital_Downloads' ) ) {
		return true;
	}
	return false;
}

function singularity_show_homepage_section() {
	$home_id = get_option( 'page_on_front' );
	$template = get_page_template_slug( $home_id );
	// Must be on the front page and using the correct template
	if( is_front_page() && $template == 'page-homepage.php' ) {
		return true;
	}
	return false;
}

function singularity_blog_on_homepage( $control ) {
	// Search all homepage sections to see if the blog has been selected
	$has_blog = false;
	for( $i=1; $i<=6; $i++ ) {
		$option = $control->manager->get_setting( 'home-section-' . $i . '-content' );
		if( isset( $option ) && $option->value() == 'blog' ) {
			$has_blog = true;
			break;
		}
	}
	return $has_blog;
}

function singularity_downloads_on_homepage( $control ) {
	// Search all homepage sections to see if the blog has been selected
	$has_blog = false;
	for( $i=1; $i<=6; $i++ ) {
		$option = $control->manager->get_setting( 'home-section-' . $i . '-content' );
		if( isset( $option ) && $option->value() == 'downloads' ) {
			$has_blog = true;
			break;
		}
	}
	return $has_blog;
}

function singularity_pages_on_homepage( $control ) {
	// Search all homepage sections to see if the blog has been selected
	$has_blog = false;
	for( $i=1; $i<=6; $i++ ) {
		$option = $control->manager->get_setting( 'home-section-' . $i . '-content' );
		if( isset( $option ) && $option->value() == 'pages' ) {
			$has_blog = true;
			break;
		}
	}
	return $has_blog;
}

function singularity_page_1_on_homepage( $control ) {
	$option = $control->manager->get_setting( 'home-featured-page-1' );
	if( $option->value() ) {
		return true;
	}
	return false;
}

function singularity_page_2_on_homepage( $control ) {
	$option = $control->manager->get_setting( 'home-featured-page-2' );
	if( $option->value() ) {
		return true;
	}
	return false;
}

function singularity_page_3_on_homepage( $control ) {
	$option = $control->manager->get_setting( 'home-featured-page-3' );
	if( $option->value() ) {
		return true;
	}
	return false;
}

function singularity_page_4_on_homepage( $control ) {
	$option = $control->manager->get_setting( 'home-featured-page-4' );
	if( $option->value() ) {
		return true;
	}
	return false;
}