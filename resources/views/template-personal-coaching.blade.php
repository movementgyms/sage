{{--
  Template Name: Personal Coaching (Location Specific)
--}}

@php
  \App\switch_to_main_blog();
  $personal_coaching_page = get_field('personal_coaching_page', 'option');
  wp_redirect(get_permalink($personal_coaching_page));
  restore_current_blog();

  exit;
@endphp
