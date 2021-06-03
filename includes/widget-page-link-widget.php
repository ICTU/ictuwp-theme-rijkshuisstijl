<?php

/**
 *  wp-rijkshuisstijl - widget-page-link-widget.php
 *  ----------------------------------------------------------------------------------
 *  voor als je niet weet waar je bent. Als je jezelf zoekt, of als je
 *  gewoon in z'n algemeenheid de site probeert stuk te maken.
 *  ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 2.0.11
 * @desc.   Aanpassingen aan div. widgets + bugfix voor widet-banner
 * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */


//========================================================================================================
//* banner widget
class rhswp_page_widget extends WP_Widget {


	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {

		$widget_ops = array(
			'classname'   => 'page-link-widget',
			'description' => __( 'Korte tekst met verwijzing naar een pagina.', 'wp-rijkshuisstijl' ),
		);

		parent::__construct( 'rhswp_page_widget', RHSWP_WIDGET_LINK_TO_SINGLE_PAGE, $widget_ops );

	}


	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance,
			array(
				'rhswp_page_widget_title'         => '',
				'rhswp_page_widget_short_text'    => '',
				'rhswp_page_widget_page_linktext' => '',
				'rhswp_page_widget_page_link'     => ''
			)
		);

		$rhswp_page_widget_title         = empty( $instance['rhswp_page_widget_title'] ) ? '' : $instance['rhswp_page_widget_title'];
		$rhswp_page_widget_short_text    = empty( $instance['rhswp_page_widget_short_text'] ) ? '' : $instance['rhswp_page_widget_short_text'];
		$rhswp_page_widget_page_link     = empty( $instance['rhswp_page_widget_page_link'] ) ? '' : $instance['rhswp_page_widget_page_link'];
		$rhswp_page_widget_page_linktext = empty( $instance['rhswp_page_widget_page_linktext'] ) ? _x( "Meer lezen", 'Widget page-link: default linktekst', 'wp-rijkshuisstijl' ) : $instance['rhswp_page_widget_page_linktext'];


		?>

		<p><label for="<?php echo $this->get_field_id( 'rhswp_page_widget-title' ); ?>">Titel: <input
					id="<?php echo $this->get_field_id( 'rhswp_page_widget-title' ); ?>"
					name="<?php echo $this->get_field_name( 'rhswp_page_widget_title' ); ?>" type="text"
					value="<?php echo esc_attr( $rhswp_page_widget_title ); ?>"/></label></p>

		<p>
			<label
				for="<?php echo $this->get_field_id( 'rhswp_page_widget_short_text' ) ?>"><?php _e( "Vrije tekst in widget:", 'wp-rijkshuisstijl' ) ?>
				<br/><textarea cols="33" rows="4"
							   id="<?php echo $this->get_field_id( 'rhswp_page_widget_short_text' ); ?>"
							   name="<?php echo $this->get_field_name( 'rhswp_page_widget_short_text' ); ?>"><?php echo esc_attr( $rhswp_page_widget_short_text ); ?></textarea></label>
		</p>


		<p><label for="<?php echo $this->get_field_id( 'rhswp_page_widget_page_linktext' ); ?>">Linktekst:<br><input
					id="<?php echo $this->get_field_id( 'rhswp_page_widget_page_linktext' ); ?>"
					name="<?php echo $this->get_field_name( 'rhswp_page_widget_page_linktext' ); ?>" type="text"
					value="<?php echo esc_attr( $rhswp_page_widget_page_linktext ); ?>"/></label></p>


		<label for="<?php echo $this->get_field_id( 'rhswp_page_widget_page_link' ) . '">' . __( "Linkt naar pagina:", 'wp-rijkshuisstijl' ) ?><br />
        <?php
		$args = array(
			'depth'    => 0,
			'child_of' => 0,
			'selected' => esc_attr( $rhswp_page_widget_page_link ),
			'echo'     => 1,
			'name'     => $this->get_field_name( 'rhswp_page_widget_page_link' )
		);

		wp_dropdown_pages( $args );

		echo '</label>';


	}

	function update( $new_instance, $old_instance ) {
		$instance                                    = $old_instance;
		$instance['rhswp_page_widget_title']         = empty( $new_instance['rhswp_page_widget_title'] ) ? '' : $new_instance['rhswp_page_widget_title'];
		$instance['rhswp_page_widget_page_linktext'] = empty( $new_instance['rhswp_page_widget_page_linktext'] ) ? '' : $new_instance['rhswp_page_widget_page_linktext'];
		$instance['rhswp_page_widget_short_text']    = empty( $new_instance['rhswp_page_widget_short_text'] ) ? '' : $new_instance['rhswp_page_widget_short_text'];
		$instance['rhswp_page_widget_page_link']     = empty( $new_instance['rhswp_page_widget_page_link'] ) ? '' : $new_instance['rhswp_page_widget_page_link'];

		return $instance;
	}

	function widget( $args, $instance ) {


		extract( $args, EXTR_SKIP );

		$rhswp_page_widget_title         = empty( $instance['rhswp_page_widget_title'] ) ? '' : $instance['rhswp_page_widget_title'];
		$rhswp_page_widget_short_text    = empty( $instance['rhswp_page_widget_short_text'] ) ? '' : $instance['rhswp_page_widget_short_text'];
		$rhswp_page_widget_page_link     = empty( $instance['rhswp_page_widget_page_link'] ) ? '' : $instance['rhswp_page_widget_page_link'];
		$rhswp_page_widget_page_linktext = empty( $instance['rhswp_page_widget_page_linktext'] ) ? _x( "Geen linktekst ingevoerd", 'Widget', 'wp-rijkshuisstijl' ) : $instance['rhswp_page_widget_page_linktext'];
		$linkafter                       = '';


		echo $before_widget;


		echo '<div class="text">';

		$linkbefore = '';
		$linkafter  = '';

		if ( $rhswp_page_widget_page_link ) {
			$rhswp_page_widget_page_link = get_permalink( $rhswp_page_widget_page_link );
			$linkbefore                  = '<p class="read-more"><a href="' . $rhswp_page_widget_page_link . '">' . $rhswp_page_widget_page_linktext;
			$linkafter                   = '</a></p>';
		}

		if ( $instance['rhswp_page_widget_title'] !== '' ) {
			echo $before_title . $instance['rhswp_page_widget_title'] . $after_title;
		}

		echo $rhswp_page_widget_short_text;
		echo $linkbefore . $linkafter;

		echo '</div>'; // class=text

		echo $after_widget;

	}

}


function rhswp_page_widget_register() {
	return register_widget( "rhswp_page_widget" );
}

add_action( 'widgets_init', 'rhswp_page_widget_register' );





