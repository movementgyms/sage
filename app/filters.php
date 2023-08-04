<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment', 'embed'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__.'\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    collect(['get_header', 'wp_head'])->each(function ($tag) {
        ob_start();
        do_action($tag);
        $output = ob_get_clean();
        remove_all_actions($tag);
        add_action($tag, function () use ($output) {
            echo $output;
        });
    });
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory().'/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Render comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );

    $data = collect(get_body_class())->reduce(function ($data, $class) use ($comments_template) {
        return apply_filters("sage/template/{$class}/data", $data, $comments_template);
    }, []);

    $theme_template = locate_template(["views/{$comments_template}", $comments_template]);

    if ($theme_template) {
        echo template($theme_template, $data);
        return get_stylesheet_directory().'/index.php';
    }

    return $comments_template;
}, 100);

/**
 * ACF
 */
add_filter(
	'acf/settings/save_json',
	function ( $path ) {
		// update path
		return realpath( get_template_directory() . '/assets/fields' );
	}
);

add_filter(
	'acf/settings/load_json',
	function( $paths ) {
		// remove original path
		unset( $paths[0] );

		// append path
		$paths[] = realpath( get_template_directory() . '/assets/fields' );

		// return
		return $paths;
	}
);

add_filter('acf/fields/google_map/api', function($api){
    \App\switch_to_main_blog();
    $api['key'] = get_field('google_maps_api_key', 'option');
    restore_current_blog();

    return $api;
});


/**
 * Gravity Forms
 */
add_filter( 'gform_submit_button', function($input, $form) {
    $input = str_replace('gform_button button', 'gform_button button cta-button', $input);
    $input = str_replace('<input', '<button', $input);
    $input = str_replace('/>', '>Submit</button>', $input);

    return "
        <div class='gform_submit_button_wrapper uk-margin-small-top cta-wrapper'>
            $input
        </div>";
}, 10, 2 );

// Add admin email routing
add_filter( 'gform_notification', function($notification, $form, $entry) {
    if ($notification['to'] === '{admin_email}') {
        $contact_email = get_field('contact_email', 'option');
        if (!empty($contact_email)) {
            $notification['to'] = get_field('contact_email', 'option');
        }
    }

    return $notification;
}, 10, 3 );

/**
 * Add optional params to vimeo videos
 */
add_filter('oembed_fetch_url', function($provider, $url, $args) {
    if ( strpos($provider, '//vimeo.com/') !== false ) {
        unset($args['height']);
        unset($args['width']);

        $provider = add_query_arg( $args, $provider );
    }
    return $provider;
} ,10, 3);

/**
 * Disable search https://gist.github.com/pradeepdotco/646410736ee5f1d7c7f7
 */
add_action( 'parse_query', function ( $query, $error = true ) {

	if ( is_search() && !is_admin() ) {
		$query->is_search = false;
		$query->query_vars['s'] = false;
		$query->query['s'] = false;

		// to error
		if ( $error == true )
			$query->is_404 = true;
	}
});

add_filter( 'get_search_form', function() {
    return null;
});

add_filter('get_blogs_of_user', function( $blogs ) {
    uasort( $blogs, function( $a, $b ) {
        if ($a->userblog_id === 1) {
            return -1;
        } else if ($b->userblog_id === 1) {
            return 1;
        }

        return strcasecmp( $a->blogname, $b->blogname );
    });
    return $blogs;
});

add_filter('get_site_icon_url', function($url, $size, $blog_id) {
    if ($size <= 32) {
        \App\switch_to_main_blog();
        $icon = get_field('favicon_small', 'option') ? get_field('favicon_small', 'option')['sizes']['thumbnail'] : $url;
        restore_current_blog();

        return $icon;
    }

    return $url;
}, 10, 3);
