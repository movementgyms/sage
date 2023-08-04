<div class="bg-dots">
  <section uk-scrollspy="cls: uk-animation-slide-bottom-medium;" class="uk-section">
    <div class="uk-container">
      @include('components.person-list', ['instructors' => $instructors, 'has_classes' => true])
    </div>
  </section>
</div>
