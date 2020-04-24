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
 * @version 0.2.4
 * @desc.   Context widget added
 * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */

//* Output primary sidebar structure
genesis_markup( array(
	'html5'   => '<aside %s><h2>' . _x( 'Tweede sidebar', 'Title of secondary sidebar', 'wp-rijkshuisstijl' ) . '</h2>',
	'xhtml'   => '<div id="sidebar" class="sidebar widget-area">',
	'context' => 'sidebar-secondary',
) );

do_action( 'genesis_before_sidebar_widget_area' );

do_action( 'genesis_sidebar_alt' );
do_action( 'genesis_after_sidebar_widget_area' );

genesis_markup( array(
	'html5' => '</aside>', //* end .sidebar-primary
	'xhtml' => '</div>', //* end #sidebar
) );
