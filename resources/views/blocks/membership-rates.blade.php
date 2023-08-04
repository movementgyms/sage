@php
  $gyms = \App\get_all_gym_data();

  if (!empty($_GET['location'])) {
    $user_gym = array_filter($gyms, function($gym) {
      return strtolower($gym->location_name) === strtolower($_GET['location']);
    });
  }
  else if (!empty($user_blog_id)) {
    $user_gym = array_filter($gyms, function($gym) {
      global $user_blog_id;

      return (int) $gym->blog_id === $user_blog_id;
    });
  }

  if (!empty($user_gym)) {
    $user_gym = reset($user_gym);
  }

  $global_rentals = \App\get_rental_data();
@endphp

<script>
  window.elcap_gym_data = {!! json_encode($gyms) !!}
</script>

<div class="uk-container membership-rates">
  <h2 class="uk-text-center text-heading-large overline-medium overline-center">Rates and Purchase</h2>
  <div class="uk-margin-top bg-gray-light">
    <div class="membership-rates__locations {{ empty($user_gym) ? 'is-active' : '' }}">
      <a class="uk-flex uk-flex-between uk-padding-medium uk-padding-remove-right uk-padding-remove-bottom uk-padding-remove-top cta-container membership-rates__locations__toggle">
        <h3 class="uk-margin-small-top text-heading-medium-large">
          Location<span class="membership-rates__selected-gym">{{ !empty($user_gym) ? $user_gym->name . ', ' . $user_gym->address->street_address->state_short : '' }}</span>
        </h3>
        <span class="uk-margin-small-left cta-block-caret-down"></span>
      </a>

      <div class="membership-rates__locations__content">
        <div class="uk-flex uk-flex-center uk-child-width-1-2@s uk-child-width-1-3@m uk-padding-medium uk-padding-remove-top" uk-grid>
          @foreach(['western', 'central', 'eastern'] as $region)
            <div class="uk-margin-small-top">
              <h3 class="uk-padding-small uk-padding-remove-left uk-padding-remove-right uk-padding-remove-bottom text-heading-small text-transform-uppercase border-color-darken-black border-top-small">{{ ucwords($region) }} Region</h3>
              <ul class="uk-list uk-list-collapse">
                @php
                  $region_gyms = array_filter($gyms, function($gym) use ($region) {
                    return $gym->region === $region;
                  });
                @endphp

                @foreach ($region_gyms as $gym)
                  <li>
                    <a href="javascript: void(0);" class="uk-margin-remove-bottom cta-small-reverse cta-small-full-width membership-rates__locations__select" data-gym="{{ $gym->blog_id }}">
                      {{ $gym->full_name }},
                      {{ ( !empty($gym->address->street_address->state_short) ? $gym->address->street_address->state_short : '' ) }}
                    </a>
                  </li>
                @endforeach
              </ul>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <div class="uk-margin-top bg-gray-light">
    <div class="membership-rates__rates {{ !empty($user_gym) ? 'is-active' : 'is-disabled' }}">
      <a class="uk-flex uk-flex-between uk-padding-medium uk-padding-remove-right uk-padding-remove-bottom uk-padding-remove-top cta-container membership-rates__rates__toggle">
        <h3 class="uk-margin-small-top text-heading-medium-large">Membership & Passes</h3>
        <span class="uk-margin-small-left cta-block-caret-down"></span>
      </a>

      <div class="uk-margin-small-top uk-padding-remove-top membership-rates__rates__content">
        @foreach ($gyms as $gym)
          <div class="membership-rates__rates__gym {{ (int)$gym->blog_id === $user_blog_id ? 'is-active' : '' }}" data-gym="{{ $gym->blog_id }}">
            @if ($gym->coming_soon)
              <div class="uk-padding-medium uk-padding-remove-top">
                <h4 class="uk-padding-small text-heading-medium bg-brand-primary color-white">
                  Coming soon
                </h4>
              </div>
            @elseif (!empty($gym->pricing_types))
              <div class="uk-padding-medium uk-padding-remove-top">
                @foreach ($gym->pricing_types as $pricing_type)
                  <div class="uk-margin-small-bottom">
                    <h4 class="uk-padding-small text-heading-medium bg-brand-primary color-white">
                      {{ $pricing_type->type->label }}
                    </h4>
                    <ul uk-grid class="uk-flex uk-flex-stretch uk-list uk-list-collapse uk-child-width-1-2@s uk-child-width-1-4@m">
                      @foreach ($pricing_type->items as $item)
                        <li class="uk-flex uk-flex-column uk-flex-stretch uk-margin-remove-top uk-margin-bottom">
                          <div class="uk-flex uk-flex-grow uk-flex-column uk-padding bg-white">
                            <h5 class="uk-margin-remove text-label-medium text-transform-uppercase">{{ $item->title }}</h5>
                            <div class="uk-flex-grow">
                              <p class="uk-margin-remove"><span class="text-label-medium text-transform-uppercase">{{ $item->price }}</span>
                              @if (!empty($item->subtitle))
                                <span class="text-label-aside">{{ $item->subtitle }}</span></p>
                              @endif
                              @if (!empty($item->description))
                                <p class="uk-margin-remove text-body-xsmall">{{ $item->description }}</p>
                              @endif
                            </div>
                            @if (empty($item->purcahse_url) && !empty($item->purchase_text))
                              <p class="text-body-xsmall uk-margin-small-top uk-margin-remove-bottom">{{ $item->purchase_text }}</p>
                            @endif
                          </div>
                          @if ($item->has_purchase_link && !empty($item->purchase_url))
                            @include('components.cta-link', [
                              'url' => $item->purchase_url,
                              'title' => 'Purchase',
                              'classes' => 'cta-button cta-button-full-width',
                            ])
                          @elseif ($item->has_purchase_link)
                            @include('components.cta-link', [
                              'url' => $gym->rgp_membership_url,
                              'title' => 'Purchase',
                              'classes' => 'cta-button cta-button-full-width',
                            ])
                          @endif
                        </li>
                      @endforeach
                    </ul>
                  </div>
                @endforeach
              </div>
            @endif

            @if (!$gym->coming_soon && !empty($gym->rentals))
              <div class="bg-gray-medium uk-section">
                <div class="uk-width-5-6 uk-margin-auto uk-text-center">
                  <h4 class="text-heading-large overline-medium overline-center">
                    Rental Gear
                  </h4>
                  {!! $rental_gear_content !!}
                </div>
                <ul uk-grid class="uk-list uk-list-collapse uk-flex uk-flex-center uk-child-width-1-2 uk-child-width-1-4@s">
                  @foreach ($gym->rentals as $rental)
                    @php
                      $rental_item = array_filter($global_rentals, function($item) use($rental) {
                        return $item->name === $rental->rental_item->label;
                      });

                      $rental_info = reset($rental_item);
                    @endphp

                    <li class="uk-flex uk-flex-column uk-text-center">
                      <div class="uk-padding-small uk-padding-remove-bottom">
                        @include ('components.background-image-cover', [
                          'url' => $rental_info->icon->url
                        ])
                      </div>
                      <h5 class="uk-margin-top uk-margin-remove-bottom text-label-medium text-transform-uppercase">
                        {{ $rental->rental_item->label }}
                      </h5>
                      <p class="uk-margin-remove text-label-medium text-transform-uppercase">
                        {{ $rental->price }}
                      </p>
                    </li>
                  @endforeach
                </ul>
              </div>
            @endif
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
