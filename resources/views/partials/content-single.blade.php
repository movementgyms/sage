
@if (!empty(get_the_content()))
  <section class="uk-container uk-section uk-flex uk-flex-center">
    <div class="uk-width-5-6 content-wp content-main">
      <h1 class="text-content-main-heading">{{ get_the_title() }}</h1>
      @php the_content() @endphp
    </div>
  </section>
@endif
