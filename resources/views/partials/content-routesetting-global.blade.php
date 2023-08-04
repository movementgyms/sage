@php
  \App\switch_to_main_blog();
  $routesetting_page = get_field('routesetting_page', 'option');
@endphp

<div class="bg-dots">
  <div class="uk-container">
    <div class="uk-width-5-6 uk-margin-auto uk-margin-large-top uk-margin-bottom content-blocks content-main content-wp">

      {!! apply_filters('the_content', $routesetting_page->post_content) !!}

      @if (!empty($routesetting_file))
        <div>
          <a href="{{ $routesetting_file->url }}" class="cta-button" target="_blank">Route Updates</a>
        </div>
      @endif
    </div>

    <div class="responsive-video uk-margin-top uk-margin-bottom">
      @if (!empty($routesetting_video))
        {!! $routesetting_video !!}
      @else
        {!! wp_oembed_get($routesetting_page->default_routesetting_video) !!}
      @endif
    </div>
  </div>
  <div class="content-blocks">
    @include('partials.content-blocks', [
      'content_blocks' => json_decode(json_encode(get_field('content_blocks', $routesetting_page)))
    ])
  </div>
</div>

@php
  restore_current_blog();
@endphp
