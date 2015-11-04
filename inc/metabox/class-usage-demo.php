<?php
/*
Plugin Name: Demo MetaBox
Plugin URI: http://en.bainternet.info
Description: My Meta Box Class usage demo
Version: 3.1.1
Author: Bainternet, Ohad Raz
Author URI: http://en.bainternet.info
*/

//include the main class file
require_once("meta-box-class/my-meta-box-class.php");
if (is_admin()){
  /* 
   * prefix of meta keys, optional
   * use underscore (_) at the beginning to make keys hidden, for example $prefix = '_ba_';
   *  you also can make prefix empty to disable it
   * 
   */
  $prefix = '_wcpct_';
  /* 
   * configure your meta box
   */
  $config = array(
    'id'             => 'AdvencedCustomTabsWoocommerce',          // meta box id, unique per meta box
    'title'          => 'Tabs options',          // meta box title
    'pages'          => array('wcct'),      // post types, accept custom post types as well, default is array('post'); optional
    'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'       => 'high',            // order of meta box: high (default), low; optional
    'fields'         => array(),            // list of meta fields (can be added by field arrays)
    'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
   * Initiate your meta box
   */
  $my_meta =  new AT_Meta_Box($config);
  
  /*
   * Add fields to your meta box
   */
  
  //text field
  //$my_meta->addText($prefix.'text_field_id',array('name'=> 'My Text '));
  //textarea field
  //$my_meta->addTextarea($prefix.'textarea_field_id',array('name'=> 'My Textarea '));
  //checkbox field
  $my_meta->addCheckbox($prefix.'global_tab',array('name'=> 'Global tab? '));
  //select field
  //$my_meta->addSelect($prefix.'select_field_id',array('selectkey1'=>'Select Value1','selectkey2'=>'Select Value2'),array('name'=> 'My select ', 'std'=> array('selectkey2')));
  //radio field
 // $my_meta->addRadio($prefix.'radio_field_id',array('radiokey1'=>'Radio Value1','radiokey2'=>'Radio Value2'),array('name'=> 'My Radio Filed', 'std'=> array('radionkey2')));
  //Image field
  //$my_meta->addImage($prefix.'image_field_id',array('name'=> 'My Image '));
  //file upload field
 // $my_meta->addFile($prefix.'file_field_id',array('name'=> 'My File'));
  //file upload field with type limitation
 // $my_meta->addFile($prefix.'file_pdf_field_id',array('name'=> 'My File limited to PDF Only','ext' =>'pdf','mime_type' => 'application/pdf'));
  /*
   * Don't Forget to Close up the meta box Declaration 
   */
  //Finish Meta Box Declaration 
  $my_meta->Finish();

  
}

 