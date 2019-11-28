<?php


/**
// * Rijkshuisstijl (Digitale Overheid) - taxonomy.php
// * ----------------------------------------------------------------------------------
// * Taxonomie-pagina voor tip-thema's
// * ----------------------------------------------------------------------------------
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 2.12.1
// * @desc.   Homepage nu vanuit template file (page_front-page.php).
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */

//========================================================================================================

// Reposition the primary navigation menu
if ( ( is_front_page() ) || ( is_home() ) ) {
	// only show menu if this is really the home page
}
else {

	remove_action( 'genesis_after_header', 'genesis_do_nav' );

}

//========================================================================================================


//Removes Title and Description on CPT Archive
remove_action( 'genesis_before_loop', 'genesis_do_cpt_archive_title_description' );

//Removes Title and Description on Blog Archive
remove_action( 'genesis_before_loop', 'genesis_do_posts_page_heading' );

//Removes Title and Description on Date Archive
remove_action( 'genesis_before_loop', 'genesis_do_date_archive_title' );

//Removes Title and Description on Archive, Taxonomy, Category, Tag
remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );

// add description
add_action( 'genesis_before_loop', 'rhswp_add_taxonomy_description', 15 );

if ( rhswp_extra_contentblokken_checker() ) {

  // replace default loop with extra blocks
  remove_action( 'genesis_loop', 'genesis_do_loop' );
  add_action( 'genesis_before_loop', 'rhswp_write_extra_contentblokken', 16 );
  
}
else {

  add_action( 'genesis_before_loop', 'rhswp_write_contentblok_waarschuwing', 16 );

  /** Replace the standard loop with our custom loop */
  remove_action( 'genesis_loop', 'genesis_do_loop' );
  add_action( 'genesis_loop', 'rhswp_archive_custom_loop' );
  
  // post navigation verplaatsen tot buiten de flex-ruimte
  add_action( 'genesis_after_loop', 'genesis_posts_nav', 3 );

}

//========================================================================================================

genesis();

//========================================================================================================

function rhswp_write_contentblok_waarschuwing() {

  if ( taxonomy_exists( RHSWP_CT_DOSSIER ) && is_tax( RHSWP_CT_DOSSIER ) ) {
    
    $user = wp_get_current_user();
    if ( in_array( 'manage_categories', (array) $user->allcaps ) ) {
  
      //The user has capability to manage categories
      $queried_object = get_queried_object();
      $edit_link = esc_url( get_edit_term_link( $queried_object->term_id ) );    
  
      echo '</p><div style="border: 1px solid black; padding: .1em 1em; margin-bottom: 2em;"><h2>' . __( 'Note to the editor', 'wp-rijkshuisstijl' ) . 
      '</h2><p>' . __( 'Dit is een ongefilterde weergaven van alle content, aflopend gesoorteerd op de laatste toevoegingsdatum. Het verdient aanbeveling om hiervoor contentblokken te gebruiken. Deze worden getoond in plaats van deze lijst.', 'wp-rijkshuisstijl' ) . '.</a>';
      echo '<br><a href="' . $edit_link . '">' . __( 'Voeg contentblokken toe om deze pagina te structureren', 'wp-rijkshuisstijl' ) . '.</a>';
      echo '<br><em>' . __( 'Deze tekst wordt alleen getoond aan redacteuren die taxonomieën mogen wijzigen.', 'wp-rijkshuisstijl' ) . '</em></div>';
  
    }  
  }    
}    

