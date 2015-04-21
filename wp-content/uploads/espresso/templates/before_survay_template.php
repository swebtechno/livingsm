<?php 
if (!defined('EVENT_ESPRESSO_VERSION')) { exit('No direct script access allowed'); }
do_action('action_hook_espresso_log', __FILE__, 'FILE LOADED', '');	
//Confirmation Page Template
?>
<?php
//Support for diarise
		   if ( $event_id ) {			
				$sql = "SELECT * FROM " . EVENTS_DETAIL_TABLE;
				$sql .= " WHERE id = %d ";
				$sql .= " LIMIT 0,1";
				$ID = absint( $event_id );
			}
			
			$event = $wpdb->get_row( $wpdb->prepare( $sql, $ID ));
	
		//Build the registration page
		if ( $event ) {
			
			//These are the variables that can be used throughout the regsitration page
			$event_id = $event->id;
			$event_name = stripslashes_deep($event->event_name);
			$event_desc = stripslashes_deep($event->event_desc);
			$display_desc = $event->display_desc;
			$display_reg_form = $event->display_reg_form;
			$event_address = $event->address;
			$event_address2 = $event->address2;
			$event_city = $event->city;
			$event_state = $event->state;
			$event_zip = $event->zip;
			$event_country = $event->country;
			$event_description = stripslashes_deep($event->event_desc);
			$event_identifier = $event->event_identifier;
			$event_cost = ! empty($event->event_cost) ? $event->event_cost : 0;
			//echo '<h4>$event_cost : ' . $event_cost . '  <br /><span style="font-size:10px;font-weight:normal;">' . __FILE__ . '<br />line no: ' . __LINE__ . '</span></h4>';

			$member_only = $event->member_only;
			$reg_limit = $event->reg_limit;
			$allow_multiple = $event->allow_multiple;
			$start_date = $event->start_date;
			$end_date = $event->end_date;
			$allow_overflow = $event->allow_overflow;
			$overflow_event_id = $event->overflow_event_id;

			$virtual_url = stripslashes_deep($event->virtual_url);
			$virtual_phone = stripslashes_deep($event->virtual_phone);
			
			$reg_start_date = $event->registration_start;
			$reg_end_date = $event->registration_end;
			$today = date("Y-m-d");
		}
?>

<?php if ($reg_end_date >= $today) {?>

<h3>Before Event Survay</h3>
 <?php
          $post_id = stripslashes_deep($event_id);
           $meta_key = 'before_survay_desc';
		   $result_rows=$wpdb->get_results("SELECT meta_value FROM " . $wpdb->prefix . "events_template_meta WHERE event_id = ".$post_id." AND meta_key = '".$meta_key. "'", ARRAY_A);
           if($result_rows[0]['meta_value'])
		   {     
			   if (substr($result_rows[0]['meta_value'], 0, 1) === '[') {
					   echo do_shortcode($result_rows[0]['meta_value']);
			   }
			   else
			   {
				   echo $result_rows[0]['meta_value'];
			   }
		   }
		   else
		   
		   {?>
                <h3>Before Event Survay</h3>
			<?php
                echo do_shortcode('[wwm_survey id="2439"]');
			   //echo $befor_temp_path;
			   //include($befor_temp_path);
			}

}
else{

                   $post_id =stripslashes_deep($event_id);
                   $meta_key = 'after_survay_desc';
                   $result_rows=$wpdb->get_results("SELECT meta_value FROM " . $wpdb->prefix . "events_template_meta WHERE event_id = ".$post_id." AND meta_key = '".$meta_key. "'", ARRAY_A);
				  // echo "SELECT meta_value FROM " . $wpdb->prefix . "events_template_meta WHERE event_id = ".$post_id." AND meta_key = '".$meta_key. "'";
                   if($result_rows[0]['meta_value'])
                   {     
                       if (substr($result_rows[0]['meta_value'], 0, 1) === '[') {
                               echo do_shortcode($result_rows[0]['meta_value']);
                       }
                       else
                       {
                           echo $result_rows[0]['meta_value'];
                       }
                   }
                   else
                   
                   {
					   
         
                     echo do_shortcode('[wwm_survey id="2439"]');
                       //echo $befor_temp_path;
                       //include($befor_temp_path);
                        }
        
}
?>