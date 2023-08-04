<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;
use stdClass;

include __DIR__ . '/post-types.php';
include __DIR__ . '/acf.php';
include __DIR__ . '/tinymce.php';
include __DIR__ . '/disable-comments.php';
include __DIR__ . '/hubspot.php';
include __DIR__ . '/shortcodes.php';

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('font-icomoon',  get_theme_file_uri() . '/resources/assets/fonts/icomoon/style.css', false, md5_file(get_theme_file_path() . '/resources/assets/fonts/icomoon/style.css') );
    wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, get_asset_hash('styles/main.css'));
    wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], get_asset_hash('scripts/main.js'), true);

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS

    if ( is_page_template('views/template-you-belong-here.blade.php') ) {
        wp_enqueue_style('sage/you-belong-here.css', asset_path('styles/you-belong-here.css'), false, get_asset_hash('styles/you-belong-here.css'));
    }

    if ( is_page_template('views/template-covid-landing.blade.php') ) {
        wp_enqueue_style('sage/covid-landing.css', asset_path('styles/covid-landing.css'), false, get_asset_hash('styles/covid-landing.css'));
        // wp_enqueue_style('covid-landing-font', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap');
    }

}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage')
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
    add_editor_style(asset_path('styles/editor.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ];
    register_sidebar([
        'name'          => __('Primary', 'sage'),
        'id'            => 'sidebar-primary'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer', 'sage'),
        'id'            => 'sidebar-footer'
    ] + $config);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });
});

/**
 * Custom setup options
 */

// Image sizes
add_image_size( 'full_width', 1600, 0, false );
add_image_size( 'content_width', 1200, 0, false );

// Responsive video
add_filter('embed_oembed_html', function($html, $url, $attr, $post_id) {
    return '
        <div class="content-wp__video-wrapper">
            <div class="responsive-video">
    '
            . $html .
        '
            </div>
        </div>
    ';
  }, 10, 4);

/**
 * Get selected location ID
 */
add_action( 'init', function() {
    global $user_blog_id, $user_location, $user_location_name, $location_navigation_top_level, $location_navigation;

    // For people redirected from the old site, if the location is set in the URL explicitly, fetch the nav and save it
    // See if the user location is set in a cookie first, otherwise get it from the redirect from the old site
    if (is_main_site() && !empty($_GET['user_location']) && empty($_COOKIE['user_location'])) {
        $user_location = $_GET['user_location'];

        $sites = get_sites();
        $site = array_filter($sites, function($item) use($user_location) {
            return str_replace(['movement-', 'planetgranite-', 'earthtreks-'], '', trim($item->path, '/')) === str_replace(['movement-', 'planetgranite-', 'earthtreks-'], '', $user_location);
        });

        if (count($site) > 0) {
            $user_blog_id = (int) current($site)->blog_id;

            switch_to_blog($user_blog_id);

            $blog = get_blog_details();

            // Cache navigation
            $location_navigation_top_level = wp_nav_menu([
                'echo' => false,
                'container' => false,
                'theme_location' => 'location_primary_navigation',
                'depth' => 1,
                'menu_class' => 'nav nav-primary nav-location-primary'
            ]);

            $location_navigation = wp_nav_menu([
                'echo' => false,
                'container' => false,
                'theme_location' => 'location_primary_navigation',
                'menu_class' => 'nav nav-primary nav-location-primary'
            ]);

            $user_location_name = get_field('location_name', 'option');

            restore_current_blog();
        } else {
            $user_blog_id = 1;
        }
    }

    if (!is_main_site()) {
        $blog = get_blog_details();
        $user_blog_id = $blog->id;
        $user_location = trim($blog->path, '/');

        // Cache navigation
        $location_navigation_top_level = wp_nav_menu([
            'echo' => false,
            'container' => false,
            'theme_location' => 'location_primary_navigation',
            'depth' => 1,
            'menu_class' => 'nav nav-primary nav-location-primary'
        ]);

        $location_navigation = wp_nav_menu([
            'echo' => false,
            'container' => false,
            'theme_location' => 'location_primary_navigation',
            'menu_class' => 'nav nav-primary nav-location-primary'
        ]);

        $user_location_name = get_field('location_name', 'option');
    }
});


/**
 * Add menu locations
 */
add_action( 'init', function() {
    register_nav_menu('location_primary_navigation', 'Location Specific Primary Navigation');
    register_nav_menu('secondary_navigation', 'Secondary Navigation');
    register_nav_menu('footer_navigation', 'Footer Navigation');
    register_nav_menu('locations', 'Locations');

    if (is_admin()) {
        if (is_main_site()) {
            unregister_nav_menu('location_primary_navigation');
        } else {
            unregister_nav_menu('primary_navigation');
            unregister_nav_menu('secondary_navigation');
            unregister_nav_menu('footer_navigation');
            unregister_nav_menu('locations');
        }
    }
});

/**
 * Redirect location selects. Remove query param and redirect 404s to the home page.
 */
/* Currently unused due to all pages redirecting back to home page
add_action( 'template_redirect', function() {
    $previous_location = $_GET['previous_location'] ?? '';
    $new_location = $_GET['new_location'] ?? '';

    if (!empty($previous_location) || !empty($new_location)) {
        // Build URL and remove location_select from it
        $url = parse_url($_SERVER['REQUEST_URI']);

        $path = explode('/', trim($url['path'], '/'));

        // If we're on a gym page, first try to redirect to the same page on the new location
        if (!empty($previous_location)) {
            if (count($path) > 0 && strtolower($path[0]) === strtolower($previous_location)) {
                $path[0] = $new_location;
                unset($_GET['previous_location']);

                wp_safe_redirect('/' . implode('/', $path) . '/?' . http_build_query($_GET));
                exit;
            }
        }

        // Now, remove variables from GET
        // If we're getting a 404 when switching locations, redirect back to the location home page
        if (!empty($new_location)) {
            if (is_404()) {
                $redirect = home_url();
            } else {
                $redirect = $url['path'];

                unset($_GET['previous_location']);
                unset($_GET['new_location']);
                if (count($_GET) > 0) {
                    $redirect .= '?' . http_build_query($_GET);
                }
            }

            wp_safe_redirect($redirect);
            exit;
        }
    }
});
*/

function set_global_taxonomies() {
    global $wpdb;

    $wpdb->terms = $wpdb->base_prefix . 'terms';
    $wpdb->term_taxonomy = $wpdb->base_prefix . 'term_taxonomy';
}

add_action( 'init', '\App\set_global_taxonomies', 0 );
add_action( 'switch_blog', '\App\set_global_taxonomies', 0 );

/** Remove posts from menu */
add_action('admin_init', function() {
    if (!wp_doing_ajax()) {
        remove_menu_page('edit.php');

        if (\get_current_blog_id() !== 1) {
            remove_menu_page('edit.php?post_type=acf-field-group');
            remove_menu_page('edit.php?post_type=class');
            remove_menu_page('edit.php?post_type=downloadable');
            remove_menu_page('edit.php?post_type=latest_coverage');
            remove_menu_page('edit.php?post_type=press_release');
            remove_menu_page('cptui_main_menu');
        }

        if (!\is_network_admin()) {
            remove_menu_page('wordpress_multisite_sync_options');
            remove_menu_page('ns-cloner');
        }
    }
}, 999);

// Use the main site favicon for all pages
remove_action( 'wp_head', 'wp_site_icon', 99 );
add_action('wp_head', function() {
    switch_to_main_blog();
    wp_site_icon();
    restore_current_blog();
}, 99);


// Pagination
add_action('init', function() {
    add_rewrite_rule('press-release/page/?([0-9]{1,})/?$', 'index.php?post_type=press_release&page=$matches[1]', 'top');
});

add_action( 'pre_get_posts', function($query) {
    if (is_archive()) {
        if (!empty($query->query['post_type']) && $query->query['post_type']=== 'latest_coverage') {
            $query->set('posts_per_page', 3);
        }
    }
});

add_filter('next_posts_link_attributes', function() {
    return 'class="text-cta-small text-transform-uppercase uk-margin-auto-left"';
});

add_filter('previous_posts_link_attributes', function() {
    return 'class="text-cta-small text-transform-uppercase"';
});


// Redirect posts and taxonomies
add_action( 'template_redirect', function() {
    if (
        is_singular('class') ||
        is_tax('class_type')
    ) {
        wp_redirect(home_url(), 301);
        exit;
    }
});

// Move Yoast box to bottom of editor
add_filter( 'wpseo_metabox_prio', function() { return 'low'; } );
