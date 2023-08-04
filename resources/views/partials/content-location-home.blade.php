@php $hours = json_decode(json_encode(get_field('hours', 'option'))) @endphp
<section class="uk-container uk-section uk-flex uk-flex-between">
  <div uk-grid class="content-location-home uk-flex-column uk-flex-stretch uk-flex-row@s">
    <div class="uk-margin-auto uk-width-5-6 uk-width-2-3@s uk-width-3-4@m content-wp content-main">
      @php the_content() @endphp
    </div>
    <div class="uk-margin-auto uk-width-5-6 uk-width-1-3@s uk-width-1-4@m  uk-text-center uk-text-left@s">
      @if (!empty($hours))
        <ul class="uk-margin-remove-bottom time-list">
          @foreach ($hours as $hour)
            <li>
              <time>
                <span class="text-label-small text-transform-uppercase">{{ $hour->days }}</span>
                <span class="text-label-small text-transform-uppercase">{{ str_replace(':00' , '', $hour->opening_time) }}-{{ str_replace(':00' , '', $hour->closing_time) }}</span>
              </time>
            </li>
          @endforeach
        </ul>
        @php \App\switch_to_main_blog() @endphp
          @if (get_field('holiday_hours_show_gym_home_link', 'option') === true)
            <p class="uk-margin-xsmall-top uk-margin-remove-bottom">
              <a href="{{ get_the_permalink(get_field('holiday_hours_page', 'option')) }}" class="text-label-small text-transform-uppercase">{{ get_field('holiday_hours_link_text', 'option') }}</a>
            </p>
            @endif
        @php restore_current_blog() @endphp
      @endif

      <div class="uk-section-xsmall uk-margin-small-top uk-padding-remove-bottom border-top-xsmall border-color-blue-dark text-label-small text-transform-uppercase">
        @include ('components.address', [
          'address' => json_decode(json_encode(get_field('address', 'option')))
        ])
        <a href="tel://{{ get_field('phone_number', 'option') }}">{{ get_field('phone_number', 'option') }}</a>
      </div>
    </div>
  </div>
</section>

<div class="bg-dots">
  <div class="content-blocks">
    <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section-small uk-padding-remove-top">
      @include('blocks.location-activities', (array) $activities)
    </section>

    @include('partials.content-blocks')
  </div>
</div>
