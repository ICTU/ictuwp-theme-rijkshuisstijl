<?php

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

		if ( is_page() || is_tax() ) {

			$dossier_in_content_block = '';

			if ( is_page() ) {
				$theid                     = get_the_ID();
				$contentblokken            = get_field( 'extra_contentblokken', $theid );
				$dossier_in_content_block2 = get_the_terms( $theid, RHSWP_CT_DOSSIER );
				$dossier_in_content_block  = $dossier_in_content_block2[0]->term_id;
			} elseif ( is_tax( RHSWP_CT_DOSSIER ) ) {
				$theid                    = RHSWP_CT_DOSSIER . '_' . get_queried_object()->term_id;
				$contentblokken           = get_field( 'extra_contentblokken', $theid );
				$dossier_in_content_block = get_queried_object()->term_id;
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

					$with_featured_image.  = 'alle';
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
							}
							elseif ( 2 === count( $algemeen_links ) ) {
								$columncount = 2;
							}
							elseif ( 4 === count( $algemeen_links ) ) {
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
						}
						elseif ( 2 === count( $selected_content ) ) {
							$columncount = 2;
						}
						elseif ( 4 === count( $selected_content ) ) {
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
									$postdate = get_the_date();
								}

								if ( has_post_thumbnail( $post ) ) {
									printf( '<article %s>', $classattr );
									echo '<div class="article-container">';
									printf( '<div class="article-visual">%s</div>', get_the_post_thumbnail( $post->ID, 'article-visual' ) );
									printf( '<div class="article-excerpt"><h3><a href="%s">%s</a></h3><p class="meta">%s</p><p>%s</p></div>', get_permalink(), get_the_title(), $postdate, $excerpt );
									echo '</div>';
									echo '</article>';
								} else {
									printf( '<article %s>', $classattr );
									printf( '<h3><a href="%s">%s</a></h3><p class="meta">%s</p><p>%s</p>', get_permalink(), get_the_title(), $postdate, $excerpt );
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

									foreach ( $chosen_category as $filter ):

										$terminfo = get_term_by( 'id', $filter, 'category' );
										$slugs[]  = $terminfo->slug;

										$overviewlinktext = $terminfo->name;
										$actueelpageid    = get_option( 'page_for_posts' );

										$overviewurl = get_permalink( $actueelpageid ) . $terminfo->slug . '/'; // page_for_posts

									endforeach;

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
								} // if ( $chosen_category ) {
							}

							// Assign predefined $args to your query
							$contentblockposts = new WP_query();
							$contentblockposts->query( $args );

							if ( $contentblockposts->have_posts() ) {
								
								$count = $contentblockposts->post_count;

								$columncount = 3;
								
								if ( 1 === $count ) {
									$columncount = 1;
								}
								elseif ( 2 === $count ) {
									$columncount = 2;
								}
								elseif ( 4 === $count ) {
									$columncount = 2;
								}
								
								echo '<section class="flexbox"' . $blockidattribute . '>';
								echo '<div class="wrap">';
								echo '<div class="block ' . $type_block . ' columncount-' . $columncount . '">';

								if ( $titel ) {
									echo '<h2>' . $titel . '</h2>';
								} else {
									echo '<h2>' . __( 'No titel found for post', 'wp-rijkshuisstijl' ) . '</h2>';
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

									if ( $doimage ) {
										echo '<div class="article-container">';

										if ( ( 'front-page.php' == $pagetemplate ) || ( 'page_front-page.php' == $pagetemplate ) ) {
											printf( '<div class="article-visual" id="%s">&nbsp;</div>', 'image_featured_image_post_' . $post->ID );
										} else {
											printf( '<div class="article-visual">%s</div>', get_the_post_thumbnail( $post->ID, 'article-visual' ) );
										}
										printf( '<div class="article-excerpt"><h3><a href="%s">%s</a></h3><p class="meta">%s</p><p>%s</p>%s</div>', $theurl, $title, $postdate, $excerpt, $categorielinks );

										echo '</div>';
									} else {
										printf( '<h3><a href="%s">%s</a></h3><p class="meta">%s</p><p>%s</p>%s', $theurl, $title, $postdate, $excerpt, $categorielinks );
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
								}
								elseif ( 2 === count( $terms ) ) {
									$columncount = 2;
								}
								elseif ( 4 === count( $terms ) ) {
									$columncount = 2;
								}

								echo '<section class="uitgelicht flexbox"' . $blockidattribute . '>';
								echo '<div class="wrap">';
								echo '<div class="block ' . $type_block . ' columncount-' . $columncount . '">';
	
								if ( $titel ) {
									echo '<h2>' . $titel . '</h2>';
								}
								
								foreach ( $terms as $term ) {

									$excerpt   = '';
									$classattr = 'class="dossieroverzicht"';
									if ( $term->description ) {
										$excerpt = $term->description;
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
							}
							elseif ( 2 === count( $selecteer_uitgelichte_paginas_of_berichten ) ) {
								$columncount = 2;
							}
							elseif ( 4 === count( $selecteer_uitgelichte_paginas_of_berichten ) ) {
								$columncount = 2;
							}
							

							echo '<div class="flexcontainer no-top columncount-' . $columncount . '">';

							$postcounter = 0;

							foreach ( $selecteer_uitgelichte_paginas_of_berichten as $post ) {

								setup_postdata( $post );

								$postcounter ++;

								$classattr 			= genesis_attr( 'entry' );
								$permalink 			= '';
								$permalink_start 	= '';
								$permalink_end		= '';
								$permalink_start2	= '';
								$permalink_end2 	= '';
								$excerpt 			= '';
								$excerpt 			= '';
								$link 				= '';

								do_action( 'genesis_before_entry' );

								$classattr = str_replace( 'has-post-thumbnail', '', $classattr );

								if ( get_post_type() === RHSWP_CPT_VERWIJZING ) {
//									$excerpt   = wp_strip_all_tags( get_the_content( $post ) );
									$excerpt   = get_field( 'verwijzing_beschrijving', $post->ID );
									if ( get_field( 'verwijzing_url', $post->ID ) ) {
										$link 		= get_field( 'verwijzing_url', $post->ID );
										if ( is_array( $link ) ) {
											$permalink	= $link['url'];
										}
										else {
											$permalink	= $link;
										}
									}
								}
								else {
									$permalink = get_permalink();
									$excerpt   = wp_strip_all_tags( get_the_excerpt( $post ) );
								}

								if ( ! $excerpt ) {
									$excerpt = get_the_title();
								}

								if ( $permalink ) {
									$permalink_start = sprintf( '<a href="%s">', $permalink );
									$permalink_end = '</a>';
								}
								
								if ( has_post_thumbnail( $post ) ) {
									$classattr = preg_replace( '|class="|i', 'class="has-post-thumbnail ', $classattr );
								}
								else {
									$classattr = preg_replace( '|class="|i', 'class="no-post-thumbnail ', $classattr );
								}
							

								$postdate = '';
								if ( 'post' == get_post_type() ) {
									$postdate = get_the_date();
								}

								if ( 'citaat_of_verwijzing_citaat' === get_field( 'citaat_of_verwijzing', $post->ID )  ) {

									$citaat_en_auteur = get_field( 'citaat_en_auteur', $post->ID );
									
									
									if ( $citaat_en_auteur ) {
	
										echo '<section class="' . RHSWP_CPT_VERWIJZING . '">';
										if ( has_post_thumbnail( $post ) ) {
											echo '<div>';
											echo get_the_post_thumbnail( $post->ID, 'widget-image-top' );
											echo '</div>';
										}									
										echo '<div>';
										printf( '<blockquote cite="%s">', $permalink );
										printf( '<p>%s</p>', $citaat_en_auteur['verwijzing_citaat'] );
										printf( '<footer>%s</footer>', $citaat_en_auteur['verwijzing_citaat_auteur'] );
										echo '</blockquote>';
										if ( $link ) {
											$title = '';

											if ( ! $link['title'] ) {

												$title = $link['url'];
												$title = preg_replace( '|https://|i', '', $title );
												$title = preg_replace( '|http://|i', '', $title );
												$titlearray = explode( '/', $title );
												if ( $titlearray[0] ) {
													$title = $titlearray[0];
												}						

											}
											else {
												$title = $link['title'];
											}
											printf( '<p class="more"><a href="%s">%s</a></p>', $link['url'], $title );
										}
										echo '</div>';
										echo '</section>';
									
									}

								}
								elseif ( has_post_thumbnail( $post ) ) {
									printf( '<article %s>', $classattr );
									echo '<div class="article-container">';

									
//									$permalink_start2 = str_replace( '<a href=', '<a tabindex="-1" href=', $permalink_start );
//									$permalink_end2 = $permalink_end;
									printf( '<div class="article-visual">%s%s%s</div>', $permalink_start2, get_the_post_thumbnail( $post->ID, 'article-visual-big' ), $permalink_end2 );
									printf( '<div class="article-excerpt"><%s>%s%s%s</%s><p class="meta">%s</p><p>%s</p></div>', $headertag, $permalink_start, get_the_title(), $permalink_end, $headertag, $postdate, $excerpt );
									echo '</div>';
									echo '</article>';
								} else {
									printf( '<article %s>', $classattr );
									printf( '<%s>%s%s%s</%s><p class="meta">%s</p><p>%s</p>', $headertag, $permalink_start, get_the_title(), $permalink_end, $headertag, $postdate, $excerpt );
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


//====================================================================================================
// contentblocks onderaan een pagina.
// - of vrij ingevoerde links
// - of berichten (algemeen of gefilterd op categorie)

if ( function_exists( 'acf_add_local_field_group' ) ):

	acf_add_local_field_group( array(
		'key'                   => 'group_5804cc93cxac6',
		'title'                 => 'Contentblokken',
		'fields'                => array(
			array(
				'key'               => 'field_5804cd3ef7829',
				'label'             => 'Voeg 1 of meer blokken toe',
				'name'              => 'extra_contentblokken',
				'type'              => 'repeater',
				'instructions'      => 'Deze blokken bestaan uit berichten, pagina\'s of uit links. Berichten worden automatisch geselecteerd. Links moet je handmatig toevoegen.',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'collapsed'         => 'field_5804cd67f782a',
				'min'               => 0,
				'max'               => 0,
				'layout'            => 'block',
				'button_label'      => 'Nieuw blok toevoegen',
				'sub_fields'        => array(
					array(
						'key'               => 'field_5804cd67f782a',
						'label'             => 'Titel boven contentblok',
						'name'              => 'extra_contentblok_title',
						'type'              => 'text',
						'instructions'      => '',
						'required'          => 1,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					),
					array(
						'key'               => 'field_5804cde25e99a',
						'label'             => 'Wat wil je tonen in dit contentblok?',
						'name'              => 'extra_contentblok_type_block',
						'type'              => 'radio',
						'instructions'      => '',
						'required'          => 1,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'choices'           => array(
							'berichten'          => 'Automatische lijst van berichten',
							'berichten_paginas'  => 'Berichten of pagina\'s',
							'algemeen'           => 'Vrije invoer: links in de volgorde die ik bepaal',
							'select_dossiers'    => 'Een selectie van dossiers',
							'events'             => 'Automatische lijst van evenementen',
							'uitgelichtecontent' => 'Uitgelichte pagina\'s of berichten',
						),
						'allow_null'        => 0,
						'other_choice'      => 0,
						'default_value'     => 'berichten_paginas',
						'layout'            => 'vertical',
						'return_format'     => 'value',
						'save_other_choice' => 0,
					),
					array(
						'key'               => 'field_5804cd7bf782b',
						'label'             => 'Links in je contentblok',
						'name'              => 'extra_contentblok_algemeen_links',
						'type'              => 'repeater',
						'instructions'      => '',
						'required'          => 1,
						'conditional_logic' => array(
							array(
								array(
									'field'    => 'field_5804cde25e99a',
									'operator' => '==',
									'value'    => 'algemeen',
								),
							),
						),
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'collapsed'         => '',
						'min'               => 0,
						'max'               => 0,
						'layout'            => 'row',
						'button_label'      => 'Nieuwe regel',
						'sub_fields'        => array(
							array(
								'key'               => 'field_580ddadb4597b',
								'label'             => 'Linktekst',
								'name'              => 'extra_contentblok_algemeen_links_linktekst',
								'type'              => 'text',
								'instructions'      => '',
								'required'          => 1,
								'conditional_logic' => 0,
								'wrapper'           => array(
									'width' => '',
									'class' => '',
									'id'    => '',
								),
								'default_value'     => '',
								'placeholder'       => '',
								'prepend'           => '',
								'append'            => '',
								'maxlength'         => '',
							),
							array(
								'key'               => 'field_580ddb0e4597c',
								'label'             => 'Link',
								'name'              => 'extra_contentblok_algemeen_links_url',
								'type'              => 'url',
								'instructions'      => '',
								'required'          => 1,
								'conditional_logic' => 0,
								'wrapper'           => array(
									'width' => '',
									'class' => '',
									'id'    => '',
								),
								'default_value'     => '',
								'placeholder'       => '',
							),
						),
					),
					array(
						'key'               => 'field_5804d01355657',
						'label'             => 'Wil je de berichten filteren op categorie?',
						'name'              => 'extra_contentblok_categoriefilter',
						'type'              => 'radio',
						'instructions'      => '',
						'required'          => 1,
						'conditional_logic' => array(
							array(
								array(
									'field'    => 'field_5804cde25e99a',
									'operator' => '==',
									'value'    => 'berichten',
								),
							),
						),
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'choices'           => array(
							'ja'  => 'Ja, toon alleen berichten uit een bepaalde categorie.',
							'nee' => 'Neen, toon alle berichten die bij deze pagina horen.',
						),
						'allow_null'        => 0,
						'other_choice'      => 0,
						'save_other_choice' => 0,
						'default_value'     => 'nee',
						'layout'            => 'vertical',
						'return_format'     => 'value',
					),
					array(
						'key'               => 'field_5804d0ae7e521',
						'label'             => 'Kies de categorie',
						'name'              => 'extra_contentblok_chosen_category',
						'type'              => 'taxonomy',
						'instructions'      => '',
						'required'          => 1,
						'conditional_logic' => array(
							array(
								array(
									'field'    => 'field_5804cde25e99a',
									'operator' => '==',
									'value'    => 'berichten',
								),
								array(
									'field'    => 'field_5804d01355657',
									'operator' => '==',
									'value'    => 'ja',
								),
							),
						),
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'taxonomy'          => 'category',
						'field_type'        => 'radio',
						'allow_null'        => 0,
						'add_term'          => 1,
						'save_terms'        => 0,
						'load_terms'        => 0,
						'return_format'     => 'id',
						'multiple'          => 0,
					),
					array(
						'key'               => 'field_5804d1f49c89c',
						'label'             => 'Maximum aantal berichten',
						'name'              => 'extra_contentblok_maxnr_posts',
						'type'              => 'select',
						'instructions'      => '',
						'required'          => 1,
						'conditional_logic' => array(
							array(
								array(
									'field'    => 'field_5804cde25e99a',
									'operator' => '==',
									'value'    => 'berichten',
								),
							),
						),
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'choices'           => array(
							1  => '1',
							2  => '2',
							3  => '3',
							4  => '4',
							5  => '5',
							6  => '6',
							7  => '7',
							8  => '8',
							9  => '9',
							10 => '10',
							11 => '11',
							12 => '12',
							13 => '13',
							14 => '14',
							15 => '15',
							16 => '16',
							17 => '17',
							18 => '18',
							19 => '19',
							20 => '20',
						),
						'default_value'     => array(
							0 => 8,
						),
						'allow_null'        => 0,
						'multiple'          => 0,
						'ui'                => 0,
						'ajax'              => 0,
						'return_format'     => 'value',
						'placeholder'       => '',
					),
					array(
						'key'               => 'field_5804d943474a9',
						'label'             => 'Hoeveel evenementen maximaal?',
						'name'              => 'extra_contentblok_maxnr_events',
						'type'              => 'select',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => array(
							array(
								array(
									'field'    => 'field_5804cde25e99a',
									'operator' => '==',
									'value'    => 'events',
								),
							),
						),
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'choices'           => array(
							1  => '1',
							2  => '2',
							3  => '3',
							4  => '4',
							5  => '5',
							6  => '6',
							9  => '9',
							12 => '12',
							15 => '15',
							18 => '18',
							21 => '21',
							24 => '24',
						),
						'default_value'     => array(),
						'allow_null'        => 0,
						'multiple'          => 0,
						'ui'                => 0,
						'return_format'     => 'value',
						'ajax'              => 0,
						'placeholder'       => '',
					),
					array(
						'key'               => 'field_68247045955b10',
						'label'             => 'Geselecteerde dossiers',
						'name'              => 'select_dossiers_list',
						'type'              => 'taxonomy',
						'instructions'      => 'De dossiers die je hier kiest worden bovenaan de pagina getoond met speciale layout.',
						'required'          => 0,
						'conditional_logic' => array(
							array(
								array(
									'field'    => 'field_5804cde25e99a',
									'operator' => '==',
									'value'    => 'select_dossiers',
								),
							),
						),
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'taxonomy'          => 'dossiers',
						'field_type'        => 'checkbox',
						'add_term'          => 0,
						'save_terms'        => 0,
						'load_terms'        => 0,
						'return_format'     => 'id',
						'multiple'          => 0,
						'allow_null'        => 0,
					),
					array(
						'key'               => 'field_58247045955a9',
						'label'             => 'Berichten, documenten en pagina\'s',
						'name'              => 'select_berichten_paginas',
						'type'              => 'relationship',
						'instructions'      => '',
						'required'          => 1,
						'conditional_logic' => array(
							array(
								array(
									'field'    => 'field_5804cde25e99a',
									'operator' => '==',
									'value'    => 'berichten_paginas',
								),
							),
						),
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'post_type'         => array(),
						'taxonomy'          => array(),
						'filters'           => array(
							0 => 'search',
							1 => 'post_type',
							2 => 'taxonomy',
						),
						'elements'          => '',
						'min'               => '',
						'max'               => '',
						'return_format'     => 'object',
					),
					array(
						'key'               => 'field_58247630e21bb',
						'label'             => 'Toon samenvattingen?',
						'name'              => 'select_berichten_paginas_toon_samenvatting',
						'type'              => 'radio',
						'instructions'      => '',
						'required'          => 1,
						'conditional_logic' => array(
							array(
								array(
									'field'    => 'field_5804cde25e99a',
									'operator' => '==',
									'value'    => 'berichten_paginas',
								),
							),
						),
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'choices'           => array(
							'ja'  => 'Ja, toon samenvattingen onder de link.',
							'nee' => 'Nee, toon alleen de link',
						),
						'allow_null'        => 0,
						'other_choice'      => 0,
						'save_other_choice' => 0,
						'default_value'     => 'nee',
						'layout'            => 'horizontal',
						'return_format'     => 'value',
					),
					array(
						'key'               => 'field_5e99dbe4ee2b0',
						'label'             => 'Selecteer uitgelichte pagina\'s of berichten',
						'name'              => 'selecteer_uitgelichte_paginas_of_berichten',
						'type'              => 'relationship',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => array(
							array(
								array(
									'field'    => 'field_5804cde25e99a',
									'operator' => '==',
									'value'    => 'uitgelichtecontent',
								),
							),
						),
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'post_type'         => array(
							0 => 'post',
							1 => 'page',
							2 => RHSWP_CPT_VERWIJZING,
							
						),
						'taxonomy'          => '',
						'filters'           => array(
							0 => 'search',
							1 => 'post_type',
							2 => 'taxonomy',
						),
						'elements'          => array(
							0 => 'featured_image',
						),
						'min'               => 2,
						'max'               => 6,
						'return_format'     => 'object',
					),
				),
			),
		),
		'location'              => array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'page',
				),
			),
			array(
				array(
					'param'    => 'taxonomy',
					'operator' => '==',
					'value'    => 'dossiers',
				),
			),
			array(
				array(
					'param'    => 'taxonomy',
					'operator' => '==',
					'value'    => 'category',
				),
			),

			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'post',
				),
			),

		),
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen'        => '',
		'active'                => true,
		'description'           => '',
	) );

endif;

