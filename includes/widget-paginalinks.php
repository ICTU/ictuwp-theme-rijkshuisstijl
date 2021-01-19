<?php
/**
 * wp-rijkshuisstijl - widget-paginalinks.php
 * ----------------------------------------------------------------------------------
 * Widget voor het tonen op pagina / berichtniveau van toegevoegde links
 * ----------------------------------------------------------------------------------
 * // *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 2.12.6
 * @desc.   CSS bugfiks voor 'widget_rhswp_navigationmenu_widget', rhswp_pagelinks_widget geheractiveerd.
 * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */

//========================================================================================================

//* rhswp_pagelinks_widget widget
class rhswp_pagelinks_widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'page-links',
			'description' => _x( 'Mogelijkheid voor het tonen van de bijbehorende links die je op pagina / berichtniveau hebt ingevoerd.', 'paginalinkswidget', 'wp-rijkshuisstijl' ),
		);
		parent::__construct( RHSWP_WIDGET_PAGELINKS_ID, RHSWP_WIDGET_PAGELINKS_DESC, $widget_ops );
	}

	function form( $instance ) {
		$instance                     = wp_parse_args( (array) $instance,
			array(
				'rhswp_pagelinks_widget_title' => '',
			)
		);
		$rhswp_pagelinks_widget_title = empty( $instance['rhswp_pagelinks_widget_title'] ) ? '' : $instance['rhswp_pagelinks_widget_title'];

		echo '<p>' . _x( 'Dit widget doet pas iets als je op pagina- of berichtniveau links hebt toegevoegd. Die links worden dan op deze plaats getoond.</p><p>De titel hieronder wordt getoond als op pagina-niveau geen titel is ingevoerd.', 'paginalinkswidget', 'wp-rijkshuisstijl' );
		?>
        <br><label
                for="<?php echo $this->get_field_id( 'rhswp_pagelinks_widget-title' ); ?>"><?php echo _x( 'Titel', 'paginalinkswidget', 'wp-rijkshuisstijl' ) ?>
            <input id="<?php echo $this->get_field_id( 'rhswp_pagelinks_widget-title' ); ?>"
                   name="<?php echo $this->get_field_name( 'rhswp_pagelinks_widget_title' ); ?>" type="text"
                   value="<?php echo esc_attr( $rhswp_pagelinks_widget_title ); ?>"/></label></p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance                                 = $old_instance;
		$instance['rhswp_pagelinks_widget_title'] = empty( $new_instance['rhswp_pagelinks_widget_title'] ) ? '' : $new_instance['rhswp_pagelinks_widget_title'];

		return $instance;
	}

	function widget( $args, $instance ) {
		if ( is_page() || is_single() ) {
			extract( $args, EXTR_SKIP );
			global $post;
			$toon_extra_links = get_field( RHSWP_WIDGET_PAGELINKS_ID . '_widget_show_extra_links', $post->ID );
			$widgettitle      = get_field( RHSWP_WIDGET_PAGELINKS_ID . '_widget_title', $post->ID );

			if ( ! $widgettitle ) {
				if ( $instance['rhswp_pagelinks_widget_title'] !== '' ) {
					$widgettitle = $instance['rhswp_pagelinks_widget_title'];
				} else {
					$widgettitle = _x( 'Extra links voor ', 'paginalinkswidget', 'wp-rijkshuisstijl' ) . get_the_title();
				}
			}

			if ( 'ja' == $toon_extra_links ) {
				echo $before_widget;
				echo $before_title . $widgettitle . $after_title;
				if ( have_rows( RHSWP_WIDGET_PAGELINKS_ID . '_widget_links' ) ) {
					echo '<ul>';
					while ( have_rows( RHSWP_WIDGET_PAGELINKS_ID . '_widget_links' ) ): the_row();
						// vars
						$externe_link                = get_sub_field( 'externe_link' );
						$url_extern                  = get_sub_field( 'url_extern' );
						$linktekst_voor_externe_link = get_sub_field( 'linktekst_voor_externe_link' );
						$content                     = '';
						if ( 'ja' == $externe_link ) {
							// externe link dus
							if ( $linktekst_voor_externe_link && $url_extern ) {
								$content = '<li><a href="' . $url_extern . '" class="extern">' . $linktekst_voor_externe_link . '</a></li>';
							}
						} else {
							// interne link
							$interne_link = get_sub_field( 'interne_link' );
							foreach ( $interne_link as $linkobject ) {
								$content .= '<li><a href="' . get_permalink( $linkobject->ID ) . '">' . $linkobject->post_title . '</a></li>';
							}
						}
						echo $content;
					endwhile;
					echo '</ul>';
				} else {
					echo _x( 'Er zijn geen extra links ingevoerd.', 'paginalinkswidget', 'wp-rijkshuisstijl' );
				}
				echo $after_widget;
			} else {
				// do nothing
			}
		} else {
            // do nothing
		}
	}
}

//========================================================================================================

function rhswp_pagelinks_widget_register() {
	return register_widget( "rhswp_pagelinks_widget" );
}

add_action( 'widgets_init', 'rhswp_pagelinks_widget_register' );

//========================================================================================================

function rhswp_pagelinks_replace_widget() {

	global $post;

	if ( ( ! is_home() && ! is_front_page() ) && ( is_page() || is_single() ) ) {
		$toon_extra_links = get_field( RHSWP_WIDGET_PAGELINKS_ID . '_widget_show_extra_links', $post->ID );
		$widgettitle      = get_field( RHSWP_WIDGET_PAGELINKS_ID . '_widget_title', $post->ID );
		$links            = get_field( RHSWP_WIDGET_PAGELINKS_ID . '_widget_links', $post->ID );
		if ( ! $widgettitle ) {
			$widgettitle = _x( 'Extra links voor ', 'paginalinkswidget', 'wp-rijkshuisstijl' ) . get_the_title();
		}

		if ( 'ja' == $toon_extra_links && $links ) {
			$title_id = sanitize_title( $widgettitle );
			echo '<section aria-labelledby="' . $title_id . '" class="page-links">';
			echo '<h2 id="' . $title_id . '">' . $widgettitle . '</h2>';
			echo '<ul>';
			foreach ( $links as $link ) {

				// vars
				$externe_link                = $link['externe_link'];
				$url_extern                  = $link['url_extern'];
				$linktekst_voor_externe_link = $link['linktekst_voor_externe_link'];
				$content                     = '';
				if ( 'ja' == $externe_link && $url_extern ) {
					// externe link dus
					if ( $url_extern ) {
						$content = '<li><a href="' . $url_extern . '" class="extern">' . $linktekst_voor_externe_link . '</a></li>';
					} else {
						$content = '<li><a href="' . $url_extern . '" class="extern">' . $url_extern . '</a></li>';
					}
				} else {
					// interne link
					$interne_link = get_sub_field( 'interne_link' );
					foreach ( $interne_link as $linkobject ) {
						$content .= '<li><a href="' . get_permalink( $linkobject->ID ) . '">' . $linkobject->post_title . '</a></li>';
					}
				}
				echo $content;
			}
			echo '</ul>';
			echo "</section>";
		}
	}
}

//========================================================================================================

