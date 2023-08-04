<div class="links-with-images-grid uk-container">
  <div class="uk-width-5-6 uk-margin-auto">
    <h2 class="text-heading-large overline-medium">{{ $title }}</h2>
    {!! $content !!}
    <ul class="uk-grid uk-grid-medium uk-child-width-1-2" uk-grid>
      @foreach ($links as $link)
        <li>
          <a class="cta-container" href="{{ $link->link->url }}" target="{{ $link->link->target }}">
            <div class="cta-hover-zoom">
              <div
                role="image"
                class="uk-background-cover links-with-images-grid__image"
                style="background-image: url('{{ $link->image->sizes->large }}');"
                aria-label="{{ $link->image->alt }}">
              </div>
            </div>
            <span class="cta-button-full-width">{{ $link->link->title }}</span>
          </a>
        </li>
      @endforeach
    </ul>
    @if (!empty($cta))
      <div class="uk-text-center uk-margin-medium-top">
        @include('components.cta-link', (array) $cta)
      </div>
    @endif
  </div>
</div>
