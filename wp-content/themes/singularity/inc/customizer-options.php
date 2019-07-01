<?php
/**
 * Defines customizer options
 *
 * @package Customizer Library Demo
 */

function customizer_library_singularity_options() {

	// Theme defaults
	$primary_color = '#2980b9';
	$secondary_color = '#2c3e50';
	
	// Homepage choices
	$home_sections = array(
		'0'			=> '',
		'blog'		=> __( 'Blog Posts', 'singularity' ),
		'pages'		=> __( 'Featured Pages', 'singularity' ),
		'widget-1'	=> __( 'Homepage Widget Area 1', 'singularity' ),
		'widget-2'	=> __( 'Homepage Widget Area 2', 'singularity' ),
		'content'	=> __( 'Standard Page Content', 'singularity' ),
	);
	if( singularity_is_edd_enabled() ) {
		$home_sections['downloads'] = __( 'Downloads', 'singularity' );
	}
	if( singularity_is_discussion_board_enabled() ) {
		$home_sections['topics'] = __( 'Topics', 'singularity' );
	}	

	// Stores all the controls that will be added
	$options = array();

	// Stores all the sections to be added
	$sections = array();

	// Stores all the panels to be added
	$panels = array();

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Identity
	$section = 'title_tagline';

	$options['logo-width'] = array(
		'id' => 'logo-width',
		'label'   => __( 'Logo Width', 'singularity' ),
		'section' => $section,
		'type'    => 'range',
		'default' => '100',
		'priority'	=> '8',
		'input_attrs' => array(
			'min'		=> '10',
			'max'		=> '100',
			'step'		=> '10'
		)
	);
	
	$options['hide-tagline'] = array(
		'id' => 'hide-tagline',
		'label'   => __( 'Hide Tagline', 'singularity' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 0,
		'priority'	=> '40'
	);
	
	$options['wisdom-allow-tracking'] = array(
		'id' => 'wisdom-allow-tracking',
		'label'   => __( 'Allow tracking', 'singularity' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 0,
		'priority'	=> '240'
	);
	
	// Layout Panel
	$panel = 'layout';

	$panels[] = array(
		'id' => $panel,
		'title' => __( 'Layout', 'singularity' ),
		'priority' => '50'
	);

	$section = 'global-section';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Global', 'singularity' ),
		'priority' => '10',
		'panel' => $panel
	);

	$options['site-layout'] = array(
		'id' => 'site-layout',
		'label'   => __( 'Site Layout', 'singularity' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => array(
			'boxed' 		=> __( 'Boxed', 'singularity' ),
			'full-width' 	=> __( 'Full Width', 'singularity' ),
		),
		'default' => 'boxed'
	);
	
	$options['max-content-width'] = array(
		'id' => 'max-content-width',
		'label'   => __( 'Max Content Width', 'singularity' ),
		'section' => $section,
		'type'    => 'text',
		'default' => 1170,
		'active_callback'	=> 'singularity_is_layout_full_width'
	);
	
	$section = 'header-section';
	
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Header', 'singularity' ),
		'priority' => '20',
		'panel' => $panel
	);

	$options['header-layout'] = array(
		'id' => 'header-layout',
		'label'   => __( 'Header Layout', 'singularity' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => array(
			'centered' 		=> __( 'Centered', 'singularity' ),
			'standard'	 	=> __( 'Standard', 'singularity' ),
		),
		'default' => 'standard'
	);
	
	$options['enable-top-bar'] = array(
		'id' => 'enable-top-bar',
		'label'   => __( 'Enable Top Bar', 'singularity' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 0,
	);
	
	$options['fixed-header'] = array(
		'id' => 'fixed-header',
		'label'   => __( 'Fixed Header', 'singularity' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 0,
	);
	
	$options['v-center-header'] = array(
		'id' => 'v-center-header',
		'label'   => __( 'Vertically Center Elements', 'singularity' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
	);
	
	$section = 'blog-section';
	
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Blog', 'singularity' ),
		'priority' => '30',
		'panel' => $panel
	);
	
	$options['blog-archive-content'] = array(
		'id' => 'blog-archive-content',
		'label'   => __( 'Archive Content', 'singularity' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => array(
			'content' 		=> __( 'Content', 'singularity' ),
			'excerpt'	 	=> __( 'Excerpt', 'singularity' ),
		),
		'default' => 'excerpt'
	);
	
	$options['center-thumbnail'] = array(
		'id' => 'center-thumbnail',
		'label'   => __( 'Center Thumbnails', 'singularity' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 0,
	);
	
	$options['thumbnail-height'] = array(
		'id' => 'thumbnail-height',
		'label'   => __( 'Thumbnail Height', 'singularity' ),
		'section' => $section,
		'type'    => 'text',
		'default' => 260,
		'active_callback'	=> 'singularity_is_centered_thumbnail'
	);
	
	$options['thumbnail-placeholder'] = array(
		'id' => 'thumbnail-placeholder',
		'label'   => __( 'Use Placeholder for Missing Thumbnails', 'singularity' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
	);
	
	$options['excerpt-length'] = array(
		'id' => 'excerpt-length',
		'label'   => __( 'Excerpt Length', 'singularity' ),
		'section' => $section,
		'type'    => 'text',
		'default' => 20
	);
	
	$options['archive-layout'] = array(
		'id' => 'archive-layout',
		'label'   => __( 'Archive Layout', 'singularity' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => array(
			'narrow'		=> __( 'Narrow', 'singularity' ),
			'no-sidebar'	=> __( 'No Sidebar', 'singularity' ),
			'sidebar-left'	=> __( 'Sidebar Left', 'singularity' ),
			'sidebar-right'	=> __( 'Sidebar Right', 'singularity' )		
		),
		'default' => 'no-sidebar',
	);
	
	$options['posts-per-row'] = array(
		'id' => 'posts-per-row',
		'label'   => __( 'Posts Per Row on Post Archives', 'singularity' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => array(
			1	=> '1',
			2	=> '2',
			3	=> '3',
		),
		'default' => 2,
	);
	
	$options['post-layout'] = array(
		'id' => 'post-layout',
		'label'   => __( 'Post Layout', 'singularity' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => array(
			'narrow'		=> __( 'Narrow', 'singularity' ),
			'no-sidebar'	=> __( 'No Sidebar', 'singularity' ),
			'sidebar-left'	=> __( 'Sidebar Left', 'singularity' ),
			'sidebar-right'	=> __( 'Sidebar Right', 'singularity' )		
		),
		'default' => 'narrow',
	);
	
	$section = 'sidebar-section';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Sidebar', 'singularity' ),
		'priority' => '45',
		'panel' => $panel
	);
	
	$options['sidebar-width'] = array(
		'id' => 'sidebar-width',
		'label'   => __( 'Sidebar Width', 'singularity' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => array(
			'25' 	=> '25%',
			'33' 	=> '33%',
		),
		'default' => '25'
	);
	
	$options['sidebar-format'] = array(
		'id' => 'sidebar-format',
		'label'   => __( 'Sidebar Format', 'singularity' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => array(
			'panel' 	=> __( 'Panel', 'singularity' ),
			'simple' 	=> __( 'Simple', 'singularity' ),
			'titled' 	=> __( 'Titled', 'singularity' )
		),
		'default' => 'titled'
	);
	
	$section = 'thumbnail-section';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Featured Image', 'singularity' ),
		'priority' => '50',
		'panel' => $panel
	);
	
	$options['pin-thumbnail-pages'] = array(
		'id' => 'pin-thumbnail-pages',
		'label'   => __( 'Pin Featured Image to Header on Pages', 'singularity' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 0,
	);
	
	$options['pin-thumbnail-posts'] = array(
		'id' => 'pin-thumbnail-posts',
		'label'   => __( 'Pin Featured Image to Header on Posts', 'singularity' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 0,
	);
	
	$options['alt-logo'] = array(
		'id' => 'alt-logo',
		'label'   => __( 'Alternative Logo for Pinned Images', 'singularity' ),
		'section' => $section,
		'type'    => 'image',
		'default' => '',
		'active_callback'	=> 'singularity_is_pinned_thumbnail'
	);
	
	$options['pin-title'] = array(
		'id' => 'pin-title',
		'label'   => __( 'Pin Title over Image', 'singularity' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 0,
		'active_callback'	=> 'singularity_is_pinned_thumbnail'
	);
	
	$options['pin-excerpt'] = array(
		'id' => 'pin-excerpt',
		'label'   => __( 'Pin Excerpt with Title', 'singularity' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 0,
		'active_callback'	=> 'singularity_is_pinned_title'
	);
	
	$options['pinned-thumbnail-height'] = array(
		'id' => 'pinned-thumbnail-height',
		'label'   => __( 'Pinned Featured Image Height', 'singularity' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => array(
			'third' => __( 'Third', 'singularity' ),
			'half'	=> __( 'Half', 'singularity' ),
			'full'	=> __( 'Full', 'singularity' )
		),
		'default' => 'third',
		'active_callback'	=> 'singularity_is_pinned_thumbnail'
	);
	
	$options['pinned-menu-style'] = array(
		'id' => 'pinned-menu-style',
		'label'   => __( 'Menu Style', 'singularity' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => array(
			'dark' 		=> __( 'Dark', 'singularity' ),
			'light'	 	=> __( 'Light', 'singularity' ),
		),
		'default' => 'dark',
		'active_callback'	=> 'singularity_is_pinned_thumbnail'
	);
	
	$section = 'footer-section';
	
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Footer', 'singularity' ),
		'priority' => '120',
		'panel' => $panel
	);
	
	$options['footer-bg-img'] = array(
		'id' => 'footer-bg-img',
		'label'   => __( 'Footer Background', 'singularity' ),
		'section' => $section,
		'type'    => 'image',
		'default' => '',
	);
	
	$options['force-footer-full-width'] = array(
		'id' => 'force-footer-full-width',
		'label'   => __( 'Force Footer Full Width', 'singularity' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 0,
		'active_callback' => 'singularity_is_boxed_layout'
	);
	
	$options['full-width-footer'] = array(
		'id' => 'full-width-footer',
		'label'   => __( 'Enable Area above Columns', 'singularity' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
	);
	
	$options['footer-columns'] = array(
		'id' => 'footer-columns',
		'label'   => __( 'Footer Columns', 'singularity' ),
		'section' => $section,
		'type'    => 'select',
		'default'	=> '4',
		'choices' => array(
			'0' => '0',
			'1'	=> '1',
			'2'	=> '2',
			'3'	=> '3',
			'4'	=> '4',
			'5'	=> '5',
			'6'	=> '6',
		)
	);
	
	$options['footer-reveal'] = array(
		'id' => 'footer-reveal',
		'label'   => __( 'Footer Reveal', 'singularity' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 0,
	);
	
	$options['show-credits'] = array(
		'id' => 'show-credits',
		'label'   => __( 'Show Credits', 'singularity' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
	);
	
	$options['credits-text'] = array(
		'id' => 'credits-text',
		'label'   => __( 'Credits Text', 'singularity' ),
		'section' => $section,
		'type'    => 'text',
		'default' => __( 'Singularity Theme', 'singularity' ),
	);
	
	$options['credits-url'] = array(
		'id' => 'credits-url',
		'label'   => __( 'Credits URL', 'singularity' ),
		'section' => $section,
		'type'    => 'url',
		'default' => 'https://singularitytheme.com/',
	);
	
	$section = 'edd';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Easy Digital Downloads', 'singularity' ),
		'panel' => $panel
	);
	
	$options['single-download-layout'] = array(
		'id' => 'single-download-layout',
		'label'   => __( 'Single Layout', 'singularity' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => array(
			'narrow'		=> __( 'Narrow', 'singularity' ),
			'no-sidebar'	=> __( 'No Sidebar', 'singularity' ),
			'sidebar-left'	=> __( 'Sidebar Left', 'singularity' ),
			'sidebar-right'	=> __( 'Sidebar Right', 'singularity' )		
		),
		'default' => 'no-sidebar',
		'active_callback'	=> 'singularity_is_edd_enabled'
	);
	
	$options['archive-download-layout'] = array(
		'id' => 'archive-download-layout',
		'label'   => __( 'Archive Layout', 'singularity' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => array(
			'narrow'		=> __( 'Narrow', 'singularity' ),
			'no-sidebar'	=> __( 'No Sidebar', 'singularity' ),
			'sidebar-left'	=> __( 'Sidebar Left', 'singularity' ),
			'sidebar-right'	=> __( 'Sidebar Right', 'singularity' )		
		),
		'default' => 'no-sidebar',
		'active_callback'	=> 'singularity_is_edd_enabled'
	);
	
	$options['downloads-per-row'] = array(
		'id' => 'downloads-per-row',
		'label'   => __( 'Downloads Per Row on Archives', 'singularity' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => array(
			1	=> '1',
			2	=> '2',
			3	=> '3',
		),
		'default' => 2,
	);
	
	// Homepage
	$section = 'homepage';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Homepage', 'singularity' ),
		'priority' => '55',
		'active_callback'	=> 'singularity_show_homepage_section'
	);

	$options['hide-homepage-title'] = array(
		'id' => 'hide-homepage-title',
		'label'   => __( 'Hide Page Title', 'singularity' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => '1'
	);
	
	$options['home-section-1-title'] = array(
		'id' => 'home-section-1-title',
		'label'   => __( 'Section 1 Title', 'singularity' ),
		'section' => $section,
		'type'    => 'text',
		'default' => ''
	);
	
	$options['home-section-1-content'] = array(
		'id' => 'home-section-1-content',
		'label'   => __( 'Section 1 Content', 'singularity' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $home_sections,
		'default' => '',
	);
	
	$options['home-section-2-title'] = array(
		'id' => 'home-section-2-title',
		'label'   => __( 'Section 2 Title', 'singularity' ),
		'section' => $section,
		'type'    => 'text',
		'default' => ''
	);
	
	$options['home-section-2-content'] = array(
		'id' => 'home-section-2-content',
		'label'   => __( 'Section 2 Content', 'singularity' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $home_sections,
		'default' => '',
	);
	
	$options['home-section-3-title'] = array(
		'id' => 'home-section-3-title',
		'label'   => __( 'Section 3 Title', 'singularity' ),
		'section' => $section,
		'type'    => 'text',
		'default' => ''
	);
	
	$options['home-section-3-content'] = array(
		'id' => 'home-section-3-content',
		'label'   => __( 'Section 3 Content', 'singularity' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $home_sections,
		'default' => '',
	);
	
	$options['home-section-4-title'] = array(
		'id' => 'home-section-4-title',
		'label'   => __( 'Section 4 Title', 'singularity' ),
		'section' => $section,
		'type'    => 'text',
		'default' => ''
	);
	
	$options['home-section-4-content'] = array(
		'id' => 'home-section-4-content',
		'label'   => __( 'Section 4 Content', 'singularity' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $home_sections,
		'default' => '',
	);
	
	$options['home-section-5-title'] = array(
		'id' => 'home-section-5-title',
		'label'   => __( 'Section 5 Title', 'singularity' ),
		'section' => $section,
		'type'    => 'text',
		'default' => ''
	);
	
	$options['home-section-5-content'] = array(
		'id' => 'home-section-5-content',
		'label'   => __( 'Section 5 Content', 'singularity' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $home_sections,
		'default' => '',
	);
	
	$options['home-posts-divider'] = array(
		'id' => 'home-posts-divider',
		'label'   => '',
		'section' => $section,
		'type'    => 'content',
		'content' => '<hr>',
		'active_callback'	=> 'singularity_blog_on_homepage'
	);
	
	$options['home-blog-posts'] = array(
		'id' => 'home-blog-posts',
		'label'   => __( 'Number of Blog Posts', 'singularity' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => array(
			'1'	=> '1',
			'2'	=> '2',
			'3'	=> '3',
			'4'	=> '4'
		),
		'default' => '3',
		'active_callback'	=> 'singularity_blog_on_homepage'
	);
	
	$options['home-downloads-divider'] = array(
		'id' => 'home-downloads-divider',
		'label'   => '',
		'section' => $section,
		'type'    => 'content',
		'content' => '<hr>',
		'active_callback'	=> 'singularity_downloads_on_homepage'
	);
	
	$options['home-number-downloads'] = array(
		'id' => 'home-number-downloads',
		'label'   => __( 'Number of Downloads', 'singularity' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => array(
			'1'	=> '1',
			'2'	=> '2',
			'3'	=> '3',
			'4'	=> '4'
		),
		'default' => '3',
		'active_callback'	=> 'singularity_downloads_on_homepage'
	);
	
	$options['home-featured-page-divider'] = array(
		'id' => 'home-featured-page-divider',
		'label'   => '',
		'section' => $section,
		'type'    => 'content',
		'content' => '<hr>',
		'active_callback'	=> 'singularity_pages_on_homepage'
	);
	
	$options['home-featured-page-1'] = array(
		'id' => 'home-featured-page-1',
		'label'   => __( 'Featured Page 1', 'singularity' ),
		'section' => $section,
		'type'    => 'dropdown-pages',
		'default' => '',
		'active_callback'	=> 'singularity_pages_on_homepage'
	);
	
	$options['featured-page-extract-1'] = array(
		'id' => 'featured-page-extract-1',
		'label'   => __( 'Featured Page Extract 1', 'singularity' ),
		'section' => $section,
		'type'    => 'textarea',
		'default' => '',
		'active_callback'	=> 'singularity_page_1_on_homepage'
	);
	
	$options['home-featured-page-2'] = array(
		'id' => 'home-featured-page-2',
		'label'   => __( 'Featured Page 2', 'singularity' ),
		'section' => $section,
		'type'    => 'dropdown-pages',
		'default' => '',
		'active_callback'	=> 'singularity_pages_on_homepage'
	);
	
	$options['featured-page-extract-2'] = array(
		'id' => 'featured-page-extract-2',
		'label'   => __( 'Featured Page Extract 2', 'singularity' ),
		'section' => $section,
		'type'    => 'textarea',
		'default' => '',
		'active_callback'	=> 'singularity_page_2_on_homepage'
	);
	
	$options['home-featured-page-3'] = array(
		'id' => 'home-featured-page-3',
		'label'   => __( 'Featured Page 3', 'singularity' ),
		'section' => $section,
		'type'    => 'dropdown-pages',
		'default' => '',
		'active_callback'	=> 'singularity_pages_on_homepage'
	);
	
	$options['featured-page-extract-3'] = array(
		'id' => 'featured-page-extract-3',
		'label'   => __( 'Featured Page Extract 3', 'singularity' ),
		'section' => $section,
		'type'    => 'textarea',
		'default' => '',
		'active_callback'	=> 'singularity_page_3_on_homepage'
	);
	
	$options['home-featured-page-4'] = array(
		'id' => 'home-featured-page-4',
		'label'   => __( 'Featured Page 4', 'singularity' ),
		'section' => $section,
		'type'    => 'dropdown-pages',
		'default' => '',
		'active_callback'	=> 'singularity_pages_on_homepage'
	);
	
	$options['featured-page-extract-4'] = array(
		'id' => 'featured-page-extract-4',
		'label'   => __( 'Featured Page Extract 4', 'singularity' ),
		'section' => $section,
		'type'    => 'textarea',
		'default' => '',
		'active_callback'	=> 'singularity_page_4_on_homepage'
	);

	// Colors Panel
	$panel = 'colors';

	$panels[] = array(
		'id' => $panel,
		'title' => __( 'Colors', 'singularity' ),
		'priority' => '80'
	);

	$section = 'colors';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Global', 'singularity' ),
		'priority' => '10',
		'panel' => $panel
	);

	$options['primary-color'] = array(
		'id' => 'primary-color',
		'label'   => __( 'Link Color', 'singularity' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $primary_color,
		'selectors'		=> array(
			'a'
		),
		'declarations'	=> array(
			'color'
		)
	);

	$options['secondary-color'] = array(
		'id' => 'secondary-color',
		'label'   => __( 'Body Color', 'singularity' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $secondary_color,
	);
	
	$options['content-bg-color'] = array(
		'id' => 'content-bg-color',
		'label'   => __( 'Content Background Color', 'singularity' ),
		'section' => $section,
		'type'    => 'color',
		'default' => '#ffffff',
	);
	
	$options['border-color'] = array(
		'id' => 'border-color',
		'label'   => __( 'Border Color', 'singularity' ),
		'section' => $section,
		'type'    => 'color',
		'default' => '#ddd',
	);
	
	$options['light-grey'] = array(
		'id' => 'light-grey',
		'label'   => __( 'Light Grey', 'singularity' ),
		'section' => $section,
		'type'    => 'color',
		'default' => '#f9f9f9',
	);
	
	$section = 'header-colors';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Header', 'singularity' ),
		'priority' => '50',
		'panel' => $panel
	);
	
	$options['top-bar-bg'] = array(
		'id' => 'top-bar-bg',
		'label'   => __( 'Top Bar Background', 'singularity' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $primary_color,
	);
	
	$options['top-bar-color'] = array(
		'id' => 'top-bar-color',
		'label'   => __( 'Top Bar Color', 'singularity' ),
		'section' => $section,
		'type'    => 'color',
		'default' => '#fff',
	);
	
	$options['header-background'] = array(
		'id' => 'header-background',
		'label'   => __( 'Header Background', 'singularity' ),
		'section' => $section,
		'type'    => 'color',
		'default' => '#ffffff',
	);
	
	$options['header-color'] = array(
		'id' => 'header-color',
		'label'   => __( 'Header Text Color', 'singularity' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $secondary_color,
	);
	
	$options['header-link-color'] = array(
		'id' => 'header-link-color',
		'label'   => __( 'Header Link Color', 'singularity' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $secondary_color,
	);
	
	$section = 'footer-colors';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Footer', 'singularity' ),
		'priority' => '100',
		'panel' => $panel
	);
	
	$options['full-width-bg'] = array(
		'id' => 'full-width-bg',
		'label'   => __( 'Full Width Area Background', 'singularity' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $primary_color,
	);
	
	$options['full-width-opacity'] = array(
		'id' => 'full-width-opacity',
		'label'   => __( 'Full Width Background Opacity', 'singularity' ),
		'section' => $section,
		'type'    => 'range',
		'type'    => 'range',
		'default'	=> 1,
		'input_attrs' => array(
	        'min'   => 0,
	        'max'   => 1,
	        'step'  => 0.05,
	        'style' => 'color: #0a0',
		)
	);
	
	$options['full-width-color'] = array(
		'id' => 'full-width-color',
		'label'   => __( 'Full Width Area Color', 'singularity' ),
		'section' => $section,
		'type'    => 'color',
		'default' => '#E4EFF6',
	);
	
	$options['footer-bg'] = array(
		'id' => 'footer-bg',
		'label'   => __( 'Footer Background', 'singularity' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $secondary_color,
	);
	
	$options['footer-bg-opacity'] = array(
		'id' => 'footer-bg-opacity',
		'label'   => __( 'Footer Background Opacity', 'singularity' ),
		'section' => $section,
		'type'    => 'range',
		'default'	=> 1,
		'input_attrs' => array(
	        'min'   => 0,
	        'max'   => 1,
	        'step'  => 0.05,
	        'style' => 'color: #0a0',
		)
	);
	
	$options['footer-color'] = array(
		'id' => 'footer-color',
		'label'   => __( 'Footer Color', 'singularity' ),
		'section' => $section,
		'type'    => 'color',
		'default' => '#E5E7E9',
	);
	
	$options['footer-link-color'] = array(
		'id' => 'footer-link-color',
		'label'   => __( 'Footer Link Color', 'singularity' ),
		'section' => $section,
		'type'    => 'color',
		'default' => '#fff',
	);

	// Typography
	$section = 'typography';
	$font_choices = customizer_library_get_font_choices();

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Typography', 'singularity' ),
		'priority' => '80'
	);

	$options['primary-font'] = array(
		'id' => 'primary-font',
		'label'   => __( 'Primary Font', 'singularity' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $font_choices,
		'default' => 'Nunito'
	);

	$options['secondary-font'] = array(
		'id' => 'secondary-font',
		'label'   => __( 'Secondary Font', 'singularity' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $font_choices,
		'default' => 'sans-serif'
	);
	
	$options['base-font-size'] = array(
		'id' => 'base-font-size',
		'label'   => __( 'Base Font Size (%)', 'singularity' ),
		'section' => $section,
		'type'    => 'range',
		'default'	=> 100,
		'input_attrs' => array(
	        'min'   => 62.5,
	        'max'   => 150,
	        'step'  => 12.5,
	        'style' => 'color: #0a0',
		)
	);
	
	$options['use-typekit'] = array(
		'id' => 'use-typekit',
		'label'   => __( 'Use Typekit Fonts', 'singularity' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 0,
	);
	
	$options['typekit-kit'] = array(
		'id' => 'typekit-kit',
		'label'   => __( 'Kit Reference', 'singularity' ),
		'section' => $section,
		'type'    => 'text',
		'active_callback'	=> 'singularity_use_typekit'
	);
	
	$options['typekit-font-family'] = array(
		'id' => 'typekit-font-family',
		'label'   => __( 'Font Family', 'singularity' ),
		'section' => $section,
		'type'    => 'text',
		'active_callback'	=> 'singularity_use_typekit'
	);
	
	$options['typekit-body-weight'] = array(
		'id' => 'typekit-body-weight',
		'label'   => __( 'Body Weight', 'singularity' ),
		'section' => $section,
		'type'    => 'text',
		'default'	=> '400',
		'active_callback'	=> 'singularity_use_typekit'
	);
	
	$options['typekit-bold-weight'] = array(
		'id' => 'typekit-bold-weight',
		'label'   => __( 'Bold Weight', 'singularity' ),
		'section' => $section,
		'type'    => 'text',
		'default'	=> '700',
		'active_callback'	=> 'singularity_use_typekit'
	);

	

	$panel = 'ctdb';
	$section = 'ctdb_single';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Single', 'singularity' ),
		'priority' => '50',
		'panel' => $panel
	);
	
	$options['topic_template'] = array(
		'id' => 'topic_template',
		'label'   => __( 'Topic Template', 'singularity' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => array(
			'narrow'		=> __( 'Narrow', 'singularity' ),
			'no-sidebar'	=> __( 'No Sidebar', 'singularity' ),
			'sidebar-left'	=> __( 'Sidebar Left', 'singularity' ),
			'sidebar-right'	=> __( 'Sidebar Right', 'singularity' )		
		),
		'default' => 'no-sidebar',
		'active_callback'	=> 'singularity_is_discussion_board_enabled'
	);
	
	$section = 'ctdb_archive';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Archive', 'singularity' ),
		'priority' => '50',
		'panel' => $panel
	);
	
	$options['topic_archive_template'] = array(
		'id' => 'topic_archive_template',
		'label'   => __( 'Topics Archive Template', 'singularity' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => array(
			'narrow'		=> __( 'Narrow', 'singularity' ),
			'no-sidebar'	=> __( 'No Sidebar', 'singularity' ),
			'sidebar-left'	=> __( 'Sidebar Left', 'singularity' ),
			'sidebar-right'	=> __( 'Sidebar Right', 'singularity' )		
		),
		'default' => 'no-sidebar',
		'active_callback'	=> 'singularity_is_discussion_board_enabled'
	);

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Adds the panels to the $options array
	$options['panels'] = $panels;

	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $options );

	// To delete custom mods use: customizer_library_remove_theme_mods();

}
add_action( 'init', 'customizer_library_singularity_options' );
