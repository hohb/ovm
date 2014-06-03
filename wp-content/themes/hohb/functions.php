<?php

require_once dirname( __FILE__ ) . '/lib/class-hohb-plugin-activation.php';


add_action( 'hohb_register', 'hohb_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the hohb library
 * and one from the .org repo.
 *
 * The variable passed to hohb_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into hohb_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function hohb_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

      
        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'Flexible Posts Widget',
            'slug'      => 'flexible-posts-widget',
            'required'  => false,
            'force_activation'  => true			
        ),
		array(
			'name'		=> 'Ultimate Tinymce',
			'slug'		=> 'ultimate-tinymce',
			'required'	=> false,
			'force_activation'	=> true
		),
		array(
			'name'		=> 'Yoast SEO',
			'slug'		=> 'wordpress-seo',
			'required'	=> false,
			'force_activation'	=> true
		),
		
 		array(
            'name'               => 'Visual Form Builder Pro', // The plugin name.
            'slug'               => 'visual-form-builder-pro', // The plugin slug (typically the folder name).
            'source'             => get_settings('siteurl') . '/wp-content/plugins/visual-form-builder-pro', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),
    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'id'           => 'hohb',                 // Unique ID for hashing notices for multiple instances of hohb.
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'hohb-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Installeer verplichte plugins', 'hohb' ),
            'menu_title'                      => __( 'Installeer plugins', 'hohb' ),
            'installing'                      => __( 'Bezig met installeren plugin: %s', 'hohb' ), // %s = plugin name.
            'oops'                            => __( 'Er is iets mis gegaan met de plugin API.', 'hohb' ),
            'notice_can_install_required'     => _n_noop( 'Dit thema vereist de volgende plugin: %1$s.', 'Dit thema vereist de volgende plugins: %1$s.', 'hohb' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'Dit thema raadt de volgende plugin aan: %1$s.', 'Dit thema raadt de volgende plugins aan: %1$s.', 'hohb' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, je hebt niet de juiste rechten om de %s plugin te installeren. Neem contact op met de beheerder van de site om deze plugin te laten installeren.', 'Sorry, je hebt niet de juiste rechten om de %s plugins te installeren. Neem contact op met de beheerder van de site om deze plugins te laten installeren.', 'hohb' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'De volgende vereiste plugin is momenteel inactief: %1$s.', 'De volgende vereiste plugins zijn momenteel inactief: %1$s.', 'hohb' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'De volgende aangeraden plugin is momenteel inactief: %1$s.', 'De volgende aangeraden plugins zijn momenteel inactief: %1$s.', 'hohb' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, je hebt niet de juiste rechten om de plugin %s the installeren. Neem contact op met de beheerder van de site om deze plugin te laten activeren.', 'Sorry, je hebt niet de juiste rechten om de plugins %s the installeren. Neem contact op met de beheerder van de site om deze plugins te laten activeren.', 'hohb' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'De volgende plugin moet worden geupdate naar de laaste versie om goed te kunnen werken met dit thema:%l$s.', 'De volgende plugins moeten worden geupdate naar de laaste versie om goed te kunnen werken met dit thema:%l$s.', 'hohb' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, je hebt niet de juiste rechten om de plugin %s te updaten. Neem contact op met de beheerder van de site om deze plugin te updaten.', 'Sorry, je hebt niet de juiste rechten om de plugins %s te updaten. Neem contact op met de beheerder van de site om deze plugins te updaten.', 'hohb' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin met installeren plugin', 'Begin met installeren plugins', 'hohb' ),
            'activate_link'                   => _n_noop( 'Begin met activeren plugin', 'Begin met activeren plugins', 'hohb' ),
            'return'                          => __( 'Terug naar vereiste plugins installer', 'hohb' ),
            'plugin_activated'                => __( 'Plugin successvol geactiveerd.', 'hohb' ),
            'complete'                        => __( 'Alle plugins zijn geinstalleerd en succesvol geactiveerd. %s', 'hohb' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    hohb( $plugins, $config );

}


if ( ! function_exists( 'hohb_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hohb_setup() {


	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'hohb_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );
}
endif; // hohb_setup
add_action( 'after_setup_theme', 'hohb_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function hohb_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'hohb' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'hohb_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function hohb_scripts() {

	wp_enqueue_script( 'hohb-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'hohb-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'hohb_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
//require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
//require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
//require get_template_directory() . '/inc/jetpack.php';
