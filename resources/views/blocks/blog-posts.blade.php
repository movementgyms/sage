@php $id = uniqid('uk-switcher-'); @endphp
<div class="blog-posts">
  <div class="uk-container">
    <div class="uk-flex uk-flex-between uk-flex-column uk-flex-row@m uk-flex-middle@m">
      <h2 class="text-heading-large overline-medium">Blog</h2>
      <ul uk-switcher="connect: #{{ $id }}" class="uk-subnav" id="{{ $id }}-controls">
        @if( !empty($blog_tags) )
          @foreach ($blog_tags as $index => $blog_tag)
            <li class="{{ $index === 0 ? 'uk-active' : '' }}"><a href="#">{{ $blog_tag->blog_tag->label }}</a></li>
          @endforeach
        @endif
      </ul>
    </div>
    <div class="uk-switcher" id="{{ $id }}">
      @foreach ($blog_tags as $index => $blog_tag)
        <div class="uk-section-small">
          <div class="uk-flex uk-flex-stretch uk-flex-center uk-flex-left@m uk-child-width-1-2@s uk-child-width-1-3@m" uk-grid>
            @if( !empty( \App\get_hubspot_blog_post_by_tag($blog_tag->blog_tag->value) ) )
              @foreach (\App\get_hubspot_blog_post_by_tag($blog_tag->blog_tag->value) as $blog_post)
                <div class="uk-flex uk-flex-column">
                  @include ('components.background-image-cover', [
                    'url' => $blog_post->featuredImage,
                    'alt' => $blog_post->featuredImageAltText,
                    'padding' => '80%',
                  ])
                  <div class="uk-flex-grow uk-padding bg-brand-tertiary">
                    {{-- <time class="text-date">{{ date('F j, Y', strtotime($blog_post->publishDate)) }}</time> --}}
                    <p class="font-weight-medium">{{ $blog_post->name }}</p>
                    <a href="{{ $blog_post->url }}" class="cta-small color-yellow-medium" target="_blank" rel="noopener noreferrer">Read More</a>
                  </div>
                </div>
              @endforeach
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
