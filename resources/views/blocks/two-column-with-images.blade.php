<div class="uk-container two-column-with-images">
  <div uk-grid class="{{ $full_width === true ? 'uk-width-1-1' : 'uk-width-5-6' }} uk-flex uk-flex-stretch uk-child-width-1-2 uk-margin-auto">
    @foreach ($blocks as $block)
      <div class="uk-flex uk-flex-stretch">
        <div class="uk-width-1-1 uk-flex uk-flex-column bg-half-white">
          @include('components.background-image-cover', [
            'url' => $block->image->sizes->large,
            'padding' => '60%',
          ])
          <div class="uk-padding-small uk-flex-grow uk-flex uk-flex-column">
            <h2 class="text-heading-medium text-transform-none">
              {{ $block->title }}
            </h2>
            <div class="text-body-small uk-flex-grow uk-margin-remove-last-child">
              {!! $block->content !!}
            </div>
            @if (!empty($block->cta))
            <div class="uk-margin-small-top">
              @include('components.cta-link', (array) $block->cta)
            </div>
            @endif
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
