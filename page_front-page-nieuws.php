<?php

/**
 * Rijkshuisstijl (Digitale Overheid) - page_front-page-nieuws.php
 * ----------------------------------------------------------------------------------
 * speciale functionaliteit voor de nieuwe homepage
 * ----------------------------------------------------------------------------------
 * //
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 2.12.11
 * @desc.   Kopstructuur homepage verbeterd.
 * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 * //
 */

//* Template Name: DO - Homepage met nieuws (2021)


//* Force full-width-content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );


// Geen caroussel tonen
remove_action( 'genesis_after_header', 'rhswp_check_caroussel_or_featured_img', 22 );

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
	$etalage_titel          = '';
	$etalage                = '';
	$etalage_url            = '';
	$etalage_image          = '';
	$etalage_label          = '';
	$etalage_excerpt        = '&nbsp;';
	$uitgelicht_titel       = '';
	$uitgelicht_titel_class = '';
	$uitgelicht_url2        = '';
	$uitgelicht_image       = '';
	$uitgelicht_label       = '';
	$uitgelicht_excerpt     = '&nbsp;';
	$skip_posts             = array(); // array with IDs for posts to be skipped in loop

	if ( 'method_auto' === get_field( 'home_row_1_cell_1_method', $theid ) ) {

		$etalage_post    = get_field( 'home_row_1_cell_1_post', $theid );
		$skip_posts[]    = $etalage_post[0]->ID;
		$etalage_excerpt = get_the_excerpt( $etalage_post[0]->ID );

		$args2 = array(
			'ID'          => $etalage_post[0]->ID,
			'cssid'       => 'etalage',
			'type'        => 'posts_featured',
			'datefield'   => false,
			'headerlevel' => 'h1',
			'itemclass'   => 'griditem griditem--textoverimage colspan-2',
		);

		$etalage = rhswp_get_grid_item( $args2 );

	} elseif ( get_field( 'home_row_1_cell_1_featured_link', $theid ) ) {
		// er is geen featured post uitgekozen; misschien zijn er wel een plaatje en link ingevoerd?

		$etalage_label = '';
		$image_ID      = '';
		$etalage_link  = get_field( 'home_row_1_cell_1_featured_link', $theid );
		$etalage_titel = $etalage_link['title'];
		if ( get_field( 'home_row_1_cell_1_featured_label', $theid ) ) {
			$etalage_label = get_field( 'home_row_1_cell_1_featured_label', $theid );
		}
		if ( get_field( 'home_row_1_cell_1_featured_image', $theid ) ) {
			$image = get_field( 'home_row_1_cell_1_featured_image', $theid );
			if ( $image ) {
				$image_ID = $image['ID'];
			}
		}
		$args2   = array(
			'cssid'              => 'etalage',
			'type'               => 'posts_manual',
			'contentblock_title' => $etalage_link['title'],
			'contentblock_url'   => $etalage_link['url'],
			'contentblock_imgid' => $image_ID,
			'contentblock_label' => $etalage_label,
			'headerlevel'        => 'h2',
			'itemclass'          => 'griditem griditem--textoverimage colspan-2',
		);
		$etalage = rhswp_get_grid_item( $args2 );
	}


	if ( 'method_auto' === get_field( 'home_row_1_cell_2_method', $theid ) ) {
		$uitgelicht_post    = get_field( 'home_row_1_cell_2_post', $theid );
		$uitgelicht_post_id = $uitgelicht_post[0]->ID;
		$uitgelicht_titel   = get_the_title( $uitgelicht_post_id );
		$uitgelicht_url2    = get_permalink( $uitgelicht_post_id );
		$uitgelicht_excerpt = get_the_excerpt( $uitgelicht_post_id );
		$uitgelicht_image   = get_the_post_thumbnail( $uitgelicht_post_id, IMAGESIZE_5x3 );
		$skip_posts[]       = $uitgelicht_post_id;
	} elseif ( get_field( 'home_row_1_cell_2_textcontent', $theid ) ) {
		$uitgelicht_titel       = _x( "Uitgelicht", 'breadcrumb', 'wp-rijkshuisstijl' );
		$uitgelicht_titel_class = ' class="visuallyhidden"';
		$uitgelicht_excerpt     = get_field( 'home_row_1_cell_2_textcontent', $theid );
		if ( get_field( 'home_row_1_cell_2_featured_image', $theid ) ) {
			$image = get_field( 'home_row_1_cell_2_featured_image', $theid );
			if ( $image['ID'] ) {
				$uitgelicht_image = wp_get_attachment_image( $image['ID'], IMAGESIZE_5x3 );
			}
		}
	}

	if ( $uitgelicht_titel || $etalage_titel ) {

		echo '<section class="grid">';
		echo $etalage;

		if ( $uitgelicht_titel ) {
			// een soort fallback: als er geen uitgelichte content is, dan tonen we de samenvatting van de etalage

			echo '<div class="griditem colspan-1 hide-on-mobile" id="uitgelicht">';
			if ( $uitgelicht_image ) {
				echo '<a href="' . $uitgelicht_url2 . '" tabindex="-1">';
				echo $uitgelicht_image;
				echo '</a>';
			}
			echo '<h2' . $uitgelicht_titel_class . '><a href="' . $uitgelicht_url2 . '">' . $uitgelicht_titel . '</a></h2>';
			if ( $uitgelicht_label ) {
				echo '<div class="label">' . $uitgelicht_label . '</div>';
			}
			echo $uitgelicht_excerpt;
			echo '</div>';

		} else {
			echo '<div class="griditem colspan-1">';
			echo $etalage_excerpt;
			echo '</div>';

		}

		echo '</section>';
	}


	$home_rows = get_field( 'home_rows', $theid );

	if ( ( is_array( $home_rows ) || is_object( $home_rows ) ) && ( $home_rows[0] != '' ) ) {


		foreach ( $home_rows as $row ) {

			$titel     = $row['home_row_title'];
			$limit     = $row['home_row_max_nr'];
			$gridclass = 'grid';

			switch ( $row['home_row_type'] ) {

				case 'free_form':
					if ( $row['home_row_freeform'] ) {

						echo '<div class="' . $gridclass . '">';
						foreach ( $row['home_row_freeform'] as $row2 ) {
							$itemclass = 'griditem colspan-1';
							$excerpt   = $row2['home_row_freeform_text'];
							$itemtitle = '<h2>' . $row2['home_row_freeform_title'] . '</h2>';
							if ( $row2['home_row_freeform_width'] ) {
								$itemclass .= ' ' . $row2['home_row_freeform_width'];
							} else {
								$itemclass .= ' colspan-1';
							}

							echo '<div class="' . $itemclass . ' container">';
							echo $itemtitle;
							echo $excerpt;
							echo '</div>';
						}
						echo '</div>';

					}

					break;
				case 'events':

					if ( class_exists( 'EM_Events' ) ) {

						$events_link = em_get_link( __( 'all events', 'events-manager' ) );
						$args        = array(
							'scope' => 'future',
							'limit' => $limit,
							'array' => true
						);

						$events = EM_Events::get( $args );

						if ( $events ) {

							echo '<div class="container">';

							if ( $titel ) {
								echo '<h2>' . $titel . '</h2>';
							}

							echo '<div class="' . $gridclass . '">';

							foreach ( $events as $event ):

								$excerpt       = get_the_excerpt( $event['post_id'] );
								$itemtitle     = '<h3><a href="' . get_the_permalink( $event['post_id'] ) . '">' . $event['event_name'] . '</a></h3>';
								$itemclass     = 'griditem colspan-1';
								$EM_Event      = new EM_Event( $event['event_id'] );
								$datum         = $EM_Event->output( '#_EVENTDATES' );
								$tijd          = $EM_Event->output( '#_EVENTTIMES' );
								$location_town = $EM_Event->output( '#_LOCATIONTOWN' );
								$location_type = $EM_Event->event_location_type;


								echo '<div class="' . $itemclass . '">';
								echo $itemtitle;
								echo $excerpt;
								if ( $datum || $tijd || $location_town || $location_type ) {

									echo '<ul class="event-meta">';
									if ( $datum ) {
										echo '<li class="event-date">' . $datum . '</li>';
									}
									if ( $tijd ) {
										echo '<li class="event-time">' . $tijd . '</li>';
									}
									if ( $location_town ) {
										echo '<li class="event-town">' . $location_town . '</li>';
									}
									if ( $location_type === 'url' ) {
										echo '<li class="event-online">' . _x( 'Online', 'event type', 'wp-rijkshuisstijl' ) . '</li>';
									}
									echo '</ul>';
								}

								echo '</div>';

							endforeach;

							echo '</div>';
							if ( $events_link ) {
								echo '<p class="more">' . $events_link . '</p>';
							}
							echo '</div>';

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

					if ( $row['home_row_type'] === $row['home_row_type'] ) {
						// alle blokken dezelfde hoogte, svp
						$gridclass .= ' stretch';
					}

					if ( $slugs ) {
						$args['tax_query'] = array(
							array(
								'taxonomy' => 'category',
								'field'    => 'term_id',
								'terms'    => $slugs,
							)
						);

						$cat_name  = get_cat_name( $slugs );
						$more_text = _x( "Alle berichten onder %s", 'readmore home', 'wp-rijkshuisstijl' );
						$more_url  = get_category_link( $slugs );
						if ( $row['home_row_readmore'] ) {
							$more_text = $row['home_row_readmore'];
						}
						if ( strpos( $more_text, '%s' ) ) {
							$more_text = sprintf( $more_text, strtolower( $cat_name ) );
						}
					}

					if ( $skip_posts ) {
						$args['post__not_in'] = $skip_posts;
					}

					$contentblockposts = new WP_query();
					$contentblockposts->query( $args );

					if ( $contentblockposts->have_posts() ) {
						$itemcounter = 0;
						echo '<div class="container">';
						if ( $titel ) {
							echo '<h2>' . $titel . '</h2>';
						}

						echo '<div class="' . $gridclass . '">';

						while ( $contentblockposts->have_posts() ) : $contentblockposts->the_post();
							$itemcounter ++;

							$contentblock_post_id = $post->ID;
							$skip_posts[]         = $contentblock_post_id;

							$args2 = array(
								'ID' => $contentblock_post_id,
							);

							if ( $row['home_row_type'] === 'posts_featured' ) {
								$args2['type']      = 'posts_featured';
								$args2['itemclass'] = 'griditem griditem--post colspan-1 griditem--post colspan-1 griditem--post colspan-1';

							} else {
								$args2['itemclass'] = 'griditem griditem--post colspan-1';
								$args2['type']      = 'posts_normal';
							}

							echo rhswp_get_grid_item( $args2 );

						endwhile;

						echo '</div>';
						echo '<p class="more"><a href="' . $more_url . '">' . $more_text . '</a></p>';
						echo '</div>';

					}

					if ( $row['home_row_type'] === 'posts_featured' ) {


						if ( $uitgelicht_titel ) {
							// een soort fallback: als er geen uitgelichte content is, dan tonen we de samenvatting van de etalage

							echo '<div class="hide-on-larger-than-mobile" aria-hidden="true">';
							echo '<h2' . $uitgelicht_titel_class . '><a href="' . $uitgelicht_url2 . '">' . $uitgelicht_titel . '</a></h2>';
							if ( $uitgelicht_image ) {
								echo '<a href="' . $uitgelicht_url2 . '" tabindex="-1" class="featured-image-link">';
								echo $uitgelicht_image;
								echo '</a>';
							}

							echo '<div class="txtcontainer">';
							if ( $uitgelicht_label ) {
								echo '<div class="label">' . $uitgelicht_label . '</div>';
							}
							echo $uitgelicht_excerpt;
							echo '</div>'; // .txtcontainer
							echo '</div>'; // .hide-on-larger-than-mobile

						} else {
							echo '<div class="griditem colspan-1">';
							echo $etalage_excerpt;
							echo '</div>';

						}

					}

					break;
			}
		}
	}


}

//========================================================================================================

