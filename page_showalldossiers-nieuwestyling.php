<?php

/**
 * // * ----------------------------------------------------------------------------------
 * // * Rijkshuisstijl (Digitale Overheid) - page_showalldossiers-nieuwestyling.php
 * // * ----------------------------------------------------------------------------------
 * // * Toont alle dossiers
 * // * ----------------------------------------------------------------------------------
 * // *
 * // * @author  Paul van Buuren
 * // * @license GPL-2.0+
 * // * @package wp-rijkshuisstijl
 * // * @version 2.12.2
 * // * @desc.   Kortere check op uitschrijven nav.bar op home.
 * // * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */

//* Template Name: DO - Template voor dossier-overzicht

//========================================================================================================

//* Force full-width-content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

$wrapper_title = '';
$checker       = '';


$sortering = get_query_var( 'sortdossier' );

add_action( 'genesis_entry_content', 'rhswp_show_dossiers_sort_markering', 15 );

if ( 'group' === $sortering ) {
	$sortering = 'group';
	add_action( 'genesis_entry_content', 'rhswp_show_dossiers_by_group', 17 );
} else {
	$sortering = 'alfabet';
	add_action( 'genesis_entry_content', 'rhswp_show_dossiers_by_alphabet', 17 );
}

if ( rhswp_extra_contentblokken_checker() ) {

	add_action( 'genesis_entry_content', 'rhswp_write_extra_contentblokken', 12 );

	$wrapper_title = 'Overige dossiers';
	$checker       = 'joe!';

}

genesis();


//========================================================================================================

function rhswp_show_dossiers_sort_markering() {

	global $post;

	$sortering = get_query_var( 'sortdossier' );
	$permalink = get_the_permalink();
	$alfabet   = _x( 'Gesorteerd op alfabet', 'sortering onderwerppagina', 'wp-rijkshuisstijl' );
	$group     = _x( 'Gegroepeerd op thema', 'sortering onderwerppagina', 'wp-rijkshuisstijl' );
	$markering = '<p class="dossier-sortering">';

	if ( 'group' === $sortering ) {
		$markering .= $group . '  <a href="' . $permalink . '?sortdossier=alfabet">' . _x( 'Sorteer alfabetisch', 'sortering onderwerppagina', 'wp-rijkshuisstijl' ) . '</a>';
	} else {
		$markering .= $alfabet . '  <a href="' . $permalink . '?sortdossier=group">' . _x( 'Groepeer per thema', 'sortering onderwerppagina', 'wp-rijkshuisstijl' ) . '</a>';
	}
	$markering .= '</p>';

	echo $markering;

}

//========================================================================================================

function rhswp_show_dossiers_by_alphabet() {

	$taxonomy_name     = RHSWP_CT_DOSSIER;
	$args              = array(
		'taxonomy'           => RHSWP_CT_DOSSIER,
		'hide_empty'         => false,
		'orderby'            => 'name',
		'order'              => 'ASC',
		'ignore_custom_sort' => true,
		'echo'               => 0,
		'hierarchical'       => false,
		'title_li'           => ''
	);
	$hiddenonderwerpen = get_field( 'dossier_overzicht_hide_dossiers', $post->ID );
	if ( $hiddenonderwerpen ) {
		$args['exclude'] = $hiddenonderwerpen;
	}

	$terms = get_terms( RHSWP_CT_DOSSIER, $args );

	if ( $terms && ! is_wp_error( $terms ) ) {

		$letter = '';
		$tag = '';

		echo '<div class="alphabet">';
		foreach ( $terms as $term ) {
			$huidigeletter = substr( strtolower( $term->name ), 0, 1 );
			if ( $huidigeletter !== $letter ) {
				echo '<a href="#list_' . strtolower( $huidigeletter ) . '">' . strtoupper( $huidigeletter ) . '</a>';
				$letter = $huidigeletter;
			}
		}
		echo '</div>'; // .dossier-list column-layout

		$letter = '';
		$tag = '';

		echo '<div class="dossier-list column-layout">';
		foreach ( $terms as $term ) {
			$huidigeletter = substr( strtolower( $term->name ), 0, 1 );
			if ( $huidigeletter !== $letter ) {
				echo $tag . '<h2 id="list_' . strtolower( $huidigeletter ) . '">' . strtoupper( $huidigeletter ) . '</h2>';
				echo '<ul>';
				$letter = $huidigeletter;
				$tag = "</ul>\n\n\n";
			}
			echo '<li class="cat-item cat-item-' . $term->term_id . '">';
			echo '<a href="' . get_term_link( $term, $taxonomy_name ) . '">';
			echo $term->name;
			echo '</a>';
			echo '</li>';
		}
		echo $tag;
		echo '</div>'; // .dossier-list column-layout
	}
}

//========================================================================================================

function rhswp_show_dossiers_by_group() {

	if ( ! taxonomy_exists( RHSWP_CT_DOSSIER ) ) {
		echo __( "'Dossiers' taxonomy does not exist. Please activate the plugin 'ICTU / WP Register post types and taxonomies'", 'wp-rijkshuisstijl' );

		return;
	}

	global $post;


	// 1 toon alles
	// 2 toon alles en uitgelichte dossiers
	// 3 toon alleen uitgelichte dossiers


	$args = array(
		'taxonomy'     => RHSWP_CT_DOSSIER,
		'parent'       => 0,
		'hide_empty'   => true,
		'echo'         => 0,
		'hierarchical' => true,
		'title_li'     => '',
	);

	$hiddenonderwerpen = get_field( 'dossier_overzicht_hide_dossiers', $post->ID );
	if ( $hiddenonderwerpen ) {
		$args['exclude'] = $hiddenonderwerpen;
	}

	$terms = get_terms( RHSWP_CT_DOSSIER, $args );

	if ( $terms && ! is_wp_error( $terms ) ) {

		echo '<div class="dossier-list">';
		foreach ( $terms as $term ) {

			$term_id       = $term->term_id;
			$taxonomy_name = RHSWP_CT_DOSSIER;
			$termchildren  = get_term_children( $term_id, $taxonomy_name );
			$permalink     = get_term_link( $term->term_id, RHSWP_CT_DOSSIER );
			$title         = $term->name;
			$headline      = get_term_meta( $term->term_id, 'headline', true );

			if ( isset( $headline[0] ) && ( strlen( $headline[0] ) > 0 ) ) {
				if ( is_array( $headline ) ) {
					$headline = strval( $headline[0] );
				} else {
					$headline = strval( $headline );
				}
				$title .= ' - ' . wp_strip_all_tags( $headline );
			}

			if ( ! empty( $termchildren ) && ! is_wp_error( $termchildren ) ) {
				$classattr = 'class="term-children cat-item cat-item-' . $term_id . '"';
			} else {
				$classattr = 'class="cat-item cat-item-' . $term_id . '"';
			}

			printf( '<div %s>', $classattr );
			printf( '<a href="%s"><h3>%s</h3></a>', $permalink, $title );

			if ( ! empty( $termchildren ) && ! is_wp_error( $termchildren ) ) {
				echo '<ul class="children column-layout">';

				$listcounter = 0;

				foreach ( $termchildren as $child ) {
					$listcounter ++;
					$term = get_term_by( 'id', $child, $taxonomy_name );
					echo '<li class="cat-item cat-item-' . $term->term_id . '">';
					echo '<a href="' . get_term_link( $child, $taxonomy_name ) . '">';
					echo $term->name;
					echo '</a>';
					echo '</li>';
				}

				echo '</ul>';
			}

			echo '</div>';

		}
		echo '</div>'; // .dossier-list

		wp_reset_postdata();

	}

}

//========================================================================================================


