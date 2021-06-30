<?php
/**
 * Rijkshuisstijl (Digitale Overheid) - functions.php
 * ----------------------------------------------------------------------------------
 * Zonder functions geen functionaliteit, he?
 * ----------------------------------------------------------------------------------
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 2.27.2
 * @desc.   Styling voor los evenement aangepast.
 * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */
//========================================================================================================
// Start Genesis engine
include_once( get_template_directory() . '/lib/init.php' );
//========================================================================================================
// Constants
define( 'CHILD_THEME_NAME', "Rijkshuisstijl (Digitale Overheid)" );
define( 'CHILD_THEME_VERSION', "2.27.2" );

// TODO
define( 'WP_DEBUG_FULL_WIDTH', true );
//define( 'WP_DEBUG_FULL_WIDTH', false );

if ( WP_DEBUG ) {
	define( 'DO_MINIFY_JS', false );
//	define( 'DO_MINIFY_JS', true );
} else {
	define( 'DO_MINIFY_JS', false );
//	define( 'DO_MINIFY_JS', true );
}
if ( WP_DEBUG ) {
	define( 'WP_LOCAL_DEV', false );
//	define( 'WP_LOCAL_DEV', true );
	define( 'SHOW_CSS_DEBUG', false );
//	define( 'SHOW_CSS_DEBUG', true );
	define( 'WP_DEBUG_SHOWTEXTLENGTH', false );
//	define( 'WP_DEBUG_SHOWTEXTLENGTH', true );
} else {
	define( 'WP_LOCAL_DEV', false );
	define( 'SHOW_CSS_DEBUG', false );
	define( 'WP_DEBUG_SHOWTEXTLENGTH', false );
}
define( 'ID_ZOEKEN', 'rhswp-searchform-nav-primary' );
define( 'RHSWP_NO', 'socmed_nee' );
define( 'RHSWP_YES', 'socmed_ja' );
$siteURL = get_stylesheet_directory_uri();
$siteURL = preg_replace( '|https://|i', '//', $siteURL );
$siteURL = preg_replace( '|http://|i', '//', $siteURL );
define( 'RHSWP_THEMEFOLDER', $siteURL );
$sharedfolder = get_stylesheet_directory();
$sharedfolder = preg_replace( '|genesis|i', 'wp-rijkshuisstijl', $sharedfolder );
define( 'RHSWP_FOLDER', $sharedfolder );
define( 'RHSWP_LINK_CPT', 'links' );
define( 'CTAX_contentsoort', 'contentsoort' );
define( 'CTAX_thema', 'CTAX_thema' );
define( 'RHSWP_HOME_WIDGET_AREA', 'home-widget-area' );
define( 'RHSWP_NORESULT_WIDGET_AREA', 'noresult-widget-area' );
define( 'RHSWP_SINGLE_FOOTER_WIDGET_AREA', 'sidebar-alt' );
define( 'RHSWP_SITEMAP_WIDGET_AREA', 'sitemap-widget-area' );
define( 'RHSWP_PREFIX_TAG_CAT', 'rhswp_dossier_select_tag_category' );
define( 'RHSWP_CMB2_TAG_FIELD', 'select_tag' );
define( 'RHSWP_CMB2_TXT_FIELD', 'select_txt' );
define( 'DO_SEPARATOR', ' | ' );
if ( ! defined( 'RHSWP_CT_DOSSIER' ) ) {
	define( 'RHSWP_CT_DOSSIER', 'dossiers' );   // slug for custom taxonomy 'dossier'
}
if ( ! defined( 'RHSWP_CPT_DOCUMENT' ) ) {
	define( 'RHSWP_CPT_DOCUMENT', 'document' );   // slug for custom taxonomy 'document'
}
if ( ! defined( 'RHSWP_CPT_EVENT' ) ) {
	define( 'RHSWP_CPT_EVENT', 'event' );      // slug for custom taxonomy 'document'
}
if ( ! defined( 'RHSWP_CPT_SLIDER' ) ) {
	define( 'RHSWP_CPT_SLIDER', 'slidertje' );  // slug for custom taxonomy 'dossier'
}
if ( ! defined( 'RHSWP_CT_DIGIBETER' ) ) {
	define( 'RHSWP_CT_DIGIBETER', 'beleidsterreinen' );   // custom taxonomy for digitale agenda
}
if ( ! defined( 'RHSWP_ADMIN_STREAMER_CSS' ) ) {
	define( 'RHSWP_ADMIN_STREAMER_CSS', 'adminstreamercss' ); // ID for admin streamer CSS
}
if ( ! defined( 'RHSWP_PULLQUOTE_WITH_IMAGE' ) ) {
	define( 'RHSWP_PULLQUOTE_WITH_IMAGE', 'pullquote-with-image' );
}
if ( ! defined( 'RHSWP_SIMPLE_PULLQUOTE' ) ) {
	define( 'RHSWP_SIMPLE_PULLQUOTE', 'simple-pullquote' );
}
if ( ! defined( 'RHSWP_HEADER_CARROUSEL_CONFIRM' ) ) {
	define( 'RHSWP_HEADER_CARROUSEL_CONFIRM', 'ja' );
}
if ( ! defined( 'RHSWP_HEADER_IMAGE_CONFIRM' ) ) {
	define( 'RHSWP_HEADER_IMAGE_CONFIRM', 'show_header_image' );
}
if ( ! defined( 'RHSWP_WIDGET_BANNER' ) ) {
	define( 'RHSWP_WIDGET_BANNER', '(DO) banner' );
}
if ( ! defined( 'RHSWP_WIDGET_PAGELINKS_DESC' ) ) {
	define( 'RHSWP_WIDGET_PAGELINKS_DESC', '(DO) paginalinks' );
}
if ( ! defined( 'RHSWP_WIDGET_PAGELINKS_ID' ) ) {
	define( 'RHSWP_WIDGET_PAGELINKS_ID', 'rhswp_pagelinks_widget' );
}
if ( ! defined( 'RHSWP_WIDGET_LINK_TO_SINGLE_PAGE' ) ) {
	define( 'RHSWP_WIDGET_LINK_TO_SINGLE_PAGE', '(DO) verwijs naar een pagina' );
}
if ( ! defined( 'RHSWP_CTA_WIDGET' ) ) {
	define( 'RHSWP_CTA_WIDGET', '(DO) CTA - Call To Action widget' );
}
if ( ! defined( 'RHSWP_WIDGET_SOCIALMEDIA' ) ) {
	define( 'RHSWP_WIDGET_SOCIALMEDIA', '(DO) socialmedia-links' );
}
if ( ! defined( 'RHSWP_CSS_BANNER' ) ) {
	define( 'RHSWP_CSS_BANNER', 'banner-css' ); // slug for custom post type 'document'
}
if ( ! defined( 'RHSWP_WIDGET_NAVIGATIONMENU' ) ) {
	define( 'RHSWP_WIDGET_NAVIGATIONMENU', '(DO) navigation menu' );
}
if ( ! defined( 'RHSWP_DOSSIERPOSTCONTEXT' ) ) {
	define( 'RHSWP_DOSSIERPOSTCONTEXT', 'dossierpostcontext' );
}
if ( ! defined( 'RHSWP_DOSSIEREVENTCONTEXT' ) ) {
	define( 'RHSWP_DOSSIEREVENTCONTEXT', 'dossiereventcontext' );
}
if ( ! defined( 'RHSWP_DOSSIERDOCUMENTCONTEXT' ) ) {
	define( 'RHSWP_DOSSIERDOCUMENTCONTEXT', 'dossierdocumentcontext' );
}
if ( defined( 'RHSWP_DOSSIERPOSTCONTEXT' ) && defined( 'CHILD_THEME_VERSION' ) ) {
	define( 'RHSWP_DOSSIERPOSTCONTEXT_OPTION', RHSWP_DOSSIERPOSTCONTEXT . CHILD_THEME_VERSION );
}
// voor de planningtool-plugin (ictuwp-plugin-planningtool)
if ( ! defined( 'DOPT__ACTIELIJN_CPT' ) ) {
	define( 'DOPT__ACTIELIJN_CPT', "actielijn" );
}
if ( ! defined( 'DOPT__GEBEURTENIS_CPT' ) ) {
	define( 'DOPT__GEBEURTENIS_CPT', "gebeurtenis" );
}
define( 'RHSWP_DOSSIERPOSTCONTEXT_OPTION_DO_FLUSH', false );
//define( 'RHSWP_DOSSIERPOSTCONTEXT_OPTION_DO_FLUSH', true );
define( 'RHSWP_NR_FEAT_IMAGES', 2 ); // max number of posts with featured images on archive pages
define( 'RHSWP_ARCHIVE_CSS', 'featured-images' );
define( 'RHSWP_FOOTERWIDGET1', 'footer-1' );
define( 'RHSWP_FOOTERWIDGET2', 'footer-2' );
define( 'RHSWP_FOOTERWIDGET3', 'footer-3' );
define( 'RHSWP_MIN_HERO_IMAGE_WIDTH', 1500 );
define( 'RHSWP_MIN_HERO_IMAGE_HEIGHT', 400 );
define( 'RHSWP_HERO_IMAGE_WIDTH_NAME', 'Carrousel (full width: ' . RHSWP_MIN_HERO_IMAGE_WIDTH . ' wide)' );
define( 'RHSWP_HERO_IMAGE2_WIDTH_NAME', RHSWP_MIN_HERO_IMAGE_WIDTH . 'w' );
if ( ! defined( 'RHSWP_DOSSIERCONTEXTPOSTOVERVIEW' ) ) {
	define( 'RHSWP_DOSSIERCONTEXTPOSTOVERVIEW', 'dossier-berichten' );
}
if ( ! defined( 'RHSWP_DOSSIERCONTEXTCATEGORYPOSTOVERVIEW' ) ) {
	define( 'RHSWP_DOSSIERCONTEXTCATEGORYPOSTOVERVIEW', 'dossier-categorie' );
}
if ( ! defined( 'RHSWP_DOSSIERCONTEXTEVENTOVERVIEW' ) ) {
	define( 'RHSWP_DOSSIERCONTEXTEVENTOVERVIEW', 'dossier-events' );
}
if ( ! defined( 'RHSWP_DOSSIERCONTEXTDOCUMENTOVERVIEW' ) ) {
	define( 'RHSWP_DOSSIERCONTEXTDOCUMENTOVERVIEW', 'dossier-documenten' );
}
if ( ! defined( 'DOPT__ACTIELIJN_CPT' ) ) {
	define( 'DOPT__ACTIELIJN_CPT', "actielijn" );
}
// @since 2.12.17
define( 'ID_DOSSIER_DIV', "dossier-overview" );
// @since 2.16.1.g
if ( ! defined( 'RHSWP_CPT_VERWIJZING' ) ) {
	define( 'RHSWP_CPT_VERWIJZING', 'externeverwijzing' );
}
// constants for styling
define( 'DEFAULTFLAVOR', 'groen' );
define( 'FLAVORSCONFIG', 'config/flavors_config.json' );
define( 'IMAGESIZE_5x3', 'image-5x3' );
define( 'IMAGESIZE_5x3_SMALL', 'image-5x3-small' );
define( 'IMAGESIZE_10x3', 'image-4x3' );
define( 'IMAGESIZE_10x3_SMALL', 'image-4x3-small' );
define( 'IMAGESIZE_SQUARE', 'image-square' );
define( 'IMAGESIZE_SQUARE_SMALL', 'image-square-small' );


//========================================================================================================
//* Remove the edit link
add_filter( 'genesis_edit_post_link', '__return_false' );
//========================================================================================================
add_image_size( 'Carrousel (preview: 400px wide)', 400, 200, false );
add_image_size( RHSWP_HERO_IMAGE_WIDTH_NAME, RHSWP_MIN_HERO_IMAGE_WIDTH, RHSWP_MIN_HERO_IMAGE_HEIGHT, false );
add_image_size( RHSWP_MIN_HERO_IMAGE_WIDTH . 'w', RHSWP_MIN_HERO_IMAGE_WIDTH, 9999, false );
add_image_size( 'featured-post-widget', 400, 250, false );
add_image_size( 'grid-half', 350, 350, true );
add_image_size( 'article-visual', 400, 400, true );
add_image_size( 'widget-image', 100, 100, false );
add_image_size( 'widget-image-top', 400, 1200, false );
add_image_size( 'nieuwsbriefthumb', 88, 88, false );
add_image_size( 'article-visual-big', 600, 600, true );
$docrop     = true;
$base_width = 900;
add_image_size( IMAGESIZE_SQUARE, $base_width, $base_width, $docrop );
$base_height = ( ( $base_width / 5 ) * 3 );
add_image_size( IMAGESIZE_5x3, $base_width, $base_height, $docrop );
$base_width  = 1200;
$base_height = ( ( $base_width / 10 ) * 3 );
add_image_size( IMAGESIZE_10x3, $base_width, $base_height, $docrop );
// SMALL VERSIONS
$base_width = 400;
add_image_size( IMAGESIZE_SQUARE_SMALL, $base_width, $base_width, $docrop );
$base_height = ( ( $base_width / 5 ) * 3 );
add_image_size( IMAGESIZE_5x3_SMALL, $base_width, $base_height, $docrop );

//========================================================================================================
//* Add new image sizes to post or page editor
add_filter( 'image_size_names_choose', 'rhswp_add_imagesize_to_editor' );
function rhswp_add_imagesize_to_editor( $sizes ) {
	$mythemesizes = array(
		'nieuwsbriefthumb' => __( 'IMG nieuwsletter size', 'wp-rijkshuisstijl' ),
	);
	$sizes        = array_merge( $sizes, $mythemesizes );

	return $sizes;
}

//========================================================================================================
// Include for javascript check
include_once( RHSWP_FOLDER . '/includes/nojs.php' );
// Include for CMB2 extra fields
include_once( RHSWP_FOLDER . '/includes/metadata-boxes.php' );
// Include for admin functions
include_once( RHSWP_FOLDER . '/includes/aux-admin-helper-functions.php' );
// Include for dossier functions
include_once( RHSWP_FOLDER . '/includes/aux-dossier-helper-functions.php' );
// Include for contact form 7 validation
include_once( RHSWP_FOLDER . '/includes/contact-form7-validation.php' );
// Include for event manager
include_once( RHSWP_FOLDER . '/includes/event-manager-functions.php' );
// Include for searchWP
include_once( RHSWP_FOLDER . '/includes/search-helper-functions.php' );
if ( 'accept.digitaleoverheid.nl' == $_SERVER["HTTP_HOST"] ) {
	include_once( RHSWP_FOLDER . '/includes/search-helper-basic-http.php' );
}
// Skiplinks
include_once( RHSWP_FOLDER . '/includes/skip-links.php' );
// Menu & header
include_once( RHSWP_FOLDER . '/includes/menu-header.php' );
// Extra filters for Event Manager
// @since 2.12.21
include_once( RHSWP_FOLDER . '/includes/aux-eventmanager-helper-functions.php' );

include_once( RHSWP_FOLDER . '/includes/aux-archives-functions.php' );


//========================================================================================================
// Include to alter the dossier taxonomy on pages: use radiobuttons instead of checkboxes.
include_once( RHSWP_FOLDER . '/includes/class.taxonomy-single-term.php' );
$custom_tax_mb = new Taxonomy_Single_Term( RHSWP_CT_DOSSIER, array( 'page' ) );
// Custom title for this metabox
$custom_tax_mb->set( 'metabox_title', __( 'Topics', 'wp-rijkshuisstijl' ) );
// Will keep radio elements from indenting for child-terms.
$custom_tax_mb->set( 'indented', true );
// Allows adding of new terms from the metabox
$custom_tax_mb->set( 'allow_new_terms', true );
// Priority of the metabox placement.
$custom_tax_mb->set( 'priority', 'low' );
// Do the same for beleidskleuren
$custom_tax_mb = new Taxonomy_Single_Term( RHSWP_CT_DIGIBETER, array( 'page' ) );
// Custom title for this metabox
$custom_tax_mb->set( 'metabox_title', __( 'Beleidskleuren', 'wp-rijkshuisstijl' ) );
// Will keep radio elements from indenting for child-terms.
$custom_tax_mb->set( 'indented', true );
// Allows adding of new terms from the metabox
$custom_tax_mb->set( 'allow_new_terms', false );
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
//========================================================================================================
// REMOVE WP EMOJI
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'rest_output_link_wp_head' );
//========================================================================================================
// voor de widgets
require_once( RHSWP_FOLDER . '/includes/widget-page-link-widget.php' );
require_once( RHSWP_FOLDER . '/includes/widget-banner.php' );
require_once( RHSWP_FOLDER . '/includes/widget-newswidget.php' );
require_once( RHSWP_FOLDER . '/includes/widget-paginalinks.php' );
require_once( RHSWP_FOLDER . '/includes/widget-subpages.php' );
require_once( RHSWP_FOLDER . '/includes/widget-events.php' );
require_once( RHSWP_FOLDER . '/includes/widget-navigation-menu.php' );
require_once( RHSWP_FOLDER . '/includes/widget-cta-banner.php' );
require_once( RHSWP_FOLDER . '/includes/widget-socialmedia.php' );
// Add support for 2-column footer widgets
add_theme_support( 'genesis-footer-widgets', 2 );
// haal de footer widgets weg uit een aparte ruimte VOOR de footer
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
// Customize the entire footer
remove_action( 'genesis_footer', 'genesis_do_footer' );
//========================================================================================================
// ** Prevent Genesis Accessible from hooking
remove_action( 'genesis_before_header', 'genwpacc_skip_links' );
//========================================================================================================
// set up config
add_action( 'init', 'rhswp_customizer_read' );
function rhswp_customizer_read() {
}

//========================================================================================================
/**
 * Add our Customizer content
 */
function rhswp_customizer_register( $wp_customize ) {
	$wp_customize->add_section( 'gc2020_theme', [
		'title'       => _x( 'Rijkshuisstijl Instellingen', 'customizer', 'gctheme' ),
		'description' => _x( 'Selecteer hier het kleurenschema voor deze site. Je wijzigt hiermee de styling, logo en sommige functionaliteit van de site.', 'customizer', 'gctheme' ),
		'priority'    => 60,
	] );
	//  =============================
	//  = Select Box                =
	//  =============================
	$wp_customize->add_setting( 'rhswp_customizer_theme_options[flavor_select]', [
		'default'    => DEFAULTFLAVOR,
		'capability' => 'edit_theme_options',
		'type'       => 'option',
	] );
	$flavors = [];
	// read configuration json file
	$configfile   = file_get_contents( trailingslashit( get_stylesheet_directory() ) . FLAVORSCONFIG );
	$flavorsource = json_decode( $configfile, true );
	foreach ( $flavorsource as $key => $value ) {
		$flavors[ strtolower( $key ) ] = $value['name'];
	}
	$wp_customize->add_control( 'example_select_box', [
		'settings' => 'rhswp_customizer_theme_options[flavor_select]',
		'label'    => _x( 'Kies het kleurenschema (' . DEFAULTFLAVOR . ') ', 'customizer', 'gctheme' ),
		'section'  => 'gc2020_theme',
		'type'     => 'select',
		'choices'  => $flavors,
	] );
}

add_action( 'customize_register', 'rhswp_customizer_register' );
//========================================================================================================
// add tag support to pages
add_action( 'init', 'rhswp_page_tag_support' );
function rhswp_page_tag_support() {
	register_taxonomy_for_object_type( 'post_tag', 'page' );
}

//========================================================================================================
// ensure all tags are included in queries
add_action( 'pre_get_posts', 'rhswp_page_tag_support_query' );
function rhswp_page_tag_support_query( $wp_query ) {
	if ( $wp_query->get( 'tag' ) ) {
		$wp_query->set( 'post_type', 'any' );
	}
}

//========================================================================================================
add_action( 'init', 'rhswp_add_excerpts_to_pages' );
function rhswp_add_excerpts_to_pages() {
	add_post_type_support( 'page', 'excerpt' );
}

// Add Read More Link to Excerpts
add_filter( 'excerpt_more', 'rhswp_get_read_more_link' );
add_filter( 'the_content_more_link', 'rhswp_get_read_more_link' );
add_filter( 'get_the_content_more_link', 'rhswp_get_read_more_link' ); // Genesis Framework only
add_filter( 'excerpt_more', 'rhswp_get_read_more_link' );
function rhswp_get_read_more_link( $thepermalink ) {
	if ( ! is_archive() ) {
		return;
	}
	if ( ! $thepermalink ) {
		$thepermalink = get_permalink();
	}
	if ( $thepermalink == ' […]' ) {
		$thepermalink = get_permalink();
	}
	$thepermalink  = get_permalink();
	$postpagetitle = get_the_title();
	if ( $postpagetitle ) {
		$postpagetitle = '<span class="screen-reader-text"> ' . _x( 'about', 'verbindt de readmore met de titel', 'wp-rijkshuisstijl' ) . " '" . $postpagetitle . "'</span>";
	}

	return ' <a href="' . $thepermalink . '" tabindex="-1">' . _x( 'Read more', 'Standaard linktekst voor lees-meer', 'wp-rijkshuisstijl' ) . $postpagetitle . '</a>';
}

//========================================================================================================
add_action( 'genesis_after_header', 'rhswp_check_caroussel_or_featured_img', 22 );
add_action( 'genesis_after_header', 'rhswp_dossier_title_checker', 24 );
//========================================================================================================
// thumbnails even for pages
add_theme_support( 'post-thumbnails' );
// Add HTML5 markup structure
add_theme_support( 'html5' );
// Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );
//========================================================================================================
// prepare for translation
load_child_theme_textdomain( 'wp-rijkshuisstijl', RHSWP_FOLDER . '/languages' );
//========================================================================================================
add_filter( 'genesis_single_crumb', 'rhswp_add_extra_info_to_breadcrumb', 10, 2 );
add_filter( 'genesis_page_crumb', 'rhswp_add_extra_info_to_breadcrumb', 10, 2 );
add_filter( 'genesis_archive_crumb', 'rhswp_add_extra_info_to_breadcrumb', 10, 2 );
function rhswp_add_extra_info_to_breadcrumb( $crumb = '', $args = '' ) {
	if ( $crumb ) {
		$span_before_start  = '<span class="breadcrumb-link-wrap" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
		$span_between_start = '<span itemprop="name">';
		$span_before_end    = '</span>';
		$loop               = rhswp_get_context_info();
		$berichtnaam        = get_the_title();
		$term               = '';
		if ( ( is_singular( 'post' ) && ( ( get_query_var( RHSWP_DOSSIERPOSTCONTEXT ) ) && ( ! get_query_var( RHSWP_DOSSIERCONTEXTPOSTOVERVIEW ) ) ) ) || is_date() || is_category() ) {
			// voor bericht in oude dossiercontext of categoriecontext: verwijs naar de pagina met alle berichten
			$actueelpageid    = get_option( 'page_for_posts' );
			$actueelpagetitle = rhswp_filter_alternative_title( $actueelpageid, get_the_title( $actueelpageid ) );
			if ( $actueelpageid ) {
				return '<a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">' . $actueelpagetitle . '</a>' . $args['sep'] . ' ' . $crumb;
			} else {
				return $crumb;
			}
		} else {
			// dit is geen bericht in oude dossiercontext of categoriecontext
			if ( taxonomy_exists( RHSWP_CT_DOSSIER ) ) {
				if (
					( RHSWP_DOSSIERCONTEXTPOSTOVERVIEW == get_query_var( 'pagename' ) ) ||
					( RHSWP_DOSSIERCONTEXTEVENTOVERVIEW == get_query_var( 'pagename' ) ) ||
					( RHSWP_DOSSIERCONTEXTDOCUMENTOVERVIEW == get_query_var( 'pagename' ) )
				) {
					// er is wel een nieuwe dossiercontext
					$terms = get_term_by( 'slug', get_query_var( RHSWP_CT_DOSSIER ), RHSWP_CT_DOSSIER );
					if ( $terms && ! is_wp_error( $terms ) ) {
						$term = $terms;
					}
				} else {
					$terms = get_the_terms( get_the_ID(), RHSWP_CT_DOSSIER );
					if ( $terms && ! is_wp_error( $terms ) ) {
						$term = array_values( $terms )[0];
					}
				}
			}
			if ( $term ) {
				if ( is_singular( 'page' ) && ( RHSWP_DOSSIERCONTEXTPOSTOVERVIEW !== get_query_var( 'pagename' ) && RHSWP_DOSSIERCONTEXTEVENTOVERVIEW !== get_query_var( 'pagename' ) && RHSWP_DOSSIERCONTEXTDOCUMENTOVERVIEW !== get_query_var( 'pagename' )
					) ) {
					// it is a page
					dodebug_do( 'rhswp_add_extra_info_to_breadcrumb: is a page' );
					$needle = '';
					if ( function_exists( 'get_field' ) ) {
						if ( get_field( 'dossier_overzichtspagina', 'option' ) ) {
							$dossier_overzichtspagina       = get_field( 'dossier_overzichtspagina', 'option' );
							$dossier_overzichtspagina_id    = $dossier_overzichtspagina->ID;
							$dossier_overzichtspagina_start = $span_before_start . '<a href="' . get_permalink( $dossier_overzichtspagina_id ) . '" itemprop="item">' . $span_between_start;
							$dossier_overzichtspagina_end   = $span_before_end . '</a>' . $span_before_end;
							$needle                         = $dossier_overzichtspagina_start . get_the_title( $dossier_overzichtspagina_id ) . $dossier_overzichtspagina_end . $args['sep'];
						}
					}
					$replacer = $needle . $span_before_start . '<a href="' . get_term_link( $term ) . '">' . $term->name . '</a>' . $span_before_end . $args['sep'];
					$crumb    = str_replace( $needle, $replacer, $crumb );

					return $crumb;
				} else {
					// it is not a page
					dodebug_do( 'rhswp_add_extra_info_to_breadcrumb: NOT a page' );
					if ( get_query_var( RHSWP_DOSSIERPOSTCONTEXT ) || is_tax( RHSWP_CT_DOSSIER ) || get_query_var( RHSWP_CT_DOSSIER ) ) {
						// het is een bericht / event / whatever in een dossiercontext
						dodebug_do( 'rhswp_add_extra_info_to_breadcrumb: IS DOSSIERTAX OR DOSSIERQUERYVAR ' );
						if ( get_query_var( RHSWP_CT_DOSSIER ) && get_query_var( 'category_slug' ) ) {
							$term                = get_term_by( 'slug', get_query_var( RHSWP_CT_DOSSIER ), RHSWP_CT_DOSSIER );
							$standaardpaginanaam = $term->name;
							$ancestorid          = $term->term_id;
							$parentpageid        = 0;
						} elseif ( get_query_var( RHSWP_DOSSIERPOSTCONTEXT ) ) {
							// de ID achterhalen van de pagina vanwaar dit bericht / event / whatever gelinkt werd
							$urlofparentpage = get_query_var( RHSWP_DOSSIERPOSTCONTEXT );
							$parentpageid    = url_to_postid( $urlofparentpage );
						} elseif ( get_query_var( RHSWP_CT_DOSSIER ) && taxonomy_exists( RHSWP_CT_DOSSIER ) ) {
							$term                = get_term_by( 'slug', get_query_var( RHSWP_CT_DOSSIER ), RHSWP_CT_DOSSIER );
							$standaardpaginanaam = $term->name;
							$ancestorid          = $term->term_id;
							$parentpageid        = 0;
						} else {
							$parentpageid = 0;
						}
						$parentlist = '';
						if ( $term ) {
							$args       = array(
								'separator' => $span_before_start,
								'inclusive' => false
							);
							$parentlist = get_term_parents_list( $term->term_id, RHSWP_CT_DOSSIER, $args );
							if ( $parentlist ) {
								$parentlist = $span_before_start . $parentlist . $span_before_end;
							}
						}
						if ( $parentpageid ) {
							// het is een pagina
							dodebug_do( 'rhswp_add_extra_info_to_breadcrumb: page with parentID ' );
							// in deze array zit als laatste element de titel van de huidige post / event / whatever
							if ( $args['sep'] ) {
								$titlearray = explode( $args['sep'], $crumb );
								array_pop( $titlearray );
							} else {
								$titlearray = $crumb;
							}
							// haal de ancestors op voor de huidige pagina
							$ancestors    = get_post_ancestors( $parentpageid );
							$returnstring = '';
							// haal de hele keten aan ancestors op en zet ze in de returnstring
							foreach ( $ancestors as $ancestorid ) {
								$returnstring = $span_before_start . ' <a href="' . get_permalink( $ancestorid ) . '">' . get_the_title( $ancestorid ) . '</a>' . $span_before_end . $args['sep'] . $returnstring;
							}
							$returnstring .= $span_before_start . ' <a href="' . get_permalink( $parentpageid ) . '">' . get_the_title( $parentpageid ) . '</a>' . $span_before_end . $args['sep'] . $titlearray;
						} elseif ( is_tax( RHSWP_CT_DOSSIER ) ) {
							// dit is de taxonomie-pagina
							$returnstring = '';
							if ( function_exists( 'get_field' ) ) {
								if ( get_field( 'dossier_overzichtspagina', 'option' ) ) {
									$dossier_overzichtspagina    = get_field( 'dossier_overzichtspagina', 'option' );
									$dossier_overzichtspagina_id = $dossier_overzichtspagina->ID;
									$returnstring                .= $span_before_start . ' <a href="' . get_permalink( $dossier_overzichtspagina_id ) . '">' . get_the_title( $dossier_overzichtspagina_id ) . '</a>' . $span_before_end;
								}
							}
							if ( $parentlist ) {
								dodebug_do( 'rhswp_add_extra_info_to_breadcrumb: IS TAX EN HEP PARENTS' );
								$returnstring .= $parentlist;
							}
							$returnstring .= $span_before_start . $standaardpaginanaam . $span_before_end;
						} elseif ( get_query_var( RHSWP_CT_DOSSIER ) ) {
							if ( function_exists( 'get_field' ) ) {
								if ( get_field( 'dossier_overzichtspagina', 'option' ) ) {
									$dossier_overzichtspagina    = get_field( 'dossier_overzichtspagina', 'option' );
									$dossier_overzichtspagina_id = $dossier_overzichtspagina->ID;
									$returnstring                = $span_before_start . ' <a href="' . get_permalink( $dossier_overzichtspagina_id ) . '">' . get_the_title( $dossier_overzichtspagina_id ) . '</a>' . $span_before_end;
								}
							}
							if ( $parentlist ) {
								dodebug_do( 'rhswp_add_extra_info_to_breadcrumb: IS TAX EN HEP PARENTS' );
								$returnstring .= $parentlist;
							}
							if ( $term && ! is_wp_error( $term ) ) {
								$returnstring .= $span_before_start . ' <a href="' . get_term_link( $term->term_id ) . '">' . $term->name . '</a>' . $span_before_end;
							}
							if ( get_query_var( 'category_slug' ) ) {
								dodebug_do( 'rhswp_add_extra_info_to_breadcrumb: YES CAT SLUG: "' . get_query_var( 'category_slug' ) . "'" );
								$category = get_term_by( 'slug', get_query_var( 'category_slug' ), 'category' );
//                $returnstring .= $span_before_start .  ' <a href="' . get_term_link( $term->term_id ) . RHSWP_DOSSIERCONTEXTPOSTOVERVIEW . '/' . RHSWP_DOSSIERCONTEXTCATEGORYPOSTOVERVIEW . '/' . $category->slug . '/">' .  $category->name .'</a>' . $span_before_end . $args['sep'];
								$returnstring .= $category->name; // . $args['sep'];
//                $returnstring .= $span_before_start . $berichtnaam . $span_before_end;
							} else {
								dodebug_do( 'rhswp_add_extra_info_to_breadcrumb: NO CAT SLUG' );
								if ( RHSWP_DOSSIERCONTEXTPOSTOVERVIEW == get_query_var( 'pagename' ) ) {
									dodebug_do( 'rhswp_add_extra_info_to_breadcrumb: NO CAT SLUG, t is nen ' . RHSWP_DOSSIERCONTEXTPOSTOVERVIEW );
									$returnstring .= $span_before_start . _x( 'Posts', 'post types', 'wp-rijkshuisstijl' );
								} elseif ( RHSWP_DOSSIERCONTEXTEVENTOVERVIEW == get_query_var( 'pagename' ) ) {
									dodebug_do( 'rhswp_add_extra_info_to_breadcrumb: NO CAT SLUG, t is nen ' . RHSWP_DOSSIERCONTEXTPOSTOVERVIEW );
									$returnstring .= $span_before_start . _x( "Events", 'post types', 'wp-rijkshuisstijl' );
								} elseif ( RHSWP_DOSSIERCONTEXTDOCUMENTOVERVIEW == get_query_var( 'pagename' ) ) {
									dodebug_do( 'rhswp_add_extra_info_to_breadcrumb: NO CAT SLUG, t is nen ' . RHSWP_DOSSIERCONTEXTDOCUMENTOVERVIEW );
									$returnstring .= $span_before_start . _x( 'Documents', 'post types', 'wp-rijkshuisstijl' );
								} else {
									dodebug_do( 'rhswp_add_extra_info_to_breadcrumb: NO CAT SLUG, t is totaal anders' );
									$returnstring .= $span_before_start . ' <a href="' . get_term_link( $term->term_id ) . RHSWP_DOSSIERCONTEXTPOSTOVERVIEW . '/">' . _x( 'Posts', 'Linktekst in dossiermenu', 'wp-rijkshuisstijl' ) . '</a>' . $span_before_end;
								}
							}
						} else {
							// geen pagina
							$crumb = $args['sep'] . ' <a href="' . get_permalink( $ancestorid ) . '">' . get_the_title( $ancestorid ) . ' / ' . $ancestorid . '</a>';
							// voeg onderwerppagina toe
							if ( function_exists( 'get_field' ) ) {
								if ( get_field( 'dossier_overzichtspagina', 'option' ) ) {
									$dossier_overzichtspagina    = get_field( 'dossier_overzichtspagina', 'option' );
									$dossier_overzichtspagina_id = $dossier_overzichtspagina->ID;
									$returnstring                .= $span_before_start . ' <a href="' . get_permalink( $dossier_overzichtspagina_id ) . '">' . get_the_title( $dossier_overzichtspagina_id ) . '</a>' . $span_before_end;
								}
							}
							$returnstring .= $crumb;
						}

						return $returnstring;
					}
				}
			} else {
				dodebug_do( 'rhswp_add_extra_info_to_breadcrumb: TERM NIET BEKEND' );
			}

			return $crumb;
		}
	}
}

//========================================================================================================
// Modify breadcrumb arguments.
add_filter( 'genesis_breadcrumb_args', 'rhswp_breadcrumb_args' );
function rhswp_breadcrumb_args( $args ) {
	global $wp_query;
	$separator  = __( '<span class="separator">&#8250;</span>', 'wp-rijkshuisstijl' );
	$searchform = '';
	if ( is_front_page() || is_search() ) {
		// the actueel pagina was marked as 'is_home()' (digitaleoverheid.nl/actueel)
	} else {
		if ( 'hide' === get_field( 'siteoption_hide_searchbox', 'option' ) ) {
			// alleen als het zoekformulier expliciet op verborgen is gezet, verbergen
		} else {
			if ( 'toon_menu' === get_field( 'siteoption_kruimelpadmenu', 'option' ) ) {
				// styling met menu, niet met broodkruimelmenu
			} else {
				// zoekformulier gewoon tonen
				$searchform = get_search_form( false );
			}
		}
	}
	$args['home']                    = esc_html( __( "Home", 'wp-rijkshuisstijl' ) );
	$args['sep']                     = $separator;
	$args['list_sep']                = ', ';
	$args['prefix']                  = '<div class="breadcrumb"><div class="wrap"><nav class="breadlist" aria-label="' . esc_attr( _x( 'Breadcrumb', 'breadcrumb', 'wp-rijkshuisstijl' ) ) . '" >';
	$args['suffix']                  = '</nav>' . $searchform . '</div></div>';
	$args['heirarchial_attachments'] = true;
	$args['heirarchial_categories']  = true;
	$args['display']                 = true;
	$args['labels']['prefix']        = '';
	$args['labels']['author']        = esc_html( _x( "Authors", 'breadcrumb', 'wp-rijkshuisstijl' ) ) . $separator;
	$args['labels']['category']      = '';
	$args['labels']['date']          = '';
	$args['labels']['tag']           = esc_html( _x( "Tags", 'breadcrumb', 'wp-rijkshuisstijl' ) ) . $separator;
	$args['labels']['search']        = esc_html( _x( "Search result for ", 'breadcrumb', 'wp-rijkshuisstijl' ) );
	$args['labels']['tax']           = '';
	if ( isset( $wp_query->query_vars['taxonomy'] ) ) {
		$tax = $wp_query->query_vars['taxonomy'];
		if ( $tax == CTAX_contentsoort ) {
			$args['labels']['tax'] = '<a href="/' . CTAX_contentsoort . '/">' . _x( 'Content type', 'breadcrumb', 'wp-rijkshuisstijl' ) . '</a>' . $separator;
		} elseif ( $tax == RHSWP_CT_DOSSIER ) {
			if ( get_field( 'dossier_overzichtspagina', 'option' ) ) {
				$dossier_overzichtspagina     = get_field( 'dossier_overzichtspagina', 'option' );
				$dossier_overzichtspagina_id  = $dossier_overzichtspagina->ID;
				$auteursoverzichtpagina_start = '<a href="' . get_permalink( $dossier_overzichtspagina_id ) . '">';
				$auteursoverzichtpagina_end   = '</a>';
				$actueelpagetitle             = get_the_title( $dossier_overzichtspagina_id );
				$tax                          = '';
				$args['labels']['tax']        = $auteursoverzichtpagina_start . $actueelpagetitle . $auteursoverzichtpagina_end . $separator;
			} else {
				$args['labels']['tax'] = $separator;
			}
		} elseif ( $tax == CTAX_thema ) {
			$tax                   = '';
			$args['labels']['tax'] = '<a href="/' . CTAX_thema . '/">' . _x( 'Topics', 'breadcrumb', 'wp-rijkshuisstijl' ) . '</a>' . $separator;
		} else {
			$args['labels']['tax'] = '<a href="/' . $tax . '/">' . $tax . '</a>' . $args['sep'];
		}
	}
	$args['labels']['post_type'] = '';
	$args['labels']['404']       = esc_html( _x( "Page not found (error 404)", 'breadcrumb', 'wp-rijkshuisstijl' ) );

	return $args;
}

//========================================================================================================
// js filter functie
function rhswp_add_defer_to_javascripts( $url ) {
	if ( // comment the following line out add 'defer' to all scripts
//    FALSE === strpos( $url, 'contact-form-7' ) or
		false === strpos( $url, '.js' )
	) { // not our file
		return $url;
	}

	// Must be a ', not "!
	return "$url' defer='defer";
}

//add_filter( 'clean_url', 'rhswp_add_defer_to_javascripts', 11, 1 );
//========================================================================================================
function rhswp_add_taxonomy_description() {
	global $wp_query;
	if ( ! is_category() && ! is_tag() && ! is_tax() && ! is_post_type_archive( RHSWP_CPT_DOCUMENT ) ) {
		return;
	}
	$prefix = '';
	if ( is_tag() ) {
		$prefix = esc_html( __( "Tag", 'wp-rijkshuisstijl' ) ) . ': ';
	}
	$term = is_tax() ? get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ) : $wp_query->get_queried_object();
	if ( ( ( ! $term || ! isset( $term->meta ) ) ) && ( ! is_post_type_archive( RHSWP_CPT_DOCUMENT ) ) ) {
		return;
	}
	$headline   = '';
	$intro_text = '';
	$tax        = isset( $wp_query->query_vars['taxonomy'] ) ? $wp_query->query_vars['taxonomy'] : '';
	if ( is_post_type_archive( RHSWP_CPT_DOCUMENT ) ) {
		$headline   = sprintf( '<h1 class="archive-title">%s</h1>', rhswp_translateposttypes( RHSWP_CPT_DOCUMENT, true ) );
		$intro_text = sprintf( '<p>' . _x( "All documents on %s.", "beschrijving op documentpagina", 'wp-rijkshuisstijl' ) . '</p>', get_bloginfo( 'name' ) );
	} elseif ( $tax == RHSWP_CT_DOSSIER ) {
	} else {
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
		$intro_text = apply_filters( 'the_content', $term->meta['intro_text'] );
	}
	if ( $term->description ) {
		$intro_text = apply_filters( 'the_content', $term->description );
	}
	if ( $headline || $intro_text ) {
		printf( '<div class="taxonomy-description"><div class="wrap">%s</div></div>', $headline . $intro_text );
	} else {
		return;
	}
}

//========================================================================================================
function get_words( $sentence, $count = 10 ) {
	preg_match( "/(?:\w+(?:\W+|$)){0,$count}/", $sentence, $matches );

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
	} else {
		// The option hasn't been added yet. We'll add it
		add_option( 'excerpt_length', $length );
	}
	wp_cache_delete( 'alloptions', 'options' );

	return $length;
}

//========================================================================================================
// Customize the entry meta in the entry header (requires HTML5 theme support)
add_filter( 'genesis_post_info', 'rhswp_correct_postinfo' );
function rhswp_correct_postinfo( $post_info ) {
	global $wp_query;
	global $post;
	if (
		( 'page' == get_post_type() ) ||
		( 'post' == get_post_type() ) ) {
		if ( function_exists( 'get_field' ) ) {
			$deelknoppen_boven = get_field( 'deelknoppen_boven', $post->ID );
			$deelknoppen_onder = get_field( 'deelknoppen_onder', $post->ID );
		}
		if ( has_post_format( 'link' ) ) {
			return '';
		} else {
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
	if ( taxonomy_exists( RHSWP_CT_DOSSIER ) ) {
		$terms = get_the_terms( $post->ID, RHSWP_CT_DOSSIER );
		if ( $terms && ! is_wp_error( $terms ) ) {
			if ( get_field( 'dossier_overzichtspagina', 'option' ) ) {
				$dossier_overzichtspagina    = get_field( 'dossier_overzichtspagina', 'option' );
				$dossier_overzichtspagina_id = $dossier_overzichtspagina->ID;
				$obj                         = get_taxonomy( RHSWP_CT_DOSSIER );
				echo '<h4>' . $obj->labels->name . '</h4>';
			} else {
				dodebug_do( 'geen overzichtspagina gevonden' );
			}
			echo '<ul>';
			foreach ( $terms as $term ) {
				echo '<li><a href="' . get_term_link( $term->term_id ) . '">' . $term->name . '</a></li>';
			}
			echo '</ul>';
			echo '<a href="' . get_permalink( $dossier_overzichtspagina_id ) . '" itemprop="item">' . get_the_title( $dossier_overzichtspagina_id ) . '</a>';
		}
	}
	$terms = get_the_terms( $post->ID, 'category' );
	if ( $terms && ! is_wp_error( $terms ) ) {
		foreach ( $terms as $term ) {
			echo '<br><a href="' . get_term_link( $term->term_id ) . '"><strong>Categorie: ' . $term->name . '</strong></a>';
		}
	}
}

//========================================================================================================
function rhswp_sidebar_context_widgets() {
	if ( WP_DEBUG && WP_LOCAL_DEV ) {
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
				$parentID = wp_get_post_parent_id( $post->ID );
				$parent   = get_post( $parentID );
				echo '<br>posttype: <strong>' . $posttype . '</strong>';
				echo '<br>template: <strong>' . basename( get_page_template() ) . '</strong>';
				if ( $parent && ( $parent->ID !== $post->ID ) ) {
					echo '<br>parent: <a href="' . get_permalink( $parent->ID ) . '"><strong>' . get_the_title( $parent->ID ) . '</strong></a>';
				} else {
					echo '<br>Pagina heeft geen parent';
				}
				echo '</p>';
			} elseif ( 'tax' == $context ) {
				rhswp_sidebar_context_taxonomies();
			} elseif ( 'single' == $context ) {
				echo '<br>posttype: <strong>' . $posttype . '</strong>';
				rhswp_sidebar_context_taxonomies();
			} else {
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
add_action( 'genesis_loop_else', 'rhswp_no_posts_content_header', 13 );
add_action( 'genesis_loop_else', 'rhswp_no_posts_content', 14 );
add_action( 'genesis_loop_else', 'rhswp_404', 15 );
//========================================================================================================
function rhswp_no_posts_content_header() {
	printf( '<h2 class="entry-title">%s</h2>', __( 'Page not found (error 404)', 'wp-rijkshuisstijl' ) );
}

//========================================================================================================
function rhswp_no_posts_content() {
	if ( 'hide' === get_field( 'siteoption_hide_searchbox', 'option' ) ) {
		// alleen als het zoekformulier expliciet op verborgen is gezet, verbergen
		echo '<p>' . sprintf( __( 'Sorry, the content you asked for is not available. <a href="%s">Go to the home page</a>', 'wp-rijkshuisstijl' ), home_url() ) . '</p>';
	} else {
		// zoekformulier gewoon tonen
		echo '<p>' . sprintf( __( 'Sorry, the content you asked for is not available. Some options: <a href="%s">go to the home page</a>, or use this search form.', 'wp-rijkshuisstijl' ), home_url() ) . '</p>';
		echo '<p>' . get_search_form() . '</p>';
	}
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
	} else {
		rhswp_get_sitemap_content();
	}
	echo '</div>';
	echo '</div>';
//  echo genesis_html5() ? '</article>' : '</div>';
}

//========================================================================================================
function rhswp_get_sitemap_for_pagenotfound() {
	rhswp_get_sitemap_pages( 'ul', false );
	if ( function_exists( 'get_field' ) ) {
		if ( get_field( 'sitemap_settings_toondossiers', 'option' ) == 'ja' ) {
			$toondossiers = true;
		} else {
			$toondossiers = false;
		}
		if ( get_field( 'sitemap_settings_tooncategorie', 'option' ) == 'ja' ) {
			$tooncategorie = true;
		} else {
			$tooncategorie = false;
		}
		if ( $toondossiers ) {
			rhswp_show_customtax_terms( RHSWP_CT_DOSSIER, __( 'Topics', 'sitemap', 'wp-rijkshuisstijl' ) . ":" );
		}
		if ( $tooncategorie ) {
			rhswp_show_customtax_terms( 'category', __( 'Categories', 'sitemap', 'wp-rijkshuisstijl' ) . ":" );
		}
	}
}

//========================================================================================================
function rhswp_get_sitemap_pages( $listitem = 'ul', $filtersitemap = true ) {
	?>
	<section aria-labelledby="title_sitemap_pages2">
	<h2 id="title_sitemap_pages2"><?php echo _x( "Pages", 'sitemap', 'wp-rijkshuisstijl' ); ?></h2>
	<<?php echo $listitem; ?>>
	<?php
	if ( $filtersitemap ) {
		$args = array(
			'title_li' => '',
			'echo'     => 0,
			'walker'   => new rhswp_custom_walker_for_sitemap()
		);
	} else {
		$args = array(
			'title_li' => '',
			'echo'     => 0,
		);
	}
	if ( function_exists( 'get_field' ) ) {
		if ( get_field( 'sitemap_settings_hide_pages', 'option' ) ) {
			$excludepages = '';
			$hidepages    = get_field( 'sitemap_settings_hide_pages', 'option' );
			if ( $hidepages ) {
				foreach ( $hidepages as $hidepage ) {
					// loop door de uitgesloten pagina's
					if ( $excludepages ) {
						$excludepages .= ',' . $hidepage->ID;
					} else {
						$excludepages = $hidepage->ID;
					}
					// en haal daarvoor ook de children op
					$hideargs        = array(
						'sort_order'   => 'asc',
						'sort_column'  => 'post_title',
						'hierarchical' => 1,
						'child_of'     => $hidepage->ID,
						'offset'       => 0,
						'post_type'    => 'page',
						'post_status'  => 'publish'
					);
					$pages_childpage = get_pages( $hideargs );
					$pagecounter     = 0;
					foreach ( $pages_childpage as $hidechildpage ) {
						if ( $excludepages ) {
							$excludepages .= ',' . $hidechildpage->ID;
						} else {
							$excludepages = $hidechildpage->ID;
						}
					}
				}
			}
			$args['exclude'] = $excludepages;
		}
	}
	$fulter  = wp_list_pages( $args );
	$pattern = "/<ul[^>]*><\\/ul[^>]*>/";
	$fulter  = preg_replace( $pattern, '', $fulter );
	echo $fulter;
	?>
	</<?php echo $listitem; ?>>
	</section>
	<?php
}

//========================================================================================================
function rhswp_get_sitemap_content() {
	$filtersitemap    = true;
	$showpagetemplate = false;
	$listitem         = 'ul';
	$toondossiers     = false;
	$tooncategorie    = false;
	$toonberichten    = false;
	if ( function_exists( 'get_field' ) ) {
		if ( get_field( 'sitemap_settings_toondossiers', 'option' ) == 'ja' ) {
			$toondossiers = true;
		}
		if ( get_field( 'sitemap_settings_tooncategorie', 'option' ) == 'ja' ) {
			$tooncategorie = true;
		}
		if ( get_field( 'sitemap_settings_toonberichten', 'option' ) == 'ja' ) {
			$toonberichten = true;
		}
	}
	if ( isset( $_GET['filtersitemap'] ) ) {
		$filtersitemap = filter_input( INPUT_GET, 'filtersitemap', FILTER_SANITIZE_SPECIAL_CHARS );
		if ( $filtersitemap == 'nee' ) {
			$filtersitemap = false;
			$listitem      = 'ol';
		}
	}
	rhswp_get_sitemap_pages( $listitem, $filtersitemap );
	if ( $toondossiers ) {
		rhswp_show_customtax_terms( RHSWP_CT_DOSSIER, _x( 'Topics', 'sitemap', 'wp-rijkshuisstijl' ) . ":" );
	}
	if ( $tooncategorie ) {
		rhswp_show_customtax_terms( 'category', _x( 'Categories', 'sitemap', 'wp-rijkshuisstijl' ) . ":" );
	}
	if ( $filtersitemap ) {
	} else {
		?>
		<section aria-labelledby="title_sitemap_documenten">
		<h2 id="title_sitemap_documenten"><?php echo _x( 'Documents', 'post types', 'wp-rijkshuisstijl' ) . _e( "(ordered by post date)", 'wp-rijkshuisstijl' ); ?></h2>
		<<?php echo $listitem; ?>>
		<?php
		$args = array(
			'type'      => 'postbypost',
			'post_type' => RHSWP_CPT_DOCUMENT,
			'echo'      => 1,
		);
		wp_get_archives( $args ); ?>
		</<?php echo $listitem; ?>>
		</section>
		<section aria-labelledby="title_sitemap_agenda">
		<h2 id="title_sitemap_agenda"><?php _e( 'Events', 'post types', 'wp-rijkshuisstijl' ); ?></h2>
		<<?php echo $listitem; ?>>
		<?php
		$args = array(
			'type'      => 'postbypost',
			'post_type' => RHSWP_CPT_EVENT,
			'echo'      => 1,
		);
		wp_get_archives( $args ); ?>
		</<?php echo $listitem; ?>>
		</section>
		<?php
		if ( defined( 'RHSWP_CPT_RIJKSVIDEO' ) ) {
			?>
			<section aria-labelledby="title_sitemap_videos">
			<h2 id="title_sitemap_videos"><?php _e( 'Videos', 'post types', 'wp-rijkshuisstijl' ); ?></h2>
			<<?php echo $listitem; ?>>
			<?php
			$args = array(
				'type'      => 'postbypost',
				'post_type' => RHSWP_CPT_RIJKSVIDEO,
				'echo'      => 1,
			);
			wp_get_archives( $args ); ?>
			</<?php echo $listitem; ?>>
			</section>
			<?php
		}
	}
	if ( $toonberichten ) {
		$maxnr_posts = - 1;
		$label       = _x( "All recent posts", "sitemap: all recent posts", 'wp-rijkshuisstijl' );
		if ( $filtersitemap ) {
			$maxnr_posts = get_option( 'posts_per_page' );
			$label       = sprintf( _x( "%s recent posts", "beschrijving op documentpagina", "sitemap: number of recent posts", 'wp-rijkshuisstijl' ), $maxnr_posts );
		}
		?>
		<section aria-labelledby="title_sitemap_posts">
		<h2 id="title_sitemap_posts"><?php echo $label . ':'; ?></h2>
		<<?php echo $listitem; ?>>
		<?php
		if ( $filtersitemap ) {
			$args = array(
				'type'      => 'postbypost',
				'limit'     => $maxnr_posts,
				'order'     => 'DESC',
				'post_type' => 'post',
				'echo'      => 1,
			);
		} else {
			$args = array(
				'type'      => 'postbypost',
				'post_type' => 'post',
				'echo'      => 1,
			);
		}
		wp_get_archives( $args ); ?>
		</<?php echo $listitem; ?>>
		</section>
		<?php
	}
}

//========================================================================================================
class rhswp_custom_walker_for_taxonomies extends Walker_Category {
	function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
		extract( $args );
		$cat_name = esc_attr( $category->name );
		$headline = get_term_meta( $category->term_id, 'headline', true );
		if ( isset( $headline[0] ) && ( strlen( $headline[0] ) > 0 ) ) {
			if ( is_array( $headline ) ) {
				$headline = strval( $headline[0] );
			} else {
				$headline = strval( $headline );
			}
			$cat_name .= ' - ' . wp_strip_all_tags( $headline );
		}

		$link = '<a href="' . esc_url( get_term_link( $category ) ) . '" ';
		$link .= '>';
		$link .= $cat_name . '</a>';
		if ( ! empty( $show_count ) ) {
			$link .= ' (' . intval( $category->count ) . ')';
		}
		if ( 'list' == $args['style'] ) {
			$output       .= "\t<li";
			$class        = 'cat-item cat-item-' . $category->term_id;
			$termchildren = get_term_children( $category->term_id, $category->taxonomy );
			if ( count( $termchildren ) > 0 ) {
				$class .= ' term-children';
			}
			if ( ! empty( $current_category ) ) {
				$_current_category = get_term( $current_category, $category->taxonomy );
				if ( $category->term_id == $current_category ) {
					$class .= ' current-cat';
				} elseif ( $category->term_id == $_current_category->parent ) {
					$class .= ' current-cat-parent';
				}
			}
			$output .= ' class="' . $class . '"';
			$output .= ">$link\n";
		} else {
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
		} else {
//        $output .= '-';
		}
	}

	// -------------------------
	function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {
		if ( $depth ) {
			$indent = str_repeat( "\t", $depth );
		} else {
			$indent = '';
		}
		extract( $args, EXTR_SKIP );
		$css_class = array( 'page_item', 'page-item-' . $page->ID );
		if ( ! empty( $current_page ) ) {
			$_current_page = get_post( $current_page );
			if ( in_array( $page->ID, $_current_page->ancestors ) ) {
				$css_class[] = 'current_page_ancestor';
			}
			if ( $page->ID == $current_page ) {
				$css_class[] = 'current_page_item';
			} elseif ( $_current_page && $page->ID == $_current_page->post_parent ) {
				$css_class[] = 'current_page_parent';
			}
		} elseif ( $page->ID == get_option( 'page_for_posts' ) ) {
			$css_class[] = 'current_page_parent';
		}
		$css_class    = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );
		$icon_class   = get_post_meta( $page->ID, 'icon_class', true ); //Retrieve stored icon class from post meta
		$pagetemplate = get_page_template_slug( $page->ID );
		if ( ( 'page_dossiersingleactueel.php' != $pagetemplate )
			 && ( 'page_dossier-document-overview.php' != $pagetemplate )
			 && ( 'page_dossier-events-overview.php' != $pagetemplate )
		) {
			$output .= $indent . '<li class="' . $css_class . '">';
			$output .= '<a href="' . get_permalink( $page->ID ) . '">' . $link_before;
			if ( $icon_class ) { //Test if $icon_class exists
				$output .= '<span class="' . $icon_class . '"></span>'; //If it exists output a span with the $icon_class attached to it
			}
			$output .= apply_filters( 'the_title', $page->post_title, $page->ID );
			$output .= $link_after . '</a>';
		}
		if ( ! empty( $show_date ) ) {
			if ( 'modified' == $show_date ) {
				$time = $page->post_modified;
			} else {
				$time   = $page->post_date;
				$output .= " " . mysql2date( $date_format, $time );
			}
		}
	}
	// -------------------------
}

//========================================================================================================
function rhswp_get_sitemap() {
	echo '<div class="entry">';
	if ( is_404() ) {
		rhswp_no_posts_content_header();
	}
	echo '<div class="entry-content">';
	if ( is_404() ) {
		rhswp_no_posts_content();
	} else {
		rhswp_get_sitemap_widgets();
	}
	rhswp_get_sitemap_content();
	echo '</div>';
	echo '</div>';
}

//========================================================================================================
genesis_register_sidebar(
	array(
		'name'          => esc_html( __( "Sitemap widget area", 'wp-rijkshuisstijl' ) ),
		'id'            => RHSWP_SITEMAP_WIDGET_AREA,
		'description'   => esc_html( __( "Ruimte voor widgets op de sitemap", 'wp-rijkshuisstijl' ) ),
		'before_widget' => genesis_markup( array(
			'html5' => '<section role="complementary" id="%1$s" class="%2$s ' . RHSWP_SITEMAP_WIDGET_AREA . '" aria-labelledby="title_' . RHSWP_SITEMAP_WIDGET_AREA . '">',
			'xhtml' => '<div id="%1$s" class="widget %2$s">',
			'echo'  => false,
		) ),
		'after_widget'  => genesis_markup( array(
			'html5' => '</section>' . "\n",
			'xhtml' => '</div>' . "\n",
			'echo'  => false
		) ),
		'before_title'  => genesis_markup( array(
			'html5' => '<h2 id="title_' . RHSWP_SITEMAP_WIDGET_AREA . '">',
			'xhtml' => '<h2 id="title_' . RHSWP_SITEMAP_WIDGET_AREA . '">',
			'echo'  => false,
		) ),
//        '<h2 class="widgettitle" id="title_%1$s">',
		'after_title'   => "</h2>\n",
	)
);
// add an extra widget area
function rhswp_get_sitemap_widgets() {
	if ( is_active_sidebar( RHSWP_SITEMAP_WIDGET_AREA ) ) {
		dynamic_sidebar( RHSWP_SITEMAP_WIDGET_AREA );
	}
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
		'name'          => esc_html( __( "Homepage widget area", 'wp-rijkshuisstijl' ) ),
		'id'            => RHSWP_HOME_WIDGET_AREA,
		'description'   => esc_html( __( "Ruimte voor widget op de homepage", 'wp-rijkshuisstijl' ) ),
		'before_widget' => genesis_markup( array(
			'html5' => '<section role="complementary" id="%1$s" class="widget %2$s ' . RHSWP_HOME_WIDGET_AREA . '" aria-labelledby="title_' . RHSWP_HOME_WIDGET_AREA . '"><div class="widget-wrap">',
			'xhtml' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'echo'  => false,
		) ),
		'after_widget'  => genesis_markup( array(
			'html5' => '</div></section>' . "\n",
			'xhtml' => '</div></div>' . "\n",
			'echo'  => false
		) ),
		'before_title'  => genesis_markup( array(
			'html5' => '<h2 id="title_' . RHSWP_HOME_WIDGET_AREA . '">',
			'xhtml' => '<h2 id="title_' . RHSWP_HOME_WIDGET_AREA . '">',
			'echo'  => false,
		) ),
//        '<h2 class="widgettitle" id="title_%1$s">',
		'after_title'   => "</h2>\n",
	)
);
//========================================================================================================
// javascripts toevoegen, voor het menu
add_action( 'wp_enqueue_scripts', 'rhswp_enqueue_js_scripts' );
function rhswp_enqueue_js_scripts() {
	if ( ! is_admin() ) {
		$versie = filemtime( dirname( __FILE__ ) . '/js/menu.js' );
		if ( DO_MINIFY_JS ) {
			// the minified file
			wp_enqueue_script( 'modernizr', RHSWP_THEMEFOLDER . '/js/modernizr-custom.js', '', $versie, true );
			wp_enqueue_script( 'allscripts', RHSWP_THEMEFOLDER . '/js/min/scripts-min.js', array( 'jquery' ), $versie, true );
		} else {
			wp_enqueue_script( 'modernizr', RHSWP_THEMEFOLDER . '/js/modernizr-custom.js', '', $versie, true );
			// these are the unminified JS-files
			wp_enqueue_script( 'wp-rijkshuisstijl-polyfill-eventlistener', RHSWP_THEMEFOLDER . '/js/polyfill-eventlistener.js', array( 'jquery' ), '', true );
			wp_enqueue_script( 'wp-rijkshuisstijl-polyfill-matchmedia', RHSWP_THEMEFOLDER . '/js/polyfill-matchmedia.js', array( 'jquery' ), '', true );
			wp_enqueue_script( 'allscripts', RHSWP_THEMEFOLDER . '/js/carousel-actions.js', array( 'jquery' ), '', true );
			wp_enqueue_script( 'details-element', RHSWP_THEMEFOLDER . '/js/details-element.js', '', $versie, true );
			wp_enqueue_script( 'menumenu', RHSWP_THEMEFOLDER . '/js/min/menu-min.js', '', $versie, true );
			// Localize the script with new data
			$translation_array = array(
				'search_open'  => _x( 'Show search bar', 'Labels menu buttons', 'wp-rijkshuisstijl' ),
				'search_close' => _x( 'Close search bar', 'Labels menu buttons', 'wp-rijkshuisstijl' ),
				'menu_open'    => _x( 'Open menu', 'Labels menu buttons', 'wp-rijkshuisstijl' ),
				'menu_close'   => _x( 'Close menu', 'Labels menu buttons', 'wp-rijkshuisstijl' ),
			);
			wp_localize_script( 'menumenu', 'menumenu', $translation_array );
		}
		$openclose = _x( 'Show all details', 'Labels detailbuttons', 'wp-rijkshuisstijl' );
		$openinit  = sprintf( _x( 'There are __NUMBER__ blocks with hidden text on this page. Use the button with \'%s\' to make the text available.', 'Labels detailbuttons', 'wp-rijkshuisstijl' ), $openclose );
		// Localize the script with new data
		$translation_array = array(
			'detailsbutton_init'        => $openinit,
			'detailsbutton_resultclose' => _x( 'All detail blocks are closed', 'Labels detailbuttons', 'wp-rijkshuisstijl' ),
			'detailsbutton_resultopen'  => _x( 'All detail blocks are open', 'Labels detailbuttons', 'wp-rijkshuisstijl' ),
			'open'                      => $openclose,
			'close'                     => _x( 'Hide all details', 'Labels detailbuttons', 'wp-rijkshuisstijl' )
		);
		wp_localize_script( 'allscripts', 'detailssummarytranslate', $translation_array );
	}
}

//========================================================================================================
add_filter( 'genesis_attr_nav-primary', 'add_class_to_menu' );
function add_class_to_menu( $attributes ) {
	$attributes['class'] .= ' js-menu init';

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
	if ( 'www.digitaleoverheid.nl' == $_SERVER["HTTP_HOST"] || 'digitaleoverheid.nl' == $_SERVER["HTTP_HOST"] || 'nldigitalgovernment.nl' == $_SERVER["HTTP_HOST"] || 'www.nldigitalgovernment.nl' == $_SERVER["HTTP_HOST"] ) {
		$strackingid  = 147;
		$cookiedomain = 'digitaleoverheid.nl';
		if ( 'nldigitalgovernment.nl' == $_SERVER["HTTP_HOST"] || 'www.nldigitalgovernment.nl' == $_SERVER["HTTP_HOST"] ) {
			$strackingid  = 1771;
			$cookiedomain = 'nldigitalgovernment.nl';
		}
		echo '
<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(["setCookieDomain", "*.' . $cookiedomain . '"]);
  _paq.push(["setDomains", ["*.' . $cookiedomain . '"]]);
  _paq.push(["enableHeartBeatTimer", 10]);
  _paq.push(["setLinkTrackingTimer", 750]);
  _paq.push(["trackPageView"]);
  _paq.push(["enableLinkTracking"]);
  (function() {
    var u="//statistiek.rijksoverheid.nl/piwik/";
    _paq.push(["setTrackerUrl", u+\'piwik.php\']);
    _paq.push(["setSiteId", \'' . $strackingid . '\']);
    var d=document, g=d.createElement(\'script\'), s=d.getElementsByTagName(\'script\')[0];
    g.type=\'text/javascript\'; g.async=true; g.defer=true; g.src=u+\'piwik.js\'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Piwik Code -->
<!-- Piwik Image Tracker-->
<noscript><img src="https://statistiek.rijksoverheid.nl/piwik/piwik.php?idsite=' . $strackingid . '&rec=1" style="border:0" alt="" /></noscript>
<!-- End Piwik -->
';
	} else {
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
	$settings['theme_advanced_blockformats'] = 'p,h2,h3,h4,h5,h6,q,hr';
	$settings['theme_advanced_disable']      = 'underline,spellchecker,forecolor,justifyfull';
	$settings['theme_advanced_buttons2_add'] = 'styleselect';
	$settings['entity_encoding']             = 'raw';
	$settings['extended_valid_elements']     = 'details,summary';
	$settings['toolbar1']                    = 'formatselect,italic,bold,bullist,numlist,blockquote,|,link,unlink,|,spellchecker,|,styleselect,|,removeformat,cleanup,|,alignleft,alignright,undo,redo,outdent,indent,hr,fullscreen';
	$settings['toolbar2']                    = '';
	$settings['block_formats']               = 'Tussenkop niveau 2=h2;Tussenkop niveau 3=h3;Tussenkop niveau 4=h4;Tussenkop niveau 5=h5;Tussenkop niveau 6=h6;Paragraaf=p;Citaat=q';
	$settings['style_formats']               = '[
    {title: "Intro-paragraaf", block: "span", classes: "intro"},
  ]';

	return $settings;
}

add_filter( 'tiny_mce_before_init', 'admin_set_tinymce_options' );
//========================================================================================================
// Add primary and secondary navigation menu
add_theme_support(
	'genesis-menus',
	array(
		'primary'   => __( 'Primary Navigation Menu', 'wp-rijkshuisstijl' ),
		'secondary' => __( 'Secondary Navigation Menu', 'wp-rijkshuisstijl' ),
	)
);
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
 * @param array $page_templates
 *
 * @return array
 * @author Bill Erickson
 * @link http://www.billerickson.net/remove-genesis-page-templates
 *
 */
function rhswp_remove_genesis_page_templates( $page_templates ) {
	unset( $page_templates['page_archive.php'] );
	unset( $page_templates['page_blog.php'] );

	return $page_templates;
}

add_filter( 'theme_page_templates', 'rhswp_remove_genesis_page_templates' );
//========================================================================================================
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
	unregister_sidebar( 'header-right' );

	genesis_register_sidebar(
		array(
			'name'          => _x( 'Widgetruimte algemeen', 'Title of primary sidebar', 'wp-rijkshuisstijl' ),
			'description'   => _x( 'Primaire zijbalk met ruimte voor widgets. Wordt standaard getoond aan de rechterkant van de content op brede schermen', 'Description of primary sidebar', 'wp-rijkshuisstijl' ),
			'id'            => 'sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'after_widget'  => "</div></div>\n",
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => "</h3>\n"
		)
	);

	genesis_register_sidebar(
		array(
			'name'          => _x( 'Widgets in de footer', 'Title of footer widget', 'wp-rijkshuisstijl' ),
			'description'   => _x( "Ruimte voor extra menus's onder de hoofdcontent", 'Description of footer widget space', 'wp-rijkshuisstijl' ),
			'id'            => RHSWP_SINGLE_FOOTER_WIDGET_AREA,
			'before_widget' => '<section id="%1$s" class="%2$s widget"><div class="widget-wrap">',
			'after_widget'  => "</div></section>\n",
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => "</h2>\n"
		)
	);
	genesis_register_sidebar(
		array(
			'name'          => _x( 'Geen resultaat op zoekpagina', 'Title of secondary sidebar', 'wp-rijkshuisstijl' ),
			'description'   => _x( 'In deze ruimte kun je widgets opnemen die getoond worden als er geen zoekresultaten zijn voor een zoekopdracht.', 'Description of secundary sidebar', 'wp-rijkshuisstijl' ),
			'id'            => RHSWP_NORESULT_WIDGET_AREA,
			'before_widget' => '<div id="%1$s" class="search no-results-widget %2$s"><div class="widget-wrap">',
			'after_widget'  => "</div></div>\n",
			'before_title'  => '<h2>',
			'after_title'   => "</h2>\n"
		)
	);
	unregister_widget( 'WP_Widget_Meta' );
	unregister_widget( 'WP_Widget_Media_gallery' );
//	register_widget( 'WP_Nav_Menu_Widget' );
	unregister_widget( 'WP_Widget_Archives' );
	unregister_widget( 'WP_Widget_Calendar' );
	unregister_widget( 'WP_Widget_Categories' );
//	register_widget( 'WP_Widget_Custom_HTML' );
	unregister_widget( 'WP_Widget_Media_Audio' );
	unregister_widget( 'WP_Widget_Media_Gallery' );
	unregister_widget( 'WP_Widget_Media_Image' );
	unregister_widget( 'WP_Widget_Media_Video' );
	unregister_widget( 'WP_Widget_Pages' );
	unregister_widget( 'WP_Widget_Recent_Comments' );
//	register_widget( 'WP_Widget_Recent_Posts' );
	unregister_widget( 'WP_Widget_RSS' );
//	register_widget( 'WP_Widget_Search' );
	unregister_widget( 'WP_Widget_Tag_Cloud' );
//	register_widget( 'WP_Widget_Text' );
	unregister_widget( 'Genesis_Featured_Page' );
	unregister_widget( 'Genesis_Featured_Post' );
	unregister_widget( 'Genesis_User_Profile_Widget' );
}

//========================================================================================================

function rhswp_document_add_extra_info() {
	global $post;

	if ( is_single() && ( RHSWP_CPT_DOCUMENT == get_post_type() ) ) {
		if ( function_exists( 'get_field' ) ) {
			$filesize_user           = get_field( 'rhswp_document_filesize', $post->ID );
			$file                    = get_field( 'rhswp_document_upload', $post->ID );
			$file_or_url             = get_field( 'rhswp_document_file_or_url', $post->ID );
			$rhswp_document_url      = get_field( 'rhswp_document_url', $post->ID );
			$rhswp_document_linktext = get_field( 'rhswp_document_linktext', $post->ID );

			echo '<p>';
			if ( 'URL' === $file_or_url && $rhswp_document_url ) {
				if ( ! $rhswp_document_linktext ) {
					$arr_linktext            = explode( '/', $rhswp_document_url );
					$linktext                = end( $arr_linktext );
					$linktext                = preg_replace( '|-|i', ' ', $linktext );
					$linktext                = preg_replace( '|   |i', ' - ', $linktext );
					$rhswp_document_linktext = sprintf( _x( 'Bekijk "%s"', 'download document', 'wp-rijkshuisstijl' ), $linktext );
				}
				echo '<p><a href="' . $rhswp_document_url . '" class="' . RHSWP_CPT_DOCUMENT . '">' . $rhswp_document_linktext . '</a></p>';
			} else {
				if ( $file ) {
					$filetype = strtoupper( $file['subtype'] );
					$filesize = human_filesize( $file['filesize'] );
					if ( $filesize_user ) {
						$filesize = $filesize_user;
					}
					echo '<p><a href="' . $file['url'] . '" class="download ' . RHSWP_CPT_DOCUMENT . '">' . sprintf( _x( "Download '%s'", 'download document', 'wp-rijkshuisstijl' ), $file['title'] );
					if ( $filetype || $filesize ) {
						echo ' (';
						if ( $filetype && $filesize ) {
							echo $filetype . ', ' . $filesize;
						} else {
							echo $filetype . $filesize;
						}
						echo ')';
					}
					echo '</a></p>';
				}
			}
			echo '</p>';

		}
	}
}

//========================================================================================================
// Customize the entry meta in the entry header (requires HTML5 theme support)
add_filter( 'genesis_post_info', 'rhswp_post_append_postinfo' );

function rhswp_post_append_postinfo( $post_info ) {

	global $wp_query;
	global $post;

	if ( is_home() ) {
		// niks, eigenlijk
		return '[post_date]';
	} elseif ( is_page() ) {
		// de publicatiedatum
		return '[post_date]';
	} else {
		if ( 'event' == get_post_type() ) {
			return '';
		} elseif ( 'post' == get_post_type() ) {
			if ( is_single() ) {
//				return '[post_date] [post_categories before=""]';
				return '[post_categories before=""] [post_date] ';
				// voor in het archief: er is ook een shortcode: [post_laatstgewijzigd]
			} else {
				return '';
			}
		} elseif ( RHSWP_CPT_DOCUMENT == get_post_type() ) {
			// hiero
			$return       = '[post_date]';
			$file         = get_field( 'rhswp_document_upload', $post->ID );
			$number_pages = get_field( 'rhswp_document_number_pages', $post->ID );
			if ( $file && $number_pages > 0 ) {
				$return .= DO_SEPARATOR . sprintf( _n( '%s page', "%s pages", $number_pages, 'wp-rijkshuisstijl' ), $number_pages );
			}

			return $return;
		} else {
			return '[post_date]';
		}
	}
}

//========================================================================================================
function rhswp_filter_alternative_title( $postid = 0, $title = '' ) {
	if ( function_exists( 'wpseo_replace_vars' ) ) {
		$yoasttitle = get_post_meta( $postid, '_yoast_wpseo_title', true );
		if ( $yoasttitle ) {
			$title = wpseo_replace_vars( $yoasttitle, get_post( $postid ) );
		}
	}
	if ( function_exists( 'get_field' ) ) {
		$alternatieve_paginatitel_gebruiken = get_field( 'alternatieve_paginatitel_gebruiken', $postid );
		if ( strtolower( $alternatieve_paginatitel_gebruiken ) == 'ja' ) {
			$alternatieve_paginatitel = get_field( 'alternatieve_paginatitel', $postid );
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
	$names = explode( ' ', $value );
	if ( count( $names ) < 2 ) {
		return '';
	}

	return ucwords( $value );
}

//========================================================================================================
add_action( 'cmb2_render_human_name', 'cmb2_render_human_name', 10, 5 );
function cmb2_render_human_name(
	$field, $escaped_value, $object_id,
	$object_type, $field_type_object
) {
	echo $field_type_object->input( array( 'type' => 'text' ) );
}

//========================================================================================================
function rhswp_show_customtax_terms( $taxonomy = 'category', $title = '', $dosection = true, $cssclasses = '', $containerid = '' ) {
	if ( $cssclasses ) {
		$cssclasses = ' class="' . strtolower( $taxonomy ) . ' ' . $cssclasses . '"';
	} else {
		$cssclasses = ' class="' . strtolower( $taxonomy ) . '"';
	}
	$title_id = $taxonomy . '-' . $title;
	if ( $containerid ) {
		$containerid = ' id="' . $containerid . '"';
		$title_id    = $taxonomy . '-' . $containerid;
	} else {
		$containerid = '';
	}
	$sectionstart = '<section aria-labelledby="' . sanitize_title( $title_id ) . '">';
	$sectionend   = '</section>';
	if ( ! $dosection ) {
		$sectionstart = '';
		$sectionend   = '';
	}
	if ( taxonomy_exists( $taxonomy ) ) {
		$show_count   = false;
		$pad_counts   = false;
		$hierarchical = true;
// to-do: walker weer aan zetten
		$args  = array(
			'taxonomy'           => $taxonomy,
			'orderby'            => 'name',
			'order'              => 'ASC',
			'hide_empty'         => true,
			'ignore_custom_sort' => true,
			'echo'               => 0,
			'hierarchical'       => true,
			'title_li'           => '',
//      'walker'                => new rhswp_custom_walker_for_taxonomies()
		);
		$terms = wp_list_categories( $args );
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			echo $sectionstart;
			if ( $title ) {
				echo '<h2 id="' . sanitize_title( $title_id ) . '">' . $title . '</h2>';
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
		if ( ( ! is_admin() ) && ( ! is_feed() ) ) {
			$needle      = '&lt;strong&gt;';
			$replacer    = '';
			$description = str_replace( $needle, $replacer, $description );
			$needle      = '&lt;/strong&gt;';
			$replacer    = '';
			$description = str_replace( $needle, $replacer, $description );
			$needle      = 'Digitale overheid';
			$replacer    = '<strong>Digitale overheid</strong>';
			$description = str_replace( $needle, $replacer, $description );
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

	return $loop;
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
add_action( 'init', 'rhswp_fix_blog_pagination' );
function rhswp_fix_blog_pagination() {
	add_rewrite_rule(
		'actueel/page/([0-9]+)/?$',
		'index.php?pagename=actueel&paged=$matches[1]',
		'top'
	);
}

//========================================================================================================
if ( RHSWP_DOSSIERPOSTCONTEXT_OPTION_DO_FLUSH ) {
	add_action( 'init', 'rhswp_dossiercontext_flush_check', 99 );
}
function rhswp_dossiercontext_flush_check() {
	$check = get_option( RHSWP_DOSSIERPOSTCONTEXT_OPTION );
	if ( ! $check == RHSWP_DOSSIERPOSTCONTEXT ) {
		dodebug_do( 'Wel spoelen' );
		flush_rewrite_rules();
		delete_option( RHSWP_DOSSIERPOSTCONTEXT_OPTION );
		add_option( RHSWP_DOSSIERPOSTCONTEXT_OPTION, RHSWP_DOSSIERPOSTCONTEXT );
	}
}

//========================================================================================================
add_action( 'query_vars', 'rhswp_dossiercontext_add_query_vars' );
function rhswp_dossiercontext_add_query_vars( $vars ) {
	$vars[] = RHSWP_DOSSIERPOSTCONTEXT;
	$vars[] = RHSWP_DOSSIERCONTEXTPOSTOVERVIEW;
	$vars[] = RHSWP_DOSSIERCONTEXTCATEGORYPOSTOVERVIEW;
	$vars[] = RHSWP_DOSSIERCONTEXTEVENTOVERVIEW;
	$vars[] = RHSWP_DOSSIERCONTEXTDOCUMENTOVERVIEW;
	$vars[] = 'searchwpquery';
	$vars[] = 'sortdossier'; // wordt gebruikt door template page_showalldossiers-nieuwestyling.php

	return $vars;
}

//========================================================================================================
function rhswp_extra_contentblokken_checker() {
	global $post;
	$debugstring = '';
	$returnvalue = false;
	if ( is_page() || is_singular( 'post' ) ) {
		// is een pagina of een bericht
		$theid          = get_the_ID();
		$contentblokken = get_field( 'extra_contentblokken', $theid );
	} elseif ( is_tax( RHSWP_CT_DOSSIER ) ) {
		$theid          = RHSWP_CT_DOSSIER . '_' . get_queried_object()->term_id;
		$contentblokken = get_field( 'extra_contentblokken', $theid );
	} else {
		$theid          = RHSWP_CT_DOSSIER . '_' . get_queried_object()->term_id;
		$contentblokken = get_field( 'extra_contentblokken', $theid );
		$debugstring    = 'rhswp_extra_contentblokken_checker / else ' . $theid;
	}
	$debugstring = rhswp_get_context_info();
	if ( $contentblokken ) {
		$returnvalue = true;
		$debugstring .= '. Er zijn contentblokkken voor ' . $theid;
	} else {
		$debugstring .= '. Helaas geen contentblokkken voor ' . $theid;
	}
	if ( $debugstring ) {
		dodebug_do( $debugstring );
	}

	return $returnvalue;
}

//========================================================================================================
function rhswp_check_caroussel_or_featured_img() {
	global $post;
//	Ik weet dus for the life of me niet meer waarom dit een reden zou moeten zijn om geen header image te tonen
//	heb dit met het oog op flitspanel.nl uitgezet
//	if ( ( ! taxonomy_exists( RHSWP_CT_DOSSIER ) ) || ( ! taxonomy_exists( RHSWP_CT_DIGIBETER ) ) ) {
//		return;
//	}
	if ( ! function_exists( 'get_field' ) ) {
		return;
	}
	if ( is_search() || is_404() ) {
		return;
	}
	$theid = 0;
	if ( is_tax() ) {
	} else {
		$theid = get_the_id();
	}
	if ( $theid ) {
		// er is een page of post ID
	} else {
		// geen post ID, dus ws. een taxonomie
	}
	if (
		( 'page_digibeter-home.php' == get_page_template_slug( get_the_ID() ) ) ||
		( 'page_toolbox-home.php' == get_page_template_slug( get_the_ID() ) ) ||
		( 'page_toolbox-cyberincident.php' == get_page_template_slug( get_the_ID() ) )
	) {
		// voorkomen dat pagina's met dit template ook een carroussel laten zien
		// toolbox template pagina's: dus geen header image tonen
		dodebug_do( 'voorkomen dat pagina\'s met dit template ook een carroussel laten zien: ' . get_page_template_slug( get_the_ID() ) );

		return;
	}
//	elseif ( is_tax( RHSWP_CT_DOSSIER ) ) {
//		// geen plaatjes bij een dossier
//		dodebug_do('geen plaatjes bij dit dossier: ' . RHSWP_CT_DOSSIER );
//		return;
//	}
	elseif (
		( is_single() && DOPT__ACTIELIJN_CPT == get_post_type() ) ||
		( is_single() && DOPT__GEBEURTENIS_CPT == get_post_type() )
	) {
		// geen header image voor actielijnen
		return;
	} elseif ( has_term( '', RHSWP_CT_DIGIBETER, $theid ) && ( ! is_tax( RHSWP_CT_DIGIBETER ) ) ) {
		$digibeterterms = wp_get_post_terms( $theid, RHSWP_CT_DIGIBETER );
		if ( $digibeterterms ) {
			echo '<div class="wrap header-image">';
			foreach ( $digibeterterms as $digibeterterm ) {
				$acfid          = RHSWP_CT_DIGIBETER . '_' . $digibeterterm->term_id;
				$digibeterimage = get_field( 'digibeter_term_hoofdstukplaatje', $acfid );
				$digibeterclass = get_field( 'digibeter_term_achtergrondkleur', $acfid );
				// default image is part of this theme
				$image    = RHSWP_THEMEFOLDER . '/images/digibeter-icons/' . $digibeterclass . '.svg';
				$alttekst = '';
				// but if an image is attached to this term, show the uploaded image
				if ( $digibeterimage ) {
					$image    = $digibeterimage['url'];
					$alttekst = $digibeterimage['alt'];
				} else {
					// extra array met alt-teksten voor de headerimages.
					// indien geen tekst ingevoerd is het alt-attribuut gewoon leeg.
					// @since 2.12.18
					if ( WP_OVERHEID_ALT[ $digibeterclass ] ) {
						$alttekst = sprintf( _x( 'Logo for %s', 'alt-tekst voor beleidskleurplaatjes', 'wp-rijkshuisstijl' ), WP_OVERHEID_ALT[ $digibeterclass ] );
					}
				}
				echo '<img src="' . $image . '" alt="' . $alttekst . '" width="1200" height="400" >';
			}
			echo '</div>';
		}
	} else {
		$carousselcheck = '';
		$divid          = '';
		if (
			( RHSWP_DOSSIERCONTEXTPOSTOVERVIEW == get_query_var( 'pagename' ) ) ||
			( RHSWP_DOSSIERCONTEXTEVENTOVERVIEW == get_query_var( 'pagename' ) ) ||
			( RHSWP_DOSSIERCONTEXTDOCUMENTOVERVIEW == get_query_var( 'pagename' ) )
		) {
			// dit is dus zo'n bijzondere pagina die berichten, events of documenten toont bij een dossier
			$term = get_term_by( 'slug', get_query_var( RHSWP_CT_DOSSIER ), RHSWP_CT_DOSSIER );
			if ( $term ) {
				$theid          = RHSWP_CT_DOSSIER . '_' . $term->term_id;
				$divid          = $term->term_id;
				$carousselcheck = get_field( 'carrousel_tonen_op_deze_pagina', $theid );
				$currentterm    = $term->term_id;
			}
		} elseif ( is_page() ) {
			$theid          = get_the_ID();
			$divid          = $theid;
			$carousselcheck = get_field( 'carrousel_tonen_op_deze_pagina', $theid );
		} elseif ( is_tax( RHSWP_CT_DOSSIER ) ) {
			$theid          = RHSWP_CT_DOSSIER . '_' . get_queried_object()->term_id;
			$divid          = get_queried_object()->term_id;
			$carousselcheck = get_field( 'carrousel_tonen_op_deze_pagina', $theid );
			$currentterm    = get_queried_object()->term_id;
		}
		if ( RHSWP_HEADER_IMAGE_CONFIRM == $carousselcheck ) {
			$headerimage = get_field( 'kies_header_image', $theid );
			$image_tekst = get_field( 'kies_header_image_tekst', $theid );
			if ( $headerimage ) {
				// image tonen, geen caroussel
				$thumb  = $headerimage['sizes'][ RHSWP_HERO_IMAGE2_WIDTH_NAME ];
				$width  = $headerimage['sizes'][ RHSWP_HERO_IMAGE2_WIDTH_NAME . '-width' ];
				$height = $headerimage['sizes'][ RHSWP_HERO_IMAGE2_WIDTH_NAME . '-height' ];
				if ( RHSWP_MIN_HERO_IMAGE_WIDTH <= $width ) {
					echo '<div class="hero-image" id="hero_' . $divid . '">';
					echo '<div class="wrapper">';
					if ( $image_tekst ) {
						echo '<div class="hero-image-tekst">';
						echo $image_tekst;
						echo '</div>';
					} else {
						echo '&nbsp;';
						if ( is_home() || is_front_page() ) {
							if ( 'hide' === get_field( 'siteoption_hide_searchbox', 'option' ) ) {
								// alleen als het zoekformulier expliciet op verborgen is gezet, verbergen
							} else {
								get_search_form();
							}
						}
					}
					echo '</div>'; // .wrapper
					echo '</div>'; // .hero-image / #hero_' . $divid . '
				}
			}
		} elseif ( RHSWP_HEADER_CARROUSEL_CONFIRM == $carousselcheck ) {
			// caroussel tonen, geen image
			$getcarousel = get_field( 'kies_carrousel', $theid );
			$carouselid  = 0;
			if ( is_object( $getcarousel ) ) {
				$carouselid      = $getcarousel->ID;
				$carouseltitle   = $getcarousel->post_title;
				$carrousel_items = get_field( 'carrousel_items', $carouselid );
			}
			if ( have_rows( 'carrousel_items', $carouselid ) ) {
				$itemcounter = 'items' . count( $carrousel_items );
				echo '<div class="slider">';
				echo '<div class="wrap">';
				echo '<p class="visuallyhidden">' . $carouseltitle . '</p>';
				echo '<p class="slidenav" id="slidenavid">&nbsp;</p>';
				echo '<ul class="carousel ' . $itemcounter . '" id="carousel" data-slidecount="' . $itemcounter . '">';
				$slidecounter = 0;
				foreach ( $carrousel_items as $row ) {
					$slidecounter ++;
					$link_img_start      = '';
					$link_end            = '';
					$slide_link_start    = '';
					$slide_link_end      = '';
					$slide_caption_start = '<div class="caption">';
					$slide_caption_end   = '</div>';
					$image               = $row['carrousel_item_photo'];
					$titel               = esc_html( $row['carrousel_item_title'] );
					$text                = esc_html( $row['carrousel_item_short_text'] );
					$type                = $row['carrousel_item_link_type'];
					$link                = $row['carrousel_item_link_page'];
					$dossier             = $row['carrousel_item_link_dossier'];
					$size                = RHSWP_HERO_IMAGE_WIDTH_NAME;
					$selected            = '';
					if ( $slidecounter == 1 ) {
						$selected = ' class="slide selected"';
					} else {
						$selected = ' class="slide"';
					}
					echo '<li' . $selected . '>';
					if ( $link && $type == 'pagina' ) {
						$linkid           = array_pop( $link );
						$link_img_start   = '<a href="' . get_permalink( $linkid ) . '" tabindex="-1" class="img-container">';
						$link_end         = '</a>';
						$slide_link_start = '<a href="' . get_permalink( $linkid ) . '">';
						$slide_link_end   = '</a>';
					} elseif ( $dossier && $type == 'dossier' ) {
						$link_img_start   = '<a href="' . get_term_link( $dossier ) . '" tabindex="-1" class="img-container">';
						$link_end         = '</a>';
						$slide_link_start = '<a href="' . get_term_link( $dossier ) . '">';
						$slide_link_end   = '</a>';
					} else {
						$link_img_start = '<span class="img-container">';
						$link_end       = '</span>';
					}
					if ( $image ) {
						$thumb  = $image['sizes'][ $size ];
						$width  = $image['sizes'][ $size . '-width' ];
						$height = $image['sizes'][ $size . '-height' ];
						echo $slide_link_start;
						if ( $titel || $text ) {
							echo $slide_caption_start;
							if ( $titel ) {
								echo '<h2 class="caption-title">' . $titel . '</h2>';
							}
							if ( $text ) {
								echo '<p class="caption-text">' . $text . '</p>';
							}
							echo $slide_caption_end;
						}
						echo '<img src="' . $thumb . '" alt="Bekijk de pagina ' . $titel . '" width="' . $width . '" height="' . $height . '" />';
						echo $slide_link_end;
					}
					echo '</li>';
				}
				echo '</ul></div></div>';
			}
		} elseif ( is_singular() ) {
			$postid = get_the_id();
			if ( has_post_thumbnail( $postid ) ) {
				// geen carroussel nodig, maar er is wel een featured image
				// is dit featured image wel breed genoeg voor een heroimage?
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), RHSWP_HERO_IMAGE_WIDTH_NAME );
				if ( RHSWP_MIN_HERO_IMAGE_WIDTH <= $image[1] ) {
					// plaatje is van zichzelf breed genoeg
					echo '<div class="hero-image wrap">' . get_the_post_thumbnail( $postid, 'full' ) . '</div>';
				} else {
					// plaatje is niet breed genoeg. We schrijven 'm dadelijk wel uit, na de titel en naast de inleiding.
					//          echo '<div class="hero-image wrap" style="border: 20px solid red;">niet deze, want breedte van de ' . RHSWP_HERO_IMAGE_WIDTH_NAME . '-versie van dit plaatje is ' . $image[1] . ' en hoogte is: ' . $image[2] . '<br>' . get_the_post_thumbnail( $postid, 'full' ) . '</div>';
				}
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
function rhswp_translateposttypes( $posttype = '', $plural = false ) {
	$returnstring = '';
	switch ( strtolower( $posttype ) ) {
		case 'post':
			$returnstring = esc_html( _x( "Post", 'post types', 'wp-rijkshuisstijl' ) );
			if ( $plural ) {
				$returnstring = esc_html( _x( "Posts", 'post types', 'wp-rijkshuisstijl' ) );
			}
			break;
		case 'page':
			$returnstring = esc_html( _x( "Page", 'post types', 'wp-rijkshuisstijl' ) );
			if ( $plural ) {
				$returnstring = esc_html( _x( "Pages", 'post types', 'wp-rijkshuisstijl' ) );
			}
			break;
		case RHSWP_CT_DOSSIER:
			$returnstring = esc_html( _x( "Topic", 'post types', 'wp-rijkshuisstijl' ) );
			if ( $plural ) {
				$returnstring = esc_html( _x( "Topics", 'post types', 'wp-rijkshuisstijl' ) );
			}
			break;
		case 'attachment':
			$returnstring = esc_html( _x( "Attachment", 'post types', 'wp-rijkshuisstijl' ) );
			if ( $plural ) {
				$returnstring = esc_html( _x( "Attachments", 'post types', 'wp-rijkshuisstijl' ) );
			}
			break;
		case RHSWP_CPT_DOCUMENT:
			$returnstring = esc_html( _x( "Document", 'post types', 'wp-rijkshuisstijl' ) );
			if ( $plural ) {
				$returnstring = esc_html( _x( "Documents", 'post types', 'wp-rijkshuisstijl' ) );
			}
			break;
		case RHSWP_CPT_EVENT:
			$returnstring = esc_html( _x( "Event", 'post types', 'wp-rijkshuisstijl' ) );
			if ( $plural ) {
				$returnstring = esc_html( _x( "Events", 'post types', 'wp-rijkshuisstijl' ) );
			}
			break;
		case DOPT__GEBEURTENIS_CPT:
			$returnstring = esc_html( _x( "Planning", 'post types', 'wp-rijkshuisstijl' ) );
			if ( $plural ) {
				$returnstring = esc_html( _x( "Planning", 'post types', 'wp-rijkshuisstijl' ) );
			}
			break;
		case DOPT__ACTIELIJN_CPT:
			$returnstring = esc_html( _x( "Planning", 'post types', 'wp-rijkshuisstijl' ) );
			if ( $plural ) {
				$returnstring = esc_html( _x( "Planning", 'post types', 'wp-rijkshuisstijl' ) );
			}
			break;
		case RHSWP_CPT_SLIDER:
			$returnstring = esc_html( __( "No sliders please", 'wp-rijkshuisstijl' ) );
			break;
		default:
			$returnstring = $posttype;
	}

	return $returnstring;
}

//========================================================================================================
function rhswp_translatemimetypes( $posttype = '' ) {
	$returnstring = '';
	switch ( $posttype ) {
		case 'image/jpeg':
		case 'image/png':
		case 'image/gif':
			$returnstring = esc_html( _x( "Image", 'post types', 'wp-rijkshuisstijl' ) );
			break;
		case 'text/csv':
		case 'text/plain':
		case 'text/xml':
			$returnstring = esc_html( _x( "Text file", 'post types', 'wp-rijkshuisstijl' ) );
			break;
		case 'video/mpeg':
		case 'video/mp4':
		case 'video/quicktime':
			$returnstring = esc_html( _x( "Movie file", 'post types', 'wp-rijkshuisstijl' ) );
			break;
		case 'application/pdf':
			$returnstring = esc_html( _x( "PDF file", 'post types', 'wp-rijkshuisstijl' ) );
			break;
		default:
			$returnstring = esc_html( _x( "Document", 'post types', 'wp-rijkshuisstijl' ) );
			break;
	}

	return $returnstring;
}

//========================================================================================================
function rhswp_filter_input_string( $string ) {
	$text = htmlspecialchars( $string );
	$text = preg_replace( "/</", "-", $text );
	$text = preg_replace( "/>/", "-", $text );
	$text = preg_replace( "/script/", "ja doei", $text );
	$text = preg_replace( "/username/i", " *zucht* ", trim( $text ) );
	$text = preg_replace( "/password/i", " *gaap* ", trim( $text ) );
	$text = preg_replace( "/;DROP /i", " *snurk* ", trim( $text ) );
	$text = preg_replace( "/select /i", " *fart* ", trim( $text ) );
	$text = preg_replace( "/ table /i", " *pfffffrt* ", trim( $text ) );

	return $text;
}

//========================================================================================================
add_filter( 'genesis_next_link_text', 'rhswp_paging_next' );
function rhswp_paging_next( $text ) {
	if ( is_category() ) {
		return esc_html( _x( "Previous posts", "paging: to older", 'wp-rijkshuisstijl' ) );
	} else {
		return esc_html( _x( "Next page", "paging: to older", 'wp-rijkshuisstijl' ) );
	}
}

//========================================================================================================
add_filter( 'genesis_prev_link_text', 'rhswp_paging_previous' );
function rhswp_paging_previous( $text ) {
	if ( is_category() ) {
		return esc_html( _x( "Newer posts", "paging: to newer", 'wp-rijkshuisstijl' ) );
	} else {
		return esc_html( _x( "Previous page", 'paging: to newer', 'wp-rijkshuisstijl' ) );
	}
}

//========================================================================================================
function human_filesize( $bytes, $decimals = 1 ) {
	$sz            = 'BkMGTP';
	$factor        = floor( ( strlen( $bytes ) - 1 ) / 3 );
	$humanreadable = ( sprintf( "%.{$decimals}f", $bytes / pow( 1024, $factor ) ) . @$sz[ $factor ] );
	$humanreadable = str_replace( '.', ',', $humanreadable );

	return $humanreadable . 'B';
}

//========================================================================================================


function rhswp_single_add_featured_image() {

	global $post;

	if ( ( is_single() && ( 'post' == get_post_type() ) || ( 'page' == get_post_type() ) ) && ( has_post_thumbnail() ) && ( ! is_front_page() && ! is_home() ) ) {
		$theid                    = get_the_ID();
		$carousselcheck           = get_field( 'carrousel_tonen_op_deze_pagina', $theid );
		$featimg_automatic_insert = get_field( 'featimg_automatic_insert', $theid );
		$postid                   = get_the_id();
		$cssid                    = 'image_featured_image_post_' . $postid;
		if ( ( strval( $carousselcheck ) !== 'ja' ) && ( strval( $featimg_automatic_insert ) !== 'nee' ) && has_post_thumbnail( $postid ) ) {
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), 'full' );
//      if ( $image[1] < RHSWP_MIN_HERO_IMAGE_WIDTH ) {
			if ( RHSWP_MIN_HERO_IMAGE_WIDTH >= $image[1] ) {
				// de featured image is niet groot genoeg om gebruikt te worden als hero-image.
				// dus hebben we geen hiervoor geen hero-image neergezet
				// dus mogeen we hem hier WEL neerzeggen.
				// hoera...
				$alignment = ' alignright';
				if ( class_exists( 'toc' ) && is_page() ) {
					// the TOC+ plugin is active
					$alignment = ' alignleft toc-active';
				}
// TODO
//				$alignment .= ' test';

				$theimageobject  = get_post( get_post_thumbnail_id() );
				$get_description = $theimageobject->post_excerpt;
				// check for an image caption
				if ( ! empty( $theimageobject->post_excerpt ) ) {
					echo '<div class="featured wp-caption ' . $alignment . '">';
				} else {
					echo '<div class="featured ' . $alignment . '">';
				}
				// todo
				echo get_the_post_thumbnail( $postid, 'article-visual', array( 'class' => 'alignright' ) );
				// write the image caption if any
				if ( ! empty( $theimageobject->post_excerpt ) ) {
					echo '<p class="wp-caption-text">' . $theimageobject->post_excerpt . '</p>';
				}
				echo '</div>';
			} else {
				// het plaatje is al neergezet als hero-image, want de breedte is groter dan RHSWP_MIN_HERO_IMAGE_WIDTH (1200px)
			}
		}
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
	if ( $query->is_main_query() && ! is_admin() && is_tax( RHSWP_CT_DOSSIER ) ) {
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
add_action( 'wp_enqueue_scripts', 'rhswp_add_blog_archive_css' );
function rhswp_add_blog_archive_css() {
	global $imgbreakpoints;
	$blogberichten_css = "
.block a:not([href*=\"" . $_SERVER["HTTP_HOST"] . "\"]),
.entry-content a:not([href*=\"" . $_SERVER["HTTP_HOST"] . "\"]) {
  padding-right: 1em;
  background-image: url('" . RHSWP_THEMEFOLDER . "/images/icon-external-link.svg');
  background-repeat: no-repeat;
  background-position: right center;
  background-size: .75em .75em;
}
.block a:not([href*=\"" . $_SERVER["HTTP_HOST"] . "\"]):visited,
.entry-content a:not([href*=\"" . $_SERVER["HTTP_HOST"] . "\"]):visited {
  background-image: url('" . RHSWP_THEMEFOLDER . "/images/icon-external-link-visited.svg');
}
.block a:not([href*=\"" . $_SERVER["HTTP_HOST"] . "\"]):active,
.block a:not([href*=\"" . $_SERVER["HTTP_HOST"] . "\"]):focus,
.block a:not([href*=\"" . $_SERVER["HTTP_HOST"] . "\"]):hover,
.entry-content a:not([href*=\"" . $_SERVER["HTTP_HOST"] . "\"]):active,
.entry-content a:not([href*=\"" . $_SERVER["HTTP_HOST"] . "\"]):focus,
.entry-content a:not([href*=\"" . $_SERVER["HTTP_HOST"] . "\"]):hover {
  background-image: url('" . RHSWP_THEMEFOLDER . "/images/icon-external-link-hover.svg');
  color: #A02F1D;
}
.entry-content .borderframe.blue a:not([href*=\"" . $_SERVER["HTTP_HOST"] . "\"]):active,
.entry-content .borderframe.blue a:not([href*=\"" . $_SERVER["HTTP_HOST"] . "\"]):focus,
.entry-content .borderframe.blue a:not([href*=\"" . $_SERVER["HTTP_HOST"] . "\"]):hover,
.entry-content .borderframe.blue a:not([href*=\"" . $_SERVER["HTTP_HOST"] . "\"]) {
  background-image: url('" . RHSWP_THEMEFOLDER . "/images/icon-external-link-white.svg');
}
.entry-content a:not([href]),
.entry-content .links li a,
.entry-content a[href^=\"/\"],
.entry-content a[href^=\"#\"],
.entry-content a[href*=\"tel:\"],
.entry-content a[href*=\"mailto:\"] {
  padding-right: 0 !important;
  background: none !important;
}";
	$countertje        = 0;
	if ( have_posts() || is_tax( RHSWP_CT_DOSSIER ) ) :
		$divid          = '';
		$carousselcheck = false;
		if ( function_exists( 'get_field' ) ) {
			if (
				( RHSWP_DOSSIERCONTEXTPOSTOVERVIEW == get_query_var( 'pagename' ) ) ||
				( RHSWP_DOSSIERCONTEXTEVENTOVERVIEW == get_query_var( 'pagename' ) ) ||
				( RHSWP_DOSSIERCONTEXTDOCUMENTOVERVIEW == get_query_var( 'pagename' ) )
			) {
				// dit is dus zo'n bijzondere pagina die berichten, events of documenten toont bij een dossier
				$term = get_term_by( 'slug', get_query_var( RHSWP_CT_DOSSIER ), RHSWP_CT_DOSSIER );
				if ( $term ) {
					$theid          = RHSWP_CT_DOSSIER . '_' . $term->term_id;
					$divid          = $term->term_id;
					$carousselcheck = get_field( 'carrousel_tonen_op_deze_pagina', $theid );
					$currentterm    = $term->term_id;
				}
			} elseif ( is_page() ) {
				$theid          = get_the_ID();
				$divid          = $theid;
				$carousselcheck = get_field( 'carrousel_tonen_op_deze_pagina', $theid );
			} elseif ( is_tax( RHSWP_CT_DOSSIER ) ) {
				$theid          = RHSWP_CT_DOSSIER . '_' . get_queried_object()->term_id;
				$divid          = get_queried_object()->term_id;
				$carousselcheck = get_field( 'carrousel_tonen_op_deze_pagina', $theid );
				$currentterm    = get_queried_object()->term_id;
			}
		} else {
			echo '<p>rhswp_add_blog_archive_css: ACF plugin is niet actief</p>';

			return;
		}
		if ( RHSWP_HEADER_IMAGE_CONFIRM == $carousselcheck ) {
			$headerimage = get_field( 'kies_header_image', $theid );
			if ( $headerimage ) {
				$thumb  = $headerimage['sizes'][ RHSWP_HERO_IMAGE2_WIDTH_NAME ];
				$width  = $headerimage['sizes'][ RHSWP_HERO_IMAGE2_WIDTH_NAME . '-width' ];
				$height = $headerimage['sizes'][ RHSWP_HERO_IMAGE2_WIDTH_NAME . '-height' ];
				if ( RHSWP_MIN_HERO_IMAGE_WIDTH <= $width ) {
					$blogberichten_css .= '#hero_' . $divid . " { ";
					$blogberichten_css .= "background-image: url('" . $thumb . "'); ";
					$blogberichten_css .= "} ";
				}
			}
		}
		while ( have_posts() ) : the_post();
			// do loop stuff
			$countertje ++;
			$getid        = get_the_ID();
			$the_image_ID = 'image_featured_image_post_' . $getid;
//      if ( $countertje <= RHSWP_NR_FEAT_IMAGES && has_post_thumbnail( $getid ) ) {
			if ( has_post_thumbnail( $getid ) ) {
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $getid ), 'full' );
				if ( $image[0] ) {
					$blogberichten_css .= '#' . $the_image_ID . " {\n";
					$blogberichten_css .= "background-image: url('" . $image[0] . "'); ";
					$blogberichten_css .= "}\n";
				}
			}
		endwhile;
	/** end of one post **/
	else : /** if no posts exist **/
	endif;
	/** end loop **/
	// extra contentblokken hier
	if ( is_page() || is_tax() ) {
		$dossier_in_content_block = '';
		$contentblokken           = null;
		if ( taxonomy_exists( RHSWP_CT_DOSSIER ) ) {
			if ( is_page() ) {
				$theid                    = get_the_ID();
				$contentblokken           = get_field( 'extra_contentblokken', $theid );
				$dossier_in_content_block = get_the_terms( $theid, RHSWP_CT_DOSSIER );
			} elseif ( is_tax( RHSWP_CT_DOSSIER ) ) {
				$theid                    = RHSWP_CT_DOSSIER . '_' . get_queried_object()->term_id;
				$contentblokken           = get_field( 'extra_contentblokken', $theid );
				$dossier_in_content_block = get_queried_object()->term_id;
			}
		}
		if ( ( is_array( $contentblokken ) || is_object( $contentblokken ) ) && ( $contentblokken[0] != '' ) ) {
			$thecounter = 0;
			foreach ( $contentblokken as $row ) {
				$thecounter ++;
				$chosen_category = $row['extra_contentblok_chosen_category'];
				$categoriefilter = $row['extra_contentblok_categoriefilter'];
				$maxnr_posts     = $row['extra_contentblok_maxnr_posts'];
				$type_block      = $row['extra_contentblok_type_block'];
//        $with_featured_image    = $row['extra_contentblok_maxnr_posts_with_featured_image'];
				if ( 'algemeen' == $type_block ) {
					// niks
				} elseif ( 'events' == $type_block ) {
					// ook niks
				} elseif ( 'berichten_paginas' == $type_block ) {
					// net zo min niks
				} elseif ( 'berichten' == $type_block ) {
					// er moet contentblock getoond worden van het type 'berichten'
					$overviewurl               = '';
					$overviewlinktext          = '';
					$toonlinksindossiercontext = false;
					if ( $dossier_in_content_block ) {
						// we zijn op een dossieroverzicht
						$term                      = get_term( $dossier_in_content_block, RHSWP_CT_DOSSIER );
						$currentterm               = $term->term_id;
						$currenttermname           = $term->name;
						$currenttermslug           = $term->slug;
						$toonlinksindossiercontext = $term;
						$args                      = array(
							'post_type'      => 'post',
							'post_status'    => 'publish',
							'posts_per_page' => $maxnr_posts,
							'tax_query'      => array(
								array(
									'taxonomy' => RHSWP_CT_DOSSIER,
									'field'    => 'term_id',
									'terms'    => $currentterm
								),
							)
						);
						$overviewlinktext          = $dossier_in_content_block;
					} else {
						// niet op een dossieroverzicht
						$args = array(
							'post_type'      => 'post',
							'post_status'    => 'publish',
							'posts_per_page' => $maxnr_posts
						);
					}
					if ( $categoriefilter == 'nee' ) {
						$actueelpageid    = get_option( 'page_for_posts' );
						$overviewlinktext = get_the_title( $actueelpageid );
						$overviewurl      = get_permalink( $actueelpageid ); // general page_for_posts
					} else {
						$slugs = array();
						if ( is_array( $chosen_category ) ) {
							foreach ( $chosen_category as $filter ):
								$terminfo         = get_term_by( 'id', $filter, 'category' );
								$slugs[]          = $terminfo->slug;
								$overviewlinktext = $terminfo->name;
								$actueelpageid    = get_option( 'page_for_posts' );
								$overviewurl      = get_permalink( $actueelpageid ) . $terminfo->slug . '/'; // page_for_posts
							endforeach;
							if ( $dossier_in_content_block ) {
								// filter op dossier
								$args = array(
									'post_type'      => 'post',
									'post_status'    => 'publish',
									'posts_per_page' => $maxnr_posts,
									'tax_query'      => array(
										'relation' => 'AND',
										array(
											'taxonomy' => RHSWP_CT_DOSSIER,
											'field'    => 'term_id',
											'terms'    => $dossier_in_content_block
										),
										array(
											'taxonomy' => 'category',
											'field'    => 'slug',
											'terms'    => $slugs,
										)
									)
								);
								// deze weer leeg maken, want er is niet zoiets als een overview mogelijk voor deze combinatie
								$overviewlinktext = '';
								$overviewurl      = '';
							} else {
								// geen verder filter
								$args = array(
									'post_type'      => 'post',
									'post_status'    => 'publish',
									'posts_per_page' => $maxnr_posts,
									'tax_query'      => array(
										array(
											'taxonomy' => 'category',
											'field'    => 'slug',
											'terms'    => $slugs,
										)
									)
								);
							}
						}
					}
					// Assign predefined $args to your query
					$sidebarposts = new WP_query();
					$sidebarposts->query( $args );
					if ( $sidebarposts->have_posts() ) {
						$postcounter = 0;
						while ( $sidebarposts->have_posts() ) : $sidebarposts->the_post();
							$postcounter ++;
							$getid        = get_the_ID();
							$the_image_ID = 'image_featured_image_post_' . $getid;
							$image        = wp_get_attachment_image_src( get_post_thumbnail_id( $getid ), 'full' );
							if ( $image[0] ) {
								$blogberichten_css .= '#' . $the_image_ID . " {\n";
								$blogberichten_css .= "background-image: url('" . $image[0] . "'); ";
								$blogberichten_css .= "}\n";
							}
						endwhile;
					}
					// RESET THE QUERY
					wp_reset_query();
				}
			}
		}
	}
	wp_enqueue_style( RHSWP_ARCHIVE_CSS, RHSWP_THEMEFOLDER . '/css/featured-background-images.css', array(), CHILD_THEME_VERSION, 'screen and (min-width: 650px)' );
	if ( $blogberichten_css ) {
		wp_add_inline_style( RHSWP_ARCHIVE_CSS, $blogberichten_css );
	}
}

//========================================================================================================
/**
 * Add 3 footers with my own markup.
 * aria-labelledby, ja?
 * to-do: check op unieke titel voor widget. Validators gaan er stuk aan als de ID niet uniek is.
 */
add_action( 'widgets_init', 'rhswp_widget_definition_footer1' );
add_action( 'widgets_init', 'rhswp_widget_definition_footer2' );
add_action( 'genesis_footer', 'rhswp_widget_output_footer1' );
add_action( 'genesis_footer', 'rhswp_widget_output_footer2' );
add_action( 'genesis_before_footer-1_widget_area', 'rhswp_footer_payoff' );
// Add in new Widget area
function rhswp_widget_definition_footer1() {
	genesis_register_sidebar( array(
		'id'            => RHSWP_FOOTERWIDGET1,
		'name'          => __( 'Footer widget (left)', 'wp-rijkshuisstijl' ),
		'description'   => __( 'This is the general footer area', 'wp-rijkshuisstijl' ),
		'before_widget' => genesis_markup( array(
			'html5' => '<div id="%1$s" class="widget-area widget footer-widgets-1 footer-widget-area %2$s ' . RHSWP_FOOTERWIDGET1 . '" aria-labelledby="title_' . RHSWP_FOOTERWIDGET1 . '"><div class="widget-wrap">',
			'xhtml' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'echo'  => false,
		) ),
		'after_widget'  => genesis_markup( array(
			'html5' => '</div></div>' . "\n",
			'xhtml' => '</div></div>' . "\n",
			'echo'  => false
		) ),
		'before_title'  => genesis_markup( array(
			'html5' => '<h2 id="title_' . RHSWP_FOOTERWIDGET1 . '">',
			'xhtml' => '<h2 id="title_' . RHSWP_FOOTERWIDGET1 . '">',
			'echo'  => false,
		) ),
		'after_title'   => "</h2>\n",
	) );
}

// Add in new Widget area
function rhswp_widget_definition_footer2() {
	genesis_register_sidebar( array(
		'id'            => RHSWP_FOOTERWIDGET2,
		'name'          => __( 'Footer widget (right)', 'wp-rijkshuisstijl' ),
		'description'   => __( 'This is the general footer area', 'wp-rijkshuisstijl' ),
		'before_widget' => genesis_markup( array(
			'html5' => '<div id="%1$s" class="widget-area widget footer-widgets-2 footer-widget-area %2$s ' . RHSWP_FOOTERWIDGET2 . '"><div class="widget-wrap">',
			'xhtml' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'echo'  => false,
		) ),
		'after_widget'  => genesis_markup( array(
			'html5' => '</div></div>' . "\n",
			'xhtml' => '</div></div>' . "\n",
			'echo'  => false
		) ),
		'before_title'  => genesis_markup( array(
			'html5' => '<h2>',
			'xhtml' => '<h2">',
			'echo'  => false,
		) ),
		'after_title'   => "</h2>\n",
	) );
}

//========================================================================================================
// Position the Footer Area
function rhswp_widget_output_footer1() {
	genesis_widget_area( RHSWP_FOOTERWIDGET1, array(
		'before' => '<div class="footer-widgets" id="genesis-footer-widgets" aria-label="' . _x( "Extra information and links in the footer", "naam widget area in footer", 'wp-rijkshuisstijl' ) . '" role="complementary"><div class="wrap"><div class="container" id="footer1">',
		'after'  => '</div>',
	) );
}

//========================================================================================================
// Position the Footer Area
function rhswp_widget_output_footer2() {
	genesis_widget_area( RHSWP_FOOTERWIDGET2, array(
		'before' => '<div class="container" id="footer2">',
		'after'  => '</div></div></div>',
	) );
}

//========================================================================================================
function rhswp_contactreactie_get_url( $atts ) {
	global $post;

	return esc_html( get_permalink( $post->ID ) );
}

add_shortcode( 'getreactieurl', 'rhswp_contactreactie_get_url' );
//========================================================================================================
function rhswp_contactreactie_get_title( $atts ) {
	global $post;

	return esc_html( get_the_title( $post->ID ) );
}

add_shortcode( 'getreactietitle', 'rhswp_contactreactie_get_title' );
//========================================================================================================
/**
 * Remove Contact Form 7 scripts + styles unless we're on the contact page
 *
 */
add_action( 'wp_enqueue_scripts', 'rhswp_remove_external_styles', 100 );
// niet 2x dezelfde functie
//add_action( 'wp_print_styles', 'rhswp_remove_external_styles', 100 );
function rhswp_remove_external_styles() {
	$configuration = array();
	$versie        = '';
	wp_deregister_style( 'contact-form-7' );
	wp_deregister_style( 'toc-screen' );
	wp_deregister_style( 'cptch_stylesheet' );
	wp_deregister_style( 'cptch_desktop_style' );
	wp_deregister_style( 'newsletter' );
	wp_dequeue_style( 'newsletter-css' );
	wp_deregister_style( 'wpacc-genesis-dropdown-css' );
	wp_deregister_style( 'duplicate-post' );
	wp_dequeue_style( 'duplicate-post-css' );
	if ( ! is_user_logged_in() ) {
		wp_dequeue_style( 'wp-block-library' );
		wp_deregister_style( 'dashicons' );
	}
	// no more gravity forms
	wp_deregister_style( 'gforms_formsmain_css' );
	wp_dequeue_style( 'gforms_formsmain_css' );
	wp_deregister_style( 'gforms_browsers_css' );
	wp_dequeue_style( 'gforms_browsers_css' );

	if ( defined( 'MINERVA_KB_PLUGIN_PREFIX' ) ) {
		// Minerva Knowledge Base plugin is actief
		$handle = 'minerva-kb/css';
		wp_deregister_style( $handle );
		wp_dequeue_style( $handle );
//		echo $handle . '<br>';
	}


	$configfile    = file_get_contents( trailingslashit( get_stylesheet_directory() ) . FLAVORSCONFIG );
	$configfile    = json_decode( $configfile, true );
	$theme_options = get_option( 'rhswp_customizer_theme_options' );
	$flavor        = DEFAULTFLAVOR; // default, tenzij er een smaakje is gekozen
	if ( isset( $theme_options['flavor_select'] ) ) {
		$flavor = $theme_options['flavor_select'];
	}
	if ( isset( $configfile[ DEFAULTFLAVOR ] ) ) {
		$defaultsettings = $configfile[ DEFAULTFLAVOR ];
	} else {
		// iemand heeft een typvaud gemaakt en de in dit bestand hier
		// gedefinieerde default staat niet in het json-bestand.
		// Beetje jammer, maar dan nemen we -op hoop van zegen- het
		// eerste setje configuratieregels
		$defaultsettings = reset( $configfile );
	}
	if ( isset( $configfile[ $flavor ] ) ) {
		// admin has chosen a flavor (any flavor), so let's
		// merge the configuration of chosen flavor with the default settings
		$configuration = wp_parse_args( $configfile[ $flavor ], $defaultsettings );
	} else {
		// no flavor chosen, so set the configuration to the default settings
		$configuration = $defaultsettings;
	}
	// standaard CSS niet meer gebruiken
	wp_dequeue_style( 'rijkshuisstijl-digitale-overheid' );
	wp_deregister_style( 'rijkshuisstijl-digitale-overheid' );
	foreach ( $configuration['cssfiles'] as $key => $value ) {
		$dependencies = $value['dependencies'];
		$versie       = filemtime( dirname( __FILE__ ) . $value['file'] );
		wp_enqueue_style( $value['handle'], get_stylesheet_directory_uri() . $value['file'], $dependencies, $versie, 'all' );
	}
}

//========================================================================================================

// Deze functie checkt of een referrer op de juiste manier is doorgegeven en geeft de titel terug

function rhswp_contacformulier_referrer_title( $atts ) {
	global $post;
	$return = '';

	// de referrer kan een dossier zijn of een normaal contenttype
	if ( isset( $_GET['dossierid'] ) ) {
		$dossierid = (int) $_GET['dossierid']; // een dossier
	}
	if ( isset( $_GET['postid'] ) ) {
		$postid = (int) $_GET['postid']; // een normaal contenttype
	}

	if ( wp_verify_nonce( $_REQUEST['referrersource'], 'postid_' . $postid ) ) {
		// de verificatie klopt voor een normaal contenttype
		$return = get_the_title( $postid );
	} elseif ( wp_verify_nonce( $_REQUEST['referrersource'], 'dossierid_' . $dossierid ) ) {
		// de verificatie klopt voor een dossier
		$termname = get_term_by( 'ID', $dossierid, RHSWP_CT_DOSSIER );
		if ( $termname && ! is_wp_error( $termname ) ) {
			$return = $termname->name;
		}
	}

	return esc_html( $return );

}

add_shortcode( 'contacformulier_referrer_title', 'rhswp_contacformulier_referrer_title' );

//========================================================================================================

// Deze functie checkt of een referrer op de juiste manier is doorgegeven en geeft de URL terug

function rhswp_contacformulier_referrer( $atts ) {
	global $post;
	$return = '';

	// de referrer kan een dossier zijn of een normaal contenttype
	if ( isset( $_GET['dossierid'] ) ) {
		$dossierid = (int) $_GET['dossierid']; // een dossier
	}
	if ( isset( $_GET['postid'] ) ) {
		$postid = (int) $_GET['postid']; // een normaal contenttype
	}

	if ( wp_verify_nonce( $_REQUEST['referrersource'], 'postid_' . $postid ) ) {
		// de verificatie klopt voor een normaal contenttype
		$return = get_permalink( $postid );
	} elseif ( wp_verify_nonce( $_REQUEST['referrersource'], 'dossierid_' . $dossierid ) ) {
		// de verificatie klopt voor een dossier
		$return = get_term_link( $dossierid );
	}

	return esc_html( $return );

}

add_shortcode( 'contacformulier_referrer', 'rhswp_contacformulier_referrer' );

//========================================================================================================

/**
 * Adds contact form. This form is set in the site's options (admin > Appearance > options)
 *
 */
//add_action( 'genesis_after_loop', 'rhswp_contactreactie_write_reactieform', 15 );
add_action( 'genesis_before_footer', 'rhswp_contactreactie_write_reactieform', 15 );

function rhswp_contactreactie_write_reactieform() {

	global $post;
	$posttype                  = '';
	$toon_reactieformulier     = 'default';
	$documenttypes             = array( 'post', 'page' );
	$doctype_check             = false;
	$postid                    = isset( $post->ID ) ? $post->ID : 0;
	$permalink                 = get_the_permalink( $postid );
	$size                      = 'thumbnail';
	$querystring               = 'postid';
	$reactiemogelijkheid_titel = esc_html( _x( "Questions, ideas, suggestions?", 'reactieformulier', 'wp-rijkshuisstijl' ) );

	if ( is_tax( RHSWP_CT_DOSSIER ) ) {
		$postid      = get_queried_object()->term_id;
		$acfid       = RHSWP_CT_DOSSIER . '_' . get_queried_object()->term_id;
		$permalink   = get_term_link( $postid );
		$querystring = 'dossierid';
	} else {
		$acfid = $postid;
	}
	if ( is_search() ) {
		return;
	}
	if ( is_home() && 'page' == get_option( 'show_on_front' ) ) {
		// op de pagina met blogberichten tonen we NOOIT het contactformulier, blijkbaar
		return;
	}


	if ( function_exists( 'get_field' ) ) {
		$toon_reactieformulier             = get_field( 'toon_reactieformulier_post', $acfid );
		$documenttypes                     = get_field( 'contactformulier_documenttypes', 'option' );
		$reactiemogelijkheid_titel         = get_field( 'reactiemogelijkheid_titel', 'option' );
		$reactiemogelijkheid_vrije_tekst   = get_field( 'reactiemogelijkheid_vrije_tekst', 'option' );
		$option_contactformulier           = get_field( 'option_contactformulier', 'option' );
		$option_contactformulier_linktekst = get_field( 'option_contactformulier_linktekst', 'option' );
		$andere_diensten                   = get_field( 'reactiemogelijkheid_andere_overheidsdiensten', 'option' );

		if ( is_tax( RHSWP_CT_DOSSIER ) ) {
			$doctype_check = true;
		} else {
			$posttype = get_post_type();
			if ( $documenttypes && $posttype ) {
				// check of posttype klopt
				$doctype_check = in_array( $posttype, $documenttypes );
			}
		}

		if ( ! $toon_reactieformulier ) {
			// lege waarde, dus we zetten 'm terug naar default
			$toon_reactieformulier = 'default';
		}
	} else {
		return;
	}
	if ( 'default' === $toon_reactieformulier ) {
		// er is niet bewust een waarde ingevuld bij deze post, we maken er 'ja' van
		$toon_reactieformulier = RHSWP_YES;
	}


	if ( $option_contactformulier->ID && ( ( $post->ID === $option_contactformulier->ID ) || ( ( RHSWP_YES == $toon_reactieformulier || 'anders' == $toon_reactieformulier ) && $doctype_check ) ) ) {
		// als er een contactformulier is ingevoerd via de site-instellingen
		// en een van deze twee is waar:
		// - dit is die pagina met het contactformulier
		// - dit is van een documenttype waarop een reactieformulier getoond mag worden

		$link_contactformulier = get_permalink( $option_contactformulier->ID ) . '?' . $querystring . '=' . $postid;
		$complete_url          = wp_nonce_url( $link_contactformulier, $querystring . '_' . $postid, 'referrersource' );

		echo '<section class="suggestie" id="reactieformulier" aria-labelledby="ID_reactieformulier_title">';
		echo '<div class="wrap">';

		if ( ( RHSWP_YES == $toon_reactieformulier || 'anders' == $toon_reactieformulier ) && $doctype_check ) {

			echo '<h2 id="ID_reactieformulier_title">' . $reactiemogelijkheid_titel . '</h2>';
			echo '<div class="inleiding">';
			echo wpautop( $reactiemogelijkheid_vrije_tekst . ' <a href="' . $complete_url . '">' . $option_contactformulier_linktekst . '</a>' );
			echo '</div>';
		} else {
			echo '<h2 id="ID_reactieformulier_title">' . $reactiemogelijkheid_titel . '</h2>';
		}

		if ( $andere_diensten ) {

			echo '<div class="reactieformulier--services">';

			foreach ( $andere_diensten as $andere_dienst ) {
				$image = $andere_dienst['reactiemogelijkheid_andere_overheidsdienst_logo'];
				$titel = $andere_dienst['reactiemogelijkheid_andere_overheidsdienst_titel'];
				$url   = $andere_dienst['reactiemogelijkheid_andere_overheidsdienst_url'];

				if ( $image && filter_var( $url, FILTER_VALIDATE_URL ) ) {

					$thumb    = $image['sizes'][ $size ];
					$width    = $image['sizes'][ $size . '-width' ];
					$height   = $image['sizes'][ $size . '-height' ];
					$url_name = preg_replace( '|https://|i', '', $url );
					$url_name = preg_replace( '|http://|i', '', $url_name );
					$url_name = preg_replace( '|mailto:|i', '', $url_name );
					$url_name = preg_replace( '|www.|i', '', $url_name );
					$url_name = rtrim( $url_name, '/' );

					$maxwidth     = 80; // 80px maximaal breed
					$width_factor = ( $width / $maxwidth );

					$height = round( ( $height / $width_factor ), 0 );

					echo '<a href="' . $url . '" class="related-content__stroke">';
					echo '<img src="' . $thumb . '" alt="Bekijk de pagina ' . $titel . '" width="' . $maxwidth . '" height="' . $height . '" />';
					echo '<div class="">';
					echo '<h3>' . $titel . '</h3>';
					echo '<span>';
					echo $url_name;
					echo '</span>';
					echo '</div>';
					echo '</a>';
				}

			}
			echo '</ul>';
		}

		echo '</div>';
		echo '</section>';
	} else {
		// wu wei
	}

}

//========================================================================================================
add_action( 'admin_init', 'wpse_add_taxonomy_archive_options', 11 );
function wpse_add_taxonomy_archive_options() {
	foreach ( get_taxonomies( array( 'public' => true ) ) as $tax_name ) {
		remove_action( $tax_name . '_edit_form', 'genesis_taxonomy_archive_options', 10, 2 );
	}
}

//========================================================================================================
add_filter( 'body_class', 'rhswp_add_body_classses' );
/**
 * CSS class toevoegen aan pagina's en berichten die RHSWP_CT_DIGIBETER terms hebben
 * en ook aan alle denkbare soorten content die in het dossier zitten dat gemarkeerd is
 * als het archief-dossier ('site_archief_dossier')
 */
function rhswp_add_body_classses( $classes ) {
// dodebug_do( 'rhswp_add_body_classses' );
	global $post;
	if ( ! function_exists( 'get_field' ) ) {
		exit;
	}
	if ( get_field( 'site_archief_dossier', 'option' ) ) {
		// er is dus een dossier aangewezen als archiefdossier.
		$archiefdossierid = get_field( 'site_archief_dossier', 'option' );
		$extraclass       = ''; // later vullen we deze variabele; als het gevuld is voegen we dit toe als class aan de body-tag
		$terms            = '';
		if ( is_tax( RHSWP_CT_DOSSIER ) ) {
			// we zitten te kijken naar een dossier
			$currenttaxid = get_queried_object()->term_id;
// dodebug_do( 'rhswp_add_body_classses IS TAX: ' . $currenttaxid );
			if ( $archiefdossierid == $currenttaxid ) {
				// dit dossier IS het archiefdossier
				$extraclass = 'archiefmarkering';
			} elseif ( term_is_ancestor_of( $archiefdossierid, $currenttaxid, RHSWP_CT_DOSSIER ) ) {
				// dit dossier valt ONDER het archiefdossier
				$extraclass = 'archiefmarkering';
			}
		} elseif (
			( RHSWP_DOSSIERCONTEXTPOSTOVERVIEW == get_query_var( 'pagename' ) ) ||
			( RHSWP_DOSSIERCONTEXTCATEGORYPOSTOVERVIEW == get_query_var( 'pagename' ) ) ||
			( RHSWP_DOSSIERCONTEXTEVENTOVERVIEW == get_query_var( 'pagename' ) ) ||
			( RHSWP_DOSSIERCONTEXTDOCUMENTOVERVIEW == get_query_var( 'pagename' ) )
		) {
			// dit is zo'n nep-pagina die berichten / events / documenten bij een bepaald dossier toont
// dodebug_do( 'rhswp_add_body_classses NEPPAGINA');
			$terms = get_term_by( 'slug', get_query_var( RHSWP_CT_DOSSIER ), RHSWP_CT_DOSSIER );
		} else {
			// het is geen dossier en het is niet zo'n neppagina. Het is content en het kan misschien in een dossier zitten
			$terms = get_the_terms( get_the_ID(), RHSWP_CT_DOSSIER );
// dodebug_do( 'rhswp_add_body_classses GEEN TAX, GEEM NEPPAGINA');
			if ( has_term( $archiefdossierid, RHSWP_CT_DOSSIER ) ) {
				dodebug_do( 'is zo\'n archiefdinges' );
			}
		}
		if ( $terms && ! is_wp_error( $terms ) ) {
			// eerder hebben we succesvol bepaald dat de content in een dossier zit
			dodebug_do( 'dit dinges heeft iets uit ' . RHSWP_CT_DOSSIER );
			if ( is_object( $terms ) ) {
				if ( $archiefdossierid === $terms->term_id ) {
					$extraclass = 'archiefmarkering luimeme';
				} elseif ( term_is_ancestor_of( $archiefdossierid, $terms->term_id, RHSWP_CT_DOSSIER ) ) {
					$extraclass = 'archiefmarkering parent';
				}
			} else {
				if ( is_array( $terms ) ) {
					// deze post zit in meerdere dossiers
					foreach ( $terms as $term ) {
						if ( term_is_ancestor_of( $archiefdossierid, $term->term_id, RHSWP_CT_DOSSIER ) ) {
							$extraclass = 'archiefmarkering parent';
							break;
						}
					}
				} else {
					// geen array, geen object, weet ik veel
				}
			}
		}
		if ( $extraclass ) {
			if ( isset( $classes['class'] ) ) {
				$classes['class'] .= ' ' . $extraclass;
			} else {
				$classes['class'] = $extraclass;
			}
		}
	}
	if ( is_tax() ) {
		// it is a taxonomy and not a post or page
	} elseif ( 'post' == get_post_type() || 'page' == get_post_type() ) {
		// it's a post or page
		if ( has_term( '', RHSWP_CT_DIGIBETER ) ) {
			// if has any terms in RHSWP_CT_DIGIBETER
			if ( isset( $classes['class'] ) ) {
				$classes['class'] .= ' digibeter';
			} else {
				$classes['class'] = 'digibeter';
			}
		}
		$postid         = get_the_id();
		$digibeterterms = wp_get_post_terms( $postid, RHSWP_CT_DIGIBETER );
		if ( $digibeterterms && ! is_wp_error( $digibeterterms ) ) {
			foreach ( $digibeterterms as $digibeterterm ) {
				$term_id          = ' ' . $digibeterterm->term_id;
				$acfid            = RHSWP_CT_DIGIBETER . '_' . $term_id;
				$digibeterclass   = get_field( 'digibeter_term_achtergrondkleur', $acfid );
				$classes['class'] .= ' ' . $digibeterclass;
			}
		}
	}

	return $classes;
}

//========================================================================================================
add_action( 'admin_footer', 'rhswp_add_streamer_funcs', 11 );
/**
 * Append the call to action content content button to the admin pages
 */
function rhswp_add_streamer_funcs() {
	global $pagenow;
	global $post;
	if ( ! is_admin() ) {
		return '';
	}
	if ( ! isset( $post->ID ) ) {
		return '';
	}
	wp_enqueue_style( RHSWP_ADMIN_STREAMER_CSS, RHSWP_THEMEFOLDER . '/css/admin-popup-css.css', false, CHILD_THEME_VERSION );
	do_action( RHSWP_ADMIN_STREAMER_CSS );
	$my_saved_attachment_post_id = $post->ID;
	// Only run in post/page creation and edit screens
	if ( in_array( $pagenow, array( 'post.php', 'page.php', 'post-new.php', 'post-edit.php' ) ) ) {
		?>
		<script type="text/javascript">
			jQuery(document).ready(function () {
				// Select files
				var file_frame;
				var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
				var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this
				// Restore the main ID when the add media button is pressed
				jQuery('a.add_media').on('click', function () {
					wp.media.model.settings.post.id = wp_media_post_id;
				});
				jQuery('#select_image_button').on('click', function (event) {
					event.preventDefault();
					// If the media frame already exists, reopen it.
					if (file_frame) {
						// Set the post ID to what we want
						file_frame.uploader.uploader.param('post_id', set_to_post_id);
						// Open frame
						file_frame.open();
						return;
					} else {
						// Set the wp.media post id so the uploader grabs the ID we want when initialised
						wp.media.model.settings.post.id = set_to_post_id;
					}
					// Create the media frame.
					file_frame = wp.media.frames.file_frame = wp.media({
						title: '<?php echo _x( 'Selecteer of upload een PDF', 'CTA knop', "insp-tranlate" ) ?>',
						button: {
							text: '<?php echo _x( 'Link naar dit bestand', 'CTA knop', "insp-tranlate" ) ?>',
						},
						multiple: false	// Set to true to allow multiple files to be selected
					});
					// When an image is selected, run a callback.
					file_frame.on('select', function () {
						// We set multiple to false so only get one image from the uploader
						attachment = file_frame.state().get('selection').first().toJSON();
						// Do something with attachment.id and/or attachment.url here
						var theurl = attachment['sizes']['article-visual']['url'];
						jQuery('#rhswp_quote_image').val(theurl);
						// Restore the main post ID
						wp.media.model.settings.post.id = wp_media_post_id;
					});
					// Finally, open the modal
					file_frame.open();
				});
				jQuery('#insert_rhswp_streamer_with_image_confirm').on('click', function () {
					var rhswp_quote_author = jQuery('#rhswp_quote_author').val();
					var rhswp_quote_text = jQuery('#rhswp_quote_text').val();
					var rhswp_quote_url = jQuery('#rhswp_quote_url').val();
					var rhswp_quote_alignment = jQuery('input[name=rhswp_quote_alignment]:checked').val();
					var rhswp_quote_image = jQuery('#rhswp_quote_image').val();
					var rhswp_quote_linktext = '';
					var theReturn = true;
					jQuery('#rhswp_insert_aside_errormessages').text('');
					jQuery('#rhswp_insert_aside_errormessages').removeClass('error');
					jQuery('#rhswp_quote_author').removeClass('error');
					jQuery('#rhswp_quote_text').removeClass('error');
					jQuery('#rhswp_quote_url').removeClass('error');
					jQuery('#rhswp_quote_author').removeClass('error');
					jQuery('#rhswp_quote_author').removeClass('error');
					if ((rhswp_quote_text === '') || (rhswp_quote_text == null)) {
						jQuery('#rhswp_insert_aside_errormessages').append('<?php echo _x( 'Voer een tekst in', 'Streamer errors', 'wp-rijkshuisstijl' ) ?>' + "<br>");
						jQuery('#rhswp_insert_aside_errormessages').addClass('error');
						jQuery('#rhswp_quote_text').addClass('error');
						theReturn = false;
					}
					if (rhswp_quote_image === '') {
						jQuery('#rhswp_insert_aside_errormessages').append('<?php echo _x( 'Selecteer een foto', 'Streamer errors', 'wp-rijkshuisstijl' ) ?>' + "<br>");
						jQuery('#rhswp_insert_aside_errormessages').addClass('error');
						jQuery('#rhswp_quote_image').addClass('error');
						theReturn = false;
					} else {
						rhswp_quote_image = '<div class="pullquote-img" style=\"background-image: url(\'' + rhswp_quote_image + '\');\">&nbsp;</div>';
					}
					if ((rhswp_quote_url === '') || (rhswp_quote_url == null)) {
						if ((rhswp_quote_author === '') || (rhswp_quote_author == null)) {
						} else {
							rhswp_quote_linktext = '<cite>' + rhswp_quote_author + '</cite>';
						}
					} else {
						// url is niet leeg
						if ((rhswp_quote_author === '') || (rhswp_quote_author == null)) {
							// quote-auteur is wel leeg, maar er is een URL
							rhswp_quote_linktext = '<cite><a href="' + rhswp_quote_url + '">(bron)</a></cite>';
							jQuery('#rhswp_insert_aside_errormessages').append('<?php echo _x( 'Voer in wie dit zei', 'Streamer errors', 'wp-rijkshuisstijl' ) ?>' + "<br>");
							jQuery('#rhswp_insert_aside_errormessages').addClass('error');
							jQuery('#rhswp_quote_author').addClass('error');
							theReturn = false;
						} else {
							// quote-auteur is niet leeg en er is een URL
							rhswp_quote_linktext = '<cite><a href="' + rhswp_quote_url + '">' + rhswp_quote_author + '</a></cite>';
						}
					}
					if (theReturn) {
					} else {
						return false;
					}
					window.send_to_editor('<aside class="<?php echo RHSWP_PULLQUOTE_WITH_IMAGE ?> ' + rhswp_quote_alignment + '"><blockquote>' + rhswp_quote_image + '<div class="quote">' + rhswp_quote_text + rhswp_quote_linktext + '</div></blockquote></aside>');
					tb_remove();
				})
			});
		</script>
		<div id="insert_rhswp_streamer_with_image_form" style="display: none;">
			<div class="wrap">
				<?php
				echo "<h3>" . _x( "Gegevens voor streamer", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</h3>";
				echo '<div class="divider" id="rhswp_insert_aside_errormessages" role="alert">';
				echo "</div>";
				echo "<div class='divider'>";
				echo "<label for='rhswp_quote_text'>" . _x( "Citaat", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</label>";
				echo "<textarea id='rhswp_quote_text' name='rhswp_quote_text' rows='8'></textarea>";
				echo "</div>";
				echo "<div class='divider'>";
				echo "<label for='rhswp_quote_author'>" . _x( "Citaatauteur", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</label>";
				echo "<input type='text' id='rhswp_quote_author' name='rhswp_quote_author' value=''>";
				echo "</div>";
				echo "<div class='divider'>";
				echo "<label for='rhswp_quote_image'>" . _x( "Foto van citaatauteur", 'CTA knop', "insp-tranlate" ) . "</label>";
				echo '<input type="text" name="rhswp_quote_image" id="rhswp_quote_image" value="">';
				echo '<input id="select_image_button" type="button" class="button" value="' . _x( "Selecteer foto", 'CTA knop', "insp-tranlate" ) . '" />';
				echo "<small>" . _x( "Je kunt een link invoegen of met de knop een foto uit de mediabibliotheek selecteren.", 'CTA knop', "insp-tranlate" ) . "</small>";
				echo "</div>";
				echo "<div class='divider'>";
				echo "<label for='rhswp_quote_url'>" . _x( "Link naar post / pagina", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</label>";
				echo '<input type="url" name="rhswp_quote_url" id="rhswp_quote_url" value="">';
				echo "</div>";
				echo "<div class='divider'>";
				echo "<label for='rhswp_quote_alignment'>" . _x( "Uitlijnen", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</label>";
				echo "<label for='rhswp_quote_alignment_left'><input type='radio' id='rhswp_quote_alignment_left' name='rhswp_quote_alignment' value='align-left'>" . _x( "Links", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</label>";
				echo "<label for='rhswp_quote_alignment_none'><input type='radio' id='rhswp_quote_alignment_none' name='rhswp_quote_alignment' checked='checked' value='align-none'>" . _x( "Geen uitlijning", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</label>";
				echo "<label for='rhswp_quote_alignment_right'><input type='radio' id='rhswp_quote_alignment_right' name='rhswp_quote_alignment' value='align-right'>" . _x( "Rechts", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</label>";
				echo "</div>";
				echo "<button class='button primary' id='insert_rhswp_streamer_with_image_confirm'>" . _x( "Voeg citaat in", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</button>";
				?>
			</div>
		</div>
		<?php
	}
}

//========================================================================================================
add_action( 'admin_footer', 'rhswp_add_simple_streamer_funcs', 12 );
/**
 * Append the call to action content content button to the admin pages
 */
function rhswp_add_simple_streamer_funcs() {
	global $pagenow;
	global $post;
	if ( ! is_admin() ) {
		return '';
	}
	if ( ! isset( $post->ID ) ) {
		return '';
	}
	$my_saved_attachment_post_id = $post->ID;
	// Only run in post/page creation and edit screens
	if ( in_array( $pagenow, array( 'post.php', 'page.php', 'post-new.php', 'post-edit.php' ) ) ) {
		?>
		<script type="text/javascript">
			jQuery(document).ready(function () {
				// Select files
				var file_frame;
				var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this
				jQuery('#insert_rhswp_simple_streamer_confirm').on('click', function () {
					var rhswp_simple_quote_text = jQuery('#rhswp_simple_quote_text').val();
					var rhswp_simple_quote_alignment = jQuery('input[name=rhswp_simple_quote_alignment]:checked').val();
					jQuery('#rhswp_insert_simple_quote_errormessages').text('');
					jQuery('#rhswp_insert_simple_quote_errormessages').removeClass('error');
					jQuery('#rhswp_simple_quote_text').removeClass('error');
					if ((rhswp_simple_quote_text === '') || (rhswp_simple_quote_text == null)) {
						jQuery('#rhswp_insert_simple_quote_errormessages').append('<?php echo _x( 'Voer een tekst in', 'Streamer errors', 'wp-rijkshuisstijl' ) ?>');
						jQuery('#rhswp_insert_simple_quote_errormessages').addClass('error');
						jQuery('#rhswp_simple_quote_text').addClass('error');
						return false;
					}
					if ((rhswp_simple_quote_text === '') || (rhswp_simple_quote_text == null)) {
						jQuery('#rhswp_insert_simple_quote_errormessages').append('<?php echo _x( 'Voer een tekst in', 'Streamer errors', 'wp-rijkshuisstijl' ) ?>');
						jQuery('#rhswp_insert_simple_quote_errormessages').addClass('error');
						jQuery('#rhswp_simple_quote_text').addClass('error');
						return false;
					}
					if ((rhswp_simple_quote_text === '') || (rhswp_simple_quote_text == null)) {
					} else {
						rhswp_simple_quote_alignment = ' ' + rhswp_simple_quote_alignment;
					}
					window.send_to_editor('<aside class="<?php echo RHSWP_SIMPLE_PULLQUOTE ?>' + rhswp_simple_quote_alignment + '"><blockquote>' + rhswp_simple_quote_text + '</blockquote></aside>');
					tb_remove();
				})
			});
		</script>
		<div id="insert_rhswp_simple_treamer_form" style="display: none;">
			<div class="wrap">
				<?php
				echo "<h3>" . _x( "Gewone streamer", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</h3>";
				echo '<div class="divider" id="rhswp_insert_simple_quote_errormessages" role="alert">';
				echo "</div>";
				echo "<div class='divider'>";
				echo "<label for='rhswp_simple_quote_text'>" . _x( "Citaat", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</label>";
				echo "<textarea id='rhswp_simple_quote_text' name='rhswp_simple_quote_text' rows='8'></textarea>";
				echo "</div>";
				echo "<div class='divider'>";
				echo "<label for='rhswp_simple_quote_alignment'>" . _x( "Uitlijnen", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</label>";
				echo "<label for='rhswp_simple_quote_alignment_none'><input type='radio' id='rhswp_simple_quote_alignment_none' name='rhswp_simple_quote_alignment' checked='checked' value='align-none'>" . _x( "Geen uitlijning", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</label>";
				echo "<label for='rhswp_simple_quote_alignment_left'><input type='radio' id='rhswp_simple_quote_alignment_left' name='rhswp_simple_quote_alignment' value='align-left'>" . _x( "Links", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</label>";
				//    echo "<label for='rhswp_simple_quote_alignment_right'><input type='radio' id='rhswp_simple_quote_alignment_right' name='rhswp_simple_quote_alignment' value='align-right'>". _x( "Links", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</label>";
				echo "</div>";
				echo "<button class='button primary' id='insert_rhswp_simple_streamer_confirm'>" . _x( "Voeg streamer toe", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</button>";
				?>
			</div>
		</div>
		<?php
	}
}

//========================================================================================================
//add_filter( 'media_buttons_context', 'rhswp_admin_insert_streamer_button' );
add_action( 'media_buttons', 'rhswp_admin_insert_streamer_button' );

/**
 * Append the 'Add streamer' button to selected admin pages
 */
function rhswp_admin_insert_streamer_button() {

	global $pagenow;
	$posttype = 'post';
	if ( isset( $_GET['post'] ) ) {
		$posttype = get_post_type( $_GET['post'] );
	}
	if ( isset( $_GET['post_type'] ) ) {
		$posttype = $_GET['post_type'];
	}
	$available_post_types = get_post_types();
	$allowed_post_types   = array();
	foreach ( $available_post_types as $available_post_type ) {
		array_push( $allowed_post_types, $available_post_type );
	}

	$context = '';

	if ( ( in_array( $pagenow, array(
			'post.php',
			'page.php',
			'post-new.php',
			'post-edit.php'
		) ) ) && ( in_array( $posttype, $allowed_post_types ) ) ) {
		// streamer met foto
		$context .= '<a href="#TB_inline?&inlineId=insert_rhswp_streamer_with_image_form" id="insert_rhswp_streamer_with_image_button" class="thickbox button" title="' .
					_x( "Gegevens voor je streamer", 'Insert streamer', 'wp-rijkshuisstijl' ) .
					'">' . _x( "Streamer met foto", 'Insert streamer', 'wp-rijkshuisstijl' ) . '</a>';
		// streamer zonder foto
		$context .= '<a href="#TB_inline?&inlineId=insert_rhswp_simple_treamer_form" id="insert_rhswp_simple_treamer_button" class="thickbox button" title="' .
					_x( "Gegevens voor je streamer", 'Insert streamer', 'wp-rijkshuisstijl' ) .
					'">' . _x( "Gewone streamer", 'Insert streamer', 'wp-rijkshuisstijl' ) . '</a>';
		// Details + summary tag
		$context .= '<a href="#TB_inline?&inlineId=insert_rhswp_detailssummary_form" id="insert_rhswp_detailssummary_button" class="thickbox button" title="' .
					_x( "Voeg inklapblok toe", 'Insert streamer', 'wp-rijkshuisstijl' ) .
					'">' . _x( "Voeg uitklapblok toe", 'Insert details summary', 'wp-rijkshuisstijl' ) . '</a>';
		// Kaders met randjes
		$context .= '<a href="#TB_inline?&inlineId=insert_rhswp_add_framebox_form" id="insert_rhswp_detailssummary_button" class="thickbox button" title="' .
					_x( "Voeg kader toe", 'Insert streamer', 'wp-rijkshuisstijl' ) .
					'">' . _x( "Voeg kader toe", 'kader', 'wp-rijkshuisstijl' ) . '</a>';
	}

	echo $context;
}

//========================================================================================================
// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function ( $data, $file, $filename, $mimes ) {
	global $wp_version;
	if ( $wp_version !== '4.7.1' ) {
		return $data;
	}
	$filetype = wp_check_filetype( $filename, $mimes );

	return [
		'ext'             => $filetype['ext'],
		'type'            => $filetype['type'],
		'proper_filename' => $data['proper_filename']
	];
}, 10, 4 );
//========================================================================================================
function rhswp_svg_add_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}

add_filter( 'upload_mimes', 'rhswp_svg_add_mime_types' );
//========================================================================================================
function rhswp_svg_css_display() {
	echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}

add_action( 'admin_head', 'rhswp_svg_css_display' );
//========================================================================================================
add_action( 'admin_footer', 'rhswp_add_detailssummary_funcs', 13 );
/**
 * Append the call to action content content button to the admin pages
 */
function rhswp_add_detailssummary_funcs() {
	global $pagenow;
	global $post;
	if ( ! is_admin() ) {
		return '';
	}
	if ( ! isset( $post->ID ) ) {
		return '';
	}
	$my_saved_attachment_post_id = $post->ID;
	// Only run in post/page creation and edit screens
	if ( in_array( $pagenow, array( 'post.php', 'page.php', 'post-new.php', 'post-edit.php' ) ) ) {
		?>
		<script type="text/javascript">
			jQuery(document).ready(function () {
				// Select files
				var file_frame;
				var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this
				jQuery('#insert_rhswp_detailssummary_confirm').on('click', function () {
					var rhswp_detailssummary_text = jQuery('#rhswp_detailssummary_text').val();
					var rhswp_detailssummary_title = jQuery('#rhswp_detailssummary_title').val();
					var rhswp_detailssummary_headerlevel = jQuery('#rhswp_detailssummary_headerlevel').val();
					var theReturn = true;
					jQuery('#rhswp_detailssummary_errors').text('');
					jQuery('#rhswp_detailssummary_errors').removeClass('error');
					jQuery('#rhswp_detailssummary_text').removeClass('error');
					jQuery('#rhswp_detailssummary_title').removeClass('error');
					if ((rhswp_detailssummary_title === '') || (rhswp_detailssummary_title == null)) {
						jQuery('#rhswp_detailssummary_errors').append('<?php echo _x( 'Voer een titel in<br>', 'Streamer errors', 'wp-rijkshuisstijl' ) ?>');
						jQuery('#rhswp_detailssummary_errors').addClass('error');
						jQuery('#rhswp_detailssummary_title').addClass('error');
						theReturn = false;
					}
					if ((rhswp_detailssummary_text === '') || (rhswp_detailssummary_text == null)) {
						jQuery('#rhswp_detailssummary_errors').append('<?php echo _x( 'Voer een tekst in<br>', 'Streamer errors', 'wp-rijkshuisstijl' ) ?>');
						jQuery('#rhswp_detailssummary_errors').addClass('error');
						jQuery('#rhswp_detailssummary_text').addClass('error');
						theReturn = false;
					} else {
						rhswp_detailssummary_text = rhswp_detailssummary_text.replace(/(?:\r\n|\r|\n)/g, '<br>');
					}
					if ((rhswp_detailssummary_headerlevel === '') || (rhswp_detailssummary_headerlevel == null)) {
						jQuery('#rhswp_detailssummary_errors').append('<?php echo _x( 'Kies een header-niveau<br>', 'Streamer errors', 'wp-rijkshuisstijl' ) ?>');
						jQuery('#rhswp_detailssummary_errors').addClass('error');
						jQuery('#rhswp_detailssummary_headerlevel').addClass('error');
						theReturn = false;
					}
					if (theReturn) {
					} else {
						return false;
					}
					window.send_to_editor('[detailssummary summary="' + rhswp_detailssummary_title + '" headerlevel="' + rhswp_detailssummary_headerlevel + '"]<p>' + rhswp_detailssummary_text + '</p>[/detailssummary]');
					tb_remove();
				})
			});
		</script>
		<div id="insert_rhswp_detailssummary_form" style="display: none;">
			<div class="wrap">
				<?php
				echo "<h3>" . _x( "Voeg een details / summary blok in. Dit blok toont of verbergt teksten.", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</h3>";
				echo '<div class="divider" id="rhswp_detailssummary_errors" role="alert">';
				echo "</div>";
				echo "<div class='divider'>";
				echo "<label for='rhswp_detailssummary_title'>" . _x( "Titel", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</label>";
				echo "<input type='text' id='rhswp_detailssummary_title' name='rhswp_detailssummary_title' value=''>";
				echo "</div>";
				echo "<div class='divider'>";
				echo "<label for='rhswp_detailssummary_headerlevel'>" . _x( "Header-niveau", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</label>";
				echo "<select id='rhswp_detailssummary_headerlevel' name='rhswp_detailssummary_headerlevel'>";
				echo '<option value="h2">' . _x( "H2 (niveau 2)", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</option>";
				echo '<option value="h3">' . _x( "H3 (niveau 3)", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</option>";
				echo '<option value="h4">' . _x( "H4 (niveau 4)", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</option>";
				echo '<option value="h5">' . _x( "H5 (niveau 5)", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</option>";
				echo '<option value="h6">' . _x( "H6 (niveau 6)", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</option>";
				echo "</select>";
				echo "</div>";
				echo "<div class='divider'>";
				echo "<label for='rhswp_detailssummary_text'>" . _x( "Inhoud van inklapblok", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</label>";
				echo "<textarea id='rhswp_detailssummary_text' name='rhswp_detailssummary_text' rows='8'></textarea>";
				echo "</div>";
				echo "<button class='button primary' id='insert_rhswp_detailssummary_confirm'>" . _x( "Voeg uitklapblok toe", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</button>";
				?>
			</div>
		</div>
		<?php
	}
}

//========================================================================================================
/*
 * Deze shortcde zorgt voor een uitklapblok via <details>
 */
function rhswp_html_for_shortcode_details_summary( $atts, $content = null ) {
	global $post;
	$a = shortcode_atts( array(
		'headerlevel' => '',
		'summary'     => '',
	), $atts );
	if ( ! isset( $a['headerlevel'] ) ) {
		$a['headerlevel'] = 'h2';
	}
	if ( ! isset( $a['summary'] ) ) {
		$a['summary'] = 'Meer details';
	}
	// voorkomen dat $content start met een </p>
	// @since 2.12.20
	if ( substr( $content, 0, 4 ) === "</p>" ) {
		$content = substr( $content, 4, strlen( $content ) );
	}
	// voorkomen dat $content eindigt met een <p>
	// @since 2.12.20
	if ( substr( $content, ( strlen( $content ) - 3 ), strlen( $content ) ) === "<p>" ) {
		$content = substr( $content, 0, strlen( $content ) - 3 );
	}

	return '<details><summary><' . $a['headerlevel'] . '>' . $a['summary'] . '</' . $a['headerlevel'] . '></summary>' . $content . '</details>';
}

add_shortcode( 'detailssummary', 'rhswp_html_for_shortcode_details_summary' );
//========================================================================================================
function rhswp_filter_the_content_cleanup( $content ) {
	if ( is_singular() && is_main_query() ) {
		// wat lege tags weghalen
		$content = preg_replace( '|<aside></aside>|i', '', $content );
		$content = preg_replace( '|<hr class="detailssummary" />|i', '', $content );
		$content = preg_replace( '|<hr class="detailssummary">|i', '', $content );
		$content = preg_replace( '|details open=""|i', 'details', $content );
		$content = preg_replace( '|details open|i', 'details', $content );
	}

	return $content;
}

add_filter( 'the_content', 'rhswp_filter_the_content_cleanup' );
//========================================================================================================
add_action( 'admin_footer', 'rhswp_add_add_framebox_funcs', 14 );
/**
 * Append the call to action content content button to the admin pages
 */
function rhswp_add_add_framebox_funcs() {
	global $pagenow;
	global $post;
	if ( ! is_admin() ) {
		return '';
	}
	if ( ! isset( $post->ID ) ) {
		return '';
	}
	$my_saved_attachment_post_id = $post->ID;
	// Only run in post/page creation and edit screens
	if ( in_array( $pagenow, array( 'post.php', 'page.php', 'post-new.php', 'post-edit.php' ) ) ) {
		?>
		<script type="text/javascript">
			jQuery(document).ready(function () {
				// Select files
				var file_frame;
				var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this
				jQuery('#insert_rhswp_add_framebox_confirm').on('click', function () {
					var rhswp_add_framebox_text = jQuery('#rhswp_add_framebox_text').val();
					var rhswp_add_framebox_title = jQuery('#rhswp_add_framebox_title').val();
					var rhswp_add_framebox_headerlevel = jQuery('#rhswp_add_framebox_headerlevel').val();
					var rhswp_add_framebox_style = jQuery('input[name=rhswp_add_framebox_style]:checked').val();
					var theReturn = true;
					var theTag = 'div'; // standard = '<div>'
					jQuery('#rhswp_add_framebox_errors').text('');
					jQuery('#rhswp_add_framebox_errors').removeClass('error');
					jQuery('#rhswp_add_framebox_text').removeClass('error');
					jQuery('#rhswp_add_framebox_title').removeClass('error');
					if ((rhswp_add_framebox_style === '') || (rhswp_add_framebox_style == null)) {
					} else {
						rhswp_add_framebox_style = ' ' + rhswp_add_framebox_style;
						if (rhswp_add_framebox_style == 'asidegrey') {
							theTag = 'aside';
						}
					}
					if ((rhswp_add_framebox_title === '') || (rhswp_add_framebox_title == null)) {
						// titel is niet verplicht
					} else {
						// maar als je 'm gevuld heb moet er ook een header-niveau gekozen zijn
						if ((rhswp_add_framebox_headerlevel === '') || (rhswp_add_framebox_headerlevel == null)) {
							jQuery('#rhswp_add_framebox_errors').append('<?php echo _x( 'Kies een header-niveau<br>', 'Streamer errors', 'wp-rijkshuisstijl' ) ?>');
							jQuery('#rhswp_add_framebox_errors').addClass('error');
							jQuery('#rhswp_add_framebox_headerlevel').addClass('error');
							theReturn = false;
						} else {
							rhswp_add_framebox_title = '<' + rhswp_add_framebox_headerlevel + ' class="blocktitle">' + rhswp_add_framebox_title + '</' + rhswp_add_framebox_headerlevel + '>';
						}
					}
					if ((rhswp_add_framebox_text === '') || (rhswp_add_framebox_text == null)) {
						jQuery('#rhswp_add_framebox_errors').append('<?php echo _x( 'Voer een tekst in<br>', 'Streamer errors', 'wp-rijkshuisstijl' ) ?>');
						jQuery('#rhswp_add_framebox_errors').addClass('error');
						jQuery('#rhswp_add_framebox_text').addClass('error');
						theReturn = false;
					} else {
						rhswp_add_framebox_text = rhswp_add_framebox_text.replace(/(?:\r\n|\r|\n)/g, '<br>');
					}
//
					if (theReturn) {
					} else {
						return false;
					}
					window.send_to_editor('<div class="borderframe' + rhswp_add_framebox_style + '">' + rhswp_add_framebox_title + '<div class="the-content">' + rhswp_add_framebox_text + '</div></div>');
					tb_remove();
				})
			});
		</script>
		<div id="insert_rhswp_add_framebox_form" style="display: none;">
			<div class="wrap">
				<?php
				echo "<h3>" . _x( "Voeg een kader toe.", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</h3>";
				echo '<div class="divider" id="rhswp_add_framebox_errors" role="alert">';
				echo "</div>";
				echo "<div class='divider'>";
				echo "<label for='rhswp_add_framebox_style'>" . _x( "Randkleur", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</label>";
				echo '<ul style="overflow: hidden;">';
				echo "<li><label style=\"width: auto; clear: both;\" for='rhswp_add_framebox_style_green'><input type='radio' id='rhswp_add_framebox_style_green' name='rhswp_add_framebox_style' checked='checked' value=\"green\">Groen</label></li>";
				echo "<li><label style=\"width: auto; clear: both;\" for='rhswp_add_framebox_style_gray'><input type='radio' id='rhswp_add_framebox_style_gray' name='rhswp_add_framebox_style' value=\"gray\">Grijs</label></li>";
				echo "<li><label style=\"width: auto; clear: both;\" for='rhswp_add_framebox_style_dataagendablue'><input type='radio' id='rhswp_add_framebox_style_dataagendablue' name='rhswp_add_framebox_style' value=\"dataagendablue\">Data-agenda-blauw</label></li>";
				echo "<li><label style=\"width: auto; clear: both;\" for='rhswp_add_framebox_style_dataagendaorange'><input type='radio' id='rhswp_add_framebox_style_dataagendaorange' name='rhswp_add_framebox_style' value=\"dataagendaorange\">Data-agenda-oranje</label></li>";
				echo "<li><label style=\"width: auto; clear: both;\" for='rhswp_add_framebox_style_blue'><input type='radio' id='rhswp_add_framebox_style_blue' name='rhswp_add_framebox_style' value=\"blue\">Blauw</label></li>";
				echo "<li><label style=\"width: auto; clear: both;\" for='rhswp_add_framebox_style_toolboxframe'><input type='radio' id='rhswp_add_framebox_style_toolboxframe' name='rhswp_add_framebox_style' value=\"toolboxframe\">Toolbox-kader</label></li>";
				echo "<li><label style=\"width: auto; clear: both;\" for='rhswp_add_framebox_style_asidegrey'><input type='radio' id='rhswp_add_framebox_style_asidegrey' name='rhswp_add_framebox_style' value=\"asidegrey\">Smal blokje links</label></li>";
				echo '</ul>';
				echo "</div>";
				echo "<div class='divider'>";
				echo "<label for='rhswp_add_framebox_title'>" . _x( "Titel", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</label>";
				echo "<input type='text' id='rhswp_add_framebox_title' name='rhswp_add_framebox_title' value=''>";
				echo "</div>";
				echo "<div class='divider'>";
				echo "<label for='rhswp_add_framebox_headerlevel'>" . _x( "Header-niveau", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</label>";
				echo "<select id='rhswp_add_framebox_headerlevel' name='rhswp_add_framebox_headerlevel'>";
				echo '<option value="h2">' . _x( "H2 (niveau 2)", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</option>";
				echo '<option value="h3">' . _x( "H3 (niveau 3)", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</option>";
				echo '<option value="h4">' . _x( "H4 (niveau 4)", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</option>";
				echo '<option value="h5">' . _x( "H5 (niveau 5)", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</option>";
				echo '<option value="h6">' . _x( "H6 (niveau 6)", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</option>";
				echo "</select>";
				echo "</div>";
				echo "<div class='divider'>";
				echo "<label for='rhswp_add_framebox_text'>" . _x( "Inhoud van blok", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</label>";
				echo "<textarea id='rhswp_add_framebox_text' name='rhswp_add_framebox_text' rows='8'></textarea>";
				echo "</div>";
				echo "<button class='button primary' id='insert_rhswp_add_framebox_confirm'>" . _x( "Voeg uitklapblok toe", 'Insert streamer', 'wp-rijkshuisstijl' ) . "</button>";
				?>
			</div>
		</div>
		<?php
	}
}

//========================================================================================================
function override_mce_options( $initArray ) {
	$opts                                 = '*[*]';
	$initArray['valid_elements']          = $opts;
	$initArray['extended_valid_elements'] = $opts;

	return $initArray;
}

//add_filter('tiny_mce_before_init', 'override_mce_options');
//========================================================================================================
function rhswp_footer_payoff() {
	$site_title       = get_bloginfo( 'title' );
	$site_description = get_bloginfo( 'description' );
	$strprefix        = '';
	$strsuffix        = '';
	if ( function_exists( 'get_field' ) ) {
		if ( get_field( 'footer_about_us', 'option' ) ) {
			$footer_about_us = get_field( 'footer_about_us', 'option' );
			if ( $footer_about_us->ID ) {
				$strprefix = '<a href="' . get_permalink( $footer_about_us->ID ) . '">';
				$strsuffix = '</a>';
			}
		}
	}
	if ( $site_title ) {
		$site_title = wp_strip_all_tags( $site_title ) . '<br>';
	}
	$site_description = wp_strip_all_tags( $site_description );

	$needle           = '&lt;strong&gt;';
	$replacer         = '';
	$site_description = str_replace( $needle, $replacer, $site_description );
	$needle           = '&lt;/strong&gt;';
	$replacer         = '';
	$site_description = str_replace( $needle, $replacer, $site_description );

	$needle           = 'werken aan digitalisering';
	$replacer         = 'werken aan<br>digitalisering';
	$site_description = str_replace( $needle, $replacer, $site_description );

	$start_title_span    = '<strong id="payoff_title">';
	$end_title_span      = '</strong>';
	$start_subtitle_span = '<span id="payoff_subtitle">';
	$end_subtitle_span   = '</span>';
	echo '<div id="payoff"> ' . $strprefix . $start_title_span . $site_title . $end_title_span . $start_subtitle_span . $site_description . $end_subtitle_span . $strsuffix . '</div>';
}


//========================================================================================================
// activate the page filters
//add_action( 'template_redirect', 'rhswp_use_page_template' );
add_action( 'pre_get_posts', 'rhswp_use_page_template' );
//========================================================================================================
function get_template_hoofdpagina_kalender( $thecontent = '' ) {
	return $thecontent . '<p>joehoe, get_template_hoofdpagina_kalender</p>';
}

//========================================================================================================
/**
 * Exclude Category from Blog
 *
 * @param object $query data
 *
 * @link http://www.billerickson.net/customize-the-wordpress-query/
 * @author Bill Erickson
 */
function rhswp_use_page_template( $query ) {
	global $wp_the_query;
	if ( $query->is_main_query() && ! $query->is_feed() && ! is_admin() && taxonomy_exists( RHSWP_CT_DOSSIER ) ) {
		if (
			( RHSWP_DOSSIERCONTEXTPOSTOVERVIEW == get_query_var( 'pagename' ) ) ||
			( RHSWP_DOSSIERCONTEXTEVENTOVERVIEW == get_query_var( 'pagename' ) ) ||
			( RHSWP_DOSSIERCONTEXTDOCUMENTOVERVIEW == get_query_var( 'pagename' ) )
		) {
			// get posts for this dossier: tax_query
			$artax_query = array(
				array(
					'taxonomy' => RHSWP_CT_DOSSIER,
					'field'    => 'slug',
					'terms'    => get_query_var( 'dossiers' ),
				),
			);
			add_filter( 'genesis_post_title_text', 'rhswp_custom_page_title_for_overviewpage', 15 );  // filter normal <h1> title
			add_filter( 'pre_get_document_title', 'rhswp_custom_page_title_for_overviewpage', 20 );  // Yoast hooks on #15

			if ( RHSWP_DOSSIERCONTEXTPOSTOVERVIEW == get_query_var( 'pagename' ) ) {
				// posts
				add_action( 'genesis_entry_content', 'rhswp_get_page_dossiersingleactueel', 15 );

			} elseif ( RHSWP_DOSSIERCONTEXTEVENTOVERVIEW == get_query_var( 'pagename' ) ) {
				// events
				add_action( 'genesis_entry_content', 'rhswp_get_events_for_dossier', 15 );

			} elseif ( RHSWP_DOSSIERCONTEXTDOCUMENTOVERVIEW == get_query_var( 'pagename' ) ) {
				// documents
				add_action( 'genesis_entry_content', 'rhswp_get_documents_for_dossier', 15 );

			} else {
				// filter the main template page
				add_filter( 'the_content', 'get_template_hoofdpagina_kalender' );

			}
		}
	}

	return $query;
}

//========================================================================================================
function rhswp_get_page_dossiersingleactueel() {
	dodebug_do( 'rhswp_get_page_dossiersingleactueel' );
	global $post;
	global $wp_query;
	if ( taxonomy_exists( RHSWP_CT_DOSSIER ) ) {
		$terms           = get_the_terms( $post->ID, RHSWP_CT_DOSSIER );
		$currentpageid   = $post->ID;
		$currentpageslug = $post->post_name;
		$currentpage     = get_permalink();
		$currentsite     = get_site_url();
		$paged           = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$dossierfilter   = '';
		$categoryfilter  = '';
		if ( function_exists( 'get_field' ) ) {
			$filter  = get_field( 'wil_je_filteren_op_categorie_op_deze_pagina', $post->ID );
			$filters = get_field( 'kies_de_categorie_waarop_je_wilt_filteren', $post->ID );
		}
		// check if the category is passed on via the query string
		if ( get_query_var( RHSWP_CT_DOSSIER ) ) {
			// posts must be filtered by category as well
			$dossierfilter = get_query_var( RHSWP_CT_DOSSIER );
			if ( get_query_var( 'category_slug' ) ) {
				$categoryfilter = get_query_var( 'category_slug' );
				$category_slug  = get_query_var( 'category_slug' );
				$categoryinfo   = get_term_by( 'slug', $category_slug, 'category' );
				$filters        = array();
				$filters[]      = $categoryinfo->term_id;
			}
			$filter = 'ja';
			$terms  = get_term_by( "slug", get_query_var( RHSWP_CT_DOSSIER ), RHSWP_CT_DOSSIER );
			if ( $terms && ! is_wp_error( $terms ) ) {
				$term = $terms;
			}
		} else {
			// nope, just use the known dossier
			if ( $terms && ! is_wp_error( $terms ) ) {
				$term = array_pop( $terms );
			}
		}
		// default = very unspecific filter
		$args            = array(
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'paged'          => $paged,
			'posts_per_page' => get_option( 'posts_per_page' ),
		);
		$message         = _x( 'All posts', 'Dossier header', 'wp-rijkshuisstijl' );
		$currentterm     = '';
		$currenttermname = '';
		$currenttermslug = '';
		if ( $term && ! is_wp_error( $term ) ) {
			// we can make the query more specific
			$currentterm     = $term->term_id;
			$currenttermname = $term->name;
			$currenttermslug = $term->slug;
			if ( $currentterm ) {
				// filter op dossier
				$args    = array(
					'post_type'      => 'post',
					'paged'          => $paged,
					'posts_per_page' => get_option( 'posts_per_page' ),
					'tax_query'      => array(
						'relation' => 'AND',
						array(
							'taxonomy' => RHSWP_CT_DOSSIER,
							'field'    => 'term_id',
							'terms'    => $currentterm
						)
					)
				);
				$message = sprintf( _x( 'posts for topic %s', 'Dossier header', 'wp-rijkshuisstijl' ), $currenttermname );
			}
		} else {
			dodebug_do( 'Terms NIET bekend :-(' );
		}
		if ( $filter !== 'ja' ) {
		} else {
			if ( $filters ) {
				$slugs = array();
				foreach ( $filters as $filter ):
					$terminfo = get_term_by( 'id', $filter, 'category' );
					$message  .= ' gecombineerd met de categorie "' . $terminfo->name . '"';
					$slugs[]  = $terminfo->slug;
				endforeach;
				if ( $currentterm ) {
					$args = array(
						'post_type'      => 'post',
						'paged'          => $paged,
						'posts_per_page' => get_option( 'posts_per_page' ),
						'tax_query'      => array(
							'relation' => 'AND',
							array(
								'taxonomy' => RHSWP_CT_DOSSIER,
								'field'    => 'term_id',
								'terms'    => $currentterm
							),
							array(
								'taxonomy' => 'category',
								'field'    => 'slug',
								'terms'    => $slugs,
							)
						)
					);
				} else {
					$args = array(
						'post_type'      => 'post',
						'paged'          => $paged,
						'posts_per_page' => get_option( 'posts_per_page' ),
						'tax_query'      => array(
							array(
								'taxonomy' => 'category',
								'field'    => 'slug',
								'terms'    => $slugs,
							)
						)
					);
				}
			}
		}
		$wp_query = new WP_Query( $args );
		if ( $wp_query->have_posts() ) {
			echo '<div class="posts-for-dossier flexcontainer page-dossiersingleactueel">';
			echo '<div class="block no-top">';
			$postcounter = 0;
//			$with_featured_image = 2;
			while ( $wp_query->have_posts() ) {
				$wp_query->the_post();
				$postcounter ++;
				$doimage  = false;
				$posttype = 'type-' . get_post_type();
//				if ( ( $postcounter <= $with_featured_image ) && has_post_thumbnail() ) {
				if ( has_post_thumbnail() ) {
					$doimage = true;
				}
				if ( $currentsite && $currentpage ) {
					$postpermalink = get_the_permalink();
					$postpermalink = str_replace( $currentsite, '', $postpermalink );
					$postpermalink = '/' . $post->post_name;
					$crumb         = str_replace( $currentsite, '', $currentpage );
					if ( $dossierfilter ) {
						$crumb = '/' . RHSWP_CT_DOSSIER . '/' . $dossierfilter . '/' . RHSWP_DOSSIERCONTEXTPOSTOVERVIEW;
						if ( $categoryfilter ) {
							$crumb .= '/' . RHSWP_DOSSIERCONTEXTCATEGORYPOSTOVERVIEW . '/' . $categoryfilter;
						}
						$theurl = $currentsite . $crumb . $postpermalink . '/';
					} else {
						$theurl = $currentsite . $crumb . RHSWP_DOSSIERPOSTCONTEXT . $postpermalink . '/';
					}
				} else {
					$theurl = get_the_permalink();
				}
				$title          = rhswp_filter_alternative_title( get_the_id(), get_the_title() );
				$excerpt        = get_the_excerpt();
				$postdate       = get_the_date();
				$categorielinks = '';
				if ( $doimage ) {
					echo '<article class="has-post-thumbnail ' . $posttype . '"><div class="article-container">';
					printf( '
					<div class="article-visual">%s</div>
					<div class="article-excerpt">
					<a href="%s"><h2>%s</h2><p class="meta">%s</p><p>%s</p></a>
					</div>', get_the_post_thumbnail( $post->ID, 'article-visual' ), $theurl, $title, $postdate, $excerpt );
					echo '</div></article>';
				} else {
					printf( '<section><a href="%s"><h2>%s</h2><p class="meta">%s</p><p>%s</p>%s</a></section>', $theurl, $title, $postdate, wp_strip_all_tags( $excerpt ), $categorielinks );
				}
			}
			echo '</div>'; // class="block">';
			echo '</div>'; // class="posts-for-dossier flexcontainer">';
		} else {
			echo '<p>';
			echo sprintf( _x( 'No results for %s.', 'No results text', 'wp-rijkshuisstijl' ), $message );
			echo '</p>';
		}
		genesis_posts_nav();
		wp_reset_query();
	}
}

//========================================================================================================

function rhswp_get_documents_for_dossier() {

	global $post;
	global $wp_query;

	$message     = 'Alle documenten';
	$currentpage = get_permalink();
	$currentsite = get_site_url();
	$postname    = $post->post_name;
	$paged       = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$term        = '';

	if ( is_single() && ( RHSWP_CPT_DOCUMENT == get_post_type() ) ) {
		return true;
	}


	if ( taxonomy_exists( RHSWP_CT_DOSSIER ) ) {
		if ( get_query_var( RHSWP_CT_DOSSIER ) ) {
			$term = get_term_by( 'slug', get_query_var( RHSWP_CT_DOSSIER ), RHSWP_CT_DOSSIER );
		} else {
			$terms = get_the_terms( $post->ID, RHSWP_CT_DOSSIER );
			if ( $terms && ! is_wp_error( $terms ) ) {
				$term = array_pop( $terms );
			}
		}
		if ( $term ) {
			$message  = sprintf( _x( 'posts for topic %s', 'Dossier header', 'wp-rijkshuisstijl' ), $term->name );
			$args     = array(
				'post_type'      => RHSWP_CPT_DOCUMENT,
				'paged'          => $paged,
				'posts_per_page' => get_option( 'posts_per_page' ),
				'tax_query'      => array(
					'relation' => 'AND',
					array(
						'taxonomy' => RHSWP_CT_DOSSIER,
						'field'    => 'term_id',
						'terms'    => $term->term_id
					)
				)
			);
			$wp_query = new WP_Query( $args );
			if ( $wp_query->have_posts() ) {

				$item_count  = $wp_query->post_count;
				$columncount = 3;

				if ( 1 === $item_count ) {
					$columncount = 1;
				} elseif ( 2 === $item_count ) {
					$columncount = 2;
				} elseif ( 4 === $item_count ) {
					$columncount = 2;
				}

				echo '<div class="grid itemcount-' . $item_count . ' columncount-' . $columncount . '">';

				while ( $wp_query->have_posts() ):
					$wp_query->the_post();

					$theurl = get_the_permalink();

					if ( $currentsite && $currentpage ) {
						$postpermalink = get_the_permalink();
						$postname      = $post->post_name;
						$postpermalink = '/' . $postname;
						$crumb         = '/' . RHSWP_CT_DOSSIER . '/' . $term->slug . '/' . RHSWP_DOSSIERCONTEXTDOCUMENTOVERVIEW;
						$theurl        = $currentsite . $crumb . $postpermalink;
					}

					$args2 = array(
						'ID'        => $post->ID,
						'type'      => 'posts_document',
						'permalink' => trailingslashit( $theurl ),
					);

					echo rhswp_get_grid_item( $args2 );

				endwhile;

				echo '</div>'; // .grid

				genesis_posts_nav();
				wp_reset_query();


			} else {
				echo '<p>';
				echo sprintf( _x( 'No results for %s.', 'No results text', 'wp-rijkshuisstijl' ), $message );
				echo '</p>';
			}
		} else {
			dodebug_do( 'rhswp_get_documents_for_dossier: C. Term NIET gevuld. ' . $message );
		}
	}
}

//========================================================================================================
function rhswp_get_events_for_dossier() {
	global $post;
	if ( taxonomy_exists( RHSWP_CT_DOSSIER ) ) {
		if ( get_query_var( RHSWP_CT_DOSSIER ) ) {
			$term = get_term_by( 'slug', get_query_var( RHSWP_CT_DOSSIER ), RHSWP_CT_DOSSIER );
		} else {
			$terms = get_the_terms( $post->ID, RHSWP_CT_DOSSIER );
			if ( $terms && ! is_wp_error( $terms ) ) {
				$term = array_pop( $terms );
			}
		}
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		if ( $term && class_exists( 'EM_Events' ) ) {
			$eventlist = EM_Events::output( array( RHSWP_CT_DOSSIER => $term->term_id ) );
			echo $eventlist;
		}
	}
}

//========================================================================================================
function rhswp_custom_page_title_for_overviewpage( $title ) {
	if ( taxonomy_exists( RHSWP_CT_DOSSIER ) ) {
		if (
			( RHSWP_DOSSIERCONTEXTPOSTOVERVIEW == get_query_var( 'pagename' ) ) ||
			( RHSWP_DOSSIERCONTEXTEVENTOVERVIEW == get_query_var( 'pagename' ) ) ||
			( RHSWP_DOSSIERCONTEXTDOCUMENTOVERVIEW == get_query_var( 'pagename' ) )
		) {
			$term  = get_term_by( 'slug', get_query_var( RHSWP_CT_DOSSIER ), RHSWP_CT_DOSSIER );
			$paged = ( get_query_var( 'paged' ) ) ? sprintf( __( '- page %s', 'wp-rijkshuisstijl' ), get_query_var( 'paged' ) ) : '';
			if ( RHSWP_DOSSIERCONTEXTPOSTOVERVIEW == get_query_var( 'pagename' ) ) {
				// posts
				$category_slug = get_query_var( 'category_slug' );
				if ( $category_slug ) {
					$categoryinfo = get_term_by( 'slug', $category_slug, 'category' );
					$title        = sprintf( _x( '%s for \'%s\' %s', 'Posts for topic with category', 'wp-rijkshuisstijl' ), $categoryinfo->name, $term->name, $paged );
				} else {
					if ( $term->name ) {
						$title = sprintf( _x( 'Posts for %s %s', 'Posts for topic without category', 'wp-rijkshuisstijl' ), $term->name, $paged );
					} else {
						$title = _x( 'Posts', 'post types', 'wp-rijkshuisstijl' );
					}
				}
			} elseif ( RHSWP_DOSSIERCONTEXTEVENTOVERVIEW == get_query_var( 'pagename' ) ) {
				// events
				if ( $term->name ) {
					$title = sprintf( __( 'Events for %s %s', 'wp-rijkshuisstijl' ), $term->name, $paged );
				} else {
					$title = _x( "Events", 'post types', 'wp-rijkshuisstijl' );
				}
			} elseif ( RHSWP_DOSSIERCONTEXTDOCUMENTOVERVIEW == get_query_var( 'pagename' ) ) {
				// documents
				if ( $term && $term->name ) {
					$title = sprintf( __( 'Documents for %s %s', 'wp-rijkshuisstijl' ), $term->name, $paged );
				} else {
					$title = _x( "Documents", 'post types', 'wp-rijkshuisstijl' );
				}
			}
		}
	}

	return $title;
}

//========================================================================================================
/**
 * Retrieve a post ID for a slug and post type
 */
function get_postid_by_slug( $page_slug = '', $posttype = 'post' ) {
	if ( $page_slug ) {
		$postobject = get_page_by_path( $page_slug, OBJECT, $posttype );
		if ( $postobject ) {
			return $postobject->ID;
		}
	}

	return 0;
}

//========================================================================================================
function acf_check( $fn ) {
	$theline = __( 'ACF plugin is niet actief (' . $fn . ') ', 'wp-rijkshuisstijl' );
	error_log( $theline );
	if ( ! is_admin() ) {
		if ( WP_DEBUG ) {
			die( $theline );
		} else {
			echo '<p>' . $theline . '</p>';
		}
	}
}

//========================================================================================================
if ( ! function_exists( 'get_field' ) || ! function_exists( 'have_rows' ) ) {
	acf_check( 'get_field' );
}
//========================================================================================================
/**
 * Localise admin script
 */
function localize_admin_scripts() {
	wp_localize_script( 'rijksvideo-admin-script', 'rijksvideo', array(
			'url'     => __( "URL", "rijksvideo-translate" ),
			'caption' => __( "Caption", "rijksvideo-translate" ),
		)
	);
}

//========================================================================================================
function ie_style_sheets() {
	wp_register_style( 'ie9', RHSWP_THEMEFOLDER . '/css/ie9.css' );
	$GLOBALS['wp_styles']->add_data( 'ie9', 'conditional', 'lte IE 9' );
	wp_enqueue_style( 'ie9' );
}

add_action( 'wp_enqueue_scripts', 'ie_style_sheets' );
//========================================================================================================
add_action( 'admin_enqueue_scripts', 'admin_enqueue_css_acf_contentblokken' );
function admin_enqueue_css_acf_contentblokken() {
	if ( is_admin() ) {
		wp_enqueue_style( 'admin-css-acf-contentblokken', RHSWP_THEMEFOLDER . '/css/admin-css-acf-contentblokken.css', false, CHILD_THEME_VERSION );
	}
}

//========================================================================================================
// hide site description visually if necessary
add_filter( 'genesis_seo_description', 'rhswp_filter_site_description', 10, 3 );
function rhswp_filter_site_description( $description, $inside, $wrap ) {
	$showpayoff = get_field( 'siteoption_show_payoff_in_header', 'option' );
	if ( 'show_payoff_in_header_no' === $showpayoff ) {
		// hide visually by adding extra class .screen-reader-text
		$custom = str_replace( 'class="site-description"', 'class="site-description screen-reader-text"', $description );

		return $custom;
	} else {
		return $description;
	}
}

//========================================================================================================
add_action( 'genesis_header', 'rhswp_append_site_logo' );
function rhswp_append_site_logo() {
	// @since 2.14.1
	// flavor checken.
	$get_theme_option      = get_option( 'rhswp_customizer_theme_options' );
	$flavor_select         = $get_theme_option['flavor_select'];
	$show_payoff_in_header = '';
	$anchorstart           = '<a href="' . get_bloginfo( 'url' ) . '">';
	$anchorend             = '</a>';
//	$title = '<p class="site-title" id="menu_site_description">' . $anchorstart . $title . $anchorend . '</p>';
	if ( $flavor_select == "flitspanel" ) {
		$anchorstart = '<a href="' . get_home_url() . '" aria-label="Naar de homepage van Flitspanel">';
	}
	$showpayoff = get_field( 'siteoption_show_payoff_in_header', 'option' );
	if ( 'show_payoff_in_header_no' === $showpayoff ) {
		$show_payoff_in_header = ' align-middle';
	}
	if ( is_front_page() ) {
		$anchorstart = '<span class="container">';
		$anchorend   = '</span>';
	}
	if ( $flavor_select == "flitspanel" ) {
		echo '<span id="logotype" class="flitspanel' . $show_payoff_in_header . '">' . $anchorstart . '<img src="' . RHSWP_THEMEFOLDER . '/images/logos/flitspanel-logo.png" alt="Logo van Flitspanel, met als ondertekst: het medwerkerspanel van en voor de publieke sector" width="300" height="123">' . $anchorend . '</span>';
	} else {
		echo '<span id="logotype" class="' . $show_payoff_in_header . '">' . $anchorstart . '<img src="' . RHSWP_THEMEFOLDER . '/images/svg/logo-digitale-overheid.svg" alt="Logo Rijksoverheid">' . $anchorend . '</span>';
	}
}

//========================================================================================================
add_filter( 'the_content', 'rhswp_filter_strange_characters', 1 );
/*
 * CSS-validatie en div. kleine accessibility correcties.
 */
function rhswp_filter_strange_characters( $content ) {
	// Check if we're inside the main loop in a single Post.
	if ( is_singular() && in_the_loop() && is_main_query() ) {
		$look_for     = '/ /i'; // Narrow No-Break Space [NNBSP]
		$replace_with = ' ';
		$content      = preg_replace( $look_for, $replace_with, $content );
	}

	return $content;
}

//========================================================================================================
// ervoor zorgen dat voor het veld 'home_row_1_cell_1_post' dat alleen *gepubliceerde* content te selecteren is
add_filter( 'acf/fields/relationship/query/name=select_berichten_paginas', 'acf_relationshipfield_only_use_published_content', 10, 3 );
add_filter( 'acf/fields/relationship/query/name=selecteer_uitgelichte_paginas_of_berichten', 'acf_relationshipfield_only_use_published_content', 10, 3 );
add_filter( 'acf/fields/relationship/query/name=home_row_1_cell_1_post', 'acf_relationshipfield_only_use_published_content', 10, 3 );
add_filter( 'acf/fields/relationship/query/name=home_row_1_cell_2_post', 'acf_relationshipfield_only_use_published_content', 10, 3 );
function acf_relationshipfield_only_use_published_content( $options, $field, $post_id ) {
	$options['post_status'] = [ 'publish' ];

	return $options;
}

//========================================================================================================
// Haalt voor een pagina of een bericht in opsommingen (zoals de homepage) een extra labeltje waarmee
// het bericht extra context krijgt
function rhswp_get_sublabel( $post_id ) {

	$return = '';

	if ( $post_id ) {

		if ( 'ja' === get_field( 'label_toevoegen', $post_id ) && get_field( 'post_label', $post_id ) ) {
			$return = get_field( 'post_label', $post_id );
		} elseif ( has_term( '', RHSWP_CT_DOSSIER, $post_id ) ) {
			$return = 'dossier ' . $post_id;
			if ( class_exists( 'WPSEO_Primary_Term' ) ) {
				// Show the post's 'Primary' category, if this Yoast feature is available, & one is set
				$wpseo_primary_term = new WPSEO_Primary_Term( RHSWP_CT_DOSSIER, $post_id );
				$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
				$term               = get_term( $wpseo_primary_term );

				if ( is_wp_error( $term ) ) {
					// whoopsy, but return nothing
					$return = '';
				} else {
					$return = $term->name;
				}
			} else {
				$uitgelicht_dossier = get_the_terms( $post_id, RHSWP_CT_DOSSIER );
				if ( $uitgelicht_dossier ) {
					$return = $uitgelicht_dossier[0]->name;
				}
			}
		} elseif ( get_the_tags( $post_id ) ) {

			// geen label en geen dossier, dan dus eerst checken of het ding een tag heeft
			$posttags = get_the_tags( $post_id );
			if ( $posttags ) {
				// geen verboden woorden, svp
				foreach ( $posttags as $value ) {
					$verboden = 'nieuwsbrief'; // voor de nieuwsbrief worden tags gebruikt en die willen we niet zien
					$gevonden = strpos( $value->name, $verboden );
					if ( $gevonden === false ) {
						$return = $value->name;
						break;
					}
				}
			}
		} elseif ( get_the_category( $post_id ) ) {
			// nog steeds niks dan maar de categorie teruggeven
			$categories = get_the_category( $post_id );
			if ( $categories ) {
				$return = $categories[0]->name;
			}
		} elseif ( 'post' === get_post_type( $post_id ) ) {
			$return = 'Geen label gevonden';
		} elseif ( 'actielijn' === get_post_type( $post_id ) ) {
			$return = '';
		} else {
			$return = get_post_type( $post_id );
		}
	}

	return $return;
}

//========================================================================================================

function rhswp_append_socialbuttons( $doecho = true ) {

	global $post;

	if ( is_single() && ( RHSWP_CPT_EVENT === get_post_type() || RHSWP_CPT_DOCUMENT === get_post_type() || 'post' == get_post_type() ) ) {

		$thelink       = urlencode( get_permalink( $post->ID ) );
		$thetitle      = urlencode( $post->post_title );
		$sitetitle     = urlencode( get_bloginfo( 'name' ) );
		$summary       = urlencode( $post->post_excerpt );
		$popup         = ' onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600\');return false;"';
		$cta           = _x( 'Share this post', 'share buttons CTA', 'wp-rijkshuisstijl' );
		$mailadres     = urlencode( 'geaddresseerd@voorbeeld.nl' );
		$return        = '';
		$mailonderwerp = urlencode( sprintf( _x( 'Read this: %s', 'share buttons mail onderwerp', 'wp-rijkshuisstijl' ), $post->post_title ) );

		if ( $thelink ) {
			$return = '<div class="share-bar aux-info-bar"><span class="cta">' . $cta . '</span>';
			$return .= '<ul>';
			$return .= '<li><a href="mailto:' . $mailadres . '?subject=' . $mailonderwerp . '&body=' . $thetitle . ' - ' . $thelink . '" target="_blank"><span class="social-media-icon social-media--mail">&nbsp;</span><span class="visuallyhidden">' . _x( "Share via email", 'share buttons mail', 'wp-rijkshuisstijl' ) . '</span></a></li>';
			$return .= '<li><a href="https://twitter.com/share?url=' . $thelink . '&via=digioverheid&text=' . $thetitle . '" data-url="' . $thelink . '" data-text="' . $thetitle . '" data-via="@digioverheid"' . $popup . '><span class="social-media-icon social-media--twitter">&nbsp;</span><span class="visuallyhidden">' . _x( "Share on Twitter", 'share buttons Twitter', 'wp-rijkshuisstijl' ) . '</span></a></li>';
			$return .= '<li><a href="http://www.linkedin.com/shareArticle?mini=true&url=' . $thelink . '&title=' . $thetitle . '&summary=' . $summary . '&source=' . $sitetitle . '"' . $popup . '><span class="social-media-icon social-media--linkedin">&nbsp;</span><span class="visuallyhidden">' . _x( "Share on LinkedIn", 'share buttons LinkedIn', 'wp-rijkshuisstijl' ) . '</span></a></li>';
			$return .= '</ul>';
			$return .= '</div>';
		}

		if ( $return ) {
			echo $return;
		}
	}

}

//========================================================================================================

function rhswp_append_terms_dossier( $doreturn = true ) {

	global $post;

	$return = '';

	if ( is_single() && ( RHSWP_CPT_DOCUMENT == get_post_type() || 'post' == get_post_type() ) ) {
		// dossier-info toevoegen ALLEEN voor documenten / berichten
		$terms = get_the_terms( $post->ID, RHSWP_CT_DOSSIER );
		if ( $terms && ! is_wp_error( $terms ) ) {
			$return = '<dl class="aux-info-bar dossier-labels">';
			$return .= '<dt>' . sprintf( _n( 'Dossier', "Dossiers", count( $terms ), 'wp-rijkshuisstijl' ), count( $terms ) ) . '</dt>';
			foreach ( $terms as $term ) {
				$return .= '<dd><a href="' . get_term_link( $term->term_id ) . '">' . $term->name . '</a></dd> ';
			}
			$return .= '</dl>';
		}

		if ( $doreturn ) {
			return $return;
		} else {
			echo $return;
		}
	}

}

//========================================================================================================

function rhswp_append_query_vars( $query_vars ) {
	$query_vars[] = 'sitemap_type';

	return $query_vars;
}

add_filter( 'query_vars', 'rhswp_append_query_vars' );

//========================================================================================================
/*
 * Deze shortcde voegt een hidden field toe als er iets van een verwijzende pagina bekend is bij de server
 * Dit is de shortcode:
 * [nieuwsbriefreferrer]
 * Meer niet.
 * Deze shortcode wordt gebruikt in het aanmeldformulier voor de nieuwsbrief
 */

function rhswp_nieuwsbrief_get_referrer( $atts ) {

	if ( $_SERVER['HTTP_REFERER'] ) {
		return '<' . '!-' . '- HTTP_REFERER --' . '>' . '<input type="hidden" name="nr" value="' . esc_url_raw( $_SERVER['HTTP_REFERER'] ) . '">';
	}

	return '';
}

add_shortcode( 'nieuwsbriefreferrer', 'rhswp_nieuwsbrief_get_referrer' );

//========================================================================================================

