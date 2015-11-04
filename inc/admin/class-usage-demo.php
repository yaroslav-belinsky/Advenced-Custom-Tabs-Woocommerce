<?php
/*
Plugin Name: Demo Admin Page
Plugin URI: http://en.bainternet.info
Description: My Admin Page Class usage demo
Version: 1.2.9
Author: Bainternet, Ohad Raz
Author URI: http://en.bainternet.info
*/



  //include the main class file
  require_once("admin-page-class/admin-page-class.php");
  
  
  /**
   * configure your admin page
   */
  $config = array(    
    'menu'           => 'edit.php?post_type=wcct',             //sub page to settings page
    'page_title'     => __('Product Tabs Settings','apc'),       //The name of this page 
    'capability'     => 'edit_themes',         // The capability needed to view the page 
    'option_group'   => 'wcpct_settings',       //the name of the option to create in the database
    'id'             => 'admin_page',            // meta box id, unique per page
    'fields'         => array(),            // list of fields (can be added by field arrays)
    'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );  
  
  /**
   * instantiate your admin page
   */
  $options_panel = new BF_Admin_Page_Class($config);
  $options_panel->OpenTabs_container('');
  
  /**
   * define your admin page tabs listing
   */
  $options_panel->TabsListing(array(
    'links' => array(
      'options_1' =>  __('Product Tabs Settings','apc')
    )
  ));
  
  /**
   * Open admin page Second tab
   */
  $options_panel->OpenTab('options_1');
  /**
   * Add fields to your admin page 2nd tab
   * 
   * Fancy options:
   *  typography field
   *  image uploader
   *  Pluploader
   *  date picker
   *  time picker
   *  color picker
   */
  //title
  $prefix = 'wcpct_';
  $options_panel->Title(__('Product Tabs Settings','apc'));

  $options_panel->addCheckbox($prefix.'description',array('name'=> 'Remove description tab '));
  $options_panel->addCheckbox($prefix.'reviews',array('name'=> 'Remove reviews tab '));
  $options_panel->addCheckbox($prefix.'additional_information',array('name'=> 'Remove additional information tab '));

 
  /**
   * Close second tab
   */ 
  $options_panel->CloseTab();


  $options_panel->CloseTab();

  //Now Just for the fun I'll add Help tabs
  $options_panel->HelpTab(array(
    'id'      =>'tab_id',
    'title'   => __('My help tab title','apc'),
    'content' =>'<p>'.__('This is my Help Tab content','apc').'</p>'
  ));
  $options_panel->HelpTab(array(
    'id'       => 'tab_id2',
    'title'    => __('My 2nd help tab title','apc'),
    'callback' => 'help_tab_callback_demo'
  ));
  
  