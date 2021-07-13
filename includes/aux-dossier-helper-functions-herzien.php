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

function my_last_updated_date( $post ) {
	$return          = '';
	$u_time          = get_the_time( 'U', $post );
	$u_modified_time = get_the_modified_time( 'U', $post );
	if ( $u_modified_time >= $u_time + 86400 ) {
		$updated_date = get_the_modified_time( get_option( 'date_format' ) );
		$updated_time = get_the_modified_time( get_option( 'time_format' ) );
		$return       = $updated_date . ' - ' . $updated_time;
	}

	return $return;
}

//========================================================================================================

function rhswp_dossier_title_show_menu( $args = '' ) {

	global $post;

	$dossier = rhswp_dossier_get_dossiercontext();

	if ( $dossier ) {

		$current_post_id         = isset( $post->ID ) ? $post->ID : 0;
		$dossier_overzichtpagina = get_field( 'dossier_overzichtpagina', $dossier );
		$datum_laatste_wijziging = get_field( 'dossier_datum_laatste_wijziging', $dossier );
		$thetitle                = rhswp_filter_alternative_title( $dossier_overzichtpagina, get_the_title( $dossier_overzichtpagina ) );


		echo '<div class="testdemotest">';

		if ( $datum_laatste_wijziging ) {
			echo '<p class="laatste-wijziging">';
			echo 'Dossier laatst gewijzigd op ' . $datum_laatste_wijziging . '<br>';
			echo '</p>';
		}

		if ( $dossier_overzichtpagina->ID == $current_post_id ) {
			echo 'Je kijkt nu naar de landingspagina voor het dossier.<br>';
			echo '<a href="' . get_term_link( $dossier ) . '">bekijk de taxonomie-info ' . $dossier->name . '</a><br>';
		} else {
			echo '<a href="' . get_the_permalink( $dossier_overzichtpagina ) . '">Bekijk ' . $thetitle . ', de landingspagina bij onderwerp ' . $dossier->name . '</a><br>';
		}

		echo '</div>';


		echo rhswp_dossier_get_onderwerpenblock( $dossier );

		$args = array(
			'cssclasses'  => 'contentblock hide-on-larger-than-mobile',
			'headerlevel' => 'h2',
			'headertekst' => 'pagesmenu verberg op desktop',
		);
		echo rhswp_dossier_get_pagesmenu( $dossier, $args );

		$args['headertekst'] = 'berichtenmenu verberg op desktop';
		echo rhswp_dossier_get_berichtenmenu( $dossier, $args );


		$args['headertekst'] = 'Documenten verberg op desktop';
		echo rhswp_dossier_get_documentenmenu( $dossier, $args );


	}
}

add_action( 'genesis_before_entry_content', 'rhswp_dossier_title_show_menu', 12 );

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
	$image_size       = IMAGESIZE_DOSSIER_HEADER;
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
		dodebug_do( ' Dit is post of search ' );
		$is_dossier = false;
	}
	if (
		( RHSWP_DOSSIERCONTEXTPOSTOVERVIEW == get_query_var( 'pagename' ) ) ||
		( RHSWP_DOSSIERCONTEXTEVENTOVERVIEW == get_query_var( 'pagename' ) ) ||
		( RHSWP_DOSSIERCONTEXTDOCUMENTOVERVIEW == get_query_var( 'pagename' ) )
	) {
		dodebug_do( 'Zo\'n bijzonder geval <a href="' . get_permalink( $post->ID ) . '">' . get_query_var( 'pagename' ) . '</a>' );
	} elseif ( ( is_singular( 'post' ) || is_singular( 'page' ) ) && ( ! has_term( '', RHSWP_CT_DOSSIER, $post->ID ) ) ) {
		// post / page zit in een dossier EN heeft een beleidskleur, dus toon plaatje van beleidskleur
		// zie functie rhswp_check_caroussel_or_featured_img, waar het plaatje getoond wordt
		dodebug_do( ' Deze post heeft geen dossier ( en ik denk dat dit <a href="' . get_permalink( $post->ID ) . '">' . get_the_title( $post->ID ) . '</a>' );
		$is_dossier = false;
	}

	if (
		( 'page_toolbox-home.php' == get_page_template_slug( get_the_ID() ) ) ||
		( 'page_digibeter-home.php' == get_page_template_slug( get_the_ID() ) ) ||
		( 'page_showalldossiers-nieuwestyling.php' == get_page_template_slug( get_the_ID() ) ) ||
		( 'page_toolbox-cyberincident.php' == get_page_template_slug( get_the_ID() ) ) ) {
		// toolbox layout: dus geen plaatje tonen
		dodebug_do( ' Verkeerde template' );
		$is_dossier = false;
	}


	if ( $is_dossier ) {
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

	if ( ( ! $is_dossier ) && ( ! $dossier ) ) {
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

function rhswp_dossier_get_onderwerpenblock( $dossier, $headerlevel = 'h3', $headertekst = 'Onderwerpen bij dit thema' ) {
	$return = '';

	if ( $dossier ) {

		$args = array(
			'taxonomy'     => RHSWP_CT_DOSSIER,
			'parent'       => $dossier->term_id,
			'hide_empty'   => true,
			'echo'         => 0,
			'hierarchical' => true,
			'title_li'     => '',
		);

		$termchildren = get_terms( RHSWP_CT_DOSSIER, $args );

		if ( ! empty( $termchildren ) && ! is_wp_error( $termchildren ) ) {

			$return = '<div class="widget widget_nav_menu testdemotest" >';
			$return .= '<' . $headerlevel . '>' . $headertekst . '</' . $headerlevel . '>';
			$return .= '<p>Dit block wordt automagisch gegenereerd voor een thema. Dat wil zeggen als onder een dossiers nog dossiers hangen.</p>';

			foreach ( $termchildren as $child ) {

				$term   = get_term_by( 'id', $child->term_id, RHSWP_CT_DOSSIER );
				$return .= rhswp_dossier_get_detailssummary( $term, 'h3' );

			}
			$return .= '</div>';

		}
	}

	return $return;

}

//========================================================================================================

function rhswp_dossier_get_documentenmenu( $dossier, $args ) {

	global $post;
	global $wp;
	$return                  = '';
	$dossier_overzichtpagina = get_field( 'dossier_overzichtpagina', $dossier );
	$current_url             = get_permalink( $dossier_overzichtpagina );
	$defaults                = array(
		'cssclasses'  => 'widget widget_nav_menu hide-on-mobile',
		'headerlevel' => 'h3',
		'headertekst' => 'Berichten en events voor dossier',
	);
	// Parse incoming $args into an array and merge it with $defaults
	$args = wp_parse_args( $args, $defaults );

	if ( $dossier ) {

		$return = '<div class="' . $args['cssclasses'] . '">';

		// check for documents ---------------------------------------------------------------------------
		$argsquery = array(
			'post_type'      => RHSWP_CPT_DOCUMENT,
			'post_status'    => 'publish',
			'posts_per_page' => - 1,
			'tax_query'      => array(
				'relation' => 'AND',
				array(
					'taxonomy' => RHSWP_CT_DOSSIER,
					'field'    => 'term_id',
					'terms'    => $dossier->term_id
				)
			)
		);


		$wp_queryposts = new WP_Query( $argsquery );

		if ( $wp_queryposts->post_count > 0 ) {
			// er zijn documenten gevonden voor dit dossier

			$titel      = sprintf( _n( '%s document', '%s documents', $wp_queryposts->post_count, 'wp-rijkshuisstijl' ), $wp_queryposts->post_count );
			$isselected = '';
			$indicator  = '';

			if ( trailingslashit( $current_url ) === trailingslashit( get_term_link( $dossier->term_id, RHSWP_CT_DOSSIER ) . RHSWP_DOSSIERCONTEXTDOCUMENTOVERVIEW ) ) {
				// de gebruiker heeft om het overzicht van documenten voor dit dossier gevraagd
				$isselected = ' class="selected case05"';
				$indicator  = $spancurrentpage_start;
			}


			$return .= '<' . $args['headerlevel'] . '>' . $titel . '</' . $args['headerlevel'] . '>';
			$return .= '<ul>';
			$return .= '<li' . $isselected . '><a href="' . get_term_link( $dossier->term_id, RHSWP_CT_DOSSIER ) . RHSWP_DOSSIERCONTEXTDOCUMENTOVERVIEW . '/">' . $indicator . _x( 'Documents', 'post types', 'wp-rijkshuisstijl' ) . '</a></li>';
			$return .= '</ul>';
		} else {
//			$return .= '<p>Er zijn geen documenten beschikbaar voor dit dossier</p>';
		}

		$return .= '</div>';

	}

	return $return;
}

//========================================================================================================

function rhswp_dossier_get_berichtenmenu( $dossier, $args ) {

	global $post;
	global $wp;

	$defaults = array(
		'cssclasses'  => 'widget widget_nav_menu hide-on-mobile',
		'headerlevel' => 'h3',
		'headertekst' => 'Berichten en events voor dossier',
	);
	// Parse incoming $args into an array and merge it with $defaults
	$args                    = wp_parse_args( $args, $defaults );
	$return                  = '';
	$isselected              = '';
	$dossier_overzichtpagina = get_field( 'dossier_overzichtpagina', $dossier );
	$current_url             = get_permalink( $dossier_overzichtpagina );

	if ( $dossier ) {
		$return = '<div class="' . $args['cssclasses'] . '">';
		$return .= '<' . $args['headerlevel'] . '>' . $args['headertekst'] . '</' . $args['headerlevel'] . '>';


		// check for posts -------------------------------------------------------------------------------
		$argsquery = array(
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => - 1,
			'tax_query'      => array(
				'relation' => 'AND',
				array(
					'taxonomy' => RHSWP_CT_DOSSIER,
					'field'    => 'term_id',
					'terms'    => $dossier->term_id
				),
			)
		);

		$wp_queryposts = new WP_Query( $argsquery );

		if ( $wp_queryposts->post_count > 0 ) {

			$return .= '<ul class="links">';

			// er zijn niet meer dan 10 berichten
			$berichten = sprintf( _n( '%s post', '%s posts', $wp_queryposts->post_count, 'wp-rijkshuisstijl' ), $wp_queryposts->post_count );
			$titel     = sprintf( __( '%s for topic %s.', 'wp-rijkshuisstijl' ), $berichten, $dossier->name );
			$threshold = get_field( 'dossier_post_overview_categor_threshold', 'option' );

			// zijn er meer dan [$threshold] berichten in dit dossier? Dan checken of we aparte categorieen moeten tonen
			if ( intval( $wp_queryposts->post_count ) >= intval( $threshold ) ) {

				$categories = get_field( 'dossier_post_overview_categories', 'option' );

				if ( $categories ) {

					// er zijn categorieen ingesteld, dus deze categorieen aflopen en een link maken
					foreach ( $categories as $category ) {

						$decategorie   = get_term( $category, 'category' );
						$argsquery     = array(
							'post_type'      => 'post',
							'post_status'    => 'publish',
							'posts_per_page' => - 1,
							'tax_query'      => array(
								'relation' => 'AND',
								array(
									'taxonomy' => RHSWP_CT_DOSSIER,
									'field'    => 'term_id',
									'terms'    => $dossier->term_id
								),
								array(
									'taxonomy' => 'category',
									'field'    => 'slug',
									'terms'    => $decategorie->slug,
								),
							)
						);
						$wp_queryposts = new WP_Query( $argsquery );

						if ( $wp_queryposts->post_count > 0 ) {

							$berichten  = sprintf( _n( '%s post', '%s posts', $wp_queryposts->post_count, 'wp-rijkshuisstijl' ), $wp_queryposts->post_count );
							$titel      = sprintf( __( '%s for topic %s and category %s.', 'wp-rijkshuisstijl' ), $berichten, $dossier->name, $decategorie->name );
							$isselected = '';
							$indicator  = '';

							if ( trailingslashit( $current_url ) === trailingslashit( get_term_link( $dossier->term_id, RHSWP_CT_DOSSIER ) . RHSWP_DOSSIERCONTEXTPOSTOVERVIEW . '/' . RHSWP_DOSSIERCONTEXTCATEGORYPOSTOVERVIEW . '/' . $decategorie->slug ) ) {
								$isselected = ' class="selected case02"';
								$indicator  = $spancurrentpage_start;
							}

							$deurl = get_permalink( $dossier_overzichtpagina );

							// TODO !! deze URL klopt nog niet en kan nog niet werken omdat nog niet goed wordt
							// gecheckt voor deze querystring
							$deurl = get_term_link( $dossier->term_id, RHSWP_CT_DOSSIER ) .
							         RHSWP_DOSSIERCONTEXTPOSTOVERVIEW . '/' .
							         RHSWP_DOSSIERCONTEXTCATEGORYPOSTOVERVIEW . '/' . $decategorie->slug;

							$return .= '<li' . $isselected . '>' .
							           '<a href="' .
							           $deurl . '/">' . $indicator . $decategorie->name . '</a></li>';

						} else {

//							$return .= '<li' . $isselected . '>maar geen berichten onder "' . $decategorie->name . '" en "' . $dossier->name . '"</li>';

						}
					}
				} else {
					// er zijn geen categorieen ingesteld
					$isselected = '';
					$indicator  = '';

					if ( trailingslashit( $current_url ) === trailingslashit( get_term_link( $dossier->term_id, RHSWP_CT_DOSSIER ) . RHSWP_DOSSIERCONTEXTPOSTOVERVIEW ) ) {
						$isselected = ' class="selected case03"';
						$indicator  = $spancurrentpage_start;
					}

					$return .= '<li' . $isselected . '><a href="' . get_term_link( $dossier->term_id, RHSWP_CT_DOSSIER ) . RHSWP_DOSSIERCONTEXTPOSTOVERVIEW . '/">' . $indicator . _x( 'Posts', 'post types', 'wp-rijkshuisstijl' ) . '</a></li>';

				}
			} else {

				// te weinig berichten om ze op te delen in aparte categorieen
				$isselected = '';
				$indicator  = '';

				if ( trailingslashit( $current_url ) === trailingslashit( get_term_link( $dossier->term_id, RHSWP_CT_DOSSIER ) . RHSWP_DOSSIERCONTEXTPOSTOVERVIEW ) ) {
					$isselected = ' class="selected case04"';
					$indicator  = $spancurrentpage_start;
				}

				$return .= '<li' . $isselected . '><a href="' . get_term_link( $dossier->term_id, RHSWP_CT_DOSSIER ) . RHSWP_DOSSIERCONTEXTPOSTOVERVIEW . '/" title="' . $titel . '">' . $indicator . _x( 'Posts', 'post types', 'wp-rijkshuisstijl' ) . '</a></li>';

			}

			$return .= '</ul>';
		} else {
//			$return .= '<p>Er zijn geen berichten beschikbaar voor dit dossier</p>';
		}

		// check for events ------------------------------------------------------------------------------
		if ( class_exists( 'EM_Events' ) ) {

			$eventargs       = array( RHSWP_CT_DOSSIER => $dossier->slug, 'scope' => 'future' );
			$eventlist       = EM_Events::output( $eventargs );
			$listitemcounter = substr_count( $eventlist, '<li' ); // 2

			if ( ( intval( $listitemcounter ) < 1 )
			     || $eventlist == get_option( 'dbem_no_events_message' )
			     || $eventlist == get_option( 'dbem_location_no_events_message' )
			     || $eventlist == get_option( 'dbem_category_no_events_message' )
			     || $eventlist == get_option( 'dbem_tag_no_events_message' ) ) {

				// no events
//				$return .= '<p>Er zijn geen evenementen aanwezig voor dit dossier</p>';

			} else {
				// some events
				$isselected = '';
				$indicator  = '';

				if ( trailingslashit( $current_url ) === trailingslashit( get_term_link( $dossier->term_id, RHSWP_CT_DOSSIER ) . RHSWP_DOSSIERCONTEXTEVENTOVERVIEW ) ) {
					$isselected = ' class="selected case06"';
					$indicator  = $spancurrentpage_start;
				}
				$return .= '<ul>';
				$return .= '<li' . $isselected . '><a href="' . get_term_link( $dossier->term_id, RHSWP_CT_DOSSIER ) . RHSWP_DOSSIERCONTEXTEVENTOVERVIEW . '/">' . $indicator . _x( 'Events', 'post types', 'wp-rijkshuisstijl' ) . '</a></li>';
				$return .= '</ul>';

			}

		}


		//------------------


		$return .= '</div>';

	}

	return $return;

}

//========================================================================================================

function rhswp_dossier_get_pagesmenu( $dossier, $args = '' ) {

	global $post;
	global $wp;

	$defaults = array(
		'cssclasses'  => 'widget widget_nav_menu hide-on-mobile',
		'headerlevel' => 'h3',
		'headertekst' => 'Menu voor dossier',
	);
	// Parse incoming $args into an array and merge it with $defaults
	$args   = wp_parse_args( $args, $defaults );
	$return = '';

	if ( $dossier ) {

		$dossier_overzichtpagina = get_field( 'dossier_overzichtpagina', $dossier );
		$menu_voor_dossier       = get_field( 'menu_pages', $dossier );

		// als een menu is ingevoerd, sorteer de pagina's
		if ( $menu_voor_dossier ) {
			$return = '<div class="' . $args['cssclasses'] . '">';
			$return .= '<' . $args['headerlevel'] . '>' . $args['headertekst'] . '</' . $args['headerlevel'] . '>';
//			$return .= '<p>Dit menu stel je in onder de taxonomie-info</p>';
			$return .= '<ul class="links">';

			if ( is_array( $menu_voor_dossier ) ) {

				if ( 'string' == gettype( $menu_voor_dossier[0] ) ) {
					// a string, so we best unserialize it.
					$menu_voor_dossier = maybe_unserialize( $menu_voor_dossier[0] ); // serialize

					if ( is_array( $menu_voor_dossier ) || is_object( $menu_voor_dossier ) ) {
						foreach ( $menu_voor_dossier as $menuitem ):
							$itemsinmenu[] = intval( $menuitem );
							$return        .= '<li>' . $menuitem . '</li>';
						endforeach;
					}
				} else {
					foreach ( $menu_voor_dossier as $menuitem ):
						// this is an object
						$itemsinmenu[] = intval( $menuitem->ID );
						$return        .= '<li><a href="' . get_the_permalink( $menuitem ) . '">' . get_the_title( $menuitem ) . '</a></li>';
					endforeach;
				}
			}

			$args['menu_voor_dossier'] = $itemsinmenu;
			$return                    .= '</ul>';
			$return                    .= '</div>';

		}

	}

	return $return;
}

//========================================================================================================

function get_term_parent_page_list( $term_id, $args = array() ) {
	$list = '';
	$taxonomy = RHSWP_CT_DOSSIER;
	$term = get_term( $term_id, $taxonomy );

	if ( is_wp_error( $term ) ) {
		return $term;
	}

	if ( ! $term ) {
		return $list;
	}

	$term_id = $term->term_id;

	$defaults = array(
		'format'    => 'name',
		'separator' => '/',
		'link'      => true,
		'inclusive' => true,
	);

	$args = wp_parse_args( $args, $defaults );

	foreach ( array( 'link', 'inclusive' ) as $bool ) {
		$args[ $bool ] = wp_validate_boolean( $args[ $bool ] );
	}

	$parents = get_ancestors( $term_id, $taxonomy, 'taxonomy' );

	if ( $args['inclusive'] ) {
		array_unshift( $parents, $term_id );
	}

	foreach ( array_reverse( $parents ) as $term_id ) {
		$parent = get_term( $term_id, $taxonomy );
		$name   = ( 'slug' === $args['format'] ) ? $parent->slug : $parent->name;

		if ( $args['link'] ) {
			$termlink = rhswp_get_pagelink_for_dossier( $parent );
			$list .= '<a href="' . esc_url( $termlink ) . '">' . $name . '</a>' . $args['separator'];
		} else {
			$list .= $name . $args['separator'];
		}
	}

	return $list;
}

//========================================================================================================

