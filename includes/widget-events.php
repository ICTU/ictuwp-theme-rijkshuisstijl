<?php

// * Rijkshuisstijl (Digitale Overheid) - widget-events.php
// * ----------------------------------------------------------------------------------
// * Widget for events
// * ----------------------------------------------------------------------------------
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 2.2.1
// * @desc.   Vertaling bijgewerkt met oog op Engelstalige site.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl


class GC_event_widget extends WP_Widget {

	var $defaults;

	/** constructor */
	public function __construct() {
		$this->defaults           = array(
			'title'           => __( '(DO) Eventwidget', 'wp-rijkshuisstijl' ),
			'scope'           => 'future',
			'order'           => 'ASC',
			'limit'           => 5,
			'category'        => 0,
			'nolistwrap'      => false,
			'orderby'         => 'event_start_date,event_start_time,event_name',
			'all_events'      => 0,
			'all_events_text' => __( 'bekijk agenda', 'wp-rijkshuisstijl' ),
			'no_events_text'  => '<li>' . __( 'De agenda is leeg', 'wp-rijkshuisstijl' ) . '</li>'
		);
		$this->em_orderby_options = apply_filters( 'em_settings_events_default_orderby_ddm', array(
			'event_start_date,event_start_time,event_name' => __( 'start date, start time, event name', 'wp-rijkshuisstijl' ),
			'event_name,event_start_date,event_start_time' => __( 'name, start date, start time', 'wp-rijkshuisstijl' ),
			'event_name,event_end_date,event_end_time'     => __( 'name, end date, end time', 'wp-rijkshuisstijl' ),
			'event_end_date,event_end_time,event_name'     => __( 'end date, end time, event name', 'wp-rijkshuisstijl' ),
		) );


		$widget_ops = array(
			'classname'   => 'event-widget',
			'description' => __( 'Toont een lijst van events', 'wp-rijkshuisstijl' ),
		);


		parent::__construct( 'rhswp_event_widget', '(DO) Eventwidget', $widget_ops );
	}

	/** @see WP_Widget::widget */
	function widget( $args, $instance ) {
		$instance = array_merge( $this->defaults, $instance );
		$instance = $this->fix_scope( $instance ); // depcreciate

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'];
			echo apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
			echo $args['after_title'];
		}

		//remove owner searches
		$instance['owner'] = false;

		if ( ! empty( $instance['do_show_2excerpt'] ) ) {
			$show_excerpt = true;
		} else {
			$show_excerpt = false;
		}

		if ( ! preg_match( '/^<li/i', trim( $instance['no_events_text'] ) ) ) {
			$instance['no_events_text'] = '<li>' . $instance['no_events_text'] . '</li>';
		}

		//add li tags to old widgets that have no forced li wrappers
		if ( ! preg_match( '/^<li/i', trim( $instance['no_events_text'] ) ) ) {
			$instance['no_events_text'] = '<li>' . $instance['no_events_text'] . '</li>';
		}

		//orderby fix for previous versions with old orderby values
		if ( ! array_key_exists( $instance['orderby'], $this->em_orderby_options ) ) {
			//replace old values
			$old_vals = array(
				'name'       => 'event_name',
				'end_date'   => 'event_end_date',
				'start_date' => 'event_start_date',
				'end_time'   => 'event_end_time',
				'start_time' => 'event_start_time'
			);

			foreach ( $old_vals as $old_val => $new_val ) {
				$instance['orderby'] = str_replace( $old_val, $new_val, $instance['orderby'] );
			}
		}

		//get events
		$events   = EM_Events::get( apply_filters( 'em_widget_events_get_args', $instance ) );
		$icounter = 0;

		if ( count( $events ) > 0 ) {

			echo '<div class="bg-color">';

			foreach ( $events as $event ) {

				$icounter ++;

				if ( $show_excerpt ) {
					if ( $icounter == 1 ) {
						echo '<section class="entry first" itemscope itemtype="http://schema.org/Event">';
					} else {
						echo '<section class="entry" itemscope itemtype="http://schema.org/Event">';
					}
				}

				echo '<a itemprop="url" href="';
				echo get_permalink( $event->post_id );
				echo '">';

				$eventstart = strtotime( $event->event_start_date );
				$eventend   = strtotime( $event->event_end_date );

				if ( date( "Y" ) == date_i18n( 'Y', $eventstart ) ) {
					$jaar = '';
				} else {
					$jaar = '<span class="jaar">' . get_the_date( 'Y' ) . '</span>';
				}


				if ( $show_excerpt ) {
					echo '<header>';
				}

				echo '<h4 class="entry-title" itemprop="name">';
				echo $event->event_name;
				echo '</h4>';


				echo '<p class="tijdenplaats">';

				echo '<meta itemprop="startDate" content="' . esc_attr( date( 'c', $eventstart ) ) . '"><span class="date-badge">' . $event->output( '#_EVENTDATES' ) . '</span>';

				if ( $event->output( '#_LOCATIONNAME' ) ) {
					echo '<span class="event-location">' . $event->output( '#_LOCATIONNAME' ) . '</span>';
				}

				echo '</p>';


				if ( $show_excerpt ) {
					echo '</header>';
					echo '<div class="excerpt" itemprop="description">';
					echo $event->output( '#_EVENTEXCERPT{20}' );
					echo '</div>';
				}
				echo '</a>';

				if ( $show_excerpt ) {
					echo '</section>';
				}

			}

			echo '</div>';

		} else {
			echo $instance['no_events_text'];
		}

		if ( ! empty( $instance['all_events'] ) ) {
			$events_link = ( ! empty( $instance['all_events_text'] ) ) ? viezelinks( $instance['all_events_text'] ) : viezelinks( __( 'all events', 'wp-rijkshuisstijl' ) );
			echo $events_link;
		}

		echo $args['after_widget'];

	}

	/** @see WP_Widget::update */
	function update( $new_instance, $old_instance ) {
		foreach ( $this->defaults as $key => $value ) {
			if ( ! isset( $new_instance[ $key ] ) ) {
				$new_instance[ $key ] = $value;
			}
			//make sure the no locations text are wrapped with li tags
			if ( ( $key == 'no_events_text' ) && ! preg_match( '/^<li/i', trim( $new_instance[ $key ] ) ) ) {
				$new_instance[ $key ] = '<li>' . force_balance_tags( $new_instance[ $key ] ) . '</li>';
			}
			//balance tags and sanitize output
			if ( in_array( $key, array( 'no_events_text', 'all_events_text' ) ) ) {
				$new_instance[ $key ] = force_balance_tags( wp_kses_post( $new_instance[ $key ] ) );
			}
		}

		return $new_instance;
	}

	/** @see WP_Widget::form */
	function form( $instance ) {
		$instance = array_merge( $this->defaults, $instance );
		$instance = $this->fix_scope( $instance ); // depcreciate
		?>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Widgettitel', 'wp-rijkshuisstijl' ); ?>
				: </label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>"
				   name="<?php echo $this->get_field_name( 'title' ); ?>"
				   value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat"/>
		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php esc_html_e( 'Maximum aantal events', 'wp-rijkshuisstijl' ); ?>
				: </label>
			<input type="text" id="<?php echo $this->get_field_id( 'limit' ); ?>"
				   name="<?php echo $this->get_field_name( 'limit' ); ?>" size="3"
				   value="<?php echo esc_attr( $instance['limit'] ); ?>"/>
		</p>
		<p>

			<label
				for="<?php echo $this->get_field_id( 'scope' ); ?>"><?php esc_html_e( 'Scope', 'wp-rijkshuisstijl' ); ?>
				: </label><br/>
			<select id="<?php echo $this->get_field_id( 'scope' ); ?>"
					name="<?php echo $this->get_field_name( 'scope' ); ?>" class="widefat">
				<?php foreach ( em_get_scopes() as $key => $value ) : ?>
					<option
						value='<?php echo esc_attr( $key ); ?>' <?php echo ( $key == $instance['scope'] ) ? "selected='selected'" : ''; ?>>
						<?php echo esc_html( $value ); ?>
					</option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'order' ); ?>"><?php esc_html_e( 'Sortering', 'wp-rijkshuisstijl' ); ?>
				: </label>
			<select id="<?php echo $this->get_field_id( 'orderby' ); ?>"
					name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat">
				<?php foreach ( $this->em_orderby_options as $key => $value ) : ?>
					<option
						value='<?php echo esc_attr( $key ); ?>' <?php echo ( ! empty( $instance['orderby'] ) && $key == $instance['orderby'] ) ? "selected='selected'" : ''; ?>>
						<?php echo esc_html( $value ); ?>
					</option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'order' ); ?>"><?php esc_html_e( 'Sorteervolgorde', 'wp-rijkshuisstijl' ); ?>
				: </label>
			<select id="<?php echo $this->get_field_id( 'order' ); ?>"
					name="<?php echo $this->get_field_name( 'order' ); ?>" class="widefat">
				<?php
				$order_options = apply_filters( 'GC_event_widget_order_ddm', array(
					'ASC'  => __( 'Aflopend', 'wp-rijkshuisstijl' ),
					'DESC' => __( 'Oplopend', 'wp-rijkshuisstijl' )
				) );
				?>
				<?php foreach ( $order_options as $key => $value ) : ?>
					<option
						value='<?php echo esc_attr( $key ); ?>' <?php echo ( $key == $instance['order'] ) ? "selected='selected'" : ''; ?>>
						<?php echo esc_html( $value ); ?>
					</option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'category' ); ?>"><?php esc_html_e( 'Categorie-filter', 'wp-rijkshuisstijl' ); ?>
				: </label>
			<input type="text" id="<?php echo $this->get_field_id( 'category' ); ?>" class="widefat"
				   name="<?php echo $this->get_field_name( 'category' ); ?>" size="3"
				   value="<?php echo esc_attr( $instance['category'] ); ?>"/><br/>
			<em><?php esc_html_e( '1,2,3 or 2 (0 = all)', 'wp-rijkshuisstijl' ); ?> </em>
		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'all_events' ); ?>"><?php esc_html_e( 'Link naar agenda-overzicht toevoegen?', 'wp-rijkshuisstijl' ); ?>
				: </label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'all_events' ); ?>"
				   name="<?php echo $this->get_field_name( 'all_events' ); ?>" <?php echo ( ! empty( $instance['all_events'] ) && $instance['all_events'] ) ? 'checked' : ''; ?>
				   class="widefat">
		</p>
		<p id="<?php echo $this->get_field_id( 'all_events' ); ?>-section">
			<label
				for="<?php echo $this->get_field_id( 'all_events' ); ?>"><?php esc_html_e( 'Linktekst voor agenda-overzicht', 'wp-rijkshuisstijl' ); ?>
				: </label>
			<input type="text" id="<?php echo $this->get_field_id( 'all_events_text' ); ?>"
				   name="<?php echo $this->get_field_name( 'all_events_text' ); ?>"
				   value="<?php echo esc_attr( $instance['all_events_text'] ); ?>">
		</p>
		<!--
  <p>
    <label for="<?php echo $this->get_field_id( 'do_show_2excerpt' ); ?>"><?php esc_html_e( 'Samenvatting tonen?', 'wp-rijkshuisstijl' ); ?>: </label>
    <input type="checkbox" id="<?php echo $this->get_field_id( 'do_show_2excerpt' ); ?>" name="<?php echo $this->get_field_name( 'do_show_2excerpt' ); ?>" <?php echo ( ! empty( $instance['do_show_2excerpt'] ) && $instance['do_show_2excerpt'] ) ? 'checked' : ''; ?> value="1" class="widefat">
  </p>
-->
		<script type="text/javascript">
			jQuery('#<?php echo $this->get_field_id( 'all_events' ); ?>').change(function () {
				if (this.checked) {
					jQuery(this).parent().next().show();
				} else {
					jQuery(this).parent().next().hide();
				}
			}).trigger('change');
		</script>

		<p>
			<label
				for="<?php echo $this->get_field_id( 'no_events_text' ); ?>"><?php _e( 'Tekst als er niets in de agenda staat', 'wp-rijkshuisstijl' ); ?>
				: </label>
			<input type="text" id="<?php echo $this->get_field_id( 'no_events_text' ); ?>"
				   name="<?php echo $this->get_field_name( 'no_events_text' ); ?>"
				   value="<?php echo esc_attr( $instance['no_events_text'] ); ?>">
		</p>
		<?php
	}

	/**
	 * Backwards compatability for an old setting which is now just another scope.
	 *
	 * @param unknown_type $instance
	 *
	 * @return string
	 */
	function fix_scope( $instance ) {
		if ( ! empty( $instance['time_limit'] ) && is_numeric( $instance['time_limit'] ) && $instance['time_limit'] > 1 ) {
			$instance['scope'] = $instance['time_limit'] . '-months';
		} elseif ( ! empty( $instance['time_limit'] ) && $instance['time_limit'] == 1 ) {
			$instance['scope'] = 'month';
		} elseif ( ! empty( $instance['time_limit'] ) && $instance['time_limit'] == 'no-limit' ) {
			$instance['scope'] = 'all';
		}

		return $instance;
	}
}


function GC_event_widget_register() {
	return register_widget( "GC_event_widget" );
}

if ( function_exists( 'em_get_scopes' ) ) {
	add_action( 'widgets_init', 'GC_event_widget_register' );
}


//add_filter( 'em_get_link', 'viezelinks', 999 );

function viezelinks( $text = '' ) {
	$text = ( $text == '' ) ? get_option( "dbem_events_page_title" ) : $text;
	$text = ( $text == '' ) ? _x( "Events", 'post types', 'wp-rijkshuisstijl' ) : $text; //In case options aren't there....

	return '<p class="more"><a href="' . EM_URI . '">' . $text . '</a></p>';
}

?>
