<div class="bg-dots">
  <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section">
    <div class="press-releases uk-container">
      <div class="uk-width-5-6 uk-margin-auto">
        <h2 class="text-heading-large overline-large">
          Press Releases
        </h2>
        @include ('components.press-release-list', ['press_releases' => $press_releases])

        <div class="uk-margin-medium-top uk-text-center">
          @include ('components.cta-link', [
            'url' => '/press-release/',
            'title' => 'See All Press Releases'
          ])
        </div>
      </div>
    </div>
  </section>

  <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section bg-brand-secondary color-white">
    <div class="latest-coverage uk-container">
      <h2 class="uk-text-center text-heading-large overline-large overline-center">Latest Coverage</h2>
      @include ('components.latest-coverage-list', ['latest_coverage' => $latest_coverage])

      <div class="uk-margin-medium-top uk-text-center">
        @include ('components.cta-link', [
          'url' => '/latest-coverage/',
          'title' => 'See All Articles'
        ])
      </div>
    </div>
  </section>

  {{-- Hide downloadables for now --}}
  {{--
  <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section">
    <div class="downloadables uk-container">
      <h2 class="uk-text-center text-heading-large overline-large overline-center">Downloadables</h2>
      <ul uk-grid class="uk-margin-top uk-list uk-list-collapse uk-flex uk-flex-center uk-flex-stretch uk-child-width-1-2@s uk-child-width-1-3@m">
        @foreach ($downloadables as $downloadable)
          <li class="uk-flex uk-flex-stretch">
            <a href="{{ get_term_link($downloadable->downloadable_type) }}" class="cta-container uk-flex uk-flex-stretch uk-width-1-1">
              <div class="uk-flex uk-flex-column uk-width-1-1">
                @include ('components.background-image-cover', array_merge(
                  (array) $downloadable->image,
                  [
                    'padding' => '75%',
                  ]
                ))
                <div class="uk-flex-grow bg-brand-secondary">
                  <h3 class="uk-padding uk-padding-remove-right uk-margin-remove text-heading-medium-large">
                    <span class="cta-block-arrow-right cta-block-hover-shift color-white hover-color-white">
                      {{ $downloadable->downloadable_type->name }}
                    </span>
                  </h3>
                </div>
              </div>
            </a>
          </li>
        @endforeach
      </ul>
    </div>
  </section>

  <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section">
    <div class="uk-container">
      <div uk-grid>
        <div class="uk-width-1-3@m">
          <h2 class="text-heading-medium-large overline-medium">
            Can't find something?
          </h2>
        </div>
        @foreach ($contacts as $contact)
        <div class="uk-width-1-2 uk-width-1-3@m">
          <h3 class="text-heading-medium uk-margin-xsmall-bottom">
            {{ $contact->title }}
          </h3>
          <address class="uk-margin-xsmall-top">
            <span>{{ $contact->information->name }}</span>
            <span>{{ $contact->information->job_title }}</span>
            @if (!empty($contact->information->email))
              <span><a href="mailto:{{ $contact->information->email }}">{{ $contact->information->email }}</a></span>
            @endif
            @if (!empty($contact->information->phone_number))
              <span><a href="tel:{{ $contact->information->phone_number }}">{{ $contact->information->phone_number }}</a></span>
            @endif
          </address>
        </div>
        @endforeach
      </div>
    </div>
  </section> --}}
</div>
