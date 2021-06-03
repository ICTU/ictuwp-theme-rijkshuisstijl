<?php

/**
 * // * wp-rijkshuisstijl - widget-navigation-menu.php
 * // * ----------------------------------------------------------------------------------
 * // * Widget voor het tonen van een navigatie-menu
 * // * ----------------------------------------------------------------------------------
 * // *
 * // * @author  Paul van Buuren
 * // * @license GPL-2.0+
 * // * @package wp-rijkshuisstijl
 * // * @version 2.12.4
 * // * @desc.   search widgetruimte toegevoegd aan no-results.
 * // * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */


//========================================================================================================


/**
 * Core class used to implement the Navigation Menu widget.
 *
 * @since 3.0.0
 *
 * @see WP_Widget
 */
class rhswp_navigationmenu_widget extends WP_Widget {

	/**
	 * Sets up a new Navigation Menu widget instance.
	 *
	 * @since 3.0.0
	 */
	public function __construct() {
		$widget_ops = array(
			'description'                 => __( 'Add a navigation menu to your sidebar.' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'rhswp_navigationmenu_widget', RHSWP_WIDGET_NAVIGATIONMENU, $widget_ops );
	}

	/**
	 * Outputs the content for the current Navigation Menu widget instance.
	 *
	 * @param array $args Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Navigation Menu widget instance.
	 *
	 * @since 3.0.0
	 *
	 */
	public function widget( $args, $instance ) {
		// Get menu
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( ! $nav_menu ) {
			return;
		}

		$title                = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$nav_description      = ! empty( $instance['nav_description'] ) ? $instance['nav_description'] : '';
		$hide_banner_for_cpts = strpos( $args['before_widget'], 'rhswp_hide_this_banner', 0 );
		$doshow               = false;


		if ( $hide_banner_for_cpts === false ) {
			// we mogen de widget tonen, want de verboden string zit er niet in
			$doshow = true;
		}

		if ( $doshow ) {

			/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
			$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

			echo $args['before_widget'];

			if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}

			if ( $nav_description ) {
				echo '<p>' . esc_attr( $nav_description ) . '</p>';
			}


			$nav_menu_args = array(
				'fallback_cb' => '',
				'menu'        => $nav_menu,
			);

			wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $args, $instance ) );

			echo $args['after_widget'];
		}

	}

	/**
	 * Handles updating settings for the current Navigation Menu widget instance.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 *
	 * @return array Updated settings to save.
	 * @since 3.0.0
	 *
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['nav_menu'] ) ) {
			$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		}
		if ( ! empty( $new_instance['nav_description'] ) ) {
			$instance['nav_description'] = sanitize_text_field( $new_instance['nav_description'] );
		}

		return $instance;
	}

	/**
	 * Outputs the settings form for the Navigation Menu widget.
	 *
	 * @param array $instance Current settings.
	 *
	 * @since 3.0.0
	 *
	 * @global WP_Customize_Manager $wp_customize
	 */
	public function form( $instance ) {
		global $wp_customize;
		$title           = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu        = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';
		$nav_description = isset( $instance['nav_description'] ) ? $instance['nav_description'] : '';


		// Get menus
		$menus = wp_get_nav_menus();

		$empty_menus_style     = '';
		$not_empty_menus_style = '';
		if ( empty( $menus ) ) {
			$empty_menus_style = ' style="display:none" ';
		} else {
			$not_empty_menus_style = ' style="display:none" ';
		}

		$nav_menu_style = '';
		if ( ! $nav_menu ) {
			$nav_menu_style = 'display: none;';
		}

		// If no menus exists, direct the user to go and create some.
		?>
		<p class="nav-menu-widget-no-menus-message" <?php echo $not_empty_menus_style; ?>>
			<?php
			if ( $wp_customize instanceof WP_Customize_Manager ) {
				$url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
			} else {
				$url = admin_url( 'nav-menus.php' );
			}

			/* translators: %s: URL to create a new menu. */
			printf( __( 'No menus have been created yet. <a href="%s">Create some</a>.' ), esc_attr( $url ) );
			?>
		</p>
		<div class="nav-menu-widget-form-controls" <?php echo $empty_menus_style; ?>>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
					   name="<?php echo $this->get_field_name( 'title' ); ?>"
					   value="<?php echo esc_attr( $title ); ?>"/>
			</p>
			<p>
				<label
					for="<?php echo $this->get_field_id( 'nav_description' ) ?>"><?php _e( "Korte beschrijving", 'wp-rijkshuisstijl' ) ?>
					<br/>
					<textarea cols="35" rows="8" id="<?php echo $this->get_field_id( 'nav_description' ); ?>"
							  name="<?php echo $this->get_field_name( 'nav_description' ); ?>"><?php echo wp_strip_all_tags( $nav_description ); ?></textarea></label>
				<small>geen HTML gebruiken</small>
			</p>
			<p>
				<label
					for="<?php echo $this->get_field_id( 'nav_menu' ); ?>"><?php _e( 'Select Menu:', 'wp-rijkshuisstijl' ); ?></label>
				<select id="<?php echo $this->get_field_id( 'nav_menu' ); ?>"
						name="<?php echo $this->get_field_name( 'nav_menu' ); ?>">
					<option value="0"><?php _e( '&mdash; Select &mdash;' ); ?></option>
					<?php foreach ( $menus as $menu ) : ?>
						<option
							value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu, $menu->term_id ); ?>>
							<?php echo esc_html( $menu->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>
			<?php if ( $wp_customize instanceof WP_Customize_Manager ) : ?>
				<p class="edit-selected-nav-menu" style="<?php echo $nav_menu_style; ?>">
					<button type="button" class="button"><?php _e( 'Edit Menu' ); ?></button>
				</p>
			<?php endif; ?>
		</div>
		<?php
	}
}


//========================================================================================================

add_filter( 'dynamic_sidebar_params', 'filter_for_rhswp_navigationmenu_widget' );

function filter_for_rhswp_navigationmenu_widget( $params ) {

	global $rhswp_banner_widget_customcss;
	global $post;

	// get widget vars
	$widget_name = $params[0]['widget_name'];
	$widget_id   = $params[0]['widget_id'];

	// bail early if this widget is not a Text widget
	if ( $widget_name != RHSWP_WIDGET_NAVIGATIONMENU ) {
		return $params;
	}

	$rhswp_widget_link_uitzonderingen = empty( get_field( 'rhswp_widget_link_uitzonderingen', 'widget_' . $widget_id ) ) ? '' : get_field( 'rhswp_widget_link_uitzonderingen', 'widget_' . $widget_id );

	$params[0]['hide_widget'] = 'false';


	if ( is_archive() || is_tax() ) {
		// can't check post type exceptions on non-post type views
	} else {

		// check of de banner op bepaalde contentsoorten niet getoond moet worden
		if ( is_array( $rhswp_widget_link_uitzonderingen ) ) {

			$posttype = get_post_type( $post ); // haal posttype van huidige content op

			foreach ( $rhswp_widget_link_uitzonderingen as $uitzondering ):

				if ( $uitzondering == $posttype ) {
					// bij deze contentsoort moet de banner dus niet getoond worden
					// dus exit
					$params[0]['before_widget'] = 'rhswp_hide_this_banner' . '-' . $uitzondering;

					return $params;

				}

			endforeach;

		}

	}

	// return
	return $params;

}

//========================================================================================================

function rhswp_navigationmenu_widget_register() {
	return register_widget( "rhswp_navigationmenu_widget" );
}

add_action( 'widgets_init', 'rhswp_navigationmenu_widget_register' );

//========================================================================================================

if ( function_exists( 'acf_add_local_field_group' ) ):

	acf_add_local_field_group( array(
		'key'                   => 'group_5ddbe7da915de',
		'title'                 => '(DO) navigatiewidget',
		'fields'                => array(
			array(
				'key'               => 'field_5ddbee779a5f2',
				'label'             => '<strong>Uitzonderingen</strong>',
				'name'              => 'rhswp_widget_link_uitzonderingen',
				'type'              => 'checkbox',
				'instructions'      => 'Kies op welke contentsoorten deze banner <strong style="color: white; background: red; padding: .1em .5em;">NIET</strong> getoond moet worden.',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'choices'           => array(
					'page'     => 'Pagina',
					'post'     => 'Berichten (dat zijn ALLE berichten)',
					'document' => 'Document',
					'event'    => 'Evenement',
				),
				'allow_custom'      => 0,
				'default_value'     => array(),
				'layout'            => 'vertical',
				'toggle'            => 0,
				'return_format'     => 'value',
				'save_custom'       => 0,
			),
		),
		'location'              => array(
			array(
				array(
					'param'    => 'widget',
					'operator' => '==',
					'value'    => 'rhswp_navigationmenu_widget',
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

//========================================================================================================

