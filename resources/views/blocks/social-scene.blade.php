<div class="uk-container social-scene">
  <h2 class="text-heading-xlarge uk-text-center overline-medium overline-center">{{ $title }}</h2>
  @php
    $options = get_option( 'sb_instagram_settings', []);
		$connected_accounts = isset( $options['connected_accounts'] ) ? $options['connected_accounts'] : [];
  @endphp
  @if (count($connected_accounts) > 0)
    {!! do_shortcode('[instagram-feed type=user num=6 cols=3 colsmobile=2 showheader=false showcaption=false showfollow=false order=recent imagepadding=10]') !!}
  @else
    <div uk-grid class="uk-margin-top uk-child-width-1-2 uk-child-width-1-3@s" uk-grid>
      @foreach($images as $image)
        <figure>
          <div
            role="image"
            class="social-scene__image uk-background-cover"
            style="background-image: url('{{ $image->sizes->large }}')"
            aria-label="{{ $image->alt }}">
          </div>
        </figure>
      @endforeach
    </div>
  @endif
</div>
