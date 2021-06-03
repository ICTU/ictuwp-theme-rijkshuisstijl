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
// Defaults:
// - we tonen een kruimelpad en geen menu
// - we tonen wel het zoekformulier

$site_show_rijkshuisstijlruimelpadmenu = true;
$site_hide_genesis_breadcrumb          = false;
$site_show_searchform                  = true;

if ( function_exists( 'get_field' ) ) {

	if ( 'hide' === get_field( 'siteoption_hide_searchbox', 'option' ) ) {
		$site_show_searchform = false;
	}

	if ( 'toon_menu' === get_field( 'siteoption_kruimelpadmenu', 'option' ) ) {
		// - in plaats van een kruimelpad tonen we het menu
		$site_show_rijkshuisstijlruimelpadmenu = false;

		// kijken of we onder het menu wel of geen kruimelpad willen tonen?
		if ( 'hide_breadcrumb' === get_field( 'siteoption_kruimelpadmenu_hide_breadcrumb', 'option' ) ) {
			// nee, we willen geen kruimelpad tonen
			$site_hide_genesis_breadcrumb = true;
		}
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


	$title                     = rhswp_clean_site_title( get_bloginfo( 'name' ) );
	$idmenu                    = 'menu_container';
	$idsearch                  = 'search_container';
	$anchorstart               = '<a href="' . get_bloginfo( 'url' ) . '">';
	$anchorend                 = '</a>';
	$siteoption_kruimelpadmenu = '';
	$siteoption_hide_searchbox = '';

	if ( function_exists( 'get_field' ) ) {
		$siteoption_kruimelpadmenu = get_field( 'siteoption_kruimelpadmenu', 'option' );
		$siteoption_hide_searchbox = get_field( 'siteoption_hide_searchbox', 'option' );
	}

	if ( is_front_page() ) {
		$anchorstart = '';
		$anchorend   = '';
	}


	if ( is_front_page() || ( 'toon_menu' === $siteoption_kruimelpadmenu ) ) {
		// - in plaats van een kruimelpad tonen we het menu
		$site_show_rijkshuisstijlruimelpadmenu = false;

		if ( has_nav_menu( 'primary' ) ) {

			echo '<div id="menu-container">';
			echo '<div class="wrap">';
			echo '<div id="buttons-title">';
			echo '<p id="site_title_mobile">' . $anchorstart . $title . $anchorend . '</p>';
			echo '<div id="buttons_container"> ';
			echo '</div>'; // #buttons_container
			echo '</div>'; // #buttons-title

			echo '<nav class="nav-primary init" id="' . $idmenu . '">';
			wp_nav_menu( array(
				'theme_location'  => 'primary',
				'menu_id'         => 'ul_nav_primary',
				'container_class' => ''
			) );
			echo '</nav>';

			$args = array(
				'echo' => false
			);

			$search = get_search_form( $args );

			if ( 'hide' === $siteoption_hide_searchbox ) {
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
				echo '<div id="' . $idsearch . '" class="init">';
				echo $search;
				echo '</div>';
			}

			echo '</div>'; // .wrap
			echo '</div>'; // #nav_container

		}

	}

}


add_action( 'genesis_after_header', 'rhswp_header_navigation', 11 );

//========================================================================================================

// Filter the title with a custom function
add_filter( 'genesis_seo_title', 'rhswp_filter_site_title' );

// Make sure the text can be wrapped on smaller screens by
// filtering long strings and hide site title visually if necessary
function rhswp_filter_site_title( $title = '' ) {

	$title      = rhswp_clean_site_title( get_bloginfo( 'name' ) );
	$showpayoff = true;
	if ( function_exists( 'get_field' ) ) {
		$showpayoff = get_field( 'siteoption_show_payoff_in_header', 'option' );
	}
	$anchorstart = '<a href="' . get_bloginfo( 'url' ) . '">';
	$anchorend   = '</a>';
	$titletag    = 'p';

	if ( is_front_page() ) {
		$anchorstart = '';
		$anchorend   = '';
		$titletag    = 'h1';
	}

	$title = '<' . $titletag . ' class="site-title" id="menu_site_description">' . $anchorstart . $title . $anchorend . '</' . $titletag . '>';

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

	if ( function_exists( 'get_field' ) ) {
		if ( 'hide' === get_field( 'siteoption_hide_searchbox', 'option' ) ) {
			// zoekdoos hoeft nergens getoond te worden
			return $menu;
		}
	}
	else {
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

