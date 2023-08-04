<div class="icongrid">
  <div class="uk-container">
    @if (!empty($title))
      <h2 class="uk-text-center uk-margin-bottom text-heading-large overline-medium overline-center">{{ $title }}</h2>
    @endif
    @if(!empty($copy))
      <div class="uk-width-5-6 uk-margin-auto uk-margin-bottom uk-text-center">
        <div class="content-wp">
          <p>{{ $copy }}</p>
        </div>
      </div>
    @endif
    <ul uk-grid class="uk-width-1-1 uk-list uk-list-collapse uk-flex uk-flex-wrap uk-flex-center offerings">
      @include('components.icon-grid', ['icon_grid_items' => $icon_grid_items])
    </ul>

    @if($cta_link)
      <div class="uk-width-5-6 uk-margin-auto uk-margin-bottom uk-text-center">
        <a href="{{$cta_link->url}}" class="cta-button" target="{{$cta_link->target}}">{{$cta_link->title}}</a>
      </div>
    @endif
  </div>
</div>