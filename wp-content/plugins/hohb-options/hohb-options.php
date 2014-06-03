<?php
/*
Plugin Name: HoHB Options
Description: Opties voor aanpassen kleuren
*/
/* Start Adding Functions Below this Line */

// Creating the widget 
class options_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'options_widget', 

// Widget name will appear in UI
__('Selectbox Menu', 'options_widget_domain'), 

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
echo $title;
}
	
} // Class wpb_widget ends here

// create custom plugin settings menu
add_action('admin_menu', 'hohb_create_menu');

function hohb_create_menu() {

	//create new top-level menu
	add_menu_page('HoHB options settings', 'HoHB Options', 'administrator', __FILE__, 'hohb_settings_page','dashicons-smiley');
	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}

function register_mysettings() {
	//register our settings
	register_setting( 'hohb-settings-group', 'hohb_default_color' );
	register_setting( 'hohb-settings-group', 'hohb_tab_text_color' );
	register_setting( 'hohb-settings-group', 'hohb_show_tabs' );	
	register_setting( 'hohb-settings-group', 'hohb_posts_per_page' );
	register_setting( 'hohb-settings-group', 'hohb_show_testimonials' );
	register_setting( 'hohb-settings-group', 'hohb_show_twitter' );
	register_setting( 'hohb-settings-group', 'hohb_show_links' );	
	$templates = get_page_templates();
    foreach ( $templates as $template_name => $template_filename ) {
	   register_setting( 'hohb-settings-group', 'hohb_show_offerte_'.str_replace('.php','',$template_filename));
	   register_setting( 'hohb-settings-group', 'hohb_show_links_'.str_replace('.php','',$template_filename));	
    }
}

function hohb_settings_page() {
?>
<div class="wrap">
<div style="float:left; margin-bottom:10px; margin-right:10px;">
	<img width="50" src="http://www.homeofhappybrands.nl/images/reclamebureau_homeofhappybrands.png" />
</div>
<div style="float:left;"> 
<h1>Uw instellingen voor het wijzigen van de elementen.</h1>
</div>
<br clear="all" />
<div class="alert-box success" style="display: none;" data-alert="">Uw instellingen zijn succesvol opgeslagen.</div>
<form action="options.php" method="post">
    <?php settings_fields( 'hohb-settings-group' ); ?>
    <?php do_settings_sections( 'hohb-settings-group' ); ?>
    <div id="tabs">
    <ul>
        <li><a href="#tabs-1">Kleurenopties</a></li>
        <li><a href="#tabs-2">Blokken aan en uitzetten Homepage</a></li>
        <li><a href="#tabs-3">Blokken aan en uitzetten per template</a></li>
        <li><a href="#tabs-4">Instellingen m.b.t. weegave</a></li>
        <li style="float:right;"><?php submit_button(); ?></li>
    </ul>
    <div id="tabs-1">
    	<table class="form-table">
            <tbody>
            <tr valign="top">
            <th scope="row">Standaard site kleur</th>
            <td><input type="text" class="my-color-field" name="hohb_default_color" value="<?php echo get_option('hohb_default_color'); ?>" /></td>
            </tr>
             
            <tr valign="top">
            <th scope="row">Text kleur active tabblad</th>
            <td><input type="text" class="my-color-field" name="hohb_tab_text_color" value="<?php echo get_option('hohb_tab_text_color'); ?>" /></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div id="tabs-2">
    	<table class="form-table">
            <tbody>
            <tr valign="top">
            <th scope="row">Toon Tabs blok</th>
            <td><input type="checkbox" name="hohb_show_tabs" <?php echo (get_option('hohb_show_tabs') == 1) ? "checked": "" ?> value="1" /></td>
            </tr>
            <tr valign="top">
            <th scope="row">Toon Testimonials blok</th>
            <td><input type="checkbox" name="hohb_show_testimonials" <?php echo (get_option('hohb_show_testimonials') == 1) ? "checked": "" ?> value="1" /></td>
            </tr>
            <tr valign="top">
            <th scope="row">Toon Twitter blok</th>
            <td><input type="checkbox" name="hohb_show_twitter" <?php echo (get_option('hohb_show_twitter') == 1) ? "checked": "" ?>  value="1" /></td>
            </tr>
            <tr valign="top">
            <th scope="row">Toon Links blok</th>
            <td><input type="checkbox" name="hohb_show_links" <?php echo (get_option('hohb_show_links') == 1) ? "checked": "" ?> value="1" /></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div id="tabs-3">
    	<table class="form-table">
            <thead>
            <tr>
                <td></td>
            <?php
            $templates = get_page_templates();
           foreach ( $templates as $template_name => $template_filename ) {
               echo '<td align="center">'.$template_name.'</td>';
           }
            ?>
            </tr>    
            </thead>
            <tbody>
            <tr valign="top">
            <th scope="row">Offerte Blok</th>
            <?php
            $templates = get_page_templates();
           foreach ( $templates as $template_name => $template_filename ) {
               if (get_option('hohb_show_offerte_'.str_replace('.php','',$template_filename)) == 1) {
                    $checked = 'checked';   
               } else {
                    $checked = '';   
               }
               echo '<td align="center">
			   			<input type="checkbox" '.$checked.' name="hohb_show_offerte_'.str_replace('.php','',$template_filename).'" value="1" />
					</td>';
           }
            ?>
            </tr>
            <tr valign="top">
            <th scope="row">Links Blok</th>
            <?php
            $templates = get_page_templates();
           foreach ( $templates as $template_name => $template_filename ) {
               if (get_option('hohb_show_links_'.str_replace('.php','',$template_filename)) == 1) {
                    $checked = 'checked';   
               } else {
                    $checked = '';   
               }
               echo '<td align="center">
			   			<input type="checkbox" '.$checked.' name="hohb_show_links_'.str_replace('.php','',$template_filename).'" value="1" />
					</td>';
           }
            ?>
            </tr>
            </tbody>
        </table>
    </div>
    <div id="tabs-4">
    	<table class="form-table">
            <tbody>
            <tr valign="top">
            <th scope="row">Aantal blog posts op de homepage (maximaal 4)</th>
            <td><input type="number" min="1" max="4" name="hohb_posts_per_page" value="<?php echo get_option('hohb_posts_per_page'); ?>" /></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
   
    

</form>
</div>
<?php } 
add_action( 'admin_enqueue_scripts', 'mw_enqueue_color_picker' );
function mw_enqueue_color_picker( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'my-script-handle', plugins_url('js/scripts.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
    wp_enqueue_script( 'my-script-handle2', plugins_url('js/jquery.cookie.js', __FILE__ ), array(), false, true );		
    wp_enqueue_script( 'my-script-handle3', plugins_url('js/jquery-ui.js', __FILE__ ), array( 'wp-tabs' ), false, true );	



}
wp_register_style( 'style.css', plugins_url('css/style.css', __FILE__));
wp_enqueue_style('style.css');
/* Stop Adding Functions Below this Line */
?>
