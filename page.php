<?php

/**
// * Rijkshuisstijl (Digitale Overheid) - page.php
// * ----------------------------------------------------------------------------------
// * Toont alle dossiers
// * ----------------------------------------------------------------------------------
// * 
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 2.12.1
// * @desc.   Homepage nu vanuit template file (page_front-page.php).
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */


if ( rhswp_extra_contentblokken_checker() ) {
  add_action( 'genesis_entry_content', 'rhswp_write_extra_contentblokken', 14 );
}

//========================================================================================================

// Reposition the primary navigation menu
if ( ( is_front_page() ) || ( is_home() ) ) {
	// only show menu if this is really the home page
}
else {

	remove_action( 'genesis_after_header', 'genesis_do_nav' );

}

//========================================================================================================

genesis();

