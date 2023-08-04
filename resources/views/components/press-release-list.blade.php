<ul class="uk-list list-with-separator press-releases">
  @foreach ($press_releases as $press_release)
    <li>
      <time class="text-label-small text-transform-uppercase">
        {{ \App\date_from_wp_date($press_release->post_date)->format('M j, Y') }}
      </time>
      <h3 class="uk-margin-xsmall-bottom uk-margin-xsmall-top text-heading-medium text-transform-none">{{ get_the_title($press_release) }}</h3>
      <a class="cta-small" href="{{ get_permalink($press_release) }}">Read More</a>
    </li>
  @endforeach
</ul>
