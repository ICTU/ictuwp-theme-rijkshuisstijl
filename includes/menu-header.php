<?php

/**
 *  Rijkshuisstijl (Digitale Overheid) - menu-header.php
 *  ----------------------------------------------------------------------------------
 *  functies rondom de header en het menu
 *  ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 2.10.3
 * @desc.   1 extra header-image voor cyber-toolbox toegevoegd; kleine CSS en JS verbeteringen.
 * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */

//========================================================================================================

// Tijdens het redesign van december 2020 besloten we af te stappen van alleen een broodkruimelpad als
// menu, zoals standaard is op de meeste rijkshuisstijl-sites.
// Voor backwards compatibility blijft de mogelijkheid voor een broodkruimelpadmenu gehandhaaft, tenzij
// in de theme-options expliciet voor iets anders wordt gekozen.
// zie: [admin] > Weergave > Instellingen theme > 'Zoekformulier, menu, kruimelpad'
//
// Veldnaam: 'siteoption_kruimelpadmenu'
// variabele: $site_show_rijkshuisstijlruimelpadmenu (boolean):
// - true: toon op onderliggende pagina's geen menu, maar alleen een broodkruimelpad
// - false: toon op onderliggende pagina's wel een menu, en daaronder een Genesis
// kruimelpad, indien gewenst (veldnaam: 'siteoption_kruimelpadmenu_hide_breadcrumb')
//

$site_show_rijkshuisstijlruimelpadmenu = true;
$site_hide_genesis_breadcrumb          = false;
$site_show_searchform                  = true;

if ( 'hide' === get_field( 'siteoption_hide_searchbox', 'option' ) ) {
	$site_show_searchform = false;
}

if ( 'toon_menu' === get_field( 'siteoption_kruimelpadmenu', 'option' ) ) {
	$site_show_rijkshuisstijlruimelpadmenu = false;
	if ( 'hide_breadcrumb' === get_field( 'siteoption_kruimelpadmenu_hide_breadcrumb', 'option' ) ) {
		$site_hide_genesis_breadcrumb = true;
	}
}

// Reposition the breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_after_header', 'genesis_do_breadcrumbs', 18 );


if ( $site_show_rijkshuisstijlruimelpadmenu ) {
	// toon geen menu maar een kruimelpad op onderliggende paagina's (i.e. anders dan de homepage)
	remove_action( 'genesis_after_header', 'genesis_do_nav' ); // primary menu

	// breadcrumb
	add_filter( 'body_class', 'rhswp_append_body_class_breadcrumb' );

} else {
	// toon een menu op onderliggende paagina's (i.e. anders dan de homepage)
	// wel of geen kruimelpad tonen?
	add_filter( 'body_class', 'rhswp_append_body_class_menu' );

}

//========================================================================================================

function rhswp_append_body_class_menu( $classes ) {
	$classes[] = 'menu-and-breadcrumb';

	return $classes;
}

//========================================================================================================


function rhswp_append_body_class_breadcrumb( $classes ) {
	$classes[] = 'breadcrumb-only';

	return $classes;
}

//========================================================================================================

// verplaatsen van secundair menu naar direct voor de header
remove_action( 'genesis_after_header', 'genesis_do_subnav' ); // secondary menu
add_action( 'genesis_before_header', 'genesis_do_subnav', 8 ); // secondary menu

//========================================================================================================

// Don't let Genesis load menus
remove_action( 'genesis_after_header', 'genesis_do_nav' );
remove_action( 'genesis_after_header', 'genesis_do_subnav' );

/**
 * Mobile Menu
 *
 */
function rhswp_header_navigation() {

	global $site_show_searchform;


	$title    = rhswp_clean_site_title( get_bloginfo( 'name' ) );
	$idmenu   = 'primary-menu';
	$idsearch = 'search-menu';

	echo '<div id="menu-container">';
	echo '<div class="wrap">';
	echo '<div class="buttons-title">';
	echo '<p id="site_title_mobile">' . $title . '</p>';
	echo '<button class="open" id="zoekdinges" aria-expanded="false" aria-controls="' . $idsearch . '">Sluit zoeken</button>';
	echo '<button class="close" id="menudinges" aria-expanded="false" aria-controls="' . $idmenu . '">Sluit menu</button>';
	echo '</div>'; // .buttons-title

	echo '<nav class="nav-primary js-menu init geen-menu-button" role="navigation">';
	if ( has_nav_menu( 'primary' ) ) {
		wp_nav_menu( array(
			'theme_location'  => 'primary',
			'menu_id'         => $idmenu,
			'container_class' => ''
		) );
	}
	echo '</nav>';
	$args = array(
		'echo' => false
	);

	$search = get_search_form( $args );

	if ( 'hide' === get_field( 'siteoption_hide_searchbox', 'option' ) ) {
		// zoekdoos hoeft nergens getoond te worden
		$search = '';
	}

	if ( is_search() ) {
		// geen extra zoekdoos op zoekresultaatpagina
		$search = '';
	}
	if ( is_404() ) {
		// geen extra zoekdoos op 404-pagina
		$search = '';
	}

	if ( $search ) {
		echo '<div id="' . $idsearch . '">';
		echo $search;
		echo '</div>';
	}

	echo '</div>'; // .wrap
	echo '</div>'; // #nav_container

}


add_action( 'genesis_after_header', 'rhswp_header_navigation', 11 );

//========================================================================================================

// Filter the title with a custom function
add_filter( 'genesis_seo_title', 'rhswp_filter_site_title' );

// Make sure the text can be wrapped on smaller screens by
// filtering long strings and hide site title visually if necessary
function rhswp_filter_site_title( $title = '' ) {

	$title      = rhswp_clean_site_title( get_bloginfo( 'name' ) );
	$showpayoff = get_field( 'siteoption_show_payoff_in_header', 'option' );

	$anchor_start = '<a href="' . get_bloginfo( 'url' ) . '">';
	$anchor_end   = '</a>';

	$title = '<p class="site-title" id="menu_site_description">' . $anchor_start . $title . $anchor_end . '</p>';

	if ( 'show_payoff_in_header_no' === $showpayoff ) {

		// hide visually by adding extra class .screen-reader-text
		$needle   = 'class="site-title"';
		$replacer = 'class="site-title screen-reader-text"';
		$title    = str_replace( $needle, $replacer, $title );

	}

	return $title;

}

//========================================================================================================

function rhswp_clean_site_title( $title = '' ) {

	$needle   = 'igitaleOverheid';
	$replacer = 'igitale&shy;Overheid';
	$title    = str_replace( $needle, $replacer, $title );

	$needle   = 'igitaleoverheid';
	$replacer = 'igitale&shy;overheid';
	$title    = str_replace( $needle, $replacer, $title );

	$needle   = '.nl';
	$replacer = '<span class="tld"><span class="puntenenel">.</span>nl</span>';
	$title    = str_replace( $needle, $replacer, $title );

	return $title;

}

//========================================================================================================

// append search box to navigation menu
//add_filter( 'wp_nav_menu_items', 'rhswp_append_search_box_to_menu', 10, 2 );

/**
 * Filter menu items, appending either a search form or today's date.
 *
 * @param string $menu HTML string of list items.
 * @param stdClass $args Menu arguments.
 *
 * @return string Amended HTML string of list items.
 */

function rhswp_append_search_box_to_menu( $menu, $args ) {

	if ( 'hide' === get_field( 'siteoption_hide_searchbox', 'option' ) ) {
		// zoekdoos hoeft nergens getoond te worden
		return $menu;
	}

	if ( is_search() ) {
		// geen extra zoekdoos op zoekresultaatpagina
		return $menu;
	}
	if ( is_404() ) {
		// geen extra zoekdoos op 404-pagina
		return $menu;
	}

	if ( 'primary' !== $args->theme_location ) {
		return $menu;
	}

	ob_start();
	get_search_form();
	$search = ob_get_clean();
	$menu   .= '<li class="right search">' . $search . '</li>';

	return $menu;
}

//========================================================================================================

