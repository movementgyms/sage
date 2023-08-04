<section class="message-banner uk-hidden" id="{{ $banner_id }}">
  @php $id = uniqid('message-banner-'); @endphp
  <div class="message-banner__collapsed bg-brand-secondary color-white">
    <div class="uk-container">
      <div class="uk-width-5-6 uk-margin-auto">
        <p class="uk-text-center uk-margin-xsmall-top uk-margin-xsmall-bottom">
          <strong class="text-label-medium text-transform-uppercase message-banner__alert">: Alert :</strong>
          <span class="text-body-small message-banner__title"></span>
          <button class="cta-more color-yellow-medium hover-color-white message-banner__more" data-message-banner="{{ $id }}">More</button>
        </p>
      </div>
    </div>
  </div>

  <div id="{{ $id }}" class="uk-section-small message-banner__expanded bg-brand-secondary color-white">
    <div class="uk-container">
      <div class="uk-width-5-6@m uk-margin-auto uk-text-center content-wp">
        <p class="uk-margin-remove-bottom message-banner__alert">
          <strong class="text-label-medium text-transform-uppercase">: Alert :</strong>
        </p>
        <div class="message-banner__content uk-margin-remove-last-child"></div>
      </div>
    </div>
    <div class="uk-margin-small-top uk-margin-right">
      <button class="message-banner__expanded__close dropdown-close color-white"><i class="icon-close"></i></a>
    </div>
  </div>
</section>
