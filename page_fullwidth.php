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
// * @version 2.12.1
// * @desc.   Homepage nu vanuit template file (page_front-page.php).
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
// 
 */


//* Template Name: DO - Template voor pagina zonder zijbalk met widgets

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

genesis();
