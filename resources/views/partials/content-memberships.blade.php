@include ('partials.the-content')

@include('components.top-accent', ['accent_color' => 'gray-medium'])
<div class="bg-dots">
  <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section">
    @include('blocks.benefits', [
      'benefits' => $benefits
    ])
  </section>

  <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section">
    @include('blocks.membership-rates');
  </section>

  <div class="content-blocks">
    @include('partials.content-blocks')
  </div>
</div>
