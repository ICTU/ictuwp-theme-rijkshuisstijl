<?php

/**
 * Rijkshuisstijl (Digitale Overheid) - includes/acf-extra_contentblokken.php
 * ----------------------------------------------------------------------------------
 * Functies en velddefinities voor contentblock
 * ----------------------------------------------------------------------------------
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 2.23.2
 * @desc.   Contentblokken ook tonen bij een bericht.
 * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */

//========================================================================================================

function rhswp_write_extra_contentblokken() {
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
				$contentblokken           = get_field( 'extra_contentblokken', $theid );
				$dossier_in_content_block = get_queried_object()->term_id;
			} else {
				// is een pagina of een bericht
				$theid                     = get_the_ID();
				$contentblokken            = get_field( 'extra_contentblokken', $theid );
				$dossier_in_content_block2 = get_the_terms( $theid, RHSWP_CT_DOSSIER );
				$dossier_in_content_block  = $dossier_in_content_block2[0]->term_id;
			}


			if ( ( is_array( $contentblokken ) || is_object( $contentblokken ) ) && ( $contentblokken[0] != '' ) ) {

				foreach ( $contentblokken as $row ) {

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
					$with_featured_image   = 'alle';
					$limit                 = $row['extra_contentblok_maxnr_events'];

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

							echo '<div class="contentblock ' . $type_block . ' columncount-' . $columncount . '"' . $blockidattribute . '>';

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

						echo '<div class="contentblock ' . $type_block . '"' . $blockidattribute . '>';

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
								$eventlist = str_replace('columncount-3',  'columncount-2', $eventlist);
								echo $eventlist;
								if ( $events_link ) {
									echo '<p class="more">' . $events_link . '</p>';
								}
							}
						}

						echo '</div>';

					} elseif ( 'berichten_paginas' == $type_block ) {

						$columncount = 2;
						$itemcount   = count( $selected_content );

						if ( 1 === $itemcount ) {
							$columncount = 1;
						} elseif ( 2 === $itemcount ) {
							$columncount = 2;
						} elseif ( 4 === $itemcount ) {
							$columncount = 2;
						}

						echo '<div class="contentblock ' . $type_block . '"' . $blockidattribute . '>';

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

							echo '<div class="grid columncount-' . $columncount . ' itemcount-' . $itemcount . '">';

							foreach ( $selected_content as $post ) {

								setup_postdata( $post );

								$postcounter ++;
								$args2 = array(
									'ID'   => get_the_ID(),
									'type' => 'posts_plain',
								);

								echo rhswp_get_grid_item( $args2 );
							}

							echo '</div>'; // .grid

						}

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

								$item_count = $contentblockposts->post_count;

								$columncount = 3;

								if ( 1 === $item_count ) {
									$columncount = 1;
								} elseif ( 2 === $item_count ) {
									$columncount = 2;
								} elseif ( 4 === $item_count ) {
									$columncount = 2;
								}

								echo '<section class="flexbox contentblocks"' . $blockidattribute . '>';
								echo '<div class="wrap">';

								if ( $titel ) {
									echo '<h2>' . $titel . '</h2>';
								} else {
									echo '<h2>' . __( 'No titel found for post', 'wp-rijkshuisstijl' ) . '</h2>';
								}

//								echo '<div class="flexcontainer ' . $type_block . ' no-top columncount-' . $columncount . '">';
								if ( is_singular( 'post' ) ) {
									// een bericht heeft inmiddels full width, dus lekker 3 kolommen
									echo '<div class="grid">';
								} elseif ( is_tax( RHSWP_CT_DOSSIER ) ) {
									// een dossier full width, dus lekker 3 kolommen
									echo '<div class="grid">';
								} else {
									echo '<div class="grid itemcount-' . $item_count . ' columncount-' . $columncount . '">';
								}

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
									$block          = '';

									//fuckup
									//puckuf
									// TODO


									if ( $currentsite && $currentpage && get_query_var( RHSWP_DOSSIERCONTEXTPOSTOVERVIEW ) && $toonlinksindossiercontext ) {
										// TODO
										// aaaaa, what a fuckup.
										// o holy ToDo: make me use a page for this URL (bug:
										echo '$currentsite : ' . $currentsite . '<br>';
										echo '$currentpage : ' . $currentpage . '<br>';

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

										$block = sprintf( '<article %s>', $classattr );
										if ( $postdate ) {
											$postdate = '<p class="meta">' . $postdate . '</p>';
										}

										if ( $doimage ) {
											$block .= '<div class="article-container">';
											$block .= sprintf( '<div class="article-visual">%s</div>', get_the_post_thumbnail( $post->ID, 'article-visual' ) );
											$block .= sprintf( '<div class="article-excerpt"><h3><a href="%s">%s</a></h3>%s<p>%s</p>%s</div>', $theurl, $title, $postdate, $excerpt, $categorielinks );
											$block .= '</div>';
										} else {
											$block .= sprintf( '<h3><a href="%s">%s</a></h3>%s<p>%s</p>%s', $theurl, $title, $postdate, $excerpt, $categorielinks );
										}
										$block .= '</article>';

									} else {

										$args2 = array(
											'ID'   => get_the_ID(),
											'type' => 'posts_plain'
										);

										$block = rhswp_get_grid_item( $args2 );

									}

									echo $block;

//									printf( '<article %s>', $classattr );


									if ( WP_DEBUG && SHOW_CSS_DEBUG ) {
										dodebug_do( 'Check category & dossier:' );
										the_category( ', ' );
										dodebug_do( get_the_term_list( $post->ID, RHSWP_CT_DOSSIER, 'Topics', ', ' ) );
									}

									do_action( 'genesis_after_entry' );

								endwhile;

								echo '</div>'; // .grid

								if ( $overviewurl && $overviewlinktext ) {
									echo '<p class="more"><a href="' . $overviewurl . '">' . $overviewlinktext . '</a></p>';
								}

								echo '</div>'; // .wrap
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
								$headerlevel = 'h2';
								$itemcount   = count( $terms );
								if ( 1 === $itemcount ) {
									$columncount = 1;
								} elseif ( 2 === $itemcount ) {
									$columncount = 2;
								} elseif ( 4 === $itemcount ) {
									$columncount = 2;
								}

								echo '<section class="uitgelicht flexbox"' . $blockidattribute . '>';
								echo '<div class="contentblock ' . $type_block . ' itemcount-' . $itemcount . '">';

								if ( $titel ) {
//									$headerlevel = 'h3';
									echo '<h2>' . $titel . '</h2>';
								}

								foreach ( $terms as $term ) {

									$excerpt     = '';
									$kortebeschr = get_field( 'dossier_korte_beschrijving_voor_dossieroverzicht', RHSWP_CT_DOSSIER . '_' . $term->term_id );
									$dossierlink = '<p class="dossierlink"><a href="' . get_term_link( $term->term_id, RHSWP_CT_DOSSIER ) . '">' . $term->name . '</a></p>';

									if ( $kortebeschr ) {
										$excerpt = $kortebeschr;
									} elseif ( $term->description ) {
										$excerpt = $term->description;;
									}

									echo '<details><summary><' . $headerlevel . '>' . $term->name . '</' . $headerlevel . '></summary><p>' . wp_strip_all_tags( $excerpt ) . '</p>' . $dossierlink . '</details>';

								}

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
							$item_count  = count( $selecteer_uitgelichte_paginas_of_berichten );
							if ( 1 === $item_count ) {
								$columncount = 1;
							} elseif ( 2 === $item_count ) {
								$columncount = 2;
							} elseif ( 4 === $item_count ) {
								$columncount = 2;
							}

							echo '<div class="grid itemcount-' . $item_count . ' columncount-' . $columncount . '">';

							$postcounter = 0;

							foreach ( $selecteer_uitgelichte_paginas_of_berichten as $post ) {

								setup_postdata( $post );

								$postcounter ++;
								$current_post_id = isset( $post->ID ) ? $post->ID : 0;
								$args2           = array(
									'ID'          => $current_post_id,
									'itemclass'   => 'griditem griditem--post colspan-1 ' . get_post_type( $post->ID ),
									'type'        => 'posts_normal',
									'headerlevel' => $headertag
								);
								echo rhswp_get_grid_item( $args2 );

							}


							echo '</div>'; // class="grid
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


//====================================================================================================
