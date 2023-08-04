<!-- Google Tag Manager (noscript) -->
@php \App\switch_to_main_blog(); @endphp
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ get_field('gtm_id', 'option')}}"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
@php restore_current_blog(); @endphp
<!-- End Google Tag Manager (noscript) -->

<header uk-sticky="top: #nav-sticky-scroll-point" class="header-main" id="header-main">
  {{-- Secondary Nav --}}
  <nav class="uk-container uk-container-expand nav-top bg-gray-dark">
    @php \App\switch_to_main_blog(); @endphp
      @if (has_nav_menu('secondary_navigation'))
        {!!
          wp_nav_menu([
            'echo' => false,
            'theme_location' => 'secondary_navigation',
            'menu_class' => 'nav nav-secondary'
          ])
        !!}
      @endif
    @php restore_current_blog(); @endphp
  </nav>
  <div class="uk-container uk-container-expand uk-flex uk-flex-stretch header-top bg-brand-secondary">
    <a class="header-logo-link" href="/">
      <img class="header-logo" src="{{ $logo['sizes']['large'] }}" height="{{ $logo['sizes']['large-height'] }}" width="{{ $logo['sizes']['large-width'] }}" alt={{ $logo['alt'] }}/>
    </a>

    {{-- Main blog nav --}}
    <nav class="nav-header uk-flex uk-flex-middle">
      @php \App\switch_to_main_blog(); @endphp
        @if (has_nav_menu('primary_navigation'))
          {!!
            wp_nav_menu([
              'echo' => false,
              'theme_location' => 'primary_navigation',
              'container_class' => 'nav-primary-container',
              'depth' => 1,
              'menu_class' => 'nav nav-primary'
            ])
          !!}
        @endif
      @php restore_current_blog(); @endphp

      {{-- Location Primary Navigation --}}
      <div class="nav-location-primary-container menu-secondary-navigation-container">
        @php \App\switch_to_user_blog(); @endphp
          @if (has_nav_menu('location_primary_navigation'))
            {!!
              wp_nav_menu([
                'echo' => false,
                'container' => false,
                'theme_location' => 'location_primary_navigation',
                'depth' => 1,
                'menu_class' => 'nav nav-primary nav-location-primary'
              ])
            !!}
          @endif
        @php restore_current_blog(); @endphp
      </div>
    </nav>

    {{-- Choose location --}}
    <nav class="uk-flex uk-flex-row uk-flex-middle nav-location-picker">
      @include ('images/icon-map-marker')
      <a class="uk-flex uk-flex-middle user-location-name">
        @php \App\switch_to_user_blog(); @endphp
          @if (is_main_site())
            Choose Location
          @else
            {{ bloginfo('sitename') }}
          @endif
        @php restore_current_blog(); @endphp
      </a>
    </nav>

    <nav class="uk-section-small bg-brand-secondary nav-dropdown__container nav-locations-dropdown-container">
      {{-- Locations Dropdown --}}
      @php \App\switch_to_main_blog(); @endphp
        @if (has_nav_menu('locations'))
          {!!
            wp_nav_menu([
              'echo' => false,
              'theme_location' => 'locations',
              'container_class' => 'uk-container locations-container',
              'menu_class' => 'nav nav-locations-dropdown'
            ])
          !!}
          <div class="uk-flex uk-margin-top uk-flex-center">
            @include('components.cta-link', (array) get_field('locations_dropdown_cta', 'option'))
          </div>
        @endif
      @php restore_current_blog(); @endphp
      <button class="nav-dropdown__close dropdown-close uk-margin-right color-white"><i class="icon-close"></i></a>
    </nav>

    <nav class="uk-section-small bg-brand-secondary nav-dropdown__container nav-primary-dropdown-container">
      {{-- Global nav dropdown --}}
      @php \App\switch_to_main_blog(); @endphp
        @if (has_nav_menu('primary_navigation'))
          {!!
            wp_nav_menu([
              'echo' => false,
              'theme_location' => 'primary_navigation',
              'container_class' => 'uk-container primary-nav-container',
              'menu_class' => 'nav nav-primary-dropdown'
            ])
          !!}
        @endif
      @php restore_current_blog(); @endphp

      {{-- Location nav dropdown --}}
      <div class="uk-container location-primary-nav-container">
        @php \App\switch_to_user_blog(); @endphp
          @if (has_nav_menu('location_primary_navigation'))
            {!!
              wp_nav_menu([
                'echo' => false,
                'container' => false,
                'theme_location' => 'location_primary_navigation',
                'menu_class' => 'nav nav-primary-dropdown'
              ])
            !!}
          @endif
        @php restore_current_blog(); @endphp
      </div>
      <button class="nav-dropdown__close dropdown-close uk-margin-right color-white"><i class="icon-close"></i></button>
    </nav>
  </div>
</header>

<div id="nav-sticky-scroll-point"></div>

<div uk-sticky="top: #nav-sticky-scroll-point" style="z-index: -1" class="nav-sticky-toggle bg-brand-secondary">
  <div class="uk-container uk-flex uk-flex-between uk-flex-middle uk-padding-small">
    <button class="hamburger hamburger--squeeze js-hamburger color-white">
      <div class="hamburger-box">
        <div class="hamburger-inner"></div>
      </div>
    </button>
    <img class="nav-sticky-toggle__logo" src="{{ $logo_symbol['sizes']['large'] }}" height="{{ $logo_symbol['sizes']['large-height'] }}" width="{{ $logo_symbol['sizes']['large-width'] }}" alt={{ $logo_symbol['alt'] }}/>
    <button class="hamburger hamburger--squeeze js-hamburger color-white">
      <div class="hamburger-box">
        <div class="hamburger-inner"></div>
      </div>
    </button>
  </div>
</div>

<header uk-sticky class="header-mobile bg-brand-secondary">
  <div class="uk-container uk-container-expand uk-flex uk-flex-middle uk-flex-between header-top">
    <a class="header-logo-link" href="/">
      <img class="header-logo" src="{{ $logo['sizes']['large'] }}" height="{{ $logo['sizes']['large-height'] }}" width="{{ $logo['sizes']['large-width'] }}" alt={{ $logo['alt'] }}/>
    </a>
    <div class="mobile-header-actions uk-flex uk-flex-middle">
      @include ('images/icon-map-marker')
      <button class="hamburger hamburger--squeeze js-hamburger mobile-menu-toggle color-white">
        <div class="hamburger-box">
          <div class="hamburger-inner"></div>
        </div>
      </button>
    </div>
  </div>
  <nav class="nav-mobile nav-mobile-main bg-brand-secondary">
    <div class="uk-container nav-location-picker bg-white">
      @include ('images/icon-map-marker')
      <a class="uk-flex uk-flex-middle color-blue-dark user-location-name">
        @php \App\switch_to_user_blog(); @endphp
          @if (is_main_site())
            Choose Location
          @else
            {{ bloginfo('sitename') }}
          @endif
        @php restore_current_blog(); @endphp
      </a>
    </div>

    <div class="uk-container nav-mobile-container">
      {{-- Mobile location specific nav --}}
      <div class="nav-location-primary-container">
        @php \App\switch_to_user_blog(); @endphp
          @if (has_nav_menu('location_primary_navigation'))
            {!!
              wp_nav_menu([
                'echo' => false,
                'container' => false,
                'theme_location' => 'location_primary_navigation',
                'menu_class' => 'nav nav-primary nav-location-primary'
              ])
            !!}
          @endif
        @php restore_current_blog(); @endphp
      </div>

      {{-- Mobile primary nav --}}
      @php \App\switch_to_main_blog(); @endphp
        @if (has_nav_menu('primary_navigation'))
          {!!
            wp_nav_menu([
              'echo' => false,
              'theme_location' => 'primary_navigation',
              'container_class' => 'nav-primary-container',
              'menu_class' => 'nav nav-primary'
            ])
          !!}
        @endif
      @php restore_current_blog(); @endphp

      {{-- Mobile secondary nav --}}
      @php \App\switch_to_main_blog(); @endphp
        @if (has_nav_menu('secondary_navigation'))
          {!!
            wp_nav_menu([
              'echo' => false,
              'theme_location' => 'secondary_navigation',
              'menu_class' => 'nav nav-secondary'
            ])
          !!}
        @endif
      @php restore_current_blog(); @endphp
    </div>
  </nav>

  {{-- Mobile location picker --}}
  <nav class="nav-mobile nav-mobile-location bg-brand-secondary">
    @php \App\switch_to_main_blog(); @endphp
      @if (has_nav_menu('locations'))
        {!!
          wp_nav_menu([
            'echo' => false,
            'theme_location' => 'locations',
            'container_class' => 'uk-container locations-container',
            'menu_class' => 'nav nav-locations-dropdown'
          ])
        !!}
        <div class="uk-flex uk-section-xsmall uk-flex-center map-cta-container">
          @include('components.cta-link', (array) get_field('locations_dropdown_cta', 'option'))
        </div>
      @endif
    @php restore_current_blog(); @endphp
  </nav>
</header>

<nav class="nav-locations-floating nav-floating">
  <div class="uk-section-small bg-brand-secondary">
    <h2 class="text-heading-large color-white uk-text-center">Choose a location</h2>
    @php \App\switch_to_main_blog(); @endphp
      @if (has_nav_menu('locations'))
        {!!
          wp_nav_menu([
            'echo' => false,
            'theme_location' => 'locations',
            'container_class' => 'uk-container locations-container',
            'menu_class' => 'nav nav-locations-dropdown'
          ])
        !!}
        <div class="uk-flex uk-margin-top uk-flex-center nav-locations-dropdown__cta">
          @include('components.cta-link', (array) get_field('locations_dropdown_cta', 'option'))
        </div>
      @endif
    @php restore_current_blog(); @endphp
    <div class="uk-flex-grow uk-flex uk-flex-bottom">
      <button class="nav-floating__close dropdown-close color-white"><i class="icon-close"></i></a>
    </div>
  </div>
</nav>
