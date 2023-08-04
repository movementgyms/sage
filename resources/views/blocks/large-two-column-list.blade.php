<div class="uk-container">
  @include('components.block-title')

  <div class="uk-width-5-6 uk-margin-auto">
    <ol class="list-two-column-large">
      @foreach ($list_items as $list_item)
        <li>
          <div>
            <h3>{{ $list_item->title }}</h3>
            <div class="list-two-column-large__content color-blue-dark">
              {!! $list_item->content !!}
            </div>
          </div>
        </li>
      @endforeach
    </ol>
  </div>
</div>
