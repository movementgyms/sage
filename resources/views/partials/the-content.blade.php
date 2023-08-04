@if (!empty(get_the_content()))
  <section class="uk-container uk-section uk-flex uk-flex-center">
    <div class="uk-width-5-6 content-wp content-main">
      @php the_content() @endphp
    </div>
  </section>
@endif
