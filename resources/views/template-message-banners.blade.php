{{--
  Template Name: Message Banners (Do Not Use)
--}}

@php
if (!empty($_GET['locationId'])) {
  switch_to_blog($_GET['locationId']);
} else {
  \App\switch_to_user_blog();
}

$message_banner = get_field('message_banner', 'option');
restore_current_blog();

\App\switch_to_main_blog();
$global_message_banner = get_field('global_message_banner', 'option');
restore_current_blog();

@endphp

{!!
  json_encode([
    'location_message_banner' => $message_banner['show'] === true ? $message_banner : new stdClass,
    'global_message_banner' => $global_message_banner['show'] === true ? $global_message_banner : new stdClass,
  ])
!!}
