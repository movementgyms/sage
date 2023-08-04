<?php

namespace App;

if ( function_exists( 'acf_add_options_page' ) ) {
  acf_add_options_page(
      array(
          'page_title' => 'Location Settings',
          'menu_title' => 'Location Settings',
          'menu_slug'  => 'location-settings',
          'capability' => 'manage_options',
          'redirect'   => false,
      )
  );

  if (is_main_site()) {
      acf_add_options_page(
          array(
              'page_title' => 'Global Settings',
              'menu_title' => 'Global Settings',
              'menu_slug'  => 'global-settings',
              'capability' => 'edit_posts',
              'redirect'   => false,
          )
      );
  }
}

// Switch to main blog to get taxonomy terms, then switch back before displaying results
add_filter('acf/fields/taxonomy/query', function( $args, $field, $post_id ) {
  \App\switch_to_main_blog();

  return $args;
}, 10, 3);

add_filter('acf/fields/taxonomy/result', function( $text, $term, $field, $post_id ) {
  restore_current_blog();

  return $text;
}, 10, 4);

function acf_background_color_choices($field) {
  $field['choices'] = [
    'transparent' => 'None',
    'gray-dark' => 'Dark Gray',
    'brand-primary' => 'Brand Primary',
    'brand-secondary' => 'Brand Secondary',
    'brand-tertiary' => 'Brand Tertiary',
  ];

  return $field;
}

add_filter('acf/load_field/name=background_color', 'App\acf_background_color_choices');

function acf_feature_choices($field) {
  global $wpdb;
  \App\switch_to_main_blog();

  // Query features directly since using get_field causes an infite loop
  $results = $wpdb->get_results("
    SELECT option_value FROM {$wpdb->options} WHERE option_name LIKE 'options_gym_features_%_feature'
    ORDER BY option_name
  ");

  $features = array_map(function($result) {
    return $result->option_value;
  }, $results);

  $field['choices'] = $features;

  restore_current_blog();

  return $field;
}

add_filter('acf/load_field/name=feature', 'App\acf_feature_choices');

function acf_rental_choices($field) {
  global $wpdb;
  \App\switch_to_main_blog();

  // Query features directly since using get_field causes an infite loop
  $results = $wpdb->get_results("
    SELECT option_value FROM {$wpdb->options} WHERE option_name LIKE 'options_rental_items_%_name'
    ORDER BY option_name
  ");

  $items = array_map(function($result) {
    return $result->option_value;
  }, $results);

  $field['choices'] = $items;

  restore_current_blog();

  return $field;
}

add_filter('acf/load_field/name=rental_item', 'App\acf_rental_choices');


function maybe_clear_message_banner_cache() {
  $screen = get_current_screen();

  if (
    strpos($screen->id, 'global-settings') !== false ||
    strpos($screen->id, 'location-settings') !== false
  ) {
    switch_to_main_blog();
    $url = get_bloginfo('url') . '/kinsta-clear-cache-all/';
    restore_current_blog();

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    curl_exec($ch);
    curl_close($ch);
  }
}

add_filter('acf/save_post', 'App\maybe_clear_message_banner_cache');
