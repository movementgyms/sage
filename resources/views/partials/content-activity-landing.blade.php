<section class="uk-container uk-section">
  <div uk-grid>
    <div class="uk-margin-auto uk-width-5-6 uk-width-2-3@m content-wp content-main">
      @php the_content() @endphp
    </div>
    <div class="uk-margin-auto uk-width-5-6 uk-width-1-3@m uk-margin-top uk-margin-remove-top@m">
      @include('components/blockquote', (array) $quote)
    </div>
  </div>
</section>

@include('components.top-accent', ['accent_color' => !empty($offerings) ? 'gray-medium' : $top_accent_color])
<div class="bg-dots">
  <div class="content-blocks">
    @if (!empty($offerings))
      <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section">
        @include('blocks.offerings', array_merge((array) $offerings, ['activity_type' => $activity_type]))
      </section>
    @endif

    @include('partials.content-blocks')
  </div>
</div>
