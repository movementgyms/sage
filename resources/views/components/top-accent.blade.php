@php
  if (empty($accent_color)) {
    $accent_color = $top_accent_color;
  }
@endphp

<div class="uk-container page-accent__container-top">
  <div class="page-accent-reversed">
    <div class="bg-{{ $accent_color }}"></div>
  </div>
</div>
