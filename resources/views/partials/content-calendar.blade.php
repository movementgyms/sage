<div class="bg-dots uk-overflow-hidden">
  <div class="uk-container uk-container-expand">
    {!! do_shortcode('[elcap-calendar location="' . get_field('location_name', 'option') . '"]') !!}
  </div>
</div>

@include('partials.the-content')
