@php
  $id = uniqid('uk-switcher-');
  $pricing_types = json_decode(json_encode(get_field('pricing_types', 'option')));
  $rentals = json_decode(json_encode(get_field('rentals', 'option')));

  $pricing = [
    'membership' => [],
    'pass' => [],
    'rental' => $rentals,
];

  foreach ($pricing_types as $pricing_type) {
    foreach ($pricing_type->items as &$item) {
      $item->pricing_type = $pricing_type->type->label;
      $pricing[$item->type->value][] = $item;
    }
  }
@endphp
<div class="pricing">
  <div class="uk-flex uk-flex-stretch bg-brand-tertiary">
    <div
      role="image"
      class="uk-width-1-2 uk-background-cover"
      style="background-image: url('{{ $image->sizes->large }}');"
      aria-label="{{ $image->alt }}">
    </div>
    <div class="uk-width-1-2">
      <div class="container-half-width uk-padding-large pricing__content">
        <h2 class="text-heading-large color-white overline-medium">{{ $title }}</h2>
        <ul uk-switcher="connect: #{{ $id }}" class="uk-subnav" id="{{ $id }}-controls">
          @foreach (['memberships', 'passes', 'rentals'] as $index => $tab)
            <li class="{{ $index === 0 ? 'uk-active' : '' }}"><a href="#">{{ ucwords($tab) }}</a></li>
          @endforeach
        </ul>
        <ul class="uk-switcher uk-margin-top" id="{{ $id }}">
          @foreach (['membership', 'pass', 'rental'] as $index => $tab)
            <li>
              <ul class="uk-list text-heading-small text-transform-uppercase pricing__list">
                @foreach ($pricing[$tab] as $item)
                  <li class="uk-flex uk-flex-between uk-flex-middle bg-brand-secondary color-white">
                    @if ($tab === 'membership')
                      <span>{{ $item->title }} ({{ $item->pricing_type }})</span>
                    @elseif ($tab === 'pass')
                      <span>
                        {{ $item->title }}
                        @if ($item->pricing_type !== 'Individual')
                          ({{ $item->pricing_type }})
                        @endif
                      </span>
                    @else
                      <span>{{ $item->item->label }}</span>
                    @endif
                    <span>{{ $item->price }}</span>
                  </li>
                @endforeach
              </ul>
              @if ($item->has_purchase_link)
                @include('components.cta-link', array_merge((array) $cta, ['classes' => 'cta-button uk-margin-medium-top']))
              @endif
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
