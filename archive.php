<?php

/**
 * Rijkshuisstijl (Digitale Overheid) - archive.php
 * ----------------------------------------------------------------------------------
 * Toont de aanwezige content
 * ----------------------------------------------------------------------------------
 * 
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 2.12.4
 * @desc.   search widgetruimte toegevoegd aan no-results.
 * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */

//========================================================================================================

// post navigation verplaatsen tot buiten de flex-ruimte
add_action( 'genesis_after_loop', 'genesis_posts_nav', 3 );

remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );

//Removes Title and Description on Archive, Taxonomy, Category, Tag
remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );

// add description
add_action( 'genesis_before_loop', 'rhswp_add_taxonomy_description', 15 );

/** Replace the standard loop with our custom loop */
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'rhswp_archive_loop' );

//========================================================================================================

genesis();



