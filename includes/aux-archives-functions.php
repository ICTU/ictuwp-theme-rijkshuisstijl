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
		'type'               => 'posts_featured',
		'headerlevel'        => 'h3',
		'itemclass'          => 'griditem griditem--post colspan-1',
		'cssid'              => '',
		'contentblock_title' => '',
		'contentblock_imgid' => '',
		'contentblock_url'   => '',
		'contentblock_label' => '',
		'tagcontainer'       => 'div',
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
	$contentblock_url   = get_permalink( $args['ID'] );
	$cssid              = '';
	$excerpt            = '';
	$itemtitle          = "";
	$cssclasses         = explode( ' ', $args['itemclass'] );
	$contentblock_label = rhswp_get_sublabel( $args['ID'] );
	$contentblock_titel .= ' <span class="titellengte"><span>' . strlen( $contentblock_titel ) . '</span></span>';
	if ( $args['cssid'] ) {
		$cssid = ' id="' . $args['cssid'] . '"';
	}

	if ( $args['type'] === 'posts_manual' ) {
		if ( in_array( 'colspan-1', $cssclasses ) ) {
			// voor blokken die 1 kolom breed zijn, gebruiken we een vierkant plaatje
			$imgcontainer = wp_get_attachment_image( $args['contentblock_imgid'], IMAGESIZE_SQUARE_SMALL );
		}
		if ( in_array( 'colspan-2', $cssclasses ) ) {
			// voor blokken die 2 kolommen breed zijn, gebruiken we een 16:9 plaatje
			$imgcontainer = wp_get_attachment_image( $args['contentblock_imgid'], IMAGESIZE_5x3 );
		}
		if ( $contentblock_label ) {
			$itemtitle .= '<div class="label">' . $contentblock_label . '</div>';
		}
		$itemtitle .= '<' . $args['headerlevel'] . '>' . $contentblock_titel . '</' . $args['headerlevel'] . '>';

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
		$cssclasses[] = 'datefield';
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
		$return .= '<p class="meta">' . $itemdate . '</p>';
		$return .= '</div>'; // .txtcontainer
		$return .= '</' . $args['tagcontainer'] . '>';
	} else {
		if ( $contentblock_label ) {
			$itemtitle .= '<div class="label">' . $contentblock_label . '</div>';
		}
		$itemtitle .= '<' . $args['headerlevel'] . '><a href="' . $contentblock_url . '">' . $contentblock_titel . '</a></' . $args['headerlevel'] . '>';
		$itemtitle .= '<p class="meta">' . $itemdate . '</p>';
		$excerpt   .= '<p class="excerpt">' . wp_strip_all_tags( get_the_excerpt( $args['ID'] ) ) . '</p>';
		if ( $imgcontainer && $contentblock_url ) {
			$imgcontainer = '<a tabindex="-1" href="' . $contentblock_url . '">' . $imgcontainer . '</a>';
		}
		$return .= '<' . $args['tagcontainer'] . ' class="' . implode( " ", array_unique( $cssclasses ) ) . ' "' . $cssid . '>';
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

		global $wp_query;
		$actueelpageid    = get_option( 'page_for_posts' );
		$actueelpagetitle = rhswp_filter_alternative_title( $actueelpageid, get_the_title( $actueelpageid ) );
		$paging           = '';
		$aantalpaginas    = $wp_query->max_num_pages;
		$paged            = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$actueelpageid    = get_option( 'page_for_posts' );
		if ( $paged > 1 ) {
			$paging = ' Pagina ' . $paged . ' van ' . $aantalpaginas . '.';
		}
		echo '<header class="entry-header"><h1 class="entry-title" itemprop="headline">' . $actueelpagetitle . '</h1> </header>';
		echo '<p>' . _x( 'All posts related to the Digital Governement.', 'Tekst op de actueelpagina', 'wp-rijkshuisstijl' ) . $paging . '</p>';
		if ( $paged === 1 ) {
			// alleen op de eerste pagina van de blog page tonen we eerst een aantal berichten uit de
			// uitgelichte categorie
			$styling_categorie       = get_field( 'styling_categorie', $actueelpageid ); // haal de bijzondere categorieen op die niet op deze pagina getoond moeten worden
			$styling_categorie_maxnr = get_field( 'styling_categorie_maxnr', $actueelpageid );
			if ( ! $styling_categorie_maxnr ) {
				$styling_categorie_maxnr = 3;
			}
			if ( $styling_categorie ) {
				foreach ( $styling_categorie as $styling_category ) {
					$args                    = array(
						'post_type'      => 'post',
						'post_status'    => 'publish',
						'posts_per_page' => $styling_categorie_maxnr,
						'tax_query'      => array(
							array(
								'taxonomy' => 'category',
								'field'    => 'term_id',
								'terms'    => $styling_category,
							)
						),
					);
					$styling_categorie_posts = new WP_query();
					$styling_categorie_posts->query( $args );
					if ( $styling_categorie_posts->have_posts() ) {
						$cat_name  = get_cat_name( $styling_category );
						$more_text = _x( "Alle berichten onder %s", 'readmore home', 'wp-rijkshuisstijl' );
						$more_url  = get_category_link( $styling_category );
						if ( strpos( $more_text, '%s' ) ) {
							$more_text = sprintf( $more_text, strtolower( $cat_name ) );
						}
						echo '<h2>' . $cat_name . '</h2>';
						echo '<div class="grid">';
						while ( $styling_categorie_posts->have_posts() ) : $styling_categorie_posts->the_post();
							$postcounter ++;
							$contentblock_post_id = get_the_ID();
							$args2                = array(
								'ID'   => $contentblock_post_id,
								'type' => 'posts_featured',
							);
							echo rhswp_get_grid_item( $args2 );
						endwhile;
						echo '</div>'; // .grid
						echo '<p class="more"><a href="' . $more_url . '">' . $more_text . '</a></p>';
					}
					// RESET THE QUERY
					wp_reset_query();
				}
			}
		}
		/** Replace the standard loop with our custom loop */
		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'rhswp_archive_loop' );
		// post navigation verplaatsen tot buiten de flex-ruimte
		add_action( 'genesis_after_loop', 'genesis_posts_nav', 3 );
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
			$args2 = array(
				'ID'        => $current_post_id,
				'itemclass' => 'griditem griditem--post colspan-1',
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

function rhswp_archive_custom_loop() {
	// code for a completely custom loop
	global $post;
	if ( have_posts() ) {
		echo '<div class="block no-top archive-custom-loop">';
		$postcounter = 0;
		while ( have_posts() ) : the_post();
			$postcounter ++;
			$permalink         = get_permalink();
			$excerpt           = wp_strip_all_tags( get_the_excerpt( $post ) );
			$postdate          = get_the_date();
			$doimage           = false;
			$classattr         = genesis_attr( 'entry' );
			$contenttype       = get_post_type();
			$current_post_id   = isset( $post->ID ) ? $post->ID : 0;
			$cssid             = 'image_featured_image_post_' . $current_post_id;
			$labelledbytitleid = sanitize_title( 'title_' . $contenttype . '_' . $current_post_id );
			$labelledby        = ' aria-labelledby="' . $labelledbytitleid . '"';
//			if ( $postcounter <= RHSWP_NR_FEAT_IMAGES && has_post_thumbnail( $post->ID ) ) {
			if ( has_post_thumbnail( $post->ID ) ) {
				$doimage = true;
			} else {
//				$classattr = str_replace( 'has-post-thumbnail', '', $classattr );
			}
			$toonitem = true;
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
				if ( is_search() || is_post_type_archive( RHSWP_CPT_DOCUMENT ) ) {
					$theurl       = get_permalink();
					$thetitle     = rhswp_filter_alternative_title( get_the_id(), get_the_title() );
					$documenttype = rhswp_translateposttypes( $contenttype );
					if ( 'post' == $contenttype ) {
						$categories = get_the_category( get_the_id() );
						if ( ! empty( $categories ) ) {
							// show the categories / category
							$documenttype = esc_html( $categories[0]->name );
						} else {
							// leave the translated post type
						}
						$documenttype .= ' - <span class="post-date">' . get_the_date() . '</span>';
					}
					if ( 'document' == $contenttype ) {
						$file           = get_field( 'rhswp_document_upload', $post->ID );
						$number_pages   = get_field( 'rhswp_document_number_pages', $post->ID );
						$bestand_of_url = get_field( 'rhswp_document_file_or_url', $post->ID );
						$filetype       = strtoupper( $file['subtype'] );
						$documenttype   = get_the_date( '', $post->ID );
						if ( 'bestand' === $bestand_of_url ) {
							if ( $filetype ) {
								$documenttype .= DO_SEPARATOR . $filetype;
							}
							if ( $file['filesize'] > 0 ) {
								$documenttype .= ' (' . human_filesize( $file['filesize'] ) . ')';
							}
						} else {
							// het is een link
							$documenttype .= DO_SEPARATOR . _x( "external link", 'document is een link', 'wp-rijkshuisstijl' );
						}
						if ( $number_pages > 0 ) {
							$documenttype .= DO_SEPARATOR . sprintf( _n( '%s page', "%s pages", $number_pages, 'wp-rijkshuisstijl' ), $number_pages );
						}
					}
					if ( 'attachment' == $contenttype ) {
						$theurl    = wp_get_attachment_url( $post->ID );
						$parent_id = $post->post_parent;
						$excerpt   = wp_strip_all_tags( get_the_excerpt( $parent_id ) );
						$mimetype  = get_post_mime_type( $post->ID );
						$thetitle  = rhswp_filter_alternative_title( $parent_id, get_the_title( $parent_id ) );
						$filesize  = filesize( get_attached_file( $post->ID ) );
						$file      = get_field( 'rhswp_document_upload', $parent_id );
						$filetype  = strtoupper( $file['subtype'] );
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
					printf( '<article %s %s>', $classattr, $labelledby );
					printf( '<a href="%s"><h2 id="%s">%s</h2><p>%s</p><p class="meta">%s</p></a>', $theurl, $labelledbytitleid, $thetitle, $excerpt, $documenttype );
				} else {
					// no search, not an archive for RHSWP_CPT_DOCUMENT
					if ( 'post' == $contenttype ) {
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
					printf( '<article %s %s>', $classattr, $labelledby );
					if ( $doimage ) {
						printf( '<div class="article-container"><div class="article-visual" id="%s">&nbsp;</div>', $cssid );
						printf( '<div class="article-excerpt"><a href="%s"><h2 id="%s">%s</h2><p class="meta">%s</p><p>%s</p></a></div></div>', get_permalink(), $labelledbytitleid, $thetitle, $postdate, $excerpt );
					} else {
						if ( ! ( 'post' == get_post_type( $post->ID ) ) ) {
							printf( '<a href="%s"><h2 id="%s">%s</h2><p>%s</p></a>', get_permalink(), $labelledbytitleid, $thetitle, $excerpt );
						} else {
							printf( '<a href="%s"><h2 id="%s">%s</h2><p class="meta">%s</p><p>%s</p></a>', get_permalink(), $labelledbytitleid, $thetitle, $postdate, $excerpt );
						}
					}
				}
				echo '</article>';
			}
			do_action( 'genesis_after_entry' );
		endwhile;
		echo '</div>';
		wp_reset_query();
	}
}

//========================================================================================================
