<div class="our-routesetters-module uk-container">
  <div class="uk-width-5-6 uk-margin-auto">
    <h2 class="text-heading-large overline-medium">
      {{ $title }}
    </h2>
    <div>
      {!! $content !!}
    </div>

    @php
      if (
        empty($routesetter) ||
        empty($routesetter->image) ||
        (empty($routesetter->first_name) && empty($routesetter->last_name))
      ) {
        $routesetter = $default_featured_routesetter;
      }

      if (empty($image)) {
        $image = $default_image;
      }

      $headshot = !empty($routesetter->headshot) ? $routesetter->headshot : $routesetter->image;

      $first_routesetter = $routesetter;
      $first_routesetter->headshot = $headshot;

      $routesetters_array  = ( !empty($routesetters) ? $routesetters : array() );
      array_unshift($routesetters_array, $first_routesetter);

    @endphp

    <div class="uk-grid uk-flex uk-flex-stretch">
      @foreach ($routesetters_array as $key => $routesetter)
        <a
          uk-toggle
          class="uk-width-1-2@s uk-width-1-3@m cta-container"
          href="#routesetter-modal-{{$key}}"
        >
          <div class="cta-hover-zoom">
            @include('components/background-image-cover', [
              'url' => $routesetter->headshot->sizes->large,
              'alt' => $routesetter->headshot->alt,
              'padding' => '75%',
            ])
          </div>
          <div class="bg-brand-secondary uk-flex uk-flex-between">
            <h3 class="uk-padding-small uk-margin-remove text-heading-medium color-white">
              {{ $routesetter->first_name }} <br/>
              {{ $routesetter->last_name }}
            </h3>
            <button class="cta-block-plus uk-margin-auto-top"></button>
          </div>
        </a>
      @endforeach

      
      <div class="uk-flex uk-flex-stretch uk-width-2-3">
        @include('components.background-image-cover', array_merge((array) $image, [
          'padding' => '0%',
          'classes' => 'uk-width-1-1'
        ]))
      </div>
    </div>
  </div>
</div>

@foreach ($routesetters_array as $key => $routesetter)
  <div id="routesetter-modal-{{$key}}" class="uk-modal-container person-modal" uk-modal>
    <div class="uk-modal-dialog uk-margin-auto-vertical bg-brand-secondary">
      <div class="uk-flex uk-flex-column uk-flex-row@m uk-child-width-1-2@m uk-margin-small-top uk-margin-small-bottom">
        <div class="uk-flex uk-flex-stretch">
          @include('components/background-image-cover', [
            'url' => $routesetter->image->sizes->large,
            'alt' => $routesetter->image->alt,
            'classes' => 'uk-width-1-1 person-modal__image',
          ])
        </div>
        <div class="uk-flex uk-flex-column uk-flex-between bg-white">
          <div class="uk-padding-medium">
            <h2 class="text-heading-medium-large overline-medium-thin">
              {{ $routesetter->first_name }} {{ $routesetter->last_name }}
            </h2>
            <div class="text-body-small">
              {!! $routesetter->bio !!}
            </div>
          </div>
          <button class="uk-modal-close cta-block-close uk-margin-auto-left"></button>
        </div>
      </div>
    </div>
  </div>
@endforeach
  