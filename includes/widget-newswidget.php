<?php

/**
 * wp-rijkshuisstijl - widget-newswidget.php
 * ----------------------------------------------------------------------------------
 * toont nieuwsberichten uit een geselecteerde categorie
 * ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.11.1
 * @desc.   Bugfix voor carroussel. CSS external link.
 * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */



function rhswp_news_widget_register() {
  return register_widget("rhswp_news_widget");  
}

add_action( 'widgets_init', 'rhswp_news_widget_register' );


//========================================================================================================
//* news widget
class rhswp_news_widget extends WP_Widget {

    function __construct() {


    		$widget_ops = array(
    			'classname'   => 'news-widget',
    			'description' => __( 'Mogelijkheid voor tonen van nieuwsberichten uit een bepaalde categorie', 'wp-rijkshuisstijl' ),
    		);
    
    		parent::__construct( 'rhswp_news_widget', '(DO) Berichtenwidget (per categorie)', $widget_ops );


    }
    function form($instance) {
        $instance = wp_parse_args( (array) $instance, 
            array( 
                'rhswp_news_title' => '', 
                'rhswp_news_category' => '', 
                'rhswp_news_max' => '' 
                ) 
            );

        $rhswp_news_title     = empty( $instance['rhswp_news_title'] ) ? '' : $instance['rhswp_news_title'];
        $rhswp_news_category  = $instance['rhswp_news_category'];
        $rhswp_news_max       = $instance['rhswp_news_max'];
        
        ?>
        <p><label for="<?php echo $this->get_field_id('rhswp_news_title') . '">' . __( "Titel:", 'wp-rijkshuisstijl' ) ?><br /><input id="<?php echo $this->get_field_id('rhswp_news_title'); ?>" name="<?php echo $this->get_field_name('rhswp_news_title'); ?>" type="text" style="width: 100%;" value="<?php echo esc_attr($rhswp_news_title); ?>" /></label><br>(niet zichtbaar, wel noodzakelijk)</p>
        
        <?php
            
            $args = array(
                'orderby'       => 'name', 
                'order'         => 'ASC',
                'hide_empty'    => true, 
                'fields'        => 'all', 
                'hierarchical'  => true, 
                'cache_domain'  => 'core'
            ); 
            
            $availablecategories         = get_terms( 'category', $args );            
            $count                        = count($availablecategories);

            echo '<p><label for="' . $this->get_field_id('rhswp_news_category') . '">' . __( "Categorie:", 'wp-rijkshuisstijl' ) . '<br />';
            wp_dropdown_categories(array('hide_empty' => 1, 'name' => $this->get_field_name('rhswp_news_category'), 'hierarchical' => true, 'selected' => $rhswp_news_category));
            echo '</label></p>';

            $counter  = 0;
            $max      = 10;
            
            echo '<p><label for="' . $this->get_field_id('rhswp_news_max') . '">' . __( "Aantal:", 'wp-rijkshuisstijl' ) . '<br /><select name="' . $this->get_field_name('rhswp_news_max') . '" id="rhswp_news_max">';
            while ( $counter < $max ) {
                $counter++;
                echo '<option value="' . $counter . '"';
                if ($rhswp_news_max == $counter) {
                    echo ' selected>';
                }
                else {
                    echo '>';
                }
                echo $counter . '</option>';
            }
            echo "</select></label></p>";


    }
     
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['rhswp_news_title']     = empty( $new_instance['rhswp_news_title'] ) ? '' : $new_instance['rhswp_news_title'];
        $instance['rhswp_news_category']  = empty( $new_instance['rhswp_news_category'] ) ? '' : $new_instance['rhswp_news_category'];
        $instance['rhswp_news_max']       = empty( $new_instance['rhswp_news_max'] ) ? '' : $new_instance['rhswp_news_max'];
        return $instance;
    }
     
    function widget($args, $instance) {
        global $query;
        global $post;
        global $wp_query;
    
        extract($args, EXTR_SKIP);

        $rhswp_news_title   = empty( $instance['rhswp_news_title'] ) ? '' : $instance['rhswp_news_title'];
        $categorie          = empty( $instance['rhswp_news_category'] ) ? '' : $instance['rhswp_news_category'] ;
        $aantalberichten    = empty( $instance['rhswp_news_max'] ) ? '5' : $instance['rhswp_news_max'] ;


        if ( isset($wp_query->query_vars['category_name'] ) ) 
        {

            $currentcat     =   get_category_by_slug( $wp_query->query_vars['category_name'] ); 
            if ( $currentcat ) 
            {
                $currentcat_id  =   $currentcat->term_id;
    
                if ( $currentcat_id == $categorie ) 
                {
                    dodebug("rhswp_news_widget: currentcat " . $currentcat_id);
                    dodebug("rhswp_news_widget: categorie " . $categorie);
                    dodebug("rhswp_news_widget: WOEPS! " . $categorie . "=" . $currentcat_id);
                }
            }
        }
         

        $args = array(
            'type'                     => 'post',
            'child_of'                 => 0,
            'parent'                   => $categorie,
            'orderby'                  => 'id',
            'order'                    => 'ASC',
            'hide_empty'               => 1,
            'hierarchical'             => 1,
            'taxonomy'                 => 'category',
            'pad_counts'               => false 
        ); 
        
        $categories = get_categories( $args ); 
        
        $args = array(
            'post_type'             =>  'post',
            'posts_per_page'        =>  $aantalberichten, 
            'ignore_sticky_posts'   =>  1, 
            'order'                 =>  'DESC',
            'orderby'               =>  'date'
            );
        
        if ($categories) 
        {
            
            $subcat = $categorie;
            
            foreach ( $categories as $term ) 
            {
                $subcat .= ','.$term->term_id;
            }
            $args['cat']    =  $subcat;       
        }
        else 
        {
            $args['cat']    =  $categorie;       
        }
        
        $sidebarposts = new WP_query();

        if ( is_single() ) 
        {
            $args['post__not_in'] =  array( $post->ID );       
        }
        // Assign predefined $args to your query
        $sidebarposts->query($args);
        
        
        $countertje = 0; // Run your normal loop
        
        if ($sidebarposts->have_posts()) 
        {

            $category_id = get_cat_ID( 'Category Name' );
            
            // Get the URL of this category
            $category_link = get_category_link( $categorie );        

            echo $before_widget;
            echo '<h3 class="widgettitle">'. $rhswp_news_title . '</h3>'; 

            echo '<div class="flex">';

             while ($sidebarposts->have_posts()) : $sidebarposts->the_post();
                // do loop stuff
                $countertje++;
                $permalink = get_permalink();
                    
                echo '<div class="flex-block">'; 
                echo '<h4>'; 
                echo '<a href="' . $permalink . '">';
                echo the_title();
                echo '</a>';
                echo '</h4>';
                echo the_excerpt();
                echo '</div>'; 
            
            endwhile;

            echo '</div>'; 


            if ( $countertje > 2 ) 
            {
                echo '<div class="category-link more"><a href="' . $category_link . '">' . __( "Meer", 'wp-rijkshuisstijl' ) . ' ' . strtolower( get_the_category_by_ID( $categorie ) ). '</a></div>';
            }

            echo $after_widget;
            
        }
        
        // RESET THE QUERY
        wp_reset_query();

    }
 
}

	
	
