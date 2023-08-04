@foreach ($icon_grid_items as $item)
  <li class="uk-width-1-1 uk-width-1-2@s uk-width-1-4@m uk-width-1-4@l uk-text-center uk-padding-small offerings__offering">
    <figure>
      <img src="{{$item->icon->url}}" class="uk-width-1-2 offerings__image" />
      <figcaption class="uk-flex uk-flex-column uk-flex-middle uk-margin-small-top offerings__caption">
        <span class="text-heading-small text-transform-lowercase offerings__label">{{ $item->title }}</span>
        <p>{{$item->description}}</p>
      </figcaption>
    </figure>
  </li>
@endforeach