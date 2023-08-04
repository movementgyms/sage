<div id="redirect-modal" class="uk-modal-container redirect-modal" uk-modal>
  <div class="uk-modal-dialog uk-margin-auto-vertical bg-brand-secondary">
    <div class="uk-flex uk-flex-column uk-padding-medium uk-padding-remove-bottom">
      @php \App\switch_to_main_blog() @endphp
        <div class="content-wp color-white">
          {!! get_field('home_redirect_modal_content', 'option') !!}
        </div>
        @if (has_nav_menu('locations'))
          {!!
            wp_nav_menu([
              'theme_location' => 'locations',
              'container_class' => 'uk-width-1-1 uk-margin-small-top locations-container',
              'menu_class' => 'nav nav-locations-dropdown'
            ])
          !!}
          <div class="uk-flex uk-margin-top uk-flex-center nav-locations-dropdown__cta">
            @include('components.cta-link', (array) get_field('locations_dropdown_cta', 'option'))
          </div>
        @endif
      @php restore_current_blog() @endphp
    </div>
    <button class="uk-modal-close cta-block-close uk-margin-small-top uk-margin-auto-left"></button>
  </div>
</div>
