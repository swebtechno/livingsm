<?php
function event_espresso_templates_config_mnu() {
	global $wpdb;
	ob_start();
	 if($_GET['action']=='edit_before_survay'){ ?>
   
	<div class="wrap">
		<div id="icon-options-event" class="icon32"> </div>
		<h2><?php echo _e('Manage Before Survey Template', 'event_espresso') ?></h2>
		<form method='post'>
      <?php
           $post_id = $_REQUEST['event_id'];
           $meta_key = 'before_survay_desc';
		   $content_arr = $wpdb->get_results("SELECT event_id, meta_key, meta_value FROM " . $wpdb->prefix . "events_template_meta WHERE event_id = ".$post_id." AND meta_key = '".$meta_key. "'", ARRAY_A);
           $content = $content_arr[0]['meta_value'];
		   wp_editor( $content, 'before_survay_desc' );
           submit_button('Save', 'primary');
     ?>
   </form>
		
		<?php
		if(isset($_POST['before_survay_desc']) && isset($_POST['submit'])=='Save'){
			
		   $post_id = $_REQUEST['event_id'];
           $meta_key = 'before_survay_desc';
           $meta_value = stripslashes( $_POST['before_survay_desc']);
		   $result_rows=$wpdb->get_results("SELECT event_id, meta_key FROM " . $wpdb->prefix . "events_template_meta WHERE event_id = ".$post_id." AND meta_key = '".$meta_key. "'", ARRAY_A);
		   
		    if ( $result_rows[0]['meta_key'] ) {
					   
			   $table_name = $wpdb->prefix . 'events_template_meta';
			  // echo ("UPDATE ". $table_name ." SET meta_value = '".$meta_value."' WHERE event_id = ". $post_id ."");
			   $wpdb->query("UPDATE ". $table_name ." SET meta_value = '".$meta_value."' WHERE event_id = ". $post_id ." AND meta_key= '". $meta_key ."'");
			}
			else{
			    $wpdb->insert( $wpdb->prefix . "events_template_meta", array( 'event_id' => $post_id, 'meta_key' =>$meta_key, 'meta_value' => $meta_value ) );
			}
		}
	}
	
	else{ ?>
	<div class="wrap">
		<div id="icon-options-event" class="icon32"> </div>
		<h2><?php echo _e('Manage After Survey Template', 'event_espresso') ?></h2>
		<form method='post'>
      <?php
           $post_id = $_REQUEST['event_id'];
           $meta_key = 'after_survay_desc'; 
		  $content_arr = $wpdb->get_results("SELECT event_id, meta_key, meta_value FROM " . $wpdb->prefix . "events_template_meta WHERE event_id = ".$post_id." AND meta_key = '".$meta_key. "'", ARRAY_A);
           $content = $content_arr[0]['meta_value'];
		   wp_editor( $content, 'after_survay_desc' );
           submit_button('Save', 'primary');
     ?>
   </form>
		<?php
		if(isset($_POST['after_survay_desc']) && $_POST['submit']=='Save'){
		   $post_id = $_REQUEST['event_id'];
           $meta_key = 'after_survay_desc';
           $meta_value = stripslashes($_POST['after_survay_desc']);
		  
		    $result_rows=$wpdb->get_results("SELECT event_id, meta_key, meta_value FROM " . $wpdb->prefix . "events_template_meta WHERE event_id = ".$post_id." AND meta_key = '".$meta_key. "'", ARRAY_A);
				    if ( $result_rows[0]['meta_key'] ) {
				  
				    $table_name = $wpdb->prefix . 'events_template_meta';
			       $wpdb->query("UPDATE ". $table_name ." SET meta_value = '".$meta_value."' WHERE event_id = ". $post_id ." AND meta_key= '". $meta_key ."'");	   
				   
			}
			else{
			    $wpdb->insert( $wpdb->prefix . "events_template_meta", array( 'event_id' => $post_id, 'meta_key' =>$meta_key, 'meta_value' => $meta_value ) );
			}
		  
		  }//after survay
		
		}//action
	//else
		
		
		//echo plugins_url('event-espresso/includes/event-management/update_template.php');
		$main_post_content = ob_get_clean();
		espresso_choose_layout($main_post_content, event_espresso_display_right_column());
		?>							
	</div>
	<?php } ?>