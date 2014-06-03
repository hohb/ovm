<?php
/*
Plugin Name: Selectbox Plugin
Description: Pagina's selectie voor dropdown veld
*/
/* Start Adding Functions Below this Line */

// Creating the widget 
class wpb_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'wpb_widget', 

// Widget name will appear in UI
__('Selectbox Menu', 'wpb_widget_domain'), 

// Widget description
array( 'description' => __( 'Paginas selectie voor dropdown veld', 'wpb_widget_domain' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {

$title = apply_filters( 'widget_title', $instance['title'] );


// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo '<label>'. $title . '</label>';
echo '<select id="gotoPage">';
echo '<option value="--">Maak uw keuze</option>';
foreach ($instance['select'] as $key => $val){
	echo '<option value="'.get_permalink($val).'">'.get_the_title($val)."</option>";
}
echo '</select>';
// This is where you run the code and display the output
//echo __( 'Hello, World!', 'wpb_widget_domain' );
echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'New title', 'wpb_widget_domain' );
}
if( $instance ) 
            $select = $instance['select'];
        else
             $select ='';
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<p>
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
                    '<option value="%s" class="hot-topic" %s style="margin-bottom:3px;">%s</option>',
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
function wpb_load_widget() {
	register_widget( 'wpb_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );

wp_register_script( 'my_plugin_script', plugins_url('js/scripts.js', __FILE__), array('jquery'));

wp_enqueue_script( 'my_plugin_script' );
/* Stop Adding Functions Below this Line */
?>
