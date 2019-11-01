<?php

/**
// * Rijkshuisstijl (Digitale Overheid) - page_toolbox-cyberincident.php
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


//* Template Name: DO - Toolbox Cyberincident

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
		'image01-rapporteren-report'	=> 'Rapporteren',
		'image02-beoordelen-assess'     => 'Beoordelen',
		'image03-bijeenroepen-convene'  => 'Bijeenroepen',
		'image04-uitvoeren-execute'     => 'Uitvoeren',
		'image05-oplossen-resolve'		=> 'Oplossen'
	);

	echo '<div id="toolbox-cyberincident-illustrations">';

	$toolbox_inleiding		= get_field('titel_boven_plaat', $post->ID );
	if ( $toolbox_inleiding ) {
		echo '<div class="toolbox-introduction">' . apply_filters( 'the_content', $toolbox_inleiding ) . '</div>';
	}

	foreach ( $toolbox_images as $attr => $value ) {
		
		$counter++;
		
		$a_start	= '';
		$a_end		= '';
		$link 		= '';
		
		$titel_stap		= get_field('titel_stap_' . $counter, $post->ID ) ? get_field('titel_stap_' . $counter, $post->ID ) : $value;
		$titel_stap_en	= get_field('titel_stap_' . $counter . '_en', $post->ID ) ? get_field('titel_stap_' . $counter . '_en', $post->ID ) : '';
		$link_stap		= get_field('link_stap_' . $counter, $post->ID );
		if ( is_object( $link_stap ) ) {
			$link 				= get_permalink( $link_stap->ID );
		}

		if ( $titel_stap_en ) {
			$titel_stap_en = '<br><em lang="en">' . $titel_stap_en . '</em>';
		}
		if ( $titel_stap ) {
			$titel_stap = '<h2><span>' . $counter . '</span> ' . $titel_stap . $titel_stap_en . '</h2>';
		}

		$has_link = '';

		if ( $link ) {
			$a_start	= '<a href="' . $link . '">';
			$a_end		= '</a>';
			$has_link 	= ' has-link';
		}
		
		echo '<div id="toolbox_stap_' . $counter . '" class="toolbox-img' . $has_link . '">';
		echo $a_start;
		
		$svg_icons = get_stylesheet_directory()  . '/images/toolbox/cyberincident/' . $attr . '.svg';
		// If it exists, include it.
		if ( file_exists( $svg_icons ) ) {
			echo '<div class="svg">';
			require_once( $svg_icons );
			echo '</div>';
		}
//		else {
//			echo 'Foetsie? toolbox/cyberincident/' . $attr . '.svg<br>';
//		}
		
		echo $titel_stap;
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

