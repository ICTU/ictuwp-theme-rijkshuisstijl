<?php

/**
// * Rijkshuisstijl (Digitale Overheid) - searchform.php
// * ----------------------------------------------------------------------------------
// * Overwrite default searchform
// * this file is a copy from /themes/genesis/searchform.php
// * ----------------------------------------------------------------------------------
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 1.2.7
// * @desc.   Voor dossiers: automatische links toegevoegd voor berichten, events, documenten. Plus: search form in breadcrumb.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */

$strings                  = array();
$search_text              = apply_filters( 'genesis_search_text', __( 'Search this website', 'genesis' ) );
$strings['label']         = $search_text; // apply_filters( 'genesis_search_form_label', '' );
/** This filter is documented in wp-includes/general-template.php */
$input_value              = apply_filters( 'the_search_query', get_search_query() ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Duplicated WordPress filter
$strings['input_value']   = ! empty( $input_value ) ? $input_value : '';
$strings['submit_value']  = apply_filters( 'genesis_search_button_text', esc_attr__( 'Search', 'genesis' ) );
$strings['placeholder']   = $search_text;
$strings['label']         = isset( $strings['label'] ) ? $strings['label'] : $strings['placeholder'];



$form = new Genesis_Search_Form( $strings );

/**
 * Allow the form output to be filtered.
 *
 * @since 1.0.0
 *
 * @param string The form markup.
 * @param string Input value.
 * @param string Submit button value.
 * @param string Form label value.
 */
$searchform = apply_filters( 'genesis_search_form', $form->get_form(), $strings['input_value'], $strings['submit_value'], $strings['label'] );

echo $searchform; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Need this to output raw html.
// phpcs:enable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
