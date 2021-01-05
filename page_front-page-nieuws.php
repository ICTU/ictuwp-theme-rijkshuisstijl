<?php

/**
// * Rijkshuisstijl (Digitale Overheid) - page_front-page-nieuws.php
// * ----------------------------------------------------------------------------------
// * speciale functionaliteit voor de nieuwe homepage
// * ----------------------------------------------------------------------------------
// 
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 2.12.11
// * @desc.   Kopstructuur homepage verbeterd.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
// 
 */

//* Template Name: DO - Homepage met nieuws

//* Force full-width-content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );


remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );

//========================================================================================================

// nieuws
add_action( 'genesis_loop', 'rhswp_write_extra_contentblokken', 14 );

//========================================================================================================

genesis();

//========================================================================================================

