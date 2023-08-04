@php $id = uniqid('uk-switcher-'); @endphp

@if( !empty( $block->scroll_to_name ) )
  <div id="{{ $block->scroll_to_name }}" style="position: relative; top: -8rem;"></div>
@endif

<div class="tabbed-content-slider tabbed-content-slider__{{ !empty($image_position) ? $image_position : '' }} color-white">
  <div class="uk-container">
    <ul uk-switcher="connect: #{{ $id }}" class="uk-subnav" id="{{ $id }}-controls">
      @if( !empty($content) )
        @foreach ($content as $index => $tab)
          <li class="{{ $index === 0 ? 'uk-active' : '' }}"><a href="#">{{ $tab->tab_name }}</a></li>
        @endforeach
      @endif
    </ul>
  </div>
  <div class="uk-position-relative">
    <div class="uk-container">
      <ul class="uk-switcher uk-margin-medium-top" id="{{ $id }}">
        @if( !empty($content) )
          @foreach ($content as $tab)
            <li>
              <div class="uk-flex uk-flex-column-reverse {{ !empty($image_position) && $image_position === 'right' ? 'uk-flex-row@m' : 'uk-flex-row-reverse@m' }} uk-child-width-1-1 uk-child-width-1-2@m">
                <div class="uk-padding uk-padding-remove-top uk-padding-remove-bottom {{ !empty($image_position) && $image_position === 'right' ? 'uk-padding-remove-left' : 'uk-padding-remove-right' }}">
                  <h2 class="text-heading-large color-white overline-medium">{{ $tab->title }}</h2>
                  <div class="content-wp">
                    {!! $tab->content !!}
                  </div>
                  @if (!empty($tab->cta))
                    <div class="uk-margin-small-top">
                      @include('components/cta-link', (array) $tab->cta)
                    </div>
                  @endif
                </div>
                <div class="uk-flex uk-flex-center uk-padding uk-padding-remove-top uk-padding-remove-bottom {{ !empty($image_position) && $image_position === 'right' ? 'uk-padding-remove-right' : 'uk-padding-remove-left' }} uk-visible@m">
                  <div class="uk-flex uk-flex-center uk-width-1-1 uk-width-1-2@s uk-width-1-1@m uk-margin-small-left@m">
                    <div
                      role="image"
                      class="uk-width-1-1- uk-background-cover tabbed-content-slider__image"
                      style="background-image: url(' {{ $tab->image->sizes->large }} ')"
                      aria-label="{{ $tab->image->alt }}" >
                    </div>
                  </div>
                </div>
              </div>
            </li>
          @endforeach
        @endif
      </ul>

      @if (!empty($content) && count($content) > 1)
        <div id="{{ $id }}-floating-controls" class="uk-visible@s">
          <div class="uk-position-center-left">
            <a class="cta-block-caret-left tabbed-content-slider__control" href="#" data-switcher="{{ $id }}" data-show="previous"></a>
          </div>
          <div class="uk-position-center-right">
            <a class="cta-block-caret-right tabbed-content-slider__control" href="#"data-switcher="{{ $id }}" data-show="next"></a>
          </div>
        </div>
      @endif
    </div>
  </div>

</div>
