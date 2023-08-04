<div class="bg-brand-secondary gallery-with-logo uk-margin-bottom">
  <div uk-slider>
    <ul class="uk-slider-items uk-child-width-1-1">
      @foreach ($items as $item)
        <li class="slide">
          <div class="uk-container">
            <div class="uk-grid">
              <div class="uk-width-1-2 copy-col">
                <div class="uk-flex-grow gallery-with-logo__caption">
                  <div class="color-white">
                    <div class="uk-section-small uk-width-5-6 uk-margin-auto">
                      <h2 class="text-heading-large color-white overline-medium overline-expanded uk-scrollspy-inview false">{{ $title }}</h2>
                      @if (!empty($item->title))
                        <h3 class="text-heading-small uk-margin-xsmall-bottom">{{ $item->title }}</h3>
                      @endif
                      <div class="text-body-small uk-margin-remove-first">
                        {!! $item->caption !!}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-width-1-2 media-col">
                @if (!empty($item->image))
                  <div
                    role="image"
                    class="uk-background-cover gallery-with-logo__image"
                    style="background-image: @include('components/background-gradient-darken'), url('{{ $item->image->sizes->large }}')"
                    aria-label="{{ $item->image->alt }}">
                  </div>
                @endif
              </div>
            </div>
          </div>
        </li>
      @endforeach
    </ul>
    <div class="gallery-with-logo__floating-controls uk-flex">
      <a class="cta-block-caret-left gallery-with-logo__control uk-slidenav-previous" href="#" uk-slider-item="previous"></a>
      <a class="uk-margin-small-left cta-block-caret-right gallery-with-logo__control uk-slidenav-next" href="#" uk-slider-item="next"></a>
    </div>
  </div>
</div>
