<?php

/**
 *  ----------------------------------------------------------------------------------
 *  Rijkshuisstijl (Digitale Overheid) - page_sitemap_title_info.php
 *  ----------------------------------------------------------------------------------
 *  Toont de sitemap. Deze sitemap komt bijna overeen met de sitemap die
 *  getoond wordt op de 404-pagina
 *  ----------------------------------------------------------------------------------
 * 
 *  @author  Paul van Buuren
 *  @license GPL-2.0+
 *  @package wp-rijkshuisstijl
 *  @version 2.12.2
 *  @desc.   Kortere check op uitschrijven nav.bar op home.
 *  @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 * 
 */


//* Template Name: (niet gebruiken: titel-lengte_

//========================================================================================================

//* Force full-width-content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Remove standard post content output
remove_action( 'genesis_post_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

add_action( 'genesis_entry_content', 'paginatitels', 13 );
add_action( 'genesis_entry_content', 'rhswp_get_sitemap', 15 );

genesis();

function paginatitels() {
	$args = array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'orderby'        => 'name',
		'order'          => 'ASC',
		'posts_per_page' => - 1,

	);

	$contentblockposts = new WP_query();
	$contentblockposts->query( $args );

	$postcounter          = 0;
	$pagecounter          = 0;
	$lengthcounter        = 0;
	$totalcounter         = 0;
	$grootstelengte       = 0;
	$grootstelengte_titel = '';
	$woordenlijst         = array();

	if ( $contentblockposts->have_posts() ) {
		echo '<h2>Berichten</h2>';
		echo '<ul>';
		while ( $contentblockposts->have_posts() ) : $contentblockposts->the_post();
			$postcounter ++;
			$totalcounter ++;
			echo '<li>';
			$title         = get_the_title();
			$strlength     = strlen( $title );
			$lengthcounter = ( $lengthcounter + $strlength );
			if ( $strlength > $grootstelengte ) {
				$grootstelengte       = $strlength;
				$grootstelengte_titel = $title;
			}

			$title2   = preg_replace( '/[^a-z ]/', '', strtolower( $title ) );
			$title2   = strtolower( $title2 );
			$woordjes = explode( " ", $title2 );
			foreach ( $woordjes as $woordje ) {
				if ( $woordenlijst[ $woordje ] ) {
					$woordenlijst[ $woordje ] = ( $woordenlijst[ $woordje ] + 1 );
				}
				else {
					$woordenlijst[ $woordje ] = 1;
				}
			}

			echo ' ***' . $strlength . '*** ';
			echo $title;
			echo '</li>';
		endwhile;
		echo '</ul>';


	}

	$args = array(
		'post_type'      => 'page',
		'post_status'    => 'publish',
		'orderby'        => 'name',
		'order'          => 'ASC',
		'posts_per_page' => - 1,

	);

	$contentblockposts = new WP_query();
	$contentblockposts->query( $args );

	if ( $contentblockposts->have_posts() ) {
		echo '<h2>Paginas</h2>';
		echo '<ul>';
		while ( $contentblockposts->have_posts() ) : $contentblockposts->the_post();
			$pagecounter ++;
			$totalcounter ++;
			echo '<li>';
			$title         = get_the_title();
			$strlength     = strlen( $title );
			$lengthcounter = ( $lengthcounter + $strlength );
			if ( $strlength > $grootstelengte ) {
				$grootstelengte       = $strlength;
				$grootstelengte_titel = $title;
			}
			echo ' ***' . $strlength . '*** ';

			$title2   = preg_replace( '/[^a-z ]/', '', strtolower( $title ) );
			$title2   = strtolower( $title2 );
			$woordjes = explode( " ", $title2 );
			foreach ( $woordjes as $woordje ) {
				if ( $woordenlijst[ $woordje ] ) {
					$woordenlijst[ $woordje ] = ( $woordenlijst[ $woordje ] + 1 );
				}
				else {
					$woordenlijst[ $woordje ] = 1;
				}
			}

			echo $title;
			echo '</li>';
		endwhile;
		echo '</ul>';


	}

	echo '<p>';
	echo $pagecounter . ' paginas<br>';
	echo $postcounter . ' berichten<br>';
	echo $totalcounter . ' totaal<br>';

	echo $grootstelengte . ' is het langste: "' . $grootstelengte_titel . '"<br>';
	echo ' Gemiddeld: ' . round( ( $lengthcounter / $totalcounter ), 1 ) . ' karakters (' . $lengthcounter . ' / ' . $totalcounter . ')';
	echo '</p>';

	if ( $woordenlijst ) {
		echo '<h2>Woordjes</h2>';
		echo '<ul>';

		foreach ( $woordenlijst as $key => $value ) {
			echo '<li>' . $key . ' **** ' . strlen( $key ) . ' **** ' . $value . '</li>';
		}

		echo '</ul>';

	}


	// RESET THE QUERY
	wp_reset_query();

}
