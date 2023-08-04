<div class="class-types uk-container">
  <div class="uk-width-5-6 uk-margin-auto">
    <h2 class="screen-reader-text">Class Types</h2>
    <ul class="uk-padding-remove uk-padding-remove-first-child uk-padding-remove-last-child alternating-image-list">
      @foreach ($class_types as $class_type_info)
        @if( !empty($class_type_info->class_type) )
          @php $class_type = \ClassType::classTypeWithMetadata($class_type_info->class_type) @endphp
          <li uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section-small uk-flex alternating-image-list__item">
            <div class="uk-flex uk-flex-middle uk-padding">
              <div>
                @if (!empty(\App\override_field('free_for_members', $class_type_info, $class_type)))
                  <h3 class="text-heading-large overline-medium uk-margin-remove-bottom">{{ $class_type->name }}</h3>
                  <h4 class="text-heading-medium">(Free for Members)</h4>
                @else
                  <h3 class="text-heading-large overline-medium">{{ $class_type->name }}</h3>
                @endif
                {!! apply_filters('the_content', \App\override_field('description', $class_type_info, $class_type)) !!}
                @include('components.cta-link', (array) $class_type_info->cta)
              </div>
            </div>
            <div class="uk-flex uk-flex-stretch">
              <div class="uk-padding uk-width-1-1">
                <div
                  role="image"
                  class="uk-background-cover uk-width-1-1 alternating-image-list__image"
                  style="background-image: url('{{ \App\override_field('image', $class_type_info, $class_type)->sizes->large }}')"
                  aria-label="{{ \App\override_field('image', $class_type_info, $class_type)->alt }}"
                >
                </div>
              </div>
            </div>
            @if (!empty($class_type_info->cta))

            @endif
          </li>
        @endif
      @endforeach
    </ul>
  </div>
</div>
