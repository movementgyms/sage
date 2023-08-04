<div class="uk-container">
  <div class="uk-width-5-6 uk-width-1-1@l uk-margin-auto">
    @if( empty($header->hide_title_and_subtitle) )
      <div class="overline-medium">
        <div class="uk-flex {{ !empty($header) && !empty($header->show_title_first) && $header->show_title_first === true ? 'uk-flex-column' : 'uk-flex-column-reverse' }} uk-margin-small-bottom">
          <h1 class="text-page-header-title">
            {!! !empty($header->title) ? apply_shortcodes($header->title) : App::title() !!}
          </h1>
          <p class="uk-margin-remove text-page-header-subtitle{{ !is_front_page() ? '-small' : ''}}">
            {!! !empty($header->subtitle) ? apply_shortcodes($header->subtitle) : App::breadcrumbs() !!}
          </p>
        </div>
      </div>
    @endif

    @if (!empty($header->cta))
      <div class="uk-margin-small-bottom">
        <a href="{{ $header->cta->url }}" class="cta-button" target="{{ $header->cta->target }}">{{ $header->cta->title }}</a>
      </div>
    @endif
  </div>
</div>
