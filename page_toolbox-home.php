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
// * @version 2.10.1ed
// * @desc.   Toolbox voor cyberincidenten toevoegd.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
// *
 */


//* Template Name: DO - Toolbox Innovatie

//========================================================================================================

//* Force full-width-content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// append the images to the content
add_action( 'genesis_before_entry_content', 'rhswp_toolbox_append_illustrations', 8 );

// append the images to the content
add_action( 'genesis_after_entry_content', 'rhswp_toolbox_append_the_content_endtag', 12 );

//========================================================================================================

function rhswp_toolbox_append_illustrations() {

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
		echo '<div class="toolbox-introduction">' . apply_filters( 'the_content', $toolbox_inleiding ) . '</div>';
	}

	echo '<div id="toolbox-innovatie-illustrations">';

	foreach ( $toolbox_images as $attr => $value ) {
		
		$counter++;
		
		$a_start	= '';
		$a_end		= '';
		$link 		= '';
		
		$titel_principe		= get_field('titel_principe_' . $counter, $post->ID ) ? get_field('titel_principe_' . $counter, $post->ID ) : $value;
		$link_principe		= get_field('link_principe_' . $counter, $post->ID );
		if ( is_object( $link_principe ) ) {
			$link 				= get_permalink( $link_principe->ID );
		}

		if ( $titel_principe ) {
//			$titel_principe = '<h2>' . $counter . ' - ' . $titel_principe . '</h2>';
			$titel_principe = '<h2>' . $titel_principe . '</h2>';
		}

		$has_link = '';

		if ( $link ) {
			$a_start	= '<a href="' . $link . '">';
			$a_end		= '</a>';
			$has_link 	= ' has-link';
		}
		
		echo '<div id="toolbox_principe_' . $counter . '" class="toolbox-img' . $has_link . '">';
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

	echo '<div class="toolbox-the-content">';
	
}

//========================================================================================================

function rhswp_toolbox_append_the_content_endtag() {

	echo '</div>'; // div.toolbox-the-content
	
}

//========================================================================================================

genesis();

//========================================================================================================

