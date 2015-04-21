<?php
// TODO find out why $post_content is only added to the first post in case of a recurring event

function event_espresso_templates_after_survay_update(){
global $wpdb, $org_options, $current_user, $espresso_premium, $post ;
  print_r($_POST);
  die;
  exit;
  false;
  if(isset($_POST['after_survay_desc'])){
     update_option('after_survay_desc', $_POST['special_content']);
   }

   $post_id = $_REQUEST['event_id'];
   $meta_key = 'after_survay_desc';
   $meta_value = $_POST['after_survay_desc'];

   $wpdb->update(
            $wpdb->prefix . "events_template_meta",
            array( $meta_key =>  $meta_value  ),
            array( 'post_id' => $post_id)
        );
   
}

function event_espresso_templates_before_survay_update(){
global $wpdb, $org_options, $current_user, $espresso_premium;

   $post_id = $_REQUEST['event_id'];
   $meta_key = 'before_survay_desc';
   $meta_value = $_POST['before_survay_desc'];

    $wpdb->update(
            $wpdb->prefix . "events_template_meta",
            array( $meta_key =>  $meta_value  ),
            array( 'post_id' => $post_id)
        );
   
}
?>
