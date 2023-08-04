<div class="directors">
  <div class="uk-container">
    <div uk-grid class="uk-grid-large uk-flex uk-flex-column uk-flex-row@m uk-padding">
      <div class="uk-width-2-5@m uk-width-1-3@l uk-margin-right@m">
        <h2 class="text-heading-large overline-medium">{{ $title }}</h2>
        {!! $content !!}
      </div>
      <div class="uk-width-3-5@m uk-width-2-3@l">
        <ul uk-grid class="uk-list uk-list-collapse uk-flex-center uk-child-width-1-2@s">
          @foreach ($people as $person)
            <li>
              <div>
                @include('components/background-image-cover', [
                  'url' => $person->headshot->sizes->large,
                  'alt' => $person->headshot->alt,
                  'padding' => '75%',
                ])
              </div>
              <div class="bg-brand-primary uk-padding">
                <h3 class="uk-margin-remove text-heading-medium color-white">
                  {{ $person->first_name }} <br/>
                  {{ $person->last_name }}
                </h3>
                <hr class="separator-medium bg-white" />
                <p class="uk-margin-remove color-white text-transform-lowercase">{{ $person->title }}</p>
              </div>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
