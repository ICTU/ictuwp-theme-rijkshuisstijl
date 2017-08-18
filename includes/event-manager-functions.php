<?php
  
/**
 * Rijkshuisstijl (Digitale Overheid) - event-manager-functions.php
 * ----------------------------------------------------------------------------------
 * Extra functions tbv event manager
 * ----------------------------------------------------------------------------------
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.6.23
 * @desc.   Modified Event Widget, updated pagination. Extra event functions and page.
 * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */


//========================================================================================================

function gc_wbvb_event_get_organizer_info() {
  global $post;
  return gc_wbvb_authorbox_compose_box( get_the_author_meta('ID') );
}

//========================================================================================================

function gc_wbvb_authorbox_compose_box( $userid, $gravatar = '', $sectiontype = '' ) {

    global $default_persoon_plaatje;
    
    $publiek_mailadres      = '';
    $publiek_telefoonnummer = '';
    $header_tag             = 'h2';
    $prefix                 = __( 'Over', 'gebruikercentraal');
    
    if ( is_archive() ) {
      $header_tag             = 'h1';
      $prefix                 = __( 'Blogberichten van', 'gebruikercentraal');
    }

    $sectiondiv = '<section class="author-box wrap" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">';

    if ( 'even' == get_post_type() ) {
      $sectiondiv = '<section class="author-box wrap" itemprop="organizer" itemscope="itemscope" itemtype="http://schema.org/Person">';
    }

    
    if ( $default_persoon_plaatje == 'voorbeeld-persoon-2.png' ) {
    	$default_persoon_plaatje = 'voorbeeld-persoon-1.png';
    }
    else {
    	$default_persoon_plaatje = 'voorbeeld-persoon-2.png';
    }

    if ( function_exists( 'get_field' ) ) {
    
        $acf_userid             = "user_" . $userid;       

        $user_info              = get_userdata($userid);
        
//        dovardump($user_info);

//        the_author_meta('twitter');
//        the_author_meta('facebook');
        
        $gebruikersnaam         = $user_info->display_name;
        $functiebeschrijving    = get_field('functiebeschrijving', $acf_userid);
        $biografie              =( $user_info->description ) ? $user_info->description : '';
        $user_post_count        = count_user_posts( $userid ); 

    		if ( !$functiebeschrijving ) {
  	        $functiebeschrijving = $biografie;
  	        $biografie = '';
    		}

        $functiebeschrijving     = nl2br( $functiebeschrijving );

    		if ( $biografie ) {
          $biografie     = '<p>' . nl2br( $biografie ) . '</p>';
    		}




        $pattern = "/<p[^>]*><\\/p[^>]*>/"; 
        $functiebeschrijving = preg_replace($pattern, '', $functiebeschrijving); 
        
        
        $twitter                = get_field('twitter', $acf_userid);
        if ($twitter != '') {
            $twitter            = preg_replace('/@/i','',$twitter);
        }
        
        $linkedin               = get_field('linkedin', $acf_userid);
        $facebook               = get_field('facebook', $acf_userid);
        $googleplus             = get_field('googleplus', $acf_userid);
        $personalurl            = get_field('personalurl', $acf_userid);
        

        
        
        $publiek_mailadres      = get_field('publiek_mailadres', $acf_userid);
        $publiek_telefoonnummer = get_field('publiek_telefoonnummer', $acf_userid);
    
        $authorfoto             = get_field('auteursfoto', $acf_userid);

        $image                  = wp_get_attachment_image_src($authorfoto['id'], 'thumbnail'); 
        $imagetag               = '';

        if ( $image[0] ) {
            $imagetag  = '            <img src="' . $image[0] . '" class="author-photo photo avatar" height="' . $image[2] . '" width="' . $image[1] . '" alt="' . $authorfoto['id'] . '" />';
        }
        else {

          $args = array(
            'size'  => 82,  
            'class' => 'author-photo photo avatar',  
          );

          $defaultplaatje = get_stylesheet_directory_uri() . '/images/' . $default_persoon_plaatje;
          $imagetag  = get_avatar( $userid, 82, $defaultplaatje, $authorfoto['id'], $args ); 

        }
    }
    
    $dl = '';
    
    $displayname = ( $user_info->user_firstname ? $user_info->user_firstname : ( $user_info->display_name ? $user_info->display_name : 'geen naam'  ) );

    if ($publiek_telefoonnummer) {
        $publiek_telefoonnummer_d = preg_replace("/[^0-9+]/", "", $publiek_telefoonnummer);
        $publiek_telefoonnummer = '<a href="tel://' . $publiek_telefoonnummer_d . '" itemprop="telephone">' . ' ' . $publiek_telefoonnummer . '</a> ';
    }

    if ($publiek_mailadres) {
        $publiek_mailadres = '<a href="mailto:' . $publiek_mailadres . '" itemprop="email">' . _x('Mail','Event: CTA om mail te versturen aan organisator','gebruikercentraal' ) . ' ' . $displayname . '</a> ';
    }

    if ($publiek_mailadres) {
        $dl .= '<li>' . $publiek_mailadres . '</li>';
    }

    if ($publiek_telefoonnummer) {
        $dl .= '<li>' . $publiek_telefoonnummer . '</li>';
    }


    if ($personalurl) {
        $dl .= '<li><a href="' . $personalurl . '" class="personallink" title="' . __('Persoonlijke website', 'gebruikercentraal' ) . ' van ' . $gebruikersnaam . '"><span class="visuallyhidden">' . __('Persoonlijke website', 'gebruikercentraal' ) . '</span></a></li>';
    }

    if ($googleplus) {
        $dl .= '<li><a href="' . $googleplus . '" class="googleplus" title="' . __('Google+-profiel', 'gebruikercentraal' ) . ' van ' . $gebruikersnaam . '"><span class="visuallyhidden">' . __('Google+', 'gebruikercentraal' ) . '</span></a></li>';
    }

    if ($linkedin) {
        $dl .= '<li><a href="' . $linkedin . '" class="linkedin" title="' . __('LinkedIn-profiel', 'gebruikercentraal' ) . ' van ' . $gebruikersnaam . '"><span class="visuallyhidden">' . __('LinkedIn-profiel', 'gebruikercentraal' ) . '</span></a></li>';
    }

    if ($facebook) {
        $dl .= '<li><a href="' . $facebook . '" class="facebook" title="' . __('Facebook-account', 'gebruikercentraal' ) . ' van ' . $gebruikersnaam . '"><span class="visuallyhidden">' . __('Facebook-account', 'gebruikercentraal' ) . '</span></a></li>';
    }

    if ($twitter) {
        $dl .= '<li><a href="https://twitter.com/' . $twitter . '" class="twitter" title="' . __('Twitter-account', 'gebruikercentraal' ) . ' van ' . $gebruikersnaam . '"><span class="visuallyhidden">' . __('Twitter-account', 'gebruikercentraal' ) . '</span></a></li>';
    }

    
    if ($dl) {
        $dl = '<ul class="social-media">' . $dl . '</ul>';
    }
    
    $functiebeschrijving = preg_replace("/&#?[a-z0-9]{2,8};/i","",$functiebeschrijving);

    if ( $functiebeschrijving ) {
        $functiebeschrijving = '<p span itemprop="jobTitle">' . $functiebeschrijving . "</p>";
    }

    $output = '<div class="wrap contains-author-box">' . $sectiondiv . '<div class="bg-color">' . $imagetag . '
      <div class="author-info">
        <' . $header_tag . ' class="author-box-title"><span class="visuallyhidden">' . $prefix . ' </span><span itemprop="name">' .$gebruikersnaam . '</span></' . $header_tag . '>
        ' . $functiebeschrijving . '
        <hr>' . $biografie . '
        <p>' . $dl;
        if ( !is_author() ) {
          if ( $user_post_count > 0 ) {
            $output .= '<a href="' . get_author_posts_url( $userid ) . '" class="author-archive more" title="' . __('Alle artikelen', 'gebruikercentraal' ) . ' van ' . $gebruikersnaam . '"><span class="visuallyhidden">' . __('Alle artikelen', 'gebruikercentraal' ) . ' van ' . $gebruikersnaam . '</span></a>';
          }
        }

    $output .= '</p></div></div></section></div>';


    return $output;
    
    
}

//========================================================================================================

function gc_wbvb_event_get_programma() {

  global $post;
  
  $return = '';
  
  if( have_rows( 'programmaonderdelen' ) ):
    
    $return = '<div id="programma"><h2>' . _x('Programma', 'Kopje op evenementpagina', 'gebruikercentraal') . '</h2>';
    $return .= '<ul class="event-program">';
    
    // loop through the rows of data
    while ( have_rows('programmaonderdelen') ) : the_row();
    
      $programmaonderdeel_tijd            = wp_strip_all_tags( get_sub_field('programmaonderdeel_tijd'), '<br>' );
      $programmaonderdeel_beschrijving    = wp_strip_all_tags( get_sub_field('programmaonderdeel_beschrijving'), '<br>' );
      
      $programmaonderdeel_beschrijving = '<span class="beschrijving">' . $programmaonderdeel_beschrijving . '</span>';
      
      if ( $programmaonderdeel_tijd ) {
        $programmaonderdeel_tijd = '<span class="tijd">' . $programmaonderdeel_tijd . '</span>';
      }

      $return .= '<li>' . $programmaonderdeel_tijd  . $programmaonderdeel_beschrijving . '</li>';
    
    endwhile;
    
    $return .= '</ul></div>';
    
  else :
    // no rows found
  
  endif;
  
  return $return;
  
}

//========================================================================================================

function gc_wbvb_post_get_links() {

  global $post;
  
  $return = '';
  
  if( have_rows( 'event_post_links_collection' ) ):
  
    $return = '<h2>' . _x('Links', 'Kopje op bericht- of evenementpagina', 'gebruikercentraal') . '</h2>';
    $return .= '<ul class="link-list">';
    
    // loop through the rows of data
    while ( have_rows('event_post_links_collection') ) : the_row();
      
      $event_link_url         = wp_strip_all_tags( get_sub_field('event_post_link_url'), '' );
      $event_link_linktekst   = wp_strip_all_tags( get_sub_field('event_post_link_linktekst'), '' );
      
      if ( !$event_link_linktekst ) {
        $event_link_linktekst = gc_wbvb_clean_url( $event_link_url );
      }
      
      $return .= '<li><a href="' . $event_link_url . '" itemprop="url">' . $event_link_linktekst . '</a></li>';
    
    endwhile;
    
    $return .= '</ul>';
    
  else :
    // no rows found
  
  endif;
  
  return $return;
}

//========================================================================================================



