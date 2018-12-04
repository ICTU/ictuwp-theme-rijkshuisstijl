<?php


/**
// * Rijkshuisstijl (Digitale Overheid) - search-helper-functions.php
// * ----------------------------------------------------------------------------------
// * functies voor zoekfunctionaliteit
// * ----------------------------------------------------------------------------------
// *
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 0.11.19
// * @desc.   Debug verbeterd en print style verbeterd.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */


//========================================================================================================

function rhswp_searchwp_term_highlight_auto_excerpt( $excerpt ) {
	global $post;
	
	if ( ! is_search() ) {
		return $excerpt;
	}
	// prevent recursion
	remove_filter( 'get_the_excerpt', 'rhswp_searchwp_term_highlight_auto_excerpt' );
	
	$global_excerpt = searchwp_term_highlight_get_the_excerpt_global( $post->ID, null, get_search_query() );

	add_filter( 'get_the_excerpt', 'rhswp_searchwp_term_highlight_auto_excerpt' );

	return 'ik ben gefilterd, heur! ' . $global_excerpt;

}

//add_filter( 'get_the_excerpt', 'rhswp_searchwp_term_highlight_auto_excerpt' );

//========================================================================================================

function rhswp_searchwp_maybe_include_term_archive( $include, $engine, $terms ) {
  // only have term archives included for supplemental search engine with name 'supplemental'
  return ( $engine == 'supplemental' ) ? true : false;
}

add_filter( 'searchwp_term_archive_enabled', 'rhswp_searchwp_maybe_include_term_archive', 10, 3 );

//========================================================================================================

function rhswp_searchwp_exclude( $ids, $engine, $terms ) {

  $ids[] = 377; // is ID voor dossier 'NL Digibeter'

  // dit was een oud, inmiddels buiten gebruik gesteld, paginatemplate dat de zoekresultaten vervuilde
	$entries_to_exclude = get_posts(
		array(
			'nopaging'    => true,
			'fields'      => 'ids',
      'post_type'   => 'page', 
      'meta_query'  => array( 
        array(
          'key'     => '_wp_page_template', 
          'value'   => 'page_dossiersingleactueel.php'
        )
      )
		)
	);

	$ids = array_unique( array_merge( $ids, array_map( 'absint', $entries_to_exclude ) ) );

	return $ids;

}

add_filter( 'searchwp_exclude', 'rhswp_searchwp_exclude', 10, 3 );

//========================================================================================================
