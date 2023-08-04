@php \App\switch_to_main_blog() @endphp
<div uk-grid>
  <div class="uk-width-1-2@m content-wp content-main">
    <h2>{{ get_field('rebrand_message_title', 'option') }}</h1>
    {!! get_field('rebrand_message_content', 'option') !!}
    @if (!empty($show_rebrand_message_cta))
      @include('components.cta-link', (array) get_field('rebrand_message_cta', 'option'))
    @endif
    @if (!empty($show_rebrand_message_logo))
      <figure class="uk-margin-remove">
        <img class="rebrand-message-modal__logo" src="@asset('images/icon-movement-symbol-white.svg')" />
      </figure>
    @endif
  </div>
  <div class="uk-width-1-2@m">
    <div class="responsive-video">
      {!! get_field('rebrand_message_video', 'option') !!}
    </div>
  </div>
</div>
@php restore_current_blog() @endphp
