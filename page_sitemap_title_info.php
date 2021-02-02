<?php

/**
 *  ----------------------------------------------------------------------------------
 *  Rijkshuisstijl (Digitale Overheid) - page_sitemap_title_info.php
 *  ----------------------------------------------------------------------------------
 *  Toont de sitemap. Deze sitemap komt bijna overeen met de sitemap die
 *  getoond wordt op de 404-pagina
 *  ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 2.12.2
 * @desc.   Kortere check op uitschrijven nav.bar op home.
 * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 *
 */


//* Template Name: (niet gebruiken: titel-lengte_

//========================================================================================================

//* Force full-width-content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Remove standard post content output
remove_action( 'genesis_post_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

add_action( 'genesis_entry_content', 'paginatitels', 13 );
//add_action( 'genesis_entry_content', 'rhswp_get_sitemap', 15 );

genesis();

function paginatitels() {
	$args = array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
//		'orderby'        => 'name',
//		'order'          => 'ASC',
		'posts_per_page' => - 1,

	);

	$contentblockposts = new WP_query();
	$contentblockposts->query( $args );

	$postcounter          = 0;
	$pagecounter          = 0;
	$lengthcounter        = 0;
	$totalcounter         = 0;
	$grootstelengte       = 0;
	$grootstelengte_titel = '';
	$woordenlijst         = array();

	if ( $contentblockposts->have_posts() ) {

		echo '<h2>Berichten</h2>';
		echo '<table>';
		echo '<tr>';
		echo '<th scope="col">Publicatiedatum</th>';
		echo '<th scope="col">Laatst&nbsp;gewijzigd</th>';
		echo '<th scope="col">Titel</th>';
		echo '<th scope="col">Auteurs</th>';
		echo '<th scope="col">Content-blokken</th>';
		echo '<th scope="col">Gerelateerde links</th>';
		echo '<th scope="col">Check inhoud</th>';
		echo '<th scope="col">Lengte titel</th>';
		echo '<th scope="col">Lengte samenvatting</th>';
		echo '<th scope="col">Heeft uitgelichte afbeelding</th>';
		echo '<th scope="col">afbeelding H </th>';
		echo '<th scope="col">afbeelding W </th>';
		echo '<th scope="col">Automatisch invoegen?</th>';
		echo '<th scope="col">Caroussel</th>';
		echo '<th scope="col">Categorie</th>';
		echo '<th scope="col">Tag</th>';
		echo '<th scope="col">Dossier</th>';
		echo '</tr>';

		while ( $contentblockposts->have_posts() ) : $contentblockposts->the_post();
			$postcounter ++;
			$totalcounter ++;
			echo '<tr>';
			$theid                    = get_the_id();
			$title                    = get_the_title();
			$strlength                = strlen( $title );
			$lengthcounter            = ( $lengthcounter + $strlength );
			$carousselcheck           = get_field( 'carrousel_tonen_op_deze_pagina', $theid );
			$featimg_automatic_insert = get_field( 'featimg_automatic_insert', $theid );
			$contentblokken           = get_field( 'extra_contentblokken', $theid );
			$relatedlinks             = get_field( RHSWP_WIDGET_PAGELINKS_ID . '_widget_links', $theid );
			$excerpt                  = strip_tags( get_the_excerpt( $theid ) );
			$dateformat               = 'd-m-Y'; //get_option( 'date_format' )
			$publicatie_datum         = get_the_date( $dateformat, $theid );
			$wijzigings_datum         = get_the_modified_date( $dateformat, $theid );

			if ( $strlength > $grootstelengte ) {
				$grootstelengte       = $strlength;
				$grootstelengte_titel = $title;
			}

			/*
			$title2   = preg_replace( '/[^a-z ]/', '', strtolower( $title ) );
			$title2   = strtolower( $title2 );
			$woordjes = explode( " ", $title2 );
			foreach ( $woordjes as $woordje ) {
				if ( $woordenlijst[ $woordje ] ) {
					$woordenlijst[ $woordje ] = ( $woordenlijst[ $woordje ] + 1 );
				}
				else {
					$woordenlijst[ $woordje ] = 1;
				}
			}
			*/

			// Publicatiedatum
			echo '<td>' . $publicatie_datum . '</td>';

			// Laatst gewijzigd op
			echo '<td>' . $wijzigings_datum . '</td>';


			echo '<td><a href="' . get_the_permalink() . '">' . $title . '</a></td>';

			// auteur
			echo '<td>' . get_the_author_meta( 'display_name' ) . ' &nbsp;</td>';


			echo '<td>';
			if ( $contentblokken ) {
				$contentblokcheck = 'contentblock:ja';
				echo $contentblokcheck . '<br>';
				echo '<ul>';

				foreach ( $contentblokken as $row ) {

					$thecounter ++;
//					$algemeen_links        = $row['extra_contentblok_algemeen_links'];
//					$select_dossiers_list  = $row['select_dossiers_list'];
//					$selected_content      = $row['select_berichten_paginas'];
//					$selected_content_full = $row['select_berichten_paginas_toon_samenvatting'];
//					$chosen_category       = $row['extra_contentblok_chosen_category'];
//					$titel                 = esc_html( $row['extra_contentblok_title'] );
					$type_block = $row['extra_contentblok_type_block'];
//					$categoriefilter       = $row['extra_contentblok_categoriefilter'];
					$maxnr_posts = $row['extra_contentblok_maxnr_posts'];
//					$with_featured_image   = 'alle';
					$limit = $row['extra_contentblok_maxnr_events'];
					echo '<li>';
					echo 'type contentblock: ' . $type_block;
					if ( $maxnr_posts ) {
						echo ' - $maxnr_posts: ' . $maxnr_posts;
					}
					if ( $limit ) {
						echo ' - $limit (events): ' . $limit;
					}
					echo '</li>';

				}
				echo '</ul>';

			} else {
				$contentblokcheck = 'nee';
				echo $contentblokcheck;
			}
			echo '</td>';

			echo '<td>';
			if ( $relatedlinks ) {
				$relatedlinkcheck = '<p>ja</p>';
				echo $relatedlinkcheck;

				echo '<ul>';
				foreach ( $relatedlinks as $link ) {

					// vars
					$externe_link                = $link['externe_link'];
					$url_extern                  = $link['url_extern'];
					$linktekst_voor_externe_link = $link['linktekst_voor_externe_link'];
					$content                     = '';

					if ( 'ja' == $externe_link && $url_extern ) {
						// externe link dus
						if ( $url_extern ) {
							// TODO
							$content = '<li>EXTERNE LINK <a href="' . $url_extern . '" class="extern">' . $linktekst_voor_externe_link . '</a></li>';
						} else {
							$content = '<li><a href="' . $url_extern . '" class="extern">' . $url_extern . '</a></li>';
						}
					} else {
						// interne link
						// TODO
						$interne_link = $link['interne_link'];
						foreach ( $interne_link as $linkobject ) {
							$content .= '<li>INTERNE LINK  - ' . get_post_type( $linkobject->ID ) . ' <a href="' . get_permalink( $linkobject->ID ) . '">' . $linkobject->post_title . '</a></li>';
						}
					}
					echo $content;
				}
				echo '</ul>';

			} else {
				echo 'nee';
			}
			echo '</td>';

			// Check inhoud
			echo '<td>';
			$post_content = apply_filters( 'the_content', get_the_content() );
			$result       = '';

			if ( preg_match( '/<img.*>/', $post_content ) ) {
				$result .= '<li>Bevat plaatje &lt;img&gt; </pre></li>';
			}
			if ( preg_match( '/style="width:/', $post_content ) ) {
				$result .= '<li>Bevat &lt;style="width:&gt; </pre></li>';
			}
			if ( preg_match( '/<blockquote.*>/', $post_content ) ) {
				$result .= '<li>Bevat citaat (&lt;blockquote&gt;) </pre></li>';
			}
			if ( preg_match( '/class="borderframe.*>/', $post_content ) ) {
				$result .= '<li>Bevat kader (class="borderframe") </pre></li>';
			}
			if ( preg_match( '/<details.*>/', $post_content ) ) {
				$result .= '<li>Bevat uitklapblok (&lt;details&gt;) </pre></li>';
			}
			if ( preg_match( '/<tabel.*>/', $post_content ) ) {
				$result .= '<li>Bevat tabel (&lt;tabel&gt;) </pre></li>';
			}

			if ( $result ) {
				echo '<ul>';
				echo $result;
				echo '</ul>';
			}

			echo '&nbsp;';
			echo '</td>';

			// lengte titel
			echo '<td>' . $strlength . '</td>';

			//$excerpt
			echo '<td>' . strlen( $excerpt ) . '</td>';

			//Heeft uitgelichte afbeelding
			echo '<td>';
			if ( has_post_thumbnail() ) {

				$size   = 'full';
				$meta   = wp_get_attachment_metadata( get_post_thumbnail_id( $theid ) );
				$width  = $meta['width'];
				$height = $meta['height'];

				echo 'Ja';
				echo '</td><td>' . $height;
				echo '</td><td>' . $width;

				echo '</td><td>' . $featimg_automatic_insert;

			} else {
				echo 'Nee';
				echo '</td><td>&nbsp;'; // hoogte
				echo '</td><td>&nbsp;'; // breedte

				// automatisch invoegen
				echo '<td>&nbsp;';
			}
			echo '</td>';


			echo '<td>' . $carousselcheck . '</td>';


			//Categorie
			echo '<td>';
			$terms = get_the_terms( $theid, 'category' );
			$bla   = '';
			if ( $terms ) {
				foreach ( $terms as $category ) {
					echo $bla . $category->name;
					$bla = ', ';
				}
			}
			echo '&nbsp;</td>';

			//Tag
			echo '<td>';
			$terms = get_the_terms( $theid, 'post_tag' );
			$bla   = '';
			if ( $terms ) {
				foreach ( $terms as $category ) {
					echo $bla . $category->name;
					$bla = ', ';
				}
			}
			echo '&nbsp;</td>';

			//Dossier
			echo '<td>';
			$terms = get_the_terms( $theid, RHSWP_CT_DOSSIER );
			$bla   = '';
			if ( $terms ) {
				echo '<ul>';
				foreach ( $terms as $category ) {
					echo '<li>' . $category->name . '</li>';
				}
				echo '</ul>';
			}
			echo '&nbsp;</td>';


			echo '</tr>';
		endwhile;
		echo '</table>';

	}

	/*
	 *
	 * */
	$args = array(
		'post_type'      => 'page',
		'post_status'    => 'publish',
		'orderby'        => 'name',
		'order'          => 'ASC',
		'posts_per_page' => - 1,

	);

	$contentblockposts = new WP_query();
	$contentblockposts->query( $args );

	if ( $contentblockposts->have_posts() ) {

		echo '<h2>Pagina\'s</h2>';
		echo '<table>';
		echo '<tr>';
		echo '<th scope="col">Publicatiedatum</th>';
		echo '<th scope="col">Laatst&nbsp;gewijzigd</th>';
		echo '<th scope="col">Titel</th>';
		echo '<th scope="col">Auteurs</th>';
		echo '<th scope="col">Paginatemplate</th>';
		echo '<th scope="col">Content-blokken</th>';
		echo '<th scope="col">Gerelateerde links</th>';
		echo '<th scope="col">Check inhoud</th>';
		echo '<th scope="col">Lengte titel</th>';
		echo '<th scope="col">Lengte samenvatting</th>';
		echo '<th scope="col">Heeft uitgelichte afbeelding</th>';
		echo '<th scope="col">afbeelding H </th>';
		echo '<th scope="col">afbeelding W </th>';
		echo '<th scope="col">Automatisch invoegen?</th>';
		echo '<th scope="col">Caroussel</th>';
		echo '<th scope="col">Categorie</th>';
		echo '<th scope="col">Tag</th>';
		echo '<th scope="col">Dossier</th>';
		echo '</tr>';

		while ( $contentblockposts->have_posts() ) : $contentblockposts->the_post();
			$pagecounter ++;
			$totalcounter ++;
			echo '<tr>';
			$theid                    = get_the_id();
			$title                    = get_the_title();
			$strlength                = strlen( $title );
			$lengthcounter            = ( $lengthcounter + $strlength );
			$carousselcheck           = get_field( 'carrousel_tonen_op_deze_pagina', $theid );
			$featimg_automatic_insert = get_field( 'featimg_automatic_insert', $theid );
			$contentblokken           = get_field( 'extra_contentblokken', $theid );
			$relatedlinks             = get_field( RHSWP_WIDGET_PAGELINKS_ID . '_widget_links', $theid );
			$excerpt                  = strip_tags( get_the_excerpt( $theid ) );
			$dateformat               = 'd-m-Y'; //get_option( 'date_format' )
			$publicatie_datum         = get_the_date( $dateformat, $theid );
			$wijzigings_datum         = get_the_modified_date( $dateformat, $theid );

			if ( $strlength > $grootstelengte ) {
				$grootstelengte       = $strlength;
				$grootstelengte_titel = $title;
			}

			/*
			$title2   = preg_replace( '/[^a-z ]/', '', strtolower( $title ) );
			$title2   = strtolower( $title2 );
			$woordjes = explode( " ", $title2 );
			foreach ( $woordjes as $woordje ) {
				if ( $woordenlijst[ $woordje ] ) {
					$woordenlijst[ $woordje ] = ( $woordenlijst[ $woordje ] + 1 );
				}
				else {
					$woordenlijst[ $woordje ] = 1;
				}
			}
			*/

			// Publicatiedatum
			echo '<td>' . $publicatie_datum . '</td>';

			// Laatst gewijzigd op
			echo '<td>' . $wijzigings_datum . '</td>';

			// titel
			echo '<td><a href="' . get_the_permalink() . '">' . $title . '</a></td>';

			// auteur
			echo '<td>' . get_the_author_meta( 'display_name' ) . ' &nbsp;</td>';

			// paginatemplate
			$paginatemplate  = basename( get_page_template() );
			echo '<td>' . $paginatemplate . '</td>';


			echo '<td>';
			if ( $contentblokken ) {
				$contentblokcheck = 'contentblock:ja';
				echo $contentblokcheck . '<br>';
				echo '<ul>';

				foreach ( $contentblokken as $row ) {

					$thecounter ++;
//					$algemeen_links        = $row['extra_contentblok_algemeen_links'];
//					$select_dossiers_list  = $row['select_dossiers_list'];
//					$selected_content      = $row['select_berichten_paginas'];
//					$selected_content_full = $row['select_berichten_paginas_toon_samenvatting'];
//					$chosen_category       = $row['extra_contentblok_chosen_category'];
//					$titel                 = esc_html( $row['extra_contentblok_title'] );
					$type_block = $row['extra_contentblok_type_block'];
//					$categoriefilter       = $row['extra_contentblok_categoriefilter'];
					$maxnr_posts = $row['extra_contentblok_maxnr_posts'];
//					$with_featured_image   = 'alle';
					$limit = $row['extra_contentblok_maxnr_events'];
					echo '<li>';
					echo 'type contentblock: ' . $type_block;
					if ( $maxnr_posts ) {
						echo ' - $maxnr_posts: ' . $maxnr_posts;
					}
					if ( $limit ) {
						echo ' - $limit (events): ' . $limit;
					}
					echo '</li>';

				}
				echo '</ul>';

			} else {
				$contentblokcheck = 'nee';
				echo $contentblokcheck;
			}
			echo '</td>';

			echo '<td>';
			if ( $relatedlinks ) {
				$relatedlinkcheck = '<p>ja</p>';
				echo $relatedlinkcheck;

				echo '<ul>';
				foreach ( $relatedlinks as $link ) {

					// vars
					$externe_link                = $link['externe_link'];
					$url_extern                  = $link['url_extern'];
					$linktekst_voor_externe_link = $link['linktekst_voor_externe_link'];
					$content                     = '';

					if ( 'ja' == $externe_link && $url_extern ) {
						// externe link dus
						if ( $url_extern ) {
							// TODO
							$content = '<li>EXTERNE LINK <a href="' . $url_extern . '" class="extern">' . $linktekst_voor_externe_link . '</a></li>';
						} else {
							$content = '<li><a href="' . $url_extern . '" class="extern">' . $url_extern . '</a></li>';
						}
					} else {
						// interne link
						// TODO
						$interne_link = $link['interne_link'];
						foreach ( $interne_link as $linkobject ) {
							$content .= '<li>INTERNE LINK  - ' . get_post_type( $linkobject->ID ) . ' <a href="' . get_permalink( $linkobject->ID ) . '">' . $linkobject->post_title . '</a></li>';
						}
					}
					echo $content;
				}
				echo '</ul>';

			} else {
				echo 'nee';
			}
			echo '</td>';

			// Check inhoud
			echo '<td>';
			$post_content = apply_filters( 'the_content', get_the_content() );
			$result       = '';

			if ( preg_match( '/<img.*>/', $post_content ) ) {
				$result .= '<li>Bevat plaatje &lt;img&gt; </pre></li>';
			}
			if ( preg_match( '/style="width:/', $post_content ) ) {
				$result .= '<li>Bevat &lt;style="width:&gt; </pre></li>';
			}
			if ( preg_match( '/<blockquote.*>/', $post_content ) ) {
				$result .= '<li>Bevat citaat (&lt;blockquote&gt;) </pre></li>';
			}
			if ( preg_match( '/class="borderframe.*>/', $post_content ) ) {
				$result .= '<li>Bevat kader (class="borderframe") </pre></li>';
			}
			if ( preg_match( '/<details.*>/', $post_content ) ) {
				$result .= '<li>Bevat uitklapblok (&lt;details&gt;) </pre></li>';
			}
			if ( preg_match( '/<tabel.*>/', $post_content ) ) {
				$result .= '<li>Bevat tabel (&lt;tabel&gt;) </pre></li>';
			}

			if ( $result ) {
				echo '<ul>';
				echo $result;
				echo '</ul>';
			}

			echo '&nbsp;';
			echo '</td>';

			// lengte titel
			echo '<td>' . $strlength . '</td>';

			//$excerpt
			echo '<td>' . strlen( $excerpt ) . '</td>';

			//Heeft uitgelichte afbeelding
			echo '<td>';
			if ( has_post_thumbnail() ) {

				$size   = 'full';
				$meta   = wp_get_attachment_metadata( get_post_thumbnail_id( $theid ) );
				$width  = $meta['width'];
				$height = $meta['height'];

				echo 'Ja';
				echo '</td><td>' . $height;
				echo '</td><td>' . $width;

				echo '</td><td>' . $featimg_automatic_insert;

			} else {
				echo 'Nee';
				echo '</td><td>&nbsp;'; // hoogte
				echo '</td><td>&nbsp;'; // breedte

				// automatisch invoegen
				echo '<td>&nbsp;';
			}
			echo '</td>';


			echo '<td>' . $carousselcheck . '</td>';


			//Categorie
			echo '<td>';
			$terms = get_the_terms( $theid, 'category' );
			$bla   = '';
			if ( $terms ) {
				foreach ( $terms as $category ) {
					echo $bla . $category->name;
					$bla = ', ';
				}
			}
			echo '&nbsp;</td>';

			//Tag
			echo '<td>';
			$terms = get_the_terms( $theid, 'post_tag' );
			$bla   = '';
			if ( $terms ) {
				foreach ( $terms as $category ) {
					echo $bla . $category->name;
					$bla = ', ';
				}
			}
			echo '&nbsp;</td>';

			//Dossier
			echo '<td>';
			$terms = get_the_terms( $theid, RHSWP_CT_DOSSIER );
			$bla   = '';
			if ( $terms ) {
				echo '<ul>';
				foreach ( $terms as $category ) {
					echo '<li>' . $category->name . '</li>';
				}
				echo '</ul>';
			}
			echo '&nbsp;</td>';


			echo '</tr>';
		endwhile;
		echo '</table>';


	}


	echo '<p>';
	echo $pagecounter . ' paginas<br>';
	echo $postcounter . ' berichten<br>';
	echo $totalcounter . ' totaal<br>';

	echo $grootstelengte . ' is het langste: "' . $grootstelengte_titel . '"<br>';
	echo ' Gemiddeld: ' . round( ( $lengthcounter / $totalcounter ), 1 ) . ' karakters (' . $lengthcounter . ' / ' . $totalcounter . ')';
	echo '</p>';

	/*
	 *
	if ( $woordenlijst ) {
		echo '<h2>Woordjes</h2>';
		echo '<ul>';

		foreach ( $woordenlijst as $key => $value ) {
			echo '<li>' . $key . ' **** ' . strlen( $key ) . ' **** ' . $value . '</li>';
		}

		echo '</ul>';

	}
	 */


	// RESET THE QUERY
	wp_reset_query();

}
