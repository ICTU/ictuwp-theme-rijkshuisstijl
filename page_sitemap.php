<?php

/**
// * ----------------------------------------------------------------------------------
// * Rijkshuisstijl (Digitale Overheid) - page_sitemap.php
// * ----------------------------------------------------------------------------------
// * Toont de sitemap. Deze sitemap komt bijna overeen met de sitemap die
// * getoond wordt op de 404-pagina
// * ----------------------------------------------------------------------------------
// * 
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 2.12.1
// * @desc.   Homepage nu vanuit template file (page_front-page.php).
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
// 
 */


//* Template Name: DO - Template voor sitemap-pagina

//========================================================================================================

// Reposition the primary navigation menu
if ( ( is_front_page() ) || ( is_home() ) ) {
	// only show menu if this is really the home page
}
else {

	remove_action( 'genesis_after_header', 'genesis_do_nav' );

}

//========================================================================================================

//* Force full-width-content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Remove standard post content output
remove_action( 'genesis_post_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

add_action( 'genesis_entry_content', 'rhswp_get_sitemap', 15 );

genesis();
