<?php
/*
Plugin Name: Tabs for Faundation Plugin
Description: Pagina's selectie voor in tabs
*/
/* Start Adding Functions Below this Line */

// Creating the widget 
class tabs_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'tabs_widget', 

// Widget name will appear in UI
__('Tabs for Faundation', 'wpb_widget_domain'), 

// Widget description
array( 'description' => __( 'Create tabs from selected pages in Faudation framework', 'wpb_widget_domain' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {

// before and after widget arguments are defined by themes
echo $args['before_widget'];
echo '
<div class="block orange-block show-for-large-up">
	<div class="tab-bg">
		<div class="row">
			<div class="small-12 columns">
				<dl class="tabs" data-tab>';
					$li = 1;
					$div = 1;
					foreach ($instance['select'] as $key => $val){
						if ($li == 1){
						echo '<dd class="active"><a id="tab'.$li.'" class="tabs-li" href="#panel'.$li.'">'.get_the_title($val).'</a></dd>';
						} else {
						echo '<dd><a id="tab'.$li.'" class="tabs-li" href="#panel'.$li.'">'.get_the_title($val).'</a></dd>';	
						}
						$li++;
					}
		  echo '</dl>
		 	</div>
		</div>
	</div>
	<div class="tab-content-container clearfix  orange-bg">
	<div id="tab-image"></div>
		<div class="row">
			<div id="tab-pos" class="small-6 columns content">
		  		  <div class="tabs-content clearfix">';
				  
				  	$my_wp_query = new WP_Query();
					$all_wp_pages = $my_wp_query->query(array('post_type' => 'page'));
				  
				  	foreach ($instance['select'] as $key => $val){
						
						if ($div == 1){
							echo '<div class="content active" id="panel'.$div.'">';
						} else {
							echo '<div class="content" id="panel'.$div.'">';	
						}

					
						$post = get_post($val);
						$post_children = get_page_children($post->ID, $all_wp_pages);
						$content = apply_filters('the_content', $post->post_excerpt);
						
						echo $content;
						echo '<ul class="bxslider">'; 
						
						foreach ($post_children as $child) {
							
							$permalink = get_permalink($child->ID);
							$icon = get_the_post_thumbnail($child->ID);
							
							echo '<li><a href="'.$permalink.'">'.$icon.'</a></li>';
						}
						
						echo '</ul>';
						echo '</div>';
						$div++;
				  }

					wp_reset_postdata();

				  echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
echo '</div>';
// This is where you run the code and display the output
//echo __( 'Hello, World!', 'wpb_widget_domain' );
echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
	
if( $instance ) 
            $select = $instance['select'];
        else
             $select ='';
// Widget admin form
?>
<!--
    <select name="selectfrom" class="select-from" multiple size="5">
      <option value="1">Item 1</option>
      <option value="2">Item 2</option>
      <option value="3">Item 3</option>
      <option value="4">Item 4</option>
    </select>
    <a class="add">Add &raquo;</a>
    <a class="remove">&laquo; Remove</a>
    <select name="select" class="select-to" multiple size="5">
      <option value="5">Item 5</option>
      <option value="6">Item 6</option>
      <option value="7">Item 7</option>
    </select>
    <a  class="up">Up</a>
    <a  class="down">Down</a>
    -->
<p>


<br /><br />
<label for="<?php echo $this->get_field_id( 'select' ); ?>"><?php _e( 'Select:' ); ?></label> 
<?php
printf(
                '<select multiple="multiple" name="%s[]" id="%s" class="widefat" size="10">',
                $this->get_field_name('select'),
                $this->get_field_id('select')
            );

$pages = get_pages($args); 

foreach ( $pages as $page ) {
	
		printf(
			'<option value="%s"  %s style="margin-bottom:3px;">%s</option>',
			$page->ID,
			in_array( $page->ID, $select) ? 'selected="selected"' : '',
			$page->post_title
        );
  }
 
?>
</select>
</p>
<?php 

}
	
} // Class wpb_widget ends here

// Register and load the widget
function tabs_load_widget() {
	register_widget( 'tabs_widget' );
}
add_action( 'widgets_init', 'tabs_load_widget' );


?>
