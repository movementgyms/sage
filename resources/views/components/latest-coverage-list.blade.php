<ul uk-grid class="uk-margin-top uk-list uk-list-collapse uk-flex uk-flex-stretch uk-child-width-1-2@s uk-child-width-1-3@m">
  @foreach ($latest_coverage as $article)
    <li class="uk-flex uk-flex-stretch">
      <div class="uk-flex uk-flex-column uk-padding bg-{{ !empty($archive) ? 'white' : 'gray-light' }} color-blue-dark">
        <div class="uk-flex-grow">
          <h3 class="text-heading-medium text-transform-none">
            {{ get_the_title($article) }}
          </h3>

          <p>{{ get_the_excerpt($article) }}</p>
          <a class="cta-small" href="{{ get_field('article_url', $article) }}" target="_blank">Read More</a>
        </div>
        <div class="uk-margin-top latest-coverage__publication-logo uk-background-contain uk-background-center-left" style="background-image: url('{{ get_field('publication_logo', $article)['sizes']['medium'] }}')"></div>
      </div>
    </li>
  @endforeach
</ul>
