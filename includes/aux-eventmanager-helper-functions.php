<?php

/**
 *  Rijkshuisstijl (Digitale Overheid) - eventmanager-helper-functions.php
 *  ----------------------------------------------------------------------------------
 *  functies ten behoeve van event-manager plugin
 *  ----------------------------------------------------------------------------------
 * // *
 *  @author  Paul van Buuren
 *  @license GPL-2.0+
 *  @package wp-rijkshuisstijl
 *  @version 2.12.21
 *  @desc.   Filter toegevoegd voor Event Manager-plugin: melding of event al afgelopen is.
 *  @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */


//========================================================================================================

// @since 2.12.21

add_filter( 'em_location_output_placeholder', 'mju_fn_eventmanager_styles_placeholders', 1, 3 );

add_filter( 'em_event_output_placeholder', 'mju_fn_eventmanager_styles_placeholders', 1, 3 );

add_filter( 'em_category_output_placeholder', 'mju_fn_eventmanager_styles_placeholders', 1, 3 );

add_filter( 'em_booking_output_placeholder', 'mju_fn_eventmanager_salutation', 1, 3 );

//========================================================================================================

function mju_fn_eventmanager_styles_placeholders( $replace, $EM_Event, $result ) {

	// @since 2.12.21

	global $EM_Event;
	global $post;

	switch ( $result ) {

		case '#_AVAILABILITYCHECK':
		case '#_AVAILABILITYCHECK_LI':
			// deze placeholder toont een tekst bij evenementen die al afgelopen zijn
			// Dit ter voorkoming van klachten van mensen die denken dat een afgelopen evenement
			// niet afgelopen is.
			$is_open           = $EM_Event->get_bookings()->is_open(); //whether there are any available tickets right now
			$datum_start_event = strtotime( $EM_Event->event_start_date . ' ' . $EM_Event->event_start_time );
			$datum_end_date    = strtotime( $EM_Event->event_end_date . ' ' . $EM_Event->event_end_time );
			$datum_vandaag     = strtotime( date( "Y-m-d" ) );
			$prefix            = 'span';
			$suffix           = 'span';
			if ( '#_AVAILABILITYCHECK_LI' === $result ) {
				$prefix  = 'li';
				$suffix = 'li';
			}

			// event is eerder gestart dan vandaag (ie. in het verleden....)
			if ( $datum_end_date < $datum_vandaag ) {
				return '<' . $prefix . ' class="passed-enddate">' .  _x( 'Afgelopen', 'Melding bij een event', 'wp-rijkshuisstijl' ) . '</' . $suffix . '>';
			} elseif ( $datum_start_event < $datum_vandaag ) {
				return '';
//				return '<' . $prefix . ' class="started-not-ended">' .  _x( 'Bezig', 'Melding bij een event', 'wp-rijkshuisstijl' ) . '</' . $suffix . '>';
			} else {
				return '';
			}

			break;

		case '#_LOCATIONONLINE':

			$location_type = $EM_Event->event_location_type;
			if ( $location_type === 'url' ) {
				return $location_type . ' (1)<li class="event-online">' . _x( 'Online', 'event type', 'wp-rijkshuisstijl' ) . '</li>';
			} else {
				return '';
			}
			break;

	}

	return $replace;

}

//========================================================================================================
