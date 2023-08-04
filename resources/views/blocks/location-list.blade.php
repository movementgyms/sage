<ul class="location-list uk-list">
  @foreach ($gyms as $gym)
    <li id="location-list__{{ $gym->blog_id }}" class="location-list__item uk-flex uk-flex-stretch uk-flex-column uk-flex-row@m uk-margin-medium-top location-list__item location-list__region__{{ strtolower($gym->address->street_address->state) }}">
      <div class="location-list__item__image uk-flex uk-flex-stretch uk-width-1-1 uk-width-1-3@m">
        @if (!empty($gym->featured_image))
          @include('components.background-image-cover', [
            'url' => $gym->featured_image->sizes->large,
            'alt' => $gym->featured_image->alt,
            'classes' => 'uk-width-1-1',
          ])
        @endif
      </div>
      <div class="uk-width-1-1 uk-width-2-3@m bg-gray-light">
        <a class="uk-flex uk-flex-between uk-flex-middle cta-container bg-blue-dark color-white" href="{{ $gym->url }}">
          <h3 class="uk-margin-small-left uk-margin-remove-bottom text-heading-small text-transform-uppercase">
            {{ $gym->full_name }}
            {!! $gym->coming_soon ? ' &ndash; Coming Soon' : '' !!}
          </h3>
          <span class="cta-block-arrow-right cta-block-hover-shift"></span>
        </a>
        <div class="uk-padding uk-grid">
          <div class="uk-width-1-2">
            <h4 class="text-label-small text-transform-uppercase">
              Information
            </h4>
            @if (!empty($gym->address->street_address))
              @include ('components.address', [
                'address' => $gym->address
              ])
            @endif
            @if (!empty($gym->hours))
              <ul class="time-list">
                @foreach ($gym->hours as $hours)
                  <li>
                    <time>
                      <span class="text-label-small text-transform-uppercase">{{ $hours->days }}</span>
                      <span>{{ str_replace(':00' , '', $hours->opening_time) }}-{{ str_replace(':00' , '', $hours->closing_time) }}</span>
                    </time>
                  </li>
                @endforeach
              </ul>
            @endif
          </div>
          <div class="uk-width-1-2">
            <h4 class="text-label-small text-transform-uppercase">
              Features
            </h4>
            @if (!empty($gym->features))
              <ul class="list-caret text-body-small">
                @foreach ($gym->features as $feature)
                  <li>{{ $feature->feature }}</li>
                @endforeach
              </ul>
            @endif
          </div>
        </div>
      </div>
    </li>
  @endforeach
</ul>
