<div class="cta-list">
  <div class="uk-container">
    @include('components.block-title', ['align' => $heading_alignment])

    @if (!empty($ctas))
      <ul uk-grid class="uk-list uk-list-collapse uk-flex uk-flex-center uk-flex-stretch uk-child-width-1-2@s uk-child-width-1-3@m">
        @foreach ($ctas as $index => $cta)
          <li class="uk-flex uk-flex-column uk-flex-middle uk-flex-stretch">
            @if ($show_step_numbers)
              <div class="uk-margin-bottom text-step-number bg-brand-secondary color-{{ $background_color }}">{{ $index + 1 }}</div>
            @endif

            @if ($cta_style === 'text-only' || $cta_style === 'text-with-image')
              <div class="uk-flex uk-flex-column uk-flex-middle uk-flex-center uk-margin-small-left uk-margin-small-right uk-text-center cta-list__cta__text-only">
                @if ($cta_style === 'text-with-image' && !empty($cta->image))
                <div class="uk-margin-small-bottom uk-width-4-5">
                  <img src="{{ $cta->image->sizes->large }}" alt="{{ $cta->image->alt }}" class="uk-width-1-1" />
                </div>
                @endif
                <h3 class="text-heading-medium uk-margin-xsmall-bottom">{{ $cta->title }}</h3>
                <div class="uk-margin-remove-first">
                  {!! $cta->content !!}
                </div>
                <div class="uk-margin-small-top">
                  @include('components.cta-link', (array) $cta->cta)
                </div>
              </div>

            @elseif ($cta_style === 'image-on-top')
              @if (!empty($cta->cta))
                <a class="uk-flex uk-flex-stretch cta-container uk-height-1-1 uk-width-1-1" href="{{ $cta->cta->url }}">
              @endif
                <div class="uk-flex uk-flex-stretch uk-flex-column uk-width-1-1 cta-list__cta__image-on-top">
                  @include('components.background-image-cover', [
                    'url' => $cta->image->sizes->large,
                    'alt' => $cta->image->alt,
                    'padding' => '75%',
                  ])

                  @if (!empty($cta->title) || !empty($cta->content))
                    <div class="uk-padding-small uk-flex-grow bg-half-white color-brand-secondary">
                      <h3 class="text-heading-medium uk-margin-xsmall-bottom">{{ $cta->title }}</h3>
                      <div class="uk-margin-remove-first">
                        {!! $cta->content !!}
                      </div>
                    </div>
                  @endif

                  @if (!empty($cta->cta))
                    <span class="cta-button-full-width">{{ $cta->cta->title }}</span>
                  @endif
                </div>
              @if (!empty($cta->cta))
                </a>
              @endif

            @elseif ($cta_style === 'image-with-flip')
              <div class="uk-position-relative uk-flex uk-flex-grow uk-width-1-1 cta-container cta-list__cta__image-with-flip">
                <div class="uk-flex uk-flex-column uk-flex-grow bg-brand-secondary color-white">
                  <div class="uk-position-relative">
                    @include('components.background-image-cover', [
                      'url' => $cta->image->sizes->large,
                      'alt' => $cta->image->alt,
                      'padding' => '75%',
                    ])
                    <div class="bg-brand-secondary uk-padding uk-padding-remove-right cta-list__cta__image-with-flip__content">
                      <div class="uk-width-5-6">
                        <h3 class="text-heading-medium uk-margin-xsmall-bottom" aria-hidden="true">{{ $cta->title }}</h3>
                        <div class="content-wp text-body-small">
                          {!! $cta->content !!}
                        </div>
                      </div>
                    </div>
                  </div>

                  @if (!empty($cta->title) || !empty($cta->content))
                    <div class="uk-flex uk-flex-between uk-flex-grow">
                      <div class="uk-padding uk-padding-remove-right">
                        <div class="cta-list__cta__image-with-flip__title uk-width-5-6">
                          <h3 class="text-heading-medium uk-margin-xsmall-bottom">{{ $cta->title }}</h3>
                        </div>
                      </div>
                    </div>
                  @endif
                </div>
                {{-- This is just here for spacing --}}
                <div class="uk-flex uk-flex-column uk-flex-grow uk-padding bg-brand-secondary color-white cta-list__cta__image-with-flip__content-spacer" aria-hidden="true">
                  <h3 class="text-heading-medium">{{ $cta->title }}</h3>
                  <div class="content-wp text-body-small">
                    {!! $cta->content !!}
                  </div>
                </div>
                <span class="uk-position-absolute uk-position-bottom-right uk-margin-small-bottom cta-block-plus cta-list__cta__image-with-flip__show-icon" aria-label="Show More"></span>
                <span class="uk-position-absolute uk-position-bottom-right uk-margin-small-bottom cta-block-minus cta-list__cta__image-with-flip__hide-icon" aria-label="Hide"></span>
              </div>
            @endif
          </li>
        @endforeach
      </ul>
    @endif
  </div>
</div>
