<?php
/*
Plugin Name: List Sub Categories Sidebar Widget
Plugin URI: http://www.desi-tashan.com/
Description: Adds a Sidebar widget that can display sub categories of a selected category. You can add as many widgets as you want.
Author: Ahmad Baig	
Version: 1.0
Author URI: http://www.desi-tashan.com/
*/

class ListSubCategories extends WP_Widget {

function ListSubCategories() {
	parent::WP_Widget(false, $name='List Sub Categories');
}

/**
 * Displays Sub category widget on Blog.
 */
function widget($args, $instance) {

	extract( $args );
	
	// If not title, use the name of the category.
	if( !$instance["title"] ) {
		$category_info = get_category($instance["parent_cat"]);
		$instance["title"] = $category_info->name;		
	}
	
	$ParentCat = $instance["parent_cat"];
	
	//Hide/Unhide Empty Sub Categories
	if( (bool) $instance["show_empty"] )
	{
		$hide_empty = false;
	}
	else
	{
		$hide_empty = true;
	}
	
	//Order ASC/DESC
	if( (bool) $instance["order"] )
	{
		$order = "DESC";
	}
	else
	{
		$order = "ASC";
	}
	if( $instance["excl"] )	
	{
		$exclude = $instance["excl"];
	}
	else
	{
		$exclude = '';
	}
	echo $before_widget;
	echo '<div class="subcats_top"></div>';
	echo '<div class="subcats_inner">';
	echo $before_title;
	// Display Title of Parent Category
	if( (bool) $instance["title_link"] )
	{
		echo '<a href="' . get_category_link($instance["parent_cat"]) . '">' . $instance["title"] . '</a>';
	}
	else
	{
		echo $instance["title"];
	}
	echo $after_title;
	
	$CatArgs=array(
	  'orderby' => 'name',
	  'order' => $order,
	  'exclude'  => $exclude,
	  "child_of" => $ParentCat,
	  "hide_empty" => $hide_empty
	  );

	$ChildCategories = get_categories($CatArgs); ?>
	
		<ul class="subcats">
		<?php foreach ( $ChildCategories as $ChildCategory ) {?>
			<li><a class="post-title" href="<?php echo get_category_link($ChildCategory->cat_ID);?>" title="<?php echo $ChildCategory->cat_name; ?>"><?php echo $ChildCategory->cat_name . ' (' . $ChildCategory->category_count.')'; ?></a></li>
		<?php } ?>
	
		</ul>
	</div>
	<div class="subcats_bottom"></div>
	
	<?php echo $after_widget;
}

/**
 * 	Instance Processing
 */
function update($new_instance, $old_instance) {
    $new_instance["parent_cat"] = absint( $new_instance["parent_cat"] );
    $new_instance["exclude"] = (bool) $new_instance["exclude"];
    
	return $new_instance;
}

/**
 *  User Interface
 */
function form($instance) {
?>
		<p>
			<label for="<?php echo $this->get_field_id("title"); ?>">
				<?php _e( 'Title' ); ?>:
				<input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
			</label>
		</p>
		
		<p>
			<label>
				<?php _e( 'Parent Category' ); ?>:
				<?php wp_dropdown_categories( array( 'name' => $this->get_field_name("parent_cat"), 'selected' => $instance["parent_cat"] ) ); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("show_empty"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_empty"); ?>" name="<?php echo $this->get_field_name("show_empty"); ?>"<?php checked( (bool) $instance["show_empty"], true ); ?> />
				<?php _e( 'Show Empty Sub Categories' ); ?>
			</label>
		</p>
		
		
		<p>
			<label for="<?php echo $this->get_field_id("title_link"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("title_link"); ?>" name="<?php echo $this->get_field_name("title_link"); ?>"<?php checked( (bool) $instance["title_link"], true ); ?> />
				<?php _e( 'Create Parent Category link' ); ?>
			</label>
		</p>
		
		<p>
		
		<label for="<?php echo $this->get_field_id("order"); ?>">
	
					<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("order"); ?>" name="<?php echo $this->get_field_name("order"); ?>"<?php checked( (bool) $instance["order"], true ); ?> />
					<?php _e( 'DESC Order' ); ?>
		</label>
		</p>
		
		<p>
		
		<label for="<?php echo $this->get_field_id("excl"); ?>">
	
<input class="widefat" type="text" id="<?php echo $this->get_field_id("excl"); ?>" name="<?php echo $this->get_field_name("excl"); ?>" value="<?php echo $instance["excl"]; ?>" />
					<?php _e( 'Exclude Sub Categories. Comma separated' ); ?>
		</label>
		</p>
		
	
<?php

}

}

add_action( 'widgets_init', create_function('', 'return register_widget("ListSubCategories");') );

?>
