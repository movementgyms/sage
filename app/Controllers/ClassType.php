<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class ClassType extends Controller
{
  public static function classesByClassType($class_type) {
    $query = new \WP_Query([
      'tax_query' => [
        [
          'taxonomy' => $class_type->taxonomy,
          'field' => 'term_id',
          'terms' => $class_type->term_id
        ]
      ]
    ]);

    return $query->get_posts();
  }

  public static function classTypeWithMetadata($class_type) {
    $metadata = static::classTypeMetadata($class_type);

    foreach ($metadata as $property => $value) {
      $class_type->{$property} = $value;
    }

    return $class_type;
  }

  public static function classTypeMetadata($class_type) {
    \App\switch_to_main_blog();

    $heading = get_field('heading', $class_type);
    if (empty($heading)) {
      $heading = get_the_title($class_type);
    }

    $metadata = [
      'subheading' => get_field('subheading', $class_type),
      'free_for_members' => get_field('free_for_members', $class_type),
      'color' => get_field('color', $class_type),
      'heading' => $heading,
      'image' => json_decode(json_encode(get_field('image', $class_type))),
      'header_image' => json_decode(json_encode(get_field('header_image', $class_type))),
    ];
    restore_current_blog();

    return $metadata;
  }

  public static function classTypeColor($class_type) {
    \App\switch_to_main_blog();
    $color = get_field('color', $class_type);
    restore_current_blog();

    return $color;
  }
}
