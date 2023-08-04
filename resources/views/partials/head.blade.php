@php
  global $user_location, $user_blog_id, $user_location_name, $location_navigation_top_level, $location_navigation;
@endphp
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="facebook-domain-verification" content="urushu5kedwy8t9598j0k7l8h4t73c" />
  @php wp_head() @endphp

  <!-- Google Tag Manager -->
  @php \App\switch_to_main_blog(); @endphp
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','{{ get_field('gtm_id', 'option')}}');</script>
  @php restore_current_blog(); @endphp
  <!-- End Google Tag Manager -->

  <link rel="stylesheet" href="//fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;1,700&display=swap" async>

  @if (!is_main_site() || (!empty($_GET['user_location']) && empty($_COOKIE['user_location'])) )
    <script>
      window.elcap_data = {
        user_location: {!! json_encode($user_location) !!},
        user_location_name: {!! json_encode(!empty($user_location_name) ? $user_location_name : '') !!},
        user_blog_id: {!! json_encode($user_blog_id) !!},
        location_navigation_top_level: {!! json_encode(!empty($location_navigation_top_level) ? $location_navigation_top_level : '') !!},
        location_navigation: {!! json_encode(!empty($location_navigation) ? $location_navigation : '') !!},
      };
    </script>
  @endif

  <script>
    window.ajaxurl = {!! json_encode(admin_url( 'admin-ajax.php' )) !!};
  </script>

  @if (!empty(get_field('hotjar_site_id', 'option')))
    <!-- Hotjar Tracking Code for el-cap.com -->
    @php \App\switch_to_main_blog() @endphp
    <script>
      (function(h,o,t,j,a,r){
          h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
          h._hjSettings={hjid:{{ get_field('hotjar_site_id', 'option') }},hjsv:6};
          a=o.getElementsByTagName('head')[0];
          r=o.createElement('script');r.async=1;
          r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
          a.appendChild(r);
      })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
    @php restore_current_blog() @endphp
  @endif
</head>
