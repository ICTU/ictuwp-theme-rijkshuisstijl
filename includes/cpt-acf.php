<?php

// * Rijkshuisstijl (Digitale Overheid) - cpt-acf.php
// * -------------------------------------------------------------------------------------------------------
// * Definities van Advanced Custom Fields voor diverse plekken
// * -------------------------------------------------------------------------------------------------------
// *
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 2.6.1
// * @desc.   Markering in grijs voor archief-dossiers.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl




//========================================================================================================

if( function_exists('acf_add_local_field_group') ):

  //======================================================================================================
  // upload voor CPT RHSWP_CPT_DOCUMENT 
  //======================================================================================================
  acf_add_local_field_group(array (
  	'key' => 'group_57e8f17964532',
  	'title' => 'Document',
  	'fields' => array (
  		array (
  			'key'     => 'field_57e8f1821cab5',
  			'label'   => __( 'Bijbehorend document', 'wp-rijkshuisstijl' ),
  			'name'    => 'rhswp_document_upload',
  			'type'    => 'file',
  			'instructions'   => '',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'return_format' => 'array',
  			'library' => 'all',
  			'min_size' => '',
  			'max_size' => '',
  			'mime_types' => '',
  		),
  		array (
  			'key' => 'field_57faa99195748',
  			'label'   => __( 'Bestandstype', 'wp-rijkshuisstijl' ),
  			'name' => 'rhswp_document_filetype',
  			'type' => 'text',
  			'instructions'   => __( 'Denk aan: PDF, Word-document, tekstbestand', 'wp-rijkshuisstijl' ),
  			'required' => 0,
  			'conditional_logic' => 0,
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
  			'key' => 'field_57faa9a013f5f',
  			'label'   => __( 'Document-grootte', 'wp-rijkshuisstijl' ),
  			'name' => 'rhswp_document_filesize',
  			'type' => 'text',
        'instructions'   => __( 'bijvoorbeeld: 372KB, of: 2MB', 'wp-rijkshuisstijl' ),  			
  			'required' => 0,
  			'conditional_logic' => 0,
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
  		
  	),
  	'location' => array (
  		array (
  			array (
  				'param' => 'post_type',
  				'operator' => '==',
  				'value' => 'document',
  			),
  		),
  	),
  	'menu_order' => 0,
  	'position' => 'acf_after_title',
  	'style' => 'default',
  	'label_placement' => 'top',
  	'instruction_placement' => 'label',
  	'hide_on_screen' => '',
  	'active' => 1,
  	'description' => '',
  ));


    //======================================================================================================
    // metadata voor CT RHSWP_CT_DOSSIER 
    //======================================================================================================
    acf_add_local_field_group(array (
    	'key' => 'group_57f90d0a441e4',
    	'title' => 'Dossier-informatie',
    	'fields' => array (
    		array (
    			'key' => 'field_57f90d20c2fdf',
    			'label'   => __( 'Inhoudspagina', 'wp-rijkshuisstijl' ),
    			'name' => 'dossier_overzichtpagina',
    			'type' => 'post_object',
          'instructions'   => __( 'Welke pagina beschrijft de inhoud van dit dossier? Deze pagina is belangrijk, omdat we hiermee de verdere structuur van het dossier kunnen bepalen.', 'wp-rijkshuisstijl' ),  			
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array (
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'post_type' => array (
    				0 => 'page',
    			),
    			'taxonomy' => array (
    			),
    			'allow_null' => 0,
    			'multiple' => 0,
    			'return_format' => 'object',
    			'ui' => 1,
    		),
    		array (
    			'key' => 'field_57fa70f9fe7a3',
    			'label'   => __( 'Toon inhoudspagina in het menu?', 'wp-rijkshuisstijl' ),
    			'name' => 'toon_overzichtspagina_in_het_menu',
    			'type' => 'radio',
    			'instructions'   => '',
    			'required' => 1,
    			'conditional_logic' => 0,
    			'wrapper' => array (
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'choices' => array (
    				'ja' => 'Toon wel',
    				'nee' => 'Toon niet',
    			),
    			'allow_null' => 0,
    			'other_choice' => 0,
    			'save_other_choice' => 0,
    			'default_value' => 'ja',
    			'layout' => 'vertical',
    			'return_format' => 'value',
    		),
    		array (
    			'key' => 'field_57f90f281dcfb',
    			'label'   => __( 'Andere pagina\'s in het menu', 'wp-rijkshuisstijl' ),
    			'name' => 'menu_pages',
    			'type' => 'relationship',
    			'instructions'   => '',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array (
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'post_type' => array (
    				0 => 'page',
    			),
    			'taxonomy' => array (
    			),
    			'filters' => array (
    				0 => 'search',
    				1 => 'taxonomy',
    			),
    			'elements' => '',
    			'min' => '',
    			'max' => '',
    			'return_format' => 'object',
    		),
    	),
    	'location' => array (
    		array (
    			array (
    				'param' => 'taxonomy',
    				'operator' => '==',
    				'value' => 'dossiers',
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



  //======================================================================================================
  // metadata voor page_dossiersingleactueel.php
  //======================================================================================================
  acf_add_local_field_group(array (
  	'key' => 'group_57fa9232d034a',
  	'title' => 'Actueelpagina voor een dossier',
  	'fields' => array (
  		array (
  			'key' => 'field_57fa92400aa5c',
  			'label'   => __( 'Wil je filteren op categorie op deze pagina?', 'wp-rijkshuisstijl' ),
  			'name' => 'wil_je_filteren_op_categorie_op_deze_pagina',
  			'type' => 'radio',
        'instructions'   => __( 'Als je niet filtert worden alle berichten getoond die aan dit dossier gekoppeld zijn. Als je wilt filteren, kun je kiezen voor een categorie. Dan worden dus alleen die berichten getoond die:
  - zowel aan dit dossier gekoppeld zijn 
  - als aan de door jou gekozen categorie', 'wp-rijkshuisstijl' ),  			

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
  			'layout' => 'vertical',
  			'return_format' => 'value',
  		),
  		array (
  			'key' => 'field_57fa933133d61',
  			'label'   => __( 'Kies de categorie waarop je wilt filteren', 'wp-rijkshuisstijl' ),
  			'name' => 'kies_de_categorie_waarop_je_wilt_filteren',
  			'type' => 'taxonomy',
  			'instructions'   => '',
  			'required' => 0,
  			'conditional_logic' => array (
  				array (
  					array (
  						'field' => 'field_57fa92400aa5c',
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
  			'taxonomy' => 'category',
  			'field_type' => 'checkbox',
  			'allow_null' => 0,
  			'add_term' => 1,
  			'save_terms' => 0,
  			'load_terms' => 0,
  			'return_format' => 'id',
  			'multiple' => 0,
  		),
  	),
  	'location' => array (
  		array (
  			array (
  				'param' => 'page_template',
  				'operator' => '==',
  				'value' => 'page_dossiersingleactueel.php',
  			),
  		),
  	),
  	'menu_order' => 0,
  	'position' => 'acf_after_title',
  	'style' => 'default',
  	'label_placement' => 'top',
  	'instruction_placement' => 'label',
  	'hide_on_screen' => '',
  	'active' => 1,
  	'description' => '',
  	'local' => 'php',
  ));

  //======================================================================================================
  // metadata voor RHSWP_WIDGET_BANNER
  //======================================================================================================
  acf_add_local_field_group(array(
  	'key' => 'group_57e4e9cdb7b83',
  	'title' => 'Layout-opties voor banner-widget',
  	'fields' => array(
  		array(
  			'key' => 'field_5848103f0be5b',
  			'label' => 'Link in de banner',
  			'name' => 'rhswp_widget_link',
  			'type' => 'url',
  			'instructions' => 'Een link is niet verplicht',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => '',
  			'placeholder' => '',
  		),
  		array(
  			'key' => 'field_58491e20452d3',
  			'label' => 'Vormgeving',
  			'name' => 'rhswp_widget_class',
  			'type' => 'select',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'choices' => array(
  				'standaard' => 'Standaard - grijze rand, witte achtergrond, blauwe titel',
  				'do-groen' => 'DO-groen - Donkergroene achtergrond, witte tekst',
  				'do-groen-light' => 'DO-lichtgroen - Lichtgroene achtergrond, zwarte tekst',
  				'text-over-plaatje' => 'Tekst over een plaatje',
  				'plaatje-link-notitel' => 'Alleen plaatje met een link, titel verborgen',
  			),
  			'default_value' => array(
  			),
  			'allow_null' => 0,
  			'multiple' => 0,
  			'ui' => 0,
  			'return_format' => 'value',
  			'ajax' => 0,
  			'placeholder' => '',
  		),
  		array(
  			'key' => 'field_5847d2d9a31f8',
  			'label' => 'Image in de banner',
  			'name' => 'rhswp_widget_bannerimage',
  			'type' => 'image',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => array(
  				array(
  					array(
  						'field' => 'field_58491e20452d3',
  						'operator' => '==',
  						'value' => 'text-over-plaatje',
  					),
  				),
  				array(
  					array(
  						'field' => 'field_58491e20452d3',
  						'operator' => '==',
  						'value' => 'plaatje-link-notitel',
  					),
  				),
  			),
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'return_format' => 'array',
  			'preview_size' => 'thumbnail',
  			'library' => 'all',
  			'min_width' => '',
  			'min_height' => '',
  			'min_size' => '',
  			'max_width' => '',
  			'max_height' => '',
  			'max_size' => '',
  			'mime_types' => '',
  		),
  		array(
  			'key' => 'field_58480b91f296f',
  			'label' => 'Hoe wil je het plaatje uitlijnen?',
  			'name' => 'rhswp_widget_image_alignment',
  			'type' => 'radio',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'choices' => array(
  				'top' => 'Boven de tekst (volle breedte)',
  				'left' => 'Links van de tekst (100px breed)',
  				'right' => 'Rechts van de tekst (100px breed)',
  			),
  			'allow_null' => 0,
  			'other_choice' => 0,
  			'default_value' => '',
  			'layout' => 'vertical',
  			'return_format' => 'value',
  			'save_other_choice' => 0,
  		),
  		array(
  			'key' => 'field_584927f5927b8',
  			'label' => 'Uitlijning van de tekst',
  			'name' => 'rhswp_widget_textalignment',
  			'type' => 'radio',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'choices' => array(
  				'left' => 'Links uitgelijnd',
  				'center' => 'Gecentreerd',
  				'right' => 'Rechts uitgelijnd',
  			),
  			'allow_null' => 0,
  			'other_choice' => 0,
  			'default_value' => '',
  			'layout' => 'vertical',
  			'return_format' => 'value',
  			'save_other_choice' => 0,
  		),
  		array(
  			'key' => 'field_5c08efcd9dd7f',
  			'label' => '<strong>Uitzonderingen</strong>',
  			'name' => 'rhswp_widget_link_uitzonderingen',
  			'type' => 'checkbox',
  			'instructions' => 'Kies op welke contentsoorten deze banner <strong style="color: white; background: red; padding: .1em .5em;">NIET</strong> getoond moet worden.',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'choices' => array(
  				'page' => 'Pagina',
  				'post' => 'Berichten (dat zijn ALLE berichten)',
  				'document' => 'Document',
  				'event' => 'Evenement',
  			),
  			'allow_custom' => 0,
  			'default_value' => array(
  			),
  			'layout' => 'vertical',
  			'toggle' => 0,
  			'return_format' => 'value',
  			'save_custom' => 0,
  		),
  	),
  	'location' => array(
  		array(
  			array(
  				'param' => 'widget',
  				'operator' => '==',
  				'value' => 'rhswp_banner_widget',
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

// options page 
if( function_exists('acf_add_options_page') ):

	$args = array(
		'slug' => 'instellingen',
		'title' => __( 'Instellingen theme', 'wp-rijkshuisstijl' ),
		'parent' => 'themes.php'
	); 
	
		acf_add_options_page($args);

endif;

//========================================================================================================

if( function_exists('register_field_group') ):


    //====================================================================================================
    // sokmetknoppen voor twitter, linkedin, het satanische facebook
    // 
    register_field_group(array (
      'key' => 'group_54e6101992f1e',
      'title' => 'Deelknoppen en reactieformulier',
      'fields' => array (
        array (
          'key' => 'field_54e610433e1d0',
    			'label'   => __( 'Toon social-media-opties wel of niet', 'wp-rijkshuisstijl' ),
          'name' => 'socialmedia_icoontjes',
          'prefix' => '',
          'type' => 'radio',
          'instructions'   => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'choices' => array (
      			SOC_MED_YES   => __( 'Ja, toon socialmedia-icoontjes', 'wp-rijkshuisstijl' ),
      			SOC_MED_NO   => __( 'Nee, verberg socialmedia-icoontjes', 'wp-rijkshuisstijl' ),
          ),
          'other_choice' => 0,
          'save_other_choice' => 0,
          'default_value' => SOC_MED_YES,
          'layout' => 'vertical',
        ),

        array (
          'key'						=> 'field_54e610433e1d1',
    			'label'					=> __( 'Toon reactieformulier', 'wp-rijkshuisstijl' ),
          'name' 					=> 'toon_reactieformulier_post',
          'prefix' 				=> '',
          'type' 					=> 'radio',
          'instructions'	=> '',
          'required' 			=> 0,
          'conditional_logic'	=> 0,
          'wrapper' 			=> array (
            'width'	=> '',
            'class'	=> '',
            'id'	=> '',
          ),
          'choices' 			=> array (
      			SOC_MED_YES	=> __( 'Ja, toon reactieformulier', 'wp-rijkshuisstijl' ),
      			SOC_MED_NO	=> __( 'Nee, verberg reactieformulier', 'wp-rijkshuisstijl' ),
    				'anders'    => __( 'Anders, toon dit formulier:', 'wp-rijkshuisstijl' ) ,
          ),
          'other_choice'			=> 0,
          'save_other_choice'	=> 0,
          'default_value'			=> SOC_MED_YES,
          'layout' 						=> 'vertical',
        ),
    
    		array(
    			'key' => 'field_5c87a6bc3c29a',
    			'label' => 'Ander reactieformulier',
    			'name' => 'ander_reactieformulier',
    			'type' => 'post_object',
    			'instructions' => '',
    			'required' => 0,
    			'conditional_logic' => array(
    				array(
    					array(
    						'field' => 'field_54e610433e1d1',
    						'operator' => '==',
    						'value' => 'anders',
    					),
    				),
    			),
    			'wrapper' => array(
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'post_type' => array(
    				0 => 'wpcf7_contact_form',
    			),
    			'taxonomy' => '',
    			'allow_null' => 0,
    			'multiple' => 0,
    			'return_format' => 'id',
    			'ui' => 1,
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
        array (
          array (
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'event',
          ),
        ),
    		array(
    			array(
    				'param' => 'taxonomy',
    				'operator' => '==',
    				'value' => RHSWP_CT_DOSSIER,
    			),
    		),
        
      ),
      'menu_order' => 0,
      'position' => 'normal',
      'style' => 'artmustgrow',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => '',
    ));

  
  acf_add_local_field_group(array (
  	'key' => 'group_57dbb4a2b1368',
  	'title' => 'Alternatieve paginatitel',
  	'fields' => array (
  		array (
  			'key' => 'field_57dbb4bb70f6f',
  			'label'   => __( 'Alternatieve paginatitel gebruiken?', 'wp-rijkshuisstijl' ),
  			'name' => 'alternatieve_paginatitel_gebruiken',
  			'type' => 'radio',
        'instructions'   => esc_html( __( 'De paginatitel wordt standaard gebruikt voor ondermeer verwijzingen in menu\'s en in de <title>. Het kan zijn dat je voor de duidelijkheid een andere tekst wilt tonen in de <h1>. Als je hier \'ja\' kiest, kun je een alternatieve paginatitel invoeren.', 'wp-rijkshuisstijl' ) ),  			
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'choices' => array (
  				'nee' => 'nee',
  				'ja' => 'ja',
  			),
  			'allow_null' => 0,
  			'other_choice' => 0,
  			'save_other_choice' => 0,
  			'default_value' => 'nee',
  			'layout' => 'horizontal',
  		),
  		array (
  			'key' => 'field_57dbb54b70f70',
  			'label'   => __( 'Alternatieve paginatitel', 'wp-rijkshuisstijl' ),
  			'name' => 'alternatieve_paginatitel',
  			'type' => 'text',
  			'instructions'   => '',
  			'required' => 0,
  			'conditional_logic' => array (
  				array (
  					array (
  						'field' => 'field_57dbb4bb70f6f',
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
  			'readonly' => 0,
  			'disabled' => 0,
  		),
  	),
  	'location' => array (
  		array (
  			array (
  				'param' => 'post_type',
  				'operator' => '==',
  				'value' => 'page',
  			),
  		),
  	),
  	'menu_order' => 0,
  	'position' => 'acf_after_title',
  	'style' => 'default',
  	'label_placement' => 'top',
  	'instruction_placement' => 'label',
  	'hide_on_screen' => '',
  	'active' => 1,
  	'description' => '',
  ));
  

endif;



//========================================================================================================



//========================================================================================================

if( function_exists('acf_add_local_field_group') ):

    //====================================================================================================
    // uitgelichte dossiers op de dossieroverzichtspagina
      acf_add_local_field_group(array (
      	'key' => 'group_57f50ce2004e6',
      	'title' => 'Onderwerppagina: selecteer uitgelichte onderwerpen',
      	'fields' => array (
      		array (
      			'key' => 'field_58382ce90bcd4',
      			'label' => 'Hoe wil je de onderwerpen tonen?',
      			'name' => 'dossier_overzicht_filter',
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
      				'dossier_overzicht_filter_as_list' => 'Alleen de onderwerpen in een lijst',
      				'dossier_overzicht_filter_as_list_plus' => 'Filter en uitgelichte onderwerpen + alle onderwerpen in een lijst',
      			),
      			'allow_null' => 0,
      			'other_choice' => 0,
      			'save_other_choice' => 0,
      			'default_value' => 'dossier_overzicht_filter_as_list',
      			'layout' => 'vertical',
      			'return_format' => 'value',
      		),
  
          array (
          		'key' => 'field_583838dde16cd',
          		'label' => 'Titel boven blok met uitgelichte onderwerpen',
          		'name' => 'dossier_overzicht_filter_title',
          		'type' => 'text',
          		'instructions' => '',
          		'required' => 1,
          		'conditional_logic' => array (
          			array (
          				array (
          					'field' => 'field_58382ce90bcd4',
          					'operator' => '==',
        						'value' => 'dossier_overzicht_filter_as_list_plus',
          				),
          			),
          		),
      		),
      		array (
      			'key' => 'field_57f50cf4234e6',
      			'label'   => __( 'Uitgelichte onderwerpen', 'wp-rijkshuisstijl' ),
      			'name' => 'uitgelichte_dossiers',
      			'type' => 'taxonomy',
            'instructions'   => __( 'De onderwerpen die je hier kiest worden bovenaan de pagina getoond met speciale layout.', 'wp-rijkshuisstijl' ),  			
      			'required' => 0,
      			'conditional_logic' => array (
          			array (
          				array (
          					'field' => 'field_58382ce90bcd4',
          					'operator' => '==',
        						'value' => 'dossier_overzicht_filter_as_list_plus',
          				),
          			),
      			),
  
      			'wrapper' => array (
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'taxonomy' => 'dossiers',
      			'field_type' => 'checkbox',
      			'allow_null' => 0,
      			'add_term' => 1,
      			'save_terms' => 0,
      			'load_terms' => 0,
      			'return_format' => 'id',
      			'multiple' => 0,
      		),
  
      		array(
      			'key' => 'field_5ba1eaafcc2c0',
      			'label' => 'Welke dossiers wil je NIET tonen?',
      			'name' => 'dossier_overzicht_hide_dossiers',
      			'type' => 'taxonomy',
      			'instructions' => '',
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array(
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'taxonomy' => 'dossiers',
      			'field_type' => 'checkbox',
      			'allow_null' => 1,
      			'add_term' => 0,
      			'save_terms' => 0,
      			'load_terms' => 0,
      			'return_format' => 'id',
      			'multiple' => 0,
      		),
      		
      	),
      	'location' => array (
      		array (
      			array (
      				'param' => 'page_template',
      				'operator' => '==',
      				'value' => 'page_showalldossiers-nieuwestyling.php',
      			),
      		),
      	),
      	'menu_order' => 0,
      	'position' => 'acf_after_title',
      	'style' => 'default',
      	'label_placement' => 'top',
      	'instruction_placement' => 'label',
      	'hide_on_screen' => '',
      	'active' => 1,
      	'description' => '',
      ));

    
    acf_add_local_field_group(array (
    	'key' => 'group_57f5099923f1b',
    	'title' => 'Theme-instellingen',
    	'fields' => array (
    		array (
    			'key' => 'field_57f509b68989b',
    			'label'   => __( 'Inhoudspagina voor dossier', 'wp-rijkshuisstijl' ),
    			'name' => 'dossier_overzichtspagina',
    			'type' => 'post_object',
    			'instructions'   => '',
    			'required' => 1,
    			'conditional_logic' => 0,
    			'wrapper' => array (
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'post_type' => array (
    				0 => 'page',
    			),
    			'taxonomy' => array (
    			),
    			'allow_null' => 0,
    			'multiple' => 0,
    			'return_format' => 'object',
    			'ui' => 1,
    		),
    		array (
    			'key' => 'field_57f509b70910d',
    			'label'   => __( 'Link in footer', 'wp-rijkshuisstijl' ),
    			'name' => 'footer_about_us',
    			'type' => 'post_object',
    			'instructions'   => '',
    			'required' => 1,
    			'conditional_logic' => 0,
    			'wrapper' => array (
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'post_type' => array (
    				0 => 'page',
    			),
    			'taxonomy' => array (
    			),
    			'allow_null' => 0,
    			'multiple' => 0,
    			'return_format' => 'object',
    			'ui' => 1,
    		),
    	),
    	'location' => array (
    		array (
    			array (
    				'param' => 'options_page',
    				'operator' => '==',
    				'value' => 'instellingen',
    			),
    		),
    	),
    	'menu_order' => 0,
    	'position' => 'acf_after_title',
    	'style' => 'default',
    	'label_placement' => 'top',
    	'instruction_placement' => 'label',
    	'hide_on_screen' => '',
    	'active' => 1,
    	'description' => '',
    ));
    



    
    //====================================================================================================
    // extra info voor relevante links onder aan de pagina
    acf_add_local_field_group(array (
    	'key' => 'group_572227c314a62',
    	'title' => 'Extra info voor relevante link',
    	'fields' => array (
    		array (
    			'key' => 'field_572227cb69fc1',
    			'label'   => __( 'URL voor relevante link', 'wp-rijkshuisstijl' ),
    			'name' => 'url_voor_relevante_link',
    			'type' => 'url',
    			'instructions'   => '',
    			'required' => 1,
    			'conditional_logic' => 0,
    			'wrapper' => array (
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'default_value' => '',
    			'placeholder' => '',
    		),
    		array (
    			'key' => 'field_572227e269fc2',
    			'label'   => __( 'Linktekst', 'wp-rijkshuisstijl' ),
    			'name' => 'linktekst_voor_relevante_link',
    			'type' => 'text',
    			'instructions'   => '',
    			'required' => 0,
    			'conditional_logic' => 0,
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
    			'readonly' => 0,
    			'disabled' => 0,
    		),
    	),
    	'location' => array (
    		array (
    			array (
    				'param' => 'post_type',
    				'operator' => '==',
    				'value' => RHSWP_LINK_CPT,
    			),
    		),
    	),    	'menu_order' => 0,
    	'position' => 'acf_after_title',
    	'style' => 'default',
    	'label_placement' => 'top',
    	'instruction_placement' => 'label',
    	'hide_on_screen' => '',
    	'active' => 1,
    	'description' => '',
    ));

  

  //====================================================================================================
    acf_add_local_field_group(array(
    	'key' => 'group_5804cc93cdcc6',
    	'title' => 'Carrousel of header-image',
    	'fields' => array(
    		array(
    			'key' => 'field_5804ccac137a5',
    			'label' => 'Wil je hier een header-image of carrousel tonen?',
    			'name' => 'carrousel_tonen_op_deze_pagina',
    			'type' => 'radio',
    			'instructions' => '',
    			'required' => 1,
    			'conditional_logic' => 0,
    			'wrapper' => array(
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'choices' => array(
    				'ja' => 'Ja, toon een carrousel',
    				'show_header_image' => 'Ja, toon een afbeelding (evt met tekst)',
    				'nee' => 'Nee',
    			),
    			'allow_null' => 0,
    			'other_choice' => 0,
    			'save_other_choice' => 0,
    			'default_value' => 'nee',
    			'layout' => 'horizontal',
    			'return_format' => 'value',
    		),
    		array(
    			'key' => 'field_5804cd037c566',
    			'label' => 'Kies carrousel',
    			'name' => 'kies_carrousel',
    			'type' => 'post_object',
    			'instructions' => '',
    			'required' => 1,
    			'conditional_logic' => array(
    				array(
    					array(
    						'field' => 'field_5804ccac137a5',
    						'operator' => '==',
    						'value' => 'ja',
    					),
    				),
    			),
    			'wrapper' => array(
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'post_type' => array(
    				0 => 'carrousel',
    			),
    			'taxonomy' => array(
    			),
    			'allow_null' => 0,
    			'multiple' => 0,
    			'return_format' => 'object',
    			'ui' => 1,
    		),
    		array(
    			'key' => 'field_5b55f5085efb5',
    			'label' => 'Kies header-image',
    			'name' => 'kies_header_image',
    			'type' => 'image',
    			'instructions' => 'De afbeelding moet minimaal ' . RHSWP_MIN_HERO_IMAGE_WIDTH . ' pixels breed en 300 pixels hoog zijn.',
    			'required' => 1,
    			'conditional_logic' => array(
    				array(
    					array(
    						'field' => 'field_5804ccac137a5',
    						'operator' => '==',
    						'value' => 'show_header_image',
    					),
    				),
    			),
    			'wrapper' => array(
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'return_format' => 'array',
    			'preview_size' => 'thumbnail',
    			'library' => 'all',
    			'min_width' => RHSWP_MIN_HERO_IMAGE_WIDTH,
    			'min_height' => '',
    			'min_size' => '',
    			'max_width' => '',
    			'max_height' => '',
    			'max_size' => '',
    			'mime_types' => '',
    		),
    		array(
    			'key' => 'field_5b560fba61073',
    			'label' => 'Tekst over afbeelding',
    			'name' => 'kies_header_image_tekst',
    			'type' => 'wysiwyg',
    			'instructions' => '',
    			'required' => 0,
    			'conditional_logic' => array(
    				array(
    					array(
    						'field' => 'field_5804ccac137a5',
    						'operator' => '==',
    						'value' => 'show_header_image',
    					),
    				),
    			),
    			'wrapper' => array(
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'default_value' => '',
    			'tabs' => 'all',
    			'toolbar' => 'basic',
    			'media_upload' => 0,
    			'delay' => 1,
    		),
    	),
    	'location' => array(
    		array(
    			array(
    				'param' => 'post_type',
    				'operator' => '==',
    				'value' => 'page',
    			),
    		),
    		array(
    			array(
    				'param' => 'taxonomy',
    				'operator' => '==',
    				'value' => 'dossiers',
    			),
    		),
    	),
    	'menu_order' => 0,
    	'position' => 'acf_after_title',
    	'style' => 'default',
    	'label_placement' => 'top',
    	'instruction_placement' => 'label',
    	'hide_on_screen' => '',
    	'active' => 1,
    	'description' => '',
    ));


  //====================================================================================================
  // instellingen voor contactformulier onder nieuwsberichten
  // 
	acf_add_local_field_group(array (
		'key' => 'group_56a73cbfdf435',
		'title' => 'Instellingen voor contactformulier',
		'fields' => array (
			array (
				'key' => 'field_56a73cbfe31be',
				'label' => 'Contact- / reactieformulier',
				'name' => 'contactformulier',
				'type' => 'post_object',
				'instructions' => 'Dit formulier wordt onderaan een bericht of pagina getoond als reactiemogelijkheid.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array (
					0 => 'wpcf7_contact_form',
				),
				'taxonomy' => array (
				),
				'allow_null' => 0,
				'multiple' => 0,
				'return_format' => 'id',
				'ui' => 1,
			),

			array(
				'key' => 'field_5acb5e24804dc',
				'label' => 'Contenttypes',
				'name' => 'contactformulier_documenttypes',
				'type' => 'checkbox',
				'instructions' => 'Kies de contenttypes waarvoor het reactieformulier actief moet zijn:',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'post' => 'Berichten',
					'page' => 'Pagina\'s',
					'document' => 'Document',
					'event' => 'Evenementen',
				),
				'allow_custom' => 0,
				'save_custom' => 0,
				'default_value' => array(
				),
				'layout' => 'vertical',
				'toggle' => 0,
				'return_format' => 'value',
			),			
			array (
				'key' => 'field_56a73ce794fcf',
				'label' => 'Lege naam',
				'name' => 'lege_naam',
				'type' => 'text',
				'instructions' => 'Foutboodschap als naam leeg is',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'State your name, please.',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
			array (
				'key' => 'field_56a73d2e94fd0',
				'label' => 'Lege suggestie',
				'name' => 'lege_suggestie',
				'type' => 'text',
				'instructions' => 'Foutboodschap als er geen suggestie of vraag is ingevuld',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'Please enter a question or a suggestion.',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
			array (
				'key' => 'field_56a73d6294fd1',
				'label' => 'Leeg mailadres',
				'name' => 'leeg_mailadres',
				'type' => 'text',
				'instructions' => 'Foutboodschap als er geen e-mailadres is ingevuld',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'Please state your email address, so we can respond to your message.',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'instellingen',
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

if( function_exists('acf_add_local_field_group') ):
  
    acf_add_local_field_group(array (
    	'key' => 'group_58da405ecc1c5',
    	'title' => ' Korte beschrijving',
    	'fields' => array (
    		array (
    			'default_value' => '',
    			'maxlength' => '',
    			'placeholder' => '',
    			'prepend' => '',
    			'append' => '',
    			'key' => 'field_58da406ee63df',
    			'label' => 'Korte beschrijving voor dossieroverzicht',
    			'name' => 'dossier_korte_beschrijving_voor_dossieroverzicht',
    			'type' => 'textarea',
    			'instructions' => '',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array (
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    		),
    	),
    	'location' => array (
    		array (
    			array (
    				'param' => 'taxonomy',
    				'operator' => '==',
    				'value' => 'dossiers',
    			),
    		),
    	),
    	'menu_order' => 0,
    	'position' => 'acf_after_title',
    	'style' => 'default',
    	'label_placement' => 'top',
    	'instruction_placement' => 'label',
    	'hide_on_screen' => '',
    	'active' => 1,
    	'description' => '',
    ));
  


endif;

//========================================================================================================

add_action( 'init', 'cptui_register_my_cpts' );

function cptui_register_my_cpts() {


	$labels = array(
		"name"                  => __( 'Carrousels', 'wp-rijkshuisstijl' ),
		"singular_name"         => __( 'Carrousel', 'wp-rijkshuisstijl' ),
		"menu_name"             => __( 'Carrousels', 'wp-rijkshuisstijl' ),
		"all_items"             => __( 'Alle carrousels', 'wp-rijkshuisstijl' ),
		"add_new"               => __( 'Nieuwe carrousel toevoegen', 'wp-rijkshuisstijl' ),
		"add_new_item"          => __( 'Voeg nieuwe carrousel toe', 'wp-rijkshuisstijl' ),
		"edit_item"             => __( 'Bewerk carrousel', 'wp-rijkshuisstijl' ),
		"new_item"              => __( 'Nieuwe carrousel', 'wp-rijkshuisstijl' ),
		"view_item"             => __( 'Bekijk carrousel', 'wp-rijkshuisstijl' ),
		"search_items"          => __( 'Zoek carrousel', 'wp-rijkshuisstijl' ),
		"not_found"             => __( 'Geen carrousels gevonden', 'wp-rijkshuisstijl' ),
		"not_found_in_trash"    => __( 'Geen carrousels gevonden in de prullenbak', 'wp-rijkshuisstijl' ),
		"featured_image"        => __( 'Uitgelichte afbeelding', 'wp-rijkshuisstijl' ),
		"archives"              => __( 'Overzichten', 'wp-rijkshuisstijl' ),
		"uploaded_to_this_item" => __( 'Bijbehorende bestanden', 'wp-rijkshuisstijl' ),
		);

	$args = array(
		"label"                 => __( 'Carrousels', '' ),
		"labels"                => $labels,
		"description"           => "Foto\'s en links. Toe te voegen aan pagina\'s en taxonomieen op Digitale Overheid",
		"public"                => true,
		"publicly_queryable"    => false,
		"show_ui"               => true,
		"show_in_rest"          => false,
		"rest_base"             => "",
		"has_archive"           => false,
		"show_in_menu"          => true,
		"exclude_from_search"   => false,
		"capability_type"       => "post",
		"map_meta_cap"          => true,
		"hierarchical"          => false,
		"rewrite"               => array( "slug" => "carrousel", "with_front" => false ),
		"query_var"             => false,
		"supports"              => array( "title", "excerpt", "revisions" ),					);
	register_post_type( RHSWP_CPT_SLIDER, $args );

// End of cptui_register_my_cpts()

}

//========================================================================================================

if( function_exists('acf_add_local_field_group') ):

  
  acf_add_local_field_group(array (
  	'key' => 'group_5804da997fa03',
  	'title' => 'content voor carrousel',
  	'fields' => array (
  		array (
  			'key' => 'field_5804daa4dc66c',
  			'label' => "Voeg foto's en teksten toe",
  			'name' => 'carrousel_items',
  			'type' => 'repeater',
  			'instructions'   => '',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'collapsed' => '',
  			'min' => '1',
  			'max' => '5',
  			'layout' => 'block',
  			'button_label' => 'Nieuwe foto',
  			'sub_fields' => array (
  				array (
  					'key' => 'field_5804dabbdc66d',
      			'label'   => __( 'Afbeelding bij dit item', 'wp-rijkshuisstijl' ),
  					'name' => 'carrousel_item_photo',
  					'type' => 'image',
  					'instructions'   => 'Deze afbeelding moet 1200px bij 400px groot zijn',
  					'required' => 1,
  					'conditional_logic' => 0,
  					'wrapper' => array (
  						'width' => '',
  						'class' => '',
  						'id' => '',
  					),
  					'return_format' => 'array',
  					'preview_size' => 'medium_large',
  					'library' => 'all',
  					'min_width' => '1200',
  					'min_height' => '400',
  					'min_size' => '',
  					'max_width' => '1200',
  					'max_height' => '400',
  					'max_size' => '',
  					'mime_types' => '',
  				),
  				array (
  					'key'   => 'field_5804dc3bdc66e',
      			'label'   => __( 'Titel bij dit item', 'wp-rijkshuisstijl' ),
  					'name'  => 'carrousel_item_title',
  					'type'  => 'text',
  					'instructions'   => '',
  					'required' => 0,
  					'conditional_logic' => 0,
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
  					'key' => 'field_5804dc41dc66f',
      			'label'   => __( 'Korte tekst bij dit item', 'wp-rijkshuisstijl' ),
  					'name' => 'carrousel_item_short_text',
  					'type' => 'textarea',
  					'instructions'   => '',
  					'required' => 0,
  					'conditional_logic' => 0,
  					'wrapper' => array (
  						'width' => '',
  						'class' => '',
  						'id' => '',
  					),
  					'default_value' => '',
  					'placeholder' => '',
  					'maxlength' => '',
  					'rows' => '',
					'new_lines' => 'None',
  				),
  
  				array (
  					'key' => 'field_5808c01e6c841',
      			'label'   => __( 'Soort link', 'wp-rijkshuisstijl' ),
  					'name' => 'carrousel_item_link_type',
  					'type' => 'radio',
  					'instructions' => 'Keuze: link naar een dossier of naar een pagina / bericht?',
  					'required' => 1,
  					'conditional_logic' => 0,
  					'wrapper' => array (
  						'width' => '',
  						'class' => '',
  						'id' => '',
  					),
  					'choices' => array (
  						'pagina'  => __( 'Naar een pagina / bericht', 'wp-rijkshuisstijl' ),
  						'dossier' => __( 'Naar een dossier', 'wp-rijkshuisstijl' ),
  					),
  					'allow_null' => 0,
  					'other_choice' => 0,
  					'save_other_choice' => 0,
  					'default_value' => 'pagina',
  					'layout' => 'horizontal',
  					'return_format' => 'value',
  				),
  				array (
  					'key' => 'field_5804dc47dc670',
      			'label'   => __( 'Kies een pagina of bericht:', 'wp-rijkshuisstijl' ),
  					'name' => 'carrousel_item_link_page',
  					'type' => 'relationship',
  					'instructions' => '',
  					'required' => 0,
  					'conditional_logic' => array (
  						array (
  							array (
  								'field' => 'field_5808c01e6c841',
  								'operator' => '==',
  								'value' => 'pagina',
  							),
  						),
  					),
  					'wrapper' => array (
  						'width' => '',
  						'class' => '',
  						'id' => '',
  					),
  					'post_type' => array (
  						0 => 'post',
  						1 => 'page',
  						2 => 'event',
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
  					'max' => 1,
  					'return_format' => 'object',
  				),
  				array (
  					'key' => 'field_5808bfe86c840',
      			'label'   => __( 'Kies een dossier:', 'wp-rijkshuisstijl' ),
  					'name' => 'carrousel_item_link_dossier',
  					'type' => 'taxonomy',
  					'instructions' => '',
  					'required' => 0,
  					'conditional_logic' => array (
  						array (
  							array (
  								'field' => 'field_5808c01e6c841',
  								'operator' => '==',
  								'value' => 'dossier',
  							),
  						),
  					),
  					'wrapper' => array (
  						'width' => '',
  						'class' => '',
  						'id' => '',
  					),
  					'taxonomy' => 'dossiers',
  					'field_type' => 'radio',
  					'allow_null' => 0,
  					'add_term' => 1,
  					'save_terms' => 0,
  					'load_terms' => 0,
  					'return_format' => 'id',
  					'multiple' => 0,
  				),

  			),
  		),
  	),
  	'location' => array (
  		array (
  			array (
  				'param' => 'post_type',
  				'operator' => '==',
  				'value' => RHSWP_CPT_SLIDER,
  			),
  		),
  	),
  	'menu_order' => 0,
  	'position' => 'normal',
  	'style' => 'default',
  	'label_placement' => 'top',
  	'instruction_placement' => 'label',
    'hide_on_screen' => array (
      0 => 'wpseo_meta',
      1 => 'wpseo'
    ),
  	'active' => 1,
  	'description' => '',
  ));

  //======================================================================================================
  
  acf_add_local_field_group(array(
  	'key' => 'group_5b30e4089957f',
  	'title' => 'Kleuren voor NL Digibeter',
  	'fields' => array(
  		array(
  			'key' => 'field_5b30e4db4e762',
  			'label' => 'Achtergrondkleur (let op: Nederlands of Engels!)',
  			'name' => 'digibeter_term_achtergrondkleur',
  			'type' => 'select',
  			'description' => 'In de header images zit ook tekst. Let er daarom op of je wel of geen ehm "<em>Engelse</em>" kleur kiest.',
  			'instructions' => '<img src="' . RHSWP_THEMEFOLDER . '/images/digibeter-kleuren.png" width="272" height="280" alt="">',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'choices' => array(
  				'digibeter-oranje' => 'oranje digibeter (Nederlands)',
  				'digibeter-blauw' => 'blauw digibeter (Nederlands)',
  				'digibeter-groen' => 'groen digibeter (Nederlands)',
  				'digibeter-violet' => 'violet digibeter (Nederlands)',
  				'digibeter-paars' => 'paars digibeter (Nederlands)',

  				'digibeter-en-orange' => 'oranje digibeter (Engels)',
  				'digibeter-en-blue' => 'blauw digibeter (Engels)',
  				'digibeter-en-green' => 'groen digibeter (Engels)',
  				'digibeter-en-violet' => 'violet digibeter (Engels)',
  				'digibeter-en-purple' => 'paars digibeter (Engels)',
  				
  				'da-06' => 'NDA - algemeen',
  				'da-01-problemen-oplossen' => 'NDA H1 - Problemen oplossen met datagedreven werken',
  				'da-02-wetgeving-publieke-waarden' => 'NDA H2 - Aandacht voor wetgeving en publieke waarden',
  				'da-03-overheidsdata-verbeteren' => 'NDA H3 - Overheidsdata kwalitatief verbeteren en efficiënter benutten',
  				'da-04-kennis-verzamelen-verbeteren' => 'NDA H4 - Kennis over datagedreven werken verzamelen en delen',
  				'da-05-mensen-organisatie-cultuurverandering' => 'NDA H5 - Investeren in mensen, organisatie en cultuurverandering',
  				
  			),
  			'default_value' => array(
  			),
  			'allow_null' => 0,
  			'multiple' => 0,
  			'ui' => 0,
  			'ajax' => 0,
  			'return_format' => 'value',
  			'placeholder' => '',
  		),
  	),
  	'location' => array(
  		array(
  			array(
  				'param' => 'taxonomy',
  				'operator' => '==',
  				'value' => RHSWP_CT_DIGIBETER,
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
  
  //======================================================================================================

  acf_add_local_field_group(array(
  	'key' => 'group_5b3a69b639877',
  	'title' => 'NL Digibeter landingspagina',
  	'fields' => array(
  		array(
  			'key' => 'field_5b3a69dc16a11',
  			'label' => 'Inleiding',
  			'name' => 'digibeter_content_intro',
  			'type' => 'wysiwyg',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => '',
  			'tabs' => 'all',
  			'toolbar' => 'full',
  			'media_upload' => 1,
  			'delay' => 0,
  		),
  	),
  	'location' => array(
  		array(
  			array(
  				'param' => 'page_template',
  				'operator' => '==',
  				'value' => 'page_digibeter-home.php',
  			),
  		),
  	),
  	'menu_order' => 0,
  	'position' => 'acf_after_title',
  	'style' => 'default',
  	'label_placement' => 'top',
  	'instruction_placement' => 'label',
  	'hide_on_screen' => '',
  	'active' => 1,
  	'description' => '',
  ));
  
  //======================================================================================================

  //====================================================================================================
  // contentblocks onderaan een pagina.
  // - of vrij ingevoerde links
  // - of berichten (algemeen of gefilterd op categorie)
  acf_add_local_field_group(array (
  	'key' => 'group_5804cc93cxac6',
  	'title' => __( 'Content-blokken', 'wp-rijkshuisstijl' ),
  	'fields' => array (
  		array (
  			'key' => 'field_5804cd3ef7829',
  			'label'   => __( 'Voeg 1 of meer blokken toe', 'wp-rijkshuisstijl' ),
  			'name' => 'extra_contentblokken',
  			'type' => 'repeater',
  			'instructions'   => __( 'Deze blokken bestaan uit berichten, pagina\s of uit links. Berichten worden automatisch geselecteerd. Links moet je handmatig toevoegen. ', 'wp-rijkshuisstijl' ),
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'collapsed' => 'field_5804cd67f782a',
  			'min' => '',
  			'max' => '',
  			'layout' => 'row',
  			'button_label' => 'Nieuw blok toevoegen',
  			'sub_fields' => array (
  				array (
  					'key' => 'field_5804cd67f782a',
      			'label'   => __( 'Titel boven contentblok', 'wp-rijkshuisstijl' ),
  					'name' => 'extra_contentblok_title',
  					'type' => 'text',
  					'instructions'   => '',
  					'required' => 1,
  					'conditional_logic' => 0,
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
  					'key' => 'field_5804cde25e99a',
      			'label'   => __( 'Wat wil je tonen in dit contentblok?', 'wp-rijkshuisstijl' ),
  					'name' => 'extra_contentblok_type_block',
  					'type' => 'radio',
  					'instructions'   => '',
  					'required' => 1,
  					'conditional_logic' => 0,
  					'wrapper' => array (
  						'width' => '',
  						'class' => '',
  						'id' => '',
  					),
  					'choices' => array (
  						'berichten'           => __( 'Automatische lijst van berichten', 'wp-rijkshuisstijl' ),
  						'berichten_paginas'   => __( 'Berichten of pagina\'s', 'wp-rijkshuisstijl' ),
  						'algemeen'            => __( 'Vrije invoer: links in de volgorde die ik bepaal', 'wp-rijkshuisstijl' ),
  						'select_dossiers'     => __( 'Een selectie van dossiers', 'wp-rijkshuisstijl' ),
  						'events'              => __( 'Automatische lijst van evenementen', 'wp-rijkshuisstijl' ),
  					),
  					'allow_null' => 0,
  					'other_choice' => 0,
  					'save_other_choice' => 0,
  					'default_value' => 'berichten_paginas',
  					'layout' => 'vertical',
  					'return_format' => 'value',
  				),
  				array (
  					'key' => 'field_5804cd7bf782b',
            'label'   => __( 'Links in je contentblok', 'wp-rijkshuisstijl' ),
  					'name' => 'extra_contentblok_algemeen_links',
  					'type' => 'repeater',
  					'instructions' => '',
  					'required' => 1,
  					'conditional_logic' => array (
  						array (
  							array (
  								'field' => 'field_5804cde25e99a',
  								'operator' => '==',
  								'value' => 'algemeen',
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
  					'layout' => 'table',
  					'button_label' => 'Nieuwe regel',
  					'sub_fields' => array (
  						array (
  							'key' => 'field_580ddadb4597b',
                'label'   => __( 'Linktekst', 'wp-rijkshuisstijl' ),
  							'name' => 'extra_contentblok_algemeen_links_linktekst',
  							'type' => 'text',
  							'instructions' => '',
  							'required' => 1,
  							'conditional_logic' => 0,
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
  							'key' => 'field_580ddb0e4597c',
  							'label' => 'Link',
  							'name' => 'extra_contentblok_algemeen_links_url',
  							'type' => 'url',
  							'instructions' => '',
  							'required' => 1,
  							'conditional_logic' => 0,
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
  				array (
  					'key' => 'field_5804d01355657',
      			'label'   => __( 'Wil je de berichten filteren op categorie?', 'wp-rijkshuisstijl' ),
  					'name' => 'extra_contentblok_categoriefilter',
  					'type' => 'radio',
            'instructions'   => __( 'Als deze pagina een dossier heeft, worden berichten sowieso gefilterd op het dossier.', 'wp-rijkshuisstijl' ),  			
  					'required' => 1,
  					'conditional_logic' => array (
  						array (
  							array (
  								'field' => 'field_5804cde25e99a',
  								'operator' => '==',
  								'value' => 'berichten',
  							),
  						),
  					),
  					'wrapper' => array (
  						'width' => '',
  						'class' => '',
  						'id' => '',
  					),
  					'choices' => array (
  						'ja' => 'Ja, toon alleen berichten uit een bepaalde categorie.',
  						'nee' => 'Nee, toon alle berichten.',
  					),
  					'allow_null' => 0,
  					'other_choice' => 0,
  					'save_other_choice' => 0,
  					'default_value' => 'nee',
  					'layout' => 'vertical',
  					'return_format' => 'value',
  				),
  				array (
  					'key' => 'field_5804d0ae7e521',
      			'label'   => __( 'Kies de categorie', 'wp-rijkshuisstijl' ),
  					'name' => 'extra_contentblok_chosen_category',
  					'type' => 'taxonomy',
  					'instructions'   => '',
  					'required' => 1,
  					'conditional_logic' => array (
  						array (
  							array (
  								'field' => 'field_5804cde25e99a',
  								'operator' => '==',
  								'value' => 'berichten',
  							),
  							array (
  								'field' => 'field_5804d01355657',
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
  					'taxonomy' => 'category',
  					'field_type' => 'checkbox',
  					'allow_null' => 0,
  					'add_term' => 1,
  					'save_terms' => 0,
  					'load_terms' => 0,
  					'return_format' => 'id',
  					'multiple' => 0,
  				),
  				array (
  					'key' => 'field_5804d1f49c89c',
      			'label'   => __( 'Maximum aantal berichten', 'wp-rijkshuisstijl' ),
  					'name' => 'extra_contentblok_maxnr_posts',
  					'type' => 'select',
  					'instructions'   => '',
  					'required' => 1,
  					'conditional_logic' => array (
  						array (
  							array (
  								'field' => 'field_5804cde25e99a',
  								'operator' => '==',
  								'value' => 'berichten',
  							),
  						),
  					),
  					'wrapper' => array (
  						'width' => '',
  						'class' => '',
  						'id' => '',
  					),
  					'choices' => array (
  						1 => '1',
  						2 => '2',
  						3 => '3',
  						4 => '4',
  						5 => '5',
  						6 => '6',
  						7 => '7',
  						8 => '8',
  						9 => '9',
  						10 => '10',
  						11 => '11',
  						12 => '12',
  						13 => '13',
  						14 => '14',
  						15 => '15',
  						16 => '16',
  						17 => '17',
  						18 => '18',
  						19 => '19',
  						20 => '20',
  					),
  					'default_value' => array (
  						0 => 6,
  					),
  					'allow_null' => 0,
  					'multiple' => 0,
  					'ui' => 0,
  					'ajax' => 0,
  					'return_format' => 'value',
  					'placeholder' => '',
  				),
  				array (
  					'key' => 'field_5804d943476f2',
      			'label'   => __( 'Toon hoeveel berichten met hun uitgelichte afbeelding', 'wp-rijkshuisstijl' ),
  					'name' => 'extra_contentblok_maxnr_posts_with_featured_image',
  					'type' => 'select',
  					'instructions'   => '',
  					'required' => 1,
  					'conditional_logic' => array (
  						array (
  							array (
  								'field' => 'field_5804cde25e99a',
  								'operator' => '==',
  								'value' => 'berichten',
  							),
  						),
  					),
  					'wrapper' => array (
  						'width' => '',
  						'class' => '',
  						'id' => '',
  					),
  					'choices' => array (
  						0 => 'geen',
  						1 => '1',
  						2 => '2',
  						3 => '3',
  						4 => '4',
  						5 => '5',
  						'alle' => 'Alle berichten tonen met uitgelichte afbeelding',
  					),
  					'default_value' => array (
  						0 => 1,
  					),
  					'allow_null' => 0,
  					'multiple' => 0,
  					'ui' => 0,
  					'ajax' => 0,
  					'return_format' => 'value',
  					'placeholder' => '',
  				),

  				array (
  					'key' => 'field_5804d943474a9',
      			'label'   => __( 'Hoeveel evenementen maximaal?', 'wp-rijkshuisstijl' ),
  					'name' => 'extra_contentblok_maxnr_events',
  					'type' => 'select',
  					'instructions'   => '',
  					'required' => 1,
  					'conditional_logic' => array (
  						array (
  							array (
  								'field' => 'field_5804cde25e99a',
  								'operator' => '==',
  								'value' => 'events',
  							),
  						),
  					),
  					'wrapper' => array (
  						'width' => '',
  						'class' => '',
  						'id' => '',
  					),
  					'choices' => array (
  						1 => '1',
  						2 => '2',
  						3 => '3',
  						4 => '4',
  						5 => '5',
  						6 => '6',
  						9 => '9',
  						12 => '12',
  						15 => '15',
  						18 => '18',
  						21 => '21',
  						24 => '24',
  					),
  					'default_value' => array (
  						3 => 3,
  					),
  					'allow_null' => 0,
  					'multiple' => 0,
  					'ui' => 0,
  					'ajax' => 0,
  					'return_format' => 'value',
  					'placeholder' => '',
  				),
  				array (
      			'key' => 'field_68247045955b10',
      			'label'   => __( 'Geselecteerde dossiers', 'wp-rijkshuisstijl' ),
      			'name' => 'select_dossiers_list',
      			'type' => 'taxonomy',
            'instructions'   => __( 'De dossiers die je hier kiest worden bovenaan de pagina getoond met speciale layout.', 'wp-rijkshuisstijl' ),  			
      			'required' => 0,
      			'conditional_logic' => array (
      				array (
      					array (
  								'field' => 'field_5804cde25e99a',
      						'operator' => '==',
      						'value' => 'select_dossiers',
      					),
      				),
      			),
  
      			'wrapper' => array (
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'taxonomy' => 'dossiers',
      			'field_type' => 'checkbox',
      			'allow_null' => 0,
      			'add_term' => 0,
      			'save_terms' => 0,
      			'load_terms' => 0,
      			'return_format' => 'id',
      			'multiple' => 0,
  

  				),
  				array (
  					'key' => 'field_58247045955a9',
  					'label' => 'Berichten, documenten en pagina\'s',
  					'name' => 'select_berichten_paginas',
  					'type' => 'relationship',
  					'instructions' => '',
  					'required' => 1,
  					'conditional_logic' => array (
  						array (
  							array (
  								'field' => 'field_5804cde25e99a',
  								'operator' => '==',
  								'value' => 'berichten_paginas',
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
					'key' => 'field_58247630e21bb',
					'label' => 'Toon samenvattingen?',
					'name' => 'select_berichten_paginas_toon_samenvatting',
					'type' => 'radio',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_5804cde25e99a',
								'operator' => '==',
								'value' => 'berichten_paginas',
							),
						),
					),
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array (
						'ja' => 'Ja, toon samenvattingen onder de link.',
						'nee' => 'Nee, toon alleen de link',
					),
					'allow_null' => 0,
					'other_choice' => 0,
					'save_other_choice' => 0,
					'default_value' => 'nee',
					'layout' => 'horizontal',
					'return_format' => 'value',
				),  				
  			),
  		),
  	),
  	'location' => array (
  		array (
  			array (
  				'param' => 'post_type',
  				'operator' => '==',
  				'value' => 'page',
  			),
  		),
  		array (
  			array (
  				'param' => 'taxonomy',
  				'operator' => '==',
  				'value' => 'dossiers',
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


  acf_add_local_field_group(array(
  	'key' => 'group_5b62a5dfca2ad',
  	'title' => 'Opbouw homepage',
  	'fields' => array(
  		array(
  			'key' => 'field_5b62a5fcfad9f',
  			'label' => 'Kies onderwerpen (dossiers)',
  			'name' => 'home_onderwerpen_dossiers',
  			'type' => 'repeater',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'collapsed' => 'field_5b62a673fada0',
  			'min' => 0,
  			'max' => 0,
  			'layout' => 'block',
  			'button_label' => '',
  			'sub_fields' => array(
  				array(
  					'key' => 'field_5b62a673fada0',
  					'label' => 'kies een onderwerp',
  					'name' => 'kies_een_onderwerp',
  					'type' => 'taxonomy',
  					'instructions' => '',
  					'required' => 0,
  					'conditional_logic' => 0,
  					'wrapper' => array(
  						'width' => '',
  						'class' => '',
  						'id' => '',
  					),
  					'taxonomy' => 'dossiers',
  					'field_type' => 'select',
  					'allow_null' => 1,
  					'add_term' => 0,
  					'save_terms' => 0,
  					'load_terms' => 0,
  					'return_format' => 'object',
  					'multiple' => 0,
  				),
  				array(
  					'key' => 'field_5b62f190714ff',
  					'label' => 'Welke beschrijving',
  					'name' => 'welke_beschrijving',
  					'type' => 'radio',
  					'instructions' => 'Welke beschrijving wil je bij dit onderwerp tonen?',
  					'required' => 0,
  					'conditional_logic' => 0,
  					'wrapper' => array(
  						'width' => '',
  						'class' => '',
  						'id' => '',
  					),
  					'choices' => array(
  						'standaardbeschrijving' => 'Standaardbeschrijving',
  						'andere_tekst' => 'Een andere tekst, namelijk:',
  					),
  					'allow_null' => 0,
  					'other_choice' => 0,
  					'save_other_choice' => 0,
  					'default_value' => 'standaardbeschrijving',
  					'layout' => 'vertical',
  					'return_format' => 'value',
  				),
  				array(
  					'key' => 'field_5b62f20671500',
  					'label' => 'Andere beschrijving',
  					'name' => 'andere_beschrijving',
  					'type' => 'textarea',
  					'instructions' => '',
  					'required' => 0,
  					'conditional_logic' => array(
  						array(
  							array(
  								'field' => 'field_5b62f190714ff',
  								'operator' => '==',
  								'value' => 'andere_tekst',
  							),
  						),
  					),
  					'wrapper' => array(
  						'width' => '',
  						'class' => '',
  						'id' => '',
  					),
  					'default_value' => '',
  					'placeholder' => '',
  					'maxlength' => '',
  					'rows' => '',
  					'new_lines' => '',
  				),
  			),
  		),
  	),
  	'location' => array(
  		array(
  			array(
  				'param' => 'page_template',
  				'operator' => '==',
  				'value' => 'front-page.php',
  			),
  		),
  	),
  	'menu_order' => 0,
  	'position' => 'acf_after_title',
  	'style' => 'default',
  	'label_placement' => 'top',
  	'instruction_placement' => 'label',
  	'hide_on_screen' => '',
  	'active' => 1,
  	'description' => '',
  ));

  //------------------------------------------------------------------------------------------------------
  // check om te bepalen of bij een dossiers aparte links getoond moeten worden voor berichten
  // als er voor een dossier meer dan XX berichten zijn dan wordt, in plaats van 1 simpele link naar
  // alle berichten, een link getoond naar een pagina waarop de beschikbare berichten getoond worden
  // voor de combinatie dossier + categorie
  // 
  acf_add_local_field_group(array(
  	'key' => 'group_5b8f9051e2a03',
  	'title' => 'Instellingen voor berichten bij een dossier',
  	'fields' => array(
  		array(
  			'key' => 'field_5b8f916c20a29',
  			'label' => 'Ondergrens berichtencheck',
  			'name' => 'dossier_post_overview_categor_threshold',
  			'type' => 'select',
  			'instructions' => '',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'choices' => array(
  				1 => '1',
  				2 => '2',
  				3 => '3',
  				4 => '4',
  				5 => '5',
  				6 => '6',
  				7 => '7',
  				8 => '8',
  				9 => '9',
  				10 => '10',
  				15 => '15',
  				20 => '20',
  				25 => '25',
  				40 => '40',
  			),
  			'default_value' => array(
  				0 => 10,
  			),
  			'allow_null' => 0,
  			'multiple' => 0,
  			'ui' => 0,
  			'return_format' => 'value',
  			'ajax' => 0,
  			'placeholder' => '',
  		),
  		array(
  			'key' => 'field_5b8f906dd4f37',
  			'label' => 'Selecteer 1 of meer categorieen',
  			'name' => 'dossier_post_overview_categories',
  			'type' => 'taxonomy',
  			'instructions' => 'Selecteer hier de categorieen die apart getoond mogen worden in een dossieroverzicht. Als er berichten bestaan in deze categorie EN het zijn er meer dan \'Ondergrens berichtencheck\' dan worden aparte overzichtspagina\'s per categorie getoond.',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'taxonomy' => 'category',
  			'field_type' => 'checkbox',
  			'allow_null' => 0,
  			'add_term' => 0,
  			'save_terms' => 0,
  			'load_terms' => 0,
  			'return_format' => 'id',
  			'multiple' => 0,
  		),
  		array(
  			'key' => 'field_5b8f96a6d3686',
  			'label' => 'Pagina voor berichten',
  			'name' => 'dossier_post_overview_page',
  			'type' => 'post_object',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'post_type' => array(
  				0 => 'page',
  			),
  			'taxonomy' => '',
  			'allow_null' => 1,
  			'multiple' => 0,
  			'return_format' => 'object',
  			'ui' => 1,
  		),
  		array(
  			'key' => 'field_5b8f98627f62a',
  			'label' => 'Pagina voor evenementen',
  			'name' => 'dossier_events_overview_page',
  			'type' => 'post_object',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'post_type' => array(
  				0 => 'page',
  			),
  			'taxonomy' => '',
  			'allow_null' => 0,
  			'multiple' => 0,
  			'return_format' => 'object',
  			'ui' => 1,
  		),
  		array(
  			'key' => 'field_5b8f98897f62b',
  			'label' => 'Pagina voor documenten',
  			'name' => 'dossier_documents_overview_page',
  			'type' => 'post_object',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'post_type' => array(
  				0 => 'page',
  			),
  			'taxonomy' => '',
  			'allow_null' => 0,
  			'multiple' => 0,
  			'return_format' => 'object',
  			'ui' => 1,
  		),
  		array(
  			'key' => 'field_5ca5e711e2a9c',
  			'label' => 'Archief-dossier',
  			'name' => 'site_archief_dossier',
  			'type' => 'taxonomy',
  			'instructions' => 'Dit dossier zal grijs gemarkeerd worden. Zo zien bezoekers beter dat content niet meer actief wordt bijgehouden. Selecteer het dossier dat de status \'archief\' heeft. Alle onderliggende dossiers zullen ook de status \'archief\' krijgen.',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'taxonomy' => 'dossiers',
  			'field_type' => 'select',
  			'allow_null' => 0,
  			'add_term' => 0,
  			'save_terms' => 0,
  			'load_terms' => 0,
  			'return_format' => 'id',
  			'multiple' => 0,
  		),
  	),
  	'location' => array(
  		array(
  			array(
  				'param' => 'options_page',
  				'operator' => '==',
  				'value' => 'instellingen',
  			),
  		),
  	),
  	'menu_order' => 0,
  	'position' => 'normal',
  	'style' => 'default',
  	'label_placement' => 'top',
  	'instruction_placement' => 'label',
  	'hide_on_screen' => '',
  	'active' => true,
  	'description' => '',
  ));


  //------------------------------------------------------------------------------------------------------
  // sitemap instellingen: tonen / verbergen van lijst met categorie, laatste berichten, dossierlijst
  //
  acf_add_local_field_group(array(
  	'key' => 'group_5bb213f55a1f6',
  	'title' => 'Sitemap: wat wel of niet tonen?',
  	'fields' => array(
  		array(
  			'key' => 'field_5bb214191eeb8',
  			'label' => 'Welke pagina\'s NIET tonen?',
  			'name' => 'sitemap_settings_hide_pages',
  			'type' => 'relationship',
  			'instructions' => 'Kies hier de pagina\'s die je <strong style="color: red">niet</strong> wil tonen op de sitemap. Ook de pagina\'s onder de pagina die je hier kiest worden dan verborgen.',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'post_type' => array(
  				0 => 'page',
  			),
  			'taxonomy' => '',
  			'filters' => array(
  				0 => 'search',
  				1 => 'taxonomy',
  			),
  			'elements' => '',
  			'min' => '',
  			'max' => '',
  			'return_format' => 'object',
  		),
  		array(
  			'key' => 'field_5bb221088bf7a',
  			'label' => 'Wil je de lijst met dossiers tonen op de 404-pagina?',
  			'name' => 'sitemap_settings_toondossiers',
  			'type' => 'radio',
  			'instructions' => '',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'choices' => array(
  				'ja' => 'Ja, toon de lijst met dossiers',
  				'nee' => 'Nee, verberg de lijst met dossiers',
  			),
  			'allow_null' => 1,
  			'other_choice' => 0,
  			'default_value' => 'ja',
  			'layout' => 'vertical',
  			'return_format' => 'value',
  			'save_other_choice' => 0,
  		),
  		array(
  			'key' => 'field_5bb224403dd0f',
  			'label' => 'Wil je de lijst met categorieën tonen op de 404-pagina?',
  			'name' => 'sitemap_settings_tooncategorie',
  			'type' => 'radio',
  			'instructions' => '',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'choices' => array(
  				'ja' => 'Ja, toon de lijst met categorieën',
  				'nee' => 'Nee, verberg de lijst met categorieën',
  			),
  			'allow_null' => 1,
  			'other_choice' => 0,
  			'default_value' => 'ja',
  			'layout' => 'vertical',
  			'return_format' => 'value',
  			'save_other_choice' => 0,
  		),
  		array(
  			'key' => 'field_5bb226d651e14',
  			'label' => 'Wil je de laatste berichten tonen?',
  			'name' => 'sitemap_settings_toonberichten',
  			'type' => 'radio',
  			'instructions' => '',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'choices' => array(
  				'ja' => 'Ja, toon een lijst met de laatste berichten',
  				'nee' => 'Nee, verberg de laatste berichten',
  			),
  			'allow_null' => 1,
  			'other_choice' => 0,
  			'default_value' => 'ja',
  			'layout' => 'vertical',
  			'return_format' => 'value',
  			'save_other_choice' => 0,
  		),
  	),
  	'location' => array(
  		array(
  			array(
  				'param' => 'options_page',
  				'operator' => '==',
  				'value' => 'instellingen',
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
  

  //------------------------------------------------------------------------------------------------------
  // sitemap instellingen: boodschap op de sitemap pagina (obv template)
  //
  acf_add_local_field_group(array(
  	'key' => 'group_5bb212c2df202',
  	'title' => 'Sitemap: let op',
  	'fields' => array(
  		array(
  			'key' => 'field_5bb212ce666a8',
  			'label' => 'Sommige pagina\'s wel of niet tonen?',
  			'name' => '',
  			'type' => 'message',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'message' => 'Via de <a href="/wp-admin/themes.php?page=instellingen">theme instellingen</a> kun je bepalen welke pagina\'s verborgen moeten worden op de sitemap.',
  			'new_lines' => 'wpautop',
  			'esc_html' => 0,
  		),
  	),
  	'location' => array(
  		array(
  			array(
  				'param' => 'page_template',
  				'operator' => '==',
  				'value' => 'page_sitemap.php',
  			),
  		),
  	),
  	'menu_order' => 0,
  	'position' => 'acf_after_title',
  	'style' => 'default',
  	'label_placement' => 'top',
  	'instruction_placement' => 'label',
  	'hide_on_screen' => '',
  	'active' => 1,
  	'description' => '',
  ));

  //------------------------------------------------------------------------------------------------------
  // Extra layout-optie voor automatische afbeelding
  //
  acf_add_local_field_group(array(
    	'key' => 'group_5c9c94d6734bc',
    	'title' => 'Uitlijning uitgelichte afbeelding',
    	'fields' => array(
    		array(
    			'key' => 'field_5c9c9544cf719',
    			'label' => 'Uitgelichte afbeelding automatisch aan tekst toevoegen?',
    			'name' => 'featimg_automatic_insert',
    			'type' => 'radio',
    			'instructions' => 'Als je hier \'<em>Nee</em>\' kiest, dan kun je zelf in je tekst een foto toevoegen met de uitsnedes of uitlijning die je wilt. Als je dit op \'<em>Ja</em>\' laat staan, dan wordt de uitgelichte afbeelding rechtsbovenin de tekst ingevoegd.',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array(
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'choices' => array(
    				'ja' => 'Ja, automatisch invoegen',
    				'nee' => 'Nee, niet automatisch invoegen',
    			),
    			'allow_null' => 0,
    			'other_choice' => 0,
    			'default_value' => 'ja',
    			'layout' => 'vertical',
    			'return_format' => 'value',
    			'save_other_choice' => 0,
    		),
    	),
    	'location' => array(
    		array(
    			array(
    				'param' => 'post_type',
    				'operator' => '==',
    				'value' => 'post',
    			),
    		),
    		array(
    			array(
    				'param' => 'post_type',
    				'operator' => '==',
    				'value' => 'page',
    			),
    		),
    	),
    	'menu_order' => 0,
    	'position' => 'side',
    	'style' => 'default',
    	'label_placement' => 'top',
    	'instruction_placement' => 'field',
    	'hide_on_screen' => '',
    	'active' => true,
    	'description' => '',
  ));


endif;

//========================================================================================================

