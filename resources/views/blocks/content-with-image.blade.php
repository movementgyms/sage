<div class="content-with-image content-with-image-{{$image_position}}">
  <div class="uk-flex uk-flex-column-reverse uk-flex-row@m uk-flex-stretch uk-child-width-1-1 uk-child-width-1-2@m">
    <div class="uk-flex uk-flex-middle">
      <div class="container-half-width uk-padding-large content-with-image__content">
        <h2 class="text-heading-large color-white overline-medium">{{ $title }}</h2>
        <div class="color-white content-wp">
          {!! $content !!}
        </div>
        @include('components/cta-link', array_merge((array) $cta, ['classes' => 'cta-button uk-margin-top']))
      </div>
    </div>
    <div
      role="image"
      class="uk-background-cover content-with-image__image"
      style="background-image: url('{{ $image->sizes->large }}');"
      aria-label="{{ $image->alt }}">
    </div>
  </div>
</div>
