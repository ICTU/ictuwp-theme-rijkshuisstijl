<?php

/**
// * Rijkshuisstijl (Digitale Overheid) - page_dossier-document-overview.php
// * ----------------------------------------------------------------------------------
// * Toont de nieuws-pagina van een dossier
// * ----------------------------------------------------------------------------------
// *
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 2.5.1a
// * @desc.   Lijst met pagina-templates gecontroleerd en opgeschoond.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */


//* Template Name: VERWIJDEREN 03 - (dossiers) documenten voor een dossier 

//========================================================================================================

add_action( 'genesis_entry_content', 'rhswp_get_documents_for_dossier', 15 );

if ( rhswp_extra_contentblokken_checker() ) {
  add_action( 'genesis_entry_content', 'rhswp_write_extra_contentblokken', 16 );
}

// Remove the standard pagination, so we don't get two sets
remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );

//========================================================================================================

genesis();

//========================================================================================================

