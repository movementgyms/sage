<footer class="uk-section bg-gray-dark footer-main">
  <div class="uk-container">
    <div class="uk-flex uk-flex-column uk-flex-row@m uk-flex-between uk-flex-middle">
      <div>
        @php \App\switch_to_main_blog(); @endphp
          <a class="cta-button" href="{{ get_permalink(get_field('newsletter_signup_page', 'option')) }}">Sign up for our newsletter</a>
        @php restore_current_blog(); @endphp
      </div>
      <ul class="uk-list uk-flex uk-flex-middle uk-margin-top uk-margin-remove-bottom uk-margin-remove-top@m social-icons">
        @if (!empty(get_field('facebook_handle', 'option')))
          <li class="uk-margin-remove">
            <a class="link-social color-yellow-medium hover-color-white" href="https://facebook.com/{{ get_field('facebook_handle', 'option') }}" target="_blank" rel="noopener noreferrer">
              <figure>@include('images/icon-facebook')</figure>
            </a>
          </li>
        @endif
        @if (!empty(get_field('instagram_handle', 'option')))
          <li class="uk-margin-remove-top uk-margin-small-left">
            <a class="link-social color-yellow-medium hover-color-white" href="https://instagram.com/{{ get_field('instagram_handle', 'option') }}" target="_blank" rel="noopener noreferrer">
              <figure>@include('images/icon-instagram')</figure>
            </a>
          </li>
        @endif
        @if (!empty(get_field('youtube_handle', 'option')))
          <li class="uk-margin-remove-top uk-margin-small-left">
            <a class="link-social color-yellow-medium hover-color-white" href="https://youtube.com/{{ get_field('youtube_handle', 'option') }}" target="_blank" rel="noopener noreferrer">
              <figure>@include('images/icon-youtube')</figure>
            </a>
          </li>
        @endif
      </ul>
    </div>
    <div class="uk-flex uk-flex-column">
      <div class="uk-width-2-3@m uk-margin-top">
        @php \App\switch_to_main_blog(); @endphp
          @if (has_nav_menu('footer_navigation'))
            {!! wp_nav_menu([
              'theme_location' => 'footer_navigation',
              'menu_class' => 'nav nav-footer',

            ]) !!}
          @endif
        @php restore_current_blog(); @endphp
      </div>
      <div class="uk-flex uk-flex-column uk-flex-row@s uk-flex-bottom uk-flex-between uk-margin-small-top">
        <p class="text-muted color-gray-medium-dark margin-bottom-remove">
          @php \App\switch_to_main_blog(); @endphp
            {{ bloginfo('title') }} &copy; {{ date('Y') }} | Site by <a class="color-gray-light hover-color-yellow-medium" href="https://vermilion.com" target="_blank" rel="noopener noreferrer">Vermilion Design + Digital</a>
          @php restore_current_blog(); @endphp
        </p>
        <div class="uk-width-1-2 uk-width-1-3@s uk-width-1-4@m uk-width-1-6@l uk-flex uk-flex-bottom uk-flex-right">
          <a class="uk-width-1-1 footer-logo-link" href="{{ get_home_url() }}">
            <img class="footer-logo" src="{{ $footer_logo['sizes']['large'] }}" height="{{ $footer_logo['sizes']['large-height'] }}" width="{{ $footer_logo['sizes']['large-width'] }}" alt={{ $footer_logo['alt'] }}/>
          </a>
        </div>
      </div>
    </div>
  </div>
</footer>
