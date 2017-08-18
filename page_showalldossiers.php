<?php

/**
 * Rijkshuisstijl (Digitale Overheid) - page_showalldossiers.php
 * ----------------------------------------------------------------------------------
 * Toont alle dossiers
 * ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.10.2
 * @desc.   Icon external link. Filterform aangepast.
 * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */


//* Template Name: 04 - (dossiers) overzicht alle dossiers (met uitgelichte dossiers)

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
  

$timestamp = time();  

  wp_enqueue_script( 'mixitupactions', RHSWP_THEMEFOLDER . '/js/min/filterpage-min.js', array( 'jquery' ), $timestamp, true );

  global $post; 

  $title            = '';
  $dossierfilter    = '';
  $featonderwerpen  = '';

  if ( function_exists( 'get_field' ) ) {
	  $title            = get_field('dossier_overzicht_filter_title', $post->ID );
	  $dossierfilter    = get_field('dossier_overzicht_filter', $post->ID );
	  $featonderwerpen  = get_field('uitgelichte_dossiers', $post->ID );
  }

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
  	echo '<div class="topicSearchWrapper"><form method="get" action="' . $_SERVER['REQUEST_URI'] . '" id="rhswp-searchform-onderwerpen" class="search-form filter-options">
      <fieldset class="filter-group searchkeyword">
        <label class="filter-form-label" for="filtertrefwoord">' . _x( 'Vind een onderwerp over', 'onderwerpfilterpagina', 'wp-rijkshuisstijl' ) . ':</label>
        <div id="filter_group_search_form_bg">
          <input type="search" id="filtertrefwoord" name="filtertrefwoord" itemprop="query-input" placeholder="' . _x( 'filter op onderwerp', 'onderwerpfilterpagina', 'wp-rijkshuisstijl' ) . '" value="">
          <button type="submit" id="searchbutton">Filter</button>
        </div>
      </fieldset>
    <button id="filter" name="selectie" value="wis" type="submit" class="reset">' . _x( 'Toon alle onderwerpen', 'filterknop op onderwerppagina', 'wp-rijkshuisstijl' ) . '</button>
  </form></div>';  
	
	  
	
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
          $title  		= $term->name;
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
  
  echo '<h2>' . _x( 'Alle onderwerpen', 'Tussenkop op onderwerppagina', 'wp-rijkshuisstijl' ) . '</h2>';
  
  $args = array(
    'taxonomy'              => RHSWP_CT_DOSSIER,
    'parent'                => 0,
    'hide_empty'            => true,      
    'echo'                  => 0,
    'hierarchical'          => TRUE,
    'title_li'              => '',
  );
  
  $terms = get_terms( RHSWP_CT_DOSSIER, $args );
	
	if ($terms && ! is_wp_error( $terms ) ) { 

    echo '<div class="' . $dossierfilter . ' unfiltered" id="mixitupfilterlist">';
		
    foreach ( $terms as $term ) {
      
      $href       = get_term_link( $term->term_id, RHSWP_CT_DOSSIER );
      $title  		= $term->name;
      
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
      
      $childargs = array(
        'taxonomy'              => RHSWP_CT_DOSSIER,
        'orderby'               => 'name',
        'order'                 => 'ASC',
        'hide_empty'            => true,      
        'ignore_custom_sort'    => TRUE,
        'echo'                  => 0,
        'hierarchical'          => TRUE,
        'title_li'              => '',
        'parent'                => $term->term_id,
        'show_option_none'      => '',
        'walker'                => new rhswp_custom_walker_for_taxonomies()
      );
      
      
      $termchildren = wp_list_categories( $childargs );
      
      if ( ! empty( $termchildren ) && ! is_wp_error( $termchildren ) ) {
        $classattr  	= 'class="i-have-kids cat-item cat-item-' . $term->term_id . '"';
      }
      else {
        $classattr  	= 'class="cat-item cat-item-' . $term->term_id . '"';
      }
      
      $classattr  	.= ' data-mixible data-titel="' . strtolower( $title ) . ' ' . strtolower( $excerpt ) .  '"';
      
      $kortebeschr	= get_field( 'dossier_korte_beschrijving_voor_dossieroverzicht', RHSWP_CT_DOSSIER . '_' . $term->term_id );
      
      printf( '<div %s>', $classattr );
      printf( '<a href="%s"><h3>%s</h3></a>', $href, $title );
      printf( '<span class="excerpt">%s</span>', $excerpt );
      
      if ( ! empty( $termchildren ) && ! is_wp_error( $termchildren ) ) {
        echo '<ul class="children">';
        echo $termchildren;
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


