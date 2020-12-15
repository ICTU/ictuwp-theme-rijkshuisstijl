<?php

/**
// * ----------------------------------------------------------------------------------
// * Rijkshuisstijl (Digitale Overheid) - page_showalldossiers-nieuwestyling.php
// * ----------------------------------------------------------------------------------
// * Toont alle dossiers
// * ----------------------------------------------------------------------------------
// * 
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 2.12.2
// * @desc.   Kortere check op uitschrijven nav.bar op home.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */

//* Template Name: DO - Template voor dossier-overzicht

//========================================================================================================

// Reposition the primary navigation menu
if ( ( is_front_page() ) || ( is_home() ) ) {
	add_action( 'genesis_after_header', 'genesis_do_nav' );
}

//========================================================================================================

//* Force full-width-content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

$wrapper_title  = '';
$checker        = '';


add_action( 'genesis_entry_content', 'rhswp_show_all_dossiers', 15 );

if ( rhswp_extra_contentblokken_checker() ) {
  
  add_action( 'genesis_entry_content', 'rhswp_write_extra_contentblokken', 12 );

  $wrapper_title  = 'Overige dossiers';
  $checker        = 'joe!';

}

genesis();

//========================================================================================================

function rhswp_show_all_dossiers() {
	
	if ( ! taxonomy_exists( RHSWP_CT_DOSSIER ) ) {
		echo __( "'Dossiers' taxonomy does not exist. Please activate the plugin 'ICTU / WP Register post types and taxonomies'", 'wp-rijkshuisstijl' );
		return;
	}
	
	global $post; 
	
	$timestamp = time();  
	
	if ( DO_MINIFY_JS ) {
		$timestamp = CHILD_THEME_VERSION;  
	}
	
	wp_enqueue_script( 'mixitupactions', RHSWP_THEMEFOLDER . '/js/min/filterpage-min.js', array( 'jquery' ), $timestamp, true );
	
	$title            = '';
	$dossierfilter    = '';
	$featonderwerpen  = '';
	
	$title              = get_field('dossier_overzicht_filter_title', $post->ID );
	$dossierfilter      = get_field('dossier_overzicht_filter', $post->ID );
	$featonderwerpen    = get_field('uitgelichte_dossiers', $post->ID );
	$hiddenonderwerpen  = get_field('dossier_overzicht_hide_dossiers', $post->ID );
	
	// 1 toon alles
	// 2 toon alles en uitgelichte dossiers
	// 3 toon alleen uitgelichte dossiers
	
	$args = array(
			'taxonomy'              => RHSWP_CT_DOSSIER,
			'hide_empty'            => false,
			'orderby'               => 'name',
			'order'                 => 'ASC',
			'ignore_custom_sort'    => TRUE,
			'echo'                  => 0,
			'title_li'              => ''
		);
	
	if ( 'dossier_overzicht_filter_as_list_plus' == $dossierfilter ) {
		
		echo '<div id="cardflex_tab1">';
		echo '<div id="filterselector">';
		/*
				echo '<div class="topicSearchWrapper">
		<form method="get" action="' . $_SERVER['REQUEST_URI'] . '" id="rhswp-searchform-onderwerpen" class="search-form filter-options">
				<fieldset class="filter-group searchkeyword">
				<label class="filter-form-label" for="filtertrefwoord">' . _x( 'Filter op onderwerp', 'onderwerpfilterpagina', 'wp-rijkshuisstijl' ) . ':</label>
				<div id="filter_group_search_form_bg">
				<input type="search" id="filtertrefwoord" name="filtertrefwoord" itemprop="query-input" placeholder="' . _x( 'onderwerp', 'onderwerpfilterpagina', 'wp-rijkshuisstijl' ) . '" value="">
				<button type="submit" id="filterbutton">Filter</button>
				</div>
				</fieldset>
				<button id="resetbutton" name="selectie" value="wis" type="submit" class="reset">' . _x( 'Verwijder filter', 'filterknop op onderwerppagina', 'wp-rijkshuisstijl' ) . '</button>
				</form></div>';
		*/
		
		
		if ( $featonderwerpen ) {
			
			$args_filter = array(
					'taxonomy'              => RHSWP_CT_DOSSIER,
					'hide_empty'            => false,
					'include'               => $featonderwerpen,
					'orderby'               => 'name',
					'order'                 => 'ASC',
					'ignore_custom_sort'    => TRUE,
					'echo'                  => 0,
					'title_li'              => ''
				);
			
			$terms = get_terms( RHSWP_CT_DOSSIER, $args_filter );
		
			if ($terms && ! is_wp_error( $terms ) ) { 
				
				echo '<div class="block no-top dossier_overzicht_popular ' . $dossierfilter . '">';
				echo '<h2>' . $title . '</h2>';
				echo '<ul class="links">';
				
				foreach ( $terms as $term ) {
					
					$excerpt    = '';
					$classattr  = 'class="filterbaardinges"';
					$title  	= $term->name;
					$href       = get_term_link( $term->term_id, RHSWP_CT_DOSSIER );
					
					if ( isset( $term->meta['headline'] ) && $term->meta['headline'] ) {
						$title .= ' (' . wp_strip_all_tags( strval( $term->meta['headline'] ) ) . ')';
					}

					printf( '<li><a href="%s">%s</a>', $href, $title );
					
				}
				
				echo '</ul>';
				echo '</div>';
				
			}
		}
		
		echo '</div>'; // id="filterselector";
		
	}
	
	echo '<h2 id="h-result">' . _x( 'Overview of all topics', 'Tussenkop op onderwerppagina', 'wp-rijkshuisstijl' ) . '</h2>';
	
	
	$args = array(
			'taxonomy'              => RHSWP_CT_DOSSIER,
			'parent'                => 0,
			'hide_empty'            => true,      
			'echo'                  => 0,
			'hierarchical'          => TRUE,
			'title_li'              => '',
		);
	
	if ( $hiddenonderwerpen ) {
		$args['exclude'] = $hiddenonderwerpen;
	}
	
	$terms = get_terms( RHSWP_CT_DOSSIER, $args );
	
	if ($terms && ! is_wp_error( $terms ) ) { 
		
		echo '<div class="' . $dossierfilter . ' unfiltered" id="mixitupfilterlist">';
		
		foreach ( $terms as $term ) {
			
			$href       = get_term_link( $term->term_id, RHSWP_CT_DOSSIER );
			$title 		= $term->name;
			
			$headline   =  get_term_meta( $term->term_id, 'headline', true );
			$excerpt    = '';
			if ( $term->description ) {
				$excerpt  =  wp_strip_all_tags( $term->description );
			}
			
			if ( isset( $headline[0] ) && ( strlen( $headline[0] ) > 0 ) ) {
				if ( is_array( $headline ) ) {
					$headline = strval( $headline[0] );
				}
				else {
					$headline = strval( $headline );
				}
				$title .= ' - ' . wp_strip_all_tags( $headline );
			}

			$term_id 		= $term->term_id;
			$taxonomy_name	= RHSWP_CT_DOSSIER;
			$termchildren	= get_term_children( $term_id, $taxonomy_name );

			if ( ! empty( $termchildren ) && ! is_wp_error( $termchildren ) ) {
				$classattr  	= 'class="term-children cat-item cat-item-' . $term_id . '"';
			}
			else {
				$classattr  	= 'class="cat-item cat-item-' . $term_id . '"';
			}
			
			$classattr  	.= ' data-mixible data-titel="' . strtolower( $title ) . ' ' . strtolower( $excerpt ) .  '"';
			$kortebeschr	= get_field( 'dossier_korte_beschrijving_voor_dossieroverzicht', RHSWP_CT_DOSSIER . '_' . $term->term_id );
			$alleregels		= explode('. ', $excerpt);
			
			if ( $alleregels[0] ) {
				$excerpt = $alleregels[0] . '.';
			}

			printf( '<div %s>', $classattr );
			printf( '<a href="%s"><h3>%s</h3></a>', $href, $title );
			printf( '<span class="excerpt">%s</span>', $excerpt );
			
			if ( ! empty( $termchildren ) && ! is_wp_error( $termchildren ) ) {
				echo '<ul class="children">';
				
				$listcounter = 0;

				foreach ( $termchildren as $child ) {
					$listcounter++;
					$term		= get_term_by( 'id', $child, $taxonomy_name );
					$excerpt	= wp_strip_all_tags( $term->description );
					echo '<li class="cat-item cat-item-' . $term->term_id . '" data-mixible data-titel="' . strtolower( $term->name ) . ' ' . strtolower( $excerpt ) . '">';
					echo '<a href="' . get_term_link( $child, $taxonomy_name ) . '">';
//					echo '('  . $listcounter . ') ';					
					echo $term->name;
					echo '</a>';
					printf( '<span class="excerpt">%s</span>', $excerpt );
					echo '</li>';
				}
				
				echo '</ul>';
			}
			
			echo '</div>';
			
		}
		
		echo '</div>';
		
		wp_reset_postdata();
		
	}
	
	if ( 'dossier_overzicht_filter_as_list_plus' == $dossierfilter ) {
		echo '</div>'; // id="cardflex_tab1";
	}
	
}

//========================================================================================================


