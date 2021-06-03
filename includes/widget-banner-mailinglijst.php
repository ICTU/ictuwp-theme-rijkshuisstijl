<?php

/**
 *  wp-rijkshuisstijl - widget-banner-mailinglijst.php
 *  ----------------------------------------------------------------------------------
 * widget met banner met inschrijfformulier mailinglijst
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
class rhswp_widget_banner_mailinglijst extends WP_Widget {


	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {

		$widget_ops = array(
			'classname'   => 'widget-banner-mailinglijst',
			'description' => __( 'Banner met formulier voor inschrijving mailinglijst', 'wp-rijkshuisstijl' ),
		);

		parent::__construct( 'rhswp_widget_banner_mailinglijst', RHSWP_CTA_WIDGET, $widget_ops );

	}


	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance,
			array(
				'rhswp_widget_banner_mailinglijst_title'         => '',
				'rhswp_widget_banner_mailinglijst_short_text'    => '',
				'rhswp_widget_banner_mailinglijst_page_linktext' => '',
				'rhswp_widget_banner_mailinglijst_page_link'     => ''
			)
		);

		$rhswp_widget_banner_mailinglijst_title      = empty( $instance['rhswp_widget_banner_mailinglijst_title'] ) ? '' : $instance['rhswp_widget_banner_mailinglijst_title'];
		$rhswp_widget_banner_mailinglijst_short_text = empty( $instance['rhswp_widget_banner_mailinglijst_short_text'] ) ? '' : $instance['rhswp_widget_banner_mailinglijst_short_text'];


		?>

		<p><label for="<?php echo $this->get_field_id( 'rhswp_widget_banner_mailinglijst-title' ); ?>">Titel: <input
					id="<?php echo $this->get_field_id( 'rhswp_widget_banner_mailinglijst-title' ); ?>"
					name="<?php echo $this->get_field_name( 'rhswp_widget_banner_mailinglijst_title' ); ?>" type="text"
					value="<?php echo esc_attr( $rhswp_widget_banner_mailinglijst_title ); ?>"/></label></p>

		<p>
			<label
				for="<?php echo $this->get_field_id( 'rhswp_widget_banner_mailinglijst_short_text' ) ?>"><?php _e( "Vrije tekst in widget:", 'wp-rijkshuisstijl' ) ?>
				<br/><textarea cols="33" rows="4"
							   id="<?php echo $this->get_field_id( 'rhswp_widget_banner_mailinglijst_short_text' ); ?>"
							   name="<?php echo $this->get_field_name( 'rhswp_widget_banner_mailinglijst_short_text' ); ?>"><?php echo esc_attr( $rhswp_widget_banner_mailinglijst_short_text ); ?></textarea></label>
		</p>

		<?php

	}

	function update( $new_instance, $old_instance ) {
		$instance                                                   = $old_instance;
		$instance['rhswp_widget_banner_mailinglijst_title']         = empty( $new_instance['rhswp_widget_banner_mailinglijst_title'] ) ? '' : $new_instance['rhswp_widget_banner_mailinglijst_title'];
		$instance['rhswp_widget_banner_mailinglijst_page_linktext'] = empty( $new_instance['rhswp_widget_banner_mailinglijst_page_linktext'] ) ? '' : $new_instance['rhswp_widget_banner_mailinglijst_page_linktext'];
		$instance['rhswp_widget_banner_mailinglijst_short_text']    = empty( $new_instance['rhswp_widget_banner_mailinglijst_short_text'] ) ? '' : $new_instance['rhswp_widget_banner_mailinglijst_short_text'];
		$instance['rhswp_widget_banner_mailinglijst_page_link']     = empty( $new_instance['rhswp_widget_banner_mailinglijst_page_link'] ) ? '' : $new_instance['rhswp_widget_banner_mailinglijst_page_link'];

		return $instance;
	}

	function widget( $args, $instance ) {


		extract( $args, EXTR_SKIP );

		$rhswp_widget_banner_mailinglijst_title         = empty( $instance['rhswp_widget_banner_mailinglijst_title'] ) ? '' : $instance['rhswp_widget_banner_mailinglijst_title'];
		$rhswp_widget_banner_mailinglijst_short_text    = empty( $instance['rhswp_widget_banner_mailinglijst_short_text'] ) ? '' : $instance['rhswp_widget_banner_mailinglijst_short_text'];
		$rhswp_widget_banner_mailinglijst_page_link     = empty( $instance['rhswp_widget_banner_mailinglijst_page_link'] ) ? '' : $instance['rhswp_widget_banner_mailinglijst_page_link'];
		$rhswp_widget_banner_mailinglijst_page_linktext = empty( $instance['rhswp_widget_banner_mailinglijst_page_linktext'] ) ? _x( "Geen linktekst ingevoerd", 'Widget', 'wp-rijkshuisstijl' ) : $instance['rhswp_widget_banner_mailinglijst_page_linktext'];
		$linkafter                                      = '';

		$widget_id = 'widget_' . $args['widget_id'];

		$link = get_field( 'widget_acf_link', $widget_id );

		echo $before_widget;

		$linkbefore = '';
		$linkafter  = '';

		if ( $link ) {
			$linkbefore = '<p><a href="' . $link['url'] . '" class="cta">' . $link['title'] . '</a>';
			$linkafter  = '</p>';
		}

		if ( $instance['rhswp_widget_banner_mailinglijst_title'] !== '' ) {
			echo $before_title . $instance['rhswp_widget_banner_mailinglijst_title'] . $after_title;
		}

		if ( $rhswp_widget_banner_mailinglijst_short_text ) {
			echo '<div class="text">';
			echo wpautop( esc_html( $rhswp_widget_banner_mailinglijst_short_text ) );
			echo '</div>'; // class=text
		}

		echo $linkbefore . $linkafter;

		echo $after_widget;

	}

}


function rhswp_widget_banner_mailinglijst_register() {
	return register_widget( "rhswp_widget_banner_mailinglijst" );
}

add_action( 'widgets_init', 'rhswp_widget_banner_mailinglijst_register' );


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
					'value'    => 'rhswp_widget_banner_mailinglijst',
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


