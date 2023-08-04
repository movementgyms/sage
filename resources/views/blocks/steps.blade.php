<div class="steps">
  <div class="uk-container">
    @include ('components.block-title')

    <ul uk-grid class="uk-flex uk-flex-center uk-list uk-list-collapse uk-width-5-6 uk-margin-auto uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-5@m">
      @foreach ($steps as $index => $step)
        <li class="uk-text-center">
          <div class="text-step-number-small bg-brand-primary color-white">{{ $index + 1 }}</div>
          <p class="text-label-medium text-transform-uppercase">{{ $step->title }}</p>
        </li>
      @endforeach
    </ul>
  </div>
</div>
