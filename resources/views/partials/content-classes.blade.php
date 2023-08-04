@if (!empty($post->post_content))
  <section class="uk-container uk-section uk-flex uk-flex-center">
    <div class="uk-width-5-6 content-wp content-main">
      @php the_content() @endphp
    </div>
  </section>
  @include('components.top-accent')
@endif

<div class="bg-dots">
  @foreach ($class_types as $class_type)
    @php $class_type->class_type = \ClassType::classTypeWithMetadata($class_type->class_type) @endphp
    <div uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-container uk-flex uk-flex-column uk-flex-middle">
      <div class="uk-section uk-width-5-6">
        <h2 class="text-heading-large overline-medium">
          {{ $class_type->class_type->heading }}{{!empty($class_type->class_type->subheading) ? ': ' . $class_type->class_type->subheading : ''}}
        </h2>
        {!! !empty($class_type->description) ? $class_type->description : apply_filters('the_content', $class_type->class_type->description) !!}
      </div>
      <div class="uk-width-1-1">
        @include('blocks.class-list', [
          'classes' => $class_type->classes,
          'class_type' => \ClassType::classTypeWithMetadata($class_type->class_type),
        ])
      </div>
      <div class="uk-margin-medium-top">
        @php
          $activity = get_post($post->post_parent)->post_name;

          if (!empty($class_type->class_type->slug)) {
            $class_type_param = '&class-type=' . $class_type->class_type->slug;
          } else {
            $class_type_param = '';
          }
        @endphp
      </div>
    </div>
  @endforeach
</div>
