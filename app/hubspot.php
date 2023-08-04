<?php

namespace App;

function get_hubspot_api_key() {
  \App\switch_to_main_blog();
  $hubspot_api_key = get_field('hubspot_api_key', 'option');
  restore_current_blog();

  return $hubspot_api_key;
}

function acf_load_hubspot_blog_tag_choices($field) {
  $url = 'https://api.hubapi.com/cms/v3/blogs/tags';

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , 'Authorization: Bearer '. get_hubspot_api_key() ));
  curl_setopt($ch, CURLOPT_URL, $url );
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $response = json_decode(curl_exec($ch));

  if (!empty($response) && !empty($response->results)) {
      $tags = $response->results;

      $choices = [];

      foreach ($tags as $tag){
        $choices[$tag->id] = $tag->name;
      }

      asort($choices);

      $field['choices'] = $choices;
  }

  return $field;
}

add_filter('acf/load_field/name=blog_tag', 'App\acf_load_hubspot_blog_tag_choices');

function get_hubspot_blog_post_by_tag($tag_id) {
  $query_arr = array(
    'tagId' => $tag_id,
    'state' => 'PUBLISHED'
  );
  $query_str = http_build_query($query_arr);
  $url = 'https://api.hubapi.com/cms/v3/blogs/posts?'.$query_str;

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , 'Authorization: Bearer '. get_hubspot_api_key() ));
  curl_setopt($ch, CURLOPT_URL, $url );
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $response = json_decode(curl_exec($ch));
  $results = [];

  if (!empty($response) && !empty($response->results)) {
    $posts = $response->results;

    foreach ($posts as $post) {
      if (array_search($tag_id, $post->tagIds) !== false) {
        $results[] = $post;

        if (count($results) >= 3) {
          break;
        }
      }
    }
  }

  return $results;
}
