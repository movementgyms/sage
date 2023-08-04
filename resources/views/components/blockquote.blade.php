<div class="blockquote">
  <div class="color-brand-secondary">
    @include('images/icon-quote')
  </div>
  <div class="blockquote__container uk-flex uk-flex-middle">
    @if (!empty($image))
      <blockquote class="uk-width-3-5 uk-flex-grow">
        <p>{{ $quote }}&rdquo;</p>
        <footer>
          <cite class="text-blockquote-cite">{{ $attribution }}</cite>
        </footer>
      </blockquote>
      <figure class="uk-width-2-5 uk-padding-small uk-padding-remove-right uk-text-right">
        <img class="uk-width-1-1 blockquote__image" src="{{ $image->sizes->thumbnail }}" alt="{{ $image->alt }}" />
      </figure>
    @else
      <blockquote class="uk-width-1-1 uk-flex-grow text-blockquote-bold">
        <p>{{ $quote }}&rdquo;</p>
        @if (!empty($attribution))
          <footer>
            <cite class="text-blockquote-cite">&mdash; {{ $attribution }}</cite>
          </footer>
        @endif
      </blockquote>
    @endif
  </div>
</div>
