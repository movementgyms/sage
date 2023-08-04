@php
  if (empty($align)) {
    $align = 'center';
  }
@endphp

@if (!empty($title) || (!empty($content)))
  <div class="uk-width-5-6 uk-margin-auto uk-margin-bottom uk-text-{{ $align }}">
    @if (!empty($title))
      <h2 class="text-heading-large overline-medium overline{{ $align === 'center' ? '-center' : '' }}">{{ $title }}</h2>
    @endif
    @if (!empty($content))
    <div class="content-wp">
      {!! $content !!}
    </div>
    @endif
  </div>
@endif
