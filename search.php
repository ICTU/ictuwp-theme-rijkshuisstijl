<?php


/**
// Rijkshuisstijl (Digitale Overheid) - page_search.php
// ----------------------------------------------------------------------------------
// Zoekresultaatpagina
// ----------------------------------------------------------------------------------
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 2.12.4
// * @desc.   search widgetruimte toegevoegd aan no-results.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */

//========================================================================================================

// Reposition the primary navigation menu
if ( ( is_front_page() ) || ( is_home() ) ) {
	add_action( 'genesis_after_header', 'genesis_do_nav' );
}

//========================================================================================================

//* Force full-width-content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

if (class_exists('SearchWP')) {

	// add description
	add_action( 'genesis_before_loop', 'rhswp_add_search_description', 15 );
	
	/** Replace the standard loop with our custom loop */
	remove_action( 'genesis_loop', 'genesis_do_loop' );
	add_action( 'genesis_loop', 'rhswp_archive_custom_search_with_searchWP' );

}
else {

	// add description
	add_action( 'genesis_before_loop', 'rhswp_add_search_description_without_searchwp', 15 );
	
	/** Replace the standard loop with our custom loop */
	remove_action( 'genesis_loop', 'genesis_do_loop' );
	add_action( 'genesis_loop', 'rhswp_archive_custom_loop' );
	
}



genesis();


//========================================================================================================

function rhswp_add_search_description() {
	
	$search_text = get_search_query() ? apply_filters( 'the_search_query', get_search_query() ) : apply_filters( 'genesis_search_text', _x( 'Search this site', 'searchform', 'wp-rijkshuisstijl' ) . ' &#x02026;' );
	
	echo '<h1>' . _x( "Search result for ", 'breadcrumb', 'wp-rijkshuisstijl' ) . ' "<span class="wordbreak">' . $search_text . '</span>"</h1>';

}

//========================================================================================================

function rhswp_add_search_description_without_searchwp() {

	$search_text = get_search_query() ? apply_filters( 'the_search_query', get_search_query() ) : apply_filters( 'genesis_search_text', _x( 'Search this site', 'searchform', 'wp-rijkshuisstijl' ) . ' &#x02026;' );
	  
	echo '<h1>' . _x( "Search result for ", 'breadcrumb', 'wp-rijkshuisstijl' ) . ' "' . $search_text . '"</h1>';
	
	dodebug_do( ' searchWP plugin wordt niet gebruikt ' );

	get_search_form();
	  
}

//========================================================================================================

/** Code for custom loop */
function rhswp_archive_custom_search_with_searchWP() {

	// code for a completely custom loop
	global $post;
	$query  = isset( $_GET['s'] ) ? sanitize_text_field( $_GET['s'] ) : '';
	$paged  = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	$page   = isset( $_GET['swppage'] ) ? absint( $_GET['swppage'] ) : $paged;

	if( !empty( $query ) ) :
		
		$engine                 = SearchWP::instance();     // instatiate SearchWP
		$supplementalEngineName = 'supplemental'; 	        // search engine name
		// perform the search
		$posts = $engine->search( $supplementalEngineName, $query, $page );
		
		if( !empty( $posts ) ) : 

			$title  = sprintf( _n( '%s result', '%s results', count( $posts ), 'wp-rijkshuisstijl' ), number_format_i18n( count( $posts ) ) );      
			
			echo '<p>' . $title  . '</p>';		
			
			get_search_form();

			echo '<div class="block">';
			
			foreach( $posts as $post ) : 
			
				$permalink    = get_permalink();
				$excerpt      = wp_strip_all_tags( get_the_excerpt( $post ) );
				$postdate     = get_the_date( );
				$doimage      = false;
				$classattr    = genesis_attr( 'entry' );
				$classattr    = str_replace( 'has-post-thumbnail', '', $classattr );
				$contenttype  = get_post_type();
				$theurl       = get_permalink();
				$thetitle     = rhswp_filter_alternative_title( get_the_id(), get_the_title() );
				$documenttype = rhswp_translateposttypes( $contenttype );
				
				if ( 'voorzieningencpt' == $contenttype ) {
					// to do: check op link naar planningspagina
					
					$documenttype = 'Releasekalender';
					
					$hoofdpagina = intval( get_option( 'rijksreleasekalender_hoofdpagina' ) );
					if ( is_int( $hoofdpagina ) && $hoofdpagina > 0 ) {
					}
					else {
						$hoofdpagina = 73;
					}
					
					$theurl   = get_the_permalink( $hoofdpagina ) . 'voorziening/' . $post->post_name . '/';
	
				}
				elseif ( 'producten' == $contenttype ) {
					// to do: check op link naar planningspagina
					
					$documenttype = 'Releasekalender';
					
					$hoofdpagina = intval( get_option( 'rijksreleasekalender_hoofdpagina' ) );
					
					if ( is_int( $hoofdpagina ) && $hoofdpagina > 0 ) {
					}
					else {
						$hoofdpagina = 73;
					}
					
					$voorzieningslug   = get_post_meta( get_the_ID(), 'product_voorziening_real_id_slug', true );    
					
					$theurl   = get_the_permalink( $hoofdpagina ) . 'voorziening/' . $voorzieningslug . '/product/' . $post->post_name . '/';
				
				
				}
				elseif ( 'attachment' == $contenttype ) {
					
					$theurl       = wp_get_attachment_url( $post->ID );
					$parent_id    = $post->post_parent;
					$excerpt      = wp_strip_all_tags( get_the_excerpt( $parent_id ) );
					
					
					$mimetype     = get_post_mime_type( $post->ID ); 
					$thetitle     = get_the_title( $parent_id );
					
					$filesize     = filesize( get_attached_file( $post->ID ) );
					
					if ( $mimetype ) {
						$typeclass = explode('/', $mimetype);
						
						$classattr = str_replace( 'class="', 'class="attachment ' . $typeclass[1] . ' ', $classattr );
						
						if ( $filesize ) {
							$documenttype = rhswp_translatemimetypes( $mimetype ) . ' (' . human_filesize($filesize) . ')';
						}
						else {
							$documenttype = rhswp_translatemimetypes( $mimetype );
						}
					}
				}
				
				if( $post instanceof SearchWPTermResult ) :
				
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
		
				$excerpt  =  wp_strip_all_tags( $excerpt );
				printf( '<article %s>', $classattr );
				printf( '<a href="%s"><h2>%s</h2><p>%s</p><p class="meta">%s</p></a>', $theurl, $thetitle, $excerpt, $documenttype );
				echo '</article>';
		
			endforeach; 
			
			echo '</div>';
			
			wp_reset_postdata();
			
			genesis_posts_nav();
		
		
		else:
		
			echo '<h2>' . _x( 'Sorry', 'Title, no results text', 'wp-rijkshuisstijl' ) . '</h2>';
			echo '<p>';
			echo sprintf( _x( 'No results for %s.', 'No results text', 'wp-rijkshuisstijl' ), $query );
			
			if ( is_active_sidebar( RHSWP_NORESULT_WIDGET_AREA ) ) {
			
				dynamic_sidebar( RHSWP_NORESULT_WIDGET_AREA );
			
			}

			echo '</p>';
		
		endif; 
		
	endif; 
	
}

//========================================================================================================

