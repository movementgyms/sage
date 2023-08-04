<div class="uk-container uk-flex uk-flex-middle uk-flex-column contact-us">
  <div class="uk-width-2-3 uk-text-center">
    <h2 class="text-heading-large overline-medium overline-center">{{ $title }}</h2>
    <div class="content-wp">
      {!! $content !!}
    </div>
  </div>
  <div class="uk-width-5-6@s uk-margin-small-top">
    <div class="gform-multi-column">
      {!! do_shortcode('[gravityform id="' . get_field('contact_us_form', 'option') . '" title="false" description="false" ajax="true"]') !!}
    </div>
  </div>
</div>
