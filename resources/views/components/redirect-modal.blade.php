<div id="redirect-modal" class="uk-modal-container" uk-modal>
  <div class="uk-modal-dialog uk-margin-auto-vertical bg-brand-secondary">
    <div class="uk-flex uk-flex-column uk-margin-small-top uk-margin-small-bottom">
      <div class="bg-white">
        <div class="uk-padding content-wp">
          @php \App\switch_to_main_blog() @endphp
            {!! get_field('redirect_modal_content', 'option') !!}
          @php restore_current_blog() @endphp
        </div>
        <button class="uk-modal-close cta-block-close uk-margin-auto-left"></button>
      </div>
    </div>
  </div>
</div>
