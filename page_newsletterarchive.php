<?php

/**
// * Rijkshuisstijl (Digitale Overheid) - page_newsletterarchive.php
// * ----------------------------------------------------------------------------------
// * Dit template zou een archief moeten tonen van de verzonden nieuwsbrieven
// * ----------------------------------------------------------------------------------
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 2.5.1
// * @desc.   Lijst met pagina-templates gecontroleerd en opgeschoond.
// * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */

//========================================================================================================
//* Template Name: ZZZ (NIET GEBRUIKEN) DO - Nieuwsbriefarchief


//========================================================================================================

function genesis_sample_add_body_class( $classes ) {

	$classes[] = 'newsletterarchive';
	return $classes;

}

//========================================================================================================

function wbvb_newsletter_createlink( $title = '',  $newsletter ) {
  
  $hash   = wp_hash_password( $newsletter['create_date'] );
  $url    = strtok($_SERVER["REQUEST_URI"],'?');
  
  return '<a href="' . $url . '?id=' . $newsletter['newsletter_id'] . '&amp;code=' . urlencode($hash) . '">' . $title . '</a>';
}

//========================================================================================================

function wbvb_newsletter_list_newsletters() {
  
  global $email_newsletter, $email_builder;

// php7 try / catch error

  if ( function_exists( $email_newsletter->get_newsletters() ) ) {
    
    $newsletters  = $email_newsletter->get_newsletters();
  
    if ( $newsletters ) {
      
      krsort( $newsletters );
      
      echo '<ul>';
      foreach ( $newsletters as $newsletter ) {
  
        if ( $newsletter['subject'] ) {
          echo '<li>'  . wbvb_newsletter_createlink( $newsletter['subject'], $newsletter ) . ' (' . date_i18n( get_option( 'date_format' ), $newsletter['create_date'] ) . ')</li>';
        }
        else {
          echo '<li>'  . wbvb_newsletter_createlink( __('Geen titel bekend', 'wp-rijkshuisstijl' ), $newsletter ) . ' (' . date_i18n( get_option( 'date_format' ), $newsletter['create_date'] ) . ')</li>';
        }
      }
      echo '</ul>';
    }
  }
  else {
    echo '<p>' . __( 'Het systeem kan geen nieuwsbrieven vinden voor deze pagina.', 'wp-rijkshuisstijl' ) . '</p>';
  }
}

//========================================================================================================

function wbvb_newsletter_displaysingle() {
  
  global $email_newsletter, $email_builder;
  
  $requestedID    = $_GET['id'];
  
  if ( is_numeric( $requestedID )) {
    
    $requestedCode  = urldecode($_GET['code']);
    $newsletters  = $email_newsletter->get_newsletters();
  
    if ( $newsletters ) {
      foreach ( $newsletters as $newsletter ) {
  
        if ( $requestedID == $newsletter['newsletter_id'] ) {
  
          $code   = $newsletter['create_date'];
          $check  = wp_check_password( $code, $requestedCode );
  
          if ( $check ) {
            $content    = $email_newsletter->make_email_body($requestedID, 1);
        		$content    = $email_newsletter->personalise_email_body($content, 0, 0, 0, 0, 0, $changes = array('user_name' => '{USER_NAME}', 'first_name' => '{FIRST_NAME}', 'to_email'=> '{TO_EMAIL}'));
            echo $content;
          }
          else {
            // invalid ID
            genesis();
          }
        }
      }
    }
  }
  else {
    genesis();
  }
}

//========================================================================================================


// check to see if we want to display a single newsletter or just the list of newsletters
if ( isset( $_GET['id'] ) ) { 
  if ($_GET['id'] &&  $_GET['code'] ) {
    wbvb_newsletter_displaysingle();
  }
  else {

    //* Add landing page body class to the head
    add_filter( 'body_class', 'genesis_sample_add_body_class' );
    
    add_action( 'genesis_entry_content', 'wbvb_newsletter_list_newsletters', 15 );
    
    
    //* Run the Genesis loop
    genesis();

  }
}  
else {

  //* Add landing page body class to the head
  add_filter( 'body_class', 'genesis_sample_add_body_class' );
  
  add_action( 'genesis_entry_content', 'wbvb_newsletter_list_newsletters', 15 );
  
  
  //* Run the Genesis loop
  genesis();
}

