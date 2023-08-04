@include('components.top-accent')
<div class="bg-dots">
  <section class="uk-section uk-padding-remove-top">
    <h2 class="screen-reader-text">Activities</h2>
    <ul class="uk-list uk-list-collapse home-activities">
      @foreach ($home_activities as $activity)
      <li uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-flex uk-flex-stretch bg-{{ $activity->background_color }} home-activities__activity">
        <div class="uk-flex uk-flex-stretch uk-width-1-2@m">
          @include ('components.background-image-cover', [
            'url' => $activity->image->sizes->large,
            'alt' => $activity->image->alt,
            'classes' => 'uk-width-1-1',
            'padding' => '80%',
          ])
        </div>
        <div class="uk-width-1-2@m">
          <div class="uk-padding-large container-half-width home-activities__activity__content">
            <h3 class="text-heading-xlarge color-white">{{ $activity->name }}</h3>
            <div class="color-white">{!! $activity->copy !!}</div>
            <div class="color-white">
              @include ('components.blockquote', (array) $activity->quote)
            </div>
          </div>
        </div>
      </li>
      @endforeach
    </ul>
  </section>
</div>
