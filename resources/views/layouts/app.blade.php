<!doctype html>
<html {!! get_language_attributes() !!}>
  @include('partials.head')
  <body
    @php
      body_class(
        'movement-combined '.
        (is_main_site() ? ' site-main' : ' site-location') .
        (!empty($user_blog_id) && $user_blog_id !== 1 ? ' has-location-selected' : '')
      )
    @endphp
  >
    @php do_action('get_header') @endphp
    @include('partials.header-message-banners')
    @include('partials.header')
    <div class="wrap container" role="document">
      <div class="content">
        <main class="main">
          @yield('content')
        </main>
        @if (App\display_sidebar())
          <aside class="sidebar">
            @include('partials.sidebar')
          </aside>
        @endif
      </div>
    </div>
    {{-- Show rebrand modal instead of redirect modal now --}}
    {{-- @if (!empty($_GET['redirected']) && $_GET['redirected'] === '1')
      @if (is_front_page() && get_current_blog_id() === 1)
        @include('components.redirect-modal-home')
      @else
        @include('components.redirect-modal')
      @endif
    @endif --}}
    @php do_action('get_footer') @endphp
    @include('partials.footer')
    @php wp_footer() @endphp
  </body>
</html>
