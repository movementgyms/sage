@include ('partials.the-content')

@include('components.top-accent')
<div class="bg-dots">
  <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section">
    <div class="uk-container">
      <div class="uk-width-5-6 uk-margin-auto gform-multi-column">
        @php echo do_shortcode('[gravityform id="' . get_field('contact_form') . '" title="false" description="false" ajax="true"]') @endphp
      </div>
    </div>
  </section>

  <section class="uk-section">
    @include ('blocks.gym-information')
  </section>
</div>
