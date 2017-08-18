<?php

/**
 * Rijkshuisstijl (Digitale Overheid) - functions.php
 * ----------------------------------------------------------------------------------
 * Zonder functions geen functionaliteit, he?
 * ----------------------------------------------------------------------------------
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.10.3
 * @desc.   Icon voor PDF document op zoekresultaten toegevoegd.
 * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */

//========================================================================================================

// Start Genesis engine
include_once( get_template_directory() . '/lib/init.php' );

//========================================================================================================

// Constants
define( 'CHILD_THEME_NAME',                 "Rijkshuisstijl (Digitale Overheid)" );
define( 'CHILD_THEME_URL',                  "https://wbvb.nl/themes/wp-rijkshuisstijl" );
define( 'CHILD_THEME_VERSION',              "0.10.3" );
define( 'CHILD_THEME_VERSION_DESCRIPTION',  "Icon voor PDF document op zoekresultaten toegevoegd." );
define( 'SHOW_CSS_DEBUG',                   false );

if ( SHOW_CSS_DEBUG && WP_DEBUG ) {
  define( 'DO_MINIFY_JS',                   false );
}
else {
  define( 'DO_MINIFY_JS',                   true );
}

define( 'ID_ZOEKEN',                        'rhswp-searchform-nav-primary' );
define( 'GC_TWITTERACCOUNT',                'digioverheid' );
define( 'SOC_MED_NO',                       'socmed_nee' );
define( 'SOC_MED_YES',                      'socmed_ja' );

$siteURL      =  get_stylesheet_directory_uri();
$siteURL      =  preg_replace('|https://|i', '//', $siteURL );
$siteURL      =  preg_replace('|http://|i', '//', $siteURL );
define( 'RHSWP_THEMEFOLDER',                 $siteURL );

$sharedfolder = get_stylesheet_directory();
$sharedfolder = preg_replace('|genesis|i','wp-rijkshuisstijl',$sharedfolder);
define( 'RHSWP_FOLDER',                      $sharedfolder );

define( 'RHSWP_LINK_CPT',                   'links' );
define( 'CTAX_contentsoort',                'contentsoort' );
define( 'CTAX_thema',                       'CTAX_thema' );
define( 'RHSWP_HOME_WIDGET_AREA',           'home-widget-area' );
define( 'RHSWP_PREFIX_TAG_CAT',             'rhswp_dossier_select_tag_category');
define( 'RHSWP_CMB2_TAG_FIELD',             'select_tag');
define( 'RHSWP_CMB2_TXT_FIELD',             'select_txt');

if ( ! defined( 'RHSWP_CT_DOSSIER' ) ) {
  define( 'RHSWP_CT_DOSSIER',               'dossiers' );   // slug for custom taxonomy 'dossier'
}
if ( ! defined( 'RHSWP_CPT_DOCUMENT' ) ) {
  define( 'RHSWP_CPT_DOCUMENT',             'document' );   // slug for custom taxonomy 'document'
}
if ( ! defined( 'RHSWP_CPT_EVENT' ) ) {
  define( 'RHSWP_CPT_EVENT',                'event' );      // slug for custom taxonomy 'document'
}
if ( ! defined( 'RHSWP_CPT_SLIDER' ) ) {
  define( 'RHSWP_CPT_SLIDER',               'slidertje' );  // slug for custom taxonomy 'dossier'
}


define( 'RHSWP_WIDGET_BANNER',              '(DO) banner widget');
define( 'RHSWP_WIDGET_PAGELINKS_DESC',      '(DO) paginalinks widget');
define( 'RHSWP_WIDGET_PAGELINKS_ID',        'rhswp_pagelinks_widget');
define( 'RHSWP_WIDGET_LINK_TO_SINGLE_PAGE', '(DO) verwijs naar een pagina');

define( 'RHSWP_CSS_BANNER',                 'banner-css' ); // slug for custom post type 'document'

define( 'RHSWP_PAGE_SEPARATOR',             'paginaatje' );
define( 'RHSWP_DOSSIERPOSTCONTEXT',         'dossierpostcontext' );
define( 'RHSWP_DOSSIEREVENTCONTEXT',        'dossiereventcontext' );
define( 'RHSWP_DOSSIERDOCUMENTCONTEXT',     'dossierdocumentcontext' );
define( 'RHSWP_DOSSIERPOSTCONTEXT_OPTION',  RHSWP_DOSSIERPOSTCONTEXT . CHILD_THEME_VERSION );

define( 'RHSWP_NR_FEAT_IMAGES',             2 ); // max number of posts with featured images on archive pages
define( 'RHSWP_ARCHIVE_CSS',                'featured-images' );




//========================================================================================================

add_image_size( 'Carrousel (preview: 400px wide)', 400, 200, false );
add_image_size( 'Carrousel (full width: 1200px wide)', 1200, 400, false );
add_image_size( 'featured-post-widget', 400, 250, false );
add_image_size( 'grid-half', 350, 350, true );
add_image_size( 'article-visual', 400, 400, true );
add_image_size( 'widget-image', 100, 100, false );
add_image_size( 'widget-image-top', 400, 1200, false );
add_image_size( 'nieuwsbriefthumb', 88, 88, false );

//========================================================================================================

//* Add new image sizes to post or page editor
add_filter( 'image_size_names_choose', 'rhswp_add_imagesize_to_editor' );

function rhswp_add_imagesize_to_editor( $sizes ) {

    $mythemesizes = array(
        'nieuwsbriefthumb' 		=> __( 'Nieuwsbrief-grootte' ), 
    );
    $sizes = array_merge( $sizes, $mythemesizes );

    return $sizes;
}

//========================================================================================================

// Include for javascript check
include_once( RHSWP_FOLDER . '/includes/nojs.php' );

// Include for CMB2 extra fields
include_once( RHSWP_FOLDER . '/includes/metadata-boxes.php' );

// Include for admin functions
include_once( RHSWP_FOLDER . '/includes/admin-helper-functions.php' );

// Include for dossier functions
include_once( RHSWP_FOLDER . '/includes/dossier-helper-functions.php' );

// Include for contact form 7 validation
include_once( RHSWP_FOLDER . '/includes/contact-form7-validation.php' );

// Include for contact form 7 validation
include_once( RHSWP_FOLDER . '/includes/event-manager-functions.php' );

// Include for contact form 7 validation
include_once( RHSWP_FOLDER . '/includes/search-helper-functions.php' );

// Skiplinks
include_once( RHSWP_FOLDER . '/includes/skip-links.php' );

//========================================================================================================

// Include to alter the dossier taxonomy on pages: use radiobuttons instead of checkboxes.
include_once( RHSWP_FOLDER . '/includes/class.taxonomy-single-term.php' );
$custom_tax_mb = new Taxonomy_Single_Term( RHSWP_CT_DOSSIER, array( 'page' ) );

// Custom title for this metabox
$custom_tax_mb->set( 'metabox_title', __( 'Dossiers', 'wp-rijkshuisstijl' ) );

// Will keep radio elements from indenting for child-terms.
$custom_tax_mb->set( 'indented', false );

// Allows adding of new terms from the metabox
$custom_tax_mb->set( 'allow_new_terms', true );

// Priority of the metabox placement.
$custom_tax_mb->set( 'priority', 'low' );

//========================================================================================================

// does our beloved visitor allow for JavaScript?
$genesis_js_no_js = new Genesis_Js_No_Js;
$genesis_js_no_js->run();

//========================================================================================================

// Display author box on single posts
add_filter( 'get_the_author_genesis_author_box_single', '__return_false' );

// Add the author box on archive pages
add_filter( 'get_the_author_genesis_author_box_archive', '__return_false' );

//========================================================================================================

// Include for ACF custom fields and custom post types
include_once( RHSWP_FOLDER . '/includes/cpt-acf.php' );

//========================================================================================================

//* Remove inpost layouts
remove_theme_support( 'genesis-inpost-layouts' );

//* Remove Genesis in-post SEO Settings
remove_action( 'admin_menu', 'genesis_add_inpost_seo_box' );

//* Remove content/sidebar layout
//genesis_unregister_layout( 'content-sidebar' );
 
//* Remove sidebar/content layout
genesis_unregister_layout( 'sidebar-content' );
 
//* Remove content/sidebar/sidebar layout
genesis_unregister_layout( 'content-sidebar-sidebar' );
 
//* Remove sidebar/sidebar/content layout
genesis_unregister_layout( 'sidebar-sidebar-content' );
 
//* Remove sidebar/content/sidebar layout
genesis_unregister_layout( 'sidebar-content-sidebar' );
 
//* Remove full-width content layout
//genesis_unregister_layout( 'full-width-content' );

//========================================================================================================

// voor de widgets
require_once( RHSWP_FOLDER . '/includes/widget-home.php' );
require_once( RHSWP_FOLDER . '/includes/widget-banner.php' );
require_once( RHSWP_FOLDER . '/includes/widget-newswidget.php' );
require_once( RHSWP_FOLDER . '/includes/widget-paginalinks.php' );
require_once( RHSWP_FOLDER . '/includes/widget-subpages.php' );
require_once( RHSWP_FOLDER . '/includes/widget-events.php' );

// Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

// haal de footer widgets weg uit een aparte ruimte VOOR de footer
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );

// Customize the entire footer
remove_action( 'genesis_footer', 'genesis_do_footer' );

// zet de footerwidgets IN de footer
add_action( 'genesis_before_footer', 'rhswp_add_payoff' );
add_action( 'genesis_footer', 'rhswp_footer_widget_area' );
add_action( 'genesis_footer', 'genesis_footer_widget_areas' );

// voor de actueel-pagina, voeg een titel toe
add_action( 'genesis_loop', 'rhswp_add_title_to_blog_page', 1 );

//========================================================================================================

// ** Prevent Genesis Accessible from hooking

remove_action ( 'genesis_before_header', 'genwpacc_skip_links' );

//========================================================================================================

// add tag support to pages
add_action('init', 'rhswp_page_tag_support');

function rhswp_page_tag_support() {
  register_taxonomy_for_object_type('post_tag', 'page');
}

//========================================================================================================

// ensure all tags are included in queries
add_action('pre_get_posts', 'rhswp_page_tag_support_query');

function rhswp_page_tag_support_query($wp_query) {
  if ($wp_query->get('tag')) $wp_query->set('post_type', 'any');
}

//========================================================================================================

function rhswp_add_title_to_blog_page() {
  
  if ( is_home() && 'page' == get_option( 'show_on_front' ) ) {

    global $wp_query;

    $actueelpageid    = get_option( 'page_for_posts' );
    $actueelpagetitle = rhswp_filter_alternative_title( $actueelpageid, get_the_title( $actueelpageid ) );
    $paging           = ''; 
    $aantalpaginas    = $wp_query->max_num_pages;
    $paged            = ( get_query_var('paged') ) ? get_query_var('paged') : 1;


    if ( $paged > 1 ) {
      $paging = ' Pagina ' . $paged . ' van ' . $aantalpaginas . '.';
    }
    
    echo '<header class="entry-header"><h1 class="entry-title" itemprop="headline">' . $actueelpagetitle  . '</h1> </header>';
    echo '<p>' . _x( 'Alle berichten rondom de digitale overheid.', 'Tekst op de actueelpagina', 'wp-rijkshuisstijl' ) . $paging . '</p>';

    /** Replace the standard loop with our custom loop */
    remove_action( 'genesis_loop', 'genesis_do_loop' );
    add_action( 'genesis_loop', 'rhswp_archive_custom_loop' );
    
    // post navigation verplaatsen tot buiten de flex-ruimte
    add_action( 'genesis_after_loop', 'genesis_posts_nav', 3 );
    

  }
  
}

//========================================================================================================

add_action( 'init', 'rhswp_add_excerpts_to_pages' );

function rhswp_add_excerpts_to_pages() {
  add_post_type_support( 'page', 'excerpt' );
}

// Add Read More Link to Excerpts
add_filter( 'excerpt_more',               'rhswp_get_read_more_link');
add_filter( 'the_content_more_link',      'rhswp_get_read_more_link' );
//add_filter( 'the_content_more_link',      'wpm_get_read_more_link');
add_filter( 'get_the_content_more_link',  'rhswp_get_read_more_link'); // Genesis Framework only
add_filter( 'excerpt_more',               'rhswp_get_read_more_link');

function rhswp_get_read_more_link( $thepermalink ) {

  if ( ! is_archive() ) {
    return;
  }
  
  if (!$thepermalink) {
    $thepermalink = get_permalink();
  }
  if ( $thepermalink == ' […]' ) {
    $thepermalink = get_permalink();
  }
  $thepermalink   = get_permalink();
  $postpagetitle  = get_the_title();
  
  if ( $postpagetitle ) {
    $postpagetitle = '<span class="screen-reader-text"> ' . _x( 'over', 'verbindt de readmore met de titel', 'wp-rijkshuisstijl' ) . " '" . $postpagetitle . "'</span>";
  }
   return ' <a href="' . $thepermalink . '" tabindex="-1">' . _x( 'Lees verder', 'Standaard linktekst voor lees-meer', 'wp-rijkshuisstijl' ) . $postpagetitle . '</a>';
}

//========================================================================================================

// Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );

//========================================================================================================

// breadcrumb 
// Reposition the breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

// Remove the site title
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );

// Remove the site title
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

add_action( 'genesis_after_header', 'rhswp_site_description',       10 );
add_action( 'genesis_after_header', 'rhswp_site_description',       10 );
add_action( 'genesis_after_header', 'rhswp_menu_container_start',   12 );
add_action( 'genesis_after_header', 'genesis_do_nav',               14 );
add_action( 'genesis_after_header', 'rhswp_menu_container_end',     16 );
add_action( 'genesis_after_header', 'genesis_do_breadcrumbs',       18 );
add_action( 'genesis_after_header', 'rhswp_dossier_title_checker',  20 );
add_action( 'genesis_after_header', 'rhswp_caroussel_checker',      22 );

//========================================================================================================

// thumbnails even for pages
add_theme_support( 'post-thumbnails' );

// Add HTML5 markup structure
add_theme_support( 'html5' );

// Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//========================================================================================================

// prepare for translation
load_child_theme_textdomain('wp-rijkshuisstijl', RHSWP_FOLDER . '/languages' );

//========================================================================================================

// append search box to navigation menu
add_filter( 'wp_nav_menu_items', 'rhswp_append_search_box_to_menu', 10, 2 );

/**
 * Filter menu items, appending either a search form or today's date.
 *
 * @param string   $menu HTML string of list items.
 * @param stdClass $args Menu arguments.
 *
 * @return string Amended HTML string of list items.
 */

function rhswp_append_search_box_to_menu( $menu, $args ) {
	//* Change 'primary' to 'secondary' to add extras to the secondary navigation menu
	if ( is_search() ) {
		return $menu;
	}
	if ( is_404() ) {
		return $menu;
	}
	
	if ( 'primary' !== $args->theme_location )
		return $menu;
	//* Uncomment this block to add a search form to the navigation menu
	ob_start();
	get_search_form();
	$search = ob_get_clean();
	$menu  .= '<li class="right search">' . $search . '</li>';
	return $menu;
}

//========================================================================================================

add_filter( 'genesis_single_crumb',   'rhswp_breadcrumb_add_newspage', 10, 2 );
add_filter( 'genesis_page_crumb',     'rhswp_breadcrumb_add_newspage', 10, 2 );
add_filter( 'genesis_archive_crumb',  'rhswp_breadcrumb_add_newspage', 10, 2 );

function rhswp_breadcrumb_add_newspage( $crumb, $args ) {

  $span_before_start  = '<span class="breadcrumb-link-wrap" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';  
  $span_between_start = '<span itemprop="name">';  
  $span_before_end    = '</span>';  
  $loop     = rhswp_get_context_info();
  
	if ( ( is_singular( 'post' ) && ( ! get_query_var( RHSWP_DOSSIERPOSTCONTEXT ) ) ) || is_date() || is_category() ) {

    $actueelpageid    = get_option( 'page_for_posts' );
    $actueelpagetitle = rhswp_filter_alternative_title( $actueelpageid, get_the_title( $actueelpageid ) );

  	
  	if ( $actueelpageid ) {
  		return '<a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">' . $actueelpagetitle .'</a>' . $args['sep'] . ' ' . $crumb;
  	}
  	else {
  		return $crumb;
  	}
	}
	else {
  	
    $terms = get_the_terms( get_the_ID(), RHSWP_CT_DOSSIER );

    if ( $terms && ! is_wp_error( $terms ) ) {

      if ( is_singular( 'page' ) ) {

  
        $term = array_values( $terms )[0]; 
        $needle = '';
        
        if ( function_exists( 'get_field' ) ) {
          if( get_field('dossier_overzichtspagina', 'option') ) {
          
            $dossier_overzichtspagina       = get_field('dossier_overzichtspagina', 'option');
            $dossier_overzichtspagina_id    = $dossier_overzichtspagina->ID;
            
            $dossier_overzichtspagina_start = $span_before_start . '<a href="' . get_permalink( $dossier_overzichtspagina_id ) . '" itemprop="item">' . $span_between_start;
            $dossier_overzichtspagina_end   = $span_before_end . '</a>' . $span_before_end;
            $needle = $dossier_overzichtspagina_start . get_the_title( $dossier_overzichtspagina_id ) . $dossier_overzichtspagina_end  . $args['sep'];
          
          }
          else {
          }
        }
        
        $replacer = $needle . $span_before_start . '<a href="' . get_term_link( $term ) . '">' . $term->name .'</a>' . $span_before_end . $args['sep'];
        $crumb = str_replace( $needle, $replacer, $crumb);
        
    		return $crumb;
        
      }
      else {

        if ( get_query_var( RHSWP_DOSSIERPOSTCONTEXT ) ) {
          
          // het is een bericht / event / whatever in een dossiercontext

          // de ID achterhalen van de pagina vanwaar dit bericht / event / whatever gelinkt werd
          $urlofparentpage  = get_query_var( RHSWP_DOSSIERPOSTCONTEXT ); 
          $parentpageid     = url_to_postid( $urlofparentpage );

          // in deze array zit als laatste element de titel van de huidige post / event / whatever
          $titlearray = explode( $args['sep'], $crumb );

          // haal de ancestors op voor de huidige pagina
          $ancestors = get_post_ancestors( $parentpageid );

          $returnstring = '';
          // haal de hele keten aan ancestors op en zet ze in de returnstring
          foreach ( $ancestors as $ancestorid ) {
            $returnstring = $span_before_start . '<a href="' . get_permalink( $ancestorid ) . '">' . get_the_title( $ancestorid ) .'</a>' . $span_before_end . $args['sep'] . $returnstring;
          }

          $returnstring .= $span_before_start . '<a href="' . get_permalink( $parentpageid ) . '">' . get_the_title( $parentpageid ) .'</a>' . $span_before_end . $args['sep'] . array_pop($titlearray);

      		return $returnstring;
    
        }
      }
    }

		return $crumb;
	}
}

//========================================================================================================

// Modify breadcrumb arguments.
add_filter( 'genesis_breadcrumb_args', 'rhswp_breadcrumb_args' );

function rhswp_breadcrumb_args( $args ) {
    global $wp_query;
    $separator = __( '<span class="separator">&gt;</span>', 'wp-rijkshuisstijl' );
    
    $args['home']                       = __( "Home", 'wp-rijkshuisstijl' );
    $args['sep']                        = $separator ;
    $args['list_sep']                   = ', ';
    $args['prefix']                     = '<div class="breadcrumb"><div class="wrap"><nav class="breadlist">';
    $args['suffix']                     = '</nav></div></div>';
    $args['heirarchial_attachments']    = true;
    $args['heirarchial_categories']     = true;
    $args['display']                    = true;
    $args['labels']['prefix']           = '';
    $args['labels']['author']           = __( "Auteurs", 'wp-rijkshuisstijl' ) . $separator;
    $args['labels']['category']         = '';
    $args['labels']['date']             = '';

    $args['labels']['tag']              = __( "Tags", 'wp-rijkshuisstijl' ) . $separator;
    $args['labels']['search']           = __( "Zoekresultaat voor ", 'wp-rijkshuisstijl' );
    $args['labels']['tax']              = '';
    
    if ( isset( $wp_query->query_vars['taxonomy'] ) ) {
        
        $tax = $wp_query->query_vars['taxonomy'];
        
        if ( $tax == CTAX_contentsoort ) {
            $args['labels']['tax'] = '<a href="/' . CTAX_contentsoort . '/">' . __( 'Contentsoort', 'wp-rijkshuisstijl' ) . '</a>' . $separator;
        }
        elseif ( $tax == RHSWP_CT_DOSSIER ) {
          if( get_field('dossier_overzichtspagina', 'option') ) {
            
            $dossier_overzichtspagina     = get_field('dossier_overzichtspagina', 'option');
            $dossier_overzichtspagina_id  = $dossier_overzichtspagina->ID;
            
            $auteursoverzichtpagina_start = '<a href="' . get_permalink( $dossier_overzichtspagina_id ) . '">' ;
            $auteursoverzichtpagina_end   = '</a>';

            $actueelpagetitle = get_the_title( $dossier_overzichtspagina_id );
            $tax = '';
            $args['labels']['tax'] = $auteursoverzichtpagina_start . $actueelpagetitle . $auteursoverzichtpagina_end . $separator;
            
          }
          else {
            $args['labels']['tax'] =  $separator;
          }
        }
        elseif ( $tax == CTAX_thema ) {
          $tax = '';
          $args['labels']['tax'] = '<a href="/' . CTAX_thema . '/">' . __( 'Onderwerpen', 'wp-rijkshuisstijl' ) . '</a>' . $separator;
        }
        else {
          $args['labels']['tax'] = '<a href="/' . $tax . '/">' . $tax . '</a>' . $args['sep'] ;
        }
    }
    
    
    $args['labels']['post_type']        = '';
    $args['labels']['404']              = __( "404 - Pagina niet gevonden", 'wp-rijkshuisstijl' );
    return $args;
    
}

//========================================================================================================

// js filter functie

function rhswp_add_defer_to_javascripts( $url )
{
    if ( // comment the following line out add 'defer' to all scripts

//    FALSE === strpos( $url, 'contact-form-7' ) or
    FALSE === strpos( $url, '.js' )
    )
    { // not our file
        return $url;
    }
    // Must be a ', not "!
    return "$url' defer='defer";
}
//add_filter( 'clean_url', 'rhswp_add_defer_to_javascripts', 11, 1 );

//========================================================================================================

function rhswp_add_taxonomy_description() {
    global $wp_query;
    

    if ( ! is_category() && ! is_tag() && ! is_tax() )
        return;

    $prefix = '';

    if ( is_tag() ) {
      $prefix = __( "Tag", 'wp-rijkshuisstijl' ) . ': ';  
    }

    $term = is_tax() ? get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ) : $wp_query->get_queried_object();
    if ( ! $term || ! isset( $term->meta ) )
        return;
        
    $headline   = '';
    $intro_text = '';

    $tax = $wp_query->query_vars['taxonomy'];
    
    if ( $tax == RHSWP_CT_DOSSIER ) {
    
    }
    else {
      if ( $term->name ) {
          $headline = sprintf( '<h1 class="archive-title">%s</h1>', $prefix . strip_tags( strval( $term->name ) ) );
      }
      if ( isset( $term->meta['headline'] ) && $term->meta['headline'] ) {

          if ( 'Array' !== $term->meta['headline'] ) {
            $headline = sprintf( '<h1 class="archive-title">%s</h1>', $prefix . strip_tags( strval( $term->meta['headline'] ) ) );
          }
        
      }
    }

    if ( isset( $term->meta['intro_text'] ) && $term->meta['intro_text'] ) {
        $intro_text = apply_filters( 'genesis_term_intro_text_output', $term->meta['intro_text'] );
    }
        
    if ( $term->description ) {
        $intro_text = apply_filters( 'genesis_term_intro_text_output', $term->description );
    }

    if ( $headline || $intro_text ) {
        printf( '<div class="taxonomy-description">%s</div>', $headline . $intro_text );
    }
    else {
        return;
    }
}

//========================================================================================================

function get_words($sentence, $count = 10) {
  preg_match("/(?:\w+(?:\W+|$)){0,$count}/", $sentence, $matches);
  return $matches[0];
}

//========================================================================================================

add_filter( 'excerpt_length', 'rhswp_custom_excerpt_length', 999 );

// Filter except length to 35 words.
// tn custom excerpt length

function rhswp_custom_excerpt_length( $length ) {
  $length = 35;
  if ( get_option( 'excerpt_length' ) !== false ) {
    // The option already exists, so we just update it.
    update_option( 'excerpt_length', $length );
  }
  else {
    // The option hasn't been added yet. We'll add it
    add_option( 'excerpt_length', $length );
  }
  wp_cache_delete ( 'alloptions', 'options' );
  return $length;
}

//========================================================================================================

// Customize the entry meta in the entry header (requires HTML5 theme support)
add_filter( 'genesis_post_info', 'rhswp_correct_postinfo' ); 

function rhswp_correct_postinfo($post_info) {
    global $wp_query;
    global $post;
    if ( 
        ( 'page'    == get_post_type() ) ||
        ( 'post'    == get_post_type() ) ) {
        
        if ( function_exists( 'get_field' ) ) {
            $deelknoppen_boven    = get_field('deelknoppen_boven', $post->ID );
            $deelknoppen_onder    = get_field('deelknoppen_onder', $post->ID );
        }
        if ( has_post_format( 'link' ) ) {
            return '';
        }
        else {
            return '[post_date]';
        }
    }
    return '';
    
}

//========================================================================================================

//* Remove the entry meta in the entry footer
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );


//========================================================================================================

// action for writing extra info in the alt-sidebar
add_action( 'rhswp_primary_sidebar_first_action', 'rhswp_sidebar_context_widgets' );

function rhswp_sidebar_context_taxonomies() {

    global $post;
  
    $terms        = get_the_terms( $post->ID , RHSWP_CT_DOSSIER );

    if ( $terms && ! is_wp_error( $terms ) ) { 

      if( get_field('dossier_overzichtspagina', 'option') ) {
      
        $dossier_overzichtspagina       = get_field('dossier_overzichtspagina', 'option');
        $dossier_overzichtspagina_id    = $dossier_overzichtspagina->ID;

        $obj = get_taxonomy( RHSWP_CT_DOSSIER );

        echo '<h4>' . $obj->labels->name . '</h4>';
      }
      else {
        dodebug('geen overzichtspagina gevonden');
      }

      echo '<ul>';
      foreach ( $terms as $term ) {
        echo '<li><a href="' . get_term_link( $term->term_id ) . '">' . $term->name . '</a></li>';
      }
      echo '</ul>';
      echo '<a href="' . get_permalink( $dossier_overzichtspagina_id ) . '" itemprop="item">' . get_the_title( $dossier_overzichtspagina_id ) . '</a>';

    }

    $terms        = get_the_terms( $post->ID , 'category' );

    if ( $terms && ! is_wp_error( $terms ) ) { 

        foreach ( $terms as $term ) {
          echo '<br><a href="' . get_term_link( $term->term_id ) . '"><strong>Categorie: ' . $term->name . '</strong></a>';
        }
    }

}

//========================================================================================================

function rhswp_sidebar_context_widgets() {

  if ( WP_DEBUG ) {

    global $post;

    rhswp_admin_display_wpquery_in_context();

    $context  = rhswp_get_context_info();
    $posttype = get_post_type();

    echo '<div id="debug_context_info" class="widget context-info">
    <div class="widget-wrap">
    <h3 class="widgettitle">Context debug info</h3>
    <div class="menu-footer-quicklinks-container">';

    echo '<p>paginatype: ' . $context;

    if ( $posttype ) {
      
      if ( 'page' == $context ) {

        $parentID     = wp_get_post_parent_id( $post->ID );
        $parent       = get_post( $parentID );
        
        echo '<br>posttype: <strong>' . $posttype . '</strong>';
        echo '<br>template: <strong>' . basename( get_page_template() ) . '</strong>';
        if ( $parent && ( $parent->ID !== $post->ID ) ) {
          echo '<br>parent: <a href="' . get_permalink( $parent->ID ) . '"><strong>' . get_the_title( $parent->ID ) . '</strong></a>';
        }
        else {
          echo '<br>Pagina heeft geen parent';
        }
        echo '</p>';
        
      }
      elseif ( 'tax' == $context ) {

        rhswp_sidebar_context_taxonomies();

      }
      elseif ( 'single' == $context ) {

        echo '<br>posttype: <strong>' . $posttype . '</strong>';
        rhswp_sidebar_context_taxonomies();

      }
      else {
        echo '<br>posttype: <a href="/' . $posttype . '/"><strong>' . $posttype . '</strong></a></p>';
      }
    }

    echo '</div></div></div>';    
    
  }
}

//========================================================================================================

// 404 AFHANDELING

//========================================================================================================

remove_action( 'genesis_loop_else', 'genesis_404' );
remove_action( 'genesis_loop_else', 'genesis_do_noposts' );
add_action( 'genesis_loop_else',    'rhswp_no_posts_content_header', 13 );
add_action( 'genesis_loop_else',    'rhswp_no_posts_content', 14 );
add_action( 'genesis_loop_else',    'rhswp_404', 15 );

//========================================================================================================

function rhswp_no_posts_content_header() {
    printf( '<h2 class="entry-title">%s</h2>', __( 'Pagina niet gevonden (fout 404)', 'wp-rijkshuisstijl' ) );
}

//========================================================================================================

function rhswp_no_posts_content() {
    echo '<p>' . sprintf( __( 'We konden niet vinden waar je om vroeg. Misschien helpt het om naar <a href="%s">de homepage te gaan</a>. Je kunt ook zoeken via het zoekformulier hieronder.', 'wp-rijkshuisstijl' ), home_url() ) . '</p>';
    echo '<p>' . get_search_form() . '</p>';
}

//========================================================================================================

function rhswp_404() {
//  echo genesis_html5() ? '<article class="entry">' : '<div class="post hentry">';

  echo '<div class="entry">';
  
  if ( is_404() ) {
    rhswp_no_posts_content_header();
  }
  
  echo '<div class="entry-content">';
  
  if ( is_404() ) {
    rhswp_no_posts_content();
    rhswp_get_sitemap_for_pagenotfound();
  }
  else {
    rhswp_get_sitemap_content();
  }
  
  
  echo '</div>';
  echo '</div>';
  
//  echo genesis_html5() ? '</article>' : '</div>';
  
}

//========================================================================================================

function rhswp_get_sitemap_for_pagenotfound() {
  ?>        
  <section>
    <h2><?php _e( "Pagina's:", 'wp-rijkshuisstijl' ); ?></h2>

    <ul>
        <?php
          $args = array(    
            'depth'                 => '1',
            'title_li'              => '',
            'echo'                  => 0,
            'sort_column'           => 'post_title',
            'walker'                => new rhswp_custom_walker_for_sitemap(),
            'ignore_custom_sort'    => TRUE,
          );
          
           $fulter = wp_list_pages( $args ); 
           echo $fulter;
           ?>
    </ul>
    
  </section>
  <?php
  rhswp_show_customtax_terms( RHSWP_CT_DOSSIER, __( 'Dossiers', 'wp-rijkshuisstijl' ) . ":" );
  rhswp_show_customtax_terms( 'category', __( 'Categorieën', 'wp-rijkshuisstijl' ) . ":" );
  
  
    
}

//========================================================================================================

function rhswp_get_sitemap_content() {
  
  $filtersitemap = true;
  $listitem = 'ul';
  
  if ( isset( $_GET['filtersitemap'] ) ) {
    $filtersitemap = filter_input(INPUT_GET, 'filtersitemap', FILTER_SANITIZE_SPECIAL_CHARS);
    if ( $filtersitemap == 'nee' ) {
      $filtersitemap = false;
      $listitem = 'ol';
    }
  }
  
  ?>        
  <section>
    <h2><?php _e( "Pagina's:", 'wp-rijkshuisstijl' ); ?></h2>
    <<?php echo $listitem; ?>>
        <?php

        if ( $filtersitemap ) {
          
          $args = array(    
            'title_li'  => '',
            'echo'      => 0,
            'walker'    => new rhswp_custom_walker_for_sitemap()
          );
        
        }
        else {
          
          $args = array(    
            'title_li'  => '',
            'echo'      => 0,
          );
        
        }
          
        $fulter   = wp_list_pages( $args ); 
        $pattern  = "/<ul[^>]*><\\/ul[^>]*>/"; 
        $fulter   = preg_replace($pattern, '', $fulter); 
        echo $fulter;
 ?>
      </<?php echo $listitem; ?>>
  </section>
  <?php
    
    rhswp_show_customtax_terms( RHSWP_CT_DOSSIER, __( 'Dossiers', 'wp-rijkshuisstijl' ) . ":" );
    rhswp_show_customtax_terms( 'category', __( 'Categorieën', 'wp-rijkshuisstijl' ) . ":" );

    if ( $filtersitemap ) {
    }
    else { 
      ?>
      <section>
        <h2><?php echo 'Documenten:' ?></h2>
        <<?php echo $listitem; ?>>
            <?php 
    
                
              $args = array(    
                'type'        => 'postbypost',
                'post_type'   => RHSWP_CPT_DOCUMENT,
                'echo'         => 1,
              );
      
              
              wp_get_archives( $args ); ?>
        </<?php echo $listitem; ?>>
      </section>
      <section>
        <h2><?php echo 'Events:' ?></h2>
        <<?php echo $listitem; ?>>
            <?php 
    
                
              $args = array(    
                'type'        => 'postbypost',
                'post_type'   => RHSWP_CPT_EVENT,
                'echo'         => 1,
              );
      
              
              wp_get_archives( $args ); ?>
        </<?php echo $listitem; ?>>
      </section>

      <?php
      if ( defined( 'RHSWP_CPT_RIJKSVIDEO' ) ) {
      ?>
      
      <section>
        <h2><?php echo 'Videos:' ?></h2>
        <<?php echo $listitem; ?>>
            <?php 
    
                
              $args = array(    
                'type'        => 'postbypost',
                'post_type'   => RHSWP_CPT_RIJKSVIDEO,
                'echo'         => 1,
              );
      
              
              wp_get_archives( $args ); ?>
        </<?php echo $listitem; ?>>
      </section>

      
      <?php
        }
    }

  
  $maxnr_posts = -1;

  if ( $filtersitemap ) {
    $maxnr_posts = 12;
  }
  else {
    $maxnr_posts = 'Alle';
  }
  
  ?>        
  <section>
    <h2><?php echo $maxnr_posts .  __( ' laatste berichten', 'wp-rijkshuisstijl' ) . ':'; ?></h2>
    <<?php echo $listitem; ?>>
        <?php 


        if ( $filtersitemap ) {
          
          $args = array(    
          'type'        => 'postbypost',
          'limit'       => $maxnr_posts,
          'order'       => 'DESC',
          'post_type'   => 'post',
          'echo'         => 1,
          );
        
        }
        else {
          
          $args = array(    
            'type'        => 'postbypost',
            'post_type'   => 'post',
            'echo'         => 1,
          );
        
        }

          
          wp_get_archives( $args ); ?>
    </<?php echo $listitem; ?>>
  </section>
  <?php
    
}

//========================================================================================================

class rhswp_custom_walker_for_taxonomies extends Walker_Category {
  
  function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {

    extract($args);
    
    $cat_name     = esc_attr( $category->name );
    $excerpt      = esc_attr( wp_strip_all_tags( $category->description ) );

		$headline   =  get_term_meta( $category->term_id, 'headline', true );

    if ( isset( $headline[0] ) && ( strlen( $headline[0] ) > 0 ) ) {
      if ( is_array( $headline ) ) {
      	$headline = strval( $headline[0] );
      }
      else {
      	$headline = strval( $headline );
      }
			$cat_name .= ' - ' . wp_strip_all_tags( $headline );
		}

    if ( $excerpt ) {

      if ( is_array( $excerpt ) ) {
      	$excerpt = strval( $excerpt[0] );
      }
      else {
      	$excerpt = strval( $excerpt );
      }
      
    	$excerpt  =  wp_strip_all_tags( $excerpt );
    }


    $link = '<a href="' . esc_url( get_term_link($category) ) . '" ';
    $link .= '>';
    $link .= $cat_name . '</a>';
    
    if ( !empty($show_count) )
      $link .= ' (' . intval($category->count) . ')';
    
      if ( 'list' == $args['style'] ) {
        $output .= "\t<li";
        $class = 'cat-item cat-item-' . $category->term_id;
        
        $termchildren = get_term_children( $category->term_id, $category->taxonomy );
        if(count($termchildren)>0){
          $class .=  ' i-have-kids';
        }
        
        if ( !empty($current_category) ) {
          $_current_category = get_term( $current_category, $category->taxonomy );
          if ( $category->term_id == $current_category )
            $class .=  ' current-cat';
          elseif ( $category->term_id == $_current_category->parent )
            $class .=  ' current-cat-parent';
        }
        
        $output .=  ' class="' . $class . '"';
//        $output .= ' data-mixible data-titel="' . strtolower( $cat_name ) . '"';
        $output .= ' data-mixible data-titel="' . strtolower( $cat_name ) . ' ' . strtolower( $excerpt ) . '"';
        $output .= ">$link\n";
        $output .= '<span class="excerpt">' . $excerpt . "</span>\n";
        
      }
      else {
        $output .= "\t$link<br />\n";
      }
  }
}
//========================================================================================================

class rhswp_custom_walker_for_sitemap extends Walker_Page {

  // -------------------------

  function start_lvl( &$output, $depth = 0, $args = array() ) {
    $output .= '<ul class="children nounou">';
  }
  
  // -------------------------

  function end_lvl( &$output, $depth = 0, $args = array() ) {
    $output .= '</ul>';
  }
  
  // -------------------------

  function end_el( &$output, $page, $depth = 0, $args = array() ) {

    $indent       = '';
    $css_class    = '';
    $link_before  = '';
    $icon_class   = '';
    $link_after   = '';

    $pagetemplate = get_page_template_slug( $page->ID );

    if ( ( 'page_dossiersingleactueel.php' != $pagetemplate ) 
        && ( 'page_dossier-document-overview.php' != $pagetemplate ) 
        && ( 'page_dossier-events-overview.php' != $pagetemplate ) 
        ) {
  
//        $output .= 'BOE';

    }
    else {
//        $output .= '-';
    }

  }
  
  // -------------------------
  
  function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {

      if ( $depth ) {
        $indent = str_repeat("\t", $depth);
      }
      else {
        $indent = '';
      }
          
      extract($args, EXTR_SKIP);

      $css_class = array('page_item', 'page-item-' . $page->ID);
  
      if ( !empty($current_page) ) {
          $_current_page = get_post( $current_page );

          if ( in_array( $page->ID, $_current_page->ancestors ) ) {
            $css_class[] = 'current_page_ancestor';
          }
          if ( $page->ID == $current_page ) {
            $css_class[] = 'current_page_item';
          }
          elseif ( $_current_page && $page->ID == $_current_page->post_parent ) {
            $css_class[] = 'current_page_parent';
          }
      }
      elseif ( $page->ID == get_option('page_for_posts') ) {
          $css_class[] = 'current_page_parent';
      }
  
      $css_class    = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );
      $icon_class   = get_post_meta($page->ID, 'icon_class', true); //Retrieve stored icon class from post meta

      $pagetemplate = get_page_template_slug( $page->ID );

      if ( ( 'page_dossiersingleactueel.php' != $pagetemplate ) 
          && ( 'page_dossier-document-overview.php' != $pagetemplate ) 
          && ( 'page_dossier-events-overview.php' != $pagetemplate ) 
          ) {
  
        $output .= $indent . '<li class="' . $css_class . '">';
        $output .= '<a href="' . get_permalink( $page->ID ) . '">' . $link_before;
    
        if($icon_class){ //Test if $icon_class exists
          $output .= '<span class="' . $icon_class . '"></span>'; //If it exists output a span with the $icon_class attached to it
        }
        
        $output .= apply_filters( 'the_title', $page->post_title, $page->ID );
        $output .= $link_after . '</a>';

    }
    else {
//        $output .= 'START';
    }
      
  
    if ( !empty($show_date) ) {
      if ( 'modified' == $show_date ) {
        $time = $page->post_modified;
      }
      else {
        $time = $page->post_date;
        $output .= " " . mysql2date($date_format, $time);
      }
    }
  }

  // -------------------------
  
}
//========================================================================================================

function rhswp_get_sitemap() {
  
//  echo genesis_html5() ? '<article class="entry">' : '<div class="post hentry">';

  echo '<div class="entry">';
  
  if ( is_404() ) {
    rhswp_no_posts_content_header();
  }
  
  echo '<div class="entry-content">';
  
  if ( is_404() ) {
    rhswp_no_posts_content();
  }
  
  rhswp_get_sitemap_content();
  echo '</div>';
  
  echo '</div>';
  
//  echo genesis_html5() ? '</article>' : '</div>';
  
}

//========================================================================================================

// add an extra widget area

function rhswp_widget_homepage() {
  if ( is_active_sidebar( RHSWP_HOME_WIDGET_AREA ) ) {
    echo '<div class="widgets ' . RHSWP_HOME_WIDGET_AREA . ' entry">';
    dynamic_sidebar( RHSWP_HOME_WIDGET_AREA );
    echo '</div>';
  }
}
genesis_register_sidebar(   
    array(
        'name'              => __( "Homepage widget area", 'wp-rijkshuisstijl' ),
        'id'                => RHSWP_HOME_WIDGET_AREA,
        'description'       => __( "Ruimte voor widget op de homepage", 'wp-rijkshuisstijl' ),
        'before_widget' => genesis_markup( array(
            'html5' => '<section id="%1$s" class="widget %2$s '.RHSWP_HOME_WIDGET_AREA . '"><div class="widget-wrap">',
            'xhtml' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
            'echo'  => false,
        ) ),
        'after_widget'  => genesis_markup( array(
            'html5' => '</div></section>' . "\n",
            'xhtml' => '</div></div>' . "\n",
            'echo'  => false
        ) ),
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => "</h2>\n",
    )
);

//========================================================================================================

// javascripts toevoegen, voor het menu
add_action( 'wp_enqueue_scripts', 'rhswp_enqueue_js_scripts' );

function rhswp_enqueue_js_scripts() {

  if ( ! is_admin() ) {

    wp_enqueue_script( 'modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', '', '', true );
    
    if ( DO_MINIFY_JS ) {
      // the minified file
      wp_enqueue_script( 'slider2', RHSWP_THEMEFOLDER . '/js/min/scripts-min.js', array( 'jquery' ), '', true );
      wp_enqueue_script( 'wp-rijkshuisstijl-menu', RHSWP_THEMEFOLDER . '/js/min/menu-min.js', '', '', true );
    }
    else {
      // these are the unminified JS-files
      wp_enqueue_script( 'wp-rijkshuisstijl-polyfill-eventlistener', RHSWP_THEMEFOLDER . '/js/polyfill-eventlistener.js', array( 'jquery' ), '', true );
      wp_enqueue_script( 'wp-rijkshuisstijl-polyfill-matchmedia', RHSWP_THEMEFOLDER . '/js/polyfill-matchmedia.js', array( 'jquery' ), '', true );
      wp_enqueue_script( 'slider2', RHSWP_THEMEFOLDER . '/js/carousel-actions.js', array( 'jquery' ), '', true );
      wp_enqueue_script( 'wp-rijkshuisstijl-menu', RHSWP_THEMEFOLDER . '/js/menu.js', '', CHILD_THEME_VERSION, true );
    }
  }

//  if ( ( is_home() || is_front_page() ) ) {
//    wp_enqueue_script( 'commentform', RHSWP_THEMEFOLDER . '/js/min/scripts-home-min.js', array( 'jquery' ), '', true );
//  }
}

//========================================================================================================

add_filter( 'genesis_attr_nav-primary',   'add_class_to_menu' );
add_filter( 'genesis_attr_nav-secondary', 'add_class_to_menu' );

function add_class_to_menu( $attributes ) {
	$attributes['class'] .= ' js-menu';
	return $attributes;
}

//========================================================================================================

function rhswp_menu_container_start() {
	echo '<div id="menu-container">';
}

//========================================================================================================

function rhswp_menu_container_end() {
	echo '</div>';
}

//========================================================================================================

add_filter( 'genesis_after', 'rhswp_trackercode', 999 );

function rhswp_trackercode() {
  if ( 'www.digitaleoverheid.nl' == $_SERVER["HTTP_HOST"] || 'digitaleoverheid.nl' == $_SERVER["HTTP_HOST"] ) { 
        echo '<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(["enableLinkTracking"]);
  _paq.push(["setLinkTrackingTimer", 750]);
  _paq.push(["enableHeartBeatTimer"]);
  _paq.push(["trackPageView"]);
  _paq.push(["enableLinkTracking"]);
  (function() {
    var u="//statistiek.rijksoverheid.nl/piwik/";
    _paq.push(["setTrackerUrl", u+"js/tracker.php"]);
    _paq.push(["setSiteId", 147]);
    var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0];
    g.type="text/javascript"; g.async=true; g.defer=true; g.src=u+"js/tracker.php"; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Piwik Code -->';
    }
    else {
        if ( WP_DEBUG ) {
          echo '<!-- Geen Piwik: ' . $_SERVER["HTTP_HOST"] . '-->';
        }
    }
}

//========================================================================================================

/*
 * Modifying TinyMCE editor to remove unused items.
*/

function admin_set_tinymce_options( $settings ) {
    $settings['theme_advanced_blockformats']  = 'p,h2,h3,h4,h5,h6,q,hr';
    $settings['theme_advanced_disable']       = 'underline,spellchecker,forecolor,justifyfull';
    $settings['theme_advanced_buttons2_add']  = 'styleselect';
    $settings['theme_advanced_styles']        = "'Infoblok'=infoblock, 'Streamer'=pullquote";
    // ============
     
    $settings['toolbar1'] = 'formatselect,italic,bullist,numlist,blockquote,|,link,unlink,|,spellchecker,|,styleselect,|,removeformat,cleanup,|,alignleft,alignright,undo,redo,outdent,indent,hr,fullscreen';
    $settings['toolbar2'] = '';
    $settings['block_formats'] = 'Tussenkop niveau 2=h2;Tussenkop niveau 3=h3;Tussenkop niveau 4=h4;Tussenkop niveau 5=h5;Tussenkop niveau 6=h6;Paragraaf=p;Citaat=q';

    $settings['style_formats'] = '[
            {title: "Kaderblok", block: "section", classes: "kaderblok"},
            {title: "Intro-paragraaf", block: "span", classes: "intro"},
    ]';


    return $settings;
}
 
add_filter('tiny_mce_before_init', 'admin_set_tinymce_options');

//========================================================================================================

function rhswp_register_extra_menu() {
  register_nav_menu('extra-menu',__( 'Extra navigatiemenu (rechtsboven)', 'wp-rijkshuisstijl' ) );
}
//add_action( 'init', 'rhswp_register_extra_menu' );

// Unregister secondary navigation menu
add_theme_support( 'genesis-menus', array( 'primary' => __( 'Primary Navigation Menu', 'wp-rijkshuisstijl' ) ) );

//========================================================================================================

// Add the extra navigation menu
add_action( 'genesis_header', 'rhswp_display_extra_menu', 2 );

function rhswp_display_extra_menu() {
  
  if ( has_nav_menu( 'extra-menu' ) ) {
    wp_nav_menu( array( 'theme_location' => 'extra-menu', 'container_class' => 'wrap extra-menu' ) );
  }
  
}

//========================================================================================================

  /**
 * Remove Genesis Page Templates
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/remove-genesis-page-templates
 *
 * @param array $page_templates
 * @return array
 */

function rhswp_remove_genesis_page_templates( $page_templates ) {
	unset( $page_templates['page_archive.php'] );
	unset( $page_templates['page_blog.php'] );
	return $page_templates;
}
add_filter( 'theme_page_templates', 'rhswp_remove_genesis_page_templates' );

//========================================================================================================

add_filter( 'get_search_form', 'rhswp_add_id_to_search_form', 21 );

function rhswp_add_id_to_search_form( $form ) {
  $form = str_replace("<form", '<form tabindex="-1" id="' . ID_ZOEKEN . '" ', $form);
  return apply_filters( 'genesis_search_form', $form );
}

//========================================================================================================

function rhswp_add_payoff() {
  echo '<div id="payoff"><div class="wrapper"><span>&nbsp;</span></div></div>';
  
}

function rhswp_footer_widget_area() {
  echo '<h3 class="screen-reader-text">' . _x( 'Footer widgets', 'Title of footer widgets', 'wp-rijkshuisstijl' ) . '</h3>';
}

//========================================================================================================

// Overwrite widget settings
add_action( 'widgets_init', 'rhswp_overwrite_widget_settings' );

function rhswp_overwrite_widget_settings() {
  //Gets rid of the default Primary Sidebar
  unregister_sidebar( 'sidebar' );
  unregister_sidebar( 'sidebar-alt' );
  
  genesis_register_sidebar( 
    array (
    	'name'          => _x( 'Eerste sidebar', 'Title of primary sidebar', 'wp-rijkshuisstijl' ), 
    	'description'   => _x( 'Primaire zijbalk met ruimte voor widgets. Wordt standaard getoond aan de rechterkant van de content op brede schermen', 'Description of primary sidebar', 'wp-rijkshuisstijl' ), 
    	'id'            => 'sidebar', 
    	'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">', 
    	'after_widget'  => "</div></div>\n", 
    	'before_title'  => '<h3 class="widgettitle">', 
    	'after_title'   => "</h3>\n" 
    ) 
  );
  
  genesis_register_sidebar( 
    array (
    	'name'          => _x( 'Tweede sidebar', 'Title of secondary sidebar', 'wp-rijkshuisstijl' ), 
    	'description'   => _x( 'Secundaire zijbalk met ruimte voor widgets. Wordt alleen getoond op pagina\'s waar de niet-standaard layout is gekozen', 'Description of secundary sidebar', 'wp-rijkshuisstijl' ),
    	'id'            => 'sidebar-alt', 
    	'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">', 
    	'after_widget'  => "</div></div>\n", 
    	'before_title'  => '<h2 class="widgettitle">', 
    	'after_title'   => "</h2>\n" 
    ) 
  );
  
  genesis_register_sidebar( 
    array (
    	'name'          => _x( 'Widgets in de footer', 'Title of footer widget', 'wp-rijkshuisstijl' ), 
    	'description'   => _x( "Ruimte voor extra menus's onder de hoofdcontent", 'Description of footer widget space', 'wp-rijkshuisstijl' ),
    	'id'            => 'sidebar-footer', 
    	'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">', 
    	'after_widget'  => "</div></div>\n", 
    	'before_title'  => '<h3 class="widgettitle">', 
    	'after_title'   => "</h3>\n" 
    ) 
  );
}

//========================================================================================================

//Social Buttons

function rhswp_socialbuttons($post_info, $hidden = '') {
	
    $thelink    = urlencode(get_permalink($post_info->ID));
    $thetitle   = urlencode($post_info->post_title);
    $sitetitle  = urlencode(get_bloginfo('name'));
    $summary    = urlencode($post_info->post_excerpt);

    $pagetype   = 'Deel deze pagina';
    
    $comment    = '<h2>' . $pagetype . '</h2>';
    
    $startblock = '<div class="sharing block">';
    $endblock   = '</div>';
        
        
    if ( $hidden ) {
        $comment    = '<!-- ey, we hoeven maar 1 werkende set sokmetknoppen te gebruiken ja? dit hiero is versiering -->';
        $thetag     = 'i';
        $hrefattr   = 'data-href';
        $popup      = ' onclick="javascript:window.open(this.dataset.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600\');return false;"';
    }
    else {
        $thetag = 'a';
        $hrefattr = 'href';
        $popup      = ' onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600\');return false;"';
    }    
    
    if ( $thelink ) {
        return $startblock . $comment . '<ul class="social-media share-buttons">
            <li><' . $thetag . ' ' . $hrefattr . '="https://twitter.com/share?url=' . $thelink . '&via=' . GC_TWITTERACCOUNT . '&text=' . $thetitle . '" class="twitter" data-url="' . $thelink . '" data-text="' . $thetitle . '" data-via="' . GC_TWITTERACCOUNT . '"' . $popup . '><span class="visuallyhidden">' . __('Deel op Twitter', 'wp-rijkshuisstijl'
) . '</span></' . $thetag . '></li>
            <li><' . $thetag . ' class="facebook" ' . $hrefattr . '="https://www.facebook.com/sharer/sharer.php?u=' . $thelink . '&t=' . $thetitle . '"' . $popup . '><span class="visuallyhidden">' . __('Deel op Facebook', 'wp-rijkshuisstijl'
) . '</span></' . $thetag . '></li>
            <li><' . $thetag . ' class="linkedin" ' . $hrefattr . '="http://www.linkedin.com/shareArticle?mini=true&url=' . $thelink . '&title=' . $thetitle . '&summary=' . $summary . '&source=' . $sitetitle . '"' . $popup . '><span class="visuallyhidden">' . __('Deel op LinkedIn', 'wp-rijkshuisstijl'
) . '</span></' . $thetag . '></li>
            </ul>' . $endblock;    

//            <li><' . $thetag . ' class="googleplus" ' . $hrefattr . '="https://plus.google.com/share?url=' . $thelink . '&t=' . $thetitle . '"' . $popup . '><span>' . __('Deel op Google+', 'wp-rijkshuisstijl') . '</span></' . $thetag . '></li>
            
    }
}

add_action( 'genesis_after_loop', 'rhswp_add_sharebuttons_after_content', 15 );

//========================================================================================================

add_action( 'genesis_entry_content', 'rhswp_document_add_extra_info', 15 );

function rhswp_document_add_extra_info() {
  global $post;
  
  if ( is_single() && ( RHSWP_CPT_DOCUMENT == get_post_type() ) ) {
    if ( function_exists( 'get_field' ) ) {
      $grootte    = get_field('rhswp_document_filesize', $post->ID );
      $type       = get_field('rhswp_document_filetype', $post->ID );
      $file       = get_field('rhswp_document_upload', $post->ID );
      if( $file ) {
        echo '<a href="' . $file['url'] . '">Download ' . $file['filename'] . '</a>';
        if ( $type || $grootte ) {
          echo ' (';
          if ( $type && $grootte ) {
            echo $type . ', ' . $grootte;
          }
          else {
            echo $type . $grootte;
          }          
          echo ')';
        }
      }
    }
  }
}

//========================================================================================================

function rhswp_add_sharebuttons_after_content() {
  global $post;
  
  $socialmedia_icoontjes    = SOC_MED_YES;
  if ( 
      ( 'page'    == get_post_type() ) ||
      ( 'post'    == get_post_type() ) ||
      ( 'event'   == get_post_type() ) 
       ) {
      
      if ( function_exists( 'get_field' ) ) {
          $socialmedia_icoontjes    = get_field('socialmedia_icoontjes', $post->ID );
      }
  }
  if ( is_home() || is_front_page() ) {
      $socialmedia_icoontjes = '';
  }
  elseif  ( ( $socialmedia_icoontjes !== SOC_MED_NO ) && ( is_single() ||  is_page() ) )  {
      $socialmedia_icoontjes = rhswp_socialbuttons( $post, '' );
  }            
  else {
      $socialmedia_icoontjes = '';
  }
 
 echo $socialmedia_icoontjes;
      
}

//========================================================================================================

// Customize the entry meta in the entry header (requires HTML5 theme support)
add_filter( 'genesis_post_info', 'rhswp_post_append_postinfo' ); 

function rhswp_post_append_postinfo($post_info) {
  global $wp_query;
  global $post;

  if ( is_home() ) {
    // niks, eigenlijk
    return '[post_date]';
  }
  elseif ( is_page() ) {
    // niks, eigenlijk
    return '[post_date]';
  }
  else {
    if ( 'event' == get_post_type() ) {
      return '';
    }
    elseif ( 'post' == get_post_type() ) {
      if ( is_single() ) {
        return '[post_categories before=""] [post_date]';

      }
      else {
        return '[post_date]';
      }
    } 
    else {
      return '[post_date]';
    }
  }
}

//========================================================================================================

function rhswp_add_single_socialmedia_buttons() {
  $socialmedia_icoontjes    = SOC_MED_YES;
  
  if ( function_exists( 'get_field' ) ) {
    $socialmedia_icoontjes    = get_field('socialmedia_icoontjes', $post->ID );
    if  ( ( $socialmedia_icoontjes !== SOC_MED_NO ) && ( is_single() ) )  {
      $socialmedia_icoontjes = rhswp_socialbuttons($post, '' );
    }
    else {
      $socialmedia_icoontjes = '';
    }
  }
  
  echo $socialmedia_icoontjes;
}

//========================================================================================================

function rhswp_filter_alternative_title( $postid = 0,  $title = '' ) {

  $yoasttitle = get_post_meta( $postid , '_yoast_wpseo_title', true); 

  if ( $yoasttitle ) {
    $title = $yoasttitle;
  }
  
  if ( function_exists( 'get_field' ) ) {
    
      $alternatieve_paginatitel_gebruiken    = get_field('alternatieve_paginatitel_gebruiken', $postid );
      if ( strtolower($alternatieve_paginatitel_gebruiken) == 'ja' ) {
        
        $alternatieve_paginatitel    = get_field('alternatieve_paginatitel', $postid );
        
        if ( $alternatieve_paginatitel ) {
          return $alternatieve_paginatitel;
        }
      }
  }
  return $title;
}

//========================================================================================================

add_filter( 'genesis_post_title_text', 'genesis_post_title_text_filter', 15 );

function genesis_post_title_text_filter( $title ) {
  
  global $post;
  $title = rhswp_filter_alternative_title( $post->ID, $title );
  return $title;
}

//========================================================================================================

add_filter( 'cmb2_sanitize_human_name', 'cmb2_sanitize_human_name', 10, 2 );

function cmb2_sanitize_human_name( $override_value, $value ) {
  $value = sanitize_text_field( $value );
  $names = explode(' ', $value);
  if ( count( $names ) < 2 ) {
    return '';
  }
  return ucwords( $value );
}

//========================================================================================================

add_action( 'cmb2_render_human_name', 'cmb2_render_human_name', 10, 5 );

function cmb2_render_human_name( $field, $escaped_value, $object_id,
          $object_type, $field_type_object ) {
  echo $field_type_object->input( array( 'type' => 'text' ) );
}

//========================================================================================================

add_action( 'genesis_site_title',   'rhswp_append_site_logo' );

function rhswp_append_site_logo() {
  echo '<a href="' . get_home_url() . '" title="' . _x( 'Naar de homepage van digitaleoverheid.nl', 'title for link to homepage', 'wp-rijkshuisstijl' ) . '"><span id="logotype"><img src="' . RHSWP_THEMEFOLDER . '/images/svg/logo-digitaleoverheid.svg" alt="Logo digitaleoverheid.nl"></span></a>';
}

//========================================================================================================

function rhswp_show_customtax_terms( $taxonomy = 'category', $title = '', $dosection = true, $cssclasses = '', $containerid = '' ) {
  $sectionstart = '<section>';
  $sectionend   = '</section>';
  
  if ( $cssclasses ) {
    $cssclasses = ' class="' . strtolower($taxonomy) . ' ' . $cssclasses . '"';
  }
  else {
    $cssclasses = ' class="' . strtolower($taxonomy) . '"';
  }
  
  if ( $containerid ) {
    $containerid = ' id="' . $containerid . '"';
  }
  else {
    $containerid = '';
  }
  
  if ( !$dosection ) {
    $sectionstart = '';
    $sectionend   = '';
  }
  
  if ( taxonomy_exists( $taxonomy ) ) { 
      
    $show_count   = false;
    $pad_counts   = false;
    $hierarchical = true;
     
    $args = array(
      'taxonomy'              => $taxonomy,
      'orderby'               => 'name',
      'order'                 => 'ASC',
      'hide_empty'            => true,      
      'ignore_custom_sort'    => TRUE,
      'echo'                  => 0,
      'hierarchical'          => TRUE,
      'title_li'              => '',
      'walker'                => new rhswp_custom_walker_for_taxonomies()
    );

    $terms = wp_list_categories( $args );
    
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){

        echo $sectionstart;
        if ( $title ) {
          echo '<h2>' . $title . '</h2>';
        }
    
        echo '<ul' . $cssclasses . '' . $containerid . '>';
        echo $terms;
        echo '</ul>';
    
        echo $sectionend;
    }
  }
}

//========================================================================================================

function rhswp_site_description() {
  
  $description = get_bloginfo( 'description' );
  
  if ( $description ) {
    if ( ( !is_admin() ) && ( !is_feed() ) ) {
      
    $needle   = '&lt;strong&gt;';
    $replacer = '';
    $description = str_replace( $needle, $replacer, $description);
    
    $needle   = '&lt;/strong&gt;';
    $replacer = '';
    $description = str_replace( $needle, $replacer, $description);
    
    $needle   = 'Digitale overheid';
    $replacer = '<strong>Digitale overheid</strong>';
    $description = str_replace( $needle, $replacer, $description);

//<strong>Digitale overheid</strong>: betrouwbaar, veilig, betaalbaar    
    
    echo '<div class="site-description"><div class="wrap">' . $description . '</div></div>';

    }

  }
}

//========================================================================================================

function rhswp_get_context_info() {
  
  global $wp_query;


  if ( $wp_query->is_page ) {
      $loop = is_front_page() ? 'front' : 'page';
  } elseif ( $wp_query->is_home ) {
      $loop = 'home';
  } elseif ( $wp_query->is_single ) {
      $loop = ( $wp_query->is_attachment ) ? 'attachment' : 'single';
  } elseif ( $wp_query->is_category ) {
      $loop = 'category';
  } elseif ( $wp_query->is_tag ) {
      $loop = 'tag';
  } elseif ( $wp_query->is_tax ) {
      $loop = 'tax';
  } elseif ( $wp_query->is_archive ) {
      if ( $wp_query->is_day ) {
          $loop = 'day';
      } elseif ( $wp_query->is_month ) {
          $loop = 'month';
      } elseif ( $wp_query->is_year ) {
          $loop = 'year';
      } elseif ( $wp_query->is_author ) {
          $loop = 'author';
      } else {
          $loop = 'archive';
      }
  } elseif ( $wp_query->is_search ) {
      $loop = 'search';
  } elseif ( $wp_query->is_404 ) {
      $loop = 'notfound';
  }
  
  return $loop ;

}


//========================================================================================================

// zorg voor de mogelijkheid voor context van berichten. Dit doen we door een url met
// 2 gedeeltes:
//  1: pagina waarop het bericht vermeld staat
//  2: de slug van het bericht
// deze twee gedeeltes komen in de URL terug en worden van elkaar gescheiden door RHSWP_DOSSIERPOSTCONTEXT
//
// dus in deze URL
// <domainname>/wanneer/voortgang/actueel/dossiercontext/optimaal-digitaal-partner-van-alert-online-2/
// zit 'optimaal-digitaal-partner-van-alert-online-2' als slug van het bericht
// en '/wanneer/voortgang/actueel/' als context
//

//========================================================================================================

add_action( 'init', 'rhswp_dossiercontext_add_rewrite_rules');

function rhswp_dossiercontext_add_rewrite_rules() {

  // rewrite rules for posts in dossier context
  add_rewrite_rule( '(.+?)(/' . RHSWP_DOSSIERPOSTCONTEXT . '/)(.+?)/?$', 'index.php?name=$matches[3]&' . RHSWP_DOSSIERPOSTCONTEXT . '=$matches[1]', 'top');
  add_rewrite_rule( '(.+?)/' . RHSWP_DOSSIERPOSTCONTEXT . '/?$', 'index.php?pagename=$matches[1]', 'top');

  // rewrite rules for documents in dossier context
  add_rewrite_rule( '(.+?)(/' . RHSWP_DOSSIERDOCUMENTCONTEXT . '/)(.+?)/?$', 'index.php?document=$matches[3]&' . RHSWP_DOSSIERPOSTCONTEXT . '=$matches[1]', 'top');
  add_rewrite_rule( '(.+?)/' . RHSWP_DOSSIERDOCUMENTCONTEXT . '/?$', 'index.php?pagename=$matches[1]', 'top');

  // rewrite rules for events in dossier context
  add_rewrite_rule( '(.+?)(/' . RHSWP_DOSSIEREVENTCONTEXT . '/)(.+?)/?$', 'index.php?event=$matches[3]&' . RHSWP_DOSSIERPOSTCONTEXT . '=$matches[1]', 'top');
  add_rewrite_rule( '(.+?)/' . RHSWP_DOSSIEREVENTCONTEXT . '/?$', 'index.php?pagename=$matches[1]', 'top');

  if ( function_exists( 'get_field' ) ) {
    if( get_field('global_search_page', 'option') ) {
      
      $zoekpagina = get_field('global_search_page', 'option');
  
      // rewrite rules for events in dossier context
      add_rewrite_rule( '?(s=)(.+?)?$', 'index.php?page_id=' . $zoekpagina->ID . '&searchwpquery=$matches[2]', 'top');
      
    }  
  }  

}

//========================================================================================================

add_action( 'init', 'rhswp_fix_blog_pagination' );

function rhswp_fix_blog_pagination(){
    add_rewrite_rule(
        'actueel/page/([0-9]+)/?$',
        'index.php?pagename=actueel&paged=$matches[1]',
        'top'
    );
}

//========================================================================================================

add_action( 'init', 'rhswp_dossiercontext_flush_check', 99);

function rhswp_dossiercontext_flush_check() {
  
  $check = get_option( RHSWP_DOSSIERPOSTCONTEXT_OPTION );

  if ( !$check == RHSWP_DOSSIERPOSTCONTEXT ) {
    dodebug('Wel spoelen');
    flush_rewrite_rules();
    delete_option( RHSWP_DOSSIERPOSTCONTEXT_OPTION );
    add_option( RHSWP_DOSSIERPOSTCONTEXT_OPTION, RHSWP_DOSSIERPOSTCONTEXT );
  }

}

//========================================================================================================

add_action( 'query_vars', 'rhswp_dossiercontext_add_query_vars' );

function rhswp_dossiercontext_add_query_vars($vars) {
	$vars[] = RHSWP_DOSSIERPOSTCONTEXT;
	$vars[] = 'searchwpquery';
	
	return $vars;
}

//========================================================================================================

function rhswp_extra_contentblokken_checker() {
  global $post;

  $debugstring  = '';
  $returnvalue  = false;

  if ( is_page() ) {
    $theid          = get_the_ID();
    $contentblokken = get_field('extra_contentblokken', $theid );
  }
  elseif ( is_tax( RHSWP_CT_DOSSIER ) ) {
    $theid          = RHSWP_CT_DOSSIER . '_' . get_queried_object()->term_id;
    $contentblokken = get_field('extra_contentblokken', $theid );
  }
  else {
    $theid          = RHSWP_CT_DOSSIER . '_' . get_queried_object()->term_id;
    $contentblokken = get_field('extra_contentblokken', $theid );
    $debugstring    = 'rhswp_extra_contentblokken_checker / else ' . $theid;
  }

  $debugstring = rhswp_get_context_info();

  if( $contentblokken ) {
    $returnvalue =  true;
    $debugstring   .= '. Er zijn contentblokkken voor ' . $theid;
  }
  else {
    $debugstring   .= '. Helaas geen contentblokkken voor ' . $theid;
  }  
  
  if( $debugstring ) {
//    dodebug( $debugstring );
  }  
  
  return $returnvalue;

}

//========================================================================================================

function rhswp_write_extra_contentblokken() {
  global $post;
  
  if ( function_exists( 'get_field' ) ) {

    if ( is_page() || is_tax() ) {

      $dossier_in_content_block      = '';

      if ( is_page() ) {
        $theid          = get_the_ID();
        $contentblokken = get_field('extra_contentblokken', $theid );
        $dossier_in_content_block    = get_the_terms( $theid , RHSWP_CT_DOSSIER );
      }
      elseif ( is_tax( RHSWP_CT_DOSSIER ) ) {
        $theid          = RHSWP_CT_DOSSIER . '_' . get_queried_object()->term_id;
        $contentblokken = get_field('extra_contentblokken', $theid );
        $dossier_in_content_block    = get_queried_object()->term_id;
      }

     
      if( $contentblokken && ( $contentblokken[0] != '' ) ) {

        foreach( $contentblokken as $row ) {
  
          $algemeen_links         = $row['extra_contentblok_algemeen_links'];
          $select_dossiers_list   = $row['select_dossiers_list'];
          $selected_content       = $row['select_berichten_paginas'];
          $selected_content_full  = $row['select_berichten_paginas_toon_samenvatting'];
          $chosen_category        = $row['extra_contentblok_chosen_category'];
          $titel                  = esc_html( $row['extra_contentblok_title'] );
          $type_block             = $row['extra_contentblok_type_block'];
          $categoriefilter        = $row['extra_contentblok_categoriefilter'];
          $maxnr_posts            = $row['extra_contentblok_maxnr_posts'];
          $with_featured_image    = $row['extra_contentblok_maxnr_posts_with_featured_image'];

          $currentpage            = '';
          $currentsite            = '';


          if ( 'algemeen' == $type_block ) {

            if ( $algemeen_links ) {

              echo '<div class="block">';
              
              if ( $titel ) {
                echo '<h2>' . $titel . '</h2>';
              }
              echo '<ul class="links">';

              foreach ( $algemeen_links as $itemid ) {
                $title  = $itemid['extra_contentblok_algemeen_links_linktekst'];
                $url    = $itemid['extra_contentblok_algemeen_links_url'];
                if ( $title && $url ) {
                  echo '<li>';
                  echo '<a href="';
                  echo $url;
                  echo '">';
                  echo $title;
                  echo '</a></li>';
                }
              }
              
              echo '</ul>';
              echo '</div>';
            }

            // RESET THE QUERY
            wp_reset_query();
            
          }
          elseif ( 'berichten_paginas' == $type_block ) {

            echo '<div class="block">';

            if ( $titel ) {
              echo '<h2>' . $titel . '</h2>';
            }

            if ( $selected_content_full != 'ja' ) {
              
              echo '<ul class="links">';
            
              foreach ( $selected_content as $post ) {
                
                setup_postdata($post);                
                
                $title  = get_the_title();
                $url    = get_permalink();
                if ( $title && $url ) {
                  echo '<li>';
                  echo '<a href="';
                  echo $url;
                  echo '">';
                  echo $title;
                  echo '</a></li>';
                }
              }

              wp_reset_query();
              
              
              echo '</ul>';
            }
            else {
              // dus $selected_content_full == 'ja'

              $postcounter = 0;
            
              foreach ( $selected_content as $post ) {
                
                setup_postdata($post);                
            
                $postcounter++;
            
                $doimage = false;
                
                $classattr = genesis_attr( 'entry' );
            
                do_action( 'genesis_before_entry' );
            
                $classattr  = str_replace( 'has-post-thumbnail', '', $classattr );
            
                $permalink  = get_permalink();
                $excerpt    = wp_strip_all_tags( get_the_excerpt( $post ) );
            
                if ( !$excerpt ) {
                  $excerpt = get_the_title();
                }
                $postdate   = '';
                if ( 'post'    == get_post_type() ) {
                    $postdate   = get_the_date( );
                }
                
                printf( '<article %s>', $classattr );
                printf( '<a href="%s"><h3>%s</h3><p>%s</p><p class="meta">%s</p></a>', get_permalink(), get_the_title(), $excerpt, $postdate );
                echo '</article>';
                
                // RESET THE QUERY
                wp_reset_query();
                
                do_action( 'genesis_after_entry' );
            
              }
            }

            echo '</div>';
          }
          elseif ( 'berichten' == $type_block ) {
            // dus $type_block != 'algemeen' && $type_block != 'berichten_paginas'

            $pagetemplate = get_page_template_slug( $theid );

            // eerst even checken of we een contentblock met berichten moeten tonen op een pagina die vanzichzelf al berichten moet tonen
            if ( ( 'page_dossiersingleactueel.php' == $pagetemplate ) ) {

              // ja dus, dubbelop en overbodig

              $user = wp_get_current_user();
              
              if ( in_array( 'edit_pages', (array) $user->allcaps ) ) {
                //The user has capability to edit pages

                echo '<div style="border: 1px solid black; padding: .1em 1em; margin-bottom: 2em;">';
  
                echo '<div class="block">';
  
                if ( $titel ) {
                  echo '<h2>' . $titel . '</h2>';
                }
                else {
                  echo '<h2>' . __( 'Geen titel ingevoerd', 'wp-rijkshuisstijl' ) . '</h2>';
                }
  
                
                echo '<p>' . __( 'Noot voor de redactie', 'wp-rijkshuisstijl' ) . '</p>';
                echo '<p>' . __( 'Je hebt een content-block toegevoegd die berichten zou moeten tonen, maar de functie van deze pagina <em>is</em> het tonen van berichten. Dubbelop, dus.', 'wp-rijkshuisstijl' );
  
                echo '<br><em>' . __( "Deze tekst wordt alleen getoond aan redacteuren die pagina's mogen wijzigen.", 'wp-rijkshuisstijl' ) . '</em></div>';
            
                echo '</div>';
                    
              }
            }
            else {
              // er moet contentblock getoond worden van het type 'berichten'  

              $overviewurl        = '';
              $overviewlinktext   = '';
              $toonlinksindossiercontext = false;

              if ( $dossier_in_content_block ) {
                // we zijn op een dossieroverzicht

                $term             = get_term( $dossier_in_content_block, RHSWP_CT_DOSSIER );
                $currentterm      = $term->term_id;
                $currenttermname  = $term->name;
                $currenttermslug  = $term->slug; 
                $toonlinksindossiercontext = $term;
  
                $currentpage      = get_permalink();
                $currentsite      = get_site_url();
                
                $args = array(
                  'post_type'       => 'post',
                  'post_status'     => 'publish',
                  'posts_per_page'  => $maxnr_posts,
                  'tax_query' => array(
                    array(
                      'taxonomy'  => RHSWP_CT_DOSSIER,
                      'field'     => 'term_id',
                      'terms'     => $currentterm
                    ),
                  )
                );
                
                $overviewlinktext = $dossier_in_content_block;
                  
              }
              else {
                // niet op een dossieroverzicht

                $args = array(
                  'post_type'       => 'post',
                  'post_status'     => 'publish',
                  'posts_per_page'  => $maxnr_posts
                );
              }            
              
              if ( $categoriefilter == 'nee' ) {
  
                $actueelpageid    = get_option( 'page_for_posts' );
                $overviewlinktext = get_the_title( $actueelpageid );
                $overviewurl      = get_permalink( $actueelpageid ); // general page_for_posts
  
              }
              else {
  
                $slugs = array();
                
                if ( $chosen_category ) {
  
                  foreach( $chosen_category as $filter ): 
  
                    $terminfo     = get_term_by( 'id', $filter, 'category' );
                    $slugs[]      = $terminfo->slug;
  
                    $overviewlinktext = $terminfo->name;
                    $actueelpageid    = get_option( 'page_for_posts' );
                    
                    $overviewurl      = get_permalink( $actueelpageid ) . $terminfo->slug . '/'; // page_for_posts
              
                  endforeach;
                  
                  if ( $dossier_in_content_block ) {
                    
                    // filter op dossier
                    $args = array(
                      'post_type' => 'post',
                      'post_status'     => 'publish',
                      'posts_per_page'  => $maxnr_posts,
                      'tax_query' => array(
                        'relation' => 'AND',
                        array(
                          'taxonomy'  => RHSWP_CT_DOSSIER,
                          'field'     => 'term_id',
                          'terms'     => $dossier_in_content_block
                        ),
                        array(
                          'taxonomy'  => 'category',
                          'field'     => 'slug',
                          'terms'     => $slugs,
                        )
                      )
                    );
                    
                    // deze weer leeg maken, want er is niet zoiets als een overview mogelijk voor deze combinatie
                    $overviewlinktext = '';
                    $overviewurl      = '';
                  }
                  else {
  
                    // geen verder filter
                    $args = array(
                      'post_type' => 'post',
                      'post_status'     => 'publish',
                      'posts_per_page'  => $maxnr_posts,
                      'tax_query' => array(
                        array(
                          'taxonomy'  => 'category',
                          'field'     => 'slug',
                          'terms'     => $slugs,
                        )
                      )
                    );
                  }
                } 
              }
              
              // Assign predefined $args to your query
              $sidebarposts = new WP_query();
              $sidebarposts->query($args);
              
              if ( $sidebarposts->have_posts() ) {
  
                echo '<div class="block">';
  
                if ( $titel ) {
                  echo '<h2>' . $titel . '</h2>';
                }
                else {
                  echo '<h2>' . __( 'Geen titel ingevoerd', 'wp-rijkshuisstijl' ) . '</h2>';
                }
  
                $postcounter = 0;
  
                while ($sidebarposts->have_posts()) : $sidebarposts->the_post();
                  $postcounter++;
  
                  $doimage = false;
                  
                  $classattr = genesis_attr( 'entry' );
  
                  do_action( 'genesis_before_entry' );
  
                  if ( 
                    ( ( intval( $with_featured_image ) > 0 && ( $postcounter <= $with_featured_image ) )
                    || ( $with_featured_image == 'alle' ) )
                    && has_post_thumbnail()
                    ) {
                      $doimage = true;
                  }
                  else {
                    $classattr = str_replace( 'has-post-thumbnail', '', $classattr );
                  }
  
                  $theurl     = get_permalink();
                  $excerpt    = wp_strip_all_tags( get_the_excerpt( $post ) );
                  $postdate   = get_the_date( );
                  $title      = get_the_title();
                  
      
                  if ( $currentsite && $currentpage && $toonlinksindossiercontext ) {
                    // aaaaa, what a fuckup.
                    // o holy ToDo: make me use a page for this URL (bug: 

                  if ( is_page() ) {
                  
                    $postpermalink  = '/' . $post->post_name;
                    $theurl         = $currentpage  . RHSWP_DOSSIERPOSTCONTEXT . $postpermalink;

                  }
                  elseif ( is_tax( RHSWP_CT_DOSSIER ) ) {
                  
                    $postpermalink  = get_term_link( $toonlinksindossiercontext );
                    $postpermalink  = str_replace( $currentsite, '', $postpermalink);

                    $postpermalink  = '/' . $post->post_name;
                    $crumb          = str_replace( $currentsite, '', $currentpage);
                    $theurl         = get_term_link( $toonlinksindossiercontext )  . RHSWP_DOSSIERPOSTCONTEXT . $postpermalink;
                  
                  }
        
                  }
                  else {
                    $theurl         = get_the_permalink();
                  }
  
              		
  
                  printf( '<article %s>', $classattr );
  
                  if ( $doimage ) {
                    printf( '<div class="article-container"><div class="article-visual">%s</div>', get_the_post_thumbnail( $post->ID, 'article-visual' ) );
                    printf( '<div class="article-excerpt"><a href="%s"><h3>%s</h3><p>%s</p><p class="meta">%s</p></a></div></div>', $theurl, $title, $excerpt, $postdate );
                  }
                  else {
                    printf( '<a href="%s"><h3>%s</h3><p>%s</p><p class="meta">%s</p></a>', $theurl, $title, $excerpt, $postdate );
                  }
  
  
                  if ( WP_DEBUG && SHOW_CSS_DEBUG ) {
                    dodebug('Check category & dossier:');
                    the_category( ', ' ); 
                    dodebug(get_the_term_list( $post->ID, RHSWP_CT_DOSSIER, 'Dossiers: ', ', ' ) );  
                  }
  
                  
                  echo '</article>';
                  
                  do_action( 'genesis_after_entry' );
  
                endwhile;
  
                if ( $overviewurl && $overviewlinktext ) {
                  echo '<p class="more"><a href="'.$overviewurl.'">' . $overviewlinktext . '</a></p>';
                }
  
                echo '</div>';
                
              }
              else {
  
                $user = wp_get_current_user();
                
                if ( in_array( 'edit_pages', (array) $user->allcaps ) ) {
                  //The user has capability to edit pages
  
  
                  echo '<div style="border: 1px solid black; padding: .1em 1em; margin-bottom: 2em;">';
  
                  echo '<div class="block">';
    
                  if ( $titel ) {
                    echo '<h2>' . $titel . '</h2>';
                  }
                  else {
                    echo '<h2>' . __( 'Geen titel ingevoerd', 'wp-rijkshuisstijl' ) . '</h2>';
                  }
  
                  echo '<p>' . __( 'Noot voor de redactie', 'wp-rijkshuisstijl' ) . '</p>';
                  echo '<p>' . __( 'Er is een content-block met berichten toegevoegd aan deze pagina, maar hiervoor zijn geen berichten gevonden.', 'wp-rijkshuisstijl' ) ;
                  dovardump($args);
                  echo '<br><em>' . __( "Deze tekst wordt alleen getoond aan redacteuren die pagina's mogen wijzigen.", 'wp-rijkshuisstijl' ) . '</em></div>';
              
                  echo '</div>';
  
                }  
                
              }
              // RESET THE QUERY
              wp_reset_query();
      
            }

          }
          elseif ( 'select_dossiers' == $type_block ) {

            if ( $select_dossiers_list ) {
              
              echo '<div class="block">';
                          
              if ( $titel ) {
                echo '<h2>' . $titel . '</h2>';
              }
              
              $terms = get_terms( RHSWP_CT_DOSSIER, array(
                'hide_empty' => false,
                'include'   => $select_dossiers_list
              ) );
                  
              if ($terms && ! is_wp_error( $terms ) ) {       
                foreach ( $terms as $term ) {
              
                  $excerpt    = '';
                  $classattr  = 'class="dossieroverzicht"';
                  if ( $term->description ) {
                    $excerpt  =  $term->description;
                  }
                  $href       = get_term_link( $term->term_id, RHSWP_CT_DOSSIER );
                  $excerpt    = wp_strip_all_tags( $excerpt );                    
                  
                  printf( '<article %s>', $classattr );
                  printf( '<a href="%s"><h3>%s</h3><p>%s</p></a>', $href, $term->name, $excerpt );
                  echo '</article>';
                }
              }

              echo '</div>';

              // RESET THE QUERY
              wp_reset_query();
              
            }

          }
          else {
            if ( $titel ) {
              echo '<h2>' . $titel . ' / ' . $type_block . '</h2>';
            }
            else {
              echo '<h2>' . __( 'Geen titel ingevoerd', 'wp-rijkshuisstijl' ) . ' / ' . $type_block . '</h2>';
            }
          }
        }
      }
      else {
        dodebug('geen blokken gevonden');
      }
    }
  }
}

//========================================================================================================

function rhswp_caroussel_checker() {
  
  global $post;
  
  
  if ( function_exists( 'get_field' ) ) {

    $carousselcheck = '';

    if ( is_page() ) {
      $theid          = get_the_ID();
      $carousselcheck = get_field('carrousel_tonen_op_deze_pagina', $theid );
    }
    elseif ( is_tax( RHSWP_CT_DOSSIER ) ) {
      $theid          = RHSWP_CT_DOSSIER . '_' . get_queried_object()->term_id;
      $carousselcheck = get_field('carrousel_tonen_op_deze_pagina', $theid );
      $currentterm    = get_queried_object()->term_id;
    }

   

    if ( 'ja' == $carousselcheck ) {
      
      $getcarousel      = get_field('kies_carrousel', $theid );
      $carouselid       = 0;

      if ( is_object( $getcarousel ) ) {
        $carouselid       = $getcarousel->ID;
        $carouseltitle    = $getcarousel->post_title;
        $carrousel_items  = get_field( 'carrousel_items', $carouselid );
      }


      if( have_rows('carrousel_items', $carouselid ) ) {

        $itemcounter = 'items' . count( $carrousel_items ) ;

        echo '<div class="slider" role="complementary">';
        echo '<div class="wrap">';

        echo '<p class="visuallyhidden">' . $carouseltitle . '</p>';
        echo '<p class="slidenav" id="slidenavid">&nbsp;</p>';   	
        
        echo '<ul class="carousel ' . $itemcounter . '" id="carousel" data-slidecount="' . $itemcounter . '">';


        $slidecounter = 0;

        foreach( $carrousel_items as $row ) {
          
          $slidecounter++;
          
          $link_img_start       = '';
          $link_end             = '';
          $slide_link_start     = '';         
          $slide_link_end       = ''; 
          $slide_caption_start  = '<div class="caption">';   	
          $slide_caption_end    = '</div>';   	

          $image    = $row[ 'carrousel_item_photo' ];
          $titel    = esc_html( $row[ 'carrousel_item_title' ] );
          $text     = esc_html( $row[ 'carrousel_item_short_text' ] );
          $type     = $row[ 'carrousel_item_link_type' ];
          $link     = $row[ 'carrousel_item_link_page' ];
          $dossier  = $row[ 'carrousel_item_link_dossier' ];
          $size     = 'Carrousel (full width: 1200px wide)';

          $selected = '';
          
          if ( $slidecounter == 1 ) {
            $selected = ' class="slide selected"';
          }
          else {
            $selected = ' class="slide"';
          }
          
          echo '<li' . $selected . '>';   	
          
          if ( $link && $type == 'pagina' ) {
            $linkid         = array_pop($link);
            $link_img_start     = '<a href="' . get_permalink( $linkid ) . '" tabindex="-1" class="img-container">';   	
            $link_end           = '</a>';

            $slide_link_start = '<a href="' . get_permalink( $linkid ) . '">';   	
            $slide_link_end   = '</a>';   	
          }
          elseif ( $dossier && $type == 'dossier' ) {
            $link_img_start     = '<a href="' . get_term_link( $dossier ) . '" tabindex="-1" class="img-container">';   	
            $link_end           = '</a>';

            $slide_link_start = '<a href="' . get_term_link( $dossier ) . '">';   	
            $slide_link_end   = '</a>';   	

          }
          else {
            $link_img_start     = '<span class="img-container">';   	
            $link_end           = '</span>';

          }



          if ( $image ) {
            $thumb  = $image['sizes'][ $size ];
            $width  = $image['sizes'][ $size . '-width' ];
            $height = $image['sizes'][ $size . '-height' ];


            echo $slide_link_start;   		

            if ( $titel || $text ) {
  

              echo $slide_caption_start;   		
              

              if ( $titel ) {
                echo '<h2 class="caption-title">' .  $titel . '</h2>';   		
              }

              if ( $text ) {
                echo '<p class="caption-text">' .  $text . '</p>';   		
              }

//            echo $link_img_start;   		
//            echo $link_end;   		


            echo $slide_caption_end;   		

            
            }

            echo '<img src="' . $thumb . '" alt="Bekijk de pagina ' . $titel . '" width="' . $width . '" height="' . $height . '" />';

            echo $slide_link_end;   		


          }
            
          
          echo '</li>';   	
          
        }        

        echo '</ul></div></div>';
        
      }
    }
  }  
}

//========================================================================================================

function be_remove_image_alignment( $attributes ) {
  $attributes['class'] = str_replace( 'has-post-thumbnail', '', $attributes['class'] );
	return $attributes;
}

//========================================================================================================

/** Code for custom loop */
function rhswp_archive_custom_loop() {
  // code for a completely custom loop
  global $post;
  
  if ( have_posts() ) {

    echo '<div class="block no-top">';
    
    $postcounter = 0;
  
    while (have_posts()) : the_post();
      $postcounter++;
  
      $permalink    = get_permalink();
      $excerpt      = wp_strip_all_tags( get_the_excerpt( $post ) );
      $postdate     = get_the_date( );
      $doimage      = false;
      $classattr    = genesis_attr( 'entry' );
      $contenttype  = get_post_type();
      $current_post_id  = isset( $post->ID  ) ? $post->ID : 0;
      $cssid        = 'image_featured_image_post_' . $current_post_id;



      if ( $postcounter <= RHSWP_NR_FEAT_IMAGES && has_post_thumbnail( $post->ID ) ) {
        $doimage    = true;
      } 
      else {
        $classattr = str_replace( 'has-post-thumbnail', '', $classattr );
      }

      $toonitem = true;

      if ( is_tax( RHSWP_CT_DOSSIER ) ) {

        $pagetemplateslug = basename( get_page_template_slug( $current_post_id ) );

        $selectposttype   = '';
        $checkpostcount   = false;

        $currentID        = get_queried_object()->term_id;
        $term             = get_term( $currentID, RHSWP_CT_DOSSIER );

        if ( 'page_dossiersingleactueel.php' == $pagetemplateslug ) {
          $selectposttype = 'post';
          $checkpostcount = true;
        }    
        elseif ( 'page_dossier-document-overview.php' == $pagetemplateslug ) {
          $selectposttype = RHSWP_CPT_DOCUMENT;
          $checkpostcount = true;
        }    
        elseif ( 'page_dossier-events-overview.php' == $pagetemplateslug ) {
          $selectposttype = RHSWP_CPT_EVENT;
          $checkpostcount = true;
        }    
        
        // is deze pagina al de overzichtspagina?
        if ( function_exists( 'get_field' ) ) {
  
          $dossier_overzichtpagina  = get_field('dossier_overzichtpagina', $term );

          if ( $dossier_overzichtpagina->ID == $current_post_id ) {
            $checkpostcount = false;
            $toonitem = false;
          }
        }

        // IS GEPUBLICEERD?
        if ( get_post_status( $post->ID ) != 'publish' ) {
          $toonitem = false;
        }
        if ( 'page_dossiersingleactueel.php' == $pagetemplateslug ) {
          $toonitem = false;
        }
        
        if ( $selectposttype && $checkpostcount ) {


        
          $argsquery = array(
            'post_type' => $selectposttype,
            'tax_query' => array(
              'relation' => 'AND',
              array(
                'taxonomy' => RHSWP_CT_DOSSIER,
                'field' => 'term_id',
                'terms' => $term->term_id
              )
            )
          );

          $wp_query = new WP_Query( $argsquery );
        
          if( $wp_query->have_posts() ) {
            if ( $wp_query->post_count > 0 ) {
            }
            else {
              $toonitem = false;
            }
          }
          else {
            $toonitem = false;
          }
          
          // RESET THE QUERY
          wp_reset_query();
        }
      }
  
      if ( $toonitem ) {
    
        if ( is_search() ) {
  
          $theurl       = get_permalink();
          $thetitle     = rhswp_filter_alternative_title( get_the_id(), get_the_title() );
          $documenttype = rhswp_translateposttypes( $contenttype );
          
          if ( 'post' == $contenttype ) {
            
            $documenttype .= '<span class="post-date">' . get_the_date() . '</span>';          
          }
          if ( 'attachment' == $contenttype ) {
            
            $theurl       = wp_get_attachment_url( $post->ID );
            $parent_id    = $post->post_parent;
            $excerpt      = wp_strip_all_tags( get_the_excerpt( $parent_id ) );
  
            $mimetype     = get_post_mime_type( $post->ID ); 
            $thetitle     = rhswp_filter_alternative_title( $parent_id, get_the_title( $parent_id ) );
  
            $filesize     = filesize( get_attached_file( $post->ID ) );
            
            if ( $mimetype ) {
              $typeclass = explode('/', $mimetype);
  
              $classattr = str_replace( 'class="', 'class="attachment ' . $typeclass[1] . ' ', $classattr );
  
              if ( $filesize ) {
                $documenttype = rhswp_translatemimetypes( $mimetype ) . ' (' . human_filesize($filesize) . ')';
              }
              else {
                $documenttype = rhswp_translatemimetypes( $mimetype );
              }
  
            }
          }
  
          printf( '<article %s>', $classattr );
          printf( '<a href="%s"><h3>%s</h3><p>%s</p><p class="meta">%s</p></a>', $theurl, $thetitle, $excerpt, $documenttype );
  
  
        } 
        else {

          if ( ! ( 'page' == get_post_type( $post->ID ) ) ) {
            $thetitle     = get_the_title( get_the_id() );
          }
          else {
            $thetitle     = rhswp_filter_alternative_title( get_the_id(), get_the_title( get_the_id() ) );
          }
  
          printf( '<article %s>', $classattr );
          
          if ( $doimage ) {
//            printf( '<div class="article-container"><div class="article-visual">%s</div>', get_the_post_thumbnail( $post->ID, 'featured-post-widget' ) );
            printf( '<div class="article-container"><div class="article-visual" id="%s">&nbsp;</div>', $cssid );
            printf( '<div class="article-excerpt"><a href="%s"><h3>%s</h3><p>%s</p><p class="meta">%s</p></a></div></div>', get_permalink(), $thetitle, $excerpt, $postdate );
          }
          else {
            if ( ! ( 'post' == get_post_type( $post->ID ) ) ) {
              printf( '<a href="%s"><h3>%s</h3><p>%s</p></a>', get_permalink(), $thetitle, $excerpt );
            }
            else {
              printf( '<a href="%s"><h3>%s</h3><p>%s</p><p class="meta">%s</p></a>', get_permalink(), $thetitle, $excerpt, $postdate );
            }
          }
  
        } 
  
        echo '</article>';
      }

      do_action( 'genesis_after_entry' );
  
    endwhile;
  
    echo '</div>';

    wp_reset_query();        

  }
}

//========================================================================================================

function rhswp_translateposttypes( $posttype = '' ) {
  $returnstring = '';
  
  switch ($posttype) {
    case 'post':
      $returnstring = __( "Bericht", 'wp-rijkshuisstijl' );
      break;
    case 'page':
      $returnstring = __( "Pagina", 'wp-rijkshuisstijl' );
      break;
    case RHSWP_CT_DOSSIER:
      $returnstring = __( "Dossier", 'wp-rijkshuisstijl' );
      break;
    case 'attachment':
      $returnstring = __( "Document", 'wp-rijkshuisstijl' );
      break;
    case RHSWP_CPT_DOCUMENT:
      $returnstring = __( "Document", 'wp-rijkshuisstijl' );
      break;
    case RHSWP_CPT_EVENT:
      $returnstring = __( "Agenda", 'wp-rijkshuisstijl' );
      break;
    case RHSWP_CPT_SLIDER:
      $returnstring = __( "Deze hoort hier niet tussen", 'wp-rijkshuisstijl' );
      break;
    break;
      default:
      $returnstring = $posttype;
  }  


  return $returnstring;
  
}

//========================================================================================================
function rhswp_translatemimetypes( $posttype = '' ) {
  $returnstring = '';
  
  switch ($posttype) {
    case 'image/jpeg':
    case 'image/png':
    case 'image/gif':
      $returnstring = __( "Plaatje", 'wp-rijkshuisstijl' );
      break;
    case 'text/csv':
    case 'text/plain': 
    case 'text/xml':
      $returnstring = __( "Tekstbestand", 'wp-rijkshuisstijl' );
      break;
    case 'video/mpeg':
    case 'video/mp4': 
    case 'video/quicktime':
      $returnstring = __( "Filmbestand", 'wp-rijkshuisstijl' );
      break;
    case 'application/pdf':
      $returnstring = __( "PDF-bestand", 'wp-rijkshuisstijl' );
      break;
    default:
      $returnstring = __( "Document", 'wp-rijkshuisstijl' );
      break;
  }  


  return $returnstring;
  
}

//========================================================================================================

function rhswp_filter_input_string( $string ) {

  $text = htmlspecialchars( $string );

  $text = preg_replace("/</", "-", $text);
  $text = preg_replace("/>/", "-", $text);
  $text = preg_replace("/script/", "ja doei", $text);
  $text = preg_replace("/username/i", " *zucht* ", trim($text));
  $text = preg_replace("/password/i", " *gaap* ", trim($text));
  $text = preg_replace("/;DROP /i", " *snurk* ", trim($text));
  $text = preg_replace("/select /i", " *fart* ", trim($text));
  $text = preg_replace("/ table /i", " *pfffffrt* ", trim($text));
  
  return $text;

}

//========================================================================================================

add_filter ( 'genesis_next_link_text' , 'rhswp_paging_next' );
function rhswp_paging_next ( $text ) {
	if ( is_category() ) {
	    return __( "Oudere berichten", 'wp-rijkshuisstijl' );
    }
    else {
	    return __( "Volgende pagina", 'wp-rijkshuisstijl' );
    }
}

//========================================================================================================

add_filter ( 'genesis_prev_link_text' , 'rhswp_paging_previous' );
function rhswp_paging_previous ( $text ) {
	if ( is_category() ) {
	    return __( "Nieuwere berichten", 'wp-rijkshuisstijl' );
    }
    else {
	    return __( "Vorige pagina", 'wp-rijkshuisstijl' );
    }
}

//========================================================================================================

function human_filesize($bytes, $decimals = 1) {
  $sz = 'BkMGTP';
  $factor = floor((strlen($bytes) - 1) / 3);
  $humanreadable = ( sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor] );
  $humanreadable = str_replace( '.', ',', $humanreadable );

  return $humanreadable . 'B';
}

//========================================================================================================

add_action( 'genesis_entry_content', 'rhswp_single_add_featured_image', 9 );

function rhswp_single_add_featured_image() {
  global $post;
// has-post-thumbnail
  if ( ( is_single() && ( 'post' == get_post_type() ) || (  'page' == get_post_type()  ) ) && ( has_post_thumbnail() ) && ( !is_front_page() && !is_home() ) ) {


    $theimageobject = get_post(get_post_thumbnail_id());

    $get_description = $theimageobject->post_excerpt;


    if(!empty( $theimageobject->post_excerpt )){//If description is not empty show the div
      echo '<div class="wp-caption alignright">';
    }
    else {
      echo '<div class="featured alignright">';
    }
    
    echo get_the_post_thumbnail( $post->ID, 'article-visual', array( 'class' => 'alignright' ) );

    if(!empty( $theimageobject->post_excerpt )){
      echo '<p class="wp-caption-text">' . $theimageobject->post_excerpt . '</p>';
    }

    echo '</div>';
      
  }
}

//========================================================================================================

add_action( 'pre_get_posts', 'rhswp_modify_query_for_dossieroverview' );

/**
 * Filter the list of content to be shown on the dossier overview
 * 
 * @param object $query data
 *
 */
function rhswp_modify_query_for_dossieroverview( $query ) {
	
	if( $query->is_main_query() && !is_admin() && is_tax( RHSWP_CT_DOSSIER ) ) {
  	
    // remove all posts that are marked 'private'
    $query->set( 'perm', 'readable' );
    return $query;
		
	}
}

//========================================================================================================

add_action( 'genesis_meta', 'rhswp_add_touch_icons' );

function rhswp_add_touch_icons() {
	echo '<link rel="icon" sizes="192x192" href="' . RHSWP_THEMEFOLDER . '/images/touch-icon.png"/>
<link rel="apple-touch-icon" href="' . RHSWP_THEMEFOLDER . '/images/apple-touch-icon.png" />';

}

//========================================================================================================

add_action( 'send_headers', 'rhswp_set_hsts_policy' );
/**
 * Enables the HTTP Strict Transport Security (HSTS) header.
 *
 * @since 1.0.0
 */
function rhswp_set_hsts_policy() {
 
  // 2 year expiration: 63072000
  header( 'Strict-Transport-Security: max-age=63072000; includeSubDomains; preload' );

 
}

//========================================================================================================

add_action( 'wp_enqueue_scripts', 'rhswp_add_blog_archive_css' );

function rhswp_add_blog_archive_css() {

  global $imgbreakpoints;

  $blogberichten_css   = ".entry-content a:not([href*=\"" . $_SERVER["HTTP_HOST"] . "\"]) {    
    padding-right: 1em;
    background-image: url('" . RHSWP_THEMEFOLDER . "/images/icon-external-link.svg');
    background-repeat: no-repeat;
    background-position: right center;
    background-size: .75em .75em;
  }";
  
  $countertje   = 0;

  if ( have_posts() ) : 
  
  
    while ( have_posts() ) : the_post();
  
      // do loop stuff
      $countertje++;
      $getid        = get_the_ID();
      $the_image_ID = 'image_featured_image_post_' . $getid;
  
      if ( $countertje <= RHSWP_NR_FEAT_IMAGES && has_post_thumbnail( $getid ) ) {

        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $getid ), 'full' );
  
        if ( $image[0] ) {
          $blogberichten_css .= '#' . $the_image_ID . " { ";
          $blogberichten_css .= "background-image: url('" . $image[0] . "'); ";
          $blogberichten_css .= "} ";
        }
      }
    
    endwhile; /** end of one post **/

  else : /** if no posts exist **/

  endif; /** end loop **/

  wp_enqueue_style( RHSWP_ARCHIVE_CSS, RHSWP_THEMEFOLDER . '/css/featured-background-images.css', array(), CHILD_THEME_VERSION, 'screen and (min-width: 650px)' );

  if ( $blogberichten_css ) {
    wp_add_inline_style( RHSWP_ARCHIVE_CSS, $blogberichten_css );
  }
    



}

//========================================================================================================

