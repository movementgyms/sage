@php
  if (empty($classes)) {
    $classes = '';
  }

  if (empty($alt)) {
    $alt = '';
  }

  if (empty($padding)) {
    $padding = '100%';
  }
@endphp
<div
  role="image"
  class="uk-background-cover {{ $classes }}"
  style="background-image: url('{{ ( !empty( $url ) ? $url : '' ) }}'); padding-top: {{ $padding }};"
  aria-label="{{ $alt }}">
</div>
