<?php

/**
 * // * Rijkshuisstijl (Digitale Overheid) - page_front-page-nieuws.php
 * // * ----------------------------------------------------------------------------------
 * // * speciale functionaliteit voor de nieuwe homepage
 * // * ----------------------------------------------------------------------------------
 * //
 * // * @author  Paul van Buuren
 * // * @license GPL-2.0+
 * // * @package wp-rijkshuisstijl
 * // * @version 2.12.11
 * // * @desc.   Kopstructuur homepage verbeterd.
 * // * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 * //
 */

//* Template Name: DO - Homepage met nieuws

//* Force full-width-content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );


remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );

//========================================================================================================

// geen titel meer tonen of de standaard pagina-inhoud
remove_action( 'genesis_loop', 'genesis_do_loop' );

// eerste blok met uitgelicht artikel
add_action( 'genesis_loop', 'rhswp_home_onderwerpen_dossiers', 8 );

// nieuws
add_action( 'genesis_loop', 'rhswp_write_extra_contentblokken', 14 );

//========================================================================================================

genesis();

//========================================================================================================

function rhswp_home_onderwerpen_dossiers() {

	global $post;

	$theid                  = $post->ID;
	$featuredpost_title1    = '';
	$featuredpost_title2    = '';
	$featuredpost_url1      = '';
	$featuredpost_url2      = '';
	$featuredpost_image     = '';
	$featuredpost_image2    = '';
	$featuredpost_subtitle1 = '';
	$featuredpost_subtitle2 = '';
	$featuredpost_excerpt1  = '&nbsp;';
	$featuredpost_excerpt2  = '&nbsp;';
	$skip_posts             = array(); // array with IDs for posts to be skipped in loop

	if ( get_field( 'home_row_1_cell_1_post', $theid ) ) {
		$featuredpost          = get_field( 'home_row_1_cell_1_post', $theid );
		$featuredid            = $featuredpost[0]->ID;
		$featuredpost_title1   = get_the_title( $featuredid );
		$featuredpost_url1     = get_permalink( $featuredid );
		$featuredpost_excerpt1 = get_the_excerpt( $featuredid );
		$featuredpost_image    = get_the_post_thumbnail( $featuredid, IMAGESIZE_16x9 );
		$featuredpost_dossier  = get_the_terms( $theid, RHSWP_CT_DOSSIER );
		if ( $featuredpost_dossier ) {
			$featuredpost_subtitle1 = $featuredpost_dossier[0]->term_name;
		}
		$skip_posts[] = $featuredid;
	} elseif ( get_field( 'home_row_1_cell_1_featured_link', $theid ) ) {
		// er is geen featured post uitgekozen; misschien zijn er wel een plaatje, link en losse tekst ingevoerd?
		$link                = get_field( 'home_row_1_cell_1_featured_link', $theid );
		$featuredpost_title1 = $link['title'];
		$featuredpost_url1   = $link['url'];
	}

	if ( get_field( 'home_row_1_cell_2_post', $theid ) ) {
		$featuredpost          = get_field( 'home_row_1_cell_2_post', $theid );
		$featuredid            = $featuredpost[0]->ID;
		$featuredpost_title2   = get_the_title( $featuredid );
		$featuredpost_url1     = get_permalink( $featuredid );
		$featuredpost_excerpt2 = get_the_excerpt( $featuredid );
		$featuredpost_image2   = get_the_post_thumbnail( $featuredid, IMAGESIZE_16x9 );
		$skip_posts[]          = $featuredid;
	}


	$maxnr      = 4;
	$rowcounter = 0;
	$breedte    = 'vollebreedte';


	if ( $featuredpost_title2 || $featuredpost_title1 ) {

		echo '<section class="grid">';

		echo '<div class="grid-item float-text colspan-2">';
		echo $featuredpost_image . '<div class="text">';
		if ( $featuredpost_subtitle1 ) {
			echo '<div class="badge">' . $featuredpost_subtitle1 . '</div>';
		}
		echo '<h2><a href="' . $featuredpost_url1 . '">' . $featuredpost_title1 . '</a></h2>';
		echo '</div>';
		echo '</div>';

		if ( $featuredpost_title2 ) {

			echo '<div class="grid-item">';
			echo '<h2><a href="' . $featuredpost_url2 . '">' . $featuredpost_title2 . '</a></h2>';
			if ( $featuredpost_image2 ) {
				echo '<a href="' . $featuredpost_url2 . '" tabindex="-1">';
				echo $featuredpost_image2;
				echo '</a>';
			}
			if ( $featuredpost_subtitle2 ) {
				echo '<div class="badge">' . $featuredpost_subtitle2 . '</div>';
			}
			echo $featuredpost_excerpt2;
			echo '</div>';

		} else {
			echo '<div class="grid-item">';
			echo $featuredpost_excerpt1;
			echo '</div>';

		}

		echo '</section>';
	}


	$home_rows = get_field( 'home_rows', $theid );

	if ( ( is_array( $home_rows ) || is_object( $home_rows ) ) && ( $home_rows[0] != '' ) ) {


		foreach ( $home_rows as $row ) {

			$titel = $row['home_row_title'];
			$limit = $row['home_row_max_nr'];

			echo '<section class="">';

			if ( $titel ) {
				echo '<h2>' . $titel . '</h2>';
			}

			switch ( $row['home_row_type'] ) {

				case 'free_form':
					break;
				case 'events':
					$titel = $row['home_row_title'];
					if ( class_exists( 'EM_Events' ) && ( $row['home_row_type'] === 'events' ) ) {

						$events_link = em_get_link( __( 'all events', 'events-manager' ) );
						$eventlist   = EM_Events::output( array( 'scope' => 'future', 'limit' => $limit ) );

						if ( $eventlist == get_option( 'dbem_no_events_message' ) ) {
							// er zijn dus geen evenementen
							echo get_option( 'dbem_no_events_message' );
						} else {
							echo $eventlist;
							if ( $events_link ) {
								echo '<p class="more">' . $events_link . '</p>';
							}
						}
					}
					break;
				case 'posts_featured':
				case 'posts_normal':

					$slugs = $row['home_row_category'];
					$args  = array(
						'post_type'      => 'post',
						'post_status'    => 'publish',
						'posts_per_page' => $limit,
					);

					if ( $slugs ) {
						$args['tax_query'] = array(
							array(
								'taxonomy' => 'category',
								'field'    => 'term_id',
								'terms'    => $slugs,
							)
						);
						$more_text         = get_cat_name( $slugs );
						$more_url          = get_category_link( $slugs );

					}
					if ( $skip_posts ) {
						$args['post__not_in'] = $skip_posts;
					}

					// Assign predefined $args to your query
					$contentblockposts = new WP_query();
					$contentblockposts->query( $args );

					if ( $contentblockposts->have_posts() ) {
						echo '<div class="grid">';
						while ( $contentblockposts->have_posts() ) : $contentblockposts->the_post();
							$featuredid           = $post->ID;
							$skip_posts[]         = $featuredid;
							$itemclass            = 'grid-item';
							$itemdate             = get_the_date( get_option( 'date_format' ), $featuredid );
							$featuredpost_image   = get_the_post_thumbnail( $featuredid, IMAGESIZE_4x3 );
							$featuredpost_title1  = get_the_title( $featuredid );
							$featuredpost_url1    = get_permalink( $featuredid );
							$featuredpost_dossier = get_the_terms( $featuredid, RHSWP_CT_DOSSIER );
							$excerpt              = '';
							$itemtitle            = '';

							if ( $featuredpost_dossier ) {
								$featuredpost_subtitle1 = $featuredpost_dossier[0]->term_name;
							}

							if ( $row['home_row_type'] === 'posts_featured' ) {
								$itemclass          = 'grid-item float-text';
								$featuredpost_image = get_the_post_thumbnail( $featuredid, IMAGESIZE_SQUARE );
								$itemtitle          = '<div class="text">';
								if ( $featuredpost_subtitle1 ) {
									$itemtitle .= '<div class="badge">' . $featuredpost_subtitle1 . '</div>';
								}
								$itemtitle .= '<h2><a href="' . $featuredpost_url1 . '">' . $featuredpost_title1 . '</a></h2>';
								$itemtitle .= '</div>';
							} else {
								if ( $featuredpost_subtitle1 ) {
									$itemtitle .= '<div class="badge">' . $featuredpost_subtitle1 . '</div>';
								}
								$itemtitle .= '<h2><a href="' . $featuredpost_url1 . '">' . $featuredpost_title1 . '</a></h2>';
								$itemtitle .= '<p class="publishdaet">' . $itemdate . '</p>';
								$excerpt   = wp_strip_all_tags( get_the_excerpt( $featuredid ) );
							}

							echo '<div class="' . $itemclass . '">';
							echo $featuredpost_image;
							echo $itemtitle;
							echo $excerpt;
							echo '</div>';

						endwhile;

						echo '</div>';

						echo '<a href="' . $more_url . '">' . $more_text . '</a>';


					}

					break;
			}

			echo '</section>';
		}
	}


}

//========================================================================================================
function rhswp_write_deleteme_extra_contentblokken() {
	global $post;

	$thecounter              = 0;
	$blockidattribute        = '';
	$blockidattribute_prefix = ' id="';
	$blockidattribute_suffix = '"';
	$blockidattribute_prev   = '';
	$blockidattribute_name   = '';
	$arr_blockidattribute    = array(); // empty array to check if the ID for the current block exists

	if ( function_exists( 'get_field' ) && taxonomy_exists( RHSWP_CT_DOSSIER ) ) {

		if ( is_page() || is_tax( RHSWP_CT_DOSSIER ) || is_singular( 'post' ) ) {

			$dossier_in_content_block = '';

			if ( is_tax( RHSWP_CT_DOSSIER ) ) {
				// is een dossier
				$theid                    = RHSWP_CT_DOSSIER . '_' . get_queried_object()->term_id;
				$home_rows                = get_field( 'extra_contentblokken', $theid );
				$dossier_in_content_block = get_queried_object()->term_id;
			} else {
				// is een pagina of een bericht
				$theid                    = get_the_ID();
				$home_rows                = get_field( 'extra_contentblokken', $theid );
				$featuredpost_dossier     = get_the_terms( $theid, RHSWP_CT_DOSSIER );
				$dossier_in_content_block = $featuredpost_dossier[0]->term_id;
			}


			if ( ( is_array( $home_rows ) || is_object( $home_rows ) ) && ( $home_rows[0] != '' ) ) {

				foreach ( $home_rows as $row ) {

					$thecounter ++;
					$algemeen_links        = $row['extra_contentblok_algemeen_links'];
					$select_dossiers_list  = $row['select_dossiers_list'];
					$selected_content      = $row['select_berichten_paginas'];
					$selected_content_full = $row['select_berichten_paginas_toon_samenvatting'];
					$chosen_category       = $row['extra_contentblok_chosen_category'];
					$titel                 = esc_html( $row['extra_contentblok_title'] );
					$type_block            = $row['extra_contentblok_type_block'];
					$categoriefilter       = $row['extra_contentblok_categoriefilter'];
					$maxnr_posts           = $row['extra_contentblok_maxnr_posts'];

					$with_featured_image = 'alle';
					$limit               = $row['extra_contentblok_maxnr_events'];

					if ( $blockidattribute_prev == $titel ) {
						$blockidattribute_name = $titel . '-' . $thecounter;
					} else {
						$blockidattribute_name = $titel;
					}

					if ( array_key_exists( $blockidattribute_name, $arr_blockidattribute ) ) {
						// we need to be sure the ID is unique
						$blockidattribute_name = $blockidattribute_name . '-' . $thecounter;
					}

					$arr_blockidattribute[ $blockidattribute_name ] = $blockidattribute_name;


					$blockidattribute_prev = $titel;
					$blockidattribute      = $blockidattribute_prefix . sanitize_title( $blockidattribute_name ) . $blockidattribute_suffix;

					$currentpage = '';
					$currentsite = '';

					if ( 'algemeen' == $type_block ) {

						if ( $algemeen_links ) {

							$columncount = 3;

							if ( 1 === count( $algemeen_links ) ) {
								$columncount = 1;
							} elseif ( 2 === count( $algemeen_links ) ) {
								$columncount = 2;
							} elseif ( 4 === count( $algemeen_links ) ) {
								$columncount = 2;
							}

							echo '<div class="block ' . $type_block . ' columncount-' . $columncount . '"' . $blockidattribute . '>';

							if ( $titel ) {
								echo '<h2>' . $titel . '</h2>';
							}
							echo '<ul class="links">';

							foreach ( $algemeen_links as $itemid ) {
								$title = $itemid['extra_contentblok_algemeen_links_linktekst'];
								$url   = $itemid['extra_contentblok_algemeen_links_url'];
								if ( $title && $url ) {
									echo '<li>';
									echo '<a href="';
									echo $url;
									echo '">';
									echo $title;
									echo '</a></li>';
								}
							}

							echo '</ul>';
							echo '</div>';
						}

						// RESET THE QUERY
						wp_reset_query();

					} elseif ( 'events' == $type_block ) {

						$termname = get_term( $dossier_in_content_block, RHSWP_CT_DOSSIER );
						$slug     = '';
						if ( $termname && ! is_wp_error( $termname ) ) {
							$slug = $termname->slug;
						}

						echo '<div class="block ' . $type_block . '"' . $blockidattribute . '>';

						if ( $titel ) {
							echo '<h2>' . $titel . '</h2>';
						}

						if ( class_exists( 'EM_Events' ) ) {

							$events_link = em_get_link( __( 'all events', 'events-manager' ) );

							if ( $slug ) {
								$eventlist = EM_Events::output( array(
									RHSWP_CT_DOSSIER => $slug,
									'scope'          => 'future',
									'limit'          => $limit
								) );
							} else {
								$eventlist = EM_Events::output( array( 'scope' => 'future', 'limit' => $limit ) );
							}

							if ( $eventlist == get_option( 'dbem_no_events_message' ) ) {
								// er zijn dus geen evenementen
								echo get_option( 'dbem_no_events_message' );
							} else {
								echo $eventlist;
								if ( $events_link ) {
									echo '<p class="more">' . $events_link . '</p>';
								}
							}
						}

						echo '</div>';

					} elseif ( 'berichten_paginas' == $type_block ) {

						$columncount = 3;

						if ( 1 === count( $selected_content ) ) {
							$columncount = 1;
						} elseif ( 2 === count( $selected_content ) ) {
							$columncount = 2;
						} elseif ( 4 === count( $selected_content ) ) {
							$columncount = 2;
						}

						echo '<div class="block ' . $type_block . ' columncount-' . $columncount . '"' . $blockidattribute . '>';
						echo '<div class="wrap">';

						if ( $titel ) {
							echo '<h2>' . $titel . '</h2>';
						}

						if ( $selected_content_full != 'ja' ) {
							// niet ja, dus nee: toon geen samenvatting, alleen de link

							echo '<ul class="links">';

							foreach ( $selected_content as $post ) {

								setup_postdata( $post );

								$title = get_the_title();
								$url   = get_permalink();
								if ( $title && $url ) {
									echo '<li>';
									echo '<a href="';
									echo $url;
									echo '">';
									echo $title;
									echo '</a></li>';
								}
							}

							wp_reset_query();


							echo '</ul>';
						} else {
							// dus $selected_content_full == 'ja'

							$postcounter = 0;

							foreach ( $selected_content as $post ) {

								setup_postdata( $post );

								$postcounter ++;

								$doimage = false;

								$classattr = genesis_attr( 'entry' );

								do_action( 'genesis_before_entry' );

								$classattr = str_replace( 'has-post-thumbnail', '', $classattr );

								$permalink = get_permalink();
								$excerpt   = wp_strip_all_tags( get_the_excerpt( $post ) );

								if ( ! $excerpt ) {
									$excerpt = get_the_title();
								}

								$postdate = '';
								if ( 'post' == get_post_type() ) {
									$postdate = '<p class="meta">' . get_the_date() . '</p>';
								}

								if ( has_post_thumbnail( $post ) ) {
									printf( '<article %s>', $classattr );
									echo '<div class="article-container">';
									printf( '<div class="article-visual">%s</div>', get_the_post_thumbnail( $post->ID, 'article-visual' ) );
									printf( '<div class="article-excerpt"><h3><a href="%s">%s</a></h3>%s<p>%s</p></div>', get_permalink(), get_the_title(), $postdate, $excerpt );
									echo '</div>';
									echo '</article>';
								} else {
									printf( '<article %s>', $classattr );
									printf( '<h3><a href="%s">%s</a></h3>%s<p>%s</p>', get_permalink(), get_the_title(), $postdate, $excerpt );
									echo '</article>';
								}

								// RESET THE QUERY
								wp_reset_query();

								do_action( 'genesis_after_entry' );

							}
						}

						echo '</div>'; //  class="wrap"
						echo '</div>';

					} elseif ( 'berichten' == $type_block ) {
						// dus $type_block != 'algemeen' && $type_block != 'berichten_paginas'

						$pagetemplate = get_page_template_slug( $theid );

						// eerst even checken of we een contentblock met berichten moeten tonen op een pagina die vanzichzelf al berichten moet tonen
						if ( ( 'page_dossiersingleactueel.php' == $pagetemplate ) ) {

							// ja dus, dubbelop en overbodig

							$user = wp_get_current_user();

							if ( in_array( 'edit_pages', (array) $user->allcaps ) ) {
								//The user has capability to edit pages

								echo '<div style="border: 5px solid red; padding: .1em 1em; margin-bottom: 2em;">';

								echo '<div class="block ' . $type_block . '"' . $blockidattribute . '>';

								if ( $titel ) {
									echo '<h2>' . $titel . '</h2>';
								} else {
									echo '<h2>' . __( 'No titel found for post', 'wp-rijkshuisstijl' ) . '</h2>';
								}


								echo '<p>' . __( 'Note to the editor', 'wp-rijkshuisstijl' ) . '</p>';
								echo '<p>' . __( 'Je hebt een content-block toegevoegd die berichten zou moeten tonen, maar de functie van deze pagina <em>is</em> het tonen van berichten. Dubbelop, dus.', 'wp-rijkshuisstijl' );

								echo '<br><em>' . esc_html( __( "Deze tekst wordt alleen getoond aan redacteuren die pagina's mogen wijzigen.", 'wp-rijkshuisstijl' ) ) . '</em>';

								echo '</div>';
								echo '</div>';

							}
						} else {
							// er moet contentblock getoond worden van het type 'berichten'

							$overviewurl               = '';
							$overviewlinktext          = '';
							$toonlinksindossiercontext = false;
							$do_cat_permalinks         = false;
							$threshold                 = get_field( 'dossier_post_overview_categor_threshold', 'option' );
							$permalink_categories      = get_field( 'dossier_post_overview_categories', 'option' );

							if ( $dossier_in_content_block ) {
								// we zijn op een dossieroverzicht

								$term                      = get_term( $dossier_in_content_block, RHSWP_CT_DOSSIER );
								$currentterm               = $term->term_id;
								$currenttermname           = $term->name;
								$currenttermslug           = $term->slug;
								$toonlinksindossiercontext = $term;

								$currentpage = get_permalink();
								$currentsite = get_site_url();

								$args = array(
									'post_type'      => 'post',
									'post_status'    => 'publish',
									'posts_per_page' => $maxnr_posts,
									'tax_query'      => array(
										array(
											'taxonomy' => RHSWP_CT_DOSSIER,
											'field'    => 'term_id',
											'terms'    => $currentterm
										),
									)
								);

								$argscount = array(
									'post_type'      => 'post',
									'post_status'    => 'publish',
									'posts_per_page' => - 1,
									'tax_query'      => array(
										array(
											'taxonomy' => RHSWP_CT_DOSSIER,
											'field'    => 'term_id',
											'terms'    => $currentterm
										),
									)
								);

								$overviewlinktext = $dossier_in_content_block;


								// Assign predefined $args to your query
								$contentblockpostscount = new WP_query();
								$contentblockpostscount->query( $argscount );

								if ( intval( $contentblockpostscount->post_count ) >= intval( $threshold ) ) {
									$do_cat_permalinks = true;
								}

							} else {
								// niet op een dossieroverzicht
								$args = array(
									'post_type'      => 'post',
									'post_status'    => 'publish',
									'posts_per_page' => $maxnr_posts
								);

							}

							if ( $categoriefilter == 'nee' ) {

								$actueelpageid    = get_option( 'page_for_posts' );
								$overviewlinktext = get_the_title( $actueelpageid );
								$overviewurl      = get_permalink( $actueelpageid ); // general page_for_posts

							} else {

								$slugs = array();

								if ( $chosen_category ) {

									if ( is_array( $chosen_category ) ) {

										foreach ( $chosen_category as $filter ):

											$terminfo = get_term_by( 'id', $filter, 'category' );
											$slugs[]  = $terminfo->slug;

											$overviewlinktext = $terminfo->name;
											$actueelpageid    = get_option( 'page_for_posts' );

											$overviewurl = get_permalink( $actueelpageid ) . $terminfo->slug . '/'; // page_for_posts

										endforeach;

									} else {

										$terminfo = get_term_by( 'id', $chosen_category, 'category' );
										$slugs[]  = $terminfo->slug;

										$overviewlinktext = $terminfo->name;
										$actueelpageid    = get_option( 'page_for_posts' );

										$overviewurl = get_permalink( $actueelpageid ) . $terminfo->slug . '/'; // page_for_posts

									}


									if ( $dossier_in_content_block ) {

										// filter op dossier
										$args = array(
											'post_type'      => 'post',
											'post_status'    => 'publish',
											'posts_per_page' => $maxnr_posts,
											'tax_query'      => array(
												'relation' => 'AND',
												array(
													'taxonomy' => RHSWP_CT_DOSSIER,
													'field'    => 'term_id',
													'terms'    => $dossier_in_content_block
												),
												array(
													'taxonomy' => 'category',
													'field'    => 'slug',
													'terms'    => $slugs,
												)
											)
										);

										// deze weer leeg maken, want er is niet zoiets als een overview mogelijk voor deze combinatie
										$overviewlinktext = '';
										$overviewurl      = '';
									} else {

										// geen verder filter
										$args = array(
											'post_type'      => 'post',
											'post_status'    => 'publish',
											'posts_per_page' => $maxnr_posts,
											'tax_query'      => array(
												array(
													'taxonomy' => 'category',
													'field'    => 'slug',
													'terms'    => $slugs,
												)
											)
										);
									}
								} // if ( $chosen_category )
							}

							// Assign predefined $args to your query
							$contentblockposts = new WP_query();
							$contentblockposts->query( $args );

							if ( $contentblockposts->have_posts() ) {

								$count = $contentblockposts->post_count;

								$columncount = 3;

								if ( 1 === $count ) {
									$columncount = 1;
								} elseif ( 2 === $count ) {
									$columncount = 2;
								} elseif ( 4 === $count ) {
									$columncount = 2;
								}

								echo '<section class="flexbox"' . $blockidattribute . '>';
								echo '<div class="wrap">';
//								echo '<div class="block ' . $type_block . ' columncount-' . $columncount . '">';

								if ( $titel ) {
									echo '<h2>' . $titel . '</h2>';
								} else {
									echo '<h2>' . __( 'No titel found for post', 'wp-rijkshuisstijl' ) . '</h2>';
								}

								echo '<div class="flexcontainer ' . $type_block . ' no-top columncount-' . $columncount . '">';


								$postcounter = 0;

								while ( $contentblockposts->have_posts() ) : $contentblockposts->the_post();

									$postcounter ++;
									$doimage   = false;
									$classattr = genesis_attr( 'entry' );

									do_action( 'genesis_before_entry' );

									if (
										( ( intval( $with_featured_image ) > 0 && ( $postcounter <= $with_featured_image ) )
										  || ( $with_featured_image == 'alle' ) )
										&& has_post_thumbnail()
									) {
										$doimage = true;
									} else {
										$classattr = str_replace( 'has-post-thumbnail', '', $classattr );
									}

									$theurl         = get_permalink();
									$excerpt        = wp_strip_all_tags( get_the_excerpt( $post ) );
									$postdate       = get_the_date();
									$title          = get_the_title();
									$categorielinks = '';
									$permalink_cat  = '';

									if ( $currentsite && $currentpage && $toonlinksindossiercontext ) {
										// aaaaa, what a fuckup.
										// o holy ToDo: make me use a page for this URL (bug:

										if ( is_page() ) {
											// RHSWP_DOSSIERCONTEXTPOSTOVERVIEW
											$postpermalink = '/' . $post->post_name;
											$theurl        = $currentpage . RHSWP_DOSSIERPOSTCONTEXT . $postpermalink;
										} elseif ( is_tax( RHSWP_CT_DOSSIER ) ) {

											$postpermalink = get_term_link( $toonlinksindossiercontext );
											$postpermalink = str_replace( $currentsite, '', $postpermalink );

											$postpermalink = '/' . $post->post_name;
											$crumb         = str_replace( $currentsite, '', $currentpage );

											if ( $do_cat_permalinks && $permalink_cat ) {
												$theurl = trailingslashit( get_term_link( $toonlinksindossiercontext ) . RHSWP_DOSSIERCONTEXTPOSTOVERVIEW . '/' . RHSWP_DOSSIERCONTEXTCATEGORYPOSTOVERVIEW . '/' . $permalink_cat . $postpermalink );
											} else {
												$theurl = trailingslashit( get_term_link( $toonlinksindossiercontext ) . RHSWP_DOSSIERCONTEXTPOSTOVERVIEW . $postpermalink );
											}
										}
									} else {
										$theurl = get_the_permalink();
									}

									printf( '<article %s>', $classattr );

									if ( $postdate ) {
										$postdate = '<p class="meta">' . $postdate . '</p>';
									}


									if ( $doimage ) {
										echo '<div class="article-container">';
										printf( '<div class="article-visual">%s</div>', get_the_post_thumbnail( $post->ID, 'article-visual' ) );
										printf( '<div class="article-excerpt"><h3><a href="%s">%s</a></h3>%s<p>%s</p>%s</div>', $theurl, $title, $postdate, $excerpt, $categorielinks );

										echo '</div>';
									} else {
										printf( '<h3><a href="%s">%s</a></h3>%s<p>%s</p>%s', $theurl, $title, $postdate, $excerpt, $categorielinks );
									}

									if ( WP_DEBUG && SHOW_CSS_DEBUG ) {
										dodebug_do( 'Check category & dossier:' );
										the_category( ', ' );
										dodebug_do( get_the_term_list( $post->ID, RHSWP_CT_DOSSIER, 'Topics', ', ' ) );
									}

									echo '</article>';

									do_action( 'genesis_after_entry' );

								endwhile;

								if ( $overviewurl && $overviewlinktext ) {
									echo '<p class="more"><a href="' . $overviewurl . '">' . $overviewlinktext . '</a></p>';
								}

								echo '</div>';
								echo '</div>';
								echo '</section>';

							} else {

								$user = wp_get_current_user();

								if ( in_array( 'edit_pages', (array) $user->allcaps ) ) {
									//The user has capability to edit pages


									echo '<div style="border: 5px solid red; padding: .1em 1em; margin-bottom: 2em;">';

									echo '<div class="block ' . $type_block . '"' . $blockidattribute . ' style="display: block;">';

									if ( $titel ) {
										echo '<h2>' . $titel . '</h2>';
									} else {
										echo '<h2>' . __( 'No titel found for post', 'wp-rijkshuisstijl' ) . '</h2>';
									}

									echo '<p>' . __( 'Note to the editor', 'wp-rijkshuisstijl' ) . '</p>';
									echo '<p>' . __( 'Er is een content-block met berichten toegevoegd aan deze pagina, maar hiervoor zijn geen berichten gevonden.', 'wp-rijkshuisstijl' );
									echo '<br><em>' . esc_html( __( "Deze tekst wordt alleen getoond aan redacteuren die pagina's mogen wijzigen.", 'wp-rijkshuisstijl' ) ) . '</em>';

									echo '</div>';
									echo '</div>';

								}

							}
							// RESET THE QUERY
							wp_reset_query();

						}

					} elseif ( 'select_dossiers' == $type_block ) {

						if ( $select_dossiers_list ) {


							$terms = get_terms( RHSWP_CT_DOSSIER, array(
								'hide_empty' => false,
								'include'    => $select_dossiers_list
							) );

							if ( $terms && ! is_wp_error( $terms ) ) {

								$columncount = 3;
								if ( 1 === count( $terms ) ) {
									$columncount = 1;
								} elseif ( 2 === count( $terms ) ) {
									$columncount = 2;
								} elseif ( 4 === count( $terms ) ) {
									$columncount = 2;
								}

								echo '<section class="uitgelicht flexbox"' . $blockidattribute . '>';
								echo '<div class="wrap">';
								echo '<div class="block ' . $type_block . ' columncount-' . $columncount . '">';

								if ( $titel ) {
									echo '<h2>' . $titel . '</h2>';
								}

								foreach ( $terms as $term ) {

									$excerpt     = '';
									$classattr   = 'class="dossieroverzicht"';
									$kortebeschr = get_field( 'dossier_korte_beschrijving_voor_dossieroverzicht', RHSWP_CT_DOSSIER . '_' . $term->term_id );

									if ( $kortebeschr ) {
										$excerpt = $kortebeschr;
									} elseif ( $term->description ) {
										$excerpt = $term->description;;
									}
									$href    = get_term_link( $term->term_id, RHSWP_CT_DOSSIER );
									$excerpt = wp_strip_all_tags( $excerpt );

									printf( '<article %s>', $classattr );
									printf( '<a href="%s"><h3>%s</h3><p>%s</p></a>', $href, $term->name, $excerpt );
									echo '</article>';
								}

								echo '</div>';
								echo '</div>';
								echo '</section>';

							}

							// RESET THE QUERY
							wp_reset_query();

						}
					} elseif ( 'uitgelichtecontent' == $type_block ) {

						$selecteer_uitgelichte_paginas_of_berichten = $row['selecteer_uitgelichte_paginas_of_berichten'];

						if ( count( $selecteer_uitgelichte_paginas_of_berichten ) > 0 ) {

							echo '<section class="uitgelicht"' . $blockidattribute . '>';

							echo '<div class="wrap">';
							$headertag = 'h2';

							if ( $titel ) {
								echo '<h2>' . $titel . '</h2>';
								$headertag = 'h3';
							}

							$columncount = 3;
							if ( 1 === count( $selecteer_uitgelichte_paginas_of_berichten ) ) {
								$columncount = 1;
							} elseif ( 2 === count( $selecteer_uitgelichte_paginas_of_berichten ) ) {
								$columncount = 2;
							} elseif ( 4 === count( $selecteer_uitgelichte_paginas_of_berichten ) ) {
								$columncount = 2;
							}


							echo '<div class="flexcontainer no-top columncount-' . $columncount . '">';

							$postcounter = 0;

							foreach ( $selecteer_uitgelichte_paginas_of_berichten as $post ) {

								setup_postdata( $post );

								$postcounter ++;

								$classattr        = genesis_attr( 'entry' );
								$permalink        = '';
								$permalink_start  = '';
								$permalink_end    = '';
								$permalink_start2 = '';
								$permalink_end2   = '';
								$excerpt          = '';
								$excerpt          = '';
								$link             = '';

								do_action( 'genesis_before_entry' );

								$classattr = str_replace( 'has-post-thumbnail', '', $classattr );

								if ( get_post_type() === RHSWP_CPT_VERWIJZING ) {
//									$excerpt   = wp_strip_all_tags( get_the_content( $post ) );
									$excerpt = get_field( 'verwijzing_beschrijving', $post->ID );
									if ( get_field( 'verwijzing_url', $post->ID ) ) {
										$link = get_field( 'verwijzing_url', $post->ID );
										if ( is_array( $link ) ) {
											$permalink = $link['url'];
										} else {
											$permalink = $link;
										}
									}
								} else {
									$permalink = get_permalink();
									$excerpt   = wp_strip_all_tags( get_the_excerpt( $post ) );
								}

								if ( ! $excerpt ) {
									$excerpt = get_the_title();
								}

								if ( $permalink ) {
									$permalink_start = sprintf( '<a href="%s">', $permalink );
									$permalink_end   = '</a>';
								}

								if ( has_post_thumbnail( $post ) ) {
									$classattr = preg_replace( '|class="|i', 'class="has-post-thumbnail ', $classattr );
								} else {
									$classattr = preg_replace( '|class="|i', 'class="no-post-thumbnail ', $classattr );
								}


								$postdate = '';
								if ( 'post' == get_post_type() ) {
									$postdate = '<p class="meta">' . get_the_date() . '</p>';
								}


								if ( 'citaat_of_verwijzing_citaat' === get_field( 'citaat_of_verwijzing', $post->ID ) ) {

									$citaat_en_auteur = get_field( 'citaat_en_auteur', $post->ID );


									if ( $citaat_en_auteur ) {

										echo '<section class="' . RHSWP_CPT_VERWIJZING . '">';
										if ( has_post_thumbnail( $post ) ) {
											echo '<div class="has-thumbnail">';
											echo get_the_post_thumbnail( $post->ID, 'widget-image-top' );
											echo '</div>';
										}
										echo '<div class="blockquote">';
										printf( '<blockquote cite="%s">', $permalink );
										printf( '<p>%s</p>', $citaat_en_auteur['verwijzing_citaat'] );
										printf( '<footer>%s</footer>', $citaat_en_auteur['verwijzing_citaat_auteur'] );
										echo '</blockquote>';
										if ( $link ) {
											$title = '';

											if ( ! $link['title'] ) {

												$title      = $link['url'];
												$title      = preg_replace( '|https://|i', '', $title );
												$title      = preg_replace( '|http://|i', '', $title );
												$titlearray = explode( '/', $title );
												if ( $titlearray[0] ) {
													$title = $titlearray[0];
												}

											} else {
												$title = $link['title'];
											}
											printf( '<p class="more"><a href="%s">%s</a></p>', $link['url'], $title );
										}
										echo '</div>';
										echo '</section>';

									}

								} elseif ( has_post_thumbnail( $post ) ) {
									printf( '<article %s>', $classattr );
									echo '<div class="article-container">';


//									$permalink_start2 = str_replace( '<a href=', '<a tabindex="-1" href=', $permalink_start );
//									$permalink_end2 = $permalink_end;
									printf( '<div class="article-visual">%s%s%s</div>', $permalink_start2, get_the_post_thumbnail( $post->ID, 'article-visual-big' ), $permalink_end2 );
									printf( '<div class="article-excerpt"><%s>%s%s%s</%s>%s<p>%s</p></div>', $headertag, $permalink_start, get_the_title(), $permalink_end, $headertag, $postdate, $excerpt );
									echo '</div>';
									echo '</article>';
								} else {
									printf( '<article %s>', $classattr );
									printf( '<%s>%s%s%s</%s>%s<p>%s</p>', $headertag, $permalink_start, get_the_title(), $permalink_end, $headertag, $postdate, $excerpt );
									echo '</article>';
								}

								// RESET THE QUERY
								wp_reset_query();

								do_action( 'genesis_after_entry' );

							}


							echo '</div>'; // class="flex
							echo '</div>'; // class="wrap
							echo '</section>'; // class="uitgelicht

						} // if ( $selecteer_uitgelichte_paginas_of_berichten )


					} else {
						if ( $titel ) {
							echo '<h2>' . $titel . ' / ' . $type_block . '</h2>';
						} else {
							echo '<h2>' . __( 'No titel found for post', 'wp-rijkshuisstijl' ) . ' / ' . $type_block . '</h2>';
						}
					}
				}
			} else {
				dodebug_do( 'geen blokken gevonden' );
			}
		}
	}

	// RESET THE QUERY
	wp_reset_query();


}

