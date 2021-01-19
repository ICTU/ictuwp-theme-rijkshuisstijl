<?php

/**
// * Rijkshuisstijl (Digitale Overheid) - page_show-child-pages.php
// * ----------------------------------------------------------------------------------
// * Toont onderliggende pagina's
// * ----------------------------------------------------------------------------------
// *
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 2.12.2
// * @desc.   Kortere check op uitschrijven nav.bar op home.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
// 
 */


//* Template Name: DO - Toon onderliggende pagina's

//========================================================================================================

add_action( 'genesis_entry_content', 'rhswp_get_page_childpages', 15 );

if ( rhswp_extra_contentblokken_checker() ) {
  add_action( 'genesis_entry_content', 'rhswp_write_extra_contentblokken', 14 );
}

//========================================================================================================

// Ter vervanging van de vervallen widget-ruimte en de 'extra links'-widget daarin
add_action( 'genesis_entry_content', 'rhswp_pagelinks_replace_widget', 14 );

//========================================================================================================

genesis();

//========================================================================================================

function rhswp_get_page_childpages() {


  global $post;

  $currentpostID    = $post->ID;
  $pagetemplateslug = basename( get_page_template_slug( $currentpostID ) );
  $args = array( 
        'child_of'      => $currentpostID, 
        'parent'        => $currentpostID,
        'hierarchical'  => 0,
        'sort_column'   => 'menu_order', 
        'sort_order'    => 'asc'
  );
  $mypages = get_pages( $args );

  if ( $mypages ) {
    
    $postcounter = 0;
    
    echo '<h2 class="visuallyhidden">' . _x( 'See also these pages:', 'show child pages', 'wp-rijkshuisstijl' ) . '</h2>';
    echo '<div class="block no-top">';

    foreach( $mypages as $postx ) {

      $postcounter++;
  
      $image      = get_the_post_thumbnail( $postx->ID, 'featured-post-widget' );
      $classattr  = '';

      if ( $image ) {
        $classattr  = ' class="with-image"';
      }
      
      if (  has_excerpt( $postx->ID ) ) {
        $text       = get_the_excerpt( $postx->ID );
      } 
      else {
        $thecontent = wp_strip_all_tags( get_post_field('post_content', $postx->ID ) );
        $text       = get_words( $thecontent, get_option( 'excerpt_length' ) );   
      } 
      
      if ( !$text ) {

        $user = wp_get_current_user();
        if ( in_array( 'edit_pages', (array) $user->allcaps ) ) {
          //The user has capability to edit pages
          $text = '<div style="border: 1px solid black; padding: .1em 1em; margin-bottom: 2em;">';
          $text .=  _x( 'Eh, dit is een pagina zonder tekst', 'Standaardtekst als pagina geen tekst heeft.', 'wp-rijkshuisstijl' );
          $text .= '</div>';

        }
      }
      
      if ( $text ) {
        $text = '<p>' . $text . '</p>';
      }
  
      printf( '<article %s>', $classattr );

      if ( $image ) {
        printf( '<div class="article-container"><div class="article-visual">%s</div>', $image );
        printf( '<div class="article-excerpt"><a href="%s"><h2>%s</h2>%s</a></div></div>', get_permalink( $postx->ID ), get_the_title( $postx->ID ), $text );
      }
      else {
        printf( '<a href="%s"><h3>%s</h3><p>%s</p></a>', get_permalink( $postx->ID ), get_the_title( $postx->ID ), $text );
      }
      echo '</article>';
      
    }

    echo '</div>';
    
  }

}


//========================================================================================================


