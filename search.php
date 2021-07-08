<?php


/**
 * // Rijkshuisstijl (Digitale Overheid) - page_search.php
 * // ----------------------------------------------------------------------------------
 * // Zoekresultaatpagina
 * // ----------------------------------------------------------------------------------
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 2.12.14
 * @desc.   Zoekformulier kan verborgen worden in de site-instellingen.
 * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */

//========================================================================================================

//* Force full-width-content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

if ( class_exists( 'SearchWP' ) ) {

	/** Replace the standard loop with our custom loop */
	remove_action( 'genesis_loop', 'genesis_do_loop' );
	add_action( 'genesis_after_header', 'rhswp_archive_custom_search_with_searchWP', 20 );

} else {

	// add description
	add_action( 'genesis_after_header', 'rhswp_add_search_description_without_searchwp', 20 );

	/** Replace the standard loop with our custom loop */
	remove_action( 'genesis_loop', 'genesis_do_loop' );
	add_action( 'genesis_loop', 'rhswp_archive_custom_loop' );

	// post navigation verplaatsen tot buiten de flex-ruimte
	add_action( 'genesis_after_loop', 'genesis_posts_nav', 3 );

}


genesis();

//========================================================================================================

function rhswp_add_search_description() {


}

//========================================================================================================

function rhswp_add_search_description_without_searchwp() {

	$search_text = get_search_query() ? apply_filters( 'the_search_query', get_search_query() ) : apply_filters( 'genesis_search_text', _x( 'Search this site', 'searchform', 'wp-rijkshuisstijl' ) . ' &#x02026;' );

	echo '<div class="header">';
	echo '<h1>' . _x( "Search result for ", 'breadcrumb', 'wp-rijkshuisstijl' ) . ' "' . $search_text . '"</h1>';

	dodebug_do( ' searchWP plugin wordt niet gebruikt ' );

	get_search_form();

	echo '</div>'; // .header
}

//========================================================================================================

/** Code for custom loop */
function rhswp_archive_custom_search_with_searchWP() {

	// code for a completely custom loop
	global $post;
	$query = isset( $_GET['s'] ) ? sanitize_text_field( $_GET['s'] ) : '';
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$page  = isset( $_GET['swppage'] ) ? absint( $_GET['swppage'] ) : $paged;

	$search_text = get_search_query() ? apply_filters( 'the_search_query', get_search_query() ) : apply_filters( 'genesis_search_text', _x( 'Search this site', 'searchform', 'wp-rijkshuisstijl' ) . ' &#x02026;' );


	echo '<main class="content">';
	echo '<div class="header">';
	echo '<h1>' . _x( "Search result for ", 'breadcrumb', 'wp-rijkshuisstijl' ) . ' "<span class="wordbreak">' . $search_text . '</span>"</h1>';

	if ( ! empty( $query ) ) :

		$engine                 = SearchWP::instance();     // instatiate SearchWP
		$supplementalEngineName = 'supplemental';            // search engine name
		// perform the search
		$posts = $engine->search( $supplementalEngineName, $query, $page );

		if ( ! empty( $posts ) ) :

			$title = sprintf( _n( '%s result', '%s results', count( $posts ), 'wp-rijkshuisstijl' ), number_format_i18n( count( $posts ) ) );

			echo '<p>' . $title . '</p>';

			get_search_form();
			echo '</div>'; // .header

			echo '<div class="block no-top">';

			foreach ( $posts as $post ) :

				$excerpt      = get_the_excerpt( $post );
				$theid        = get_the_id();
				$classattr    = genesis_attr( 'entry' );
				$classattr    = str_replace( 'has-post-thumbnail', '', $classattr );
				$contenttype  = get_post_type();
				$theurl       = get_permalink();
				$thetitle     = rhswp_filter_alternative_title( $theid, get_the_title() );
				$documenttype = rhswp_translateposttypes( $contenttype );


				if ( 'post' == $contenttype ) {

					$documenttype    = '';
					$counter         = 0;
					$post_categories = wp_get_post_categories( $theid );
					foreach ( $post_categories as $category ) {
						$counter ++;
						$catinfo = get_category( $category );
						if ( $counter > 1 ) {
							$documenttype .= ', ';
						}
						$documenttype .= $catinfo->name;
					}

				} elseif ( RHSWP_CPT_DOCUMENT == $contenttype ) {

					$file           = get_field( 'rhswp_document_upload', $theid );
					$number_pages   = get_field( 'rhswp_document_number_pages', $theid );
					$bestand_of_url = get_field( 'rhswp_document_file_or_url', $theid );
					$documenttype   = get_the_date( '', $theid );

					if ( $bestand_of_url === 'URL' ) {
						$rhswp_document_url = get_field( 'rhswp_document_url', $theid );
						if ( $rhswp_document_url ) {
							$theurl = $rhswp_document_url;
						}
					} else {
						$filetype = strtoupper( $file['subtype'] );

						if ( $file ) {
							if ( $filetype ) {
								$documenttype .= DO_SEPARATOR . $filetype;
							}
							if ( $file['url'] ) {
								$theurl = $file['url'];
							}
							if ( $file['filesize'] > 0 ) {
								$documenttype .= ' (' . human_filesize( $file['filesize'] ) . ')';
							}
							if ( $number_pages > 0 ) {
								$documenttype .= DO_SEPARATOR . sprintf( _n( '%s page', "%s pages", $number_pages, 'wp-rijkshuisstijl' ), $number_pages );
							}
						}
					}


				} elseif ( 'producten' == $contenttype ) {
					// to do: check op link naar planningspagina

					$documenttype = 'Releasekalender';

					$hoofdpagina = intval( get_option( 'rijksreleasekalender_hoofdpagina' ) );

					if ( is_int( $hoofdpagina ) && $hoofdpagina > 0 ) {
					} else {
						$hoofdpagina = 73;
					}

					$voorzieningslug = get_post_meta( $theid, 'product_voorziening_real_id_slug', true );

					$theurl = get_the_permalink( $hoofdpagina ) . 'voorziening/' . $voorzieningslug . '/product/' . $post->post_name . '/';


				} elseif ( 'attachment' == $contenttype ) {

					$theurl    = wp_get_attachment_url( $post->ID );
					$parent_id = $post->post_parent;
					$excerpt   = get_the_excerpt( $parent_id );


					$mimetype = get_post_mime_type( $post->ID );
					$thetitle = get_the_title( $parent_id );

					$filesize = filesize( get_attached_file( $post->ID ) );

					if ( $mimetype ) {
						$typeclass = explode( '/', $mimetype );

						$classattr = str_replace( 'class="', 'class="attachment ' . $typeclass[1] . ' ', $classattr );

						if ( $filesize ) {
							$documenttype = rhswp_translatemimetypes( $mimetype ) . ' (' . human_filesize( $filesize ) . ')';
						} else {
							$documenttype = rhswp_translatemimetypes( $mimetype );
						}
					}
				}

				if ( $post instanceof SearchWPTermResult ) :

					$classattr = str_replace( 'class="', 'class="taxonomy ' . $post->term->taxonomy . ' ', $classattr );

					$theurl       = $post->link;
					$thetitle     = $post->name;
					$excerpt      = $post->description;
					$documenttype = $post->taxonomy;

				else : setup_postdata( $post );

					if ( 'post' == $contenttype ) {
						$documenttype .= '<span class="post-date">' . get_the_date() . '</span>';
					}

				endif;

				printf( '<article %s>', $classattr );
				printf( '<h2><a href="%s">%s</a></h2><p class="meta">%s</p><p>%s</p>', $theurl, $thetitle, $documenttype, wp_strip_all_tags( $excerpt ) );
				echo '</article>';

			endforeach;

			echo '</div>'; // .block

			wp_reset_postdata();

			genesis_posts_nav();


		else:

			echo '<h2>' . _x( 'Sorry', 'Title, no results text', 'wp-rijkshuisstijl' ) . '</h2>';
			echo '<p>';
			echo sprintf( _x( 'No results for %s.', 'No results text', 'wp-rijkshuisstijl' ), $query );
			echo '</p>';

			get_search_form();
			echo '</div>'; // .header

			echo '<div class="block no-top">';

			if ( is_active_sidebar( RHSWP_NORESULT_WIDGET_AREA ) ) {

				dynamic_sidebar( RHSWP_NORESULT_WIDGET_AREA );

			}


			echo '</div>'; // .block

		endif;

	endif;
	echo '</main>'; // .block

}

//========================================================================================================

