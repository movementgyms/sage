@php
    $gyms = \App\get_all_gym_data();
    $gym_state = '';
@endphp

<div class="uk-container gym-information">
  <div class="uk-width-5-6 uk-margin-auto">
    <h2 class="uk-text-center text-heading-large overline-medium overline-center">Gym Information</h2>
  </div>
  <div class="uk-margin-top uk-grid uk-child-width-1-3">
    @foreach(['western', 'central', 'eastern'] as $region)
      <div>
        <ul class="uk-list">
          @php
            $region_gyms = array_filter($gyms, function($gym) use ($region) {
              return $gym->region === $region;
            });
          @endphp

          @foreach ($region_gyms as $gym)
            @if(empty($gym->address->street_address->state) || $gym->address->street_address->state !== $gym_state)
              @php $gym_state = $gym->address->street_address->state; @endphp
              <li>
                <h3 class="gym-information__region-heading text-heading-medium uk-margin-small-top uk-padding-small uk-padding-remove-left uk-padding-remove-right">{{ ucwords($gym_state) }}</h3>
              </li>
            @endif
            <li>
              <h4 class="uk-margin-remove-bottom text-heading-small text-transform-uppercase">
                {{ $gym->full_name }}
                {{ ( $gym->address->street_address->state_short ? $gym->address->street_address->state_short : '' ) }}
              </h4>
              <div class="uk-margin-remove text-body-small font-weight-medium">
                @if ($gym->coming_soon)
                  <p class="text-label-small text-transform-uppercase uk-margin-remove">Coming Soon</p>
                @endif
                @if (!empty($gym->address->street_address))
                  @include ('components.address', [
                    'address' => $gym->address,
                    'phone_number' => $gym->phone_number,
                    'email' => $gym->contact_email
                  ])
                @endif
              </div>
            </li>
          @endforeach
        </ul>
      </div>
    @endforeach
  </div>
</div>
