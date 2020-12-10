<?php

/**
// * Rijkshuisstijl (Digitale Overheid) - skip-links.php
// * ----------------------------------------------------------------------------------
// * Adds skiplinks after the header to content, menu's and asides.
// * ----------------------------------------------------------------------------------
// * @author  Rian Rietveld
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 2.12.17
// * @desc.   Skiplink-structuur aangepast.
// * @link    http://genesis-accessible.org/
 */



add_action ( 'genesis_before_header', 'rhswp_skip_links', 5);

/** Add skiplinks for screen readers and keyboard navigation for Genesis version < 2.2
*
* @since 1.0.0
*/
function rhswp_skip_links() {

	global $wp_query;
	
	// Call function to add IDs to the markup
	rhswp_skiplinks_markup();

	// Determine which skip links are needed
	$links 			= array();
	$loop 			= '';
	$dossier		= '?';
	$carousselcheck	= '';
	
	// een default 
	$idvoor_pagina_inhoud = 'genesis-content';

	// eerst de hoofdnavigatie	
	// eerst checken of er een carroussel of header-image getoond zal worden op deze pagina
	// als dat zo is, verwijst de skiplink naar deze ID, in plaats van naar #genesis-content
	if ( is_page() ) {
		$objectid       = get_the_ID();
		$divid          = $objectid;
		$carousselcheck = get_field( 'carrousel_tonen_op_deze_pagina', $objectid );
	}
	elseif ( is_tax( RHSWP_CT_DOSSIER ) ) {
		$objectid       = RHSWP_CT_DOSSIER . '_' . get_queried_object()->term_id;
		$divid          = get_queried_object()->term_id;
		$carousselcheck = get_field( 'carrousel_tonen_op_deze_pagina', $objectid );
	}
	
	

	if( has_term( '', RHSWP_CT_DIGIBETER, get_the_ID() ) && ( ! is_tax( RHSWP_CT_DIGIBETER ) ) ) {
		// deze post heeft een 'beleidskleur' en toont dus geen dossierinfo en geen headerimage
		// $idvoor_pagina_inhoud blijft onveranderd
		$loop 		= RHSWP_CT_DIGIBETER;
	}
	elseif ( get_query_var( RHSWP_CT_DOSSIER ) ) {
		// checken of er wellicht een dossier-info bovenaan geschreven wordt. 
		$loop 					= 'dossier is bekend';
		$idvoor_pagina_inhoud 	= ID_DOSSIER_DIV;
		$dossier				= get_query_var( RHSWP_CT_DOSSIER );
	}
	elseif ( RHSWP_HEADER_IMAGE_CONFIRM == $carousselcheck ) {
		// er komt dus wel een header image aan
		$image_tekst      = get_field( 'kies_header_image_tekst', get_the_ID() );

		if ( $image_tekst ) {
			// en er zit tekst over de header image, dus verwijzen we naar deze ID
			$idvoor_pagina_inhoud = 'hero_' . $divid;
		}
		else {
			// wel een header image, maar alleen maar decoratief (i.e. zonder tekst)
			// dus gewoon verwijzen naar #genesis-content
			// $idvoor_pagina_inhoud blijft onveranderd
		}
	} 
	elseif ( is_page() ) {

		// is deze pagina aan een dossier gekoppeld?
		$terms        = get_the_terms( get_the_ID() , RHSWP_CT_DOSSIER );

		if ( $terms && ! is_wp_error( $terms ) ) { 
			// ja, deze pagina zit in een dossier
			$idvoor_pagina_inhoud 	= ID_DOSSIER_DIV;
			$dossier 				= $terms[0]->name;
		}
	}
	
	// nu weten we naar welke ID we moeten verwijzen; 
	// voeg die toe aan de skiplink-array
	$links[ $idvoor_pagina_inhoud ] = __( 'Direct naar de pagina-inhoud', 'wp-rijkshuisstijl' );

	
	// dan de skiplink naar de naviatie
	if ( has_nav_menu( 'primary' ) ) {
		if ( is_home() || is_front_page() ) {
			$links['genesis-nav-primary'] =  __( 'Direct naar de hoofdnavigatie', 'wp-rijkshuisstijl' );
		}
	}
	
	// dan voor pagina's / berichten met een actieve widgetruimte, mogelijkheid te verwijzen naar de widgetruimtes
	if ( in_array( genesis_site_layout(), array(
			'sidebar-content',
			'content-sidebar',
			'sidebar-sidebar-content',
			'sidebar-content-sidebar',
			'content-sidebar-sidebar' ) ) ) {
		$links['genesis-sidebar-primary'] = __( 'Direct naar de secundaire content met widgets', 'wp-rijkshuisstijl' );
	}
	
	if ( in_array( genesis_site_layout(), array(
			'sidebar-sidebar-content',
			'sidebar-content-sidebar',
			'content-sidebar-sidebar' ) ) ) {
		$links['genesis-sidebar-secondary'] = __( 'Direct naar de tweede zijbalk met widgets', 'wp-rijkshuisstijl' );
	}
	
	// tenslotte, ook verwijzen naar de footerwidgets
	if ( current_theme_supports( 'genesis-footer-widgets' ) ) {
		$footer_widgets = get_theme_support( 'genesis-footer-widgets' );
		if ( isset( $footer_widgets[0] ) && is_numeric( $footer_widgets[0] ) ) {
			if ( is_active_sidebar( 'footer-1' ) ) {
				$links['genesis-footer-widgets'] = __( 'Direct naar de footer', 'wp-rijkshuisstijl' );
			}
		}
	}
	
//	// secundaire navigatie
//	if ( has_nav_menu( 'secondary' ) ) {
//		if ( is_home() || is_front_page() ) {
//			$links['genesis-nav-secondary'] =  __( 'Direct naar het tweede navigatiemenu', 'wp-rijkshuisstijl' );
//		}
//	}

	/**
	* Filter the skip links.
	*
	* @since 1.2.0
	*
	* @param array $links {
	*     Default skiplinks.
	*
	*     @type string HTML ID attribute value to link to.
	*     @type string Anchor text.
	* }
	*/
	$links = apply_filters( 'genesis_skip_links_output', $links );
	
	// write HTML, skiplinks in a list with a heading
	$skiplinks  =  '<section id="skiplinkscontainer" aria-labelledby="skiplinkstitle">';
	$skiplinks .=  '<h2 class="screen-reader-text" id="skiplinkstitle">'. __( 'Omzeilende links', 'wp-rijkshuisstijl' ) .'</h2>';
	$skiplinks .=  '<ul class="genesis-skip-link genwpacc-genesis-skip-link">';
	
	// Add markup for each skiplink
	foreach ( $links as $key => $value ) {
		$skiplinks .=  '<li><a href="' . esc_url( '#' . $key ) . '" class="screen-reader-shortcut"> ' . $value . '</a></li>';
	}
	
	$skiplinks .=  '</ul>';
	$skiplinks .=  '</section>' . "\n";
	
	echo $skiplinks;
	
}


/**
 * Add ID markup to the elements to jump to  for Genesis version < 2.2
 *
 * @since 1.2.0
 *
 * @link https://gist.github.com/salcode/7164690
 * @link genesis_markup() http://docs.garyjones.co.uk/genesis/2.0.0/source-function-genesis_parse_attr.html#77-100
 *
 */
function rhswp_skiplinks_markup() {

    add_filter( 'genesis_attr_nav-primary',          'rhswp_skiplinks_attr_nav_primary' );
    add_filter( 'genesis_attr_site-inner',           'rhswp_skiplinks_attr_content' );
    add_filter( 'genesis_attr_sidebar-primary',      'rhswp_sidebar_primary_attr_sidebar_primary' );
    add_filter( 'genesis_attr_sidebar-secondary',    'rhswp_sidebar_secondary_attr_sidebar_secondary' );
    add_filter( 'genesis_attr_footer-widgets',       'rhswp_footer_attr_footer_widgets' );

}

/**
 * Add ID markup to primary navigation
 *
 * @since 1.2.0
 *
 * @param array $attributes Existing attributes.
 *
 * @return $attributes plus id and aria-label
 *
 */
function rhswp_skiplinks_attr_nav_primary( $attributes ) {
	$attributes['id'] = 'genesis-nav-primary';
	$attributes['aria-label'] = __( 'Hoofdnavigatie', 'wp-rijkshuisstijl' );
	return $attributes;
}

/**
 * Add ID markup to content area
 *
 * @since 1.2.0
 *
 * @param array $attributes Existing attributes.
 *
 * @return $attributes plus id
 *
 */
function rhswp_skiplinks_attr_content( $attributes ) {
	$attributes['id'] = 'genesis-content';
	return $attributes;
}

/**
 * Add ID markup to primary sidebar
 *
 * @since 1.2.0
 *
 * @param array $attributes Existing attributes.
 *
 * @return $attributes plus id
 *
 */
function rhswp_sidebar_primary_attr_sidebar_primary( $attributes ) {
	$attributes['id'] = 'genesis-sidebar-primary';
	return $attributes;
}

/**
 * Add ID markup to secondary sidebar
 *
 * @since 1.2.0
 *
 * @param array $attributes Existing attributes.
 *
 * @return $attributes plus id
 *
 */
function rhswp_sidebar_secondary_attr_sidebar_secondary( $attributes ) {
	$attributes['id'] = 'genesis-sidebar-secondary';
	return $attributes;
}

/**
 * Add ID markup to footer widget area
 *
 * @since 1.2.0
 *
 * @param array $attributes Existing attributes.
 *
 * @return $attributes plus id
 *
 */
function rhswp_footer_attr_footer_widgets( $attributes ) {
	$attributes['id'] = 'genesis-footer-widgets';
	return $attributes;
}
