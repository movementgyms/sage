<div class="uk-container location-activities">
  @if (!empty($activities))
    <h2 class="screen-reader-text">Activities</h2>
    <ul uk-grid class="uk-flex-center uk-list uk-list-collapse location-activities__list">
      @foreach ($activities as $activity)
        <li class="uk-width-4-5 uk-width-1-2@s uk-width-1-3@m">
          <a class="cta-container" href="{{ $activity->link }}">
            <div class="uk-padding-small uk-padding-remove-bottom uk-padding-remove-left uk-padding-remove-right bg-brand-secondary">
              <div class="cta-hover-zoom location-activities__image-wrapper">
                <div
                  role="image"
                  class="uk-background-cover location-activities__image"
                  style="background-image: url('{{ $activity->image->sizes->large }}');">
                </div>
              </div>
              <h3 class="uk-padding uk-padding-remove-right text-heading-large location-activities__name">
                <span class="cta-block-arrow-right cta-block-hover-shift color-white hover-color-white">
                  {{ $activity->name }}
                </span>
              </h3>
            </div>
          </a>
        </li>
      @endforeach
    </ul>
  @endif
</div>
