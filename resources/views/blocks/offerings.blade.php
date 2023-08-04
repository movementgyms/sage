<div class="uk-container">
  @if (!empty($offerings_title))
    <h2 class="uk-text-center uk-margin-bottom text-heading-large overline-medium overline-center">{{ $offerings_title }}</h2>
  @endif
  <ul uk-grid class="uk-width-1-1 uk-list uk-list-collapse uk-flex uk-flex-wrap uk-flex-center offerings">
    @foreach ($offerings as $offering)
      <li class="uk-width-1-2 uk-width-1-3@s uk-width-1-4@m uk-width-1-5@l uk-text-center uk-padding-small offerings__offering">
        <figure>
          <img src="@asset('images/activity-icons/icon-' . $offering->{$activity_type . '_offering'}->value . '.svg')" class="uk-width-1-2 offerings__image" />
          <figcaption class="uk-flex uk-flex-column uk-flex-middle uk-margin-small-top offerings__caption">
            @if (!empty($offering->number))
              <span class="offerings__number separator-line-medium separator-centered">{{ number_format($offering->number) }}</span>
            @endif
            <span class="text-heading-small text-transform-uppercase offerings__label">{{ $offering->{$activity_type . '_offering'}->label }}</span>
          </figcaption>
        </figure>
      </li>
    @endforeach
  </ul>
</div>
