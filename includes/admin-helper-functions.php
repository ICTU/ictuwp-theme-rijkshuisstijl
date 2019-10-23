<?php

/**
// * Rijkshuisstijl (Digitale Overheid) - admin-helper-functions.php
// * ----------------------------------------------------------------------------------
// * functies bewerkingen aan de admin-kant
// * ----------------------------------------------------------------------------------
// *
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 2.5.2
// * @desc.   Optie om uitgelichte afbeelding NIET automatisch in te voegen.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */


//========================================================================================================
// columns for dossiers taxonomy
add_filter("manage_edit-dossiers_columns", 'admin_dossiers_columns'); 
 
function admin_dossiers_columns($theme_columns) {
    $new_columns = array(
        'cb'                        => '<input type="checkbox" />',
        'name'                      => __('Dossiernaam', 'wp-rijkshuisstijl' ),
        'description'               => __('Beschrijving', 'wp-rijkshuisstijl' ),
//        'posts'                     => __('Aantal posts', 'wp-rijkshuisstijl' ),
    );
    return $new_columns;
}
 
//========================================================================================================

// Add to admin_init function   
add_filter("manage_dossiers_custom_column", 'admin_manage_theme_columns_dossiers', 10, 3);

function admin_manage_theme_columns_dossiers($out, $column_name, $theme_id) {

    global $post;
    global $column;
    
    switch ( $column_name ){


        default:
            break;
    }
    if ("ID" == $column) echo $post->ID;
    elseif ("title" == $column) echo "title : " . $post->post_content;

    
}

//========================================================================================================

if (! function_exists( 'dodebug_do' ) ) {
	
	function dodebug_do( $string, $tag = 'p' ) {
		if ( WP_DEBUG && WP_LOCAL_DEV ) {
			echo '<' . $tag . ' class="debugstring"> ' . $string . '</' . $tag . '>';
		}
	}
	
}

//========================================================================================================

if (! function_exists( 'dodebug_do4' ) ) {
	
	function dodebug_do4($file = '', $extra = '') {

echo 'dodebug_do4!: ';

		if ( WP_DEBUG && WP_LOCAL_DEV ) {
			$break = Explode('/', $file);
			$pfile = $break[count($break) - 1]; 
			
			echo '<hr><span class="debugmessage" title="' . $file . '">' . $pfile;
			if ( $extra ) {
				echo ' - ' . $extra;
			}
			echo '</span>';
		}
	}
	
}

//========================================================================================================

if (! function_exists( 'dovardump2' ) ) {
  
  function dovardump2($data, $context = '', $echo = true ) {

    if ( WP_DEBUG ) {
      $contextstring  = '';
      $startstring    = '<div class="debug-context-info">';
      $endtring       = '</div>';
      
      if ( $context ) {

        $contextstring = '<p>Vardump ' . $context . '</p>';        
      }
      
      if ( is_array( $data ) || is_object( $data ) ) {
        $theline = "array: " . print_r( $data, false );
      }
      else {
        $theline = $data;
      }
      
      error_log( $theline );
      
      if ( $echo ) {
      
        echo $startstring . '<hr>';
        echo $contextstring;        
        echo '<pre>';
        print_r($data);
        echo '</pre><hr>' . $endtring;
      }
      else {

        return '<hr>' . $contextstring . '<pre>' . print_r($data, true) . '</pre><hr>';
      }
    }        
  }        
}        
  

//========================================================================================================

if (! function_exists( 'dovardump' ) ) {
  
  function dovardump($data, $context = '', $echo = true ) {

    if ( WP_DEBUG ) {
      $contextstring  = '';
      $startstring    = '<div class="debug-context-info">';
      $endtring       = '</div>';
      
      if ( $context ) {

        $contextstring = '<p>Vardump ' . $context . '</p>';        
      }
      
      if ( is_array( $data ) || is_object( $data ) ) {
        $theline = "array: " . print_r( $data, false );
      }
      else {
        $theline = $data;
      }
      
      error_log( $theline );
      
      if ( $echo ) {
      
        echo $startstring . '<hr>';
        echo $contextstring;        
        echo '<pre>';
        print_r($data);
        echo '</pre><hr>' . $endtring;
      }
      else {

        return '<hr>' . $contextstring . '<pre>' . print_r($data, true) . '</pre><hr>';
      }
    }        
  }        
}        
  
  
//========================================================================================================

function rhswp_admin_display_wpquery_in_context() {
  global $wp_query;
  if ( $wp_query->query ) {
    dovardump($wp_query->query, 'rhswp_admin_display_wpquery_in_context');
  }
}    

//========================================================================================================

//add_action( 'wp_head', 'rhswp_admin_dump_wpquery', 4 );

function rhswp_admin_dump_wpquery() {
  global $wp_query;
  if ( $wp_query->query ) {
    dovardump($wp_query->query, 'rhswp_admin_dump_wpquery');
  }
}    

//========================================================================================================

function admin_append_editor_styles() {
  add_editor_style(RHSWP_THEMEFOLDER . '/css/editor-styles.css?v=' . CHILD_THEME_VERSION);
}

add_action( 'init', 'admin_append_editor_styles' );

//========================================================================================================

function rhswp_admin_debug_css() {
  if ( SHOW_CSS_DEBUG && WP_DEBUG ) {
    wp_enqueue_style( 'debug-css', RHSWP_THEMEFOLDER . '/css/debug-css.css', array(), CHILD_THEME_VERSION );
    wp_enqueue_style( 'header-counter-css', RHSWP_THEMEFOLDER . '/css/header.css', array(), CHILD_THEME_VERSION );
  }
}

if ( WP_DEBUG ) {
    add_action( 'wp_enqueue_scripts', 'rhswp_admin_debug_css' );
}

//========================================================================================================

add_action( 'wp_print_styles', 'rhswp_frontend_deregister_styles', 100 );

function rhswp_frontend_deregister_styles() {
    wp_dequeue_style( 'wp-block-library' );
}

//========================================================================================================

if ( SHOW_CSS_DEBUG ) {

  //* Add role to header
  add_filter('genesis_attr_site-header', 'rhswp_add_attribute_role_banner');

  function rhswp_add_attribute_role_banner($attributes) {
  	$attributes['role'] = 'banner';
  	return $attributes;
  }

  //* Add role to footer
  add_filter('genesis_attr_site-footer', 'rhswp_add_attribute_role_contentinfo');
  
  function rhswp_add_attribute_role_contentinfo($attributes) {
    $attributes['role'] = 'contentinfo';
    return $attributes;
  }
}

//========================================================================================================

add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
  .cmb2-wrap .cmb-row {
    margin: 0 !important;
    border-bottom-style: none  !important;
    padding-top: 0 !important;
  }
  .cmb2-text-url,
  .cmb2-text-url input.cmb2-text-medium{
    width: 100% !important;
  }
  </style>';
}

//========================================================================================================

function is_posts_page() {
	return ( is_home() && 'page' == get_option( 'show_on_front' ) );
}

//========================================================================================================



