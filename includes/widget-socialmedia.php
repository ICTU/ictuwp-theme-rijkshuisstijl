<?php

/**
 *  wp-rijkshuisstijl - widget-socialmedia.php
 *  ----------------------------------------------------------------------------------
 *  De socialmedia widget
 *  ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 2.24.2
 * @desc.   Reactieformulier verlost van block elements in een <a> en verdere styling.
 * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */


//========================================================================================================
//* banner widget
class rhswp_socialmedia_widget extends WP_Widget {


	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {

		$widget_ops = array(
			'classname'   => 'social-media-widget',
			'description' => __( 'Widget met social-media-links', 'wp-rijkshuisstijl' ),
		);

		parent::__construct( 'rhswp_socialmedia_widget', RHSWP_WIDGET_SOCIALMEDIA, $widget_ops );

	}


	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance,
			array(
				'rhswp_socialmedia_widget_title'      => '',
				'rhswp_socialmedia_widget_short_text' => '',
			)
		);

		$rhswp_socialmedia_widget_title      = empty( $instance['rhswp_socialmedia_widget_title'] ) ? '' : $instance['rhswp_socialmedia_widget_title'];
		$rhswp_socialmedia_widget_short_text = empty( $instance['rhswp_socialmedia_widget_short_text'] ) ? '' : $instance['rhswp_socialmedia_widget_short_text'];


		?>

        <p><label for="<?php echo $this->get_field_id( 'rhswp_socialmedia_widget-title' ); ?>">Titel: <input
                        id="<?php echo $this->get_field_id( 'rhswp_socialmedia_widget-title' ); ?>"
                        name="<?php echo $this->get_field_name( 'rhswp_socialmedia_widget_title' ); ?>" type="text"
                        value="<?php echo esc_attr( $rhswp_socialmedia_widget_title ); ?>"/></label></p>

        <p>
            <label for="<?php echo $this->get_field_id( 'rhswp_socialmedia_widget_short_text' ) ?>"><?php _e( "Vrije tekst in widget:", 'wp-rijkshuisstijl' ) ?>
                <br/><textarea cols="33" rows="4"
                               id="<?php echo $this->get_field_id( 'rhswp_socialmedia_widget_short_text' ); ?>"
                               name="<?php echo $this->get_field_name( 'rhswp_socialmedia_widget_short_text' ); ?>"><?php echo esc_attr( $rhswp_socialmedia_widget_short_text ); ?></textarea><br>(geen HTML alsjeblieft)</label>
        </p>
		<?php

	}

	function update( $new_instance, $old_instance ) {
		$instance                                        = $old_instance;
		$instance['rhswp_socialmedia_widget_title']      = empty( $new_instance['rhswp_socialmedia_widget_title'] ) ? '' : $new_instance['rhswp_socialmedia_widget_title'];
		$instance['rhswp_socialmedia_widget_short_text'] = empty( $new_instance['rhswp_socialmedia_widget_short_text'] ) ? '' : $new_instance['rhswp_socialmedia_widget_short_text'];

		return $instance;
	}

	function widget( $args, $instance ) {


		extract( $args, EXTR_SKIP );

		$rhswp_socialmedia_widget_title      = empty( $instance['rhswp_socialmedia_widget_title'] ) ? '' : $instance['rhswp_socialmedia_widget_title'];
		$rhswp_socialmedia_widget_short_text = empty( $instance['rhswp_socialmedia_widget_short_text'] ) ? '' : $instance['rhswp_socialmedia_widget_short_text'];

		echo $before_widget;

		if ( $rhswp_socialmedia_widget_title ) {
			echo $before_title . $rhswp_socialmedia_widget_title . $after_title;
		}

		if ( $rhswp_socialmedia_widget_short_text ) {
			echo wp_strip_all_tags( $rhswp_socialmedia_widget_short_text );
		}


		echo $rhswp_socialmedia_widget_short_text;
		echo $after_widget;

	}

}

//========================================================================================================

add_filter( 'dynamic_sidebar_params', 'filter_rhswp_socialmedia_widget' );

function filter_rhswp_socialmedia_widget( $params ) {

	global $post;

	// get widget vars
	$widget_name = $params[0]['widget_name'];
	$widget_id   = $params[0]['widget_id'];

	// bail early if this widget is not the right widget
	if ( $widget_name != RHSWP_WIDGET_SOCIALMEDIA ) {
		return $params;
	}

	if ( have_rows( 'widget_socmed_links', 'widget_' . $widget_id ) ):

		$links = array();

		// Loop through rows.
		while ( have_rows( 'widget_socmed_links', 'widget_' . $widget_id ) ) : the_row();

			// Load sub field value.
			$widget_socmed_link  = get_sub_field( 'widget_socmed_link' );
			$widget_socmed_class = get_sub_field( 'widget_socmed_class' );
			$links[]             = '<li class="social-media--' . $widget_socmed_class . '"><a href="' . $widget_socmed_link['url'] . '">' . $widget_socmed_link['title'] . '</a></li>';

			// End loop.
		endwhile;

	endif;

	// link toevoegen, if any
	if ( $links ) {
		$params[0]['after_widget'] = '<ul class="social-media">' . implode( '', $links ) . '</ul>' . $params[0]['after_widget'];
	}


	// return
	return $params;

}

//========================================================================================================

function rhswp_socialmedia_widget_register() {
	return register_widget( "rhswp_socialmedia_widget" );
}

add_action( 'widgets_init', 'rhswp_socialmedia_widget_register' );

//========================================================================================================

