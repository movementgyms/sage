<div class="media-with-caption">
  <div class="uk-container">
    @include ('components.block-title')

    @if ($media_type === 'video')
      <div class="responsive-video" style="padding-top: {{ \App\video_padding_from_iframe($video) }}">
        {!! $video !!}
      </div>
    @elseif($media_type === 'image')
      <img class="image-full-width" src="{{ $image->sizes->content_width }}" alt="{{ $image->alt }}" />
    @endif
  </div>
  <div class="uk-container uk-section-xsmall uk-padding-remove-bottom uk-flex uk-flex-center">
    <div class="uk-width-5-6 uk-margin-remove-last-child">
      {!! $caption !!}
    </div>
  </div>
</div>
