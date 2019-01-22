<?php

/**
// wp-rijkshuisstijl - home.php
// ----------------------------------------------------------------------------------
// speciale functionaliteit voor de homepage
// ----------------------------------------------------------------------------------
// 
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 2.2.3
// * @desc.   Meer strings vertaald, bugfiks voor homepage. Uitlijning reactieform op vollebreedtepagina's.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
// 
 */

//* Template Name: 20 - home-pagina 

//* Force full-width-content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );


remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );

if ( is_home() || is_front_page() ) {

  // only show menu if this is really the home page
  add_action( 'genesis_after_header', 'genesis_do_nav', 14 );

}

  // dossiers (onderwerpen) + widget ruimte
  add_action( 'genesis_loop', 'rhswp_home_onderwerpen_dossiers', 12 );

  // nieuws
  add_action( 'genesis_loop', 'rhswp_write_extra_contentblokken', 14 );
  
    
  add_filter('the_content', 'rhswp_home_content_filter');
  


//========================================================================================================

function rhswp_home_content_filter( $content ) {

	if( is_singular() && is_main_query() && $content ) {

    $content = wp_strip_all_tags( $content );

	}	
	
	return $content;
	
}


//========================================================================================================

function rhswp_home_onderwerpen_dossiers() {

  $maxnr = 4;
  $rowcounter = 0;
  $breedte = 'vollebreedte';
  
  if ( is_active_sidebar( RHSWP_HOME_WIDGET_AREA ) ) {

    $maxnr = 3;
    $breedte = 'driekwart';

  }



  echo '<section class="onderwerpen">';
  echo '<div class="wrap">';

  if ( ! taxonomy_exists( RHSWP_CT_DOSSIER ) ) {
    echo __( "'Dossiers' taxonomy does not exist. Please activate the plugin 'ICTU / WP Register post types and taxonomies'", 'wp-rijkshuisstijl' );
  }

  if ( taxonomy_exists( RHSWP_CT_DOSSIER ) ) {
      
    if( have_rows( 'home_onderwerpen_dossiers' ) ) {
  
      echo '<div class="row ' . $breedte . '">';
  
      while( have_rows( 'home_onderwerpen_dossiers') ): the_row(); 
      
        $rowcounter++;
  
        $url_extern   = get_sub_field('kies_een_onderwerp');
        $description  = '';

        if ( $url_extern ) {
            
          $acfid        = RHSWP_CT_DOSSIER . '_' . $url_extern->term_id;
          $kortebeschr  = get_field( 'dossier_korte_beschrijving_voor_dossieroverzicht', $acfid );
          $description  = $url_extern->description;
        
        }

  
        if ( 'standaardbeschrijving' != get_sub_field( 'welke_beschrijving' ) ) {
          $description = get_sub_field( 'andere_beschrijving' );
        }
        elseif ( $kortebeschr ) {
          $description = $kortebeschr;
        }
  
  // to do
  
  //WOEHOE!! Waar isme dinges?      
        
  
        $name = 'naam';
        $url  = '';
        if ( $url_extern ) {
          $name = $url_extern->name;
          $url  = get_term_link( $url_extern->term_id );
        }
      
        echo '<a href="' . $url . '" class="linkblock"><h3>' .  $name . '</h3><p>' .  wp_strip_all_tags( $description ) . '</p></a>';
  
      endwhile; 
  
      echo '</div>';

    }
    
  }
  
  if ( is_active_sidebar( RHSWP_HOME_WIDGET_AREA ) ) {

    dynamic_sidebar( RHSWP_HOME_WIDGET_AREA );

  }

  echo '</div>'; // .wrap
  echo '</section>';
      
}

//========================================================================================================

genesis();

