<div class="uk-container benefits">
  <h2 class="uk-text-center text-heading-large overline-medium overline-center">Membership Benefits</h2>
  <ul class="uk-list uk-list-collapse uk-flex uk-flex-stretch uk-child-width-1-2@s uk-margin-top benefits__list" uk-grid>
    @foreach ($benefits as $benefit)
      <li class="uk-flex uk-flex-stretch uk-margin-remove benefits__list__item">
        <div class="uk-flex uk-flex-middle uk-padding uk-padding-remove-left uk-width-1-1">
          <img class="uk-width-1-5 uk-width-1-6@m uk-margin-small-right" src="@asset('images/benefits-checkmark.svg')" alt="Checkmark" />
          <p class="uk-margin-remove">
            {{ $benefit->benefit }}
          </p>
        </div>
      </li>
    @endforeach
  </ul>
</div>
