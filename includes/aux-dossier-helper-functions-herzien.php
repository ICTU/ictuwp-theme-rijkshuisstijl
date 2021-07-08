<?php

//========================================================================================================

function rhswp_dossier_title_checker() {
	$dossier = rhswp_dossier_get_dossiercontext();

	if ( $dossier ) {
		// tonen header image voor dossier
		echo '<div class="dossier-overview">';
		echo rhswp_dossier_get_dossier_headerimage( $dossier );
		echo '</div>';

	}
}

//========================================================================================================

/*
 * Toon de headerimage voor een dossier
 */
function rhswp_dossier_get_default_image() {

	$default_image = get_field( 'site_settings_default_dossier_image', 'option' );
	return $default_image;

}

//========================================================================================================

/*
 * Toon de headerimage voor een dossier
 */
function rhswp_dossier_get_dossier_headerimage( $dossier ) {

	$uitgelicht_image = '';
	$image_size       = 'full';
	$acfid            = RHSWP_CT_DOSSIER . '_' . $dossier->term_id;

	if ( get_field( 'dossier_header_image', $acfid ) ) {
		$uitgelicht_image = get_field( 'dossier_header_image', $acfid );
	} else {
		$uitgelicht_image = rhswp_dossier_get_default_image();
	}

	if ( $uitgelicht_image ) {

		echo wp_get_attachment_image( $uitgelicht_image['ID'], $image_size );

	}
}

//========================================================================================================

/*
 * Voeg een extra class toe aan <body> als er dossiercontext getoond wordt
 */
function rhswp_dossier_append_bodyclass( $classes ) {

	if ( rhswp_dossier_get_dossiercontext() ) {
		$classes[] = 'in-dossier-context';
	}

	return $classes;

}

add_filter( 'body_class', 'rhswp_dossier_append_bodyclass' );

//========================================================================================================

/*
 * Deze functie checkt of op de pagina de context voor een dossier getoond moet worden of niet. Indien ja:
 * tonen van een illustratie
 */
function rhswp_dossier_get_dossiercontext() {

	global $post;

	$is_dossier = true;
	$dossier    = '';
//	dodebug_do( ' rhswp_dossier_get_dossiercontext check ' );

	if ( ! taxonomy_exists( RHSWP_CT_DOSSIER ) ) {
		// niks doen, want dossier bestaat niet
//		dodebug_do( RHSWP_CT_DOSSIER . ' bestaat niet ' );
		$is_dossier = false;
	}

	if ( ! is_object( $post ) ) {
		// niks doen, want dit is geen post (bijv. 404 page)
//		dodebug_do( ' Dit is geen post ' );
		$is_dossier = false;
	}
	if ( is_posts_page() || is_search() ) {
		// niks doen, voor search-pagina, voor berichten-pagina
//		dodebug_do( ' Dit is post of search ' );
		$is_dossier = false;
	}

	if ( ! has_term( '', RHSWP_CT_DOSSIER, get_the_id() ) ) {
		// post / page zit in een dossier EN heeft een beleidskleur, dus toon plaatje van beleidskleur
		// zie functie rhswp_check_caroussel_or_featured_img, waar het plaatje getoond wordt
//		dodebug_do( ' Deze post heeft geen dossier ' );
		$is_dossier = false;
	}

	if (
		( 'page_toolbox-home.php' == get_page_template_slug( get_the_ID() ) ) ||
		( 'page_digibeter-home.php' == get_page_template_slug( get_the_ID() ) ) ||
		( 'page_showalldossiers-nieuwestyling.php' == get_page_template_slug( get_the_ID() ) ) ||
		( 'page_toolbox-cyberincident.php' == get_page_template_slug( get_the_ID() ) ) ) {
		// toolbox layout: dus geen plaatje tonen
//		dodebug_do( ' Verkeerde template' );
		$is_dossier = false;
	}
//	dodebug_do( ' rhswp_dossier_get_dossiercontext result "' . $is_dossier . '"' );

	if ( ! $is_dossier ) {
		return false;
	} else {
		// checken of dit een post is en is_single() en of in de URL de juiste dossier-contetxt is meegegeven.
		$posttype  = get_post_type();
		$loop      = rhswp_get_context_info();
		$tellertje = 1;

		if ( 'single' == $loop && get_query_var( RHSWP_CT_DOSSIER ) ) {
			// het is een single en het dossier is uit de queryvar te halen

			if ( get_query_var( RHSWP_DOSSIERPOSTCONTEXT ) ) {
				$url           = get_query_var( RHSWP_DOSSIERPOSTCONTEXT );
				$contextpageID = url_to_postid( $url );
				$dossier_terms = get_the_terms( $contextpageID, RHSWP_CT_DOSSIER );

				$args['markerforclickableactivepage'] = $contextpageID;

				if ( $dossier_terms && ! is_wp_error( $dossier_terms ) ) {
					// het dossier bestaat
					$dossier = array_pop( $dossier_terms );
				}
			} elseif ( get_query_var( RHSWP_CT_DOSSIER ) ) {
				// het is geen single, maar het dossier is uit de queryvar te halen
				$dossier = get_term_by( 'slug', get_query_var( RHSWP_CT_DOSSIER ), RHSWP_CT_DOSSIER );
			}
		} // ( 'single' == $loop && get_query_var( RHSWP_CT_DOSSIER ) )
		elseif ( 'page' == $loop && get_query_var( RHSWP_CT_DOSSIER ) ) {
			// het is een pagina en het dossier is uit de query var te halen
			if (
				( RHSWP_DOSSIERCONTEXTPOSTOVERVIEW == get_query_var( 'pagename' ) ) ||
				( RHSWP_DOSSIERCONTEXTEVENTOVERVIEW == get_query_var( 'pagename' ) ) ||
				( RHSWP_DOSSIERCONTEXTDOCUMENTOVERVIEW == get_query_var( 'pagename' ) )
			) {
				$dossier = get_term_by( 'slug', get_query_var( RHSWP_CT_DOSSIER ), RHSWP_CT_DOSSIER );
			}

		} // ( 'page' == $loop && get_query_var( RHSWP_CT_DOSSIER ) ) {
		elseif ( RHSWP_CPT_EVENT == $posttype && 'single' == $loop ) {
			// niks doen voor een single event
			return false;
		} elseif ( 'archive' == $loop ) {
			// niks doen voor een archive
			return false;
		} elseif ( 'category' == $loop ) {
			// niks doen voor een category archive
			return false;
		} elseif ( 'tag' == $loop ) {
			// niks doen voor een tag archive
			return false;
		} elseif ( 'tax' == $loop ) {
			// het is een andersoortige taxonomie

			if ( is_tax( RHSWP_CT_DOSSIER ) ) {
				// sterker nog, het is een dossierpagina
				$currentID = get_queried_object()->term_id;
				$dossier   = get_term( $currentID, RHSWP_CT_DOSSIER );
			}
		} else {
			// het is iets heeeeeeel anders

			if ( is_singular( 'page' ) || ( is_singular( 'post' ) && ( isset( $wp_query->query_vars['category_name'] ) ) && ( get_query_var( RHSWP_CT_DOSSIER ) ) ) ) {

				// dus:
				// of: het is een pagina maar we kunnen niks uit de queryvar halen
				// of: het is een single bericht en we kunnen iets uit category_name EN iets met de queryvar voor het dossier
				// get the dossier for pages OR for posts for which a context was provided

				$currentID     = $post->ID;
				$dossier_terms = get_the_terms( $currentID, RHSWP_CT_DOSSIER );
				$parentID      = wp_get_post_parent_id( $currentID );
				$parent        = get_post( $parentID );

				if ( $dossier_terms && ! is_wp_error( $dossier_terms ) ) {
					$dossier = array_pop( $dossier_terms );
				}

				if ( is_single() && 'post' == $posttype ) {
					dodebug_do( 'ja, is single en post' );
				}
			} else {
//				dodebug_do( 'ja, is single en post maar geen cat noch dossier' );
			}
		}

	}

	if ( ! $is_dossier ) {
		return false;
	} else {
		return $dossier;
	}

}

//========================================================================================================

function rhswp_dossier_get_pagelink( $theobject, $args ) {

	global $wp;
	global $tellertje;

	$tellertje ++;
	$childpages = [];

	if ( ! taxonomy_exists( RHSWP_CT_DOSSIER ) ) {
		return;
	}

	if (
		is_tax() ||
		( RHSWP_DOSSIERCONTEXTPOSTOVERVIEW == get_query_var( 'pagename' ) ) ||
		( RHSWP_DOSSIERCONTEXTEVENTOVERVIEW == get_query_var( 'pagename' ) ) ||
		( RHSWP_DOSSIERCONTEXTDOCUMENTOVERVIEW == get_query_var( 'pagename' ) )
	) {

		$pagerequestedbyuser = 1;
		//dodebug_do('rhswp_dossier_get_pagelink: is tax, page = ' . $pagerequestedbyuser );
	} elseif ( isset( $args['currentpageid'] ) && $args['currentpageid'] ) {
		$pagerequestedbyuser = $args['currentpageid'];
		//dodebug_do('rhswp_dossier_get_pagelink: set \$pagerequestedbyuser: ' . $args['currentpageid'] );
	} else {

		if ( 'page' == get_post_type() ) {
			// for pages get $pagerequestedbyuser based on current page slug
			$slug = add_query_arg( array(), $wp->request );

			$pagerequestedbyuser = get_postid_by_slug( $slug, 'page' );
			//dodebug_do('rhswp_dossier_get_pagelink: ELSE PAGE set \$pagerequestedbyuser: to get_the_id() / pagerequestedbyuser=' . $pagerequestedbyuser . ' / slug=' . $slug );
		} else {
			$pagerequestedbyuser = get_the_id();
			//dodebug_do('rhswp_dossier_get_pagelink: ELSE set \$pagerequestedbyuser: to get_the_id()' );
		}

	}

	// use alternative title?
	if ( isset( $args['preferedtitle'] ) && $args['preferedtitle'] ) {
		$maxposttitle = $args['preferedtitle'];
	} else {
		$maxposttitle = $theobject->post_title;
	}

	if ( isset( $args['maxlength'] ) && $args['maxlength'] ) {
		$maxlength = $args['maxlength'];
	} else {
		$maxlength = 65;
	}

	if ( strlen( $maxposttitle ) > $maxlength ) {
		$maxposttitle = substr( $maxposttitle, 0, $maxlength ) . ' (...)';
	}

	$current_menuitem_id = isset( $theobject->ID ) ? $theobject->ID : 0;

	$pagetemplateslug = basename( get_page_template_slug( $current_menuitem_id ) );

	$selectposttype = '';
	$checkpostcount = false;
	$addlink        = false;

	// IS GEPUBLICEERD?
	$poststatus = get_post_status( $current_menuitem_id );

	if ( 'page_dossiersingleactueel.php' == $pagetemplateslug ) {
		$selectposttype = 'post';
		$checkpostcount = true;
	} elseif ( 'page_dossier-document-overview.php' == $pagetemplateslug ) {
		$selectposttype = RHSWP_CPT_DOCUMENT;
		$checkpostcount = true;
	} elseif ( 'page_dossier-events-overview.php' == $pagetemplateslug ) {
		$selectposttype = RHSWP_CPT_EVENT;
		$checkpostcount = true;
	} else {
		$selectposttype = '';
		$checkpostcount = false;
		$addlink        = true;
	}

	if ( $poststatus != 'publish' ) {
		$addlink = false;
	}

	if ( $checkpostcount && $selectposttype ) {

		if ( $selectposttype == 'pagina-met-onderliggende-paginas' ) {

			$args    = array(
				'child_of'     => $current_menuitem_id,
				'parent'       => $current_menuitem_id,
				'hierarchical' => 0,
				'sort_column'  => 'menu_order',
				'sort_order'   => 'asc'
			);
			$mypages = get_pages( $args );

			if ( count( $mypages ) > 0 ) {
				$addlink = true;

				// we have child pages. Save this for checking if we are displaying any of its parents
				foreach ( $mypages as $childpage ):
					$childpages[] = $childpage->ID;
				endforeach;

			}
		} else {

			$filter    = get_field( 'wil_je_filteren_op_categorie_op_deze_pagina', $current_menuitem_id );
			$filters   = get_field( 'kies_de_categorie_waarop_je_wilt_filteren', $current_menuitem_id );
			$argsquery = array(
				'post_type' => $selectposttype,
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => RHSWP_CT_DOSSIER,
						'field'    => 'term_id',
						'terms'    => $args['theterm']
					)
				)
			);

			if ( RHSWP_CPT_EVENT == $selectposttype ) {
				if ( class_exists( 'EM_Events' ) ) {
					$eventlist = EM_Events::output( array( RHSWP_CT_DOSSIER => $args['theterm'] ) );

					if ( $eventlist == get_option( 'dbem_no_events_message' ) ) {
						// er zijn dus geen evenementen
						$addlink = false;
					} else {
						$addlink = true;
					}
				}
			} else {

				if ( $filter !== 'ja' ) {
					// no filtering, no other arguments needed
				} else {
					// yes! Do filtering

					if ( $filters ) {

						$slugs = array();

						foreach ( $filters as $filter ):
							$terminfo = get_term_by( 'id', $filter, 'category' );
							$slugs[]  = $terminfo->slug;
						endforeach;

						$argsquery = array(
							'post_type' => $selectposttype,
							'tax_query' => array(
								'relation' => 'AND',
								array(
									'taxonomy' => RHSWP_CT_DOSSIER,
									'field'    => 'term_id',
									'terms'    => $args['theterm']
								),
								array(
									'taxonomy' => 'category',
									'field'    => 'slug',
									'terms'    => $slugs,
								)
							)
						);
					}
				}

				$wp_query = new WP_Query( $argsquery );

				if ( $wp_query->have_posts() ) {
					if ( $wp_query->post_count > 0 ) {
						$addlink = true;
					}
				}
			}
		}
	} else {
		// no $checkpostcount, no special page templates
	}

	// haal de ancestors op voor de huidige pagina
	$ancestors = get_post_ancestors( $pagerequestedbyuser );

	// check of the parent niet al ergens in het menu voorkomt
	$postparent = wp_get_post_parent_id( $pagerequestedbyuser );

	$komtvoorinderestvanmenu_en_isnietdehuidigepagina = false;

	$spancurrentpage_start = '<i class="visuallyhidden">' . _x( "You are on this page: ", "Label dossier navigatie", 'wp-rijkshuisstijl' ) . ' </i>';

	if ( isset( $args['menu_voor_dossier'] ) && is_array( $args['menu_voor_dossier'] ) ) {
		if ( in_array( $pagerequestedbyuser, $args['menu_voor_dossier'] ) ) {
			// de gevraagde pagina komt voor in het menu
			if ( in_array( $postparent, $args['menu_voor_dossier'] ) ) {
				$komtvoorinderestvanmenu_en_isnietdehuidigepagina = true;
			}
		}
	}

	if (
		( RHSWP_DOSSIERCONTEXTPOSTOVERVIEW == get_query_var( 'pagename' ) ) ||
		( RHSWP_DOSSIERCONTEXTEVENTOVERVIEW == get_query_var( 'pagename' ) ) ||
		( RHSWP_DOSSIERCONTEXTDOCUMENTOVERVIEW == get_query_var( 'pagename' ) )
	) {

		$komtvoorinderestvanmenu_en_isnietdehuidigepagina = true;
	}

	if ( intval( $pagerequestedbyuser ) == intval( $current_menuitem_id ) ) {
		// the user asked for this particular page / post
		return '<li class="selected case07"><span>' . $spancurrentpage_start . $maxposttitle . '</span></li>';
	} else {
		// this is not the currently active page

		if ( $addlink ) {
			// so we should show the link

			if ( isset( $args['markerforclickableactivepage'] ) && $args['markerforclickableactivepage'] == $current_menuitem_id ) {
				// this is requested page itself
				return '<li class="selected case08"><a href="' . get_permalink( $current_menuitem_id ) . '">' . $spancurrentpage_start . $maxposttitle . '</a></li>';

			} elseif ( $current_menuitem_id && isset( $args['dossier_overzichtpagina'] ) && $args['dossier_overzichtpagina'] && in_array( $current_menuitem_id, $ancestors ) && ( $args['dossier_overzichtpagina'] != $current_menuitem_id ) ) {
				// user requested a page that is a child of the current menu item
				return '<li class="selected case09"><a href="' . get_permalink( $current_menuitem_id ) . '">' . $spancurrentpage_start . $maxposttitle . '</a></li>';

			} elseif ( wp_get_post_parent_id( $pagerequestedbyuser ) == $current_menuitem_id && ( ! $komtvoorinderestvanmenu_en_isnietdehuidigepagina ) ) {
				// this is the direct parent of the requested page
				return '<li class="case10"><a href="' . get_permalink( $current_menuitem_id ) . '">' . $spancurrentpage_start . $maxposttitle . '</a></li>';

			} elseif ( in_array( $pagerequestedbyuser, $childpages ) ) {
				// this is a child of the current menu item
				return '<li class="selected case11"><a href="' . get_permalink( $current_menuitem_id ) . '">' . $spancurrentpage_start . $maxposttitle . '</a></li>';

			} else {
				// this menu item should be clickable
				return '<li><a href="' . get_permalink( $current_menuitem_id ) . '">' . $maxposttitle . '</a></li>';

			}
		} // if ( $addlink ) {
	}

}

//========================================================================================================
