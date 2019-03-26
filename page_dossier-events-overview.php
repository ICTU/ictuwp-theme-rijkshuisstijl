<?php

/**
// * Rijkshuisstijl (Digitale Overheid) - page_dossier-events-overview.php
// * ----------------------------------------------------------------------------------
// * Toont de events voor dit dossier
// * ----------------------------------------------------------------------------------
// *
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 2.5.1a
// * @desc.   Lijst met pagina-templates gecontroleerd en opgeschoond.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */


//* Template Name: VERWIJDEREN 02 - (dossiers) events voor een dossier 

//========================================================================================================

add_action( 'genesis_entry_content', 'rhswp_get_events_for_dossier', 14 );

if ( rhswp_extra_contentblokken_checker() ) {
  add_action( 'genesis_entry_content', 'rhswp_write_extra_contentblokken', 16 );
}


// Remove the standard pagination, so we don't get two sets
remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );

//========================================================================================================

genesis();

//========================================================================================================



