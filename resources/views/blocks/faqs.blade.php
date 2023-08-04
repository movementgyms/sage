<div class="faqs uk-container" id="{{ \App\str_to_machine($title) }}">
  <div class="uk-width-5-6 uk-margin-auto">
    @if (!empty($title))
      <h2 class="text-heading-large overline-medium">{{ $title }}</h2>
    @endif
    <ul uk-accordion="multiple: true">
      @foreach ($faqs as $faq)
        <li>
          <a class="uk-accordion-title uk-flex uk-flex-between uk-flex-stretch cta-container hover-color-white" href="#">
            <h3 class="uk-flex uk-flex-middle text-heading-medium uk-margin-remove-bottom uk-width-5-6">
              {{ $faq->title }}
            </h3>
            <div>
              <span class="cta-block-plus"></span>
            </div>
          </a>
          <div class="uk-accordion-content uk-width-5-6">
            {!! $faq->content !!}
          </div>
        </li>
      @endforeach
    </ul>
  </div>
</div>
