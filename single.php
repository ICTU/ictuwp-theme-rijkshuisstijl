<?php

// Rijkshuisstijl (Digitale Overheid) - single.php
// ----------------------------------------------------------------------------------
// Toont een bericht
// ----------------------------------------------------------------------------------
// 
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 2.12.2
// * @desc.   Kortere check op uitschrijven nav.bar op home.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl


//========================================================================================================

// Geen uitgelichte afbeelding meer
//add_action( 'genesis_entry_content', 'rhswp_single_add_featured_image', 9 );

//========================================================================================================

if ( WP_DEBUG_FULL_WIDTH ) {

	// TODO
	// full width
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

	// Ter vervanging van de vervallen widget-ruimte en de 'extra links'-widget daarin
	add_action( 'genesis_entry_content', 'rhswp_pagelinks_replace_widget', 16 );

	// social media share buttons
	add_action( 'genesis_entry_content', 'wbvb_d2e_socialbuttons', 14 );

}

//========================================================================================================

add_action( 'genesis_entry_content', 'rhswp_write_extra_contentblokken', 16 );

//========================================================================================================

genesis();

//========================================================================================================

