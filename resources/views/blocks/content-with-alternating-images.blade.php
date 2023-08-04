<div class="content-with-alternating-images {{ $full_screen_width !== true ? 'uk-container' : '' }}">
  <div class=" {{ $full_screen_width !== true ? 'uk-width-5-6 uk-margin-auto' : '' }}">
    @if (!empty($title) || !empty($content))
      <div class="uk-text-center uk-margin-bottom">
        @if (!empty($title))
          <h2 class="text-heading-xlarge overline-medium overline-center">{{ $title }}</h2>
        @endif

        @if (!empty($content))
          <div class="content-wp">
            {!! $content !!}
          </div>
        @endif
      </div>
    @endif

    <div class="uk-margin-remove-first-child uk-margin-remove-last-child alternating-image-list alternating-image-list__first-image-{{ $first_image_position }}">
      @if( !empty( $image_blocks ) )
        @foreach ($image_blocks as $image_block)
          <div uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-flex uk-child-width-1-2@m {{ $image_block->background_color === 'transparent' || $block->background_color === 'none' ? 'no-background color-blue-dark' : 'bg-' . $image_block->background_color . ' color-white'}} alternating-image-list__item">
            <div class="uk-flex uk-flex-middle uk-padding{{ $full_screen_width === true ? '-large' : '' }}">
              <div>
                @if (!empty($image_block->title))
                  <h3 class="text-heading-large overline-medium uk-margin-remove-bottom">{{ $image_block->title }}</h3>
                @endif

                @if (!empty($image_block->content))
                  <div class="content-wp">
                    {!! $image_block->content !!}
                  </div>
                @endif

                @if (!empty($image_block->cta))
                  <div class="uk-margin-small-top">
                    @include('components.cta-link', (array) $image_block->cta)
                  </div>
                @endif
              </div>
            </div>
            @if($image_block->background_color === 'transparent' || $block->background_color === 'none')
              <div class="uk-flex uk-flex-stretch">
                <div class="uk-padding{{ $full_screen_width === true ? '-large' : '' }} uk-width-1-1">
                  @include('components.background-image-cover', [
                    'url' => $image_block->image->sizes->large,
                    'alt' => $image_block->image->alt,
                    'classes' => 'uk-background-cover uk-width-1-1 alternating-image-list__image',
                  ])
                </div>
              </div>
            @else
              <div class="uk-flex uk-flex-stretch">
                @include('components.background-image-cover', [
                  'url' => $image_block->image->sizes->large,
                  'alt' => $image_block->image->alt,
                  'classes' => 'uk-background-cover uk-width-1-1 alternating-image-list__image',
                ])
              </div>
            @endif
          </div>
        @endforeach
      @endif
      </div>
  </div>
</div>
