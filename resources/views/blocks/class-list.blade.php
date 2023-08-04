<ul uk-grid class="uk-grid-match uk-flex uk-flex-center uk-child-width-1-2@s uk-child-width-1-3@m class-list" uk-grid>
  @if (!empty($classes))
    @foreach ($classes as $class_info)
      @if( !empty( $class_info->class ) )
        @php
          $default_class = $class_info->class;

          $default_class->image = \App::getThumbnailInfo($default_class, 'large');
          $image = \App\override_field('image', $class_info, $default_class);

          $description = \App\override_field('description', $class_info, $default_class);
          $class_length = \App\override_field('class_length', $class_info, $default_class);
          $price = \App\override_field('price', $class_info, $default_class);
          $member_price = \App\override_field('member_price', $class_info, $default_class);
          $cta = \App\override_field('cta', $class_info, $default_class);
        @endphp
        <li class="uk-flex uk-flex-column class-list__item">
          @include('components.background-image-cover', [
            'url' => $image->url,
            'alt' => $image->alt,
            'size' => 'large',
            'padding' => '75%',
            'classes' => 'class-list__item__image'
          ])

          <div class="bg-gray-light uk-padding uk-margin-remove-last-child class-type-border-color-{{ $class_type->color }} class-list__item__content text-card">
            <h3 class="text-card-title separator-line-small">{!! get_the_title($default_class) !!}</h3>
            <div class="separator-line-small">
              {!! apply_filters('the_content', $description) !!}
            </div>
            @if(!empty($class_length))
              <time class="separator-line-small">
                <strong>
                  {{ $class_length }}
                </strong>
              </time>
            @endif
            <p>
              <strong>
                @if(!empty($price))
                  Price: {{ $price }}
                @endif
                @if(!empty($price && !empty($member_price)))
                  |
                @endif
                @if(!empty($member_price))
                  Member Price: {{ $member_price }}
                @endif
              </strong>
            </p>

            @if (!empty($cta))
              <div class="uk-flex uk-flex-center">
                @include('components.cta-link', array_merge((array) $cta, ['classes' => null]))
              </div>
            @endif
          </div>
        </li>
      @endif
    @endforeach
  @endif
</ul>
