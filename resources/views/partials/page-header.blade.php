@if (!empty($header_type) && ( ( $header_type === 'image' && !empty($header_image) ) || $header_type === 'video'))
<div class="page-header">
  <div class="page-header__has-image {{ ( (!empty($header_type) && $header_type === 'video') ? 'has-video' : '' ) }}">
    @if (!empty($header_type) && $header_type === 'video')
      <div class="play-toggle">
        <img class="pause" src="@asset('images/icon-pause.svg')">
        <img class="play" src="@asset('images/icon-play.svg')">
      </div>
    @endif
    <div class="page-header__wrapper" style="padding-top: 56.25%">
      @if (!empty($header_type) && $header_type === 'video')
        <div class="responsive-video page-header__video" style="padding-top: 56.25%">
          <video class="desktop" autoplay loop muted playsinline>
            <source src="{{ ( !empty($header->desktop_video->url) ? $header->desktop_video->url : '' ) }}" type="video/mp4">
            Your browser does not support the video tag.
          </video>

          <video class="mobile" autoplay loop muted playsinline>
            <source src="{{ ( !empty($header->mobile_video->url) ? $header->mobile_video->url : '' ) }}" type="video/mp4">
            Your browser does not support the video tag.
          </video>
        </div>
      @else
        <div
          class="uk-background-cover page-header__image"
          role="image"
          style="background-image: @include('components.background-gradient-darken'), url('{{ $header_media_url }}');"
          aria-label={{ $header_media_alt }}
        ></div>
      @endif

      <div class="page-header__content uk-visible@m">
        @include('components.page-header-title')
      </div>

    </div>
  </div>
  <div class="uk-container uk-flex uk-flex-right">
    <div class="page-accent">
      <div class="bg-brand-primary"></div>
    </div>
  </div>
  <div class="page-header__content uk-margin-top uk-hidden@m">
    @include('components.page-header-title')
  </div>
</div>
@else
  <div class="page-header page-header__no-image">
    <div class="page-header__content uk-margin-top">
      @include('components.page-header-title')
    </div>
  </div>
@endif
