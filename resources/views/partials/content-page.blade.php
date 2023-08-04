@include ('partials.the-content')

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
