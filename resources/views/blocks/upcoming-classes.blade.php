<div class="uk-container upcoming-classes">
  <h2 class="text-heading-xlarge uk-text-center overline-medium overline-center">{{ $title }}</h2>
  @if(function_exists('elcap_calendar_upcoming_classes'))
    @php $classes = elcap_calendar_upcoming_classes(get_field('location_name', 'option')); @endphp
    <ul uk-grid class="uk-container uk-flex uk-flex-stretch uk-flex-center uk-list uk-list-collapse uk-margin-top">
      @foreach ($classes as $index => $class)
        @php
          $start_time = DateTime::createFromFormat('Y-m-d\TH:i:sP', $class->startLocal);
          $end_time = DateTime::createFromFormat('Y-m-d\TH:i:sP', $class->endLocal);
        @endphp
        <li class="uk-flex uk-flex-stretch uk-width-2-3 uk-width-1-2@s uk-width-1-4@m upcoming-classes__list__item" data-start-timestamp="{{ $class->startEpoch }}">
          <div class="uk-flex uk-flex-column uk-width-1-1 uk-padding-small bg-white border-top-large class-type-border-color-{{ !empty($class->color) ? $class->color : ''}}">
            <h3 class="text-label-small text-transform-none uk-margin-remove">{!! $class->title !!}</h3>
            <hr class="separator-small" />
            @if (!empty($class->class_type))
              <p class="uk-margin-remove text-body-xsmall">{{ $class->class_type }}</p>
              <hr class="separator-small" />
            @endif

            @if (!empty($class->instructor))
              <p class="uk-margin-remove text-body-xsmall">{{ $class->instructor }}</p>
            @endif

            <time class="uk-flex-grow text-body-xsmall">
              {{ $start_time->format('F j, Y') }}
              <br/>
              {{ $start_time->format('g:iA') }} - {{ $end_time->format('g:iA') }}
            </time>
          </div>
        </li>
      @endforeach
    </ul>
  @endif
  <div class="uk-text-center uk-margin-top">
    @include ('components/cta-link', array_merge((array) $full_calendar_link, ['classes' => 'cta-button']))
  </div>
</div>
