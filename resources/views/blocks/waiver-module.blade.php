<div class="waiver-module">
  @include('components.block-title')
  <div class="uk-container">
    <div class="uk-width-5-6 uk-margin-auto uk-text-center">
      @foreach ($sections as $section)
        <section class="uk-section-small waiver-module__section">
          <h3 class="text-heading-medium-large">{{ $section->title }}</h3>
          {!! $section->content !!}
          <ul uk-grid class="uk-list uk-flex-center uk-margin-medium-top uk-list-collapse uk-child-width-1-3@s">
            @foreach ($section->ctas as $cta)
              <li class="uk-flex uk-flex-column uk-flex-middle">
                @include('components.cta-link', (array) $cta->english)
                @include('components.cta-link', array_merge((array) $cta->spanish, ['classes' => 'uk-margin-small-top cta-small color-yellow-medium'] ))
              </li>
            @endforeach
          </ul>
          @if (!empty($section->waiver_pdfs_title))
            <h4 class="text-heading-small text-transform-none uk-margin-top uk-margin-remove-bottom">{{ $section->waiver_pdfs_title }}</h4>
          @endif
          @if (!empty($section->waiver_pdfs))
            @foreach ($section->waiver_pdfs as $waiver_pdf)
              <div>
                @include('components.cta-link', [
                  'url' => $waiver_pdf->file,
                  'title' => $waiver_pdf->link_text,
                  'classes' => 'cta-small color-yellow-medium',
                  'target' => '_blank',
                ])
              </div>
            @endforeach
          @endif
        </section>
      @endforeach
    </div>
  </div>
</div>
