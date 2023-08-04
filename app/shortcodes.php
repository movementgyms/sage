<?php

namespace App;

function text_rotator_shortcode($atts) {
  $atts = shortcode_atts([
    'words' => '',
  ], $atts);

  $words = explode('|', $atts['words']);

  $output = '<span class="text-rotator">';
  foreach ($words as $index => $word) {
    $output .= '<span class="' . ($index === 0 ? 'text-rotator__active' : '') . '">' . $word . '</span>';
  }

  $output .= '</span>';

  return $output;
}

add_shortcode('text-rotator', 'App\text_rotator_shortcode');

function plans_dropdown() {
  $links = get_field('membership_links_links', 1651);
  $output = '<div class="dropdown-container relative-dropdown">
    <div class="dropdown-text">
      '.get_field('membership_area_membership_dropdown', 1651).'
    </div>
    <div class="dropdown-content">';
      foreach ($links as $link):
        $output .= '<ul>
            <li>
              <a href='.$link['link'].'>
                '.$link['city'].'
              </a>
            </li>
          </ul>';
      endforeach;

  $output .= '  </div>
              </div>';
  return $output;
}

add_shortcode('plans-dropdown', 'App\plans_dropdown');

function summer_plans_dropdown() {
  $links = get_field('summer_membership_links_links');
  $output = '<div class="dropdown-container relative-dropdown">
    <div class="dropdown-text">
      '.get_field('summer_membership_links_membership_dropdown_text').'
    </div>
    <div class="dropdown-content">';
      foreach ($links as $link):
        $output .= '<ul>
            <li>
              <a href='.$link['link'].'>
                '.$link['city'].'
              </a>
            </li>
          </ul>';
      endforeach;

  $output .= '  </div>
              </div>';
  return $output;
}

add_shortcode('summer-plans-dropdown', 'App\summer_plans_dropdown');