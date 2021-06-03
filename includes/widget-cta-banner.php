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
class rhswp_cta_banner_widget extends WP_Widget {


	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {

		$widget_ops = array(
			'classname'   => 'cta-widget',
			'description' => __( 'Korte tekst met verwijzing naar een pagina.', 'wp-rijkshuisstijl' ),
		);

		parent::__construct( 'rhswp_cta_banner_widget', RHSWP_CTA_WIDGET, $widget_ops );

	}


	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance,
			array(
				'rhswp_cta_banner_widget_title'         => '',
				'rhswp_cta_banner_widget_short_text'    => '',
				'rhswp_cta_banner_widget_page_linktext' => '',
				'rhswp_cta_banner_widget_page_link'     => ''
			)
		);

		$rhswp_cta_banner_widget_title      = empty( $instance['rhswp_cta_banner_widget_title'] ) ? '' : $instance['rhswp_cta_banner_widget_title'];
		$rhswp_cta_banner_widget_short_text = empty( $instance['rhswp_cta_banner_widget_short_text'] ) ? '' : $instance['rhswp_cta_banner_widget_short_text'];


		?>

		<p><label for="<?php echo $this->get_field_id( 'rhswp_cta_banner_widget-title' ); ?>">Titel: <input
					id="<?php echo $this->get_field_id( 'rhswp_cta_banner_widget-title' ); ?>"
					name="<?php echo $this->get_field_name( 'rhswp_cta_banner_widget_title' ); ?>" type="text"
					value="<?php echo esc_attr( $rhswp_cta_banner_widget_title ); ?>"/></label></p>

		<p>
			<label
				for="<?php echo $this->get_field_id( 'rhswp_cta_banner_widget_short_text' ) ?>"><?php _e( "Vrije tekst in widget:", 'wp-rijkshuisstijl' ) ?>
				<br/><textarea cols="33" rows="4"
							   id="<?php echo $this->get_field_id( 'rhswp_cta_banner_widget_short_text' ); ?>"
							   name="<?php echo $this->get_field_name( 'rhswp_cta_banner_widget_short_text' ); ?>"><?php echo esc_attr( $rhswp_cta_banner_widget_short_text ); ?></textarea></label>
		</p>

		<?php

	}

	function update( $new_instance, $old_instance ) {
		$instance                                          = $old_instance;
		$instance['rhswp_cta_banner_widget_title']         = empty( $new_instance['rhswp_cta_banner_widget_title'] ) ? '' : $new_instance['rhswp_cta_banner_widget_title'];
		$instance['rhswp_cta_banner_widget_page_linktext'] = empty( $new_instance['rhswp_cta_banner_widget_page_linktext'] ) ? '' : $new_instance['rhswp_cta_banner_widget_page_linktext'];
		$instance['rhswp_cta_banner_widget_short_text']    = empty( $new_instance['rhswp_cta_banner_widget_short_text'] ) ? '' : $new_instance['rhswp_cta_banner_widget_short_text'];
		$instance['rhswp_cta_banner_widget_page_link']     = empty( $new_instance['rhswp_cta_banner_widget_page_link'] ) ? '' : $new_instance['rhswp_cta_banner_widget_page_link'];

		return $instance;
	}

	function widget( $args, $instance ) {


		extract( $args, EXTR_SKIP );

		$rhswp_cta_banner_widget_title         = empty( $instance['rhswp_cta_banner_widget_title'] ) ? '' : $instance['rhswp_cta_banner_widget_title'];
		$rhswp_cta_banner_widget_short_text    = empty( $instance['rhswp_cta_banner_widget_short_text'] ) ? '' : $instance['rhswp_cta_banner_widget_short_text'];
		$rhswp_cta_banner_widget_page_link     = empty( $instance['rhswp_cta_banner_widget_page_link'] ) ? '' : $instance['rhswp_cta_banner_widget_page_link'];
		$rhswp_cta_banner_widget_page_linktext = empty( $instance['rhswp_cta_banner_widget_page_linktext'] ) ? _x( "Geen linktekst ingevoerd", 'Widget', 'wp-rijkshuisstijl' ) : $instance['rhswp_cta_banner_widget_page_linktext'];
		$linkafter                             = '';

		$widget_id = 'widget_' . $args['widget_id'];

		$link = get_field( 'widget_acf_link', $widget_id );

		echo $before_widget;

		$linkbefore = '';
		$linkafter  = '';

		if ( $link ) {
			$linkbefore = '<p><a href="' . $link['url'] . '" class="cta">' . $link['title'] . '</a>';
			$linkafter  = '</p>';
		}

		if ( $instance['rhswp_cta_banner_widget_title'] !== '' ) {
			echo $before_title . $instance['rhswp_cta_banner_widget_title'] . $after_title;
		}

		if ( $rhswp_cta_banner_widget_short_text ) {
			echo '<div class="text">';
			echo wpautop( esc_html( $rhswp_cta_banner_widget_short_text ) );
			echo '</div>'; // class=text
		}

		echo $linkbefore . $linkafter;

		echo $after_widget;

	}

}


function rhswp_cta_banner_widget_register() {
	return register_widget( "rhswp_cta_banner_widget" );
}

add_action( 'widgets_init', 'rhswp_cta_banner_widget_register' );


if ( function_exists( 'acf_add_local_field_group' ) ):

	acf_add_local_field_group( array(
		'key'                   => 'group_5f58d35680806',
		'title'                 => 'Link in CTA widget',
		'fields'                => array(
			array(
				'key'               => 'field_5f58d3771d999',
				'label'             => 'Link',
				'name'              => 'widget_acf_link',
				'type'              => 'link',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'return_format'     => 'array',
			),
		),
		'location'              => array(
			array(
				array(
					'param'    => 'widget',
					'operator' => '==',
					'value'    => 'rhswp_cta_banner_widget',
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


