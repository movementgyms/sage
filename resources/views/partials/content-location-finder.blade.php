@php
  $gyms = \App\get_all_gym_data();
  $states = \App\get_all_gym_states();
@endphp
@php \App\switch_to_main_blog() @endphp
  <script>
    window.google_maps_api_key = {!! json_encode(get_field('google_maps_api_key', 'option')) !!};
    window.gym_locations = {!! json_encode($gyms) !!};
  </script>
@php restore_current_blog() @endphp

<section class="location-finder-map uk-visible@m">
  <div id="location-map" class="responsive-iframe">
  </div>
</section>

<section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-text-center uk-section uk-container">
  <div class="uk-width-5-6 uk-margin-auto">
    <h2 class="text-heading-large">
      Find Movement Gyms In:
    </h2>
  </div>
  <div class="uk-width-1-2 uk-margin-auto">
    <form class="form-dark">
      <select class="uk-width-1-1 location-list__region-select">
        <option value="">Select State</option>
        @foreach ($states as $state)
          <option value="{{ strtolower($state) }}">{{ ucwords($state) }}</option>
        @endforeach
      </select>
    </form>
  </div>
</section>

@include('components.top-accent')
<div class="bg-dots">
  <div class="uk-container">
    <section class="uk-section">
      @include('blocks.location-list', ['gyms' => $gyms])
    </section>
  </div>
</div>
