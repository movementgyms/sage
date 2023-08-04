<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class TemplateMediaCenter extends Controller
{
  public function pressReleases() {
    return get_posts([
      'post_type' => 'press_release',
      'posts_per_page' => 3,
    ]);
  }

  public function latestCoverage() {
    return get_posts([
      'post_type' => 'latest_coverage',
      'posts_per_page' => 3,
    ]);
  }
}
