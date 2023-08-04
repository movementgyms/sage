<div class="gallery uk-margin-bottom">
  <div uk-slider>
    <ul class="uk-slider-items uk-child-width-1-1">
      @foreach ($items as $item)
        <li class="uk-flex uk-flex-column">
          @if ($item->media_type === 'image' && !empty($item->image))
            <div
              role="image"
              class="uk-background-cover gallery__image"
              style="background-image: @include('components/background-gradient-darken'), url('{{ $item->image->sizes->large }}')"
              aria-label="{{ $item->image->alt }}">
            </div>
          @elseif ($item->media_type === 'video')
            <div class="responsive-video">
              {!! $item->video !!}
            </div>
          @endif

          @if ($show_captions === true)
            <div class="bg-brand-secondary uk-flex-grow gallery__caption">
              <div class="uk-container color-white">
                <div class="uk-section-small uk-width-5-6 uk-margin-auto">
                  @if (!empty($item->title))
                    <h3 class="text-heading-small uk-margin-xsmall-bottom">{{ $item->title }}</h3>
                  @endif
                  <div class="text-body-small uk-margin-remove-first">
                    {!! $item->caption !!}
                  </div>
                </div>
              </div>
            </div>
          @endif
        </li>
      @endforeach
    </ul>
    <div class="uk-width-1-1 gallery__info">
      <div class="uk-container">
        <div class="uk-width-5-6 uk-margin-auto">
          <h2 class="text-heading-xlarge color-white overline-medium">{{ $title }}</h2>
          <div class="uk-position-relative uk-flex uk-flex-between">
            <div class="gallery__floating-controls uk-flex">
              <a class="cta-block-caret-left gallery__control" href="#" uk-slider-item="previous"></a>
              <a class="uk-margin-small-left cta-block-caret-right gallery__control" href="#" uk-slider-item="next"></a>
            </div>
            @include('components/cta-link', (array) $cta)
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
