<?php

/**
// * Rijkshuisstijl (Digitale Overheid) - page_fullwidth.php
// * ----------------------------------------------------------------------------------
// * Pagina met alleen full width, geen zijbalk
// * ----------------------------------------------------------------------------------
// * 
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 2.5.1
// * @desc.   Lijst met pagina-templates gecontroleerd en opgeschoond.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
// 
 */


//* Template Name: DO - Template voor pagina zonder zijbalk met widgets

//* Force full-width-content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

genesis();
