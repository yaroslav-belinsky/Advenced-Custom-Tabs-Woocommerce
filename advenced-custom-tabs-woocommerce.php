<?php 

/*
Plugin Name: Advenced Custom Tabs Woocommerce
Description: Advenced Custom Tabs Woocommerce
Plugin URI: https://github.com/yaroslav-belinsky/Advenced-Custom-Tabs-Woocommerce
Author: Yaroslav Belinsky
Author URI: https://www.facebook.com/yaroslav.belinsky.7
Version: 0.1
*/
class AdvencedCustomTabsWoocommerce 
{
	//private $wcct = null;
	
	function __construct()
	{
		//$this->includes();
		//add_action( 'init', 'wcct', 0 );
		add_action( 'init',  array($this,'wcct' ));
		add_filter( 'woocommerce_product_tabs', array($this,'get_wcct' ) );
		add_action( 'init',  array($this,'get_wcct_metabox' ));
		//add_action( 'admin_menu', array($this,'registerAdvencedCustomTabsWoocommerceMenu' ) );
		//add_action( 'wp_footer', array($this,'phone_script'));
		add_filter( 'woocommerce_product_tabs', array($this,'woo_remove_product_tabs'), 98 );
	}
	
	// Register Custom Post Type
	function wcct() {

		$labels = array(
			'name'                => _x( 'Product tabs', 'Post Type General Name', 'wcct' ),
			'singular_name'       => _x( 'Product tab', 'Post Type Singular Name', 'wcct' ),
			'menu_name'           => __( 'WC custom tabs', 'wcct' ),
			'name_admin_bar'      => __( 'WC custom tabs', 'wcct' ),
			'parent_item_colon'   => __( 'Parent tab:', 'wcct' ),
			'all_items'           => __( 'All tabs', 'wcct' ),
			'add_new_item'        => __( 'Add New Tab', 'wcct' ),
			'add_new'             => __( 'Add Tab', 'wcct' ),
			'new_item'            => __( 'New tab', 'wcct' ),
			'edit_item'           => __( 'Edit tab', 'wcct' ),
			'update_item'         => __( 'Update tab', 'wcct' ),
			'view_item'           => __( 'View tab', 'wcct' ),
			'search_items'        => __( 'Search tab', 'wcct' ),
			'not_found'           => __( 'Not found', 'wcct' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'wcct' ),
		);
		$args = array(
			'label'               => __( 'Product tab', 'wcct' ),
			'description'         => __( 'Custom product tab', 'wcct' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'revisions', ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 10,
			'menu_icon'           => 'dashicons-editor-table',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => false,		
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		);
		register_post_type( 'wcct', $args );

	}



	function woo_remove_product_tabs( $tabs ) {
		$tabs_options = get_option('wcpct_settings');
		//print_r($tabs_options);
		if ($tabs_options['wcpct_description'])
	    unset( $tabs['description'] );      	// Remove the description tab
		if ($tabs_options['wcpct_reviews'])
	    unset( $tabs['reviews'] ); 			// Remove the reviews tab
		if ($tabs_options['wcpct_additional_information'])
	    unset( $tabs['additional_information'] );  	// Remove the additional information tab

	    return $tabs;

	}



	function registerAdvencedCustomTabsWoocommerceMenu(){
		add_menu_page( 'WC custom tabs', 'WC custom tabs', 'manage_options', 'manageAdvencedCustomTabsWoocommerce', array($this, 'manageAdvencedCustomTabsWoocommerce'), 'dashicons-randomize', 6 ); 
	}
	

	function manageAdvencedCustomTabsWoocommerce(){
		include_once 'inc/help.html';
	}


	function woo_new_product_tab( $tabs ) {
		
		// Adds the new tab
		
		

	}
	
	function get_wcct () {
		global $product;
      // WP_Query arguments
        $args = array (
          'post_type'              => array( 'wcct' ),
        );

        // The Query
       $query = new WP_Query( $args );
       
       $count = 3;
       foreach ($query->posts as $post) {
       		$tabs[$post->post_name] = array(
			'title' 	=> $post->post_title,
			'priority' 	=> (10*$count),
			'callback' => array($this,'render_tab'),
	        'content'  => (get_post_meta($post->ID, '_wcpct_global_tab', true))? apply_filters('the_content', $post->post_content ) : get_post_meta($product->id, '_wcpct_'.$post->post_name, true)//this allows shortcodes in custom tabs
			);
			$count++;
       }
      
  
    	return $tabs;
    }

    function render_tab($key,$tab){
        global $post;
        echo apply_filters('GWP_custom_tab_content',$tab['content'],$tab,$key);
    }
    function get_wcct_metabox () {
    	$args = array (
          'post_type'              => array( 'wcct' ),
        );

        // The Query
       $query = new WP_Query( $args );
        $config = array(
	      'id'             => 'wcpct',          // meta box id, unique per meta box
	      'title'          => 'Tabs content',          // meta box title
	      'pages'          => array('product'),      // post types, accept custom post types as well, default is array('post'); optional
	      'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	      'priority'       => 'high',            // order of meta box: high (default), low; optional
	      'fields'         => array(),            // list of meta fields (can be added by field arrays)
	      'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
	      'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	    );
       $my_meta2 =  new AT_Meta_Box($config);
       foreach ($query->posts as $post) { 
    		$my_meta2->addWysiwyg('_wcpct_'.$post->post_name,array('name'=> $post->post_title));
       }
       $my_meta2->Finish();
    
    }

}
 new AdvencedCustomTabsWoocommerce(); 
 require_once 'inc/admin/class-usage-demo.php';
 require_once 'inc/metabox/class-usage-demo.php';
?>