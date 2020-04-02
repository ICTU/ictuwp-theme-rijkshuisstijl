<?php

/**
 * Rijkshuisstijl (Digitale Overheid) - page_toolbox-datagedrevenwerken.php
 * ----------------------------------------------------------------------------------
 * Landingspagina voor toolbox
 * ----------------------------------------------------------------------------------
 * 
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 2.13.3
 * @desc.   Laatste bugfix toolbox datagedreven werken en def achtergrondplaatje.
 * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 * 
 */


//* Template Name: DO - Toolbox LED datagedreven werken

//========================================================================================================

// Reposition the primary navigation menu
if ( ( is_front_page() ) || ( is_home() ) ) {
	add_action( 'genesis_after_header', 'genesis_do_nav' );
}

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
		'01-ontdekken-vraag-en-aanpak'                                   => 'Ontdekken: vraag en aanpak',
		'02-aandacht-voor-ethische-en-juridische-aspecten'               => 'Aandacht voor ethische en juridische aspecten',
		'03-randvoorwaarden-scheppen'                                    => 'Randvoorwaarden scheppen',
		'04-de-juiste-methode-voor-het-juiste-doel-clean-data'           => 'Aan de slag: datagedreven werken in de praktijk',
		'05-verzamelen-bruikbaar-maken-en-verwerken-van-data-clean_data' => 'Verzamelen, bruikbaar maken en verwerken van data',
		'06-aan-de slag-datagedreven werken in de praktijk'              => 'De juiste methode voor het juiste doel'
	);

	$toolbox_inleiding = get_field( 'titel_boven_plaat', $post->ID );

	if ( $toolbox_inleiding ) {
		echo '<div class="toolbox-introduction">' . apply_filters( 'the_content', $toolbox_inleiding ) . '</div>';
	}

	echo '<div id="toolbox-datagedreven-werken-illustrations">';

	foreach ( $toolbox_images as $attr => $value ) {

		$counter ++;

		$a_start = '';
		$a_end   = '';
		$link    = '';

		$titel_principe = get_field( 'titel_stap_' . $counter, $post->ID ) ? get_field( 'titel_stap_' . $counter, $post->ID ) : $value;
		$link_principe  = get_field( 'link_stap_' . $counter, $post->ID );

		if ( is_object( $link_principe ) ) {
			$link = get_permalink( $link_principe->ID );
		}

		if ( ! $titel_principe ) {
			$titel_principe = 'nee + ' . $value;
		}

		$titel_principe = '<h2>' . $titel_principe . '</h2>';

		$has_link = '';

		if ( $link ) {
			$a_start  = '<a href="' . $link . '">';
			$a_end    = '</a>';
			$has_link = ' has-link';
		}

		echo '<div id="toolbox_principe_' . $counter . '" class="toolbox-img' . $has_link . '">';
		echo $a_start;

		$image = get_stylesheet_directory() . '/images/toolbox/datagedreven-werken/' . $attr . '.png';

		// If it exists, include it.
		if ( file_exists( $image ) ) {
			echo '<img src="' . get_stylesheet_directory_uri() . '/images/toolbox/datagedreven-werken/' . $attr . '.png" alt="" class="png">';
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

