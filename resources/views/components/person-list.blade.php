<ul uk-grid class="uk-child-width-1-2@s uk-child-width-1-3@m">
  @if (!empty($instructors))
    @foreach ($instructors as $instructor)
      @php
        $headshot = !empty($instructor->headshot) ? $instructor->headshot : $instructor->image;

        if ($has_classes === true && !empty($instructor->classes)) {
          $instructor->classes = array_map(function($class) {
            return [
              'name' => $class->post_title,
            ];
          }, $instructor->classes);
        }
      @endphp

      <li>
        <a
          uk-toggle
          class="cta-container"
          href="#instructor-modal"
          data-instructor="{{ json_encode($instructor) }}"
        >
          <div class="cta-hover-zoom">
            @include('components/background-image-cover', [
              'url' => ( !empty($headshot) ? $headshot->sizes->large : '' ),
              'alt' => ( !empty($headshot) ? $headshot->alt : '' ),
              'padding' => '75%',
            ])
          </div>
          <div class="bg-brand-secondary uk-flex uk-flex-between">
            <h3 class="uk-padding-small uk-margin-remove text-heading-medium color-white">
              {{ $instructor->first_name }} <br/>
              {{ $instructor->last_name }}
            </h3>
            <button class="cta-block-plus uk-margin-auto-top"></button>
          </div>
        </a>
      </li>
    @endforeach
  @endif
</ul>

<div id="instructor-modal" class="uk-modal-container person-modal" uk-modal>
  <div class="uk-modal-dialog uk-margin-auto-vertical bg-brand-secondary">
    <div class="uk-flex uk-flex-column uk-flex-row@m uk-child-width-1-2@m uk-margin-small-top uk-margin-small-bottom">
      <div id="instructor-modal__image-container" class="uk-flex uk-flex-stretch">
        @include('components/background-image-cover', [
          'url' => '',
          'alt' => '',
          'classes' => 'uk-width-1-1 person-modal__image',
        ])
      </div>
      <div class="uk-flex uk-flex-column uk-flex-between bg-white">
        <div class="uk-padding-medium">
          <h2 id="instructor-modal__name" class="text-heading-medium-large overline-medium-thin"></h2>
          <div id="instructor-modal__bio" class="text-body-small"></div>
          @if ($has_classes === true)
            <div id="instructor-modal__classes__wrapper">
              <h3 class="text-heading-small text-transform-uppercase">Classes</h3>
              <ul id="instructor-modal__classes" class="list-caret two-column text-list-small"></ul>
            </div>
          @endif
        </div>
        <button class="uk-modal-close cta-block-close uk-margin-auto-left"></button>
      </div>
    </div>
  </div>
</div>
