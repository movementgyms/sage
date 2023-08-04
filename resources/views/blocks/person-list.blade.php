<div class="person-list">
  <div class="uk-container">
    @if (!empty($title))
      <h2 class="uk-text-center text-heading-large text-overline-medium text-overline-center">{{ $title }}</h2>
    @endif
    @include('components.person-list', ['instructors' => $people, 'has_classes' => false])
  </div>
</div>
