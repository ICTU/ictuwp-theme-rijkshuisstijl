<?php

/**
// * Rijkshuisstijl (Digitale Overheid) - page_toolbox-home.php
// * ----------------------------------------------------------------------------------
// * Landingspagina voor toolbox
// * ----------------------------------------------------------------------------------
// *
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 2.6.3a
// * @desc.   Eerste opzet toolbox-pagina's.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
// *
 */


//* Template Name: DO - Landingspagina Toolbox

//========================================================================================================

//* Force full-width-content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// append the images to the content
add_action( 'genesis_entry_content', 'dohupseflups', 8 );


//========================================================================================================

/**
 * Adds custom SVG icon sprite to theme footer.
 *
 * @author Jackie D'Elia
 * @package Genesis Theme code
 * @since  1.0.0
 * @license GPL-2.0+
 * @link    https://jackiedelia.com/
 */
function jdd_include_svg_icons() {
	// Define SVG sprite file.
	$svg_icons = get_stylesheet_directory()  . '/images/toolbox/toolbox-landingspagina-sprite.svg';
	// If it exists, include it.
	if ( file_exists( $svg_icons ) ) {
		require_once( $svg_icons );
	}

	$svg_icons = get_stylesheet_directory()  . '/images/toolbox/optimised.svg';
	// If it exists, include it.
	if ( file_exists( $svg_icons ) ) {
		require_once( $svg_icons );
	}

	
	
}

//========================================================================================================

function dohupseflups() {

	global $post;
		
	$counter = 0;
	
	$toolbox_images = array(
		'01-kwaliteit_van_data_algoritme_en_analyse'	=> 'Kwaliteit van data algoritme en analyse',
		'02-belanghebbenden_betrekken'     				=> 'Belanghebbenden betrekken',
		'03-transparantie_en_verantwoording'     		=> 'Transparantie en verantwoording',
		'04-wet-_en_regelgeving_respecteren'     		=> 'Wet- en regelgeving respecteren',
		'05-monitoren_en_evalueren'     				=> 'Monitoren en evalueren',
		'06-veiligheid_borgen'     						=> 'Veiligheid borgen',
		'07-publieke_waarden_centraal'					=> 'Publieke waarden centraal',
	);

	$toolbox_inleiding		= get_field('toolbox_inleiding', $post->ID );

	if ( $toolbox_inleiding ) {
		echo '<p>' . apply_filters( 'the_content', $toolbox_inleiding ) . '</p>';
	}

	echo '<div id="hier-mijn-achtergrond-toolbox">';

	foreach ( $toolbox_images as $attr => $value ) {
		
		$counter++;
		
		$a_start	= '';
		$a_end		= '';
		
		$titel_principe		= get_field('titel_principe_' . $counter, $post->ID ) ? get_field('titel_principe_' . $counter, $post->ID ) : $value;
		$link_principe		= get_field('link_principe' . $counter, $post->ID ) ? : '/';

		if ( $titel_principe ) {
			$titel_principe = '<h2>' . $titel_principe . '</h2>';
		}
		
		if ( $link_principe ) {
			$a_start	= '<a href="' . $link_principe . '">';
			$a_end		= '</a>';
		}
		
		echo '<div id="toolbox_principe_' . $counter . '" class="toolbox-img">';
		echo $a_start;
		
		$svg_icons = get_stylesheet_directory()  . '/images/toolbox/' . $attr . '.svg';
		// If it exists, include it.
		if ( file_exists( $svg_icons ) ) {
			echo '<div class="svg">';
			require_once( $svg_icons );
			echo '</div>';
		}
		
		echo $titel_principe;
		echo $a_end;
		echo '</div>';
		
	}

	echo '</div>';
	
}

//========================================================================================================

/**
 * Return SVG markup.
 *
 * @param array $args {
 *     Parameters needed to display an SVG.
 *
 *     @type string $icon  Required SVG icon filename.
 *     @type string $title Optional SVG title.
 *     @type string $desc  Optional SVG description.
 * }
 * @return string SVG markup.
 */
function jdd_get_svg( $args = array() ) {
	// Make sure $args are an array.
	if ( empty( $args ) ) {
		return __( 'Please define default parameters in the form of an array.', 'wp-rijkshuisstijl' );
	}

	// Define an icon.
	if ( false === array_key_exists( 'icon', $args ) ) {
		return __( 'Please define an SVG icon filename.', 'wp-rijkshuisstijl' );
	}

	// Set defaults.
	$defaults = array(
		'icon'        => '',
		'title'       => '',
		'desc'        => '',
		'fallback'    => false,
		'class'       => '',
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Set aria hidden.
	$aria_hidden = ' aria-hidden="true"';

	// Set ARIA.
	$aria_labelledby = '';

	/*
	 * Theme doesn't use the SVG title or description attributes; non-decorative icons are described with .screen-reader-text.
	 *
	 * However, child themes can use the title and description to add information to non-decorative SVG icons to improve accessibility.
	 *
	 * Example 1 with title: <?php echo jdd_get_svg( array( 'icon' => 'arrow-right', 'title' => __( 'This is the title', 'wp-rijkshuisstijl' ) ) ); ?>
	 *
	 * Example 2 with title and description: <?php echo jdd_get_svg( array( 'icon' => 'arrow-right', 'title' => __( 'This is the title', 'wp-rijkshuisstijl' ), 'desc' => __( 'This is the description', 'wp-rijkshuisstijl' ) ) ); ?>
	 *
	 * See https://www.paciellogroup.com/blog/2013/12/using-aria-enhance-svg-accessibility/.
	 */
	if ( $args['title'] ) {
		$aria_hidden     = '';
		$unique_id       = uniqid();
		$aria_labelledby = ' aria-labelledby="title-' . $unique_id . '"';

		if ( $args['desc'] ) {
			$aria_labelledby = ' aria-labelledby="title-' . $unique_id . ' desc-' . $unique_id . '"';
		}
	}

	// Begin SVG markup.
	$svg = '<svg class="icon icon-' . esc_attr( $args['icon'] ) . ' ' . esc_attr( $args['class'] ) .'"' . $aria_hidden . $aria_labelledby . ' role="img">';

	// Display the title.
	if ( $args['title'] ) {
		$svg .= '<title id="title-' . $unique_id . '">' . esc_html( $args['title'] ) . '</title>';

		// Display the desc only if the title is already set.
		if ( $args['desc'] ) {
			$svg .= '<desc id="desc-' . $unique_id . '">' . esc_html( $args['desc'] ) . '</desc>';
		}
	}

	/*
	 * Display the icon.
	 *
	 * The whitespace around `<use>` is intentional - it is a work around to a keyboard navigation bug in Safari 10.
	 *
	 * See https://core.trac.wordpress.org/ticket/38387.
	 */
	$svg .= ' <use href="#' . esc_html( $args['icon'] ) . '" xlink:href="#' . esc_html( $args['icon'] ) . '"></use> ';

	// Add some markup to use as a fallback for browsers that do not support SVGs.
	if ( $args['fallback'] ) {
		$svg .= '<span class="svg-fallback ' . esc_attr( $args['icon'] ) . '"></span>';
	}

	$svg .= '</svg>';
	return $svg;
}

//========================================================================================================

genesis();

//========================================================================================================

