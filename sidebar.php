<?php

/**
 * Rijkshuisstijl (Digitale Overheid) - sidebar.php
 * ----------------------------------------------------------------------------------
 * verantwoordelijk voor eventuele sidebars. Er zit extra functionaliteit in
 * de zijbalk voor het tonen van contextuele info.
 * Deze functionaliteit komt uit rhswp_sidebar_context_widgets()
 * ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 2.22.2
 * @desc.   Verdere styling Gravity Forms. Eerste opzet voor alert-bannerruimte.
 * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */

//* Output primary sidebar structure
genesis_markup( array(
	'html5'   => '<aside %s><h2 class="screen-reader-text">' . _x( 'Gerelateerde content', 'Title of primary sidebar', 'wp-rijkshuisstijl' ) . '</h2>',
	'xhtml'   => '<div id="sidebar" class="sidebar widget-area">',
	'context' => 'sidebar-primary',
) );

do_action( 'genesis_before_sidebar_widget_area' );

//echo rhswp_banner_alert_alert_mayday_mayday_desktop();

// paginaspecifieke widget
do_action( 'rhswp_primary_sidebar_first_action' );

do_action( 'genesis_sidebar' );
do_action( 'genesis_after_sidebar_widget_area' );

genesis_markup( array(
	'html5' => '</aside>', //* end .sidebar-primary
	'xhtml' => '</div>', //* end #sidebar
) );
