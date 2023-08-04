

<div class="bg-dots">
  <div class="uk-container">
    <div uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section uk-width-5-6 uk-margin-auto">
      <div class="uk-grid uk-grid-column-large">
        <div class="uk-width-1-2@m content-wp">
          @php the_content() @endphp
        </div>
        <div class="uk-width-1-2@m">
          {!! $form_embed_code !!}
        </div>
      </div>
    </div>
  </div>
</div>
