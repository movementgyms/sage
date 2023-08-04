@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  <div class="uk-container">
    <section class="uk-section">
      @switch (get_query_var('taxonomy'))
        @case ('downloadable_type')
          <ul class="uk-list uk-list-collapse uk-grid uk-flex uk-flex-stretch uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m">
            @while(have_posts()) @php the_post() @endphp
              @php
                $file = json_decode(json_encode(get_field('file')));

                if (get_field('file_type') === 'video') {
                  $thumbnail = json_decode(json_encode(get_field('thumbnail')));
                } else {
                  $thumbnail = json_decode(json_encode(get_field('file')));
                }
              @endphp
              <li class="uk-flex uk-flex-stretch uk-flex-column">
                <div class="uk-width-1-1">
                  @if (!empty($thumbnail->sizes))
                    @include ('components.background-image-cover', [
                      'url' => $thumbnail->sizes->medium,
                      'alt' => $thumbnail->alt,
                      'padding' => '75%',
                    ])
                  @endif
                </div>
                <div class="uk-flex-grow uk-padding uk-margin-remove text-body-small bg-gray-medium">
                  <p>
                    {{ get_field('description') }}
                  </p>
                  <a href="{{ $file->url }}" class="cta-button" download>Download</a>
                </div>
              </li>
            @endwhile
          </ul>
        @break
      @endswitch
    </section>

    <nav class="uk-flex uk-margin-bottom">
      {!! get_previous_posts_link('Previous Page') !!}
      {!! get_next_posts_link('Next Page') !!}
    </nav>
  </div>

@endsection
