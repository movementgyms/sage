@if(!empty($content_blocks))
  @foreach ($content_blocks as $index => $block)
    @switch ($block->acf_fc_layout)

      @case('blog_posts')
        <div uk-scrollspy="cls: uk-animation-slide-bottom-medium;">
          <section  class="uk-section {{ \App\block_background_color($block) }}">
            @include('blocks.blog-posts', (array) $block)
          </section>
          @include('components.block-accent', ['accent_color' => $block->background_color])
        </div>
        @break

      @case('class_types')
        <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section {{ \App\block_background_color($block) }}">
          @include('blocks.class-types', (array) $block)
        </section>
        @break

      @case('contact_us')
        <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section-small {{ \App\block_background_color($block) }}">
          @include('blocks.contact-us', (array) $block)
        </section>
        @break

      @case('content_cards')
        <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section-small {{ \App\block_background_color($block) }}">
          @include('blocks.content-cards', (array) $block)
        </section>
        @break

      @case('content_with_alternating_images')
        <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section {{ \App\block_background_color($block) }}">
          @include('blocks.content-with-alternating-images', (array) $block)
        </section>
        @break

      @case('content_with_image')
        <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="{{$index !== 0 ? 'uk-margin-top' : ''}} uk-margin-bottom {{ \App\block_background_color($block) }}">
          @include('blocks.content-with-image', (array) $block)
        </section>
        @break

      @case('content')
        <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="{{ \App\section_class_from_size($block->padding) }}">
          @include('blocks.content', (array) $block)
        </section>
        @break

      @case('cta_list')
        <div uk-scrollspy="cls: uk-animation-slide-bottom-medium;">
          <section class="uk-section {{ \App\block_background_color($block) }}">
            @include('blocks.cta-list', (array) $block)
          </section>
          @include('components.block-accent', ['accent_color' => $block->background_color])
        </div>
        @break

      @case('directors')
        <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section">
          @include('blocks.directors', (array) $block)
        </section>
        @break

      @case('faqs')
        <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section {{ \App\block_background_color($block) }}">
          @include('blocks.faqs', (array) $block)
        </section>
        @break

      @case('gallery')
        <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section-small collapse-bg">
          @include('blocks.gallery', (array) $block)
        </section>
        @break

      @case('gallery_with_logo')
        <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section-small collapse-bg">
          @include('blocks.gallery-with-logo', (array) $block)
        </section>
        @break

      @case('large_two_column_list')
        <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section {{ \App\block_background_color($block) }}">
          @include('blocks.large-two-column-list', (array) $block)
        </section>
        @break

      @case('links_with_images_grid')
        <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section {{ \App\block_background_color($block) }}">
          @include('blocks.links-with-images-grid', (array) $block)
        </section>
        @break

      @case('media_with_caption')
        <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section {{ \App\block_background_color($block) }}">
          @include('blocks.media-with-caption', (array) $block)
        </section>
        @break

      @case('our_routesetters_module')
        <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section-small {{ \App\block_background_color($block) }}">
          @include('blocks.our-routesetters-module', (array) $block)
        </section>
        @break

      @case('person_list')
        <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section {{ \App\block_background_color($block) }}">
          @include('blocks.person-list', (array) $block)
        </section>
        @break

      @case('pricing')
        <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="{{ \App\block_background_color($block) }}">
          @include('blocks.pricing', (array) $block)
        </section>
        @break

      @case('separator')
        <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="content-blocks__separator">
          @include('blocks.separator', (array) $block)
        </section>
        @break

      @case('social_scene')
        <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section-small {{ \App\block_background_color($block) }}">
          @include('blocks.social-scene', (array) $block)
        </section>
        @break

      @case('steps')
        <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section {{ \App\block_background_color($block) }}">
          @include('blocks.steps', (array) $block)
        </section>
        @break

      @case('tabbed_content_slider')
        <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section-small {{ \App\block_background_color($block) }}">
          @include('blocks.tabbed-content-slider', (array) $block)
        </section>
        @break

      @case('two_column_with_images')
        <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section {{ \App\block_background_color($block) }}">
          @include('blocks.two-column-with-images', (array) $block)
        </section>
        @break

      @case('upcoming_classes')
        <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section-small {{ \App\block_background_color($block) }}">
          @include('blocks.upcoming-classes', (array) $block)
        </section>
        @break

      @case('waiver_module')
        <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section {{ \App\block_background_color($block) }}">
          @include('blocks.waiver-module', (array) $block)
        </section>
        @break

      @case('icon_grid')
        <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section {{ \App\block_background_color($block) }}">
          @include('blocks.icon-grid', (array) $block)
        </section>
        @break

      @case('photo_grid')
        <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section {{ \App\block_background_color($block) }}">
          @include('blocks.photo-grid', (array) $block)
        </section>
        @break

    @endswitch
  @endforeach
@endif
