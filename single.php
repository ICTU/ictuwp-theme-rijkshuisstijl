<?php

// Rijkshuisstijl (Digitale Overheid) - single.php
// ----------------------------------------------------------------------------------
// Toont een bericht
// ----------------------------------------------------------------------------------
// 
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 2.12.2
// * @desc.   Kortere check op uitschrijven nav.bar op home.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl


//========================================================================================================

add_action( 'genesis_entry_content', 'rhswp_write_extra_contentblokken', 14 );

//========================================================================================================

genesis();

//========================================================================================================

