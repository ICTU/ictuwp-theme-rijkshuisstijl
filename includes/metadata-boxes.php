<?php


/**
 * Rijkshuisstijl (Digitale Overheid) - functions.php
 * ----------------------------------------------------------------------------------
 * Zonder functions geen functionaliteit, he?
 * ----------------------------------------------------------------------------------
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.1.13
 * @desc.   Pagina-templates herzien
 * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */


/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'rhswp_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */


add_action( 'cmb2_admin_init', 'rhswp_register_dossier_actueel_page_metabox' );

/**
 * Hook in and add a metabox that only appears on the 'About' page
 */
function rhswp_register_dossier_actueel_page_metabox() {


	/**
	 * Metabox to be displayed on a single page ID
	 */

	if ( 22 == 33 ) {

		$cmb_dossier_actueel_page = new_cmb2_box( array(
			'id'           => RHSWP_PREFIX_TAG_CAT . 'metabox',
			'title'        => __( 'Bijbehorende tag / categorie', 'wp-rijkshuisstijl' ),
			'object_types' => array( 'page', ), // Post type
			'show_on_cb'   => 'rhswp_check_page_templates',
			'context'      => 'normal',
			'priority'     => 'high',
			'show_names'   => true,
			'closed'       => false,
		) );
	}

	if ( 22 == 33 ) {
		$cmb_dossier_actueel_page->add_field( array(
			'name'     => __( 'Test Taxonomy Radio', 'wp-rijkshuisstijl' ),
			'desc'     => __( 'field description (optional)', 'wp-rijkshuisstijl' ),
			'id'       => RHSWP_PREFIX_TAG_CAT . 'select_category_radio',
			'type'     => 'taxonomy_radio',
			'taxonomy' => 'category', // Taxonomy Slug
		) );
	}
	if ( 22 == 33 ) {
		$cmb_dossier_actueel_page->add_field( array(
			'name'     => __( 'Tag', 'wp-rijkshuisstijl' ),
			'desc'     => __( 'field description (optional)', 'wp-rijkshuisstijl' ) . ' / "' . RHSWP_PREFIX_TAG_CAT . RHSWP_CMB2_TAG_FIELD . '"',
			'id'       => RHSWP_PREFIX_TAG_CAT . RHSWP_CMB2_TAG_FIELD . 'XXX',
			'type'     => 'taxonomy_radio',
			'taxonomy' => 'post_tag', // Taxonomy Slug
			'text'     => array(
				'no_terms_text' => __( 'Er zijn geen tags toegevoegd.', 'wp-rijkshuisstijl' )
			),
		) );
	}

	if ( 22 == 33 ) {
		$cmb_dossier_actueel_page->add_field( array(
			'name'           => __( 'Tag', 'wp-rijkshuisstijl' ),
			'desc'           => __( 'Kies de tag voor de actueelpagina onder dit dossier.', 'wp-rijkshuisstijl' ),
			'id'             => RHSWP_PREFIX_TAG_CAT . RHSWP_CMB2_TAG_FIELD,
			'type'           => 'radio',
			// Use a callback to avoid performance hits on pages where this field is not displayed (including the front-end).
			'options_cb'     => 'cmb2_get_term_options',
			// Same arguments you would pass to `get_terms`.
			'get_terms_args' => array(
				'taxonomy'   => 'post_tag',
				'hide_empty' => false,
			),
		) );
	}


	if ( 22 == 33 ) {
		$cmb_dossier_actueel_page->add_field( array(
			'name' => RHSWP_PREFIX_TAG_CAT . RHSWP_CMB2_TXT_FIELD,
			'desc' => __( 'field description (optional)', 'wp-rijkshuisstijl' ),
			'id'   => RHSWP_PREFIX_TAG_CAT . RHSWP_CMB2_TXT_FIELD,
			'type' => 'text',
		) );
	}
}


//Return true if page template is 'page-template' or id is 30.
function rhswp_check_page_templates() {

	$post_id = 0;

	// If we're showing it based on ID, get the current ID
	if ( isset( $_GET['post'] ) ) {
		$post_id = $_GET['post'];
	} elseif ( isset( $_POST['post_ID'] ) ) {
		$post_id = $_POST['post_ID'];
	}

	if ( ! $post_id ) {
		return false;
	}

	$page_template = get_page_template_slug( $post_id );
	$page_template = ! empty( $page_template ) ? substr( $page_template, 0, - 4 ) : '';


	if ( $page_template === 'page_dossiersingle' ) {
		return true;
	} elseif ( $page_template === 'page_dossiersingleactueel' ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Gets a number of terms and displays them as options
 *
 * @param CMB2_Field $field
 *
 * @return array An array of options that matches the CMB2 options array
 */
function cmb2_get_term_options( $field ) {
	$args = $field->args( 'get_terms_args' );
	$args = is_array( $args ) ? $args : array();

	$args = wp_parse_args( $args, array( 'taxonomy' => 'category' ) );

	$taxonomy = $args['taxonomy'];

	$terms = (array) cmb2_utils()->wp_at_least( '4.5.0' )
		? get_terms( $args )
		: get_terms( $taxonomy, $args );

	// Initate an empty array
	$term_options = array();
	if ( ! empty( $terms ) ) {
		foreach ( $terms as $term ) {
			$term_options[ $term->term_id ] = $term->name;
		}
	}

	return $term_options;
}
