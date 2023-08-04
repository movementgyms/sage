<?php

namespace App;

use Roots\Sage\Container;

/**
 * Get the sage container.
 *
 * @param string $abstract
 * @param array  $parameters
 * @param Container $container
 * @return Container|mixed
 */
function sage($abstract = null, $parameters = [], Container $container = null)
{
    $container = $container ?: Container::getInstance();
    if (!$abstract) {
        return $container;
    }
    return $container->bound($abstract)
        ? $container->makeWith($abstract, $parameters)
        : $container->makeWith("sage.{$abstract}", $parameters);
}

/**
 * Get / set the specified configuration value.
 *
 * If an array is passed as the key, we will assume you want to set an array of values.
 *
 * @param array|string $key
 * @param mixed $default
 * @return mixed|\Roots\Sage\Config
 * @copyright Taylor Otwell
 * @link https://github.com/laravel/framework/blob/c0970285/src/Illuminate/Foundation/helpers.php#L254-L265
 */
function config($key = null, $default = null)
{
    if (is_null($key)) {
        return sage('config');
    }
    if (is_array($key)) {
        return sage('config')->set($key);
    }
    return sage('config')->get($key, $default);
}

/**
 * @param string $file
 * @param array $data
 * @return string
 */
function template($file, $data = [])
{
    return sage('blade')->render($file, $data);
}

/**
 * Retrieve path to a compiled blade view
 * @param $file
 * @param array $data
 * @return string
 */
function template_path($file, $data = [])
{
    return sage('blade')->compiledPath($file, $data);
}

/**
 * @param $asset
 * @return string
 */
function asset_path($asset)
{
    return sage('assets')->getUri($asset);
}

function get_asset_hash($file) {
    $path = get_theme_file_path(). '/dist/' . $file;
    if (file_exists($path)) {
        return md5_file($path);
    } else {
        return false;
    }
}

/**
 * @param string|string[] $templates Possible template files
 * @return array
 */
function filter_templates($templates)
{
    $paths = apply_filters('sage/filter_templates/paths', [
        'views',
        'resources/views'
    ]);
    $paths_pattern = "#^(" . implode('|', $paths) . ")/#";

    return collect($templates)
        ->map(function ($template) use ($paths_pattern) {
            /** Remove .blade.php/.blade/.php from template names */
            $template = preg_replace('#\.(blade\.?)?(php)?$#', '', ltrim($template));

            /** Remove partial $paths from the beginning of template names */
            if (strpos($template, '/')) {
                $template = preg_replace($paths_pattern, '', $template);
            }

            return $template;
        })
        ->flatMap(function ($template) use ($paths) {
            return collect($paths)
                ->flatMap(function ($path) use ($template) {
                    return [
                        "{$path}/{$template}.blade.php",
                        "{$path}/{$template}.php",
                    ];
                })
                ->concat([
                    "{$template}.blade.php",
                    "{$template}.php",
                ]);
        })
        ->filter()
        ->unique()
        ->all();
}

/**
 * @param string|string[] $templates Relative path to possible template files
 * @return string Location of the template
 */
function locate_template($templates)
{
    return \locate_template(filter_templates($templates));
}

/**
 * Determine whether to show the sidebar
 * @return bool
 */
function display_sidebar()
{
    static $display;
    isset($display) || $display = apply_filters('sage/display_sidebar', false);
    return $display;
}

/**
 * Switch to the user selected blog
 */
function switch_to_user_blog() {
    global $user_blog_id;
    return switch_to_blog($user_blog_id);
}

/**
 * Switch to the main blog
 */
function switch_to_main_blog() {
    return switch_to_blog(1);
}

/**
 * Allow managing fields with a default value
 */
function override_field($field, $override, $default) {
    if ($override->override_defaults === true && !empty($override->$field)) {
        return $override->$field;
    } else {
        // Allow using override CTA without enabling override
        if($field === 'cta' && !empty($override->$field) ) {
            return $override->$field;
        }
        else if (isset($default->$field)) {
            return $default->$field;
        } else {
            return get_field($field, $default);
        }
    }

}

/**
 * Calculate video pading from iframe height and width
 */
function video_padding_from_iframe($iframe) {
    preg_match('/height="(.+?)"/', $iframe, $matches);
    $height = $matches[1] ?? '';

    preg_match('/width="(.+?)"/', $iframe, $matches);
    $width = $matches[1] ?? '';

    if (is_numeric($height) && is_numeric($width)) {
        return ($height / $width * 100) . '%';
    } else {
        return '56.25%';
    }
}

/**
 * Translate a size into UK padding
 */
function section_class_from_size($size) {
    if ($size === 'default') {
        return 'uk-section';
    } else if ($size === 'none') {
        return '';
    } else {
        return 'uk-section-' . $size;
    }
}

/**
 * Get all gyms
 */
function get_all_gyms() {
    return get_sites([
        'site__not_in' => [1]
    ]);
}

/**
 * Get all gym data
 */
function get_all_gym_data() {
    // TODO: may need to make this more efficient or cache this page
    $gyms = json_decode(json_encode(get_all_gyms()));

    $main_domain = get_site(1)->domain;

    foreach ($gyms as $index => &$gym) {
        if ($gym->domain !== $main_domain) {
            unset($gyms[$index]);
        }

        switch_to_blog($gym->blog_id);

        $gym->name = get_bloginfo('sitename');
        $gym->url = get_site_url($gym->blog_id);
        $gym->location_name = get_field('location_name', 'option');
        $gym->coming_soon = get_field('coming_soon', 'option');
        $gym->address = json_decode(json_encode(get_field('address', 'option')));
        $gym->phone_number = json_decode(json_encode(get_field('phone_number', 'option')));
        $gym->contact_email = json_decode(json_encode(get_field('contact_email', 'option')));
        $gym->hours = json_decode(json_encode(get_field('hours', 'option')));
        $gym->featured_image = json_decode(json_encode(get_field('featured_image', 'option')));
        $gym->features = json_decode(json_encode(get_field('features', 'option')));
        $gym->region = get_field('region', 'option');
        $gym->pricing_types = json_decode(json_encode(get_field('pricing_types', 'option')));
        $gym->rentals = json_decode(json_encode(get_field('rentals', 'option')));
        $gym->rgp_membership_url = json_decode(json_encode(get_field('rgp_membership_url', 'option')));

        $gym->full_name = $gym->location_name;
        if ( !empty($gym->address->street_address) &&stripos($gym->address->street_address->city, $gym->location_name) === false ) {
            $gym->full_name .= ' (' . $gym->address->street_address->city . ')';
        }

        restore_current_blog();
    }

    unset($gym);

    usort($gyms, function($a, $b) {
        $aString = '';
        $aString .= ( !empty( $a->address->street_address->state ? $a->address->street_address->state : '' ));
        $aString .= ' '.( !empty( $a->location_name ? $a->location_name : '' ));

        $bString = '';
        $bString .= ( !empty( $b->address->street_address->state ? $b->address->street_address->state : '' ));
        $bString .= ' '.( !empty( $b->location_name ? $b->location_name : '' ));
        return strcmp($aString, $bString);
    });

    return $gyms;
}

function get_all_gym_states() {
    $gyms = get_all_gym_data();
    $states = [];

    foreach ($gyms as $gym) {
        $states[$gym->address->street_address->state] = true;
    }

    ksort($states);

    return array_keys($states);
}

function get_rental_data() {
    switch_to_main_blog();

    $rental_data = json_decode(json_encode(get_field('rental_items', 'option')));

    restore_current_blog();

    return $rental_data;
}

function date_from_wp_date($datetime) {
    return \DateTime::createFromFormat('Y-m-d H:i:s', $datetime);
}

function block_background_color($block) {
    return !empty($block->background_color) && $block->background_color !== 'transparent' && $block->background_color !== 'none' ? 'bg-' . $block->background_color .  ' color-white' : '';
}

function str_to_machine($str) {
    return str_replace(' ', '-', strtolower($str));
}
