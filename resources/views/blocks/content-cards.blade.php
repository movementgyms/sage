<div class="content-cards uk-container">
  <div class="uk-width-5-6 uk-margin-auto">
    <div class="uk-text-center">
      @if (!empty($title))
        <h2 class="text-heading-xlarge overline-medium overline-center">{{ $title }}</h2>
      @endif

      @if (!empty($content))
        <div class="content-wp">
          {!! $content !!}
        </div>
      @endif
    </div>
  </div>

  <div class="uk-margin-remove-first-child uk-margin-remove-last-child">
    @foreach ($blocks as $block)
      <div uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-flex uk-flex-column uk-flex-row@s uk-margin-small-top uk-margin-small-bottom uk-child-width-1-2@s">
        <div class="uk-flex uk-flex-stretch">
          @include('components.background-image-cover', [
            'url' => ( !empty( $block->image ) ? $block->image->sizes->large : '' ),
            'alt' => ( !empty( $block->image ) ? $block->image->alt : '' ),
            'classes' => 'uk-background-cover uk-width-1-1 alternating-image-list__image',
            'padding' => '50%',
          ])
        </div>
        <div class="uk-flex uk-flex-column uk-padding {{ $block->background_color === 'transparent' || $block->background_color === 'none' ? 'bg-half-white color-blue-dark' : 'bg-' . $block->background_color . ' color-white'}}">
          @if (!empty($block->title))
            <h3 class="text-heading-medium">{{ $block->title }}</h3>
          @endif

          @if (!empty($block->content))
            <div class="uk-flex-grow content-wp text-body-small">
              {!! $block->content !!}
            </div>
          @endif

          @if (!empty($block->cta))
            <div class="uk-margin-small-top">
              @include('components.cta-link', array_merge((array) $block->cta, ['classes' => 'cta-button-full-width']))
            </div>
          @endif
        </div>
      </div>
    @endforeach
  </div>
</div>
