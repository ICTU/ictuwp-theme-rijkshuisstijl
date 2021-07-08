<?php

/**
// * Rijkshuisstijl (Digitale Overheid) - page_fullwidth.php
// * ----------------------------------------------------------------------------------
// * Pagina met alleen full width, geen zijbalk
// * ----------------------------------------------------------------------------------
// *
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 2.12.2
// * @desc.   Kortere check op uitschrijven nav.bar op home.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
//
 */


//* Template Name: DO - Template voor pagina zonder zijbalk met widgets

//========================================================================================================

if ( rhswp_extra_contentblokken_checker() ) {
	add_action( 'genesis_entry_content', 'rhswp_write_extra_contentblokken', 14 );
}

//========================================================================================================

// Ter vervanging van de vervallen widget-ruimte en de 'extra links'-widget daarin
//add_action( 'genesis_entry_content', 'rhswp_pagelinks_replace_widget', 14 );

//========================================================================================================

//* Force full-width-content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

genesis();
