<div class="bg-brand-secondary uk-margin-bottom photo-grid">
  @if( !empty($block->photo_row) )
    @foreach( $block->photo_row as $photo_row)
      <ul class="photo-row">
        @if( !empty($photo_row->photo_items) )
          @foreach( $photo_row->photo_items as $photo_item)
          <li class="photo-item">
            <div class="image" style="background-image: url({{ $photo_item->photo->sizes->large  }});">
              <img src="{{ $photo_item->photo->sizes->thumbnail }}" alt="">
            </div>
          </li>
          @endforeach
        @endif
      </ul>
    @endforeach
  @endif
</div>