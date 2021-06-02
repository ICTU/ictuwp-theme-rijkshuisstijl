<?php

/**
 *  Rijkshuisstijl (Digitale Overheid) - aux-archives-functions.php
 *  ----------------------------------------------------------------------------------
 *  functies voor opsommingen van berichten
 *  ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */

//========================================================================================================

function rhswp_get_grid_item( $args = array() ) {
	$defaults = array(
		'ID'                 => 0,
		'type'               => 'posts_plain',
		'headerlevel'        => 'h3',
		'itemclass'          => 'griditem griditem--post colspan-1',
		'cssid'              => '',
		'contentblock_title' => '',
		'contentblock_imgid' => '',
		'contentblock_url'   => '',
		'contentblock_label' => '',
		'tagcontainer'       => 'div',
		'datefield'          => true,
		'echo'               => false
	);
	// Parse incoming $args into an array and merge it with $defaults
	$args = wp_parse_args( $args, $defaults );

	if ( ( ! $args['ID'] ) && ( ! $args['contentblock_title'] ) ) {
		return;
	}
	$return             = "\n";
	$itemdate           = get_the_date( get_option( 'date_format' ), $args['ID'] );
	$imgcontainer       = get_the_post_thumbnail( $args['ID'], IMAGESIZE_5x3_SMALL );
	$contentblock_titel = ( $args['contentblock_title'] ) ? $args['contentblock_title'] : get_the_title( $args['ID'] );
	if ( isset( $args['permalink'] ) ) {
		$contentblock_url = $args['permalink'];
	} else {
		$contentblock_url = get_permalink( $args['ID'] );
	}
	$cssid              = '';
	$excerpt            = '';
	$itemtitle          = "";
	$cssclasses         = explode( ' ', $args['itemclass'] );
	$contentblock_label = rhswp_get_sublabel( $args['ID'] );

	if ( WP_DEBUG_SHOWTEXTLENGTH ) {
		// TODO: weghalen tekstlengte
		$contentblock_titel .= ' <span class="tekstlengte"><span>' . strlen( utf8_decode( $contentblock_titel ) ) . '</span></span>';
	}
	if ( $args['cssid'] ) {
		$cssid = ' id="' . $args['cssid'] . '"';
	}
	if ( RHSWP_CPT_DOCUMENT === get_post_type( $args['ID'] ) ) {
		$args['type'] = 'posts_document';
	} elseif ( 'post' != get_post_type( $args['ID'] ) ) {
		$args['type'] = 'posts_manual';
	}

	if ( $args['type'] === 'posts_manual' ) {
		if ( $args['contentblock_imgid'] ) {
			if ( in_array( 'colspan-1', $cssclasses ) ) {
				// voor blokken die 1 kolom breed zijn, gebruiken we een vierkant plaatje
				$imgcontainer = wp_get_attachment_image( $args['contentblock_imgid'], IMAGESIZE_SQUARE_SMALL );
			}
			if ( in_array( 'colspan-2', $cssclasses ) ) {
				// voor blokken die 2 kolommen breed zijn, gebruiken we een 16:9 plaatje
				$imgcontainer = wp_get_attachment_image( $args['contentblock_imgid'], IMAGESIZE_5x3 );
			}
		}

		if ( $contentblock_label ) {
			$itemtitle .= '<div class="label">' . $contentblock_label . '</div>';
		}
		$itemtitle .= '<' . $args['headerlevel'] . '>' . $contentblock_titel . '</' . $args['headerlevel'] . '>';

		$return .= '<' . $args['tagcontainer'] . ' class="' . implode( " ", array_unique( $cssclasses ) ) . '"' . $cssid . '>';

		if ( $imgcontainer ) {
			$return .= '<div class="imgcontainer">';
			$return .= $imgcontainer;
			$return .= '</div>'; // .imgcontainer
		}
		$return .= '<div class="txtcontainer">';
		$return .= '<a href="' . $contentblock_url . '">';
		$return .= '<div class="text">';
		$return .= $itemtitle;
		$return .= '</div>'; // .text
		$return .= '</a>';
		$return .= '</div>'; // .txtcontainer
		$return .= '</' . $args['tagcontainer'] . '>';
	} elseif ( $args['type'] === 'posts_document' ) {

		$file           = get_field( 'rhswp_document_upload', $args['ID'] );
		$number_pages   = get_field( 'rhswp_document_number_pages', $args['ID'] );
		$bestand_of_url = get_field( 'rhswp_document_file_or_url', $args['ID'] );
		if ( isset( $file['subtype'] )) {
			$filetype       = strtoupper( $file['subtype'] );
		}
		$documenttype   = get_the_date( '', $args['ID'] );

		if ( $file ) {
			if ( $filetype ) {
				$documenttype .= DO_SEPARATOR . $filetype;
			}
			if ( $file['filesize'] > 0 ) {
				$documenttype .= ' (' . human_filesize( $file['filesize'] ) . ')';
			}
			if ( $number_pages > 0 ) {
				$documenttype .= DO_SEPARATOR . sprintf( _n( '%s page', "%s pages", $number_pages, 'wp-rijkshuisstijl' ), $number_pages );
			}
		}


		if ( $contentblock_label ) {
			$itemtitle .= '<div class="label">' . $contentblock_label . '</div>';
		}
		$itemtitle .= '<' . $args['headerlevel'] . '><a href="' . $contentblock_url . '">' . $contentblock_titel . '</a></' . $args['headerlevel'] . '>';

		$excerpt .= '<p class="excerpt">';
		$excerpt .= wp_strip_all_tags( get_the_excerpt( $args['ID'] ) );
		if ( WP_DEBUG_SHOWTEXTLENGTH ) {
			// TODO
			$excerpt .= ' <span class="tekstlengte"><span>' . strlen( utf8_decode( wp_strip_all_tags( get_the_excerpt( $args['ID'] ) ) ) ) . '</span></span>';
		}
		$excerpt .= '</p>';

		$meta = '<p class="entry-meta">' . $documenttype . '</p>';

		$return .= '<' . $args['tagcontainer'] . ' class="' . implode( " ", array_unique( $cssclasses ) ) . '"' . $cssid . '>';
		$return .= '<div class="txtcontainer">';
		$return .= '<div class="text">';
		$return .= $itemtitle;
		$return .= $meta;
		$return .= $excerpt;
		$return .= '</div>'; // .text
		$return .= '</div>'; // .txtcontainer
		$return .= '</' . $args['tagcontainer'] . '>';

	} elseif ( $args['type'] === 'posts_featured' ) {
		if ( in_array( 'colspan-1', $cssclasses ) ) {
			// voor blokken die 1 kolom breed zijn, gebruiken we een vierkant plaatje
			$imgcontainer = get_the_post_thumbnail( $args['ID'], IMAGESIZE_SQUARE_SMALL );
		}
		if ( in_array( 'colspan-2', $cssclasses ) ) {
			// voor blokken die 2 kolommen breed zijn, gebruiken we een 16:9 plaatje
			$imgcontainer = get_the_post_thumbnail( $args['ID'], IMAGESIZE_5x3 );
		}

		$cssclasses[] = 'griditem--textoverimage';
		if ( $args['datefield'] ) {
			$cssclasses[] = 'datefield';
		}
		if ( $contentblock_label ) {
			$itemtitle .= '<div class="label">' . $contentblock_label . '</div>';
		}
		$itemtitle .= '<' . $args['headerlevel'] . '>' . $contentblock_titel . '</' . $args['headerlevel'] . '>';
		// het hele blok klikbaar maken
		$return .= '<' . $args['tagcontainer'] . ' class="' . implode( " ", array_unique( $cssclasses ) ) . ' "' . $cssid . '>';
		$return .= '<div class="imgcontainer">';
		$return .= $imgcontainer;
		$return .= '</div>'; // .imgcontainer
		$return .= '<div class="txtcontainer">';
		$return .= '<a href="' . $contentblock_url . '">';
		$return .= '<div class="text">';
		$return .= $itemtitle;
		$return .= '</div>'; // .text
		$return .= '</a>';
		if ( $args['datefield'] ) {
			$return .= '<p class="meta">' . $itemdate . '</p>';
		}
		$return .= '</div>'; // .txtcontainer
		$return .= '</' . $args['tagcontainer'] . '>';
	} else {
		// $args['type'] === 'posts_plain'
		if ( $contentblock_label ) {
			$itemtitle .= '<div class="label">' . $contentblock_label . '</div>';
		}
		$itemtitle .= '<' . $args['headerlevel'] . '><a href="' . $contentblock_url . '">' . $contentblock_titel . '</a></' . $args['headerlevel'] . '>';
		$itemtitle .= '<p class="meta">' . $itemdate . '</p>';
		$excerpt   .= '<p class="excerpt">';
		$excerpt   .= wp_strip_all_tags( get_the_excerpt( $args['ID'] ) );
		if ( WP_DEBUG_SHOWTEXTLENGTH ) {
			// TODO
			$excerpt .= ' <span class="tekstlengte"><span>' . strlen( utf8_decode( wp_strip_all_tags( get_the_excerpt( $args['ID'] ) ) ) ) . '</span></span>';
		}
		$excerpt .= '</p>';


		if ( $imgcontainer && $contentblock_url ) {
			$imgcontainer = '<a tabindex="-1" aria-hidden="true" href="' . $contentblock_url . '">' . rhswp_check_alt_attribute( $imgcontainer, $contentblock_titel ) . '</a>';
		}
		$return .= '<' . $args['tagcontainer'] . ' class="' . implode( " ", array_unique( $cssclasses ) ) . '"' . $cssid . '>';
		$return .= '<div class="imgcontainer">';
		$return .= $imgcontainer;
		$return .= '</div>'; // .imgcontainer
		$return .= '<div class="txtcontainer">';
		$return .= $itemtitle;
		$return .= $excerpt;
		$return .= '</div>'; // .txtcontainer
		$return .= '</' . $args['tagcontainer'] . '>'; // .$args['ID']
	}

	if ( $args['echo'] ) {
		echo $return;
	} else {
		return $return;
	}
}

//========================================================================================================

// voor de actueel-pagina, voeg een titel toe
add_action( 'genesis_loop', 'rhswp_blog_page_add_title', 1 );

function rhswp_blog_page_add_title() {

	if ( is_home() && 'page' == get_option( 'show_on_front' ) ) {

		// dit is de blogpagina met ALLE berichten
		/** Replace the standard loop with our custom loop */
		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'rhswp_archive_loop' );

		// full width layout
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

		global $wp_query;
		$actueelpageid         = get_option( 'page_for_posts' );
		$actueelpagetitle      = rhswp_filter_alternative_title( $actueelpageid, get_the_title( $actueelpageid ) );
		$paging                = '';
		$aantalpaginas         = $wp_query->max_num_pages;
		$paged                 = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$actueelpage_inleiding = get_field( 'actueel_inleiding', $actueelpageid );
		if ( $paged > 1 ) {
			$paging = ' Pagina ' . $paged . ' van ' . $aantalpaginas . '.';
		}
		echo '<header class="entry-header"><h1 class="entry-title" itemprop="headline">' . $actueelpagetitle . '</h1> </header>';
		if ( $actueelpage_inleiding ) {
			echo '<p>' . $actueelpage_inleiding . '</p>';
		}

		if ( $paged === 1 ) {

			// alleen op de eerste pagina van de blog page tonen we eerst een aantal berichten uit de
			// uitgelichte categorie

			if ( get_field( 'actueel_rows', $actueelpageid ) ) {

				// Loop through rows.
				while ( have_rows( 'actueel_rows', $actueelpageid ) ) : the_row();

					$actueel_row_category = get_sub_field( 'actueel_row_category' );
					$actueel_row_number   = get_sub_field( 'actueel_row_number' );
					$actueel_row_styling  = get_sub_field( 'actueel_row_styling' );
					$more_text            = get_sub_field( 'actueel_row_readmore' );

					if ( ! is_numeric( $actueel_row_number ) ) {
						$actueel_row_number = 3;
					}
					if ( $actueel_row_category ) {

						$args                       = array(
							'post_type'      => 'post',
							'post_status'    => 'publish',
							'posts_per_page' => $actueel_row_number,
							'tax_query'      => array(
								array(
									'taxonomy' => 'category',
									'field'    => 'term_id',
									'terms'    => $actueel_row_category,
								)
							),
						);
						$actueel_row_category_posts = new WP_query();
						$actueel_row_category_posts->query( $args );
						if ( $actueel_row_category_posts->have_posts() ) {
							$postcounter = 0;
							$cat_name    = get_cat_name( $actueel_row_category );
							$more_url    = get_category_link( $actueel_row_category );
							if ( ! $more_text ) {
								$more_text = _x( "Alle berichten onder %s", 'readmore home', 'wp-rijkshuisstijl' );
							}
							if ( strpos( $more_text, '%s' ) ) {
								$more_text = sprintf( $more_text, strtolower( $cat_name ) );
							}
							echo '<h2>' . $cat_name . '</h2>';
							echo '<div class="grid itemcount-' . $actueel_row_number . '">';
							while ( $actueel_row_category_posts->have_posts() ) : $actueel_row_category_posts->the_post();
								$postcounter ++;
								$contentblock_post_id = get_the_ID();
								$args2                = array(
									'ID' => $contentblock_post_id,
								);

								if ( 'actueel_row_styling_title_on_image' === $actueel_row_styling ) {
									$args2['type'] = 'posts_featured';
								} else {
//									$args2['type'] = 'posts_plain';
								}
								echo rhswp_get_grid_item( $args2 );
							endwhile;
							echo '</div>'; // .grid
							echo '<p class="more"><a href="' . $more_url . '">' . $more_text . '</a></p>';
						}
						// RESET THE QUERY
						wp_reset_query();

						// geen paginering
						remove_action( 'genesis_after_loop', 'genesis_posts_nav' );
//				add_action( 'genesis_after_loop', 'genesis_posts_nav', 3 );
					}


					// End loop.
				endwhile;

				// op de eerste pagina van de page_for_posts dus geen andere berichten meer tonen
				remove_action( 'genesis_loop', 'rhswp_archive_loop' );

			} else {

				// geen aparte categorie geselecteerd, dus wel paginering tonen
				add_action( 'genesis_after_loop', 'genesis_posts_nav', 3 );

			}


		} else {
			// post navigation verplaatsen tot buiten de flex-ruimte
			add_action( 'genesis_after_loop', 'genesis_posts_nav', 3 );
		}
	}
}

//========================================================================================================

add_action( 'pre_get_posts', 'rhswp_modify_query_for_page_for_posts' );
/**
 * Voor de blog-pagina ( is_home() / 'page_for_posts ) willen we dat de eerste pagina ('paged' = 1) alleen de
 * geselecteerde categorieen toont
 *
 * @param object $query data
 *
 */
function rhswp_modify_query_for_page_for_posts( $query ) {

	if ( $query->is_main_query() && ! is_admin() ) {

		if ( $query->is_search() ) {
			// voor standaard (i.e. non-searchwp) zoekopdrachten, voeg events en documenten als
			// doorzoekbare objecten toe
			$query->set( 'post_type', array( 'post', RHSWP_CPT_EVENT, RHSWP_CPT_DOCUMENT, 'page' ) );
		} elseif ( is_home() && 'page' == get_option( 'show_on_front' ) ) {

			//* Force full-width-content layout
			add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

			return $query;
		}
	}
}

//========================================================================================================

/** Code for custom loop */

function rhswp_archive_loop() {
	// code for a completely custom loop
	global $post;
	if ( have_posts() ) {
		echo '<div class="grid archive-custom-loop">';
		$postcounter = 0;
		while ( have_posts() ) : the_post();
			$postcounter ++;
			$current_post_id = isset( $post->ID ) ? $post->ID : 0;
			$args2           = array(
				'ID'        => $current_post_id,
				'itemclass' => 'griditem griditem--post colspan-1 ' . get_post_type( $post->ID ),
				'type'      => 'posts_normal'
			);
			echo rhswp_get_grid_item( $args2 );

			do_action( 'genesis_after_entry' );
		endwhile;
		echo '</div>';
		wp_reset_query();
	}
}

//========================================================================================================

/** Code for custom loop */


/** Code for custom loop */

function rhswp_archive_custom_loop() {
	// code for a completely custom loop
	global $post;
	if ( have_posts() ) {
		echo '<div class="block no-top archive-custom-loop">';
		$postcounter = 0;
		while ( have_posts() ) : the_post();
			$postcounter ++;
			$excerpt         = wp_strip_all_tags( get_the_excerpt( $post ) );
			$classattr       = genesis_attr( 'entry' );
			$contenttype     = get_post_type();
			$current_post_id = isset( $post->ID ) ? $post->ID : 0;
			$documenttype    = rhswp_translateposttypes( $contenttype );
			$toonitem        = true;
			$permalink       = get_permalink();

			if ( is_tax( RHSWP_CT_DOSSIER ) ) {
				$pagetemplateslug = basename( get_page_template_slug( $current_post_id ) );
				$selectposttype   = '';
				$checkpostcount   = false;
				$currentID        = get_queried_object()->term_id;
				$term             = get_term( $currentID, RHSWP_CT_DOSSIER );
				if ( 'page_dossiersingleactueel.php' == $pagetemplateslug ) {
					$selectposttype = 'post';
					$checkpostcount = true;
				} elseif ( 'page_dossier-document-overview.php' == $pagetemplateslug ) {
					$selectposttype = RHSWP_CPT_DOCUMENT;
					$checkpostcount = true;
				} elseif ( 'page_dossier-events-overview.php' == $pagetemplateslug ) {
					$selectposttype = RHSWP_CPT_EVENT;
					$checkpostcount = true;
				}
				// is deze pagina al de overzichtspagina?
				if ( function_exists( 'get_field' ) ) {
					$dossier_overzichtpagina = get_field( 'dossier_overzichtpagina', $term );
					if ( $dossier_overzichtpagina->ID == $current_post_id ) {
						$checkpostcount = false;
						$toonitem       = false;
					}
				}
				// IS GEPUBLICEERD?
				if ( get_post_status( $post->ID ) != 'publish' ) {
					$toonitem = false;
				}
				if ( 'page_dossiersingleactueel.php' == $pagetemplateslug ) {
					$toonitem = false;
				}
				if ( $selectposttype && $checkpostcount ) {
					$argsquery = array(
						'post_type' => $selectposttype,
						'tax_query' => array(
							'relation' => 'AND',
							array(
								'taxonomy' => RHSWP_CT_DOSSIER,
								'field'    => 'term_id',
								'terms'    => $term->term_id
							)
						)
					);
					$wp_query  = new WP_Query( $argsquery );
					if ( $wp_query->have_posts() ) {
						if ( $wp_query->post_count > 0 ) {
						} else {
							$toonitem = false;
						}
					} else {
						$toonitem = false;
					}
					// RESET THE QUERY
					wp_reset_query();
				}
			}
			if ( $toonitem ) {

				if ( 'page' == $contenttype ) {
					$documenttype = '';
				} elseif ( RHSWP_CPT_DOCUMENT == $contenttype ) {
					$file           = get_field( 'rhswp_document_upload', get_the_id() );
					$number_pages   = get_field( 'rhswp_document_number_pages', get_the_id() );
					$bestand_of_url = get_field( 'rhswp_document_file_or_url', get_the_id() );
					$filetype       = strtoupper( $file['subtype'] );
					$documenttype   = '(' . $bestand_of_url . ')';

					if ( 'URL' == $bestand_of_url ) {
						$permalink = get_field( 'rhswp_document_url', get_the_id() );

					} elseif ( $file ) {
						$permalink = $file['url'];

						if ( $filetype ) {
							$documenttype = $filetype;
						}
						if ( $file['filesize'] > 0 ) {
							$documenttype .= ' (' . human_filesize( $file['filesize'] ) . ')';
						}
						if ( $number_pages > 0 ) {
							$documenttype .= DO_SEPARATOR . sprintf( _n( '%s page', "%s pages", $number_pages, 'wp-rijkshuisstijl' ), $number_pages );
						}
					}

				} elseif ( 'post' == $contenttype ) {
					$categories = get_the_category( get_the_id() );
					if ( ! empty( $categories ) ) {
						// show the categories / category
						$documenttype = esc_html( $categories[0]->name );
					} else {
						// leave the translated post type
					}
					$documenttype .= ' - <span class="post-date">' . get_the_date() . '</span>';
				}
				if ( ! ( 'page' == get_post_type( $post->ID ) ) ) {
					$thetitle = get_the_title( get_the_id() );
				} else {
					$thetitle = rhswp_filter_alternative_title( get_the_id(), get_the_title( get_the_id() ) );
				}

				// geen plaatjes hier uberhaupt dus class mag weg
				$classattr = str_replace( 'has-post-thumbnail', '', $classattr );

				if ( $documenttype ) {
					$documenttype = '<p class="meta">' . $documenttype . '</p>';
				}
				printf( '<article %s>', $classattr );
				printf( '<h2><a href="%s">%s</a></h2>%s<p>%s</p>', $permalink, $thetitle, $documenttype, wp_strip_all_tags( $excerpt ) );
				echo '</article>';


			}
			do_action( 'genesis_after_entry' );
		endwhile;
		echo '</div>';
		wp_reset_query();
	}
}


//========================================================================================================
/*
functie om te checken dat een image die gebruikt wordt in een linke daadwerkelijk een gevuld alt-attribuut heeft
zodat de link een linktekst heeft
*/
function rhswp_check_alt_attribute( $imagetag, $title ) {
	global $post;
	if ( ! $imagetag ) {
		return;
	}
	if ( ! $title ) {
		return;
	}

	if ( preg_match( '|alt=""|', $imagetag ) ) {
		// alt-attribuut is dus leeg
		// we vullen het met de titel
		$alt_attr = sprintf( 'alt="Link naar %s"', wp_strip_all_tags( $title ) );
		$imagetag = preg_replace( '|alt=""|', $alt_attr, $imagetag );
	}

	return $imagetag;

}

//========================================================================================================

function rhswp_post_laatstgewijzigd( $atts ) {
	global $post;
	$publicatie_datum = get_the_date( get_option( 'date_format' ), $post->ID );
	$wijzigings_datum = get_the_modified_date( get_option( 'date_format' ), $post->ID );

	return 'publicatie: ' . esc_html( $publicatie_datum ) . ' - laatst gewijzigd: ' . $wijzigings_datum;

}

add_shortcode( 'post_laatstgewijzigd', 'rhswp_post_laatstgewijzigd' );

//========================================================================================================
