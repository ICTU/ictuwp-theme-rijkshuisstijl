<?php

/**
// * Rijkshuisstijl (Digitale Overheid) - page.php
// * ----------------------------------------------------------------------------------
// * Toont alle dossiers
// * ----------------------------------------------------------------------------------
// * 
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 2.5.1
// * @desc.   Lijst met pagina-templates gecontroleerd en opgeschoond.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */


if ( rhswp_extra_contentblokken_checker() ) {
  add_action( 'genesis_entry_content', 'rhswp_write_extra_contentblokken', 14 );
}


//========================================================================================================

genesis();

