<?php

/**
// * wp-rijkshuisstijl - widget-paginalinks.php
// * ----------------------------------------------------------------------------------
// * Widget voor het tonen op pagina / berichtniveau van toegevoegde links
// * ----------------------------------------------------------------------------------
// * 
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 2.11.2
// * @desc.   Widget 'page-links' gedeactiveerd en verplaatst naar hook 'genesis_after_entry'. 
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */


//========================================================================================================

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_57ff8c1326b24',
	'title' => ' Extra links bij bericht of pagina',
	'fields' => array (
		array (
			'key' => 'field_57ff8c9ba3211',
			'label' => 'Toon extra links?',
			'name' => RHSWP_WIDGET_PAGELINKS_ID . '_widget_show_extra_links',
			'type' => 'radio',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'ja' => 'Ja',
				'nee' => 'Nee',
			),
			'allow_null' => 0,
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => 'nee',
			'layout' => 'horizontal',
			'return_format' => 'value',
		),
		array (
			'key' => 'field_57ff8c2b5809b',
			'label' => 'Titel boven de linklijst',
  			'name' => RHSWP_WIDGET_PAGELINKS_ID . '_widget_title',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_57ff8c9ba3211',
						'operator' => '==',
						'value' => 'ja',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array (
			'key' => 'field_57ff8c6078e2d',
			'label' => 'Links',
			'name' => RHSWP_WIDGET_PAGELINKS_ID . '_widget_links',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_57ff8c9ba3211',
						'operator' => '==',
						'value' => 'ja',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => '',
			'max' => '',
			'layout' => 'row',
			'button_label' => 'Nieuwe link(s) toevoegen',
			'sub_fields' => array (
				array (
					'key' => 'field_57ff8e4ed93b6',
					'label' => 'Externe link?',
					'name' => 'externe_link',
					'type' => 'radio',
					'instructions' => 'Kies \'nee\' om te verwijzen naar een pagina binnen deze site.
Kies \'ja\' om te verwijzen naar een pagina buiten deze site.',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array (
						'nee' => 'Nee',
						'ja' => 'Ja',
					),
					'allow_null' => 0,
					'other_choice' => 0,
					'save_other_choice' => 0,
					'default_value' => 'nee',
					'layout' => 'horizontal',
					'return_format' => 'value',
				),
				array (
					'key' => 'field_57ff93f302ba5',
					'label' => 'Interne link',
					'name' => 'interne_link',
					'type' => 'relationship',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_57ff8e4ed93b6',
								'operator' => '==',
								'value' => 'nee',
							),
						),
					),
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'post_type' => array (
					),
					'taxonomy' => array (
					),
					'filters' => array (
						0 => 'search',
						1 => 'post_type',
						2 => 'taxonomy',
					),
					'elements' => '',
					'min' => '',
					'max' => '',
					'return_format' => 'object',
				),
				array (
					'key' => 'field_57ff95ab4d25b',
					'label' => 'Linktekst voor externe link',
					'name' => 'linktekst_voor_externe_link',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_57ff8e4ed93b6',
								'operator' => '==',
								'value' => 'ja',
							),
						),
					),
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array (
					'key' => 'field_57ff93b1f8765',
					'label' => 'URL voor externe link',
					'name' => 'url_extern',
					'type' => 'url',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_57ff8e4ed93b6',
								'operator' => '==',
								'value' => 'ja',
							),
						),
					),
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
				),
			),
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
		),
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'page',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;  
  
//========================================================================================================
//  //* banner widget
//  class rhswp_pagelinks_widget extends WP_Widget {
//    
//    
//    /**
//    * Sets up the widgets name etc
//    */
//    public function __construct() {
//      
//      $widget_ops = array(
//      	'classname'   => 'page-links',
//      	'description' => _x( 'Mogelijkheid voor het tonen van de bijbehorende links die je op pagina / berichtniveau hebt ingevoerd.', 'paginalinkswidget', 'wp-rijkshuisstijl' ),
//      );
//      
//      parent::__construct( RHSWP_WIDGET_PAGELINKS_ID, RHSWP_WIDGET_PAGELINKS_DESC, $widget_ops );
//    }
//    
//     
//    function form($instance) {
//      $instance = wp_parse_args( (array) $instance, 
//        array( 
//        'rhswp_pagelinks_widget_title'    => '', 
//        ) 
//      );
//      
//      $rhswp_pagelinks_widget_title          = empty( $instance['rhswp_pagelinks_widget_title'] )         ? '' : $instance['rhswp_pagelinks_widget_title'];
//      
//      
//      echo '<p>' . _x( 'Dit widget doet pas iets als je op pagina- of berichtniveau links hebt toegevoegd. Die links worden dan op deze plaats getoond.</p><p>De titel hieronder wordt getoond als op pagina-niveau geen titel is ingevoerd.', 'paginalinkswidget', 'wp-rijkshuisstijl' );
//       ? >
//      <br><label for="<?php echo $this->get_field_id('rhswp_pagelinks_widget-title'); ? >"><?php echo _x( 'Titel', 'paginalinkswidget', 'wp-rijkshuisstijl' ) ? ><input id="<?php echo $this->get_field_id('rhswp_pagelinks_widget-title'); ? >" name="<?php echo $this->get_field_name('rhswp_pagelinks_widget_title'); ? >" type="text" value="<?php echo esc_attr($rhswp_pagelinks_widget_title); ? >" /></label></p>  
//      < ? php      
//        
//    }
//     
//    function update($new_instance, $old_instance) {
//      $instance = $old_instance;
//      $instance['rhswp_pagelinks_widget_title']            = empty( $new_instance['rhswp_pagelinks_widget_title'] ) ? '' : $new_instance['rhswp_pagelinks_widget_title'];
//      return $instance;
//    }
//     
//    function widget($args, $instance) {
//  
//      if ( is_page() || is_single() ) {
//    
//        extract($args, EXTR_SKIP);
//      
//        $rhswp_pagelinks_widget_title          = empty($instance['rhswp_pagelinks_widget_title']) ? '' : $instance['rhswp_pagelinks_widget_title'] ;
//    
//        global $post;
//    
//        $widgettitle = '';
//    
//          
//          $toon_extra_links         = get_field(RHSWP_WIDGET_PAGELINKS_ID . '_widget_show_extra_links', $post->ID );
//          $widgettitle              = get_field(RHSWP_WIDGET_PAGELINKS_ID . '_widget_title', $post->ID );
//          $links                    = get_field(RHSWP_WIDGET_PAGELINKS_ID . '_widget_links', $post->ID );
//  
//          if ( !$widgettitle ) {
//          
//            if ( $instance['rhswp_pagelinks_widget_title'] !== '') {
//              $widgettitle = $instance['rhswp_pagelinks_widget_title'];
//            }
//            else {
//              $widgettitle = _x( 'Extra links voor ', 'paginalinkswidget', 'wp-rijkshuisstijl' ) . get_the_title();
//            }
//          }
//    
//          if ( 'ja' == $toon_extra_links ) {
//    
//            echo $before_widget;
//            echo $before_title . $widgettitle . $after_title;
//    
//            if( have_rows(RHSWP_WIDGET_PAGELINKS_ID . '_widget_links') ) {
//  
//              echo '<ul>';
//    
//              while( have_rows(RHSWP_WIDGET_PAGELINKS_ID . '_widget_links') ): the_row(); 
//                
//                // vars
//                $externe_link                 = get_sub_field('externe_link');
//                $url_extern                   = get_sub_field('url_extern');
//                $linktekst_voor_externe_link  = get_sub_field('linktekst_voor_externe_link');
//                $content = '';
//      
//                if( 'ja' == $externe_link ) {
//                  // externe link dus
//                  if ( $linktekst_voor_externe_link && $url_extern ) {
//                    $content = '<li><a href="' . $url_extern . '" class="extern">' . $linktekst_voor_externe_link . '</a></li>';
//                  }
//                }
//                else {
//                  // interne link
//                  $interne_link  = get_sub_field('interne_link');
//                  
//                  foreach ( $interne_link as $linkobject ) {
//                    $content .= '<li><a href="' . get_permalink( $linkobject->ID ) . '">' . $linkobject->post_title . '</a></li>';
//                  }
//                }
//                echo $content; 
//              
//              endwhile; 
//              echo '</ul>';
//            }
//            else {
//              echo _x( 'Er zijn geen extra links ingevoerd.', 'paginalinkswidget', 'wp-rijkshuisstijl' );
//            }
//    
//            echo $after_widget;
//          
//          }
//          else {
//            // do nothing
//          }
//  
//      }
//      else {
//        
//      }
//    }
//  }
  
//========================================================================================================

function rhswp_pagelinks_widget_register() {
  return register_widget("rhswp_pagelinks_widget");  
}

//add_action( 'widgets_init', 'rhswp_pagelinks_widget_register' );
  
//========================================================================================================

add_action( 'genesis_after_entry', 'rhswp_pagelinks_replace_widget' );

function rhswp_pagelinks_replace_widget() {

	global $post;
	
	if ( is_page() || is_single() ) {
		
		$toon_extra_links       = get_field(RHSWP_WIDGET_PAGELINKS_ID . '_widget_show_extra_links', $post->ID );
		$widgettitle            = get_field(RHSWP_WIDGET_PAGELINKS_ID . '_widget_title', $post->ID );
		$links                  = get_field(RHSWP_WIDGET_PAGELINKS_ID . '_widget_links', $post->ID );
		
		if ( !$widgettitle ) {
		
			$widgettitle = _x( 'Extra links voor ', 'paginalinkswidget', 'wp-rijkshuisstijl' ) . get_the_title();

		}
		
		
		if ( 'ja' == $toon_extra_links && $links ) {
			
	        $title_id 				= sanitize_title( $widgettitle );

            echo '<section aria-labelledby="' . $title_id . '" class="page-links">';
            echo '<h2 id="' . $title_id . '">' . $widgettitle . '</h2>';

			if( have_rows( RHSWP_WIDGET_PAGELINKS_ID . '_widget_links', $post->ID ) ) {
				
				echo '<ul>';
				
				while( have_rows( RHSWP_WIDGET_PAGELINKS_ID . '_widget_links', $post->ID ) ): the_row(); 
				
					// vars
					$externe_link                 = get_sub_field('externe_link');
					$url_extern                   = get_sub_field('url_extern');
					$linktekst_voor_externe_link  = get_sub_field('linktekst_voor_externe_link');
					$content = '';
					
					if( 'ja' == $externe_link && $url_extern ) {
						// externe link dus
						if ( $url_extern ) {
							$content = '<li><a href="' . $url_extern . '" class="extern">' . $linktekst_voor_externe_link . '</a></li>';
						}
						else {
							$content = '<li><a href="' . $url_extern . '" class="extern">' . $url_extern . '</a></li>';
						}
					}
					else {
						// interne link
						$interne_link  = get_sub_field('interne_link');
						
						foreach ( $interne_link as $linkobject ) {
							$content .= '<li><a href="' . get_permalink( $linkobject->ID ) . '">' . $linkobject->post_title . '</a></li>';
						}
					}
					
					endwhile; 
				
				echo '</ul>';
			}
			
            echo "</section>";
			
		}
	}
}
	
