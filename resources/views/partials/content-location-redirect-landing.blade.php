@include ('partials.the-content')

@if (!empty($location_states))
  <section class="uk-container uk-section uk-flex uk-flex-center location-redirect-list">
    <div class="uk-width-5-6 content-wp content-main">
      @foreach($location_states as $location_state)
        <h2>{{$location_state->state}}</h2>
        <ul>
          @foreach($location_state->locations as $location_item)
            <li><a href="{{$location_item->link->url}}" class="cta-button">{{$location_item->link->title}}</a></li>
          @endforeach
        </ul>
      @endforeach
    </div>
  </section>
@endif

@if (!empty($content_blocks))
  {{-- Hide page accent if it's a left aligned image since it looks super weird --}}
  @if (
    !empty(get_the_content())
    && $content_blocks[0]->acf_fc_layout !== 'content_with_image'
    || (!empty($content_blocks[0]->image_position) && !$content_blocks[0]->image_position === 'right')
  )
    @include('components.top-accent')
  @endif
  <div class="bg-dots">
    <div class="content-blocks">
      @include('partials.content-blocks')
    </div>
  </div>
@endif
